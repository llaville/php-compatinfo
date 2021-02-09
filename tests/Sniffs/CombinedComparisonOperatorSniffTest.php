<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Combined Comparison (Spaceship) Operator since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/combined-comparison-operator
 *
 * @since Class available since Release 5.4.0
 */
final class CombinedComparisonOperatorSniffTest extends SniffTestCase
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
     * Feature test for Combined Comparison (Spaceship) Operator
     *
     * @group features
     * @return void
     */
    public function testSpaceshipSyntax()
    {
        $dataSource = 'spaceship_syntax.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '7.0.0alpha1',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
