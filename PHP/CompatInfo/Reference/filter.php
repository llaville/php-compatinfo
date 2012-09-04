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
        $phpMin = '5.2.0';
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

        $release = false;
        $items = array(
            'filter_has_var'                 => array('5.2.0', ''),
            'filter_id'                      => array('5.2.0', ''),
            'filter_input'                   => array('5.2.0', ''),
            'filter_input_array'             => array('5.2.0', ''),
            'filter_list'                    => array('5.2.0', ''),
            'filter_var'                     => array('5.2.0', ''),
            'filter_var_array'               => array('5.2.0', ''),
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

        $release = false;
        $items = array(
            'FILTER_CALLBACK'                => array('5.2.0', ''),
            'FILTER_DEFAULT'                 => array('5.2.0', ''),
            'FILTER_FLAG_ALLOW_FRACTION'     => array('5.2.0', ''),
            'FILTER_FLAG_ALLOW_HEX'          => array('5.2.0', ''),
            'FILTER_FLAG_ALLOW_OCTAL'        => array('5.2.0', ''),
            'FILTER_FLAG_ALLOW_SCIENTIFIC'   => array('5.2.0', ''),
            'FILTER_FLAG_ALLOW_THOUSAND'     => array('5.2.0', ''),
            'FILTER_FLAG_EMPTY_STRING_NULL'  => array('5.2.0', ''),
            'FILTER_FLAG_ENCODE_AMP'         => array('5.2.0', ''),
            'FILTER_FLAG_ENCODE_HIGH'        => array('5.2.0', ''),
            'FILTER_FLAG_ENCODE_LOW'         => array('5.2.0', ''),
            'FILTER_FLAG_HOST_REQUIRED'      => array('5.2.0', ''),
            'FILTER_FLAG_IPV4'               => array('5.2.0', ''),
            'FILTER_FLAG_IPV6'               => array('5.2.0', ''),
            'FILTER_FLAG_NONE'               => array('5.2.0', ''),
            'FILTER_FLAG_NO_ENCODE_QUOTES'   => array('5.2.0', ''),
            'FILTER_FLAG_NO_PRIV_RANGE'      => array('5.2.0', ''),
            'FILTER_FLAG_NO_RES_RANGE'       => array('5.2.0', ''),
            'FILTER_FLAG_PATH_REQUIRED'      => array('5.2.0', ''),
            'FILTER_FLAG_QUERY_REQUIRED'     => array('5.2.0', ''),
            'FILTER_FLAG_SCHEME_REQUIRED'    => array('5.2.0', ''),
            'FILTER_FLAG_STRIP_BACKTICK'     => array('5.3.2', ''),
            'FILTER_FLAG_STRIP_HIGH'         => array('5.2.0', ''),
            'FILTER_FLAG_STRIP_LOW'          => array('5.2.0', ''),
            'FILTER_FORCE_ARRAY'             => array('5.2.0', ''),
            'FILTER_NULL_ON_FAILURE'         => array('5.2.0', ''),
            'FILTER_REQUIRE_ARRAY'           => array('5.2.0', ''),
            'FILTER_REQUIRE_SCALAR'          => array('5.2.0', ''),
            'FILTER_SANITIZE_EMAIL'          => array('5.2.0', ''),
            'FILTER_SANITIZE_ENCODED'        => array('5.2.0', ''),
            'FILTER_SANITIZE_FULL_SPECIAL_CHARS'
                                             => array('5.3.3', ''),
            'FILTER_SANITIZE_MAGIC_QUOTES'   => array('5.2.0', ''),
            'FILTER_SANITIZE_NUMBER_FLOAT'   => array('5.2.0', ''),
            'FILTER_SANITIZE_NUMBER_INT'     => array('5.2.0', ''),
            'FILTER_SANITIZE_SPECIAL_CHARS'  => array('5.2.0', ''),
            'FILTER_SANITIZE_STRING'         => array('5.2.0', ''),
            'FILTER_SANITIZE_STRIPPED'       => array('5.2.0', ''),
            'FILTER_SANITIZE_URL'            => array('5.2.0', ''),
            'FILTER_UNSAFE_RAW'              => array('5.2.0', ''),
            'FILTER_VALIDATE_BOOLEAN'        => array('5.2.0', ''),
            'FILTER_VALIDATE_EMAIL'          => array('5.2.0', ''),
            'FILTER_VALIDATE_FLOAT'          => array('5.2.0', ''),
            'FILTER_VALIDATE_INT'            => array('5.2.0', ''),
            'FILTER_VALIDATE_IP'             => array('5.2.0', ''),
            'FILTER_VALIDATE_REGEXP'         => array('5.2.0', ''),
            'FILTER_VALIDATE_URL'            => array('5.2.0', ''),
            'INPUT_COOKIE'                   => array('5.2.0', ''),
            'INPUT_ENV'                      => array('5.2.0', ''),
            'INPUT_GET'                      => array('5.2.0', ''),
            'INPUT_POST'                     => array('5.2.0', ''),
            'INPUT_REQUEST'                  => array('5.2.0', ''),
            'INPUT_SERVER'                   => array('5.2.0', ''),
            'INPUT_SESSION'                  => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
