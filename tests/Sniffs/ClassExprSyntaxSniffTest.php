<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Class::{expr}() syntax
 *
 * @since Class available since Release 5.4.0
 */
final class ClassExprSyntaxSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'expressions' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test to detect Class::{expr}() syntax
     *
     * @group features
     * @return void
     */
    public function testClassExprSyntax()
    {
        $dataSource = 'class_expr.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.4.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
