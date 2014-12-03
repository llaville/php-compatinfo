<?php
/**
 * ComposerAnalyserTest.php
 * 
 * @author Jens Hassler
 * @since  11/2014
 */

namespace Bartlett\Tests\CompatInfo;


use Bartlett\CompatInfo;
use Bartlett\Reflect\ProviderManager;
use Bartlett\Reflect\Provider\SymfonyFinderProvider;
use Bartlett\Reflect\Plugin\Analyser\AnalyserPlugin;

use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Finder\Finder;

class ComposerAnalyserTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CompatInfo $compatinfo */
    protected static $compatinfo;

    /** @var  CompatInfo\Analyser\AbstractAnalyser[] $plugins*/
    protected static $plugins;

    const JSON_PRETTY_PRINT = 128;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $finder = new Finder();
        $finder->files()
            ->name('some_extensions.php')
            ->in(
                dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
                '_files' . DIRECTORY_SEPARATOR
            )
        ;

        $pm = new ProviderManager;
        $pm->set('default', new SymfonyFinderProvider($finder));

        self::$compatinfo = new CompatInfo();
        self::$compatinfo->setProviderManager($pm);

        $plugins = array(
            new CompatInfo\Analyser\ComposerAnalyser()
        );
        self::$plugins = $plugins;
        $analyser = new AnalyserPlugin($plugins);
        self::$compatinfo->addPlugin($analyser);
    }

    public function testOutput()
    {
        self::$compatinfo->parse(array('default'));

        $bufferedOutput = new BufferedOutput();
        self::$plugins[0]->render($bufferedOutput, '>= 4.0');
        $jsonOutput = $bufferedOutput->fetch();

        $expected = array(
            'require' => array(
                'php' => '>= 5.1.0',
                'ext-ldap' => '*',
                'ext-gd' => '*',
                'ext-sqlite' => '*',
                'ext-spl' => '*'
            )
        );

        $this->assertEquals(json_encode($expected, self::JSON_PRETTY_PRINT) . "\n", $jsonOutput);
    }


} 