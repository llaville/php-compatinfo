<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MysqliExtension extends AbstractReference
{
    const REF_NAME    = 'mysqli';
    const REF_VERSION = '0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

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

        // 5.2.5
        if (version_compare($version, '5.2.5', 'ge')) {
            $release = $this->getR50205();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.4
        if (version_compare($version, '5.3.4', 'ge')) {
            $release = $this->getR50304();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.12
        if (version_compare($version, '5.4.12', 'ge')) {
            $release = $this->getR50412();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0alpha2
        if (version_compare($version, '5.6.0alpha2', 'ge')) {
            $release = $this->getR50600a2();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
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
        $release->iniEntries = array(
            'mysqli.allow_local_infile'             => null,
            'mysqli.allow_persistent'               => null,
            'mysqli.default_host'                   => null,
            'mysqli.default_port'                   => null,
            'mysqli.default_pw'                     => null,
            'mysqli.default_socket'                 => null,
            'mysqli.default_user'                   => null,
            'mysqli.max_links'                      => null,
            'mysqli.max_persistent'                 => null,
            'mysqli.reconnect'                      => null,
        );
        $release->classes = array(
            'mysqli'                                => null,
            'mysqli_driver'                         => null,
            'mysqli_result'                         => null,
            'mysqli_sql_exception'                  => null,
            'mysqli_stmt'                           => null,
            'mysqli_warning'                        => null,
        );
        $release->functions = array(
            'mysqli_affected_rows'                  => null,
            'mysqli_autocommit'                     => null,
            'mysqli_bind_param'                     => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_bind_result'                    => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_change_user'                    => null,
            'mysqli_character_set_name'             => null,
            'mysqli_client_encoding'                => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_close'                          => null,
            'mysqli_commit'                         => null,
            'mysqli_connect'                        => null,
            'mysqli_connect_errno'                  => null,
            'mysqli_connect_error'                  => null,
            'mysqli_data_seek'                      => null,
            'mysqli_debug'                          => null,
            'mysqli_disable_reads_from_master'      => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_disable_rpl_parse'              => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_dump_debug_info'                => null,
            'mysqli_embedded_server_end'            => null,
            'mysqli_embedded_server_start'          => null,
            'mysqli_enable_reads_from_master'       => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_enable_rpl_parse'               => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_errno'                          => null,
            'mysqli_error'                          => null,
            'mysqli_escape_string'                  => null,
            'mysqli_execute'                        => null,
            'mysqli_fetch'                          => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_fetch_all'                      => null,
            'mysqli_fetch_array'                    => null,
            'mysqli_fetch_assoc'                    => null,
            'mysqli_fetch_field'                    => null,
            'mysqli_fetch_field_direct'             => null,
            'mysqli_fetch_fields'                   => null,
            'mysqli_fetch_lengths'                  => null,
            'mysqli_fetch_object'                   => null,
            'mysqli_fetch_row'                      => null,
            'mysqli_field_count'                    => null,
            'mysqli_field_seek'                     => null,
            'mysqli_field_tell'                     => null,
            'mysqli_free_result'                    => null,
            'mysqli_get_cache_stats'                => null,
            'mysqli_get_charset'                    => null,
            'mysqli_get_client_info'                => null,
            'mysqli_get_client_stats'               => null,
            'mysqli_get_client_version'             => null,
            'mysqli_get_connection_stats'           => null,
            'mysqli_get_host_info'                  => null,
            'mysqli_get_metadata'                   => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_get_proto_info'                 => null,
            'mysqli_get_server_info'                => null,
            'mysqli_get_server_version'             => null,
            'mysqli_get_warnings'                   => null,
            'mysqli_info'                           => null,
            'mysqli_init'                           => null,
            'mysqli_insert_id'                      => null,
            'mysqli_kill'                           => null,
            'mysqli_master_query'                   => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_more_results'                   => null,
            'mysqli_multi_query'                    => null,
            'mysqli_next_result'                    => null,
            'mysqli_num_fields'                     => null,
            'mysqli_num_rows'                       => null,
            'mysqli_options'                        => null,
            'mysqli_param_count'                    => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_ping'                           => null,
            'mysqli_poll'                           => null,
            'mysqli_prepare'                        => null,
            'mysqli_query'                          => null,
            'mysqli_real_connect'                   => null,
            'mysqli_real_escape_string'             => null,
            'mysqli_real_query'                     => null,
            'mysqli_reap_async_query'               => null,
            'mysqli_report'                         => null,
            'mysqli_rollback'                       => null,
            'mysqli_rpl_parse_enabled'              => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_rpl_probe'                      => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_rpl_query_type'                 => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_select_db'                      => null,
            'mysqli_send_long_data'                 => array('5.0.0', self::LATEST_PHP_5_3),
            'mysqli_send_query'                     => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_set_charset'                    => null,
            'mysqli_set_local_infile_default'       => null,
            'mysqli_set_local_infile_handler'       => null,
            'mysqli_set_opt'                        => null,
            'mysqli_slave_query'                    => array('5.0.0', self::LATEST_PHP_5_2),
            'mysqli_sqlstate'                       => null,
            'mysqli_ssl_set'                        => null,
            'mysqli_stat'                           => null,
            'mysqli_stmt_affected_rows'             => null,
            'mysqli_stmt_attr_get'                  => null,
            'mysqli_stmt_attr_set'                  => null,
            'mysqli_stmt_bind_param'                => null,
            'mysqli_stmt_bind_result'               => null,
            'mysqli_stmt_close'                     => null,
            'mysqli_stmt_data_seek'                 => null,
            'mysqli_stmt_errno'                     => null,
            'mysqli_stmt_error'                     => null,
            'mysqli_stmt_execute'                   => null,
            'mysqli_stmt_fetch'                     => null,
            'mysqli_stmt_field_count'               => null,
            'mysqli_stmt_free_result'               => null,
            'mysqli_stmt_get_result'                => null,
            'mysqli_stmt_get_warnings'              => null,
            'mysqli_stmt_init'                      => null,
            'mysqli_stmt_insert_id'                 => null,
            'mysqli_stmt_more_results'              => null,
            'mysqli_stmt_next_result'               => null,
            'mysqli_stmt_num_rows'                  => null,
            'mysqli_stmt_param_count'               => null,
            'mysqli_stmt_prepare'                   => null,
            'mysqli_stmt_reset'                     => null,
            'mysqli_stmt_result_metadata'           => null,
            'mysqli_stmt_send_long_data'            => null,
            'mysqli_stmt_sqlstate'                  => null,
            'mysqli_stmt_store_result'              => null,
            'mysqli_store_result'                   => null,
            'mysqli_thread_id'                      => null,
            'mysqli_thread_safe'                    => null,
            'mysqli_use_result'                     => null,
            'mysqli_warning_count'                  => null,
        );
        $release->constants = array(
            'MYSQLI_ASSOC'                          => null,
            'MYSQLI_AUTO_INCREMENT_FLAG'            => null,
            'MYSQLI_BLOB_FLAG'                      => null,
            'MYSQLI_BOTH'                           => null,
            'MYSQLI_CLIENT_COMPRESS'                => null,
            'MYSQLI_CLIENT_FOUND_ROWS'              => null,
            'MYSQLI_CLIENT_IGNORE_SPACE'            => null,
            'MYSQLI_CLIENT_INTERACTIVE'             => null,
            'MYSQLI_CLIENT_NO_SCHEMA'               => null,
            'MYSQLI_CLIENT_SSL'                     => null,
            'MYSQLI_CURSOR_TYPE_FOR_UPDATE'         => null,
            'MYSQLI_CURSOR_TYPE_NO_CURSOR'          => null,
            'MYSQLI_CURSOR_TYPE_READ_ONLY'          => null,
            'MYSQLI_CURSOR_TYPE_SCROLLABLE'         => null,
            'MYSQLI_GROUP_FLAG'                     => null,
            'MYSQLI_INIT_COMMAND'                   => null,
            'MYSQLI_MULTIPLE_KEY_FLAG'              => null,
            'MYSQLI_NOT_NULL_FLAG'                  => null,
            'MYSQLI_NO_DATA'                        => null,
            'MYSQLI_NUM'                            => null,
            'MYSQLI_NUM_FLAG'                       => null,
            'MYSQLI_OPT_CONNECT_TIMEOUT'            => null,
            'MYSQLI_OPT_LOCAL_INFILE'               => null,
            'MYSQLI_PART_KEY_FLAG'                  => null,
            'MYSQLI_PRI_KEY_FLAG'                   => null,
            'MYSQLI_READ_DEFAULT_FILE'              => null,
            'MYSQLI_READ_DEFAULT_GROUP'             => null,
            'MYSQLI_REPORT_ALL'                     => null,
            'MYSQLI_REPORT_ERROR'                   => null,
            'MYSQLI_REPORT_INDEX'                   => null,
            'MYSQLI_REPORT_OFF'                     => null,
            'MYSQLI_REPORT_STRICT'                  => null,
            'MYSQLI_RPL_ADMIN'                      => array('5.0.0', self::LATEST_PHP_5_2),
            'MYSQLI_RPL_MASTER'                     => array('5.0.0', self::LATEST_PHP_5_2),
            'MYSQLI_RPL_SLAVE'                      => array('5.0.0', self::LATEST_PHP_5_2),
            'MYSQLI_SET_FLAG'                       => null,
            'MYSQLI_STMT_ATTR_CURSOR_TYPE'          => null,
            'MYSQLI_STMT_ATTR_PREFETCH_ROWS'        => null,
            'MYSQLI_STMT_ATTR_UPDATE_MAX_LENGTH'    => null,
            'MYSQLI_STORE_RESULT'                   => null,
            'MYSQLI_TIMESTAMP_FLAG'                 => null,
            'MYSQLI_TYPE_BIT'                       => null,
            'MYSQLI_TYPE_BLOB'                      => null,
            'MYSQLI_TYPE_CHAR'                      => null,
            'MYSQLI_TYPE_DATE'                      => null,
            'MYSQLI_TYPE_DATETIME'                  => null,
            'MYSQLI_TYPE_DECIMAL'                   => null,
            'MYSQLI_TYPE_DOUBLE'                    => null,
            'MYSQLI_TYPE_ENUM'                      => null,
            'MYSQLI_TYPE_FLOAT'                     => null,
            'MYSQLI_TYPE_GEOMETRY'                  => null,
            'MYSQLI_TYPE_INT24'                     => null,
            'MYSQLI_TYPE_INTERVAL'                  => null,
            'MYSQLI_TYPE_LONG'                      => null,
            'MYSQLI_TYPE_LONGLONG'                  => null,
            'MYSQLI_TYPE_LONG_BLOB'                 => null,
            'MYSQLI_TYPE_MEDIUM_BLOB'               => null,
            'MYSQLI_TYPE_NEWDATE'                   => null,
            'MYSQLI_TYPE_NEWDECIMAL'                => null,
            'MYSQLI_TYPE_NULL'                      => null,
            'MYSQLI_TYPE_SET'                       => null,
            'MYSQLI_TYPE_SHORT'                     => null,
            'MYSQLI_TYPE_STRING'                    => null,
            'MYSQLI_TYPE_TIME'                      => null,
            'MYSQLI_TYPE_TIMESTAMP'                 => null,
            'MYSQLI_TYPE_TINY'                      => null,
            'MYSQLI_TYPE_TINY_BLOB'                 => null,
            'MYSQLI_TYPE_VAR_STRING'                => null,
            'MYSQLI_TYPE_YEAR'                      => null,
            'MYSQLI_UNIQUE_KEY_FLAG'                => null,
            'MYSQLI_UNSIGNED_FLAG'                  => null,
            'MYSQLI_USE_RESULT'                     => null,
            'MYSQLI_ZEROFILL_FLAG'                  => null,
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
            'MYSQLI_DATA_TRUNCATED'     => null,
        );
        return $release;
    }

    protected function getR50205()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-11-08',
            'php.min' => '5.2.5',
            'php.max' => '',
        );
        $release->constants = array(
            'MYSQLI_SET_CHARSET_NAME'       => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'mysqli_refresh'                            => null,
        );
        $release->constants = array(
            'MYSQLI_ASYNC'                              => null,
            'MYSQLI_BINARY_FLAG'                        => null,
            'MYSQLI_DEBUG_TRACE_ENABLED'                => null,
            'MYSQLI_ENUM_FLAG'                          => null,
            'MYSQLI_NO_DEFAULT_VALUE_FLAG'              => null,
            'MYSQLI_ON_UPDATE_NOW_FLAG'                 => null,
            'MYSQLI_OPT_INT_AND_FLOAT_NATIVE'           => null,
            'MYSQLI_OPT_NET_CMD_BUFFER_SIZE'            => null,
            'MYSQLI_OPT_NET_READ_BUFFER_SIZE'           => null,
            'MYSQLI_REFRESH_BACKUP_LOG'                 => null,
            'MYSQLI_REFRESH_GRANT'                      => null,
            'MYSQLI_REFRESH_HOSTS'                      => null,
            'MYSQLI_REFRESH_LOG'                        => null,
            'MYSQLI_REFRESH_MASTER'                     => null,
            'MYSQLI_REFRESH_SLAVE'                      => null,
            'MYSQLI_REFRESH_STATUS'                     => null,
            'MYSQLI_REFRESH_TABLES'                     => null,
            'MYSQLI_REFRESH_THREADS'                    => null,
            'MYSQLI_SERVER_QUERY_NO_GOOD_INDEX_USED'    => null,
            'MYSQLI_SERVER_QUERY_NO_INDEX_USED'         => null,
            'MYSQLI_SERVER_QUERY_WAS_SLOW'              => null,
        );
        return $release;
    }

    protected function getR50304()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-12-09',
            'php.min' => '5.3.4',
            'php.max' => '',
        );
        $release->constants = array(
            'MYSQLI_OPT_SSL_VERIFY_SERVER_CERT'     => null,
            'MYSQLI_SERVER_PS_OUT_PARAMS'           => null,
            'MYSQLI_SET_CHARSET_DIR'                => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
        );
        $release->functions = array(
            'mysqli_error_list'             => null,
            'mysqli_stmt_error_list'        => null,
        );
        return $release;
    }

    protected function getR50412()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.12',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-02-21',
            'php.min' => '5.4.12',
            'php.max' => '',
        );
        $release->constants = array(
            'MYSQLI_OPT_CAN_HANDLE_EXPIRED_PASSWORDS'   => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->constants = array(
            'MYSQLI_SERVER_PUBLIC_KEY'                      => null,
            'MYSQLI_TRANS_COR_AND_CHAIN'                    => null,
            'MYSQLI_TRANS_COR_AND_NO_CHAIN'                 => null,
            'MYSQLI_TRANS_COR_NO_RELEASE'                   => null,
            'MYSQLI_TRANS_COR_RELEASE'                      => null,
            'MYSQLI_TRANS_START_READ_ONLY'                  => null,
            'MYSQLI_TRANS_START_READ_WRITE'                 => null,
            'MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT'   => null,
        );
        $release->functions = array(
            'mysqli_begin_transaction'                      => null,
            'mysqli_release_savepoint'                      => null,
            'mysqli_savepoint'                              => null,
        );
        return $release;
    }

    protected function getR50600a2()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha2',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-02-12',
            'php.min' => '5.6.0alpha2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mysqli.rollback_on_cached_plink'           => null,
        );
        $release->functions = array(
            'mysqli_get_links_stats'                    => null,
        );
        return $release;
    }
}
