<?php
/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
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
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */
class FunctionIssueTest extends \PHPUnit\Framework\TestCase
{
    const GH130 = 'gh130.php';

    protected static $fixtures;
    protected static $analyserId;
    protected static $api;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$fixtures = __DIR__ . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR;

        self::$analyserId = 'Bartlett\CompatInfo\Analyser\CompatibilityAnalyser';

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
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey('foo', $functions);

        $this->assertEquals(
            array(
                'ext.name'     => 'user',
                'ext.min'      => '',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '4.0.0',
                'php.max'      => '',
                'php.all'      => '4.0.0',
                'arg.max'      => 0,
                'matches'      => 1,
                'optional'     => true,
            ),
            $functions['foo']
        );
    }
}
