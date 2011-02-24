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
class PHP_CompatInfo_Reference_Calendar implements PHP_CompatInfo_Reference
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
            'calendar' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.calendar.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
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
                'jdtojewish'                     => array('4.0.0', ''),
                'jdtojulian'                     => array('4.0.0', ''),
                'jdtounix'                       => array('4.0.0', ''),
                'jewishtojd'                     => array('4.0.0', ''),
                'juliantojd'                     => array('4.0.0', ''),
                'unixtojd'                       => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/calendar.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
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
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'CAL_JEWISH_ADD_ALAFIM_GERESH'   => array('5.0.0', ''),
                'CAL_JEWISH_ADD_ALAFIM'          => array('5.0.0', ''),
                'CAL_JEWISH_ADD_GERESHAYIM'      => array('5.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
