<?php
/**
 * Version informations about filter extension
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
 * All interfaces, classes, functions, constants about filter extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.filter.php
 */
class PHP_CompatInfo_Reference_Filter implements PHP_CompatInfo_Reference
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
            'filter' => array('5.2.0', '', '0.11.0')
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
     * @link   http://www.php.net/manual/en/ref.filter.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'filter_has_var'                 => array('5.2.0', ''),
                'filter_id'                      => array('5.2.0', ''),
                'filter_input_array'             => array('5.2.0', ''),
                'filter_input'                   => array('5.2.0', ''),
                'filter_list'                    => array('5.2.0', ''),
                'filter_var_array'               => array('5.2.0', ''),
                'filter_var'                     => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/filter.constants.php
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
                'INPUT_POST'                     => array('5.2.0', ''),
                'INPUT_GET'                      => array('5.2.0', ''),
                'INPUT_COOKIE'                   => array('5.2.0', ''),
                'INPUT_ENV'                      => array('5.2.0', ''),
                'INPUT_SERVER'                   => array('5.2.0', ''),
                'INPUT_SESSION'                  => array('5.2.0', ''),
                'INPUT_REQUEST'                  => array('5.2.0', ''),
                'FILTER_FLAG_NONE'               => array('5.2.0', ''),
                'FILTER_REQUIRE_SCALAR'          => array('5.2.0', ''),
                'FILTER_REQUIRE_ARRAY'           => array('5.2.0', ''),
                'FILTER_FORCE_ARRAY'             => array('5.2.0', ''),
                'FILTER_NULL_ON_FAILURE'         => array('5.2.0', ''),
                'FILTER_VALIDATE_INT'            => array('5.2.0', ''),
                'FILTER_VALIDATE_BOOLEAN'        => array('5.2.0', ''),
                'FILTER_VALIDATE_FLOAT'          => array('5.2.0', ''),
                'FILTER_VALIDATE_REGEXP'         => array('5.2.0', ''),
                'FILTER_VALIDATE_URL'            => array('5.2.0', ''),
                'FILTER_VALIDATE_EMAIL'          => array('5.2.0', ''),
                'FILTER_VALIDATE_IP'             => array('5.2.0', ''),
                'FILTER_DEFAULT'                 => array('5.2.0', ''),
                'FILTER_UNSAFE_RAW'              => array('5.2.0', ''),
                'FILTER_SANITIZE_STRING'         => array('5.2.0', ''),
                'FILTER_SANITIZE_STRIPPED'       => array('5.2.0', ''),
                'FILTER_SANITIZE_ENCODED'        => array('5.2.0', ''),
                'FILTER_SANITIZE_SPECIAL_CHARS'  => array('5.2.0', ''),
                'FILTER_SANITIZE_EMAIL'          => array('5.2.0', ''),
                'FILTER_SANITIZE_URL'            => array('5.2.0', ''),
                'FILTER_SANITIZE_NUMBER_INT'     => array('5.2.0', ''),
                'FILTER_SANITIZE_NUMBER_FLOAT'   => array('5.2.0', ''),
                'FILTER_SANITIZE_MAGIC_QUOTES'   => array('5.2.0', ''),
                'FILTER_CALLBACK'                => array('5.2.0', ''),
                'FILTER_FLAG_ALLOW_OCTAL'        => array('5.2.0', ''),
                'FILTER_FLAG_ALLOW_HEX'          => array('5.2.0', ''),
                'FILTER_FLAG_STRIP_LOW'          => array('5.2.0', ''),
                'FILTER_FLAG_STRIP_HIGH'         => array('5.2.0', ''),
                'FILTER_FLAG_STRIP_BACKTICK'     => array('5.2.0', ''),
                'FILTER_FLAG_ENCODE_LOW'         => array('5.2.0', ''),
                'FILTER_FLAG_ENCODE_HIGH'        => array('5.2.0', ''),
                'FILTER_FLAG_ENCODE_AMP'         => array('5.2.0', ''),
                'FILTER_FLAG_NO_ENCODE_QUOTES'   => array('5.2.0', ''),
                'FILTER_FLAG_EMPTY_STRING_NULL'  => array('5.2.0', ''),
                'FILTER_FLAG_ALLOW_FRACTION'     => array('5.2.0', ''),
                'FILTER_FLAG_ALLOW_THOUSAND'     => array('5.2.0', ''),
                'FILTER_FLAG_ALLOW_SCIENTIFIC'   => array('5.2.0', ''),
                'FILTER_FLAG_SCHEME_REQUIRED'    => array('5.2.0', ''),
                'FILTER_FLAG_HOST_REQUIRED'      => array('5.2.0', ''),
                'FILTER_FLAG_PATH_REQUIRED'      => array('5.2.0', ''),
                'FILTER_FLAG_QUERY_REQUIRED'     => array('5.2.0', ''),
                'FILTER_FLAG_IPV4'               => array('5.2.0', ''),
                'FILTER_FLAG_IPV6'               => array('5.2.0', ''),
                'FILTER_FLAG_NO_RES_RANGE'       => array('5.2.0', ''),
                'FILTER_FLAG_NO_PRIV_RANGE'      => array('5.2.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
