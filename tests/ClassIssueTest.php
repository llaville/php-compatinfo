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

namespace Bartlett\Tests\CompatInfo;

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
class ClassIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH119 = 'gh119.php';
    const GH129 = 'gh129.php';
    const GH131 = 'gh131.php';
    const GH166 = 'gh166.php';

    protected static $fixtures;
    protected static $analyserId;
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

        self::$analyserId = 'Bartlett\CompatInfo\Analyser\CompatibilityAnalyser';

        $client = new Client();

        // request for a Bartlett\Reflect\Api\Analyser
        self::$api = $client->api('analyser');
    }

    /**
     * Regression test for bug GH#119
     *
     * @link https://github.com/llaville/php-compat-info/issues/119
     *       "private" keyword reports as "Required PHP 4.0.0 (min)"
     * @group regression
     * @return void
     */
    public function testBugGH119()
    {
        $dataSource = self::$fixtures . self::GH119;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            array(
                'ext.name'     => 'user',
                'ext.min'      => '',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.0.0',
                'php.max'      => '',
                'php.all'      => '5.0.0',
                'matches'      => 0,
                'declared'     => true,
            ),
            $classes['Foo']
        );
    }

    /**
     * Regression test for bug GH#129
     *
     * @link https://github.com/llaville/php-compat-info/issues/129
     *       "Non-empty classes are reported to require PHP 5.0.0"
     * @group regression
     * @return void
     * @see testBugGH119()
     */
    public function testBugGH129()
    {
        $dataSource = self::$fixtures . self::GH129;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $methods    = $metrics[self::$analyserId]['methods'];

        // implicitly public visibility
        $this->assertEquals(
            array(
                'ext.name'     => 'user',
                'ext.min'      => '',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'php.all'      => '4.0.0',
                'matches'      => 0,
            ),
            $methods['Foo2::bar']
        );

        // public visibility
        $this->assertEquals(
            array(
                'ext.name'     => 'user',
                'ext.min'      => '',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.0.0',
                'php.max'      => '',
                'php.all'      => '5.0.0',
                'matches'      => 0,
            ),
            $methods['Foo2::baz']
        );
    }

    /**
     * Regression test for bug GH#131
     *
     * @link https://github.com/llaville/php-compat-info/issues/131
     *       "Classes in extends clause are not recognized"
     * @group regression
     * @return void
     */
    public function testBugGH131()
    {
        $dataSource = self::$fixtures . self::GH131;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'      => '5.1.0',
                'php.max'      => '',
                'php.all'      => '5.1.0',
            ),
            $versions
        );
    }

    /**
     * Regression test for bug GH#166
     *
     * @link https://github.com/llaville/php-compat-info/issues/166
     *       "Type hinting and objects"
     * @group regression
     * @return void
     */
    public function testBugGH166()
    {
        $dataSource = self::$fixtures . self::GH166;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $classes    = $metrics[self::$analyserId]['classes'];
        $interfaces = $metrics[self::$analyserId]['interfaces'];

        $this->assertEquals(
            array(
                'ext.name'     => 'spl',
                'ext.min'      => '5.1.0',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.1.0',
                'php.max'      => '',
                'php.all'      => '5.1.0',
                'matches'      => 1,
            ),
            $interfaces['RecursiveIterator']
        );

        $this->assertEquals(
            array(
                'ext.name'     => 'user',
                'ext.min'      => '',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'php.all'      => '5.1.0',
                'matches'      => 0,
                'declared'     => true,
            ),
            $classes['Foo']
        );
    }
}
