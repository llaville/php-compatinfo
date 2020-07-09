<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Array dereferencing syntax.
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/148
 */
final class ArrayDereferencingSyntaxSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'arrays' . DIRECTORY_SEPARATOR;
    }

    /**
     * Regression test for issue #148
     *
     * @link https://github.com/llaville/php-compat-info/issues/148
     *       Array short syntax and array dereferencing not detected
     * @group regression
     * @return void
     */
    public function testRegressionGH148()
    {
        $dataSource = 'gh148.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $namespaces = $metrics[self::$analyserId]['namespaces'];

        $this->assertEquals(
            '5.4.0',
            $namespaces['']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['']['php.max']
        );

        $this->assertEquals(
            '5.4.0',
            $namespaces['N']['php.min']
        );
        $this->assertEquals(
            '',
            $namespaces['N']['php.max']
        );
    }
}
