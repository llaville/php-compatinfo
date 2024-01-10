<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Use function and use const
 *
 * @author Laurent Laville
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/143
 */
final class UseConstFunctionSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'namespaces' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for "use const" syntax to import constant from namespace.
     *
     * @group features
     */
    public function testUseConstSyntax(): void
    {
        $dataSource = 'use_const.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $namespaces = $metrics[self::$analyserId]['namespaces'];

        $this->assertEquals(
            '5.3.0',
            $namespaces['Name\Space']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['Name\Space']['php.max']
        );

        $this->assertEquals(
            '5.6.0',
            $namespaces['Other\Name\Space']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['Other\Name\Space']['php.max']
        );
    }

    /**
     * Feature test for "use function" syntax to import function from namespace.
     *
     * @group features
     */
    public function testUseFunctionSyntax(): void
    {
        $dataSource = 'use_function.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $namespaces = $metrics[self::$analyserId]['namespaces'];

        $this->assertEquals(
            '5.3.0',
            $namespaces['Name\Space']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['Name\Space']['php.max']
        );

        $this->assertEquals(
            '5.6.0',
            $namespaces['Other\Name\Space']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['Other\Name\Space']['php.max']
        );
    }
}
