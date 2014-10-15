<?php
/**
 * Unit tests for PHP_CompatInfo package, functions with optional arguments
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.5.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo;
use Bartlett\CompatInfo\Reference\Strategy\PreFetchStrategy;

use Bartlett\Reflect\ProviderManager;
use Bartlett\Reflect\Provider\SymfonyFinderProvider;
use Bartlett\Reflect\Plugin\Analyser\AnalyserPlugin;

use Symfony\Component\Finder\Finder;

/**
 * Tests for PHP_CompatInfo, retrieving reference elements,
 * and versioning information.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class ParameterTest extends \PHPUnit_Framework_TestCase
{
    protected static $compatinfo;
    protected static $pm;
    protected static $filesDir;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$pm         = new ProviderManager;
        self::$compatinfo = new CompatInfo;

        $plugins = array(
            new CompatInfo\Analyser\SummaryAnalyser
        );
        $analyser = new AnalyserPlugin($plugins);
        self::$compatinfo->addPlugin($analyser);

        self::$compatinfo->setProviderManager(self::$pm);

        self::$filesDir = dirname(__DIR__) . DIRECTORY_SEPARATOR
            . '_files' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Provider to test functions with default and optional arguments.
     *
     * @return array
     */
    public function functionProvider()
    {
        $prefetch   = new PreFetchStrategy();
        $loadedRefs = $prefetch->getLoadedReferences();

        $functions = array();

        foreach ($loadedRefs as $extname => $ref) {
            $fcts = $ref->getFunctions();

            foreach ($fcts as $fctname => $range) {
                if (!isset($range['parameters'])) {
                    // function without optional arguments
                    continue;
                }
                $functions[] = array($fctname, $extname);
            }
        }

        return $functions;
    }

    /**
     * Tests function signatures with default arguments
     *
     * @param string $fctname Function name that have optional arguments
     * @param string $extname Extension name that provide the $fctname
     *
     * @return void
     * @group  reference
     * @dataProvider functionProvider
     */
    public function testGetFunctionsWithDefaultArguments($fctname, $extname)
    {
        $this->assertFileExists(
            self::$filesDir . $fctname . '.18881d.php',
            "$extname::$fctname function does not have test file for default arguments"
        );

        $finder = new Finder();
        $finder->files()
            ->name($fctname . '.18881d.php')
            ->in(self::$filesDir)
        ;
        self::$pm->clear();
        self::$pm->set('18881d', new SymfonyFinderProvider($finder));

        self::$compatinfo->parse();

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.functions';

        $metrics = self::$compatinfo->getMetrics();

        $parameters = $metrics['18881d'][$key][$fctname]['parameters'];

        if (empty($parameters)) {
            // when no arguments provided (default signature)
            $parameters = array($metrics['18881d'][$key][$fctname]['php.min']);
        }

        $this->assertEquals(
            $parameters[0],
            $metrics['18881d'][$key][$fctname]['php.min'],
            'Wrong version with default arguments on ' . $fctname . ' function'
        );
    }

    /**
     * Tests function signatures with optional arguments
     *
     * @param string $fctname Function name that have optional arguments
     * @param string $extname Extension name that provide the $fctname
     *
     * @return void
     * @group  reference
     * @dataProvider functionProvider
     */
    public function testGetFunctionsWithOptionalArguments($fctname, $extname)
    {
        $this->assertFileExists(
            self::$filesDir . $fctname . '.18881o.php',
            "$extname::$fctname function does not have test file for optional arguments"
        );

        $finder = new Finder();
        $finder->files()
            ->name($fctname . '.18881o.php')
            ->in(self::$filesDir)
        ;
        self::$pm->clear();
        self::$pm->set('18881o', new SymfonyFinderProvider($finder));

        self::$compatinfo->parse();

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.functions';

        $metrics = self::$compatinfo->getMetrics();

        $parameters = $metrics['18881o'][$key][$fctname]['parameters'];

        $this->assertEquals(
            array_pop($parameters),
            $metrics['18881o'][$key][$fctname]['php.min'],
            'Wrong version with optional arguments on ' . $fctname . ' function'
        );
    }
}
