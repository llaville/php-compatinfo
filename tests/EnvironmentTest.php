<?php
/**
 * Unit Test Case that covers the Environment component.
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 3.6.0
 */

namespace Bartlett\Tests\CompatInfo;

use Bartlett\CompatInfo\Util\Database;

/**
 * Unit Test Case that covers Bartlett\CompatInfoDb\Environment
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */
final class EnvironmentTest extends \PHPUnit\Framework\TestCase
{
    protected static $pdo;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     * @link   http://phpunit.de/manual/current/en/fixtures.html#fixtures.sharing-fixture
     */
    public static function setUpBeforeClass(): void
    {
        self::$pdo = Database::initRefDb();
    }

    /**
     * Clean-up the shared fixture environment.
     *
     * @return void
     * @link   http://phpunit.de/manual/current/en/fixtures.html#fixtures.sharing-fixture
     */
    public static function tearDownAfterClass(): void
    {
        self::$pdo = null;
    }

    /**
     * @return void
     */
    public function testInitRefDb()
    {
        try {
            $pdo = Database::initRefDb();

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
