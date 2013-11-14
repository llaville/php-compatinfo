<?php
/**
 * Version informations about varnish extension
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
 * All interfaces, classes, functions, constants about varnish extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.varnish.php
 * @since    Class available since Release 2.15.0
 */
class PHP_CompatInfo_Reference_Varnish
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'varnish';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.1.1';  // 2013-10-20 (stable)

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
        $phpMin = '5.3.0';
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

        $release = '0.3';         // 2011-08-23 (alpha)
        $items = array(
            'VarnishAdmin'                          => array('5.3.0', ''),
            'VarnishStat'                           => array('5.3.0', ''),
            'VarnishLog'                            => array('5.3.0', ''),
            'VarnishException'                      => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.4';         // 2011-08-26 (alpha)
        $items = array(
            'VarnishLog'                            => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
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
     * @link   http://www.php.net/manual/en/varnish.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.3';         // 2011-08-23 (alpha)
        $items = array(
            // Status/return codes in the varnish CLI protocol
            'VARNISH_STATUS_SYNTAX'                 => array('5.3.0', ''),
            'VARNISH_STATUS_UNKNOWN'                => array('5.3.0', ''),
            'VARNISH_STATUS_UNIMPL'                 => array('5.3.0', ''),
            'VARNISH_STATUS_TOOFEW'                 => array('5.3.0', ''),
            'VARNISH_STATUS_TOOMANY'                => array('5.3.0', ''),
            'VARNISH_STATUS_PARAM'                  => array('5.3.0', ''),
            'VARNISH_STATUS_AUTH'                   => array('5.3.0', ''),
            'VARNISH_STATUS_OK'                     => array('5.3.0', ''),
            'VARNISH_STATUS_CANT'                   => array('5.3.0', ''),
            'VARNISH_STATUS_COMMS'                  => array('5.3.0', ''),
            'VARNISH_STATUS_CLOSE'                  => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.8';         // 2011-09-02 (alpha)
        $items = array(
            'VARNISH_CONFIG_IDENT'                  => array('5.3.0', ''),
            'VARNISH_CONFIG_HOST'                   => array('5.3.0', ''),
            'VARNISH_CONFIG_PORT'                   => array('5.3.0', ''),
            'VARNISH_CONFIG_TIMEOUT'                => array('5.3.0', ''),
            'VARNISH_CONFIG_SECRET'                 => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.9.2';       // 2011-10-06 (beta)
        $items = array(
            'VARNISH_CONFIG_COMPAT'                 => array('5.3.0', ''),
            'VARNISH_COMPAT_2'                      => array('5.3.0', ''),
            'VARNISH_COMPAT_3'                      => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
