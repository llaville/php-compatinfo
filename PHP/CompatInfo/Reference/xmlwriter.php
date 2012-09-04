<?php
/**
 * Version informations about xmlwriter extension
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
 * All interfaces, classes, functions, constants about xmlwriter extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.xmlwriter.php
 */
class PHP_CompatInfo_Reference_Xmlwriter
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'xmlwriter';

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
        $phpMin = '5.1.2';
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

        $release = false;
        $items = array(
            'XMLWriter'                      => array('5.1.2', ''),
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
     * @link   http://www.php.net/manual/en/ref.xmlwriter.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'xmlwriter_end_attribute'        => array('5.1.2', ''),
            'xmlwriter_end_cdata'            => array('5.1.2', ''),
            'xmlwriter_end_comment'          => array('5.1.2', ''),
            'xmlwriter_end_document'         => array('5.1.2', ''),
            'xmlwriter_end_dtd'              => array('5.1.2', ''),
            'xmlwriter_end_dtd_attlist'      => array('5.1.2', ''),
            'xmlwriter_end_dtd_element'      => array('5.1.2', ''),
            'xmlwriter_end_dtd_entity'       => array('5.1.2', ''),
            'xmlwriter_end_element'          => array('5.1.2', ''),
            'xmlwriter_end_pi'               => array('5.1.2', ''),
            'xmlwriter_flush'                => array('5.1.2', ''),
            'xmlwriter_full_end_element'     => array('5.2.0', ''),
            'xmlwriter_open_memory'          => array('5.1.2', ''),
            'xmlwriter_open_uri'             => array('5.1.2', ''),
            'xmlwriter_output_memory'        => array('5.1.2', ''),
            'xmlwriter_set_indent'           => array('5.1.2', ''),
            'xmlwriter_set_indent_string'    => array('5.1.2', ''),
            'xmlwriter_start_attribute'      => array('5.1.2', ''),
            'xmlwriter_start_attribute_ns'   => array('5.1.2', ''),
            'xmlwriter_start_cdata'          => array('5.1.2', ''),
            'xmlwriter_start_comment'        => array('5.1.2', ''),
            'xmlwriter_start_document'       => array('5.1.2', ''),
            'xmlwriter_start_dtd'            => array('5.1.2', ''),
            'xmlwriter_start_dtd_attlist'    => array('5.1.2', ''),
            'xmlwriter_start_dtd_element'    => array('5.1.2', ''),
            'xmlwriter_start_dtd_entity'     => array('5.1.2', ''),
            'xmlwriter_start_element'        => array('5.1.2', ''),
            'xmlwriter_start_element_ns'     => array('5.1.2', ''),
            'xmlwriter_start_pi'             => array('5.1.2', ''),
            'xmlwriter_text'                 => array('5.1.2', ''),
            'xmlwriter_write_attribute'      => array('5.1.2', ''),
            'xmlwriter_write_attribute_ns'   => array('5.1.2', ''),
            'xmlwriter_write_cdata'          => array('5.1.2', ''),
            'xmlwriter_write_comment'        => array('5.1.2', ''),
            'xmlwriter_write_dtd'            => array('5.1.2', ''),
            'xmlwriter_write_dtd_attlist'    => array('5.1.2', ''),
            'xmlwriter_write_dtd_element'    => array('5.1.2', ''),
            'xmlwriter_write_dtd_entity'     => array('5.1.2', ''),
            'xmlwriter_write_element'        => array('5.1.2', ''),
            'xmlwriter_write_element_ns'     => array('5.1.2', ''),
            'xmlwriter_write_pi'             => array('5.1.2', ''),
            'xmlwriter_write_raw'            => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
