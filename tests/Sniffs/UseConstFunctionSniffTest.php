<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Use function and use const
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/143
 */
final class UseConstFunctionSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
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
     * @return void
     */
    public function testUseConstSyntax()
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
     * @return void
     */
    public function testUseFunctionSyntax()
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
