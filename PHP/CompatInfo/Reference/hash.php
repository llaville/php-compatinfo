<?php
/**
 * Version informations about hash extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about hash extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.hash.php
 */
class PHP_CompatInfo_Reference_Hash
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'hash';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0';

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
        /*
            The Hash extension requires no external libraries
            and is enabled by default as of PHP 5.1.2
         */
        if (version_compare(PHP_VERSION, '5.1.2', 'ge')) {
            $extver = PHP_VERSION;
        } else {
            $extver = phpversion(self::REF_NAME);
            if ($extver === false) {
                $extver = self::REF_VERSION;
            }
        }
        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.0.0';
        } else {
            $version1 = $extver;
            $version2 = '5.1.2';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '4.0.0' : '5.1.2';
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
     * @link   http://www.php.net/manual/en/ref.hash.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '1.1';         // 2005-12-07
        $items = array(
            'hash'                           => array('4.0.0', ''),
            'hash_algos'                     => array('4.0.0', ''),
            'hash_file'                      => array('4.0.0', ''),
            'hash_final'                     => array('4.0.0', ''),
            'hash_hmac'                      => array('4.0.0', ''),
            'hash_hmac_file'                 => array('4.0.0', ''),
            'hash_init'                      => array('4.0.0', ''),
            'hash_update'                    => array('4.0.0', ''),
            'hash_update_file'               => array('4.0.0', ''),
            'hash_update_stream'             => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.3.0';       // 2009-06-30
        $items = array(
            'hash_copy'                      => array('5.3.0', ''),

            'mhash'                          => array('5.3.0', ''),
            'mhash_count'                    => array('5.3.0', ''),
            'mhash_get_block_size'           => array('5.3.0', ''),
            'mhash_get_hash_name'            => array('5.3.0', ''),
            'mhash_keygen_s2k'               => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.5.0';       // soon
        $items = array(
            'hash_pbkdf2'                    => array('5.5.0-dev', ''),
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
     * @link   http://www.php.net/manual/en/hash.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '1.1';         // 2005-12-07
        $items = array(
            'HASH_HMAC'                      => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.0';       // 2009-06-30
        $items = array(
            'MHASH_CRC32'                    => array('5.3.0', ''),
            'MHASH_MD5'                      => array('5.3.0', ''),
            'MHASH_SHA1'                     => array('5.3.0', ''),
            'MHASH_HAVAL256'                 => array('5.3.0', ''),
            'MHASH_RIPEMD160'                => array('5.3.0', ''),
            'MHASH_TIGER'                    => array('5.3.0', ''),
            'MHASH_GOST'                     => array('5.3.0', ''),
            'MHASH_CRC32B'                   => array('5.3.0', ''),
            'MHASH_HAVAL224'                 => array('5.3.0', ''),
            'MHASH_HAVAL192'                 => array('5.3.0', ''),
            'MHASH_HAVAL160'                 => array('5.3.0', ''),
            'MHASH_HAVAL128'                 => array('5.3.0', ''),
            'MHASH_TIGER128'                 => array('5.3.0', ''),
            'MHASH_TIGER160'                 => array('5.3.0', ''),
            'MHASH_MD4'                      => array('5.3.0', ''),
            'MHASH_SHA256'                   => array('5.3.0', ''),
            'MHASH_ADLER32'                  => array('5.3.0', ''),
            'MHASH_SHA224'                   => array('5.3.0', ''),
            'MHASH_SHA512'                   => array('5.3.0', ''),
            'MHASH_SHA384'                   => array('5.3.0', ''),
            'MHASH_WHIRLPOOL'                => array('5.3.0', ''),
            'MHASH_RIPEMD128'                => array('5.3.0', ''),
            'MHASH_RIPEMD256'                => array('5.3.0', ''),
            'MHASH_RIPEMD320'                => array('5.3.0', ''),
            'MHASH_SNEFRU256'                => array('5.3.0', ''),
            'MHASH_MD2'                      => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.4.0';       // 2012-03-01
        $items = array(
            'MHASH_FNV132'                   => array('5.4.0', ''),
            'MHASH_FNV1A32'                  => array('5.4.0', ''),
            'MHASH_FNV164'                   => array('5.4.0', ''),
            'MHASH_FNV1A64'                  => array('5.4.0', ''),
            'MHASH_JOAAT'                    => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
