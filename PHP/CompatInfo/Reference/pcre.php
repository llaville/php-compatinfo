<?php
/**
 * Version informations about pcre extension
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
 * All interfaces, classes, functions, constants about pcre extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.pcre.php
 */
class PHP_CompatInfo_Reference_Pcre
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'pcre';

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
     * @link   http://www.php.net/manual/en/ref.pcre.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'preg_filter'                    => array('5.3.0', ''),
            'preg_grep'                      => array('4.0.0', ''),
            'preg_last_error'                => array('5.2.0', ''),
            'preg_match'                     => array('4.0.0', ''),
            'preg_match_all'                 => array('4.0.0', ''),
            'preg_quote'                     => array('4.0.0', ''),
            'preg_replace'                   => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.1, 5.1.0'),
            'preg_replace_callback'          => array('4.0.5', '', '4.0.5, 4.0.5, 4.0.5, 4.0.5, 5.1.0'),
            'preg_split'                     => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/pcre.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'PCRE_VERSION'                   => array('5.2.4', ''),
            'PREG_BACKTRACK_LIMIT_ERROR'     => array('5.2.0', ''),
            'PREG_BAD_UTF8_ERROR'            => array('5.2.0', ''),
            'PREG_BAD_UTF8_OFFSET_ERROR'     => array('5.2.9', ''),
            'PREG_GREP_INVERT'               => array('4.0.0', ''),
            'PREG_INTERNAL_ERROR'            => array('5.2.0', ''),
            'PREG_NO_ERROR'                  => array('5.2.0', ''),
            'PREG_OFFSET_CAPTURE'            => array('4.3.0', ''),
            'PREG_PATTERN_ORDER'             => array('4.0.0', ''),
            'PREG_RECURSION_LIMIT_ERROR'     => array('5.2.0', ''),
            'PREG_SET_ORDER'                 => array('4.0.0', ''),
            'PREG_SPLIT_DELIM_CAPTURE'       => array('4.0.5', ''),
            'PREG_SPLIT_NO_EMPTY'            => array('4.0.0', ''),
            'PREG_SPLIT_OFFSET_CAPTURE'      => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
