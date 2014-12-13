<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class WddxExtension extends AbstractReference
{
    const REF_NAME    = 'wddx';
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
        $release->functions = array(
            'wddx_add_vars'                 => null,
            'wddx_deserialize'              => null,
            'wddx_packet_end'               => null,
            'wddx_packet_start'             => null,
            'wddx_serialize_value'          => null,
            'wddx_serialize_vars'           => null,
        );
        return $release;
    }
}
