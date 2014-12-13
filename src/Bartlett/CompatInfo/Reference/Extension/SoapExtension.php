<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SoapExtension extends AbstractReference
{
    const REF_NAME    = 'soap';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $this->storage->attach($release);
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
        $release->iniEntries = array(
            'soap.wsdl_cache'               => null,
            'soap.wsdl_cache_dir'           => null,
            'soap.wsdl_cache_enabled'       => null,
            'soap.wsdl_cache_limit'         => null,
            'soap.wsdl_cache_ttl'           => null,
        );
        $release->classes = array(
            'SoapClient'                    => null,
            'SoapFault'                     => null,
            'SoapHeader'                    => null,
            'SoapParam'                     => null,
            'SoapServer'                    => null,
            'SoapVar'                       => null,
        );
        $release->constants = array(
            'APACHE_MAP'                    => null,
            'SOAP_1_1'                      => null,
            'SOAP_1_2'                      => null,
            'SOAP_ACTOR_NEXT'               => null,
            'SOAP_ACTOR_NONE'               => null,
            'SOAP_ACTOR_UNLIMATERECEIVER'   => null,
            'SOAP_AUTHENTICATION_BASIC'     => null,
            'SOAP_AUTHENTICATION_DIGEST'    => null,
            'SOAP_COMPRESSION_ACCEPT'       => null,
            'SOAP_COMPRESSION_DEFLATE'      => null,
            'SOAP_COMPRESSION_GZIP'         => null,
            'SOAP_DOCUMENT'                 => null,
            'SOAP_ENCODED'                  => null,
            'SOAP_ENC_ARRAY'                => null,
            'SOAP_ENC_OBJECT'               => null,
            'SOAP_FUNCTIONS_ALL'            => null,
            'SOAP_LITERAL'                  => null,
            'SOAP_PERSISTENCE_REQUEST'      => null,
            'SOAP_PERSISTENCE_SESSION'      => null,
            'SOAP_RPC'                      => null,
            'SOAP_SINGLE_ELEMENT_ARRAYS'    => null,
            'SOAP_USE_XSI_ARRAY_TYPE'       => null,
            'SOAP_WAIT_ONE_WAY_CALLS'       => null,
            'UNKNOWN_TYPE'                  => null,
            'WSDL_CACHE_BOTH'               => null,
            'WSDL_CACHE_DISK'               => null,
            'WSDL_CACHE_MEMORY'             => null,
            'WSDL_CACHE_NONE'               => null,
            'XSD_1999_NAMESPACE'            => null,
            'XSD_1999_TIMEINSTANT'          => null,
            'XSD_ANYTYPE'                   => null,
            'XSD_ANYURI'                    => null,
            'XSD_ANYXML'                    => null,
            'XSD_BASE64BINARY'              => null,
            'XSD_BOOLEAN'                   => null,
            'XSD_BYTE'                      => null,
            'XSD_DATE'                      => null,
            'XSD_DATETIME'                  => null,
            'XSD_DECIMAL'                   => null,
            'XSD_DOUBLE'                    => null,
            'XSD_DURATION'                  => null,
            'XSD_ENTITIES'                  => null,
            'XSD_ENTITY'                    => null,
            'XSD_FLOAT'                     => null,
            'XSD_GDAY'                      => null,
            'XSD_GMONTH'                    => null,
            'XSD_GMONTHDAY'                 => null,
            'XSD_GYEAR'                     => null,
            'XSD_GYEARMONTH'                => null,
            'XSD_HEXBINARY'                 => null,
            'XSD_ID'                        => null,
            'XSD_IDREF'                     => null,
            'XSD_IDREFS'                    => null,
            'XSD_INT'                       => null,
            'XSD_INTEGER'                   => null,
            'XSD_LANGUAGE'                  => null,
            'XSD_LONG'                      => null,
            'XSD_NAME'                      => null,
            'XSD_NAMESPACE'                 => null,
            'XSD_NCNAME'                    => null,
            'XSD_NEGATIVEINTEGER'           => null,
            'XSD_NMTOKEN'                   => null,
            'XSD_NMTOKENS'                  => null,
            'XSD_NONNEGATIVEINTEGER'        => null,
            'XSD_NONPOSITIVEINTEGER'        => null,
            'XSD_NORMALIZEDSTRING'          => null,
            'XSD_NOTATION'                  => null,
            'XSD_POSITIVEINTEGER'           => null,
            'XSD_QNAME'                     => null,
            'XSD_SHORT'                     => null,
            'XSD_STRING'                    => null,
            'XSD_TIME'                      => null,
            'XSD_TOKEN'                     => null,
            'XSD_UNSIGNEDBYTE'              => null,
            'XSD_UNSIGNEDINT'               => null,
            'XSD_UNSIGNEDLONG'              => null,
            'XSD_UNSIGNEDSHORT'             => null,
        );
        $release->functions = array(
            'is_soap_fault'                 => null,
            'use_soap_error_handler'        => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->constants = array(
            'SOAP_SSL_METHOD_SSLv2'         => null,
            'SOAP_SSL_METHOD_SSLv23'        => null,
            'SOAP_SSL_METHOD_SSLv3'         => null,
            'SOAP_SSL_METHOD_TLS'           => null,
        );
        return $release;
    }
}
