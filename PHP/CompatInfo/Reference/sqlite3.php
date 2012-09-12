<?php
/**
 * Version informations about sqlite3 extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about sqlite3 extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.sqlite3.php
 */
class PHP_CompatInfo_Reference_Sqlite3
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'sqlite3';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.7';

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        $phpMin = '5.3.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );

        return $extensions;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = false;
        $items = array(
            'SQLite3'               => array('5.3.0', ''),
            'SQLite3Result'         => array('5.3.0', ''),
            'SQLite3Stmt'           => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/sqlite3.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'SQLITE3_ASSOC'             => array('5.3.0', ''),
            'SQLITE3_BLOB'              => array('5.3.0', ''),
            'SQLITE3_BOTH'              => array('5.3.0', ''),
            'SQLITE3_FLOAT'             => array('5.3.0', ''),
            'SQLITE3_INTEGER'           => array('5.3.0', ''),
            'SQLITE3_NULL'              => array('5.3.0', ''),
            'SQLITE3_NUM'               => array('5.3.0', ''),
            'SQLITE3_OPEN_CREATE'       => array('5.3.0', ''),
            'SQLITE3_OPEN_READONLY'     => array('5.3.0', ''),
            'SQLITE3_OPEN_READWRITE'    => array('5.3.0', ''),
            'SQLITE3_TEXT'              => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
