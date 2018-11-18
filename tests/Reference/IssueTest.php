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
class IssueTest extends \PHPUnit\Framework\TestCase
{
    const GH127 = 'gh127.php';
    const GH162 = 'gh162.php';
    const GH210 = '../fixtures/vfsStream-1.6.0.zip';
    const GH220 = 'gh220.php';

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
        self::$fixtures = dirname(__DIR__) . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR;

        self::$analyserId = 'Bartlett\CompatInfo\Analyser\CompatibilityAnalyser';

        $client = new Client();

        // request for a Bartlett\Reflect\Api\Analyser
        self::$api = $client->api('analyser');
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
        $dataSource = self::$fixtures . self::GH127;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'  => '5.1.0',
                'php.max'  => '',
                'php.all'  => '5.1.0',
            ),
            $versions
        );
    }

    /**
     * Regression test for bug GH#162
     *
     * @link https://github.com/llaville/php-compat-info/issues/162
     *       "ReflectionClass::newInstanceWithoutConstructor require PHP 5.4"
     * @group regression
     * @return void
     */
    public function testBugGH162()
    {
        $dataSource = self::$fixtures . self::GH162;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'  => '5.4.0',
                'php.max'  => '',
                'php.all'  => '5.4.0',
            ),
            $versions
        );
    }

    /**
     * Regression test for bug GH#210
     *
     * @link https://github.com/llaville/php-compat-info/issues/210
     *       "Regression in 4.5 : missing extensions"
     * @group regression
     * @group large
     * @return void
     */
    public function testBugGH210()
    {
        $dataSource = self::$fixtures . self::GH210;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $extensions = $metrics[self::$analyserId]['extensions'];

        $provideExtensions = array(
            'Core',
            'standard',
            'dom',
            'date',
            'posix',
            'pcre',
            'spl',
            'xml',
            'zip',
        );

        foreach ($provideExtensions as $e) {
            $this->assertArrayHasKey(
                $e,
                $extensions,
                "Extension $e is not found in analysis results while it should be"
            );
        }
    }

    /**
     * Regression test for bug GH#220
     *
     * @link https://github.com/llaville/php-compat-info/issues/220
     *       "Did not detect Blowfish on crypt"
     * @group regression
     * @return void
     */
    public function testBugGH220()
    {
        $dataSource = self::$fixtures . self::GH220;
        $analysers  = array('compatibility');
        $metrics    = self::$api->run($dataSource, $analysers);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            array(
                'php.min'      => '5.3.7',
                'php.max'      => '',
                'php.all'      => '5.3.7',
            ),
            $versions
        );
    }
}
