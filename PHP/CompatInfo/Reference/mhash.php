<?php
/**
 * Version informations about mhash extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about mhash extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mhash.php
 */
class PHP_CompatInfo_Reference_Mhash implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'mhash' => array('4.0.0', '5.3.0', '')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.mhash.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'mhash_count'           => array('4.0.0', '5.3.0'),
                'mhash_get_block_size'  => array('4.0.0', '5.3.0'),
                'mhash_get_hash_name'   => array('4.0.0', '5.3.0'),
                'mhash_keygen_s2k'      => array('4.0.4', '5.3.0'),
                'mhash'                 => array('4.0.0', '5.3.0'),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/fr/mhash.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'MHASH_ADLER32'         => array('4.0.0', '5.3.0'),
                'MHASH_CRC32'           => array('4.0.0', '5.3.0'),
                'MHASH_CRC32B'          => array('4.0.0', '5.3.0'),
                'MHASH_GOST'            => array('4.0.0', '5.3.0'),
                'MHASH_HAVAL128'        => array('4.0.0', '5.3.0'),
                'MHASH_HAVAL160'        => array('4.0.0', '5.3.0'),
                'MHASH_HAVAL192'        => array('4.0.0', '5.3.0'),
                'MHASH_HAVAL224'        => array('4.0.0', '5.3.0'),
                'MHASH_HAVAL256'        => array('4.0.0', '5.3.0'),
                'MHASH_MD2'             => array('4.0.0', '5.3.0'),
                'MHASH_MD4'             => array('4.0.0', '5.3.0'),
                'MHASH_MD5'             => array('4.0.0', '5.3.0'),
                'MHASH_RIPEMD128'       => array('4.0.0', '5.3.0'),
                'MHASH_RIPEMD160'       => array('4.0.0', '5.3.0'),
                'MHASH_RIPEMD256'       => array('4.0.0', '5.3.0'),
                'MHASH_RIPEMD320'       => array('4.0.0', '5.3.0'),
                'MHASH_SHA1'            => array('4.0.0', '5.3.0'),
                'MHASH_SHA224'          => array('4.0.0', '5.3.0'),
                'MHASH_SHA256'          => array('4.0.0', '5.3.0'),
                'MHASH_SHA384'          => array('4.0.0', '5.3.0'),
                'MHASH_SHA512'          => array('4.0.0', '5.3.0'),
                'MHASH_SNEFRU128'       => array('4.0.0', '5.3.0'),
                'MHASH_SNEFRU256'       => array('4.0.0', '5.3.0'),
                'MHASH_TIGER'           => array('4.0.0', '5.3.0'),
                'MHASH_TIGER128'        => array('4.0.0', '5.3.0'),
                'MHASH_TIGER160'        => array('4.0.0', '5.3.0'),
                'MHASH_WHIRLPOOL'       => array('4.0.0', '5.3.0'),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
