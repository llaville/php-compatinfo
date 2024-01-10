<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Tests\Sniffs;

use Exception;

/**
 * Nullsafe operator syntax (available since PHP 8.0.0 beta1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/nullsafe_operator
 * @link https://php.watch/versions/8.0/null-safe-operator
 */
final class NullsafeOperatorSniffTest extends SniffTestCase
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
     * Feature test to detect Nullsafe operator syntax
     *
     * @link https://github.com/llaville/php-compatinfo/issues/338
     * @group features
     * @throws Exception
     */
    public function testNullsafeOperator(): void
    {
        $dataSource = 'nullsafe_syntax.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.0.0beta1',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
