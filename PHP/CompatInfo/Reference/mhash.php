<?php
/**
 * Version informations about mhash extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about mhash extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mhash.php
 */
class PHP_CompatInfo_Reference_Mhash
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mhash';

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
        // emulated in hash extension since 5.3.0
        $phpMin = '4.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, self::LATEST_PHP_5_2, self::REF_VERSION)
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
     * @link   http://www.php.net/manual/en/ref.mhash.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'mhash'                 => array('4.0.0', ''),
            'mhash_count'           => array('4.0.0', ''),
            'mhash_get_block_size'  => array('4.0.0', ''),
            'mhash_get_hash_name'   => array('4.0.0', ''),
            'mhash_keygen_s2k'      => array('4.0.4', ''),
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
     * @link   http://www.php.net/manual/en/mhash.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'MHASH_ADLER32'         => array('4.0.0', ''),
            'MHASH_CRC32'           => array('4.0.0', ''),
            'MHASH_CRC32B'          => array('4.0.0', ''),
            'MHASH_GOST'            => array('4.0.0', ''),
            'MHASH_HAVAL128'        => array('4.0.0', ''),
            'MHASH_HAVAL160'        => array('4.0.0', ''),
            'MHASH_HAVAL192'        => array('4.0.0', ''),
            'MHASH_HAVAL224'        => array('4.0.0', ''),
            'MHASH_HAVAL256'        => array('4.0.0', ''),
            'MHASH_MD2'             => array('4.0.0', ''),
            'MHASH_MD4'             => array('4.0.0', ''),
            'MHASH_MD5'             => array('4.0.0', ''),
            'MHASH_RIPEMD128'       => array('4.0.0', ''),
            'MHASH_RIPEMD160'       => array('4.0.0', ''),
            'MHASH_RIPEMD256'       => array('4.0.0', ''),
            'MHASH_RIPEMD320'       => array('4.0.0', ''),
            'MHASH_SHA1'            => array('4.0.0', ''),
            'MHASH_SHA224'          => array('4.0.0', ''),
            'MHASH_SHA256'          => array('4.0.0', ''),
            'MHASH_SHA384'          => array('4.0.0', ''),
            'MHASH_SHA512'          => array('4.0.0', ''),
            'MHASH_SNEFRU128'       => array('4.0.0', ''),
            'MHASH_SNEFRU256'       => array('4.0.0', ''),
            'MHASH_TIGER'           => array('4.0.0', ''),
            'MHASH_TIGER128'        => array('4.0.0', ''),
            'MHASH_TIGER160'        => array('4.0.0', ''),
            'MHASH_WHIRLPOOL'       => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
