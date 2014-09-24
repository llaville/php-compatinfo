<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PharExtension extends AbstractReference
{
    const REF_NAME    = 'phar';
    const REF_VERSION = '2.0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0
        if (version_compare($version, '2.0.0a1', 'ge')) {
            $release = $this->getR20000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-03-28',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'phar.readonly'     => null,
            'phar.require_hash' => null,
        );
        $release->classes = array(
            'Phar'              => null,
            'PharException'     => null,
            'PharFileInfo'      => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '1.2.3',
            'state'   => 'stable',
            'date'    => '2007-04-12',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'phar.extract_list' => null,
        );
        return $release;
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0a1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2008-03-26',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'phar.cache_list'   => null,
        );
        $release->classes = array(
            'PharData'          => null,
        );
        return $release;
    }
}
