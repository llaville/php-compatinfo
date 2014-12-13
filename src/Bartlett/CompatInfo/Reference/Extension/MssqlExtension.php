<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MssqlExtension extends AbstractReference
{
    const REF_NAME    = 'mssql';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $this->storage->attach($release);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $this->storage->attach($release);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $this->storage->attach($release);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
            $this->storage->attach($release);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $this->storage->attach($release);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $this->storage->attach($release);
        }

        // 4.3.2
        if (version_compare($version, '4.3.2', 'ge')) {
            $release = $this->getR40302();
            $this->storage->attach($release);
        }

        // 5.1.2
        if (version_compare($version, '5.1.2', 'ge')) {
            $release = $this->getR50102();
            $this->storage->attach($release);
        }

        // 5.5.2
        if (version_compare($version, '5.2.2', 'ge')) {
            $release = $this->getR50502();
            $this->storage->attach($release);
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
            'mssql.allow_persistent'            => null,
            'mssql.compatability_mode'          => null,
            'mssql.connect_timeout'             => null,
            'mssql.max_links'                   => null,
            'mssql.max_persistent'              => null,
            'mssql.min_error_severity'          => null,
            'mssql.min_message_severity'        => null,
            'mssql.textlimit'                   => null,
            'mssql.textsize'                    => null,
        );
        $release->constants = array(
            'MSSQL_ASSOC'                       => null,
            'MSSQL_BOTH'                        => null,
            'MSSQL_NUM'                         => null,
            'SQLBIT'                            => null,
            'SQLCHAR'                           => null,
            'SQLFLT4'                           => null,
            'SQLFLT8'                           => null,
            'SQLFLTN'                           => null,
            'SQLINT1'                           => null,
            'SQLINT2'                           => null,
            'SQLINT4'                           => null,
            'SQLTEXT'                           => null,
            'SQLVARCHAR'                        => null,
        );
        $release->functions = array(
            'mssql_close'                       => null,
            'mssql_connect'                     => null,
            'mssql_data_seek'                   => null,
            'mssql_fetch_array'                 => null,
            'mssql_fetch_field'                 => null,
            'mssql_fetch_object'                => null,
            'mssql_fetch_row'                   => null,
            'mssql_field_length'                => null,
            'mssql_field_name'                  => null,
            'mssql_field_seek'                  => null,
            'mssql_field_type'                  => null,
            'mssql_free_result'                 => null,
            'mssql_get_last_message'            => null,
            'mssql_min_error_severity'          => null,
            'mssql_min_message_severity'        => null,
            'mssql_num_fields'                  => null,
            'mssql_num_rows'                    => null,
            'mssql_pconnect'                    => null,
            'mssql_query'                       => null,
            'mssql_result'                      => null,
            'mssql_select_db'                   => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mssql.batchsize'                   => null,
        );
        $release->functions = array(
            'mssql_fetch_batch'                 => null,
            'mssql_rows_affected'               => null,
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
            'mssql_next_result'                 => null,
        );
        return $release;
    }

    protected function getR40007()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.0.7',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mssql.timeout'                     => null,
        );
        $release->functions = array(
            'mssql_bind'                        => null,
            'mssql_execute'                     => null,
            'mssql_guid_string'                 => null,
            'mssql_init'                        => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mssql.datetimeconvert'             => null,
        );
        $release->functions = array(
            'mssql_fetch_assoc'                 => null,
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
            'mssql.secure_connection'          => null,
            'mssql.max_procs'                  => null,
        );
        return $release;
    }

    protected function getR40302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-05-29',
            'php.min' => '4.3.2',
            'php.max' => '',
        );
        $release->functions = array(
            'mssql_free_statement'              => null,
        );
        return $release;
    }

    protected function getR50102()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-01-12',
            'php.min' => '5.1.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mssql.charset'                    => null,
        );
        return $release;
    }

    protected function getR50502()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-08-13',
            'php.min' => '5.5.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mssql.compatibility_mode'          => null,
        );
        return $release;
    }
}
