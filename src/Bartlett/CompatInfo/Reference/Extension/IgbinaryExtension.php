<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class IgbinaryExtension extends AbstractReference
{
    const REF_NAME    = 'igbinary';
    const REF_VERSION = '1.2.1';    // 2014-08-29 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 1.1.1
        if (version_compare($version, '1.1.1', 'ge')) {
            $release = $this->getR10101();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10101()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.1.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-03-14',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'igbinary.compact_strings'      => null,
        );
        $release->functions = array(
            'igbinary_serialize'            => null,
            'igbinary_unserialize'          => null,
        );
        return $release;
    }
}
