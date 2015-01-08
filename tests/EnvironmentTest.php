<?php
/**
 * Unit Test Case that covers the Environment component.
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/reflect/
 * @since      Class available since Release 3.6.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo\Environment;

/**
 * Unit Test Case that covers Bartlett\CompatInfo\Environment
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/reflect/
 */
class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    protected static $pdo;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     * @link   http://phpunit.de/manual/current/en/fixtures.html#fixtures.sharing-fixture
     */
    public static function setUpBeforeClass()
    {
        self::$pdo = Environment::initRefDb();
    }

    /**
     * Clean-up the shared fixture environment.
     *
     * @return void
     * @link   http://phpunit.de/manual/current/en/fixtures.html#fixtures.sharing-fixture
     */
    public static function tearDownAfterClass()
    {
        self::$pdo = null;
    }

    /**
     * @covers Bartlett\CompatInfo\Environment::initRefDb
     *
     * @return void
     */
    public function testInitRefDb()
    {
        try {
            $pdo = Environment::initRefDb();

        } catch (\Exception $e) {
            $this->fail(
                'An unexpected ' . get_class($e)
                . ' exception has been raised with message. '
                . $e->getMessage()
            );
        }

        $this->assertInstanceOf(
            'PDO',
            $pdo,
            'Reference database instance is not PDO'
        );
    }
}
