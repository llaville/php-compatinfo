<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

/**
 * Null Coalescing Operator (??)
 *
 * @author Laurent Laville
 * @since  Class available since Release 5.4.0
 *
 * @link https://github.com/llaville/php-compat-info/issues/260
 */
final class NullCoalesceOperatorSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
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
     */
    public function testRegressionGH260(): void
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
