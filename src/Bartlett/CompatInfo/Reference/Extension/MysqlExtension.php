<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MysqlExtension extends AbstractReference
{
    const REF_NAME    = 'mysql';
    const REF_VERSION = '1.0';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.3
        if (version_compare($version, '4.0.3', 'ge')) {
            $release = $this->getR40003();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.6
        if (version_compare($version, '4.0.6', 'ge')) {
            $release = $this->getR40006();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.3
        if (version_compare($version, '5.2.3', 'ge')) {
            $release = $this->getR50203();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mysql.allow_local_infile'      => null,
            'mysql.allow_persistent'        => null,
            'mysql.default_host'            => null,
            'mysql.default_password'        => null,
            'mysql.default_port'            => null,
            'mysql.default_socket'          => null,
            'mysql.default_user'            => null,
            'mysql.max_links'               => null,
            'mysql.max_persistent'          => null,
            'mysql.trace_mode'              => null,
        );
        $release->constants = array(
            'MYSQL_ASSOC'                   => null,
            'MYSQL_BOTH'                    => null,
            'MYSQL_NUM'                     => null,
        );
        $release->functions = array(
            'mysql'                         => null,
            'mysql_affected_rows'           => null,
            'mysql_close'                   => null,
            'mysql_connect'                 => null,
            'mysql_create_db'               => null,
            'mysql_data_seek'               => null,
            'mysql_db_name'                 => null,
            'mysql_db_query'                => null,
            'mysql_dbname'                  => null,
            'mysql_drop_db'                 => null,
            'mysql_errno'                   => null,
            'mysql_error'                   => null,
            'mysql_fetch_array'             => null,
            'mysql_fetch_field'             => null,
            'mysql_fetch_lengths'           => null,
            'mysql_fetch_object'            => null,
            'mysql_fetch_row'               => null,
            'mysql_field_flags'             => null,
            'mysql_field_len'               => null,
            'mysql_field_name'              => null,
            'mysql_field_seek'              => null,
            'mysql_field_table'             => null,
            'mysql_field_type'              => null,
            'mysql_fieldflags'              => null,
            'mysql_fieldlen'                => null,
            'mysql_fieldname'               => null,
            'mysql_fieldtable'              => null,
            'mysql_fieldtype'               => null,
            'mysql_free_result'             => null,
            'mysql_freeresult'              => null,
            'mysql_insert_id'               => null,
            'mysql_list_dbs'                => null,
            'mysql_list_fields'             => null,
            'mysql_list_tables'             => null,
            'mysql_listdbs'                 => null,
            'mysql_listfields'              => null,
            'mysql_listtables'              => null,
            'mysql_num_fields'              => null,
            'mysql_num_rows'                => null,
            'mysql_numfields'               => null,
            'mysql_numrows'                 => null,
            'mysql_pconnect'                => null,
            'mysql_query'                   => null,
            'mysql_result'                  => null,
            'mysql_select_db'               => null,
            'mysql_selectdb'                => null,
            'mysql_table_name'              => null,
            'mysql_tablename'               => null,
        );
        return $release;
    }

    protected function getR40003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-10-11',
            'php.min' => '4.0.3',
            'php.max' => '',
        );
        $release->functions = array(
            'mysql_escape_string'           => null,
            'mysql_fetch_assoc'             => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->functions = array(
            'mysql_get_client_info'         => null,
            'mysql_get_host_info'           => null,
            'mysql_get_proto_info'          => null,
            'mysql_get_server_info'         => null,
        );
        return $release;
    }

    protected function getR40006()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-06-23',
            'php.min' => '4.0.6',
            'php.max' => '',
        );
        $release->functions = array(
            'mysql_unbuffered_query'        => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mysql.connect_timeout'         => null,
        );
        $release->functions = array(
            'mysql_client_encoding'         => null,
            'mysql_info'                    => null,
            'mysql_list_processes'          => null,
            'mysql_ping'                    => null,
            'mysql_real_escape_string'      => null,
            'mysql_stat'                    => null,
            'mysql_thread_id'               => null,
        );
        $release->constants = array(
            'MYSQL_CLIENT_COMPRESS'         => null,
            'MYSQL_CLIENT_IGNORE_SPACE'     => null,
            'MYSQL_CLIENT_INTERACTIVE'      => null,
            'MYSQL_CLIENT_SSL'              => null,
        );
        return $release;
    }

    protected function getR50203()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-05-31',
            'php.min' => '5.2.3',
            'php.max' => '',
        );
        $release->functions = array(
            'mysql_set_charset'             => null,
        );
        return $release;
    }
}
