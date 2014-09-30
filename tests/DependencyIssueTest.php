<?php
/**
 * Unit tests for PHP_CompatInfo package, issues reported
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
 * @since      Class available since Release 3.2.0
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
class DependencyIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH100 = 'GH#100';
    const GH128 = 'GH#128';

    protected static $compatinfo;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $finder = new Finder();
        $finder->files()
            ->name('gh100.php')
            ->in(
                dirname(__FILE__) . DIRECTORY_SEPARATOR .
                '_files' . DIRECTORY_SEPARATOR
            )
        ;

        $finder2 = new Finder();
        $finder2->files()
            ->name('gh128.php')
            ->in(
                dirname(__FILE__) . DIRECTORY_SEPARATOR .
                '_files' . DIRECTORY_SEPARATOR
            )
        ;

        $pm = new ProviderManager;
        $pm->set(self::GH100, new SymfonyFinderProvider($finder));
        $pm->set(self::GH128, new SymfonyFinderProvider($finder2));

        self::$compatinfo = new CompatInfo;
        self::$compatinfo->setProviderManager($pm);

        $plugins = array(
            new CompatInfo\Analyser\SummaryAnalyser
        );
        $analyser = new AnalyserPlugin($plugins);
        self::$compatinfo->addPlugin($analyser);
    }

    /**
     * Regression test for bug GH#100
     *
     * @link https://github.com/llaville/php-compat-info/issues/100
     *       Reports "5.2.0 (min)" on DateTime::diff (which requires 5.3)
     * @group regression
     * @return void
     */
    public function testBugGH100()
    {
        self::$compatinfo->parse(array(self::GH100));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.versions';

        $expected = '5.3.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH100][$key]['php.min']
        );
    }

    /**
     * Regression test for bug GH#128
     *
     * @link https://github.com/llaville/php-compat-info/issues/128
     *       Detection of conditional code
     * @group regression
     * @return void
     */
    public function testBugGH128()
    {
        self::$compatinfo->parse(array(self::GH128));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.versions';

        $expected = '4.0.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH128][$key]['php.min']
        );
    }
}
