<?php declare(strict_types=1);

namespace Bartlett\Tests\CompatInfo\Sniffs;

/**
 * Null Coalescing Operator (??)
 *
 * @since Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/260
 */
final class NullCoalesceOperatorSniffTest extends SniffTestCase
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
     * Regression test issue #260
     *
     * @link https://github.com/llaville/php-compat-info/issues/260
     *       PHP7 null coalesce operator not detected
     * @group regression
     * @return void
     */
    public function testRegressionGH260()
    {
        $dataSource = 'gh260.php';
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
