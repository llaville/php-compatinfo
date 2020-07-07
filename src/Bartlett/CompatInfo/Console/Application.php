<?php declare(strict_types=1);

/**
 * The CompatInfo CLI version.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Console;

use Bartlett\CompatInfo\Util\Database;
use Bartlett\Reflect\Console\Application as BaseApplication;

use Jean85\PrettyVersions;

use OutOfBoundsException;

/**
 * Console Application.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 4.0.0-alpha3+1
 */
class Application extends BaseApplication
{
    public const NAME = 'phpCompatInfo';
    public const VERSION = '5.3.x-dev';

    /**
     * @link http://patorjk.com/software/taag/#p=display&f=Standard&t=phpCompatInfo
     */
    protected static $logo = "        _            ____                            _   ___        __
  _ __ | |__  _ __  / ___|___  _ __ ___  _ __   __ _| |_|_ _|_ __  / _| ___
 | '_ \| '_ \| '_ \| |   / _ \| '_ ` _ \| '_ \ / _` | __|| || '_ \| |_ / _ \
 | |_) | | | | |_) | |__| (_) | | | | | | |_) | (_| | |_ | || | | |  _| (_) |
 | .__/|_| |_| .__/ \____\___/|_| |_| |_| .__/ \__,_|\__|___|_| |_|_|  \___/
 |_|         |_|                        |_|

";

    public function __construct()
    {
        try {
            $version = PrettyVersions::getVersion('bartlett/php-compatinfo')->getPrettyVersion();
        } catch (OutOfBoundsException $e) {
            $version = self::VERSION;
        }
        parent::__construct(self::NAME, $version);
    }

    /**
     * Gets the application version (long format).
     *
     * @return string The application version
     */
    public function getLongVersion(): string
    {
        $v = Database::versionRefDb();

        return sprintf(
            '<info>%s</info> version <comment>%s</comment> DB version <comment>%s</comment> built <comment>%s</comment>',
            $this->getName(),
            $this->getVersion(),
            $v['build.version'],
            $v['build.string']
        );
    }
}
