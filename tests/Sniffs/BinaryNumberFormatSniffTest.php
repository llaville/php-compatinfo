<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Binary Number Format (with 0b prefix)
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 */
final class BinaryNumberFormatSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'numbers' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test to detect Binary Number Format syntax
     *
     * @group features
     */
    public function testBinaryNumberFormatSyntax(): void
    {
        $dataSource = 'binary_number_format.php';
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
