<?php
/**
 * Version informations about pgsql extension
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
 * All interfaces, classes, functions, constants about PostgreSQL extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.pgsql.php
 */
class PHP_CompatInfo_Reference_Pgsql implements PHP_CompatInfo_Reference
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
            'pgsql' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.pgsql.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'pg_affected_rows'               => array('4.2.0', ''),
                'pg_cancel_query'                => array('4.2.0', ''),
                'pg_client_encoding'             => array('4.0.3', ''),
                'pg_close'                       => array('4.0.0', ''),
                'pg_connect'                     => array('4.0.0', ''),
                'pg_connection_busy'             => array('4.2.0', ''),
                'pg_connection_reset'            => array('4.2.0', ''),
                'pg_connection_status'           => array('4.2.0', ''),
                'pg_convert'                     => array('4.3.0', ''),
                'pg_copy_from'                   => array('4.2.0', ''),
                'pg_copy_to'                     => array('4.2.0', ''),
                'pg_dbname'                      => array('4.0.0', ''),
                'pg_delete'                      => array('4.3.0', ''),
                'pg_end_copy'                    => array('4.0.3', ''),
                'pg_escape_bytea'                => array('4.2.0', ''),
                'pg_escape_string'               => array('4.2.0', ''),
                'pg_fetch_all'                   => array('4.3.0', ''),
                'pg_fetch_array'                 => array('4.0.0', ''),
                'pg_fetch_assoc'                 => array('4.3.0', ''),
                'pg_fetch_object'                => array('4.0.0', ''),
                'pg_fetch_result'                => array('4.2.0', ''),
                'pg_fetch_row'                   => array('4.0.0', ''),
                'pg_field_is_null'               => array('4.2.0', ''),
                'pg_field_name'                  => array('4.2.0', ''),
                'pg_field_num'                   => array('4.2.0', ''),
                'pg_field_prtlen'                => array('4.2.0', ''),
                'pg_field_size'                  => array('4.2.0', ''),
                'pg_field_type'                  => array('4.2.0', ''),
                'pg_free_result'                 => array('4.2.0', ''),
                'pg_get_notify'                  => array('4.3.0', ''),
                'pg_get_pid'                     => array('4.3.0', ''),
                'pg_get_result'                  => array('4.2.0', ''),
                'pg_host'                        => array('4.0.0', ''),
                'pg_insert'                      => array('4.3.0', ''),
                'pg_last_error'                  => array('4.2.0', ''),
                'pg_last_notice'                 => array('4.0.6', ''),
                'pg_last_oid'                    => array('4.2.0', ''),
                'pg_lo_close'                    => array('4.2.0', ''),
                'pg_lo_create'                   => array('4.2.0', ''),
                'pg_lo_export'                   => array('4.2.0', ''),
                'pg_lo_import'                   => array('4.2.0', ''),
                'pg_lo_open'                     => array('4.2.0', ''),
                'pg_lo_read_all'                 => array('4.2.0', ''),
                'pg_lo_read'                     => array('4.2.0', ''),
                'pg_lo_seek'                     => array('4.2.0', ''),
                'pg_lo_tell'                     => array('4.2.0', ''),
                'pg_lo_unlink'                   => array('4.2.0', ''),
                'pg_lo_write'                    => array('4.2.0', ''),
                'pg_meta_data'                   => array('4.3.0', ''),
                'pg_num_fields'                  => array('4.2.0', ''),
                'pg_num_rows'                    => array('4.2.0', ''),
                'pg_options'                     => array('4.0.0', ''),
                'pg_pconnect'                    => array('4.0.0', ''),
                'pg_ping'                        => array('4.3.0', ''),
                'pg_port'                        => array('4.0.0', ''),
                'pg_put_line'                    => array('4.0.3', ''),
                'pg_query'                       => array('4.2.0', ''),
                'pg_result_error'                => array('4.2.0', ''),
                'pg_result_seek'                 => array('4.3.0', ''),
                'pg_result_status'               => array('4.2.0', ''),
                'pg_select'                      => array('4.3.0', ''),
                'pg_send_query'                  => array('4.2.0', ''),
                'pg_set_client_encoding'         => array('4.0.3', ''),
                'pg_trace'                       => array('4.0.1', ''),
                'pg_tty'                         => array('4.0.0', ''),
                'pg_unescape_bytea'              => array('4.3.0', ''),
                'pg_untrace'                     => array('4.0.1', ''),
                'pg_update'                      => array('4.3.0', ''),
                // functions alias
                'pg_clientencoding'              => array('4.0.3', ''),
                'pg_cmdtuples'                   => array('4.2.0', ''),
                'pg_errormessage'                => array('4.2.0', ''),
                'pg_exec'                        => array('4.2.0', ''),
                'pg_fieldisnull'                 => array('4.2.0', ''),
                'pg_fieldname'                   => array('4.2.0', ''),
                'pg_fieldnum'                    => array('4.2.0', ''),
                'pg_fieldprtlen'                 => array('4.2.0', ''),
                'pg_fieldsize'                   => array('4.2.0', ''),
                'pg_fieldtype'                   => array('4.2.0', ''),
                'pg_freeresult'                  => array('4.2.0', ''),
                'pg_getlastoid'                  => array('4.2.0', ''),
                'pg_loclose'                     => array('4.2.0', ''),
                'pg_locreate'                    => array('4.2.0', ''),
                'pg_loexport'                    => array('4.2.0', ''),
                'pg_loimport'                    => array('4.2.0', ''),
                'pg_loopen'                      => array('4.2.0', ''),
                'pg_loread'                      => array('4.2.0', ''),
                'pg_loreadall'                   => array('4.2.0', ''),
                'pg_lounlink'                    => array('4.2.0', ''),
                'pg_lowrite'                     => array('4.2.0', ''),
                'pg_numfields'                   => array('4.2.0', ''),
                'pg_numrows'                     => array('4.2.0', ''),
                'pg_result'                      => array('4.2.0', ''),
                'pg_setclientencoding'           => array('4.0.3', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'pg_execute'                     => array('5.1.0', ''),
                'pg_fetch_all_columns'           => array('5.1.0', ''),
                'pg_field_table'                 => array('5.2.0', ''),
                'pg_field_type_oid'              => array('5.1.0', ''),
                'pg_parameter_status'            => array('5.0.0', ''),
                'pg_escape_literal'              => array('5.4.4-dev', ''),
                'pg_escape_identifier'           => array('5.4.4-dev', ''),
                'pg_prepare'                     => array('5.1.0', ''),
                'pg_query_params'                => array('5.1.0', ''),
                'pg_result_error_field'          => array('5.1.0', ''),
                'pg_send_execute'                => array('5.1.0', ''),
                'pg_send_prepare'                => array('5.1.0', ''),
                'pg_send_query_params'           => array('5.1.0', ''),
                'pg_set_error_verbosity'         => array('5.1.0', ''),
                'pg_transaction_status'          => array('5.1.0', ''),
                'pg_version'                     => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/pgsql.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'PGSQL_ASSOC'                    => array('4.0.0', ''),
                'PGSQL_BAD_RESPONSE'             => array('4.0.0', ''),
                'PGSQL_BOTH'                     => array('4.0.0', ''),
                'PGSQL_COMMAND_OK'               => array('4.0.0', ''),
                'PGSQL_CONNECTION_BAD'           => array('4.0.0', ''),
                'PGSQL_CONNECTION_OK'            => array('4.0.0', ''),
                'PGSQL_CONNECT_FORCE_NEW'        => array('4.0.0', ''),
                'PGSQL_CONV_FORCE_NULL'          => array('4.0.0', ''),
                'PGSQL_CONV_IGNORE_DEFAULT'      => array('4.0.0', ''),
                'PGSQL_CONV_IGNORE_NOT_NULL'     => array('4.0.0', ''),
                'PGSQL_COPY_IN'                  => array('4.0.0', ''),
                'PGSQL_COPY_OUT'                 => array('4.0.0', ''),
                'PGSQL_DIAG_CONTEXT'             => array('4.0.0', ''),
                'PGSQL_DIAG_INTERNAL_POSITION'   => array('4.0.0', ''),
                'PGSQL_DIAG_INTERNAL_QUERY'      => array('4.0.0', ''),
                'PGSQL_DIAG_MESSAGE_DETAIL'      => array('4.0.0', ''),
                'PGSQL_DIAG_MESSAGE_HINT'        => array('4.0.0', ''),
                'PGSQL_DIAG_MESSAGE_PRIMARY'     => array('4.0.0', ''),
                'PGSQL_DIAG_SEVERITY'            => array('4.0.0', ''),
                'PGSQL_DIAG_SOURCE_FILE'         => array('4.0.0', ''),
                'PGSQL_DIAG_SOURCE_FUNCTION'     => array('4.0.0', ''),
                'PGSQL_DIAG_SOURCE_LINE'         => array('4.0.0', ''),
                'PGSQL_DIAG_SQLSTATE'            => array('4.0.0', ''),
                'PGSQL_DIAG_STATEMENT_POSITION'  => array('4.0.0', ''),
                'PGSQL_DML_ASYNC'                => array('4.0.0', ''),
                'PGSQL_DML_EXEC'                 => array('4.0.0', ''),
                'PGSQL_DML_NO_CONV'              => array('4.0.0', ''),
                'PGSQL_DML_STRING'               => array('4.0.0', ''),
                'PGSQL_EMPTY_QUERY'              => array('4.0.0', ''),
                'PGSQL_ERRORS_DEFAULT'           => array('4.0.0', ''),
                'PGSQL_ERRORS_TERSE'             => array('4.0.0', ''),
                'PGSQL_ERRORS_VERBOSE'           => array('4.0.0', ''),
                'PGSQL_FATAL_ERROR'              => array('4.0.0', ''),
                'PGSQL_NONFATAL_ERROR'           => array('4.0.0', ''),
                'PGSQL_NUM'                      => array('4.0.0', ''),
                'PGSQL_SEEK_CUR'                 => array('4.0.0', ''),
                'PGSQL_SEEK_END'                 => array('4.0.0', ''),
                'PGSQL_SEEK_SET'                 => array('4.0.0', ''),
                'PGSQL_STATUS_LONG'              => array('4.0.0', ''),
                'PGSQL_STATUS_STRING'            => array('4.0.0', ''),
                'PGSQL_TUPLES_OK'                => array('4.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'PGSQL_LIBPQ_VERSION'            => array('5.4.4-dev', ''),
                'PGSQL_LIBPQ_VERSION_STR'        => array('5.4.4-dev', ''),
                'PGSQL_TRANSACTION_ACTIVE'       => array('5.1.0', ''),
                'PGSQL_TRANSACTION_IDLE'         => array('5.1.0', ''),
                'PGSQL_TRANSACTION_INERROR'      => array('5.1.0', ''),
                'PGSQL_TRANSACTION_INTRANS'      => array('5.1.0', ''),
                'PGSQL_TRANSACTION_UNKNOWN'      => array('5.1.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
