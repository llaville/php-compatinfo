<?php
/**
 * Version informations about memcache extension
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
 * All interfaces, classes, functions, constants about memcache extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.memcache.php
 * @since    Class available since Release 2.1.0
 */
class PHP_CompatInfo_Reference_Memcache
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'memcache';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.0.8';  // 2013-04-07 (beta)

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
        $phpMin = '4.3.11';
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
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '0.2';         // 2004-02-26 (beta)
        $items = array(
            'Memcache'                      => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '3.0.0';       // 2007-11-26 (alpha)
        $items = array(
            'MemcachePool'                  => array('4.3.11', ''),
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
     * @link   http://www.php.net/manual/en/ref.memcache.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.2';         // 2004-02-26 (beta)
        $items = array(
            'memcache_add'                      => array('4.3.3', ''),
            'memcache_connect'                  => array('4.3.3', ''),
            'memcache_debug'                    => array('4.3.3', ''),
            'memcache_decrement'                => array('4.3.3', ''),
            'memcache_delete'                   => array('4.3.3', ''),
            'memcache_get'                      => array('4.3.3', ''),
            'memcache_get_stats'                => array('4.3.3', ''),
            'memcache_get_version'              => array('4.3.3', ''),
            'memcache_increment'                => array('4.3.3', ''),
            'memcache_replace'                  => array('4.3.3', ''),
            'memcache_set'                      => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.4';         // 2004-03-26 (beta)
        $items = array(
            'memcache_close'                    => array('4.3.3', ''),
            'memcache_pconnect'                 => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0';         // 2004-05-21 (beta)
        $items = array(
            'memcache_flush'                    => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0';       // 2005-12-23 (stable)
        $items = array(
            'memcache_add_server'               => array('4.3.3', ''),
            'memcache_get_extended_stats'       => array('4.3.3', ''),
            'memcache_set_compress_threshold'   => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.1.0';       // 2006-10-09 (stable)
        $items = array(
            'memcache_get_server_status'        => array('4.3.3', ''),
            'memcache_set_server_params'        => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.0.0';       // 2007-11-26 (alpha)
        $items = array(
            'memcache_append'                   => array('4.3.11', ''),
            'memcache_cas'                      => array('4.3.11', ''),
            'memcache_prepend'                  => array('4.3.11', ''),
            'memcache_set_failure_callback'     => array('4.3.11', ''),
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
     * @link   http://www.php.net/manual/en/memcache.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.2';         // 2004-02-26 (beta)
        $items = array(
            'MEMCACHE_COMPRESSED'               => array('4.3.3', ''),
            'MEMCACHE_SERIALIZED'               => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $constants);
        $this->setMaxExtensionVersion(
            '0.2', 'MEMCACHE_SERIALIZED', $constants
        );

        $release = '2.2.0';       // 2007-09-21 (stable)
        $items = array(
            'MEMCACHE_HAVE_SESSION'             => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '3.0.8';       // 2013-04-10 (beta)
        $items = array(
            'MEMCACHE_USER1'                    => array('4.3.11', ''),
            'MEMCACHE_USER2'                    => array('4.3.11', ''),
            'MEMCACHE_USER3'                    => array('4.3.11', ''),
            'MEMCACHE_USER4'                    => array('4.3.11', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
