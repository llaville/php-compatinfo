<?php
/**
 * The CompatInfo CLI version.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Console;

use Bartlett\CompatInfoDb\Environment;

use Bartlett\Reflect\Console\Application as BaseApplication;

/**
 * Console Application.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha3+1
 */
class Application extends BaseApplication
{
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
    /**
     * Gets the application version (long format).
     *
     * @return string The application version
     */
    public function getLongVersion()
    {
        $v = Environment::versionRefDb();

        return sprintf(
            '<info>%s</info> version <comment>%s</comment> DB built <comment>%s</comment>',
            $this->getName(),
            $this->getVersion(),
            $v['build.string']
        );
    }
}
