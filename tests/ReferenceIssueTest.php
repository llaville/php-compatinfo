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
 * @since      Class available since Release 3.4.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo;

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
class ReferenceIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH127 = 'GH#127';
    const GH153 = 'GH#153';

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
            ->name('gh127.php')
            ->in($fixtures)
        ;

        $finder1 = new Finder();
        $finder1->files()
            ->name('gh153.php')
            ->in($fixtures)
        ;

        $pm = new ProviderManager;
        $pm->set(self::GH127, new SymfonyFinderProvider($finder));
        $pm->set(self::GH153, new SymfonyFinderProvider($finder1));

        self::$compatinfo = new CompatInfo;
        self::$compatinfo->setProviderManager($pm);

        $plugins = array(
            new CompatInfo\Analyser\SummaryAnalyser
        );
        $analyser = new AnalyserPlugin($plugins);
        self::$compatinfo->addPlugin($analyser);
    }

    /**
     * Regression test for bug GH#127
     *
     * @link https://github.com/llaville/php-compat-info/issues/127
     *       "Interface Serializable is reported to require PHP 5.3"
     * @group regression
     * @return void
     */
    public function testBugGH127()
    {
        self::$compatinfo->parse(array(self::GH127));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX . '.versions';

        $expected = '5.1.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH127][$key]['php.min']
        );
    }

    /**
     * Regression test for bug GH#153
     *
     * @link https://github.com/llaville/php-compat-info/issues/153
     *       "global namespace reports highter requirements than everything else"
     * @group regression
     * @return void
     */
    public function testBugGH153()
    {
        self::$compatinfo->parse(array(self::GH153));

        $key = CompatInfo\Analyser\SummaryAnalyser::METRICS_PREFIX .
            '.' . CompatInfo\Metrics::FUNCTIONS;

        $expected = '5.0.0';
        $metrics  = self::$compatinfo->getMetrics();

        $this->assertEquals(
            $expected,
            $metrics[self::GH153][$key]['md5']['php.min']
        );
    }
}
