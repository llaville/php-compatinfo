<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class YacExtension extends AbstractReference
{
    const REF_NAME    = 'yac';
    const REF_VERSION = '0.9.2';  // 2014-10-22 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.9.0 - 2014-07-23 - first PECL release
        if (version_compare($version, '0.9.0', 'ge')) {
            $release = $this->getR00900();
            $this->storage->attach($release);
        }
    }

    protected function getR00900()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.9.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-07-23',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'yac.debug'                         => null,
            'yac.enable'                        => null,
            'yac.enable_cli'                    => null,
            'yac.compress_threshold'            => null,
            'yac.keys_memory_size'              => null,
            'yac.values_memory_size'            => null,
        );
        $release->constants = array(
            'YAC_VERSION'                       => null,
            'YAC_MAX_KEY_LEN'                   => null,
            'YAC_MAX_VALUE_RAW_LEN'             => null,
            'YAC_MAX_RAW_COMPRESSED_LEN'        => null,
            'YAC_SERIALIZER'                    => null,
        );
        $release->classes = array(
            'Yac' => array(
                'methods' => array(
                    'add'                       => null,
                    'set'                       => null,
                    'get'                       => null,
                    'delete'                    => null,
                    'flush'                     => null,
                    'info'                      => null,
                    'dump'                      => null,
                ),
            ),
        );
        return $release;
    }
}
