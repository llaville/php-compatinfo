<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SqliteExtension extends AbstractReference
{
    const REF_NAME    = 'sqlite';
    const REF_VERSION = '2.0-dev';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 2.0-dev
        if (version_compare($version, '2.0-dev', 'ge')) {
            $release = $this->getR20000dev();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR20000dev()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0-dev',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'sqlite.assoc_case'             => null,
        );
        $release->classes = array(
            'SQLiteDatabase'                => null,
            'SQLiteException'               => null,
            'SQLiteResult'                  => null,
            'SQLiteUnbuffered'              => null,
        );
        $release->functions = array(
            'sqlite_array_query'            => null,
            'sqlite_busy_timeout'           => null,
            'sqlite_changes'                => null,
            'sqlite_close'                  => null,
            'sqlite_column'                 => null,
            'sqlite_create_aggregate'       => null,
            'sqlite_create_function'        => null,
            'sqlite_current'                => null,
            'sqlite_error_string'           => null,
            'sqlite_escape_string'          => null,
            'sqlite_exec'                   => null,
            'sqlite_factory'                => null,
            'sqlite_fetch_all'              => null,
            'sqlite_fetch_array'            => null,
            'sqlite_fetch_column_types'     => array('5.0.0', '', '5.0.0, 5.0.0, 5.1.0'),
            'sqlite_fetch_object'           => null,
            'sqlite_fetch_single'           => null,
            'sqlite_fetch_string'           => null,
            'sqlite_field_name'             => null,
            'sqlite_has_more'               => null,
            'sqlite_has_prev'               => null,
            // http://bugs.php.net/31510
            //'sqlite_key'                  => array('5.1.0', ''),
            'sqlite_last_error'             => null,
            'sqlite_last_insert_rowid'      => null,
            'sqlite_libencoding'            => null,
            'sqlite_libversion'             => null,
            'sqlite_next'                   => null,
            'sqlite_num_fields'             => null,
            'sqlite_num_rows'               => null,
            'sqlite_open'                   => null,
            'sqlite_popen'                  => null,
            'sqlite_prev'                   => null,
            'sqlite_query'                  => null,
            'sqlite_rewind'                 => null,
            'sqlite_seek'                   => null,
            'sqlite_single_query'           => null,
            'sqlite_udf_decode_binary'      => null,
            'sqlite_udf_encode_binary'      => null,
            'sqlite_unbuffered_query'       => null,
            'sqlite_valid'                  => null,
        );
        $release->constants = array(
            'SQLITE_ABORT'                  => null,
            'SQLITE_ASSOC'                  => null,
            'SQLITE_AUTH'                   => null,
            'SQLITE_BOTH'                   => null,
            'SQLITE_BUSY'                   => null,
            'SQLITE_CANTOPEN'               => null,
            'SQLITE_CONSTRAINT'             => null,
            'SQLITE_CORRUPT'                => null,
            'SQLITE_DONE'                   => null,
            'SQLITE_EMPTY'                  => null,
            'SQLITE_ERROR'                  => null,
            'SQLITE_FORMAT'                 => null,
            'SQLITE_FULL'                   => null,
            'SQLITE_INTERNAL'               => null,
            'SQLITE_INTERRUPT'              => null,
            'SQLITE_IOERR'                  => null,
            'SQLITE_LOCKED'                 => null,
            'SQLITE_MISMATCH'               => null,
            'SQLITE_MISUSE'                 => null,
            'SQLITE_NOLFS'                  => null,
            'SQLITE_NOMEM'                  => null,
            'SQLITE_NOTADB'                 => null,
            'SQLITE_NOTFOUND'               => null,
            'SQLITE_NUM'                    => null,
            'SQLITE_OK'                     => null,
            'SQLITE_PERM'                   => null,
            'SQLITE_PROTOCOL'               => null,
            'SQLITE_READONLY'               => null,
            'SQLITE_ROW'                    => null,
            'SQLITE_SCHEMA'                 => null,
            'SQLITE_TOOBIG'                 => null,
        );
        return $release;
    }
}
