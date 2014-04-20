<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PgsqlExtension extends AbstractReference
{
    const REF_NAME    = 'pgsql';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.3
        if (version_compare($version, '4.0.3', 'ge')) {
            $release = $this->getR40003();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.6
        if (version_compare($version, '4.0.6', 'ge')) {
            $release = $this->getR40006();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.4
        if (version_compare($version, '5.4.4', 'ge')) {
            $release = $this->getR50404();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0alpha1
        if (version_compare($version, '5.6.0alpha1', 'ge')) {
            $release = $this->getR50600a1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0beta1
        if (version_compare($version, '5.6.0beta1', 'ge')) {
            $release = $this->getR50600b1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'pgsql.allow_persistent'            => null,
            'pgsql.auto_reset_persistent'       => null,
            'pgsql.ignore_notice'               => null,
            'pgsql.log_notice'                  => null,
            'pgsql.max_links'                   => null,
            'pgsql.max_persistent'              => null,
        );
        $release->constants = array(
            'PGSQL_ASSOC'                       => null,
            'PGSQL_BAD_RESPONSE'                => null,
            'PGSQL_BOTH'                        => null,
            'PGSQL_COMMAND_OK'                  => null,
            'PGSQL_CONNECTION_BAD'              => null,
            'PGSQL_CONNECTION_OK'               => null,
            'PGSQL_CONNECT_FORCE_NEW'           => null,
            'PGSQL_CONV_FORCE_NULL'             => null,
            'PGSQL_CONV_IGNORE_DEFAULT'         => null,
            'PGSQL_CONV_IGNORE_NOT_NULL'        => null,
            'PGSQL_COPY_IN'                     => null,
            'PGSQL_COPY_OUT'                    => null,
            'PGSQL_DIAG_CONTEXT'                => null,
            'PGSQL_DIAG_INTERNAL_POSITION'      => null,
            'PGSQL_DIAG_INTERNAL_QUERY'         => null,
            'PGSQL_DIAG_MESSAGE_DETAIL'         => null,
            'PGSQL_DIAG_MESSAGE_HINT'           => null,
            'PGSQL_DIAG_MESSAGE_PRIMARY'        => null,
            'PGSQL_DIAG_SEVERITY'               => null,
            'PGSQL_DIAG_SOURCE_FILE'            => null,
            'PGSQL_DIAG_SOURCE_FUNCTION'        => null,
            'PGSQL_DIAG_SOURCE_LINE'            => null,
            'PGSQL_DIAG_SQLSTATE'               => null,
            'PGSQL_DIAG_STATEMENT_POSITION'     => null,
            'PGSQL_DML_ASYNC'                   => null,
            'PGSQL_DML_EXEC'                    => null,
            'PGSQL_DML_NO_CONV'                 => null,
            'PGSQL_DML_STRING'                  => null,
            'PGSQL_EMPTY_QUERY'                 => null,
            'PGSQL_ERRORS_DEFAULT'              => null,
            'PGSQL_ERRORS_TERSE'                => null,
            'PGSQL_ERRORS_VERBOSE'              => null,
            'PGSQL_FATAL_ERROR'                 => null,
            'PGSQL_NONFATAL_ERROR'              => null,
            'PGSQL_NUM'                         => null,
            'PGSQL_SEEK_CUR'                    => null,
            'PGSQL_SEEK_END'                    => null,
            'PGSQL_SEEK_SET'                    => null,
            'PGSQL_STATUS_LONG'                 => null,
            'PGSQL_STATUS_STRING'               => null,
            'PGSQL_TUPLES_OK'                   => null,
        );
        $release->functions = array(
            'pg_close'                          => null,
            'pg_connect'                        => null,
            'pg_dbname'                         => null,
            'pg_fetch_array'                    => null,
            'pg_fetch_object'                   => null,
            'pg_fetch_row'                      => null,
            'pg_host'                           => null,
            'pg_options'                        => null,
            'pg_pconnect'                       => null,
            'pg_port'                           => null,
            'pg_tty'                            => null,
        );
        return $release;
    }

    protected function getR40001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-06-28',
            'php.min' => '4.0.1',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_trace'                          => null,
            'pg_untrace'                        => null,
        );
        return $release;
    }

    protected function getR40003()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-10-11',
            'php.min' => '4.0.3',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_client_encoding'                => null,
            'pg_clientencoding'                 => null,
            'pg_end_copy'                       => null,
            'pg_put_line'                       => null,
            'pg_set_client_encoding'            => null,
            'pg_setclientencoding'              => null,
        );
        return $release;
    }

    protected function getR40006()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-06-23',
            'php.min' => '4.0.6',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_last_notice'                    => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_affected_rows'                  => null,
            'pg_cancel_query'                   => null,
            'pg_cmdtuples'                      => null,
            'pg_connection_busy'                => null,
            'pg_connection_reset'               => null,
            'pg_connection_status'              => null,
            'pg_copy_from'                      => null,
            'pg_copy_to'                        => null,
            'pg_errormessage'                   => null,
            'pg_escape_bytea'                   => null,
            'pg_escape_string'                  => null,
            'pg_exec'                           => null,
            'pg_fetch_result'                   => null,
            'pg_field_is_null'                  => null,
            'pg_field_name'                     => null,
            'pg_field_num'                      => null,
            'pg_field_prtlen'                   => null,
            'pg_field_size'                     => null,
            'pg_field_type'                     => null,
            'pg_fieldisnull'                    => null,
            'pg_fieldname'                      => null,
            'pg_fieldnum'                       => null,
            'pg_fieldprtlen'                    => null,
            'pg_fieldsize'                      => null,
            'pg_fieldtype'                      => null,
            'pg_free_result'                    => null,
            'pg_freeresult'                     => null,
            'pg_get_result'                     => null,
            'pg_getlastoid'                     => null,
            'pg_last_error'                     => null,
            'pg_last_oid'                       => null,
            'pg_lo_close'                       => null,
            'pg_lo_create'                      => null,
            'pg_lo_export'                      => null,
            'pg_lo_import'                      => null,
            'pg_lo_open'                        => null,
            'pg_lo_read'                        => null,
            'pg_lo_read_all'                    => null,
            'pg_lo_seek'                        => null,
            'pg_lo_tell'                        => null,
            'pg_lo_unlink'                      => null,
            'pg_lo_write'                       => null,
            'pg_loclose'                        => null,
            'pg_locreate'                       => null,
            'pg_loexport'                       => null,
            'pg_loimport'                       => null,
            'pg_loopen'                         => null,
            'pg_loread'                         => null,
            'pg_loreadall'                      => null,
            'pg_lounlink'                       => null,
            'pg_lowrite'                        => null,
            'pg_num_fields'                     => null,
            'pg_num_rows'                       => null,
            'pg_numfields'                      => null,
            'pg_numrows'                        => null,
            'pg_query'                          => null,
            'pg_result'                         => null,
            'pg_result_error'                   => null,
            'pg_result_status'                  => null,
            'pg_send_query'                     => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_convert'                        => null,
            'pg_delete'                         => null,
            'pg_fetch_all'                      => null,
            'pg_fetch_assoc'                    => null,
            'pg_get_notify'                     => null,
            'pg_get_pid'                        => null,
            'pg_insert'                         => null,
            'pg_meta_data'                      => null,
            'pg_ping'                           => null,
            'pg_result_seek'                    => null,
            'pg_select'                         => null,
            'pg_unescape_bytea'                 => null,
            'pg_update'                         => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_parameter_status'               => null,
            'pg_version'                        => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-11-24',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PGSQL_TRANSACTION_ACTIVE'          => null,
            'PGSQL_TRANSACTION_IDLE'            => null,
            'PGSQL_TRANSACTION_INERROR'         => null,
            'PGSQL_TRANSACTION_INTRANS'         => null,
            'PGSQL_TRANSACTION_UNKNOWN'         => null,
        );
        $release->functions = array(
            'pg_execute'                        => null,
            'pg_fetch_all_columns'              => null,
            'pg_field_type_oid'                 => null,
            'pg_prepare'                        => null,
            'pg_query_params'                   => null,
            'pg_result_error_field'             => null,
            'pg_send_execute'                   => null,
            'pg_send_prepare'                   => null,
            'pg_send_query_params'              => null,
            'pg_set_error_verbosity'            => null,
            'pg_transaction_status'             => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_field_table'                    => null,
        );
        return $release;
    }

    protected function getR50404()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.4.4',
            'php.max' => '',
        );
        $release->constants = array(
            'PGSQL_LIBPQ_VERSION'               => null,
            'PGSQL_LIBPQ_VERSION_STR'           => null,
        );
        $release->functions = array(
            'pg_escape_identifier'              => null,
            'pg_escape_literal'                 => null,
        );
        return $release;
    }

    protected function getR50600a1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-01-21',
            'php.min' => '5.6.0alpha1',
            'php.max' => '',
        );
        $release->functions = array(
            'pg_lo_truncate'                    => null,
        );
        return $release;
    }

    protected function getR50600b1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.6.0beta1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-04-11',
            'php.min' => '5.6.0beta1',
            'php.max' => '',
        );
        $release->constants = array(
            'PGSQL_CONNECTION_AUTH_OK'              => null,
            'PGSQL_CONNECTION_AWAITING_RESPONSE'    => null,
            'PGSQL_CONNECTION_MADE'                 => null,
            'PGSQL_CONNECTION_SETENV'               => null,
            'PGSQL_CONNECTION_SSL_STARTUP'          => null,
            'PGSQL_CONNECTION_STARTED'              => null,
            'PGSQL_CONNECT_ASYNC'                   => null,
            'PGSQL_DML_ESCAPE'                      => null,
            'PGSQL_POLLING_ACTIVE'                  => null,
            'PGSQL_POLLING_FAILED'                  => null,
            'PGSQL_POLLING_OK'                      => null,
            'PGSQL_POLLING_READING'                 => null,
            'PGSQL_POLLING_WRITING'                 => null,
        );
        $release->functions = array(
            'pg_connect_poll'                       => null,
            'pg_consume_input'                      => null,
            'pg_flush'                              => null,
            'pg_socket'                             => null,
        );
        return $release;
    }
}
