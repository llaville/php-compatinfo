<?php
/**
 * Unit tests for PHP_CompatInfo package, PHP features
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
 * @since      Class available since Release 3.6.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo;

use Bartlett\Reflect\ProviderManager;
use Bartlett\Reflect\Provider\SymfonyFinderProvider;
use Bartlett\Reflect\Plugin\Analyser\AnalyserPlugin;

use Symfony\Component\Finder\Finder;

/**
 * Tests for PHP_CompatInfo, retrieving dependency elements,
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
class PhpFeaturesTest extends \PHPUnit_Framework_TestCase
{
    const GH140 = 'GH#140';
    const GH141 = 'GH#141';
    const GH142 = 'GH#142';

    protected static $compatinfo;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $fixtures = dirname(__FILE__) . DIRECTORY_SEPARATOR
            . '_files' . DIRECTORY_SEPARATOR;

        $finder = new Finder();
        $finder->files()
            ->name('gh140.php')
            ->in($fixtures)
        ;

        $finder1 = new Finder();
        $finder1->files()
            ->name('gh141.php')
            ->in($fixtures)
        ;

        $finder2 = new Finder();
        $finder2->files()
            ->name('gh142.php')
            ->in($fixtures)
        ;

        $pm = new ProviderManager;
        $pm->set(self::GH140, new SymfonyFinderProvider($finder));
        $pm->set(self::GH141, new SymfonyFinderProvider($finder1));
        $pm->set(self::GH142, new SymfonyFinderProvider($finder2));

        self::$compatinfo = new CompatInfo;
        self::$compatinfo->setProviderManager($pm);

        $plugins = array(
            new CompatInfo\Analyser\SummaryAnalyser
        );
        $analyser = new AnalyserPlugin($plugins);
        self::$compatinfo->addPlugin($analyser);
    }

    /**
     * Regression test for feature GH#140
     *
     * @link https://github.com/llaville/php-compat-info/issues/140
     *       Constant scalar expressions are 5.6+
     * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.const-scalar-exprs
     * @group features
     * @return void
     */
    public function testFeatureGH140()
    {
        self::$compatinfo->parse(array(self::GH140));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.versions';

        $expected = '5.6.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH140][$key]['php.min']
        );
    }

    /**
     * Regression test for feature GH#141
     *
     * @link https://github.com/llaville/php-compat-info/issues/141
     *       Variadic functions are 5.6+
     * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.variadics
     * @group features
     * @return void
     */
    public function testFeatureGH141()
    {
        self::$compatinfo->parse(array(self::GH141));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.versions';

        $expected = '5.6.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH141][$key]['php.min']
        );
    }

    /**
     * Regression test for feature GH#142
     *
     * @link https://github.com/llaville/php-compat-info/issues/142
     *       Exponentiation is 5.6+
     * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
     * @group features
     * @return void
     */
    public function testFeatureGH142()
    {
        self::$compatinfo->parse(array(self::GH142));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.versions';

        $expected = '5.6.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH142][$key]['php.min']
        );
    }

}
