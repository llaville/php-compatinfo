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
 * @since      Class available since Release 4.0.0-alpha2+1
 */

namespace Bartlett\Tests\CompatInfo\Reference;

use Bartlett\Reflect\Client;

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
class DependencyIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH100 = 'gh100.php';

    protected static $fixtures;
    protected static $api;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$fixtures = __DIR__ . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR;

        $client = new Client();

        // request for a Bartlett\Reflect\Api\Analyser
        self::$api = $client->api('analyser');
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
        $dataSource = self::$fixtures . self::GH100;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics['CompatibilityAnalyser']['versions'];
        $classes    = $metrics['CompatibilityAnalyser']['classes'];
        $methods    = $metrics['CompatibilityAnalyser']['methods'];

        $this->assertEquals(
            array(
                'php.min'      => '5.3.0',
                'php.max'      => '',
            ),
            $versions
        );

        $this->assertEquals(
            array(
                'ext.name'     => 'date',
                'ext.min'      => '5.2.0',
                'ext.max'      => '',
                'php.min'      => '5.2.0',
                'php.max'      => '',
                'arg.max'      => 1,
                'matches'      => 2,
            ),
            $classes['DateTime']
        );

        $this->assertEquals(
            array(
                'ext.name'     => 'date',
                'ext.min'      => '5.2.0',
                'ext.max'      => '',
                'php.min'      => '5.3.0',
                'php.max'      => '',
                'arg.max'      => 1,
                'matches'      => 1,
            ),
            $methods['DateTime::diff']
        );
    }
}
