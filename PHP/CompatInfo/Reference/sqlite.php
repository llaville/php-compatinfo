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

require_once 'PHP/CompatInfo/Reference.php';

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
class PHP_CompatInfo_Reference_SQLite implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'SQLite' => array('5.0.0', '', '2.0-dev')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.sqlite.php
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'SQLiteDatabase'                 => array('5.0.0', ''),
                'SQLiteResult'                   => array('5.0.0', ''),
                'SQLiteUnbuffered'               => array('5.0.0', ''),
                'SQLiteException'                => array('5.0.0', ''),
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.sqlite.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
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
                'sqlite_fetch_column_types'      => array('5.0.0', ''),
                'sqlite_fetch_object'            => array('5.0.0', ''),
                'sqlite_fetch_single'            => array('5.0.0', ''),
                'sqlite_fetch_string'            => array('5.0.0', ''),
                'sqlite_field_name'              => array('5.0.0', ''),
                'sqlite_has_more'                => array('5.0.0', ''),
                'sqlite_has_prev'                => array('5.0.0', ''),
                'sqlite_key'                     => array('5.1.0', ''),
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
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/sqlite.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
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
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
