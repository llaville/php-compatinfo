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
class PHP_CompatInfo_Reference_Apc
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'apc';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.1.13';

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
            2.0.0 until 2.0.4  PHP 4.0.0 ge
            3.0.0 until 3.0.19 PHP 4.3.0 ge
            since 3.1.1        PHP 5.1.0 ge
         */
        $extver = phpversion(self::REF_NAME);
        if ($extver === false) {
            $extver = self::REF_VERSION;
        }
        // APC 3.1 breaks PHP 4 compatibility
        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.0.0';
        } else {
            $version1 = $extver;
            $version2 = '3.1.0';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '4.3.0' : '5.1.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );

        return $extensions;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter( func_get_args() );

        $classes = array();

        $release = '3.1.1';       // 2008-12-12
        $items = array(
            'APCIterator'               => array('5.0.0', '')
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
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
     * @link   http://www.php.net/manual/en/ref.apc.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter( func_get_args() );

        $functions = array();

        $release = '2.0.0';       // 2003-07-01
        $items = array(
            'apc_cache_info'                    => array('4.0.0', ''),
            'apc_clear_cache'                   => array('4.0.0', ''),
            'apc_sma_info'                      => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.0.0';       // 2005-07-05
        $items = array(
            'apc_define_constants'              => array('4.3.0', ''),
            'apc_delete'                        => array('4.3.0', ''),
            'apc_fetch'                         => array('4.3.0', ''),
            'apc_load_constants'                => array('4.3.0', ''),
            'apc_store'                         => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.0.13';      // 2007-02-24
        $items = array(
            'apc_add'                           => array('4.3.0', ''),
            'apc_compile_file'                  => array('4.3.0', ''),
            // Add optional limited flag
            'apc_sma_info'                      => array('4.3.0', '', '4.3.0'),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.1.1';       // 2008-12-12
        $items = array(
            'apc_cas'                           => array('5.1.0', ''),
            'apc_dec'                           => array('5.1.0', ''),
            'apc_delete_file'                   => array('5.1.0', ''),
            'apc_inc'                           => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.1.4';       // 2010-08-05
        $items = array(
            'apc_bin_dump'                      => array('5.1.0', ''),
            'apc_bin_dumpfile'                  => array('5.1.0', ''),
            'apc_bin_load'                      => array('5.1.0', ''),
            'apc_bin_loadfile'                  => array('5.1.0', ''),
            'apc_exists'                        => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/apc.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter( func_get_args() );

        $constants = array();

        $release = '3.1.1';       // 2008-12-12
        $items = array(
            // Use in APCIterator
            'APC_LIST_ACTIVE'               => array('5.1.0', ''),
            'APC_LIST_DELETED'              => array('5.1.0', ''),
            'APC_ITER_TYPE'                 => array('5.1.0', ''),
            'APC_ITER_KEY'                  => array('5.1.0', ''),
            'APC_ITER_FILENAME'             => array('5.1.0', ''),
            'APC_ITER_DEVICE'               => array('5.1.0', ''),
            'APC_ITER_INODE'                => array('5.1.0', ''),
            'APC_ITER_VALUE'                => array('5.1.0', ''),
            'APC_ITER_MD5'                  => array('5.1.0', ''),
            'APC_ITER_NUM_HITS'             => array('5.1.0', ''),
            'APC_ITER_MTIME'                => array('5.1.0', ''),
            'APC_ITER_CTIME'                => array('5.1.0', ''),
            'APC_ITER_DTIME'                => array('5.1.0', ''),
            'APC_ITER_ATIME'                => array('5.1.0', ''),
            'APC_ITER_REFCOUNT'             => array('5.1.0', ''),
            'APC_ITER_MEM_SIZE'             => array('5.1.0', ''),
            'APC_ITER_TTL'                  => array('5.1.0', ''),
            'APC_ITER_NONE'                 => array('5.1.0', ''),
            'APC_ITER_ALL'                  => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '3.1.4';       // 2010-08-05
        $items = array(
            // use in apc_bin_load*
            'APC_BIN_VERIFY_MD5'            => array('5.1.0', ''),
            'APC_BIN_VERIFY_CRC32'          => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
