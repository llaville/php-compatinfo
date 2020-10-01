<?php
/**
 * Unit tests for PHP_CompatInfo package, functions with optional arguments
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 3.5.0
 */

namespace Bartlett\Tests\CompatInfo\Reference;

use Bartlett\CompatInfo\Util\Database;
use Bartlett\Tests\CompatInfo\Sniffs\SniffTestCase;

use PDO;

/**
 * Tests function signatures with default and optional arguments
 */
final class ParameterTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= '..' . DIRECTORY_SEPARATOR . 'references' . DIRECTORY_SEPARATOR;
    }

    /**
     * Data Provider to test functions with default and optional arguments.
     *
     * @return array
     */
    public function functionProvider()
    {
        $pdo = Database::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare(
            'SELECT f.name, e.name as "ext.name" ' .
            ' FROM bartlett_compatinfo_functions f,  bartlett_compatinfo_extensions e' .
            ' WHERE f.ext_name_fk = e.id AND f.parameters != "" '
        );
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_NUM);
    }

    /**
     * Tests function signatures with default arguments
     *
     * @param string $fctname Function name that have optional arguments
     * @param string $extname Extension name that provide the $fctname
     *
     * @return void
     * @group  reference
     * @large
     * @dataProvider functionProvider
     */
    public function testGetFunctionsWithDefaultArguments(string $fctname, string $extname)
    {
        $this->assertFileExists(
            self::$fixtures . $fctname . '.18881d.php',
            "$extname::$fctname function does not have test file for default arguments"
        );

        $dataSource = $fctname . '.18881d.php';

        // ... and get metrics
        $metrics   = $this->executeAnalysis($dataSource);
        $functions = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey($fctname, $functions);

        // retrieves function's parameters
        $parameters = $functions[$fctname]['parameters'];
        // ... and max arguments count used
        $argc       = $functions[$fctname]['arg.max'];

        // when no arguments provided (default signature)
        array_unshift($parameters, $functions[$fctname]['php.min']);

        $this->assertEquals(
            $parameters[$argc],
            $functions[$fctname]['php.min'],
            'Wrong version with default arguments on ' . $fctname . ' function'
        );
    }

    /**
     * Tests function signatures with optional arguments
     *
     * @param string $fctname Function name that have optional arguments
     * @param string $extname Extension name that provide the $fctname
     *
     * @return void
     * @group  reference
     * @large
     * @dataProvider functionProvider
     */
    public function testGetFunctionsWithOptionalArguments(string $fctname, string $extname)
    {
        $this->assertFileExists(
            self::$fixtures . $fctname . '.18881o.php',
            "$extname::$fctname function does not have test file for optional arguments"
        );

        $dataSource = $fctname . '.18881o.php';
        // ... and get metrics
        $metrics   = $this->executeAnalysis($dataSource);
        $functions = $metrics[self::$analyserId]['functions'];

        $this->assertArrayHasKey($fctname, $functions);

        // retrieves function's parameters
        $parameters = $functions[$fctname]['parameters'];
        // ... and max arguments count used
        $argc       = $functions[$fctname]['arg.max'];

        // when no arguments provided (default signature)
        array_unshift($parameters, $functions[$fctname]['php.min']);

        $this->assertEquals(
            $parameters[$argc],
            $functions[$fctname]['php.min'],
            'Wrong version with optional arguments on ' . $fctname . ' function'
        );
    }
}
