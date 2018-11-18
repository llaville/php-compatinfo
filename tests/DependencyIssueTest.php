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
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
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
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class DependencyIssueTest extends \PHPUnit\Framework\TestCase
{
    const GH100 = 'gh100.php';
    const GH165 = 'gh165.php';
    const GH194 = 'gh194.php';

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
        $versions   = $metrics[self::$analyserId]['versions'];
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            array(
                'php.min'      => '5.3.0',
                'php.max'      => '',
                'php.all'      => '5.3.0',
            ),
            $versions
        );

        $this->assertEquals(
            array(
                'ext.name'     => 'date',
                'ext.min'      => '5.2.0',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.3.0',
                'php.max'      => '',
                'php.all'      => '5.3.0',
                'prototype'    => 'DateTimeInterface',
                'proto_since'  => '5.5.0',
                'arg.max'      => 1,
                'matches'      => 1,
            ),
            $methods['DateTime::diff']
        );
    }

    /**
     * Regression test for request GH#165
     *
     * @link https://github.com/llaville/php-compat-info/issues/165
     *       Find undeclared elements
     * @group regression
     * @return void
     */
    public function testBugGH165()
    {
        $dataSource = self::$fixtures . self::GH165;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $classes    = $metrics[self::$analyserId]['classes'];

        $undeclaredClasses = array(
            'Console_Table',
            'Doctrine\Common\Cache\Cache',
            'Foo\Foo',
            'SebastianBergmann\Version',
        );

        foreach ($undeclaredClasses as $c) {
            $this->assertArrayNotHasKey(
                'declared',
                $classes[$c],
                "$c is marked as declared while definition is not provided"
            );
        }
    }

    /**
     * Regression test for bug GH#194
     *
     * @link https://github.com/llaville/php-compat-info/issues/194
     *       Static method calls don't properly adjust total requirements
     * @group regression
     * @return void
     */
    public function testBugGH194()
    {
        $dataSource = self::$fixtures . self::GH194;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];
        $methods    = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            array(
                'php.min'      => '5.3.0alpha1',
                'php.max'      => '',
                'php.all'      => '5.3.0alpha1',
            ),
            $versions
        );

        $this->assertArrayHasKey('Normalizer::normalize', $methods);

        $this->assertEquals(
            array(
                'ext.name'     => 'intl',
                'ext.min'      => '1.0.0beta',
                'ext.max'      => '',
                'ext.all'      => '',
                'php.min'      => '5.3.0alpha1',
                'php.max'      => '',
                'php.all'      => '5.3.0alpha1',
                'arg.max'      => 1,
                'matches'      => 1,
                'prototype'    => '',
                'proto_since'  => '',
            ),
            $methods['Normalizer::normalize']
        );
    }
}
