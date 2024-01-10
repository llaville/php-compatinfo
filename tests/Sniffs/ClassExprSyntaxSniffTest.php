<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Class::{expr}() syntax
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 */
final class ClassExprSyntaxSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
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
     */
    public function testClassExprSyntax(): void
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
