<?php
/**
 * Version informations about SQLite extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about SQLite extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.sqlite.php
 */
class PHP_CompatInfo_Reference_SQLite
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'SQLite';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '2.0-dev';

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
        $phpMin = '5.0.0';
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
     * @link   http://www.php.net/manual/en/ref.sqlite.php
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = false;
        $items = array(
            'SQLiteDatabase'                 => array('5.0.0', ''),
            'SQLiteException'                => array('5.0.0', ''),
            'SQLiteResult'                   => array('5.0.0', ''),
            'SQLiteUnbuffered'               => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.sqlite.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'sqlite_array_query'             => array('5.0.0', ''),
            'sqlite_busy_timeout'            => array('5.0.0', ''),
            'sqlite_changes'                 => array('5.0.0', ''),
            'sqlite_close'                   => array('5.0.0', ''),
            'sqlite_column'                  => array('5.0.0', ''),
            'sqlite_create_aggregate'        => array('5.0.0', ''),
            'sqlite_create_function'         => array('5.0.0', ''),
            'sqlite_current'                 => array('5.0.0', ''),
            'sqlite_error_string'            => array('5.0.0', ''),
            'sqlite_escape_string'           => array('5.0.0', ''),
            'sqlite_exec'                    => array('5.0.0', ''),
            'sqlite_factory'                 => array('5.0.0', ''),
            'sqlite_fetch_all'               => array('5.0.0', ''),
            'sqlite_fetch_array'             => array('5.0.0', ''),
            'sqlite_fetch_column_types'      => array('5.0.0', '', '5.0.0, 5.0.0, 5.1.0'),
            'sqlite_fetch_object'            => array('5.0.0', ''),
            'sqlite_fetch_single'            => array('5.0.0', ''),
            'sqlite_fetch_string'            => array('5.0.0', ''),
            'sqlite_field_name'              => array('5.0.0', ''),
            'sqlite_has_more'                => array('5.0.0', ''),
            'sqlite_has_prev'                => array('5.0.0', ''),
            // http://bugs.php.net/31510
            //'sqlite_key'                   => array('5.1.0', ''),
            'sqlite_last_error'              => array('5.0.0', ''),
            'sqlite_last_insert_rowid'       => array('5.0.0', ''),
            'sqlite_libencoding'             => array('5.0.0', ''),
            'sqlite_libversion'              => array('5.0.0', ''),
            'sqlite_next'                    => array('5.0.0', ''),
            'sqlite_num_fields'              => array('5.0.0', ''),
            'sqlite_num_rows'                => array('5.0.0', ''),
            'sqlite_open'                    => array('5.0.0', ''),
            'sqlite_popen'                   => array('5.0.0', ''),
            'sqlite_prev'                    => array('5.0.0', ''),
            'sqlite_query'                   => array('5.0.0', ''),
            'sqlite_rewind'                  => array('5.0.0', ''),
            'sqlite_seek'                    => array('5.0.0', ''),
            'sqlite_single_query'            => array('5.0.0', ''),
            'sqlite_udf_decode_binary'       => array('5.0.0', ''),
            'sqlite_udf_encode_binary'       => array('5.0.0', ''),
            'sqlite_unbuffered_query'        => array('5.0.0', ''),
            'sqlite_valid'                   => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
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
     * @link   http://www.php.net/manual/en/sqlite.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'SQLITE_ABORT'                   => array('5.0.0', ''),
            'SQLITE_ASSOC'                   => array('5.0.0', ''),
            'SQLITE_AUTH'                    => array('5.0.0', ''),
            'SQLITE_BOTH'                    => array('5.0.0', ''),
            'SQLITE_BUSY'                    => array('5.0.0', ''),
            'SQLITE_CANTOPEN'                => array('5.0.0', ''),
            'SQLITE_CONSTRAINT'              => array('5.0.0', ''),
            'SQLITE_CORRUPT'                 => array('5.0.0', ''),
            'SQLITE_DONE'                    => array('5.0.0', ''),
            'SQLITE_EMPTY'                   => array('5.0.0', ''),
            'SQLITE_ERROR'                   => array('5.0.0', ''),
            'SQLITE_FORMAT'                  => array('5.0.0', ''),
            'SQLITE_FULL'                    => array('5.0.0', ''),
            'SQLITE_INTERNAL'                => array('5.0.0', ''),
            'SQLITE_INTERRUPT'               => array('5.0.0', ''),
            'SQLITE_IOERR'                   => array('5.0.0', ''),
            'SQLITE_LOCKED'                  => array('5.0.0', ''),
            'SQLITE_MISMATCH'                => array('5.0.0', ''),
            'SQLITE_MISUSE'                  => array('5.0.0', ''),
            'SQLITE_NOLFS'                   => array('5.0.0', ''),
            'SQLITE_NOMEM'                   => array('5.0.0', ''),
            'SQLITE_NOTADB'                  => array('5.0.0', ''),
            'SQLITE_NOTFOUND'                => array('5.0.0', ''),
            'SQLITE_NUM'                     => array('5.0.0', ''),
            'SQLITE_OK'                      => array('5.0.0', ''),
            'SQLITE_PERM'                    => array('5.0.0', ''),
            'SQLITE_PROTOCOL'                => array('5.0.0', ''),
            'SQLITE_READONLY'                => array('5.0.0', ''),
            'SQLITE_ROW'                     => array('5.0.0', ''),
            'SQLITE_SCHEMA'                  => array('5.0.0', ''),
            'SQLITE_TOOBIG'                  => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
