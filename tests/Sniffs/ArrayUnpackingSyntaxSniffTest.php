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
 * Array unpacking support :
 * - for numeric-keyed arrays (since PHP 7.4)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/spread_operator_for_array
 * @link https://www.php.net/manual/en/language.types.array.php#language.types.array.unpacking
 */
final class ArrayUnpackingSyntaxSniffTest extends SniffTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$fixtures .= 'arrays' . DIRECTORY_SEPARATOR;
    }

    /**
     * Feature test for Array unpacking support for numeric-keyed arrays
     *
     * @link https://wiki.php.net/rfc/spread_operator_for_array
     * @group feature
     * @return void
     * @throws Exception
     */
    public function testArrayUnpackingSupportForNumericKeyed()
    {
        $dataSource = 'unpacking_support_array_numeric_keyed.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '7.4.0',
            $versions['php.min']
        );

        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
