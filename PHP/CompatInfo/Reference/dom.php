<?php
/**
 * Version informations about DOM extension
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
 * All interfaces, classes, functions, constants about DOM extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.dom.php
 */
class PHP_CompatInfo_Reference_Dom
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'dom';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '20031129';

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

        $release = false;
        $items = array(
            'DOMAttr'                        => array('5.0.0', ''),
            'DOMCharacterData'               => array('5.0.0', ''),
            'DOMComment'                     => array('5.0.0', ''),
            'DOMDocument'                    => array('5.0.0', ''),
            'DOMDocumentFragment'            => array('5.1.0', ''),
            'DOMDocumentType'                => array('5.0.0', ''),
            'DOMElement'                     => array('5.0.0', ''),
            'DOMEntity'                      => array('5.0.0', ''),
            'DOMEntityReference'             => array('5.0.0', ''),
            'DOMException'                   => array('5.1.0', ''),
            'DOMImplementation'              => array('5.0.0', ''),
            'DOMNamedNodeMap'                => array('5.0.0', ''),
            'DOMNode'                        => array('5.0.0', ''),
            'DOMNodeList'                    => array('5.0.0', ''),
            'DOMNotation'                    => array('5.0.0', ''),
            'DOMProcessingInstruction'       => array('5.0.0', ''),
            'DOMText'                        => array('5.0.0', ''),
            'DOMXPath'                       => array('5.0.0', ''),
            'DOMStringList'                  => array('5.0.0', ''),
            'DOMNameList'                    => array('5.0.0', ''),
            'DOMImplementationList'          => array('5.0.0', ''),
            'DOMImplementationSource'        => array('5.0.0', ''),
            'DOMNameSpaceNode'               => array('5.0.0', ''),
            'DOMTypeinfo'                    => array('5.0.0', ''),
            'DOMUserDataHandler'             => array('5.0.0', ''),
            'DOMDomError'                    => array('5.0.0', ''),
            'DOMErrorHandler'                => array('5.0.0', ''),
            'DOMLocator'                     => array('5.0.0', ''),
            'DOMConfiguration'               => array('5.0.0', ''),
            'DOMCdataSection'                => array('5.0.0', ''),
            'DOMStringExtend'                => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.dom.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'dom_import_simplexml'           => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/dom.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'DOMSTRING_SIZE_ERR'             => array('5.0.0', ''),
            'DOM_HIERARCHY_REQUEST_ERR'      => array('5.0.0', ''),
            'DOM_INDEX_SIZE_ERR'             => array('5.0.0', ''),
            'DOM_INUSE_ATTRIBUTE_ERR'        => array('5.0.0', ''),
            'DOM_INVALID_ACCESS_ERR'         => array('5.0.0', ''),
            'DOM_INVALID_CHARACTER_ERR'      => array('5.0.0', ''),
            'DOM_INVALID_MODIFICATION_ERR'   => array('5.0.0', ''),
            'DOM_INVALID_STATE_ERR'          => array('5.0.0', ''),
            'DOM_NAMESPACE_ERR'              => array('5.0.0', ''),
            'DOM_NOT_FOUND_ERR'              => array('5.0.0', ''),
            'DOM_NOT_SUPPORTED_ERR'          => array('5.0.0', ''),
            'DOM_NO_DATA_ALLOWED_ERR'        => array('5.0.0', ''),
            'DOM_NO_MODIFICATION_ALLOWED_ERR'
                                             => array('5.0.0', ''),
            'DOM_PHP_ERR'                    => array('5.0.0', ''),
            'DOM_SYNTAX_ERR'                 => array('5.0.0', ''),
            'DOM_VALIDATION_ERR'             => array('5.0.0', ''),
            'DOM_WRONG_DOCUMENT_ERR'         => array('5.0.0', ''),
            'XML_ATTRIBUTE_CDATA'            => array('5.0.0', ''),
            'XML_ATTRIBUTE_DECL_NODE'        => array('5.0.0', ''),
            'XML_ATTRIBUTE_ENTITY'           => array('5.0.0', ''),
            'XML_ATTRIBUTE_ENUMERATION'      => array('5.0.0', ''),
            'XML_ATTRIBUTE_ID'               => array('5.0.0', ''),
            'XML_ATTRIBUTE_IDREF'            => array('5.0.0', ''),
            'XML_ATTRIBUTE_IDREFS'           => array('5.0.0', ''),
            'XML_ATTRIBUTE_NMTOKEN'          => array('5.0.0', ''),
            'XML_ATTRIBUTE_NMTOKENS'         => array('5.0.0', ''),
            'XML_ATTRIBUTE_NODE'             => array('5.0.0', ''),
            'XML_ATTRIBUTE_NOTATION'         => array('5.0.0', ''),
            'XML_CDATA_SECTION_NODE'         => array('5.0.0', ''),
            'XML_COMMENT_NODE'               => array('5.0.0', ''),
            'XML_DOCUMENT_FRAG_NODE'         => array('5.0.0', ''),
            'XML_DOCUMENT_NODE'              => array('5.0.0', ''),
            'XML_DOCUMENT_TYPE_NODE'         => array('5.0.0', ''),
            'XML_DTD_NODE'                   => array('5.0.0', ''),
            'XML_ELEMENT_DECL_NODE'          => array('5.0.0', ''),
            'XML_ELEMENT_NODE'               => array('5.0.0', ''),
            'XML_ENTITY_DECL_NODE'           => array('5.0.0', ''),
            'XML_ENTITY_NODE'                => array('5.0.0', ''),
            'XML_ENTITY_REF_NODE'            => array('5.0.0', ''),
            'XML_HTML_DOCUMENT_NODE'         => array('5.0.0', ''),
            'XML_LOCAL_NAMESPACE'            => array('5.0.0', ''),
            'XML_NAMESPACE_DECL_NODE'        => array('5.0.0', ''),
            'XML_NOTATION_NODE'              => array('5.0.0', ''),
            'XML_PI_NODE'                    => array('5.0.0', ''),
            'XML_TEXT_NODE'                  => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
