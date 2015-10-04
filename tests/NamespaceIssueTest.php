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
class NamespaceIssueTest extends \PHPUnit_Framework_TestCase
{
    const GH153 = 'gh153.php';
    const GH155 = 'gh155.php';
    const GH158 = 'gh158.php';

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
     * Regression test for bug GH#153
     *
     * @link https://github.com/llaville/php-compat-info/issues/153
     *       "global namespace reports highter requirements than everything else"
     * @group regression
     * @return void
     */
    public function testBugGH153()
    {
        $dataSource = self::$fixtures . self::GH153;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            array(
                'ext.name'     => 'standard',
                'ext.min'      => '5.0.0',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.0.0',
                'php.max'      => '',
                'php.all'      => '5.0.0',
                'parameters'   => array('4.0.0', '5.0.0'),
                'php.excludes' => '',
                'deprecated'   => '',
                'arg.max'      => 2,
                'matches'      => 3,
            ),
            $functions['md5']
        );
    }

    /**
     * Regression test for bug GH#155
     *
     * @link https://github.com/llaville/php-compat-info/issues/155
     *       Results depend on lexical order of fallback implementations
     * @group regression
     * @return void
     */
    public function testBugGH155()
    {
        $dataSource = self::$fixtures . self::GH155;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            array(
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'php.all'      => '5.2.0',
            ),
            $versions
        );

        $this->assertEquals(
            array(
                'ext.name'     => 'json',
                'ext.min'      => '5.2.0',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.2.0',
                'php.max'      => '',
                'php.all'      => '5.2.0',
                'parameters'   => array('5.2.0', '5.3.0', '5.5.0'),
                'php.excludes' => '',
                'deprecated'   => '',
                'arg.max'      => 1,
                'matches'      => 1,
                'optional'     => true,
            ),
            $functions['json_encode']
        );
    }

    /**
     * Regression test for bug GH#158
     *
     * @link https://github.com/llaville/php-compat-info/issues/158
     *       Total requirements do not include Constants
     * @group regression
     * @return void
     */
    public function testBugGH158()
    {
        $dataSource = self::$fixtures . self::GH158;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'      => '4.3.10',
                'php.max'      => '',
                'php.all'      => '4.3.10',
            ),
            $versions
        );
    }
}
