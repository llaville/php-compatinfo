<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class HtscannerExtension extends AbstractReference
{
    const REF_NAME    = 'htscanner';
    const REF_VERSION = '1.0.1';    // 2012-03-01 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.5.0
        if (version_compare($version, '0.5.0', 'ge')) {
            $release = $this->getR00500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.6.0
        if (version_compare($version, '0.6.0', 'ge')) {
            $release = $this->getR00600();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.7.0
        if (version_compare($version, '0.7.0', 'ge')) {
            $release = $this->getR00700();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.5.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2006-11-29',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'htscanner.config_file'         => null,
            'htscanner.default_docroot'     => null,
        );
        return $release;
    }

    protected function getR00600()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.6.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2006-12-07',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'htscanner.default_ttl'         => null,
        );
        return $release;
    }

    protected function getR00700()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.7.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2007-02-17',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'htscanner.stop_on_error'       => null,
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2011-02-01',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'htscanner.verbose'             => null,
        );
        return $release;
    }
}
