<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class HashExtension extends AbstractReference
{
    const REF_NAME    = 'hash';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 1.1
        if (version_compare($version, '1.1', 'ge')) {
            $release = $this->getR10100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-12-07',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'HASH_HMAC'                     => null,
        );
        $release->functions = array(
            'hash'                          => null,
            'hash_algos'                    => null,
            'hash_file'                     => null,
            'hash_final'                    => null,
            'hash_hmac'                     => null,
            'hash_hmac_file'                => null,
            'hash_init'                     => null,
            'hash_update'                   => null,
            'hash_update_file'              => null,
            'hash_update_stream'            => null,
        );
        return $release;
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
        $release->constants = array(
            'MHASH_ADLER32'                 => null,
            'MHASH_CRC32'                   => null,
            'MHASH_CRC32B'                  => null,
            'MHASH_GOST'                    => null,
            'MHASH_HAVAL128'                => null,
            'MHASH_HAVAL160'                => null,
            'MHASH_HAVAL192'                => null,
            'MHASH_HAVAL224'                => null,
            'MHASH_HAVAL256'                => null,
            'MHASH_MD2'                     => null,
            'MHASH_MD4'                     => null,
            'MHASH_MD5'                     => null,
            'MHASH_RIPEMD128'               => null,
            'MHASH_RIPEMD160'               => null,
            'MHASH_RIPEMD256'               => null,
            'MHASH_RIPEMD320'               => null,
            'MHASH_SHA1'                    => null,
            'MHASH_SHA224'                  => null,
            'MHASH_SHA256'                  => null,
            'MHASH_SHA384'                  => null,
            'MHASH_SHA512'                  => null,
            'MHASH_SNEFRU256'               => null,
            'MHASH_TIGER'                   => null,
            'MHASH_TIGER128'                => null,
            'MHASH_TIGER160'                => null,
            'MHASH_WHIRLPOOL'               => null,
        );
        $release->functions = array(
            'hash_copy'                     => null,

            'mhash'                         => null,
            'mhash_count'                   => null,
            'mhash_get_block_size'          => null,
            'mhash_get_hash_name'           => null,
            'mhash_keygen_s2k'              => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'MHASH_FNV132'                  => null,
            'MHASH_FNV1A32'                 => null,
            'MHASH_FNV164'                  => null,
            'MHASH_FNV1A64'                 => null,
            'MHASH_JOAAT'                   => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->functions = array(
            'hash_pbkdf2'                   => null,
        );
        return $release;
    }
}
