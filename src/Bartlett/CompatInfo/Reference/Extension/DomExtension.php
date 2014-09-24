<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class DomExtension extends AbstractReference
{
    const REF_NAME    = 'dom';
    const REF_VERSION = '20031129';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR50000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->classes = array(
            'DOMAttr'                           => null,
            'DOMCdataSection'                   => null,
            'DOMCharacterData'                  => null,
            'DOMComment'                        => null,
            'DOMConfiguration'                  => null,
            'DOMDocument'                       => null,
            'DOMDocumentType'                   => null,
            'DOMDomError'                       => null,
            'DOMElement'                        => null,
            'DOMEntity'                         => null,
            'DOMEntityReference'                => null,
            'DOMErrorHandler'                   => null,
            'DOMImplementation'                 => null,
            'DOMImplementationList'             => null,
            'DOMImplementationSource'           => null,
            'DOMLocator'                        => null,
            'DOMNameList'                       => null,
            'DOMNameSpaceNode'                  => null,
            'DOMNamedNodeMap'                   => null,
            'DOMNode'                           => null,
            'DOMNodeList'                       => null,
            'DOMNotation'                       => null,
            'DOMProcessingInstruction'          => null,
            'DOMStringExtend'                   => null,
            'DOMStringList'                     => null,
            'DOMText'                           => null,
            'DOMTypeinfo'                       => null,
            'DOMUserDataHandler'                => null,
            'DOMXPath'                          => null,
        );
        $release->functions = array(
            'dom_import_simplexml'              => null,
        );
        $release->constants = array(
            'DOMSTRING_SIZE_ERR'                => null,
            'DOM_HIERARCHY_REQUEST_ERR'         => null,
            'DOM_INDEX_SIZE_ERR'                => null,
            'DOM_INUSE_ATTRIBUTE_ERR'           => null,
            'DOM_INVALID_ACCESS_ERR'            => null,
            'DOM_INVALID_CHARACTER_ERR'         => null,
            'DOM_INVALID_MODIFICATION_ERR'      => null,
            'DOM_INVALID_STATE_ERR'             => null,
            'DOM_NAMESPACE_ERR'                 => null,
            'DOM_NOT_FOUND_ERR'                 => null,
            'DOM_NOT_SUPPORTED_ERR'             => null,
            'DOM_NO_DATA_ALLOWED_ERR'           => null,
            'DOM_NO_MODIFICATION_ALLOWED_ERR'   => null,
            'DOM_PHP_ERR'                       => null,
            'DOM_SYNTAX_ERR'                    => null,
            'DOM_VALIDATION_ERR'                => null,
            'DOM_WRONG_DOCUMENT_ERR'            => null,
            'XML_ATTRIBUTE_CDATA'               => null,
            'XML_ATTRIBUTE_DECL_NODE'           => null,
            'XML_ATTRIBUTE_ENTITY'              => null,
            'XML_ATTRIBUTE_ENUMERATION'         => null,
            'XML_ATTRIBUTE_ID'                  => null,
            'XML_ATTRIBUTE_IDREF'               => null,
            'XML_ATTRIBUTE_IDREFS'              => null,
            'XML_ATTRIBUTE_NMTOKEN'             => null,
            'XML_ATTRIBUTE_NMTOKENS'            => null,
            'XML_ATTRIBUTE_NODE'                => null,
            'XML_ATTRIBUTE_NOTATION'            => null,
            'XML_CDATA_SECTION_NODE'            => null,
            'XML_COMMENT_NODE'                  => null,
            'XML_DOCUMENT_FRAG_NODE'            => null,
            'XML_DOCUMENT_NODE'                 => null,
            'XML_DOCUMENT_TYPE_NODE'            => null,
            'XML_DTD_NODE'                      => null,
            'XML_ELEMENT_DECL_NODE'             => null,
            'XML_ELEMENT_NODE'                  => null,
            'XML_ENTITY_DECL_NODE'              => null,
            'XML_ENTITY_NODE'                   => null,
            'XML_ENTITY_REF_NODE'               => null,
            'XML_HTML_DOCUMENT_NODE'            => null,
            'XML_LOCAL_NAMESPACE'               => null,
            'XML_NAMESPACE_DECL_NODE'           => null,
            'XML_NOTATION_NODE'                 => null,
            'XML_PI_NODE'                       => null,
            'XML_TEXT_NODE'                     => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            'DOMDocumentFragment'               => null,
            'DOMException'                      => null,
        );
        return $release;
    }
}
