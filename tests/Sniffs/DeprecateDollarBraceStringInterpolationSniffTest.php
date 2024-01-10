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
 * Deprecate Dollar Brace String Interpolation since PHP 8.2.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://wiki.php.net/rfc/deprecate_dollar_brace_string_interpolation
 */
final class DeprecateDollarBraceStringInterpolationSniffTest extends SniffTestCase
{
    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'strings' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for ${} interpolation deprecation
     *
     * @link https://github.com/llaville/php-compatinfo/issues/363
     * @group feature
     * @throws Exception
     */
    public function testDeprecation(): void
    {
        $dataSource = 'dollar_brace_string_interpolation.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.2.0alpha1',
            $versions['php.min']
        );
    }
}
