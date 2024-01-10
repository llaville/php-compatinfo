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
 * Octal Number Format (with 0o prefix) since PHP 8.1
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/releases/8.1/en.php#explicit_octal_numeral_notation
 * @link https://wiki.php.net/rfc/explicit_octal_notation
 * @link https://php.watch/versions/8.1/explicit-octal-notation
 */
final class OctalNumberFormatSniffTest extends SniffTestCase
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
     * Feature test to detect Explicit Octal numeral notation
     *
     * @group features
     * @throws Exception
     */
    public function testExplicitOctalNotation(): void
    {
        $dataSource = 'explicit_octal_number_format.php';
        $metrics    = $this->executeAnalysis($dataSource);
        $versions   = $metrics[self::$analyserId]['versions'];

        $this->assertEquals(
            '8.1.0alpha1',
            $versions['php.min']
        );
        $this->assertEquals(
            '',
            $versions['php.max']
        );
    }
}
