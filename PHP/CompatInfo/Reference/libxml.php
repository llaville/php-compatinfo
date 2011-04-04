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
 * @version  SVN: $Id$
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
class PHP_CompatInfo_Reference_Libxml implements PHP_CompatInfo_Reference
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
            'libxml' => array('5.0.0', '', '')
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
                'LibXMLError'                    => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.libxml.php
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
                'libxml_set_streams_context'     => array('5.0.0', ''),
                'libxml_use_internal_errors'     => array('5.1.0', ''),
                'libxml_get_last_error'          => array('5.1.0', ''),
                'libxml_clear_errors'            => array('5.1.0', ''),
                'libxml_get_errors'              => array('5.1.0', ''),
                'libxml_disable_entity_loader'   => array('5.2.11', ''),
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
     * @link   http://www.php.net/manual/en/libxml.constants.php
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
                'LIBXML_VERSION'                 => array('5.1.0', ''),
                'LIBXML_DOTTED_VERSION'          => array('5.1.0', ''),
                'LIBXML_LOADED_VERSION'          => array('5.3.0', ''),
                'LIBXML_NOENT'                   => array('5.1.0', ''),
                'LIBXML_DTDLOAD'                 => array('5.1.0', ''),
                'LIBXML_DTDATTR'                 => array('5.1.0', ''),
                'LIBXML_DTDVALID'                => array('5.1.0', ''),
                'LIBXML_NOERROR'                 => array('5.1.0', ''),
                'LIBXML_NOWARNING'               => array('5.1.0', ''),
                'LIBXML_NOBLANKS'                => array('5.1.0', ''),
                'LIBXML_XINCLUDE'                => array('5.1.0', ''),
                'LIBXML_NSCLEAN'                 => array('5.1.0', ''),
                'LIBXML_NOCDATA'                 => array('5.1.0', ''),
                'LIBXML_NONET'                   => array('5.1.0', ''),
                'LIBXML_COMPACT'                 => array('5.1.0', ''),
                'LIBXML_NOXMLDECL'               => array('5.1.0', ''),
                // since 5.2.12 and 5.3.2
                'LIBXML_PARSEHUGE'               => array('5.2.12', ''),
                'LIBXML_NOEMPTYTAG'              => array('5.1.0', ''),
                'LIBXML_ERR_NONE'                => array('5.1.0', ''),
                'LIBXML_ERR_WARNING'             => array('5.1.0', ''),
                'LIBXML_ERR_ERROR'               => array('5.1.0', ''),
                'LIBXML_ERR_FATAL'               => array('5.1.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
