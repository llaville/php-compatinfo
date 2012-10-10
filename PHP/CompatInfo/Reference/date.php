<?php
/**
 * Version informations about Date/Time extension
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
 * All interfaces, classes, functions, constants about Date/Time extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.datetime.php
 */
class PHP_CompatInfo_Reference_Date
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'date';

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

        $release = false;
        $items = array(
            'DateInterval'                   => array('5.3.0', ''),
            'DatePeriod'                     => array('5.3.0', ''),
            'DateTime'                       => array('5.2.0', ''),
            'DateTimeZone'                   => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.datetime.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'checkdate'                      => array('4.0.0', ''),
            'date'                           => array('4.0.0', ''),
            'date_add'                       => array('5.3.0', ''),
            'date_create'                    => array('5.2.0', ''),
            'date_create_from_format'        => array('5.3.0', ''),
            'date_date_set'                  => array('5.2.0', ''),
            'date_default_timezone_get'      => array('5.1.0', ''),
            'date_default_timezone_set'      => array('5.1.0', ''),
            'date_diff'                      => array('5.3.0', ''),
            'date_format'                    => array('5.2.0', ''),
            'date_get_last_errors'           => array('5.3.0', ''),
            'date_interval_create_from_date_string'
                                             => array('5.3.0', ''),
            'date_interval_format'           => array('5.3.0', ''),
            'date_isodate_set'               => array('5.2.0', ''),
            'date_modify'                    => array('5.2.0', ''),
            'date_offset_get'                => array('5.2.0', ''),
            'date_parse'                     => array('5.2.0', ''),
            'date_parse_from_format'         => array('5.3.0', ''),
            'date_sub'                       => array('5.3.0', ''),
            'date_sun_info'                  => array('5.1.2', ''),
            'date_sunrise'                   => array('5.0.0', ''),
            'date_sunset'                    => array('5.0.0', ''),
            'date_time_set'                  => array('5.2.0', ''),
            'date_timestamp_get'             => array('5.3.0', ''),
            'date_timestamp_set'             => array('5.3.0', ''),
            'date_timezone_get'              => array('5.2.0', ''),
            'date_timezone_set'              => array('5.2.0', ''),
            'getdate'                        => array('4.0.0', ''),
            'gmdate'                         => array('4.0.0', ''),
            'gmmktime'                       => array('4.0.0', ''),
            'gmstrftime'                     => array('4.0.0', ''),
            'idate'                          => array('5.0.0', ''),
            'localtime'                      => array('4.0.0', ''),
            'mktime'                         => array('4.0.0', ''),
            'strftime'                       => array('4.0.0', ''),
            'strtotime'                      => array('4.0.0', ''),
            'time'                           => array('4.0.0', ''),
            'timezone_abbreviations_list'    => array('5.1.0', ''),
            'timezone_identifiers_list'      => array('5.1.0', ''),
            'timezone_location_get'          => array('5.3.0', ''),
            'timezone_name_from_abbr'        => array('5.1.3', ''),
            'timezone_name_get'              => array('5.1.0', ''),
            'timezone_offset_get'            => array('5.1.0', ''),
            'timezone_open'                  => array('5.1.0', ''),
            'timezone_transitions_get'       => array('5.2.0', ''),
            'timezone_version_get'           => array('5.3.0', ''),
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
     * @link   http://www.php.net/manual/en/datetime.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'DATE_ATOM'                      => array('5.1.1', ''),
            'DATE_COOKIE'                    => array('5.1.1', ''),
            'DATE_ISO8601'                   => array('5.1.1', ''),
            'DATE_RFC1036'                   => array('5.1.1', ''),
            'DATE_RFC1123'                   => array('5.1.1', ''),
            'DATE_RFC2822'                   => array('5.1.1', ''),
            'DATE_RFC3339'                   => array('5.1.3', ''),
            'DATE_RFC822'                    => array('5.1.1', ''),
            'DATE_RFC850'                    => array('5.1.1', ''),
            'DATE_RSS'                       => array('5.1.1', ''),
            'DATE_W3C'                       => array('5.1.1', ''),
            'SUNFUNCS_RET_DOUBLE'            => array('5.1.2', ''),
            'SUNFUNCS_RET_STRING'            => array('5.1.2', ''),
            'SUNFUNCS_RET_TIMESTAMP'         => array('5.1.2', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
