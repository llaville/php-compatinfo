<?php
/**
 * Version informations about libxml extension
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
 * All interfaces, classes, functions, constants about libxml extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.libxml.php
 */
class PHP_CompatInfo_Reference_Libxml
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'libxml';

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
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '5.1.0';       // 2005-11-24
        $items = array(
            'LibXMLError'                    => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.libxml.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '5.1.0';       // 2005-11-24
        $items = array(
            'libxml_clear_errors'               => array('5.1.0', ''),
            'libxml_get_errors'                 => array('5.1.0', ''),
            'libxml_get_last_error'             => array('5.1.0', ''),
            'libxml_set_streams_context'        => array('5.0.0', ''),
            'libxml_use_internal_errors'        => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.2.11';      // 2009-09-16
        $items = array(
            'libxml_disable_entity_loader'      => array('5.2.11', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.4.0';       // 2012-03-01
        $items = array(
            'libxml_set_external_entity_loader' => array('5.4.0', ''),
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
     * @link   http://www.php.net/manual/en/libxml.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '5.1.0';       // 2005-11-24
        $items = array(
            'LIBXML_COMPACT'                 => array('5.1.0', ''),
            'LIBXML_DOTTED_VERSION'          => array('5.1.0', ''),
            'LIBXML_DTDATTR'                 => array('5.1.0', ''),
            'LIBXML_DTDLOAD'                 => array('5.1.0', ''),
            'LIBXML_DTDVALID'                => array('5.1.0', ''),
            'LIBXML_ERR_ERROR'               => array('5.1.0', ''),
            'LIBXML_ERR_FATAL'               => array('5.1.0', ''),
            'LIBXML_ERR_NONE'                => array('5.1.0', ''),
            'LIBXML_ERR_WARNING'             => array('5.1.0', ''),
            'LIBXML_NOBLANKS'                => array('5.1.0', ''),
            'LIBXML_NOCDATA'                 => array('5.1.0', ''),
            'LIBXML_NOEMPTYTAG'              => array('5.1.0', ''),
            'LIBXML_NOENT'                   => array('5.1.0', ''),
            'LIBXML_NOERROR'                 => array('5.1.0', ''),
            'LIBXML_NONET'                   => array('5.1.0', ''),
            'LIBXML_NOWARNING'               => array('5.1.0', ''),
            'LIBXML_NOXMLDECL'               => array('5.1.0', ''),
            'LIBXML_NSCLEAN'                 => array('5.1.0', ''),
            'LIBXML_VERSION'                 => array('5.1.0', ''),
            'LIBXML_XINCLUDE'                => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.2.12';      // 2009-12-17
        $items = array(
            'LIBXML_PARSEHUGE'               => array('5.2.12', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.0';       // 2009-06-30
        $items = array(
            'LIBXML_LOADED_VERSION'          => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.4.0';       // 2012-03-01
        $items = array(
            'LIBXML_HTML_NODEFDTD'           => array('5.4.0', ''),
            'LIBXML_HTML_NOIMPLIED'          => array('5.4.0', ''),
            'LIBXML_PEDANTIC'                => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
