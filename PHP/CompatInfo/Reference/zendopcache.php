<?php
/**
 * Version informations about Zend OPcache extension
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
 * All interfaces, classes, functions, constants about Zend OPcache extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.15.0
 */
class PHP_CompatInfo_Reference_Zend_OPcache
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'Zend OPcache';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '7.0.1';

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
        $extensions = array(
            self::REF_NAME => array('5.2.0', '', self::REF_VERSION)
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
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter( func_get_args() );

        $functions = array();

        // We forget version 7.0.0 (and previous non-free versions)
        // published as Zend Optimiser+
        // 7.0.1 is the first version named Zend OPcache

        $release = '7.0.1';       // 2013-03-25
        $items = array(
            'opcache_reset'                    => array('5.2.0', ''),
            'opcache_get_configuration'        => array('5.2.0', ''),
            'opcache_get_status'               => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }
}
