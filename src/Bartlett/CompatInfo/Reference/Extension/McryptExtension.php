<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class McryptExtension extends AbstractReference
{
    const REF_NAME    = 'mcrypt';
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

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $this->storage->attach($release);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
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
        $release->iniEntries = array(
            'mcrypt.algorithms_dir'         => null,
            'mcrypt.modes_dir'              => null,
        );
        $release->functions = array(
            'mcrypt_cbc'                    => null,
            'mcrypt_cfb'                    => null,
            'mcrypt_create_iv'              => null,
            'mcrypt_ecb'                    => null,
            'mcrypt_get_block_size'         => null,
            'mcrypt_get_cipher_name'        => null,
            'mcrypt_get_key_size'           => null,
            'mcrypt_ofb'                    => null,
        );
        $release->constants = array(
            'MCRYPT_3DES'                   => null,
            'MCRYPT_ARCFOUR'                => null,
            'MCRYPT_ARCFOUR_IV'             => null,
            'MCRYPT_BLOWFISH'               => null,
            'MCRYPT_CAST_128'               => null,
            'MCRYPT_CAST_256'               => null,
            'MCRYPT_CRYPT'                  => null,
            'MCRYPT_DECRYPT'                => null,
            'MCRYPT_DES'                    => null,
            'MCRYPT_DES_COMPAT'             => null,
            'MCRYPT_DEV_RANDOM'             => null,
            'MCRYPT_DEV_URANDOM'            => null,
            'MCRYPT_ENCRYPT'                => null,
            'MCRYPT_ENIGNA'                 => null,
            'MCRYPT_GOST'                   => null,
            'MCRYPT_IDEA'                   => null,
            'MCRYPT_LOKI97'                 => null,
            'MCRYPT_MARS'                   => null,
            'MCRYPT_MODE_CBC'               => null,
            'MCRYPT_MODE_CFB'               => null,
            'MCRYPT_MODE_ECB'               => null,
            'MCRYPT_MODE_NOFB'              => null,
            'MCRYPT_MODE_OFB'               => null,
            'MCRYPT_MODE_STREAM'            => null,
            'MCRYPT_PANAMA'                 => null,
            'MCRYPT_RAND'                   => null,
            'MCRYPT_RC2'                    => null,
            'MCRYPT_RC4'                    => null,
            'MCRYPT_RC6'                    => null,
            'MCRYPT_RC6_128'                => null,
            'MCRYPT_RC6_192'                => null,
            'MCRYPT_RC6_256'                => null,
            'MCRYPT_RIJNDAEL_128'           => null,
            'MCRYPT_RIJNDAEL_192'           => null,
            'MCRYPT_RIJNDAEL_256'           => null,
            'MCRYPT_SAFER128'               => null,
            'MCRYPT_SAFER64'                => null,
            'MCRYPT_SAFERPLUS'              => null,
            'MCRYPT_SERPENT'                => null,
            'MCRYPT_SERPENT_128'            => null,
            'MCRYPT_SERPENT_192'            => null,
            'MCRYPT_SERPENT_256'            => null,
            'MCRYPT_SKIPJACK'               => null,
            'MCRYPT_TEAN'                   => null,
            'MCRYPT_THREEWAY'               => null,
            'MCRYPT_TRIPLEDES'              => null,
            'MCRYPT_TWOFISH'                => null,
            'MCRYPT_TWOFISH128'             => null,
            'MCRYPT_TWOFISH192'             => null,
            'MCRYPT_TWOFISH256'             => null,
            'MCRYPT_WAKE'                   => null,
            'MCRYPT_XTEA'                   => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'mcrypt_decrypt'                        => null,
            'mcrypt_enc_get_algorithms_name'        => null,
            'mcrypt_enc_get_block_size'             => null,
            'mcrypt_enc_get_iv_size'                => null,
            'mcrypt_enc_get_key_size'               => null,
            'mcrypt_enc_get_modes_name'             => null,
            'mcrypt_enc_get_supported_key_sizes'    => null,
            'mcrypt_enc_is_block_algorithm'         => null,
            'mcrypt_enc_is_block_algorithm_mode'    => null,
            'mcrypt_enc_is_block_mode'              => null,
            'mcrypt_enc_self_test'                  => null,
            'mcrypt_encrypt'                        => null,
            'mcrypt_generic'                        => null,
            'mcrypt_generic_end'                    => null,
            'mcrypt_generic_init'                   => null,
            'mcrypt_get_iv_size'                    => null,
            'mcrypt_list_algorithms'                => null,
            'mcrypt_list_modes'                     => null,
            'mcrypt_module_close'                   => null,
            'mcrypt_module_get_algo_block_size'     => null,
            'mcrypt_module_get_algo_key_size'       => null,
            'mcrypt_module_get_supported_key_sizes' => null,
            'mcrypt_module_is_block_algorithm'      => null,
            'mcrypt_module_is_block_algorithm_mode' => null,
            'mcrypt_module_is_block_mode'           => null,
            'mcrypt_module_open'                    => null,
            'mcrypt_module_self_test'               => null,
            'mdecrypt_generic'                      => null,
        );
        return $release;
    }

    protected function getR40007()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.0.7',
            'php.max' => '',
        );
        $release->functions = array(
            'mcrypt_generic_deinit'         => null,
        );
        return $release;
    }
}
