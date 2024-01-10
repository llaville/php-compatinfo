<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

use Exception;

/**
 * Unit tests for PHP_CompatInfo package, parameter type declaration sniff
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration
 * @link https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.nullable-types
 * @link https://www.php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
 * @link https://www.php.net/manual/en/migration82.new-features.php#migration82.new-features.core.type-system
 * @link https://github.com/llaville/php-compat-info/issues/142
 * @link https://github.com/llaville/php-compat-info/issues/273
 */
final class ParamTypeDeclarationSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
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
     * @throws Exception
     */
    public function testRegressionGH142(): void
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
     * @throws Exception
     */
    public function testNullableTypeHint(): void
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
     * @throws Exception
     */
    public function testArrayTypeHint(): void
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
     * @throws Exception
     */
    public function testSelfParentTypeHint(): void
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
     * @throws Exception
     */
    public function testCallableTypeHint(): void
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
     * @throws Exception
     */
    public function testScalarTypeHint(): void
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
     * @throws Exception
     */
    public function testIterableTypeHint(): void
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
     * @throws Exception
     */
    public function testObjectTypeHint(): void
    {
        $dataSource = 'function_arguments.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.2.0',
            $functions['objectArg']['php.min']
        );
    }

    /**
     * Feature test for union types
     *
     * @group features
     * @link https://github.com/llaville/php-compatinfo/issues/333
     * @throws Exception
     */
    public function testUnionTypes(): void
    {
        $dataSource = 'union_types.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '8.0.0',
            $functions['Number\__construct']['php.min']
        );
    }

    /**
     * Feature test for intersection types
     *
     * @group features
     * @link https://github.com/llaville/php-compatinfo/issues/326
     * @throws Exception
     */
    public function testIntersectionTypes(): void
    {
        $dataSource = 'intersection_types.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '8.1.0',
            $functions['count_and_iterate']['php.min']
        );
    }

    /**
     * Feature test for Disjunctive Normal Form types
     *
     * @group features
     * @link https://github.com/llaville/php-compatinfo/issues/363
     * @throws Exception
     */
    public function testDisjunctiveNormalFormTypes(): void
    {
        $dataSource = 'dnf_types.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['methods'];

        $this->assertEquals(
            '8.2.0',
            $functions['Foo\bar']['php.min']
        );
    }
}
