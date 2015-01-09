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
class FunctionIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH130 = 'gh130.php';

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
     * Regression test for bug GH#130
     *
     * @link https://github.com/llaville/php-compat-info/issues/130
     *       "Conditionally called function is reported as interface"
     * @group regression
     * @return void
     */
    public function testBugGH130()
    {
        $dataSource = self::$fixtures . self::GH130;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $functions  = $metrics['CompatibilityAnalyser']['functions'];

        $this->assertArrayHasKey('foo', $functions);

        $this->assertEquals(
            array(
                'ext.name'     => 'user',
                'ext.min'      => '',
                'ext.max'      => '',
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'arg.max'      => 0,
                'matches'      => 1,
                'optional'     => true,
            ),
            $functions['foo']
        );
    }
}
