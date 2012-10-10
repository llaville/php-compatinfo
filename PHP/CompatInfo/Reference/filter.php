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
 * @version  GIT: $Id$
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
class PHP_CompatInfo_Reference_Filter
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'filter';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.11.0';

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
            0.9.0 until 0.10.0  PHP 4.0.0 ge
            since 0.11.0        PHP 5.0.0 ge
         */
        $extver = phpversion(self::REF_NAME);
        if ($extver === false) {
            $extver = self::REF_VERSION;
        }
        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.0.0';
        } else {
            $version1 = $extver;
            $version2 = '0.11.0';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '4.0.0' : '5.0.0';
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
     * @link   http://www.php.net/manual/en/ref.filter.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.9.0';       // 2005-10-05
        $items = array(
            'input_get'                 => array('4.0.0', ''),
            'input_filters_list'        => array('4.0.0', ''),
            'input_has_variable'        => array('4.0.0', ''),
            'filter_data'               => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);
        // filter 0.11.0 API was rewamped
        foreach (array_keys($items) as $func) {
            $this->setMaxExtensionVersion(
                '0.10.0', $func, $functions
            );
        }

        $release = '0.9.2';       // 2005-10-27
        $items = array(
            'input_name_to_filter'      => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);
        // filter 0.11.0 API was rewamped
        $this->setMaxExtensionVersion(
            '0.10.0', 'input_name_to_filter', $functions
        );

        $release = '0.10.0';      // 2006-08-31
        $items = array(
            'input_get_args'            => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);
        // filter 0.11.0 API was rewamped
        $this->setMaxExtensionVersion(
            '0.10.0', 'input_get_args', $functions
        );

        /*
            This release contains BC breaks, the API has been rewamped
          */
        $release = '0.11.0';      // 2006-10-31
        $items = array(
            'filter_has_var'            => array('5.0.0', ''),
            'filter_id'                 => array('5.0.0', ''),
            'filter_input'              => array('5.0.0', ''),
            'filter_input_array'        => array('5.0.0', ''),
            'filter_list'               => array('5.0.0', ''),
            'filter_var'                => array('5.0.0', ''),
            'filter_var_array'          => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/filter.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.9.0';       // 2005-10-05
        $items = array(
            'FILTER_FLAG_ALLOW_FRACTION'            => array('4.0.0', ''),
            'FILTER_FLAG_ALLOW_HEX'                 => array('4.0.0', ''),
            'FILTER_FLAG_ALLOW_OCTAL'               => array('4.0.0', ''),
            'FILTER_FLAG_ALLOW_SCIENTIFIC'          => array('4.0.0', ''),
            'FILTER_FLAG_ALLOW_THOUSAND'            => array('4.0.0', ''),
            'FILTER_FLAG_EMPTY_STRING_NULL'         => array('4.0.0', ''),
            'FILTER_FLAG_ENCODE_AMP'                => array('4.0.0', ''),
            'FILTER_FLAG_ENCODE_HIGH'               => array('4.0.0', ''),
            'FILTER_FLAG_ENCODE_LOW'                => array('4.0.0', ''),
            'FILTER_FLAG_HOST_REQUIRED'             => array('4.0.0', ''),
            'FILTER_FLAG_IPV4'                      => array('4.0.0', ''),
            'FILTER_FLAG_IPV6'                      => array('4.0.0', ''),
            'FILTER_FLAG_NONE'                      => array('4.0.0', ''),
            'FILTER_FLAG_NO_ENCODE_QUOTES'          => array('4.0.0', ''),
            'FILTER_FLAG_NO_PRIV_RANGE'             => array('4.0.0', ''),
            'FILTER_FLAG_NO_RES_RANGE'              => array('4.0.0', ''),
            'FILTER_FLAG_PATH_REQUIRED'             => array('4.0.0', ''),
            'FILTER_FLAG_QUERY_REQUIRED'            => array('4.0.0', ''),
            'FILTER_FLAG_SCHEME_REQUIRED'           => array('4.0.0', ''),
            'FILTER_FLAG_STRIP_HIGH'                => array('4.0.0', ''),
            'FILTER_FLAG_STRIP_LOW'                 => array('4.0.0', ''),

            'INPUT_COOKIE'                          => array('4.0.0', ''),
            'INPUT_ENV'                             => array('4.0.0', ''),
            'INPUT_GET'                             => array('4.0.0', ''),
            'INPUT_POST'                            => array('4.0.0', ''),
            'INPUT_SERVER'                          => array('4.0.0', ''),
            'INPUT_SESSION'                         => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.9.4';       // 2006-01-23
        $items = array(
            'FILTER_CALLBACK'                       => array('4.0.0', ''),
            'FILTER_DEFAULT'                        => array('4.0.0', ''),
            'FILTER_SANITIZE_ALL'                   => array('4.0.0', ''),
            'FILTER_SANITIZE_EMAIL'                 => array('4.0.0', ''),
            'FILTER_SANITIZE_ENCODED'               => array('4.0.0', ''),
            'FILTER_SANITIZE_MAGIC_QUOTES'          => array('4.0.0', ''),
            'FILTER_SANITIZE_NUMBER_FLOAT'          => array('4.0.0', ''),
            'FILTER_SANITIZE_NUMBER_INT'            => array('4.0.0', ''),
            'FILTER_SANITIZE_SPECIAL_CHARS'         => array('4.0.0', ''),
            'FILTER_SANITIZE_STRING'                => array('4.0.0', ''),
            'FILTER_SANITIZE_STRIPPED'              => array('4.0.0', ''),
            'FILTER_SANITIZE_URL'                   => array('4.0.0', ''),
            'FILTER_UNSAFE_RAW'                     => array('4.0.0', ''),
            'FILTER_VALIDATE_ALL'                   => array('4.0.0', ''),
            'FILTER_VALIDATE_BOOLEAN'               => array('4.0.0', ''),
            'FILTER_VALIDATE_EMAIL'                 => array('4.0.0', ''),
            'FILTER_VALIDATE_FLOAT'                 => array('4.0.0', ''),
            'FILTER_VALIDATE_INT'                   => array('4.0.0', ''),
            'FILTER_VALIDATE_IP'                    => array('4.0.0', ''),
            'FILTER_VALIDATE_REGEXP'                => array('4.0.0', ''),
            'FILTER_VALIDATE_URL'                   => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.10.0';      // 2006-08-31
        $items = array(
            'FILTER_FLAG_ARRAY'                     => array('5.0.0', ''),
            'FILTER_FLAG_SCALAR'                    => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);
        // renamed in filter 0.11.0
        $this->setMaxExtensionVersion(
            '0.10.0', 'FILTER_FLAG_ARRAY', $constants
        );
        $this->setMaxExtensionVersion(
            '0.10.0', 'FILTER_FLAG_SCALAR', $constants
        );

        $release = '0.11.0';      // 2006-10-31
        $items = array(
            'FILTER_REQUIRE_ARRAY'                  => array('5.0.0', ''),
            'FILTER_REQUIRE_SCALAR'                 => array('5.0.0', ''),
            'FILTER_FORCE_ARRAY'                    => array('5.0.0', ''),
            'FILTER_NULL_ON_FAILURE'                => array('5.0.0', ''),

            'INPUT_REQUEST'                         => array('5.0.0', ''),

            /*
                additional adds after PECL release 0.11.0
             */
            // 2009-12-07
            'FILTER_FLAG_STRIP_BACKTICK'            => array('5.3.2', ''),
            // 2010-03-31
            'FILTER_SANITIZE_FULL_SPECIAL_CHARS'    => array('5.3.3', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
