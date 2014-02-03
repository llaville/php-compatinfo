<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MhashExtension extends AbstractReference
{
    const REF_NAME    = 'mhash';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'mhash'                 => null,
            'mhash_count'           => null,
            'mhash_get_block_size'  => null,
            'mhash_get_hash_name'   => null,
        );
        $release->constants = array(
            'MHASH_ADLER32'         => null,
            'MHASH_CRC32'           => null,
            'MHASH_CRC32B'          => null,
            'MHASH_GOST'            => null,
            'MHASH_HAVAL128'        => null,
            'MHASH_HAVAL160'        => null,
            'MHASH_HAVAL192'        => null,
            'MHASH_HAVAL224'        => null,
            'MHASH_HAVAL256'        => null,
            'MHASH_MD2'             => null,
            'MHASH_MD4'             => null,
            'MHASH_MD5'             => null,
            'MHASH_RIPEMD128'       => null,
            'MHASH_RIPEMD160'       => null,
            'MHASH_RIPEMD256'       => null,
            'MHASH_RIPEMD320'       => null,
            'MHASH_SHA1'            => null,
            'MHASH_SHA224'          => null,
            'MHASH_SHA256'          => null,
            'MHASH_SHA384'          => null,
            'MHASH_SHA512'          => null,
            'MHASH_SNEFRU128'       => null,
            'MHASH_SNEFRU256'       => null,
            'MHASH_TIGER'           => null,
            'MHASH_TIGER128'        => null,
            'MHASH_TIGER160'        => null,
            'MHASH_WHIRLPOOL'       => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'mhash_keygen_s2k'      => null,
        );
        return $release;
    }
}
