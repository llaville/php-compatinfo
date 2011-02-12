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

require_once 'PHP/CompatInfo/Reference.php';

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
class PHP_CompatInfo_Reference_Xmlwriter implements PHP_CompatInfo_Reference
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
            'xmlwriter' => array('5.1.2', '', '0.1')
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
                'XMLWriter'                      => array('5.1.2', ''),
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
     * @link   http://www.php.net/manual/en/ref.xmlwriter.php
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
                'xmlwriter_end_attribute'        => array('5.1.2', ''),
                'xmlwriter_end_cdata'            => array('5.1.2', ''),
                'xmlwriter_end_comment'          => array('5.1.2', ''),
                'xmlwriter_end_document'         => array('5.1.2', ''),
                'xmlwriter_end_dtd_attlist'      => array('5.1.2', ''),
                'xmlwriter_end_dtd_element'      => array('5.1.2', ''),
                'xmlwriter_end_dtd_entity'       => array('5.1.2', ''),
                'xmlwriter_end_dtd'              => array('5.1.2', ''),
                'xmlwriter_end_element'          => array('5.1.2', ''),
                'xmlwriter_end_pi'               => array('5.1.2', ''),
                'xmlwriter_flush'                => array('5.1.2', ''),
                'xmlwriter_full_end_element'     => array('5.2.0', ''),
                'xmlwriter_open_memory'          => array('5.1.2', ''),
                'xmlwriter_open_uri'             => array('5.1.2', ''),
                'xmlwriter_output_memory'        => array('5.1.2', ''),
                'xmlwriter_set_indent_string'    => array('5.1.2', ''),
                'xmlwriter_set_indent'           => array('5.1.2', ''),
                'xmlwriter_start_attribute_ns'   => array('5.1.2', ''),
                'xmlwriter_start_attribute'      => array('5.1.2', ''),
                'xmlwriter_start_cdata'          => array('5.1.2', ''),
                'xmlwriter_start_comment'        => array('5.1.2', ''),
                'xmlwriter_start_document'       => array('5.1.2', ''),
                'xmlwriter_start_dtd_attlist'    => array('5.1.2', ''),
                'xmlwriter_start_dtd_element'    => array('5.1.2', ''),
                'xmlwriter_start_dtd_entity'     => array('5.1.2', ''),
                'xmlwriter_start_dtd'            => array('5.1.2', ''),
                'xmlwriter_start_element_ns'     => array('5.1.2', ''),
                'xmlwriter_start_element'        => array('5.1.2', ''),
                'xmlwriter_start_pi'             => array('5.1.2', ''),
                'xmlwriter_text'                 => array('5.1.2', ''),
                'xmlwriter_write_attribute_ns'   => array('5.1.2', ''),
                'xmlwriter_write_attribute'      => array('5.1.2', ''),
                'xmlwriter_write_cdata'          => array('5.1.2', ''),
                'xmlwriter_write_comment'        => array('5.1.2', ''),
                'xmlwriter_write_dtd_attlist'    => array('5.1.2', ''),
                'xmlwriter_write_dtd_element'    => array('5.1.2', ''),
                'xmlwriter_write_dtd_entity'     => array('5.1.2', ''),
                'xmlwriter_write_dtd'            => array('5.1.2', ''),
                'xmlwriter_write_element_ns'     => array('5.1.2', ''),
                'xmlwriter_write_element'        => array('5.1.2', ''),
                'xmlwriter_write_pi'             => array('5.1.2', ''),
                'xmlwriter_write_raw'            => array('5.2.0', ''),
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
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
