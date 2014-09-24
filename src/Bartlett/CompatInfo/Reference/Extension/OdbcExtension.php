<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class OdbcExtension extends AbstractReference
{
    const REF_NAME    = 'odbc';
    const REF_VERSION = '';

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

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.32RC1
        if (version_compare($version, '5.4.32RC1', 'ge')) {
            $release = $this->getR50432RC1();
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
            'odbc.allow_persistent'         => null,
            'odbc.check_persistent'         => null,
            'odbc.default_db'               => null,
            'odbc.default_pw'               => null,
            'odbc.default_user'             => null,
            'odbc.defaultbinmode'           => null,
            'odbc.defaultlrl'               => null,
            'odbc.max_links'                => null,
            'odbc.max_persistent'           => null,
        );
        $release->functions = array(
            'odbc_autocommit'               => null,
            'odbc_binmode'                  => null,
            'odbc_close'                    => null,
            'odbc_close_all'                => null,
            'odbc_columnprivileges'         => null,
            'odbc_columns'                  => null,
            'odbc_commit'                   => null,
            'odbc_connect'                  => null,
            'odbc_cursor'                   => null,
            'odbc_data_source'              => null,
            'odbc_do'                       => null,
            'odbc_error'                    => null,
            'odbc_errormsg'                 => null,
            'odbc_exec'                     => null,
            'odbc_execute'                  => null,
            'odbc_fetch_into'               => null,
            'odbc_fetch_row'                => null,
            'odbc_field_len'                => null,
            'odbc_field_name'               => null,
            'odbc_field_num'                => null,
            'odbc_field_precision'          => null,
            'odbc_field_scale'              => null,
            'odbc_field_type'               => null,
            'odbc_foreignkeys'              => null,
            'odbc_free_result'              => null,
            'odbc_gettypeinfo'              => null,
            'odbc_longreadlen'              => null,
            'odbc_next_result'              => null,
            'odbc_num_fields'               => null,
            'odbc_num_rows'                 => null,
            'odbc_pconnect'                 => null,
            'odbc_prepare'                  => null,
            'odbc_primarykeys'              => null,
            'odbc_procedurecolumns'         => null,
            'odbc_procedures'               => null,
            'odbc_result'                   => null,
            'odbc_result_all'               => null,
            'odbc_rollback'                 => null,
            'odbc_setoption'                => null,
            'odbc_specialcolumns'           => null,
            'odbc_statistics'               => null,
            'odbc_tableprivileges'          => null,
            'odbc_tables'                   => null,
        );
        $release->constants = array(
            'ODBC_BINMODE_CONVERT'          => null,
            'ODBC_BINMODE_PASSTHRU'         => null,
            'ODBC_BINMODE_RETURN'           => null,
            'ODBC_TYPE'                     => null,

            'SQL_CONCURRENCY'               => null,
            'SQL_CONCUR_LOCK'               => null,
            'SQL_CONCUR_READ_ONLY'          => null,
            'SQL_CONCUR_ROWVER'             => null,
            'SQL_CONCUR_VALUES'             => null,
            'SQL_CURSOR_DYNAMIC'            => null,
            'SQL_CURSOR_FORWARD_ONLY'       => null,
            'SQL_CURSOR_KEYSET_DRIVEN'      => null,
            'SQL_CURSOR_STATIC'             => null,
            'SQL_CURSOR_TYPE'               => null,
            'SQL_CUR_USE_DRIVER'            => null,
            'SQL_CUR_USE_IF_NEEDED'         => null,
            'SQL_CUR_USE_ODBC'              => null,
            'SQL_KEYSET_SIZE'               => null,
            'SQL_ODBC_CURSORS'              => null,
            // the standard data types
            'SQL_BIGINT'                    => null,
            'SQL_BINARY'                    => null,
            'SQL_BIT'                       => null,
            'SQL_CHAR'                      => null,
            'SQL_DATE'                      => null,
            'SQL_DECIMAL'                   => null,
            'SQL_DOUBLE'                    => null,
            'SQL_FLOAT'                     => null,
            'SQL_INTEGER'                   => null,
            'SQL_LONGVARBINARY'             => null,
            'SQL_LONGVARCHAR'               => null,
            'SQL_NUMERIC'                   => null,
            'SQL_REAL'                      => null,
            'SQL_SMALLINT'                  => null,
            'SQL_TIME'                      => null,
            'SQL_TIMESTAMP'                 => null,
            'SQL_TINYINT'                   => null,
            'SQL_TYPE_DATE'                 => null,
            'SQL_TYPE_TIME'                 => null,
            'SQL_TYPE_TIMESTAMP'            => null,
            'SQL_VARBINARY'                 => null,
            'SQL_VARCHAR'                   => null,
            // SQLSpecialColumns values
            'SQL_BEST_ROWID'                => null,
            'SQL_NO_NULLS'                  => null,
            'SQL_NULLABLE'                  => null,
            'SQL_ROWVER'                    => null,
            'SQL_SCOPE_CURROW'              => null,
            'SQL_SCOPE_SESSION'             => null,
            'SQL_SCOPE_TRANSACTION'         => null,
            // SQLStatistics values
            'SQL_ENSURE'                    => null,
            'SQL_INDEX_ALL'                 => null,
            'SQL_INDEX_UNIQUE'              => null,
            'SQL_QUICK'                     => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'odbc_fetch_array'              => null,
            'odbc_fetch_object'             => null,
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
        $release->constants = array(
            // Data Source type
            'SQL_FETCH_FIRST'               => null,
            'SQL_FETCH_NEXT'                => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'odbc.default_cursortype'       => null,
        );
        return $release;
    }

    protected function getR50432RC1()
    {
        $excludePhp505 = array(
            '5.5.0',
            '5.5.1',
            '5.5.2',
            '5.5.3',
            '5.5.4',
            '5.5.5',
            '5.5.6',
            '5.5.7',
            '5.5.8',
            '5.5.9',
            '5.5.10',
            '5.5.11',
            '5.5.12',
            '5.5.13',
            '5.5.14',
            '5.5.15', 
        );
        $release = new \stdClass;
        $release->info = array(
            'ext.min'       => '5.4.32RC1',
            'ext.max'       => '',
            'state'         => 'beta',
            'date'          => '2014-08-07',
            'php.min'       => '5.4.32RC1',
            'php.max'       => '',
            'php.excludes'  => $excludePhp505,
        );
        $release->constants = array(
            'SQL_WCHAR'                    => null,
            'SQL_WVARCHAR'                 => null,
            'SQL_WLONGVARCHAR'             => null,
        );
        return $release;
    }
}
