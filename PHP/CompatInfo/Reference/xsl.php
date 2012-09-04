<?php
/**
 * Version informations about xsl extension
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
 * All interfaces, classes, functions, constants about xsl extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.xsl.php
 */
class PHP_CompatInfo_Reference_Xsl
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'xsl';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.1';

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
        $phpMin = '5.0.0';
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
     * @link   http://www.php.net/manual/en/class.xsltprocessor.php
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = false;
        $items = array(
            'XSLTProcessor'                  => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
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
     * @link   http://www.php.net/manual/en/xsl.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'LIBEXSLT_DOTTED_VERSION'        => array('5.1.2', ''),
            'LIBEXSLT_VERSION'               => array('5.1.2', ''),
            'LIBXSLT_DOTTED_VERSION'         => array('5.1.2', ''),
            'LIBXSLT_VERSION'                => array('5.1.2', ''),
            'XSL_CLONE_ALWAYS'               => array('5.0.0', ''),
            'XSL_CLONE_AUTO'                 => array('5.0.0', ''),
            'XSL_CLONE_NEVER'                => array('5.0.0', ''),
            'XSL_SECPREF_CREATE_DIRECTORY'   => array('5.3.9', ''),
            'XSL_SECPREF_DEFAULT'            => array('5.3.9', ''),
            'XSL_SECPREF_NONE'               => array('5.3.9', ''),
            'XSL_SECPREF_READ_FILE'          => array('5.3.9', ''),
            'XSL_SECPREF_READ_NETWORK'       => array('5.3.9', ''),
            'XSL_SECPREF_WRITE_FILE'         => array('5.3.9', ''),
            'XSL_SECPREF_WRITE_NETWORK'      => array('5.3.9', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
