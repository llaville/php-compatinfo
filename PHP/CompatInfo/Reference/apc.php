<?php
/**
 * Version informations about apc extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about apc extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.apc.php
 */
class PHP_CompatInfo_Reference_Apc implements PHP_CompatInfo_Reference
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
            'apc' => array('4.0.0', '', '3.1.7')
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
                // APC >= 3.1.1
                'APCIterator'               => array('5.0.0', '')
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
     * @link   http://www.php.net/manual/en/ref.apc.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                // APC >= 2.0
                'apc_cache_info'                    => array('4.0.0', ''),
                'apc_clear_cache'                   => array('4.0.0', ''),
                'apc_sma_info'                      => array('4.0.0', ''),

                // APC >= 3.0.0
                'apc_define_constants'              => array('4.0.0', ''),
                'apc_delete'                        => array('4.0.0', ''),
                'apc_fetch'                         => array('4.0.0', ''),
                'apc_load_constants'                => array('4.0.0', ''),
                'apc_store'                         => array('4.0.0', ''),

                // APC >= 3.0.13
                'apc_add'                           => array('4.0.0', ''),
                'apc_compile_file'                  => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                // APC 3.1 breaks PHP 4 compatibility
                // APC >= 3.1.1
                'apc_cas'                           => array('5.0.0', ''),
                'apc_dec'                           => array('5.0.0', ''),
                'apc_delete_file'                   => array('5.0.0', ''),
                'apc_inc'                           => array('5.0.0', ''),

                // APC >= 3.1.4
                'apc_bin_dump'                      => array('5.0.0', ''),
                'apc_bin_dumpfile'                  => array('5.0.0', ''),
                'apc_bin_load'                      => array('5.0.0', ''),
                'apc_bin_loadfile'                  => array('5.0.0', ''),
                'apc_exists'                        => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/apc.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                // Use in APCIterator
                'APC_LIST_ACTIVE'               => array('5.0.0', ''),
                'APC_LIST_DELETED'              => array('5.0.0', ''),
                'APC_ITER_TYPE'                 => array('5.0.0', ''),
                'APC_ITER_KEY'                  => array('5.0.0', ''),
                'APC_ITER_FILENAME'             => array('5.0.0', ''),
                'APC_ITER_DEVICE'               => array('5.0.0', ''),
                'APC_ITER_INODE'                => array('5.0.0', ''),
                'APC_ITER_VALUE'                => array('5.0.0', ''),
                'APC_ITER_MD5'                  => array('5.0.0', ''),
                'APC_ITER_NUM_HITS'             => array('5.0.0', ''),
                'APC_ITER_MTIME'                => array('5.0.0', ''),
                'APC_ITER_CTIME'                => array('5.0.0', ''),
                'APC_ITER_DTIME'                => array('5.0.0', ''),
                'APC_ITER_ATIME'                => array('5.0.0', ''),
                'APC_ITER_REFCOUNT'             => array('5.0.0', ''),
                'APC_ITER_MEM_SIZE'             => array('5.0.0', ''),
                'APC_ITER_TTL'                  => array('5.0.0', ''),
                'APC_ITER_NONE'                 => array('5.0.0', ''),
                'APC_ITER_ALL'                  => array('5.0.0', ''),
                // use in apc_bin_load*
                'APC_BIN_VERIFY_MD5'            => array('5.0.0', ''),
                'APC_BIN_VERIFY_CRC32'          => array('5.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
