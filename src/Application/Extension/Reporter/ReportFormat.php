<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Reporter;

use Composer\InstalledVersions;

use function array_column;
use function array_search;

/**
 * @author Laurent Laville
 * @since Release 7.3.0
 */
enum ReportFormat: string
{
    case console = 'console';
    case dump = 'dump';
    case json = 'json';
    case rule = 'rule';
    // optional
    case sarif = 'sarif';

    /**
     * Domain of valid values.
     *
     * @link https://www.php.net/manual/en/language.enumerations.static-methods.php#126866
     * @return string[]
     */
    public static function values(): array
    {
        $values = array_column(self::cases(), 'value');

        // @see https://getcomposer.org/doc/07-runtime.md#installed-versions
        if (!InstalledVersions::isInstalled('bartlett/sarif-php-sdk')) {
            $key = array_search(self::sarif->value, $values, true);
            unset($values[$key]);
        }

        return $values;
    }
}
