<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Binary Number Format (with 0b prefix)
 *
 * @since Class available since Release 5.4.0
 */
final class BinaryNumberFormatSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
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
     * @return void
     */
    public function testBinaryNumberFormatSyntax()
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
