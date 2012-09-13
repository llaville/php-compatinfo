<?php
/**
 * Version informations about mcrypt extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about mcrypt extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mcrypt.php
 */
class PHP_CompatInfo_Reference_Mcrypt
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mcrypt';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        $phpMin = '4.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.mcrypt.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'mcrypt_cbc'                            => array('4.0.0', ''),
            'mcrypt_cfb'                            => array('4.0.0', ''),
            'mcrypt_create_iv'                      => array('4.0.0', ''),
            'mcrypt_decrypt'                        => array('4.0.2', ''),
            'mcrypt_ecb'                            => array('4.0.0', ''),
            'mcrypt_enc_get_algorithms_name'        => array('4.0.2', ''),
            'mcrypt_enc_get_block_size'             => array('4.0.2', ''),
            'mcrypt_enc_get_iv_size'                => array('4.0.2', ''),
            'mcrypt_enc_get_key_size'               => array('4.0.2', ''),
            'mcrypt_enc_get_modes_name'             => array('4.0.2', ''),
            'mcrypt_enc_get_supported_key_sizes'    => array('4.0.2', ''),
            'mcrypt_enc_is_block_algorithm'         => array('4.0.2', ''),
            'mcrypt_enc_is_block_algorithm_mode'    => array('4.0.2', ''),
            'mcrypt_enc_is_block_mode'              => array('4.0.2', ''),
            'mcrypt_enc_self_test'                  => array('4.0.2', ''),
            'mcrypt_encrypt'                        => array('4.0.2', ''),
            'mcrypt_generic'                        => array('4.0.2', ''),
            'mcrypt_generic_deinit'                 => array('4.0.7', ''),
            'mcrypt_generic_end'                    => array('4.0.2', ''),
            'mcrypt_generic_init'                   => array('4.0.2', ''),
            'mcrypt_get_block_size'                 => array('4.0.0', ''),
            'mcrypt_get_cipher_name'                => array('4.0.0', ''),
            'mcrypt_get_iv_size'                    => array('4.0.2', ''),
            'mcrypt_get_key_size'                   => array('4.0.0', ''),
            'mcrypt_list_algorithms'                => array('4.0.2', ''),
            'mcrypt_list_modes'                     => array('4.0.2', ''),
            'mcrypt_module_close'                   => array('4.0.2', ''),
            'mcrypt_module_get_algo_block_size'     => array('4.0.2', ''),
            'mcrypt_module_get_algo_key_size'       => array('4.0.2', ''),
            'mcrypt_module_get_supported_key_sizes' => array('4.0.2', ''),
            'mcrypt_module_is_block_algorithm'      => array('4.0.2', ''),
            'mcrypt_module_is_block_algorithm_mode' => array('4.0.2', ''),
            'mcrypt_module_is_block_mode'           => array('4.0.2', ''),
            'mcrypt_module_open'                    => array('4.0.2', ''),
            'mcrypt_module_self_test'               => array('4.0.2', ''),
            'mcrypt_ofb'                            => array('4.0.0', ''),
            'mdecrypt_generic'                      => array('4.0.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/mcrypt.constants.php
     * @link   http://www.php.net/manual/en/mcrypt.ciphers.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'MCRYPT_3DES'             => array('4.0.0', ''),
            'MCRYPT_ARCFOUR'          => array('4.0.0', ''),
            'MCRYPT_ARCFOUR_IV'       => array('4.0.0', ''),
            'MCRYPT_BLOWFISH'         => array('4.0.0', ''),
            'MCRYPT_CAST_128'         => array('4.0.0', ''),
            'MCRYPT_CAST_256'         => array('4.0.0', ''),
            'MCRYPT_CRYPT'            => array('4.0.0', ''),
            'MCRYPT_DECRYPT'          => array('4.0.0', ''),
            'MCRYPT_DES'              => array('4.0.0', ''),
            'MCRYPT_DES_COMPAT'       => array('4.0.0', ''),
            'MCRYPT_DEV_RANDOM'       => array('4.0.0', ''),
            'MCRYPT_DEV_URANDOM'      => array('4.0.0', ''),
            'MCRYPT_ENCRYPT'          => array('4.0.0', ''),
            'MCRYPT_ENIGNA'           => array('4.0.0', ''),
            'MCRYPT_GOST'             => array('4.0.0', ''),
            'MCRYPT_IDEA'             => array('4.0.0', ''),
            'MCRYPT_LOKI97'           => array('4.0.0', ''),
            'MCRYPT_MARS'             => array('4.0.0', ''),
            'MCRYPT_MODE_CBC'         => array('4.0.0', ''),
            'MCRYPT_MODE_CFB'         => array('4.0.0', ''),
            'MCRYPT_MODE_ECB'         => array('4.0.0', ''),
            'MCRYPT_MODE_NOFB'        => array('4.0.0', ''),
            'MCRYPT_MODE_OFB'         => array('4.0.0', ''),
            'MCRYPT_MODE_STREAM'      => array('4.0.0', ''),
            'MCRYPT_PANAMA'           => array('4.0.0', ''),
            'MCRYPT_RAND'             => array('4.0.0', ''),
            'MCRYPT_RC2'              => array('4.0.0', ''),
            'MCRYPT_RC4'              => array('4.0.0', ''),
            'MCRYPT_RC6'              => array('4.0.0', ''),
            'MCRYPT_RC6_128'          => array('4.0.0', ''),
            'MCRYPT_RC6_192'          => array('4.0.0', ''),
            'MCRYPT_RC6_256'          => array('4.0.0', ''),
            'MCRYPT_RIJNDAEL_128'     => array('4.0.0', ''),
            'MCRYPT_RIJNDAEL_192'     => array('4.0.0', ''),
            'MCRYPT_RIJNDAEL_256'     => array('4.0.0', ''),
            'MCRYPT_SAFER128'         => array('4.0.0', ''),
            'MCRYPT_SAFER64'          => array('4.0.0', ''),
            'MCRYPT_SAFERPLUS'        => array('4.0.0', ''),
            'MCRYPT_SERPENT'          => array('4.0.0', ''),
            'MCRYPT_SERPENT_128'      => array('4.0.0', ''),
            'MCRYPT_SERPENT_192'      => array('4.0.0', ''),
            'MCRYPT_SERPENT_256'      => array('4.0.0', ''),
            'MCRYPT_SKIPJACK'         => array('4.0.0', ''),
            'MCRYPT_TEAN'             => array('4.0.0', ''),
            'MCRYPT_THREEWAY'         => array('4.0.0', ''),
            'MCRYPT_TRIPLEDES'        => array('4.0.0', ''),
            'MCRYPT_TWOFISH'          => array('4.0.0', ''),
            'MCRYPT_TWOFISH128'       => array('4.0.0', ''),
            'MCRYPT_TWOFISH192'       => array('4.0.0', ''),
            'MCRYPT_TWOFISH256'       => array('4.0.0', ''),
            'MCRYPT_WAKE'             => array('4.0.0', ''),
            'MCRYPT_XTEA'             => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
