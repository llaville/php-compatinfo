<?php
/**
 * Version informations about openssl extension
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
 * All interfaces, classes, functions, constants about openssl extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.openssl.php
 */
class PHP_CompatInfo_Reference_Openssl
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'openssl';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

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
        $phpMin = '4.0.4';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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
     * @link   http://www.php.net/manual/en/ref.openssl.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'openssl_cipher_iv_length'       => array('5.3.3', ''),
            'openssl_csr_export'             => array('4.2.0', ''),
            'openssl_csr_export_to_file'     => array('4.2.0', ''),
            'openssl_csr_get_public_key'     => array('5.2.0', ''),
            'openssl_csr_get_subject'        => array('5.2.0', ''),
            'openssl_csr_new'                => array('4.2.0', ''),
            'openssl_csr_sign'               => array('4.2.0', ''),
            'openssl_decrypt'                => array('5.3.0', ''),
            'openssl_dh_compute_key'         => array('5.3.0', ''),
            'openssl_digest'                 => array('5.3.0', ''),
            'openssl_encrypt'                => array('5.3.0', ''),
            'openssl_error_string'           => array('4.0.6', ''),
            'openssl_free_key'               => array('4.0.4', ''),
            'openssl_get_cipher_methods'     => array('5.3.0', ''),
            'openssl_get_md_methods'         => array('5.3.0', ''),
            'openssl_get_privatekey'         => array('4.0.4', ''),
            'openssl_get_publickey'          => array('4.0.4', ''),
            'openssl_open'                   => array('4.0.4', ''),
            'openssl_pkcs12_export'          => array('5.2.2', ''),
            'openssl_pkcs12_export_to_file'  => array('5.2.2', ''),
            'openssl_pkcs12_read'            => array('5.2.2', ''),
            'openssl_pkcs7_decrypt'          => array('4.0.6', ''),
            'openssl_pkcs7_encrypt'          => array('4.0.6', ''),
            'openssl_pkcs7_sign'             => array('4.0.6', ''),
            'openssl_pkcs7_verify'           => array('4.0.6', ''),
            'openssl_pkey_export'            => array('4.2.0', ''),
            'openssl_pkey_export_to_file'    => array('4.2.0', ''),
            'openssl_pkey_free'              => array('4.2.0', ''),
            'openssl_pkey_get_details'       => array('5.2.0', ''),
            'openssl_pkey_get_private'       => array('4.2.0', ''),
            'openssl_pkey_get_public'        => array('4.2.0', ''),
            'openssl_pkey_new'               => array('4.2.0', ''),
            'openssl_private_decrypt'        => array('4.0.6', ''),
            'openssl_private_encrypt'        => array('4.0.6', ''),
            'openssl_public_decrypt'         => array('4.0.6', ''),
            'openssl_public_encrypt'         => array('4.0.6', ''),
            'openssl_random_pseudo_bytes'    => array('5.3.0', ''),
            'openssl_seal'                   => array('4.0.4', ''),
            'openssl_sign'                   => array('4.0.4', '', '4.0.4, 4.0.4, 4.0.4, 5.0.0'),
            'openssl_verify'                 => array('4.0.4', ''),
            'openssl_x509_check_private_key' => array('4.2.0', ''),
            'openssl_x509_checkpurpose'      => array('4.0.6', ''),
            'openssl_x509_export'            => array('4.2.0', ''),
            'openssl_x509_export_to_file'    => array('4.2.0', ''),
            'openssl_x509_free'              => array('4.0.6', ''),
            'openssl_x509_parse'             => array('4.0.6', ''),
            'openssl_x509_read'              => array('4.0.6', ''),
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
     * @link   http://www.php.net/manual/en/openssl.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'OPENSSL_ALGO_DSS1'              => array('5.2.8', ''),
            'OPENSSL_ALGO_MD2'               => array('5.0.0', ''),
            'OPENSSL_ALGO_MD4'               => array('5.0.0', ''),
            'OPENSSL_ALGO_MD5'               => array('5.0.0', ''),
            'OPENSSL_ALGO_SHA1'              => array('5.0.0', ''),
            'OPENSSL_CIPHER_3DES'            => array('4.3.0', ''),
            'OPENSSL_CIPHER_AES_128_CBC'     => array('5.4.0', ''),
            'OPENSSL_CIPHER_AES_192_CBC'     => array('5.4.0', ''),
            'OPENSSL_CIPHER_AES_256_CBC'     => array('5.4.0', ''),
            'OPENSSL_CIPHER_DES'             => array('4.3.0', ''),
            'OPENSSL_CIPHER_RC2_128'         => array('4.3.0', ''),
            'OPENSSL_CIPHER_RC2_40'          => array('4.3.0', ''),
            'OPENSSL_CIPHER_RC2_64'          => array('4.3.0', ''),
            'OPENSSL_KEYTYPE_DH'             => array('4.0.4', ''),
            'OPENSSL_KEYTYPE_DSA'            => array('4.0.4', ''),
            'OPENSSL_KEYTYPE_EC'             => array('4.0.4', ''),
            'OPENSSL_KEYTYPE_RSA'            => array('4.0.4', ''),
            'OPENSSL_NO_PADDING'             => array('4.0.4', ''),
            'OPENSSL_PKCS1_OAEP_PADDING'     => array('4.0.4', ''),
            'OPENSSL_PKCS1_PADDING'          => array('4.0.4', ''),
            'OPENSSL_RAW_DATA'               => array('5.4.0', ''),
            'OPENSSL_SSLV23_PADDING'         => array('4.0.4', ''),
            'OPENSSL_TLSEXT_SERVER_NAME'     => array('5.3.2', ''),
            'OPENSSL_VERSION_NUMBER'         => array('5.2.0', ''),
            'OPENSSL_VERSION_TEXT'           => array('5.2.0', ''),
            'OPENSSL_ZERO_PADDING'           => array('5.4.0', ''),
            'PKCS7_BINARY'                   => array('4.0.6', ''),
            'PKCS7_DETACHED'                 => array('4.0.6', ''),
            'PKCS7_NOATTR'                   => array('4.0.6', ''),
            'PKCS7_NOCERTS'                  => array('4.0.6', ''),
            'PKCS7_NOCHAIN'                  => array('4.0.6', ''),
            'PKCS7_NOINTERN'                 => array('4.0.6', ''),
            'PKCS7_NOSIGS'                   => array('4.0.6', ''),
            'PKCS7_NOVERIFY'                 => array('4.0.6', ''),
            'PKCS7_TEXT'                     => array('4.0.6', ''),
            'X509_PURPOSE_ANY'               => array('4.0.4', ''),
            'X509_PURPOSE_CRL_SIGN'          => array('4.0.4', ''),
            'X509_PURPOSE_NS_SSL_SERVER'     => array('4.0.4', ''),
            'X509_PURPOSE_SMIME_ENCRYPT'     => array('4.0.4', ''),
            'X509_PURPOSE_SMIME_SIGN'        => array('4.0.4', ''),
            'X509_PURPOSE_SSL_CLIENT'        => array('4.0.4', ''),
            'X509_PURPOSE_SSL_SERVER'        => array('4.0.4', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
