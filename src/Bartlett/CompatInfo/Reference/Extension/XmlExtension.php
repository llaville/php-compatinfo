<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XmlExtension extends AbstractReference
{
    const REF_NAME    = 'xml';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'utf8_decode'                               => null,
            'utf8_encode'                               => null,
            'xml_error_string'                          => null,
            'xml_get_current_byte_index'                => null,
            'xml_get_current_column_number'             => null,
            'xml_get_current_line_number'               => null,
            'xml_get_error_code'                        => null,
            'xml_parse'                                 => null,
            'xml_parse_into_struct'                     => null,
            'xml_parser_create'                         => null,
            'xml_parser_free'                           => null,
            'xml_parser_get_option'                     => null,
            'xml_parser_set_option'                     => null,
            'xml_set_character_data_handler'            => null,
            'xml_set_default_handler'                   => null,
            'xml_set_element_handler'                   => null,
            'xml_set_external_entity_ref_handler'       => null,
            'xml_set_notation_decl_handler'             => null,
            'xml_set_object'                            => null,
            'xml_set_processing_instruction_handler'    => null,
            'xml_set_unparsed_entity_decl_handler'      => null,
        );
        $release->constants = array(
            'XML_ERROR_ASYNC_ENTITY'                    => null,
            'XML_ERROR_ATTRIBUTE_EXTERNAL_ENTITY_REF'   => null,
            'XML_ERROR_BAD_CHAR_REF'                    => null,
            'XML_ERROR_BINARY_ENTITY_REF'               => null,
            'XML_ERROR_DUPLICATE_ATTRIBUTE'             => null,
            'XML_ERROR_EXTERNAL_ENTITY_HANDLING'        => null,
            'XML_ERROR_INCORRECT_ENCODING'              => null,
            'XML_ERROR_INVALID_TOKEN'                   => null,
            'XML_ERROR_JUNK_AFTER_DOC_ELEMENT'          => null,
            'XML_ERROR_MISPLACED_XML_PI'                => null,
            'XML_ERROR_NONE'                            => null,
            'XML_ERROR_NO_ELEMENTS'                     => null,
            'XML_ERROR_NO_MEMORY'                       => null,
            'XML_ERROR_PARAM_ENTITY_REF'                => null,
            'XML_ERROR_PARTIAL_CHAR'                    => null,
            'XML_ERROR_RECURSIVE_ENTITY_REF'            => null,
            'XML_ERROR_SYNTAX'                          => null,
            'XML_ERROR_TAG_MISMATCH'                    => null,
            'XML_ERROR_UNCLOSED_CDATA_SECTION'          => null,
            'XML_ERROR_UNCLOSED_TOKEN'                  => null,
            'XML_ERROR_UNDEFINED_ENTITY'                => null,
            'XML_ERROR_UNKNOWN_ENCODING'                => null,
            'XML_OPTION_CASE_FOLDING'                   => null,
            'XML_OPTION_SKIP_TAGSTART'                  => null,
            'XML_OPTION_SKIP_WHITE'                     => null,
            'XML_OPTION_TARGET_ENCODING'                => null,
            'XML_SAX_IMPL'                              => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->functions = array(
            'xml_parser_create_ns'                  => null,
            'xml_set_end_namespace_decl_handler'    => null,
            'xml_set_start_namespace_decl_handler'  => null,
        );
        return $release;
    }
}
