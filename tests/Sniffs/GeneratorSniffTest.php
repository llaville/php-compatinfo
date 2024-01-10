<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Generators were introduced in PHP 5.5
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/226
 */
final class GeneratorSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'generators' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for yielding Fibonacci generator
     *
     * @group features
     */
    public function testYieldingFibonacciGenerator(): void
    {
        $dataSource = 'fibonacci.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.5.0',
            $functions['fib']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['fib']['php.max']
        );
    }

    /**
     * Feature test for yielding delegate generator
     *
     * @group features
     */
    public function testGeneratorDelegation(): void
    {
        $dataSource = 'delegation.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.5.0',
            $functions['g1']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['g1']['php.max']
        );

        $this->assertEquals(
            '7.0.0',
            $functions['g2']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['g2']['php.max']
        );
    }

    /**
     * Feature test for generator that return expressions
     *
     * @group features
     * @group not_implemented
     */
    public function testGeneratorReturnExpressions(): void
    {
        $dataSource = 'return_expression.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '7.0.0',
            $functions['closure-3-8']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['closure-3-8']['php.max']
        );
    }

    /**
     * Regression test for issue #226
     *
     * @link https://github.com/llaville/php-compat-info/issues/226
     *       Does not detect Generators
     * @group regression
     */
    public function testRegressionGH226(): void
    {
        $dataSource = 'gh226.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $functions  = $metrics[self::$analyserId]['functions'];

        $this->assertEquals(
            '5.5.0',
            $functions['x']['php.min']
        );

        $this->assertEquals(
            '',
            $functions['x']['php.max']
        );
    }
}
