<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Short ternary operator (Elvis syntax)
 *
 * @since Class available since Release 5.4.0
 */
final class ShortTernaryOperatorSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'operators' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for short ternary operator (Elvis syntax)
     *
     * @group features
     * @return void
     */
    public function testElvisSyntax()
    {
        $dataSource = 'elvis_syntax.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '5.3.0',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
