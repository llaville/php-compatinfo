<?php
/**
 * Version informations about yaml extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about yaml extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.yaml.php
 * @since    Class available since Release ???
 */
class PHP_CompatInfo_Reference_Yaml implements PHP_CompatInfo_Reference
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
            'yaml' => array('5.2.0', '', '1.1.0')
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
     * @link   http://www.php.net/manual/en/ref.yaml.php
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
                'yaml_emit'                               => array('5.2.0', ''),
                'yaml_emit_file'                          => array('5.2.0', ''),
                'yaml_parse'                              => array('5.2.0', ''),
                'yaml_parse_file'                         => array('5.2.0', ''),
                'yaml_parse_url'                          => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/yaml.constants.php
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
                'YAML_ANY_BREAK'                          => array('5.2.0', ''),
                'YAML_ANY_ENCODING'                       => array('5.2.0', ''),
                'YAML_ANY_SCALAR_STYLE'                   => array('5.2.0', ''),
                'YAML_BINARY_TAG'                         => array('5.2.0', ''),
                'YAML_BOOL_TAG'                           => array('5.2.0', ''),
                'YAML_CRLN_BREAK'                         => array('5.2.0', ''),
                'YAML_CR_BREAK'                           => array('5.2.0', ''),
                'YAML_DOUBLE_QUOTED_SCALAR_STYLE'         => array('5.2.0', ''),
                'YAML_FLOAT_TAG'                          => array('5.2.0', ''),
                'YAML_FOLDED_SCALAR_STYLE'                => array('5.2.0', ''),
                'YAML_INT_TAG'                            => array('5.2.0', ''),
                'YAML_LITERAL_SCALAR_STYLE'               => array('5.2.0', ''),
                'YAML_LN_BREAK'                           => array('5.2.0', ''),
                'YAML_MAP_TAG'                            => array('5.2.0', ''),
                'YAML_MERGE_TAG'                          => array('5.2.0', ''),
                'YAML_NULL_TAG'                           => array('5.2.0', ''),
                'YAML_PHP_TAG'                            => array('5.2.0', ''),
                'YAML_PLAIN_SCALAR_STYLE'                 => array('5.2.0', ''),
                'YAML_SEQ_TAG'                            => array('5.2.0', ''),
                'YAML_SINGLE_QUOTED_SCALAR_STYLE'         => array('5.2.0', ''),
                'YAML_STR_TAG'                            => array('5.2.0', ''),
                'YAML_TIMESTAMP_TAG'                      => array('5.2.0', ''),
                'YAML_UTF16BE_ENCODING'                   => array('5.2.0', ''),
                'YAML_UTF16LE_ENCODING'                   => array('5.2.0', ''),
                'YAML_UTF8_ENCODING'                      => array('5.2.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
