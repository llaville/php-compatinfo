<?php
/**
 * Unit tests for PHP_CompatInfo package, parameter type declaration sniff
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since      Class available since Release 5.4.0
 */

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Parameters Type Declaration
 *
 * @link https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration
 * @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
 * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/142
 * @link https://github.com/llaville/php-compat-info/issues/273
 */
final class ParamTypeDeclarationSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'functions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #142
     *
     * @link https://github.com/llaville/php-compat-info/issues/142
     *       Exponentiation is 5.6+
     * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
     * @group regression
     * @return void
     */
    public function testRegressionGH142()
    {
        $dataSource = 'gh142.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.6.0',
            $functions['baz']['php.min']
        );
        $this->assertEquals(
            '',
            $functions['baz']['php.max']
        );
    }

    /**
     * Regression test for issue #273
     *
     * @link https://github.com/llaville/php-compat-info/issues/273
     *       PHP 7.1 Nullable types not being detected
     * @group regression
     * @return void
     */
    public function testNullableTypeHint()
    {
        $dataSource = 'gh273.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.1.0',
            $functions['test']['php.min']
        );
    }

    /**
     * Feature test for array type hint declaration detection
     *
     * @group features
     * @return void
     */
    public function testArrayTypeHint()
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.1.0',
            $functions['arrayArg']['php.min']
        );
    }

    /**
     * Feature test for self and parent type hint declaration detection
     *
     * @group features
     * @return void
     */
    public function testSelfParentTypeHint()
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.2.0',
            $functions['selfArg']['php.min']
        );
        $this->assertEquals(
            '5.2.0',
            $functions['parentArg']['php.min']
        );
    }

    /**
     * Feature test for callable type hint declaration detection
     *
     * @group features
     * @return void
     */
    public function testCallableTypeHint()
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.4.0',
            $functions['callableArg']['php.min']
        );
    }

    /**
     * Feature test for scalar (bool, float, int, string) type hint declaration detection
     *
     * @group features
     * @return void
     */
    public function testScalarTypeHint()
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.0.0',
            $functions['boolArg']['php.min']
        );
        $this->assertEquals(
            '7.0.0',
            $functions['floatArg']['php.min']
        );
        $this->assertEquals(
            '7.0.0',
            $functions['intArg']['php.min']
        );
        $this->assertEquals(
            '7.0.0',
            $functions['stringArg']['php.min']
        );
    }

    /**
     * Feature test for iterable type hint declaration detection
     *
     * @group features
     * @return void
     */
    public function testIterableTypeHint()
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.1.0',
            $functions['iterableArg']['php.min']
        );
    }

    /**
     * Feature test for object type hint declaration detection
     *
     * @group features
     * @return void
     */
    public function testObjectTypeHint()
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.2.0',
            $functions['objectArg']['php.min']
        );
    }
}
