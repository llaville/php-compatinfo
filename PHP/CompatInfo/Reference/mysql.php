<?php
/**
 * Version informations about mysql extension
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
 * All interfaces, classes, functions, constants about mysql extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mysql.php
 */
class PHP_CompatInfo_Reference_Mysql implements PHP_CompatInfo_Reference
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
            'mysql' => array('4.0.0', '', '1.0')
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
     * @link   http://www.php.net/manual/en/ref.mysql.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'mysql'                          => array('4.0.0', ''),
                'mysql_affected_rows'            => array('4.0.0', ''),
                'mysql_client_encoding'          => array('4.3.0', ''),
                'mysql_close'                    => array('4.0.0', ''),
                'mysql_connect'                  => array('4.0.0', ''),
                'mysql_create_db'                => array('4.0.0', ''),
                'mysql_data_seek'                => array('4.0.0', ''),
                'mysql_db_name'                  => array('4.0.0', ''),
                'mysql_db_query'                 => array('4.0.0', ''),
                'mysql_drop_db'                  => array('4.0.0', ''),
                'mysql_dbname'                   => array('4.0.0', ''),
                'mysql_errno'                    => array('4.0.0', ''),
                'mysql_error'                    => array('4.0.0', ''),
                'mysql_escape_string'            => array('4.0.3', ''),
                'mysql_fetch_array'              => array('4.0.0', ''),
                'mysql_fetch_assoc'              => array('4.0.3', ''),
                'mysql_fetch_field'              => array('4.0.0', ''),
                'mysql_fetch_lengths'            => array('4.0.0', ''),
                'mysql_fetch_object'             => array('4.0.0', ''),
                'mysql_fetch_row'                => array('4.0.0', ''),
                'mysql_field_flags'              => array('4.0.0', ''),
                'mysql_field_len'                => array('4.0.0', ''),
                'mysql_field_name'               => array('4.0.0', ''),
                'mysql_field_seek'               => array('4.0.0', ''),
                'mysql_field_table'              => array('4.0.0', ''),
                'mysql_field_type'               => array('4.0.0', ''),
                'mysql_fieldflags'               => array('4.0.0', ''),
                'mysql_fieldlen'                 => array('4.0.0', ''),
                'mysql_fieldname'                => array('4.0.0', ''),
                'mysql_fieldtable'               => array('4.0.0', ''),
                'mysql_fieldtype'                => array('4.0.0', ''),
                'mysql_free_result'              => array('4.0.0', ''),
                'mysql_get_client_info'          => array('4.0.5', ''),
                'mysql_get_host_info'            => array('4.0.5', ''),
                'mysql_get_proto_info'           => array('4.0.5', ''),
                'mysql_get_server_info'          => array('4.0.5', ''),
                'mysql_info'                     => array('4.3.0', ''),
                'mysql_insert_id'                => array('4.0.0', ''),
                'mysql_list_dbs'                 => array('4.0.0', ''),
                'mysql_list_fields'              => array('4.0.0', ''),
                'mysql_list_processes'           => array('4.3.0', ''),
                'mysql_list_tables'              => array('4.0.0', ''),
                'mysql_listfields'               => array('4.0.0', ''),
                'mysql_listtables'               => array('4.0.0', ''),
                'mysql_num_fields'               => array('4.0.0', ''),
                'mysql_num_rows'                 => array('4.0.0', ''),
                'mysql_numfields'                => array('4.0.0', ''),
                'mysql_numrows'                  => array('4.0.0', ''),
                'mysql_pconnect'                 => array('4.0.0', ''),
                'mysql_ping'                     => array('4.3.0', ''),
                'mysql_query'                    => array('4.0.0', ''),
                'mysql_real_escape_string'       => array('4.3.0', ''),
                'mysql_result'                   => array('4.0.0', ''),
                'mysql_select_db'                => array('4.0.0', ''),
                'mysql_stat'                     => array('4.3.0', ''),
                'mysql_table_name'               => array('4.0.0', ''),
                'mysql_thread_id'                => array('4.3.0', ''),
                'mysql_unbuffered_query'         => array('4.0.6', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'mysql_set_charset'              => array('5.2.3', ''),
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
     * @link   http://www.php.net/manual/en/mysql.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'MYSQL_ASSOC'                    => array('4.0.0', ''),
                'MYSQL_NUM'                      => array('4.0.0', ''),
                'MYSQL_BOTH'                     => array('4.0.0', ''),
                'MYSQL_CLIENT_COMPRESS'          => array('4.3.0', ''),
                'MYSQL_CLIENT_SSL'               => array('4.3.0', ''),
                'MYSQL_CLIENT_INTERACTIVE'       => array('4.3.0', ''),
                'MYSQL_CLIENT_IGNORE_SPACE'      => array('4.3.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
