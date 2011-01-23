<?php
/**
 * All interfaces, classes, functions, constants about xml extension
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @link       http://www.php.net/manual/en/book.xml.php
 */

require_once 'PHP/CompatInfo/Reference.php';

class PHP_CompatInfo_Reference_Xml implements PHP_CompatInfo_Reference
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
            'xml' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.xml.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'utf8_encode'                    => array('4.0.0', ''),
                'utf8_decode'                    => array('4.0.0', ''),
                'xml_error_string'               => array('4.0.0', ''),
                'xml_get_current_byte_index'     => array('4.0.0', ''),
                'xml_get_current_column_number'  => array('4.0.0', ''),
                'xml_get_current_line_number'    => array('4.0.0', ''),
                'xml_get_error_code'             => array('4.0.0', ''),
                'xml_parse_into_struct'          => array('4.0.0', ''),
                'xml_parse'                      => array('4.0.0', ''),
                'xml_parser_create_ns'           => array('4.0.5', ''),
                'xml_parser_create'              => array('4.0.0', ''),
                'xml_parser_free'                => array('4.0.0', ''),
                'xml_parser_get_option'          => array('4.0.0', ''),
                'xml_parser_set_option'          => array('4.0.0', ''),
                'xml_set_character_data_handler' => array('4.0.0', ''),
                'xml_set_default_handler'        => array('4.0.0', ''),
                'xml_set_element_handler'        => array('4.0.0', ''),
                'xml_set_end_namespace_decl_handler' 
                                                 => array('4.0.5', ''),
                'xml_set_external_entity_ref_handler' 
                                                 => array('4.0.0', ''),
                'xml_set_notation_decl_handler'  => array('4.0.0', ''),
                'xml_set_object'                 => array('4.0.0', ''),
                'xml_set_processing_instruction_handler' 
                                                 => array('4.0.0', ''),
                'xml_set_start_namespace_decl_handler' 
                                                 => array('4.0.5', ''),
                'xml_set_unparsed_entity_decl_handler' 
                                                 => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
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
     * @link   http://www.php.net/manual/en/xml.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'XML_ERROR_NONE'                 => array('4.0.0', ''),
                'XML_ERROR_NO_MEMORY'            => array('4.0.0', ''),
                'XML_ERROR_SYNTAX'               => array('4.0.0', ''),
                'XML_ERROR_NO_ELEMENTS'          => array('4.0.0', ''),
                'XML_ERROR_INVALID_TOKEN'        => array('4.0.0', ''),
                'XML_ERROR_UNCLOSED_TOKEN'       => array('4.0.0', ''),
                'XML_ERROR_PARTIAL_CHAR'         => array('4.0.0', ''),
                'XML_ERROR_TAG_MISMATCH'         => array('4.0.0', ''),
                'XML_ERROR_DUPLICATE_ATTRIBUTE'  => array('4.0.0', ''),
                'XML_ERROR_JUNK_AFTER_DOC_ELEMENT'
                                                 => array('4.0.0', ''),
                'XML_ERROR_PARAM_ENTITY_REF'     => array('4.0.0', ''),
                'XML_ERROR_UNDEFINED_ENTITY'     => array('4.0.0', ''),
                'XML_ERROR_RECURSIVE_ENTITY_REF' => array('4.0.0', ''),
                'XML_ERROR_ASYNC_ENTITY'         => array('4.0.0', ''),
                'XML_ERROR_BAD_CHAR_REF'         => array('4.0.0', ''),
                'XML_ERROR_BINARY_ENTITY_REF'    => array('4.0.0', ''),
                'XML_ERROR_ATTRIBUTE_EXTERNAL_ENTITY_REF'
                                                 => array('4.0.0', ''),
                'XML_ERROR_MISPLACED_XML_PI'     => array('4.0.0', ''),
                'XML_ERROR_UNKNOWN_ENCODING'     => array('4.0.0', ''),
                'XML_ERROR_INCORRECT_ENCODING'   => array('4.0.0', ''),
                'XML_ERROR_UNCLOSED_CDATA_SECTION'
                                                 => array('4.0.0', ''),
                'XML_ERROR_EXTERNAL_ENTITY_HANDLING'
                                                 => array('4.0.0', ''),
                'XML_OPTION_CASE_FOLDING'        => array('4.0.0', ''),
                'XML_OPTION_TARGET_ENCODING'     => array('4.0.0', ''),
                'XML_OPTION_SKIP_TAGSTART'       => array('4.0.0', ''),
                'XML_OPTION_SKIP_WHITE'          => array('4.0.0', ''),
                'XML_SAX_IMPL'                   => array('4.0.0', ''),
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
