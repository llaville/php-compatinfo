<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class IncluedExtension extends AbstractReference
{
    const REF_NAME    = 'inclued';
    const REF_VERSION = '0.1.3';  // 2012-06-12 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.1.2
        if (version_compare($version, '0.1.2', 'ge')) {
            $release = $this->getR00102();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2008-02-29',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'inclued.dumpdir'           => null,
            'inclued.enabled'           => null,
        );
        $release->functions = array(
            'inclued_get_data'          => null,
        );
        return $release;
    }

    protected function getR00102()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.2',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2010-11-29',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'inclued.random_sampling'   => null,
        );
        return $release;
    }
}
