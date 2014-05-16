<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class Sqlite3Extension extends AbstractReference
{
    const REF_NAME    = 'sqlite3';
    const REF_VERSION = '0.7-dev';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
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
        $release->iniEntries = array(
            'sqlite3.extension_dir'     => null,
        );
        $release->classes = array(
            'SQLite3'                   => null,
            'SQLite3Result'             => null,
            'SQLite3Stmt'               => null,
        );
        $release->constants = array(
            'SQLITE3_ASSOC'             => null,
            'SQLITE3_BLOB'              => null,
            'SQLITE3_BOTH'              => null,
            'SQLITE3_FLOAT'             => null,
            'SQLITE3_INTEGER'           => null,
            'SQLITE3_NULL'              => null,
            'SQLITE3_NUM'               => null,
            'SQLITE3_OPEN_CREATE'       => null,
            'SQLITE3_OPEN_READONLY'     => null,
            'SQLITE3_OPEN_READWRITE'    => null,
            'SQLITE3_TEXT'              => null,
        );
        return $release;
    }
}
