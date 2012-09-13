<?php
/**
 * Version informations about calendar extension
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
 * All interfaces, classes, functions, constants about calendar extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.calendar.php
 */
class PHP_CompatInfo_Reference_Calendar
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'calendar';

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
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.calendar.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'cal_days_in_month'              => array('4.0.7', ''),
            'cal_from_jd'                    => array('4.0.7', ''),
            'cal_info'                       => array('4.0.7', ''),
            'cal_to_jd'                      => array('4.0.7', ''),
            'easter_date'                    => array('4.0.0', ''),
            'easter_days'                    => array('4.0.0', ''),
            'frenchtojd'                     => array('4.0.0', ''),
            'gregoriantojd'                  => array('4.0.0', ''),
            'jddayofweek'                    => array('4.0.0', ''),
            'jdmonthname'                    => array('4.0.0', ''),
            'jdtofrench'                     => array('4.0.0', ''),
            'jdtogregorian'                  => array('4.0.0', ''),
            'jdtojewish'                     => array('4.0.0', '', '4.0.0, 4.3.0, 5.0.0'),
            'jdtojulian'                     => array('4.0.0', ''),
            'jdtounix'                       => array('4.0.0', ''),
            'jewishtojd'                     => array('4.0.0', ''),
            'juliantojd'                     => array('4.0.0', ''),
            'unixtojd'                       => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/calendar.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'CAL_GREGORIAN'                  => array('4.0.0', ''),
            'CAL_JULIAN'                     => array('4.0.0', ''),
            'CAL_JEWISH'                     => array('4.0.0', ''),
            'CAL_FRENCH'                     => array('4.0.0', ''),
            'CAL_NUM_CALS'                   => array('4.0.0', ''),
            'CAL_DOW_DAYNO'                  => array('4.0.0', ''),
            'CAL_DOW_SHORT'                  => array('4.0.0', ''),
            'CAL_DOW_LONG'                   => array('4.0.0', ''),
            'CAL_MONTH_GREGORIAN_SHORT'      => array('4.0.0', ''),
            'CAL_MONTH_GREGORIAN_LONG'       => array('4.0.0', ''),
            'CAL_MONTH_JULIAN_SHORT'         => array('4.0.0', ''),
            'CAL_MONTH_JULIAN_LONG'          => array('4.0.0', ''),
            'CAL_MONTH_JEWISH'               => array('4.0.0', ''),
            'CAL_MONTH_FRENCH'               => array('4.0.0', ''),
            'CAL_EASTER_DEFAULT'             => array('4.3.0', ''),
            'CAL_EASTER_ROMAN'               => array('4.3.0', ''),
            'CAL_EASTER_ALWAYS_GREGORIAN'    => array('4.3.0', ''),
            'CAL_EASTER_ALWAYS_JULIAN'       => array('4.3.0', ''),
            'CAL_JEWISH_ADD_ALAFIM_GERESH'   => array('5.0.0', ''),
            'CAL_JEWISH_ADD_ALAFIM'          => array('5.0.0', ''),
            'CAL_JEWISH_ADD_GERESHAYIM'      => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
