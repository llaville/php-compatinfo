<?php
/**
 * Version informations about soap extension
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
 * All interfaces, classes, functions, constants about soap extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.soap.php
 */
class PHP_CompatInfo_Reference_Soap implements PHP_CompatInfo_Reference
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
            'soap' => array('5.0.0', '', '')
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
                'SoapClient'                    => array('5.0.0', ''),
                'SoapServer'                    => array('5.0.0', ''),
                'SoapFault'                     => array('5.0.0', ''),
                'SoapHeader'                    => array('5.0.0', ''),
                'SoapParam'                     => array('5.0.0', ''),
                'SoapVar'                       => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.soap.php
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
                'is_soap_fault'                     => array('5.0.0', ''),
                'use_soap_error_handler'            => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/soap.constants.php
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
                'SOAP_1_1'                      => array('5.0.0', ''),
                'SOAP_1_2'                      => array('5.0.0', ''),
                'SOAP_PERSISTENCE_SESSION'      => array('5.0.0', ''),
                'SOAP_PERSISTENCE_REQUEST'      => array('5.0.0', ''),
                'SOAP_FUNCTIONS_ALL'            => array('5.0.0', ''),
                'SOAP_ENCODED'                  => array('5.0.0', ''),
                'SOAP_LITERAL'                  => array('5.0.0', ''),
                'SOAP_RPC'                      => array('5.0.0', ''),
                'SOAP_DOCUMENT'                 => array('5.0.0', ''),
                'SOAP_ACTOR_NEXT'               => array('5.0.0', ''),
                'SOAP_ACTOR_NONE'               => array('5.0.0', ''),
                'SOAP_ACTOR_UNLIMATERECEIVER'   => array('5.0.0', ''),
                'SOAP_COMPRESSION_ACCEPT'       => array('5.0.0', ''),
                'SOAP_COMPRESSION_GZIP'         => array('5.0.0', ''),
                'SOAP_COMPRESSION_DEFLATE'      => array('5.0.0', ''),
                'SOAP_AUTHENTICATION_BASIC'     => array('5.0.0', ''),
                'SOAP_AUTHENTICATION_DIGEST'    => array('5.0.0', ''),
                'UNKNOWN_TYPE'                  => array('5.0.0', ''),
                'XSD_STRING'                    => array('5.0.0', ''),
                'XSD_BOOLEAN'                   => array('5.0.0', ''),
                'XSD_DECIMAL'                   => array('5.0.0', ''),
                'XSD_FLOAT'                     => array('5.0.0', ''),
                'XSD_DOUBLE'                    => array('5.0.0', ''),
                'XSD_DURATION'                  => array('5.0.0', ''),
                'XSD_DATETIME'                  => array('5.0.0', ''),
                'XSD_TIME'                      => array('5.0.0', ''),
                'XSD_DATE'                      => array('5.0.0', ''),
                'XSD_GYEARMONTH'                => array('5.0.0', ''),
                'XSD_GYEAR'                     => array('5.0.0', ''),
                'XSD_GMONTHDAY'                 => array('5.0.0', ''),
                'XSD_GDAY'                      => array('5.0.0', ''),
                'XSD_GMONTH'                    => array('5.0.0', ''),
                'XSD_HEXBINARY'                 => array('5.0.0', ''),
                'XSD_BASE64BINARY'              => array('5.0.0', ''),
                'XSD_ANYURI'                    => array('5.0.0', ''),
                'XSD_QNAME'                     => array('5.0.0', ''),
                'XSD_NOTATION'                  => array('5.0.0', ''),
                'XSD_NORMALIZEDSTRING'          => array('5.0.0', ''),
                'XSD_TOKEN'                     => array('5.0.0', ''),
                'XSD_LANGUAGE'                  => array('5.0.0', ''),
                'XSD_NMTOKEN'                   => array('5.0.0', ''),
                'XSD_NAME'                      => array('5.0.0', ''),
                'XSD_NCNAME'                    => array('5.0.0', ''),
                'XSD_ID'                        => array('5.0.0', ''),
                'XSD_IDREF'                     => array('5.0.0', ''),
                'XSD_IDREFS'                    => array('5.0.0', ''),
                'XSD_ENTITY'                    => array('5.0.0', ''),
                'XSD_ENTITIES'                  => array('5.0.0', ''),
                'XSD_INTEGER'                   => array('5.0.0', ''),
                'XSD_NONPOSITIVEINTEGER'        => array('5.0.0', ''),
                'XSD_NEGATIVEINTEGER'           => array('5.0.0', ''),
                'XSD_LONG'                      => array('5.0.0', ''),
                'XSD_INT'                       => array('5.0.0', ''),
                'XSD_SHORT'                     => array('5.0.0', ''),
                'XSD_BYTE'                      => array('5.0.0', ''),
                'XSD_NONNEGATIVEINTEGER'        => array('5.0.0', ''),
                'XSD_UNSIGNEDLONG'              => array('5.0.0', ''),
                'XSD_UNSIGNEDINT'               => array('5.0.0', ''),
                'XSD_UNSIGNEDSHORT'             => array('5.0.0', ''),
                'XSD_UNSIGNEDBYTE'              => array('5.0.0', ''),
                'XSD_POSITIVEINTEGER'           => array('5.0.0', ''),
                'XSD_NMTOKENS'                  => array('5.0.0', ''),
                'XSD_ANYTYPE'                   => array('5.0.0', ''),
                'XSD_ANYXML'                    => array('5.0.0', ''),
                'APACHE_MAP'                    => array('5.0.0', ''),
                'SOAP_ENC_OBJECT'               => array('5.0.0', ''),
                'SOAP_ENC_ARRAY'                => array('5.0.0', ''),
                'XSD_1999_TIMEINSTANT'          => array('5.0.0', ''),
                'XSD_NAMESPACE'                 => array('5.0.0', ''),
                'XSD_1999_NAMESPACE'            => array('5.0.0', ''),
                'SOAP_SINGLE_ELEMENT_ARRAYS'    => array('5.0.0', ''),
                'SOAP_WAIT_ONE_WAY_CALLS'       => array('5.0.0', ''),
                'SOAP_USE_XSI_ARRAY_TYPE'       => array('5.0.0', ''),
                'WSDL_CACHE_NONE'               => array('5.0.0', ''),
                'WSDL_CACHE_DISK'               => array('5.0.0', ''),
                'WSDL_CACHE_MEMORY'             => array('5.0.0', ''),
                'WSDL_CACHE_BOTH'               => array('5.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
