<?php
/**
 * Version informations about geoip extension
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
 * All interfaces, classes, functions, constants about geoip extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.geoip.php
 * @since    Class available since Release 2.8.0
 */
class PHP_CompatInfo_Reference_Geoip
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'geoip';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0.8';  // 2011-10-23 (stable)

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
        $phpMin = '4.3.0';
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
     * @link   http://www.php.net/manual/en/ref.geoip.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.2.0';       // 2006-08-22 (beta)
        $items = array(
            'geoip_country_code3_by_name'           => array('4.3.0', ''),
            'geoip_country_code_by_name'            => array('4.3.0', ''),
            'geoip_country_name_by_name'            => array('4.3.0', ''),
            'geoip_database_info'                   => array('4.3.0', ''),
            'geoip_id_by_name'                      => array('4.3.0', ''),
            'geoip_org_by_name'                     => array('4.3.0', ''),
            'geoip_record_by_name'                  => array('4.3.0', ''),
            'geoip_region_by_name'                  => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.1';       // 2007-08-22 (stable)
        $items = array(
            'geoip_db_avail'                        => array('4.3.0', ''),
            'geoip_db_filename'                     => array('4.3.0', ''),
            'geoip_db_get_all_info'                 => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.2';       // 2007-11-20 (stable)
        $items = array(
            'geoip_isp_by_name'                     => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.3';       // 2008-06-12 (stable)
        $items = array(
            'geoip_continent_code_by_name'          => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.5';       // 2008-12-19 (stable)
        $items = array(
            'geoip_region_name_by_code'             => array('4.3.0', ''),
            'geoip_time_zone_by_country_and_region' => array('4.3.0', ''),
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
     * @link   http://www.php.net/manual/en/geoip.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.2.0';       // 2006-08-22 (beta)
        $items = array(
            /* For database type constants */
            'GEOIP_ASNUM_EDITION'                   => array('4.3.0', ''),
            'GEOIP_CITY_EDITION_REV0'               => array('4.3.0', ''),
            'GEOIP_CITY_EDITION_REV1'               => array('4.3.0', ''),
            'GEOIP_COUNTRY_EDITION'                 => array('4.3.0', ''),
            'GEOIP_DOMAIN_EDITION'                  => array('4.3.0', ''),
            'GEOIP_ISP_EDITION'                     => array('4.3.0', ''),
            'GEOIP_NETSPEED_EDITION'                => array('4.3.0', ''),
            'GEOIP_ORG_EDITION'                     => array('4.3.0', ''),
            'GEOIP_PROXY_EDITION'                   => array('4.3.0', ''),
            'GEOIP_REGION_EDITION_REV0'             => array('4.3.0', ''),
            'GEOIP_REGION_EDITION_REV1'             => array('4.3.0', ''),

            /* For netspeed constants */
            'GEOIP_CABLEDSL_SPEED'                  => array('4.3.0', ''),
            'GEOIP_CORPORATE_SPEED'                 => array('4.3.0', ''),
            'GEOIP_DIALUP_SPEED'                    => array('4.3.0', ''),
            'GEOIP_UNKNOWN_SPEED'                   => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
