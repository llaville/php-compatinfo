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
 * First class callable syntax (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/functions.first_class_callable_syntax.php
 * @link https://wiki.php.net/rfc/first_class_callable_syntax
 * @link https://php.watch/versions/8.1/first-class-callable-syntax
 * @see tests/Sniffs/FirstClassCallableSniffTest.php
 */
final class FirstClassCallableSniffTest extends SniffTestCase
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
     * Data Provider to test First class callable syntax
     *
     * @return iterable
     */
    public function callableExprProvider(): iterable
    {
        $provides = [
            'callable_expr_function.php' => [
                'php.min' => '8.1.0beta1',
            ],
            'callable_expr_method.php' => [
                'php.min' => '8.1.0beta1',
            ],
            'callable_expr_static.php' => [
                'php.min' => '8.1.0beta1',
            ],
        ];

        foreach ($provides as $filename => $versions) {
            yield [$filename, $versions];
        }
    }

    /**
     * Feature test for First class callable syntax
     *
     * @link https://github.com/llaville/php-compatinfo/issues/324
     *       First class callable syntax is detected as PHP 8.1
     * @group group
     * @dataProvider callableExprProvider
     * @return void
     * @throws Exception
     */
    public function testCallableExpr(string $dataSource, array $expectedVersions)
    {
        $metrics  = $this->executeAnalysis($dataSource);
        $versions = $metrics[self::$analyserId]['versions'];

        foreach ($expectedVersions as $key => $value) {
            $this->assertEquals($value, $versions[$key]);
        }
    }
}
