<?php
/**
 * Unit tests for PHP_CompatInfo package, functions with optional arguments
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
 * @since      Class available since Release 3.5.0
 */

namespace Bartlett\Tests\CompatInfo\Reference;

use Bartlett\CompatInfoDb\Environment;

use Bartlett\Reflect\Client;

use PDO;

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
class ParameterTest extends \PHPUnit\Framework\TestCase
{
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
     * Data Provider to test functions with default and optional arguments.
     *
     * @return array
     */
    public function functionProvider()
    {
        $pdo = Environment::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare(
            'SELECT f.name, e.name as "ext.name" ' .
            ' FROM bartlett_compatinfo_functions f,  bartlett_compatinfo_extensions e' .
            ' WHERE f.ext_name_fk = e.id AND f.parameters != "" '
        );

        $stmt->execute();
        $functions = $stmt->fetchAll(PDO::FETCH_NUM);

        return $functions;
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
    public function testGetFunctionsWithDefaultArguments($fctname, $extname)
    {
        $this->assertFileExists(
            self::$fixtures . $fctname . '.18881d.php',
            "$extname::$fctname function does not have test file for default arguments"
        );

        $dataSource = self::$fixtures . $fctname . '.18881d.php';
        $analysers  = array('compatibility');
        // ... and get metrics
        $metrics   = self::$api->run($dataSource, $analysers);
        $functions = $metrics[self::$analyserId]['functions'];

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
    public function testGetFunctionsWithOptionalArguments($fctname, $extname)
    {
        $this->assertFileExists(
            self::$fixtures . $fctname . '.18881o.php',
            "$extname::$fctname function does not have test file for optional arguments"
        );

        $dataSource = self::$fixtures . $fctname . '.18881o.php';
        $analysers  = array('compatibility');
        // ... and get metrics
        $metrics   = self::$api->run($dataSource, $analysers);
        $functions = $metrics[self::$analyserId]['functions'];

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
