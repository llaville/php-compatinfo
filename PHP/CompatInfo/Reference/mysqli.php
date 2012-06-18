<?php
/**
 * Version informations about mysqli extension
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
 * All interfaces, classes, functions, constants about mysqli extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mysqli.php
 */
class PHP_CompatInfo_Reference_Mysqli implements PHP_CompatInfo_Reference
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
            'mysqli' => array('5.0.0', '', '0.1')
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
     * @link   http://www.php.net/manual/en/class.mysqli.php
     * @link   http://www.php.net/manual/en/class.mysqli-stmt.php
     * @link   http://www.php.net/manual/en/class.mysqli-result.php
     * @link   http://www.php.net/manual/en/class.mysqli-driver.php
     * @link   http://www.php.net/manual/en/class.mysqli-warning.php
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
                'mysqli_sql_exception'           => array('5.0.0', ''),
                'mysqli_driver'                  => array('5.0.0', ''),
                'mysqli'                         => array('5.0.0', ''),
                'mysqli_warning'                 => array('5.0.0', ''),
                'mysqli_result'                  => array('5.0.0', ''),
                'mysqli_stmt'                    => array('5.0.0', ''),
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
                'mysqli_affected_rows'           => array('5.0.0', ''),
                'mysqli_autocommit'              => array('5.0.0', ''),
                'mysqli_bind_param'              => array('5.0.0', '5.3.14'),
                'mysqli_bind_result'             => array('5.0.0', '5.3.14'),
                'mysqli_change_user'             => array('5.0.0', ''),
                'mysqli_character_set_name'      => array('5.0.0', ''),
                'mysqli_client_encoding'         => array('5.0.0', '5.3.14'),
                'mysqli_close'                   => array('5.0.0', ''),
                'mysqli_commit'                  => array('5.0.0', ''),
                'mysqli_connect'                 => array('5.0.0', ''),
                'mysqli_connect_errno'           => array('5.0.0', ''),
                'mysqli_connect_error'           => array('5.0.0', ''),
                'mysqli_data_seek'               => array('5.0.0', ''),
                'mysqli_debug'                   => array('5.0.0', ''),
                'mysqli_disable_reads_from_master'
                                                 => array('5.0.0', '5.2.17'),
                'mysqli_disable_rpl_parse'       => array('5.0.0', '5.2.17'),
                'mysqli_dump_debug_info'         => array('5.0.0', ''),
                'mysqli_embedded_server_end'     => array('5.0.0', ''),
                'mysqli_embedded_server_start'   => array('5.0.0', ''),
                'mysqli_enable_reads_from_master'=> array('5.0.0', '5.2.17'),
                'mysqli_enable_rpl_parse'        => array('5.0.0', '5.2.17'),
                'mysqli_errno'                   => array('5.0.0', ''),
                'mysqli_error'                   => array('5.0.0', ''),
                'mysqli_error_list'              => array('5.4.0', ''),
                'mysqli_escape_string'           => array('5.0.0', ''),
                'mysqli_execute'                 => array('5.0.0', ''),
                'mysqli_fetch'                   => array('5.0.0', '5.3.14'),
                'mysqli_fetch_all'               => array('5.0.0', ''),
                'mysqli_fetch_array'             => array('5.0.0', ''),
                'mysqli_fetch_assoc'             => array('5.0.0', ''),
                'mysqli_fetch_field'             => array('5.0.0', ''),
                'mysqli_fetch_field_direct'      => array('5.0.0', ''),
                'mysqli_fetch_fields'            => array('5.0.0', ''),
                'mysqli_fetch_lengths'           => array('5.0.0', ''),
                'mysqli_fetch_object'            => array('5.0.0', ''),
                'mysqli_fetch_row'               => array('5.0.0', ''),
                'mysqli_field_count'             => array('5.0.0', ''),
                'mysqli_field_seek'              => array('5.0.0', ''),
                'mysqli_field_tell'              => array('5.0.0', ''),
                'mysqli_free_result'             => array('5.0.0', ''),
                'mysqli_get_cache_stats'         => array('5.0.0', ''),
                'mysqli_get_charset'             => array('5.0.0', ''),
                'mysqli_get_client_info'         => array('5.0.0', ''),
                'mysqli_get_client_stats'        => array('5.0.0', ''),
                'mysqli_get_client_version'      => array('5.0.0', ''),
                'mysqli_get_connection_stats'    => array('5.0.0', ''),
                'mysqli_get_host_info'           => array('5.0.0', ''),
                'mysqli_get_metadata'            => array('5.0.0', '5.3.14'),
                'mysqli_get_proto_info'          => array('5.0.0', ''),
                'mysqli_get_server_info'         => array('5.0.0', ''),
                'mysqli_get_server_version'      => array('5.0.0', ''),
                'mysqli_get_warnings'            => array('5.0.0', ''),
                'mysqli_info'                    => array('5.0.0', ''),
                'mysqli_init'                    => array('5.0.0', ''),
                'mysqli_insert_id'               => array('5.0.0', ''),
                'mysqli_kill'                    => array('5.0.0', ''),
                'mysqli_master_query'            => array('5.0.0', '5.2.17'),
                'mysqli_more_results'            => array('5.0.0', ''),
                'mysqli_multi_query'             => array('5.0.0', ''),
                'mysqli_next_result'             => array('5.0.0', ''),
                'mysqli_num_fields'              => array('5.0.0', ''),
                'mysqli_num_rows'                => array('5.0.0', ''),
                'mysqli_options'                 => array('5.0.0', ''),
                'mysqli_param_count'             => array('5.0.0', '5.3.14'),
                'mysqli_ping'                    => array('5.0.0', ''),
                'mysqli_poll'                    => array('5.0.0', ''),
                'mysqli_prepare'                 => array('5.0.0', ''),
                'mysqli_query'                   => array('5.0.0', ''),
                'mysqli_real_connect'            => array('5.0.0', ''),
                'mysqli_real_escape_string'      => array('5.0.0', ''),
                'mysqli_real_query'              => array('5.0.0', ''),
                'mysqli_reap_async_query'        => array('5.0.0', ''),
                'mysqli_refresh'                 => array('5.3.0', ''),
                'mysqli_report'                  => array('5.0.0', ''),
                'mysqli_rollback'                => array('5.0.0', ''),
                'mysqli_rpl_parse_enabled'       => array('5.0.0', '5.2.17'),
                'mysqli_rpl_probe'               => array('5.0.0', '5.2.17'),
                'mysqli_rpl_query_type'          => array('5.0.0', '5.2.17'),
                'mysqli_select_db'               => array('5.0.0', ''),
                'mysqli_send_long_data'          => array('5.0.0', '5.3.14'),
                'mysqli_send_query'              => array('5.0.0', '5.2.17'),
                'mysqli_set_charset'             => array('5.0.0', ''),
                'mysqli_set_local_infile_default'=> array('5.0.0', ''),
                'mysqli_set_local_infile_handler'=> array('5.0.0', ''),
                'mysqli_set_opt'                 => array('5.0.0', ''),
                'mysqli_slave_query'             => array('5.0.0', '5.2.17'),
                'mysqli_sqlstate'                => array('5.0.0', ''),
                'mysqli_ssl_set'                 => array('5.0.0', ''),
                'mysqli_stat'                    => array('5.0.0', ''),
                'mysqli_stmt_affected_rows'      => array('5.0.0', ''),
                'mysqli_stmt_attr_get'           => array('5.0.0', ''),
                'mysqli_stmt_attr_set'           => array('5.0.0', ''),
                'mysqli_stmt_bind_param'         => array('5.0.0', ''),
                'mysqli_stmt_bind_result'        => array('5.0.0', ''),
                'mysqli_stmt_close'              => array('5.0.0', ''),
                'mysqli_stmt_data_seek'          => array('5.0.0', ''),
                'mysqli_stmt_errno'              => array('5.0.0', ''),
                'mysqli_stmt_error'              => array('5.0.0', ''),
                'mysqli_stmt_error_list'         => array('5.4.0', ''),
                'mysqli_stmt_execute'            => array('5.0.0', ''),
                'mysqli_stmt_fetch'              => array('5.0.0', ''),
                'mysqli_stmt_field_count'        => array('5.0.0', ''),
                'mysqli_stmt_free_result'        => array('5.0.0', ''),
                'mysqli_stmt_get_result'         => array('5.0.0', ''),
                'mysqli_stmt_get_warnings'       => array('5.0.0', ''),
                'mysqli_stmt_init'               => array('5.0.0', ''),
                'mysqli_stmt_insert_id'          => array('5.0.0', ''),
                'mysqli_stmt_more_results'       => array('5.0.0', ''),
                'mysqli_stmt_next_result'        => array('5.0.0', ''),
                'mysqli_stmt_num_rows'           => array('5.0.0', ''),
                'mysqli_stmt_param_count'        => array('5.0.0', ''),
                'mysqli_stmt_prepare'            => array('5.0.0', ''),
                'mysqli_stmt_reset'              => array('5.0.0', ''),
                'mysqli_stmt_result_metadata'    => array('5.0.0', ''),
                'mysqli_stmt_send_long_data'     => array('5.0.0', ''),
                'mysqli_stmt_sqlstate'           => array('5.0.0', ''),
                'mysqli_stmt_store_result'       => array('5.0.0', ''),
                'mysqli_store_result'            => array('5.0.0', ''),
                'mysqli_thread_id'               => array('5.0.0', ''),
                'mysqli_thread_safe'             => array('5.0.0', ''),
                'mysqli_use_result'              => array('5.0.0', ''),
                'mysqli_warning_count'           => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/mysqli.constants.php
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
                'MYSQLI_READ_DEFAULT_GROUP'      => array('5.0.0', ''),
                'MYSQLI_READ_DEFAULT_FILE'       => array('5.0.0', ''),
                'MYSQLI_OPT_CONNECT_TIMEOUT'     => array('5.0.0', ''),
                'MYSQLI_OPT_LOCAL_INFILE'        => array('5.0.0', ''),
                'MYSQLI_INIT_COMMAND'            => array('5.0.0', ''),
                'MYSQLI_OPT_NET_CMD_BUFFER_SIZE' => array('5.3.0', ''),
                'MYSQLI_OPT_NET_READ_BUFFER_SIZE'
                                                 => array('5.3.0', ''),
                'MYSQLI_OPT_INT_AND_FLOAT_NATIVE'
                                                 => array('5.3.0', ''),
                'MYSQLI_CLIENT_SSL'              => array('5.0.0', ''),
                'MYSQLI_CLIENT_COMPRESS'         => array('5.0.0', ''),
                'MYSQLI_CLIENT_INTERACTIVE'      => array('5.0.0', ''),
                'MYSQLI_CLIENT_IGNORE_SPACE'     => array('5.0.0', ''),
                'MYSQLI_CLIENT_NO_SCHEMA'        => array('5.0.0', ''),
                'MYSQLI_CLIENT_FOUND_ROWS'       => array('5.0.0', ''),
                'MYSQLI_STORE_RESULT'            => array('5.0.0', ''),
                'MYSQLI_USE_RESULT'              => array('5.0.0', ''),
                'MYSQLI_ASYNC'                   => array('5.3.0', ''),
                'MYSQLI_ASSOC'                   => array('5.0.0', ''),
                'MYSQLI_NUM'                     => array('5.0.0', ''),
                'MYSQLI_BOTH'                    => array('5.0.0', ''),
                'MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH'
                                                 => array('5.0.0', ''),
                'MYSQLI_STMT_ATTR_CURSOR_TYPE'   => array('5.0.0', ''),
                'MYSQLI_CURSOR_TYPE_NO_CURSOR'   => array('5.0.0', ''),
                'MYSQLI_CURSOR_TYPE_READ_ONLY'   => array('5.0.0', ''),
                'MYSQLI_CURSOR_TYPE_FOR_UPDATE'  => array('5.0.0', ''),
                'MYSQLI_CURSOR_TYPE_SCROLLABLE'  => array('5.0.0', ''),
                'MYSQLI_STMT_ATTR_PREFETCH_ROWS' => array('5.0.0', ''),
                'MYSQLI_NOT_NULL_FLAG'           => array('5.0.0', ''),
                'MYSQLI_PRI_KEY_FLAG'            => array('5.0.0', ''),
                'MYSQLI_UNIQUE_KEY_FLAG'         => array('5.0.0', ''),
                'MYSQLI_MULTIPLE_KEY_FLAG'       => array('5.0.0', ''),
                'MYSQLI_BLOB_FLAG'               => array('5.0.0', ''),
                'MYSQLI_UNSIGNED_FLAG'           => array('5.0.0', ''),
                'MYSQLI_ZEROFILL_FLAG'           => array('5.0.0', ''),
                'MYSQLI_AUTO_INCREMENT_FLAG'     => array('5.0.0', ''),
                'MYSQLI_TIMESTAMP_FLAG'          => array('5.0.0', ''),
                'MYSQLI_SET_FLAG'                => array('5.0.0', ''),
                'MYSQLI_NUM_FLAG'                => array('5.0.0', ''),
                'MYSQLI_PART_KEY_FLAG'           => array('5.0.0', ''),
                'MYSQLI_GROUP_FLAG'              => array('5.0.0', ''),
                'MYSQLI_BINARY_FLAG'             => array('5.3.0', ''),
                'MYSQLI_NO_DEFAULT_VALUE_FLAG'   => array('5.3.0', ''),
                'MYSQLI_ON_UPDATE_NOW_FLAG'      => array('5.3.0', ''),
                'MYSQLI_TYPE_DECIMAL'            => array('5.0.0', ''),
                'MYSQLI_TYPE_TINY'               => array('5.0.0', ''),
                'MYSQLI_TYPE_SHORT'              => array('5.0.0', ''),
                'MYSQLI_TYPE_LONG'               => array('5.0.0', ''),
                'MYSQLI_TYPE_FLOAT'              => array('5.0.0', ''),
                'MYSQLI_TYPE_DOUBLE'             => array('5.0.0', ''),
                'MYSQLI_TYPE_NULL'               => array('5.0.0', ''),
                'MYSQLI_TYPE_TIMESTAMP'          => array('5.0.0', ''),
                'MYSQLI_TYPE_LONGLONG'           => array('5.0.0', ''),
                'MYSQLI_TYPE_INT24'              => array('5.0.0', ''),
                'MYSQLI_TYPE_DATE'               => array('5.0.0', ''),
                'MYSQLI_TYPE_TIME'               => array('5.0.0', ''),
                'MYSQLI_TYPE_DATETIME'           => array('5.0.0', ''),
                'MYSQLI_TYPE_YEAR'               => array('5.0.0', ''),
                'MYSQLI_TYPE_NEWDATE'            => array('5.0.0', ''),
                'MYSQLI_TYPE_ENUM'               => array('5.0.0', ''),
                'MYSQLI_TYPE_SET'                => array('5.0.0', ''),
                'MYSQLI_TYPE_TINY_BLOB'          => array('5.0.0', ''),
                'MYSQLI_TYPE_MEDIUM_BLOB'        => array('5.0.0', ''),
                'MYSQLI_TYPE_LONG_BLOB'          => array('5.0.0', ''),
                'MYSQLI_TYPE_BLOB'               => array('5.0.0', ''),
                'MYSQLI_TYPE_VAR_STRING'         => array('5.0.0', ''),
                'MYSQLI_TYPE_STRING'             => array('5.0.0', ''),
                'MYSQLI_TYPE_CHAR'               => array('5.0.0', ''),
                'MYSQLI_TYPE_INTERVAL'           => array('5.0.0', ''),
                'MYSQLI_TYPE_GEOMETRY'           => array('5.0.0', ''),
                'MYSQLI_TYPE_NEWDECIMAL'         => array('5.0.0', ''),
                'MYSQLI_TYPE_BIT'                => array('5.0.0', ''),
                'MYSQLI_SET_CHARSET_NAME'        => array('5.2.5', ''),
                'MYSQLI_NO_DATA'                 => array('5.0.0', ''),
                'MYSQLI_REPORT_INDEX'            => array('5.0.0', ''),
                'MYSQLI_REPORT_ERROR'            => array('5.0.0', ''),
                'MYSQLI_REPORT_STRICT'           => array('5.0.0', ''),
                'MYSQLI_REPORT_ALL'              => array('5.0.0', ''),
                'MYSQLI_REPORT_OFF'              => array('5.0.0', ''),
                'MYSQLI_DEBUG_TRACE_ENABLED'     => array('5.3.0', ''),
                'MYSQLI_SERVER_QUERY_NO_GOOD_INDEX_USED'
                                                 => array('5.3.0', ''),
                'MYSQLI_SERVER_QUERY_NO_INDEX_USED'
                                                 => array('5.3.0', ''),
                'MYSQLI_SERVER_QUERY_WAS_SLOW'   => array('5.3.0', ''),
                'MYSQLI_REFRESH_GRANT'           => array('5.3.0', ''),
                'MYSQLI_REFRESH_LOG'             => array('5.3.0', ''),
                'MYSQLI_REFRESH_TABLES'          => array('5.3.0', ''),
                'MYSQLI_REFRESH_HOSTS'           => array('5.3.0', ''),
                'MYSQLI_REFRESH_STATUS'          => array('5.3.0', ''),
                'MYSQLI_REFRESH_THREADS'         => array('5.3.0', ''),
                'MYSQLI_REFRESH_SLAVE'           => array('5.3.0', ''),
                'MYSQLI_REFRESH_MASTER'          => array('5.3.0', ''),
                'MYSQLI_REFRESH_BACKUP_LOG'      => array('5.3.0', ''),
                'MYSQLI_DATA_TRUNCATED'          => array('5.1.0', ''),
                'MYSQLI_ENUM_FLAG'               => array('5.3.0', ''),
                'MYSQLI_OPT_SSL_VERIFY_SERVER_CERT'
                                                 => array('5.3.4', ''),
                'MYSQLI_SET_CHARSET_DIR'         => array('5.3.4', ''),
                'MYSQLI_SERVER_PS_OUT_PARAMS'    => array('5.3.4', ''),

                'MYSQLI_RPL_MASTER'              => array('5.0.0', '5.2.17'),
                'MYSQLI_RPL_SLAVE'               => array('5.0.0', '5.2.17'),
                'MYSQLI_RPL_ADMIN'               => array('5.0.0', '5.2.17'),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
