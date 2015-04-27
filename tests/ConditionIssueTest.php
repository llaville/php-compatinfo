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
class ConditionIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH128 = 'gh128.php';
    const GH159 = 'gh159.php';
    const GH160 = 'gh160';     // folder

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
     * Regression test for bug GH#128
     *
     * @link https://github.com/llaville/php-compat-info/issues/128
     *       Detection of conditional code
     * @group regression
     * @return void
     */
    public function testBugGH128()
    {
        $dataSource = self::$fixtures . self::GH128;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'php.all'      => '5.4.0RC3',
            ),
            $versions
        );
    }

    /**
     * Regression test for bug GH#159
     *
     * @link https://github.com/llaville/php-compat-info/issues/159
     *       Conditionally used class is reported as required
     * @group regression
     * @return void
     */
    public function testBugGH159()
    {
        $dataSource = self::$fixtures . self::GH159;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];
        $classes    = $metrics[self::$analyserId]['classes'];

        $this->assertEquals(
            array(
                'php.min'      => '4.3.0',
                'php.max'      => '',
                'php.all'      => '5.3.0alpha1',
            ),
            $versions
        );

        $this->assertArrayHasKey('Normalizer', $classes);

        $this->assertEquals(
            array(
                'ext.name'     => 'intl',
                'ext.min'      => '1.0.0beta',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.3.0alpha1',
                'php.max'      => '',
                'php.all'      => '5.3.0alpha1',
                'arg.max'      => 0,
                'matches'      => 1,
                'optional'     => true,
            ),
            $classes['Normalizer']
        );
    }

    /**
     * Regression test for bug GH#160
     *
     * @link https://github.com/llaville/php-compat-info/issues/160
     *       Depending on parsing file order, some code conditions are not detected
     * @group regression
     * @return void
     */
    public function testBugGH160()
    {
        $dataSource = self::$fixtures . self::GH160;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'php.all'      => '5.6.0alpha1',
            ),
            $versions
        );
    }
}
