<?php
/**
 * Unit tests for PHP_CompatInfo Composer analyser
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Jens Hassler <j.hassler@iwf.ch>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.7.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo;
use Bartlett\Reflect\ProviderManager;
use Bartlett\Reflect\Provider\SymfonyFinderProvider;
use Bartlett\Reflect\Plugin\Analyser\AnalyserPlugin;

use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Finder\Finder;

/**
 * Tests for PHP_CompatInfo, retrieving extension elements,
 * and versioning information.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Jens Hassler <j.hassler@iwf.ch>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
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
                dirname(__DIR__) . DIRECTORY_SEPARATOR .
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
        self::$plugins[0]->render($bufferedOutput);
        $jsonOutput = $bufferedOutput->fetch();

        $expected = array(
            'require' => array(
                'php' => '>= 5.4.0',
                'ext-ldap' => '*',
                'ext-gd' => '*',
                'ext-sqlite' => '*',
                'ext-spl' => '*'
            )
        );

        $this->assertEquals(json_encode($expected, self::JSON_PRETTY_PRINT) . "\n", $jsonOutput);
    }
}
