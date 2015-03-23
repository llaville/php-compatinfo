<?php
/**
 * Helper class to format version string.
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

namespace Bartlett\CompatInfo\Util;

/**
 * Helper class to format version string.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha3+1
 */
class Version
{
    public static function ext($versions)
    {
        return empty($versions['ext.max'])
            ? $versions['ext.min']
            : $versions['ext.min'] . ' => ' . $versions['ext.max'];
    }

    public static function php($versions)
    {
        return empty($versions['php.max'])
            ? $versions['php.min']
            : $versions['php.min'] . ' => ' . $versions['php.max'];
    }

    public static function all($versions)
    {
        if (!empty($versions['php.all'])) {
            if (version_compare($versions['php.all'], $versions['php.min'], '>')) {
                return $versions['php.all'];
            }
        }
        return '';
    }
}
