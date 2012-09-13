<?php
/**
 * Version informations about json extension
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
 * All interfaces, classes, functions, constants about json extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.json.php
 */
class PHP_CompatInfo_Reference_Json
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'json';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.2.1';

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
     * Gets informations about interfaces
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $interfaces = array();

        $release = false;
        $items = array(
            'JsonSerializable'               => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $interfaces);

        return $interfaces;
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
     * @link   http://www.php.net/manual/en/ref.json.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'json_decode'                    => array('5.2.0', '', '5.2.0, 5.2.0, 5.3.0, 5.4.0'),
            'json_encode'                    => array('5.2.0', ''),
            'json_last_error'                => array('5.3.0', ''),
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
     * @link   http://www.php.net/manual/en/json.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'JSON_BIGINT_AS_STRING'          => array('5.4.0', ''),
            'JSON_ERROR_CTRL_CHAR'           => array('5.3.0', ''),
            'JSON_ERROR_DEPTH'               => array('5.3.0', ''),
            'JSON_ERROR_NONE'                => array('5.3.0', ''),
            'JSON_ERROR_STATE_MISMATCH'      => array('5.3.0', ''),
            'JSON_ERROR_SYNTAX'              => array('5.3.0', ''),
            'JSON_ERROR_UTF8'                => array('5.3.3', ''),
            'JSON_FORCE_OBJECT'              => array('5.3.0', ''),
            'JSON_HEX_AMP'                   => array('5.3.0', ''),
            'JSON_HEX_APOS'                  => array('5.3.0', ''),
            'JSON_HEX_QUOT'                  => array('5.3.0', ''),
            'JSON_HEX_TAG'                   => array('5.3.0', ''),
            'JSON_NUMERIC_CHECK'             => array('5.3.3', ''),
            'JSON_OBJECT_AS_ARRAY'           => array('5.4.0', ''),
            'JSON_PARTIAL_OUTPUT_ON_ERROR'   => array('5.3.14', '5.3.14'),
            'JSON_PRETTY_PRINT'              => array('5.4.0', ''),
            'JSON_UNESCAPED_SLASHES'         => array('5.4.0', ''),
            'JSON_UNESCAPED_UNICODE'         => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
