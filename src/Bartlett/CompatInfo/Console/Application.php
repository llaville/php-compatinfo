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

use Bartlett\CompatInfo\Environment;

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
     * Gets the application version (long format).
     *
     * @return string The application version
     */
    public function getLongVersion()
    {
        $v = Environment::versionRefDb();

        $version = sprintf(
            '<info>%s</info> version <comment>%s</comment> DB built <comment>%s</comment>',
            $this->getName(),
            $this->getVersion(),
            $v['build.string']
        );
        return $version;
    }
}
