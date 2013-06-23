<?php
/**
 * Version informations about ctype extension
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
 * All interfaces, classes, functions, constants about ctype extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.ctype.php
 */
class PHP_CompatInfo_Reference_Ctype
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'ctype';

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
        $phpMin = '4.0.4';
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
     * @link   http://www.php.net/manual/en/ref.ctype.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '4.0.4';       // 2000-12-19 (stable)
        $items = array(
            'ctype_alnum'                    => array('4.0.4', ''),
            'ctype_alpha'                    => array('4.0.4', ''),
            'ctype_cntrl'                    => array('4.0.4', ''),
            'ctype_digit'                    => array('4.0.4', ''),
            'ctype_graph'                    => array('4.0.4', ''),
            'ctype_lower'                    => array('4.0.4', ''),
            'ctype_print'                    => array('4.0.4', ''),
            'ctype_punct'                    => array('4.0.4', ''),
            'ctype_space'                    => array('4.0.4', ''),
            'ctype_upper'                    => array('4.0.4', ''),
            'ctype_xdigit'                   => array('4.0.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
