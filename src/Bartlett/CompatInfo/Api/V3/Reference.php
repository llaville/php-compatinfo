<?php
/**
 * Display references summaries
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Api\V3;

use Bartlett\CompatInfo\Environment;

use Bartlett\Reflect\Api\V3\Common;

use PDO;

/**
 * Api to obtain information about one or more references (extensions)
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha2+1
 */
class Reference extends Common
{
    const LATEST_PHP_5_2 = '5.2.17';
    const LATEST_PHP_5_3 = '5.3.29';
    const LATEST_PHP_5_4 = '5.4.36';
    const LATEST_PHP_5_5 = '5.5.20';
    const LATEST_PHP_5_6 = '5.6.4';

    public function __call($name, $args)
    {
        if ('list' == $name) {
            return $this->dir();
        }
    }

    /**
     * List all references supported.
     *
     * @return array
     */
    public function dir()
    {
        $pdo = Environment::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query(
            'SELECT e.name, rel_date as "date", rel_state as "state",' .
            ' rel_version as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max"' .
            ' FROM bartlett_compatinfo_releases r,  bartlett_compatinfo_extensions e' .
            ' WHERE r.ext_name_fk = e.id' .
            ' ORDER BY e.name asc, date desc'
        );

        $rows = array();

        foreach ($stmt as $rec) {
            $key = strtolower($rec['name']);

            if (!empty($rec['date']) && !array_key_exists($key, $rows)) {
                $ref = new \stdClass;
                $ref->name    = $rec['name'];
                $ref->version = $rec['ext.min'];
                $ref->state   = $rec['state'];
                $ref->date    = $rec['date'];

                if (extension_loaded($ref->name)) {
                    $version = phpversion($ref->name);
                    $pattern = '/^[0-9]+\.[0-9]+/';
                    if (!preg_match($pattern, $version)) {
                        /**
                         * When version is not provided by the extension,
                         * or not standard format or we don't have it
                         * in our reference (ex snmp) because have no sense
                         * be sure at least to return latest PHP version supported.
                         */
                        $version = $this->getLatestPhpVersion();
                    }
                } else {
                    $version = '';
                }
                $ref->loaded   = $version;
                $ref->outdated = version_compare($ref->version, $version, 'gt') ;

                $rows[$key] = $ref;
            }
        }

        ksort($rows);
        return array_values($rows);
    }

    /**
     * Gets the latest version of PHP available, corresponding to user platform.
     *
     * @return string
     */
    public function getLatestPhpVersion()
    {
        if (version_compare(PHP_VERSION, '5.3', 'lt')) {
            return self::LATEST_PHP_5_2;
        }
        if (version_compare(PHP_VERSION, '5.4', 'lt')) {
            return self::LATEST_PHP_5_3;
        }
        if (version_compare(PHP_VERSION, '5.5', 'lt')) {
            return self::LATEST_PHP_5_4;
        }
        if (version_compare(PHP_VERSION, '5.6', 'lt')) {
            return self::LATEST_PHP_5_5;
        }
        return self::LATEST_PHP_5_6;
    }
}
