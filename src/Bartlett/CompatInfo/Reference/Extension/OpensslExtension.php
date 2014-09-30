<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class OpensslExtension extends AbstractReference
{
    const REF_NAME    = 'openssl';
    const REF_VERSION = '';

    private $version_number;

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $this->version_number = $this->getMetaVersion('version_number');

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.6
        if (version_compare($version, '4.0.6', 'ge')) {
            $release = $this->getR40006();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.2
        if (version_compare($version, '5.2.2', 'ge')) {
            $release = $this->getR50202();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.8
        if (version_compare($version, '5.2.8', 'ge')) {
            $release = $this->getR50208();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.2
        if (version_compare($version, '5.3.2', 'ge')) {
            $release = $this->getR50302();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.3
        if (version_compare($version, '5.3.3', 'ge')) {
            $release = $this->getR50303();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.8
        if (version_compare($version, '5.4.8', 'ge')) {
            $release = $this->getR50408();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0alpha1
        if (version_compare($version, '5.6.0alpha1', 'ge')) {
            $release = $this->getR50600a1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0beta1
        if (version_compare($version, '5.6.0beta1', 'ge')) {
            $release = $this->getR50600b1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'openssl_free_key'              => null,
            'openssl_get_privatekey'        => null,
            'openssl_get_publickey'         => null,
            'openssl_open'                  => null,
            'openssl_seal'                  => null,
            'openssl_sign'                  => array('4.0.4', '', '4.0.4, 4.0.4, 4.0.4, 5.0.0'),
            'openssl_verify'                => null,
        );
        $release->constants = array(
            'OPENSSL_KEYTYPE_DH'            => null,
            'OPENSSL_KEYTYPE_DSA'           => null,
            'OPENSSL_KEYTYPE_EC'            => null,
            'OPENSSL_KEYTYPE_RSA'           => null,
            'OPENSSL_NO_PADDING'            => null,
            'OPENSSL_PKCS1_OAEP_PADDING'    => null,
            'OPENSSL_PKCS1_PADDING'         => null,
            'OPENSSL_SSLV23_PADDING'        => null,
            'X509_PURPOSE_ANY'              => null,
            'X509_PURPOSE_CRL_SIGN'         => null,
            'X509_PURPOSE_NS_SSL_SERVER'    => null,
            'X509_PURPOSE_SMIME_ENCRYPT'    => null,
            'X509_PURPOSE_SMIME_SIGN'       => null,
            'X509_PURPOSE_SSL_CLIENT'       => null,
            'X509_PURPOSE_SSL_SERVER'       => null,
        );
        return $release;
    }

    protected function getR40006()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-06-23',
            'php.min' => '4.0.6',
            'php.max' => '',
        );
        $release->functions = array(
            'openssl_error_string'          => null,
            'openssl_pkcs7_decrypt'         => null,
            'openssl_pkcs7_encrypt'         => null,
            'openssl_pkcs7_sign'            => null,
            'openssl_pkcs7_verify'          => null,
            'openssl_private_decrypt'       => null,
            'openssl_private_encrypt'       => null,
            'openssl_public_decrypt'        => null,
            'openssl_public_encrypt'        => null,
            'openssl_x509_checkpurpose'     => null,
            'openssl_x509_free'             => null,
            'openssl_x509_parse'            => null,
            'openssl_x509_read'             => null,
        );
        $release->constants = array(
            'PKCS7_BINARY'                  => null,
            'PKCS7_DETACHED'                => null,
            'PKCS7_NOATTR'                  => null,
            'PKCS7_NOCERTS'                 => null,
            'PKCS7_NOCHAIN'                 => null,
            'PKCS7_NOINTERN'                => null,
            'PKCS7_NOSIGS'                  => null,
            'PKCS7_NOVERIFY'                => null,
            'PKCS7_TEXT'                    => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'openssl_csr_export'                => null,
            'openssl_csr_export_to_file'        => null,
            'openssl_csr_new'                   => null,
            'openssl_csr_sign'                  => null,
            'openssl_pkey_export'               => null,
            'openssl_pkey_export_to_file'       => null,
            'openssl_pkey_free'                 => null,
            'openssl_pkey_get_private'          => null,
            'openssl_pkey_get_public'           => null,
            'openssl_pkey_new'                  => null,
            'openssl_x509_check_private_key'    => null,
            'openssl_x509_export'               => null,
            'openssl_x509_export_to_file'       => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OPENSSL_CIPHER_3DES'               => null,
            'OPENSSL_CIPHER_DES'                => null,
            'OPENSSL_CIPHER_RC2_128'            => null,
            'OPENSSL_CIPHER_RC2_40'             => null,
            'OPENSSL_CIPHER_RC2_64'             => null,
        );
        return $release;
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
        $release->constants = array(
            'OPENSSL_ALGO_MD2'                  => null,
            'OPENSSL_ALGO_MD4'                  => null,
            'OPENSSL_ALGO_MD5'                  => null,
            'OPENSSL_ALGO_SHA1'                 => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OPENSSL_VERSION_NUMBER'            => null,
            'OPENSSL_VERSION_TEXT'              => null,
        );
        $release->functions = array(
            'openssl_csr_get_public_key'        => null,
            'openssl_csr_get_subject'           => null,
            'openssl_pkey_get_details'          => null,
        );
        return $release;
    }

    protected function getR50202()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->functions = array(
            'openssl_pkcs12_export'             => null,
            'openssl_pkcs12_export_to_file'     => null,
            'openssl_pkcs12_read'               => null,
        );
        return $release;
    }

    protected function getR50208()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.8',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.2.8',
            'php.max' => '',
        );
        $release->constants = array(
            'OPENSSL_ALGO_DSS1'                 => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'openssl_decrypt'                   => null,
            'openssl_dh_compute_key'            => null,
            'openssl_digest'                    => null,
            'openssl_encrypt'                   => null,
            'openssl_get_cipher_methods'        => null,
            'openssl_get_md_methods'            => null,
            'openssl_random_pseudo_bytes'       => null,
        );
        return $release;
    }

    protected function getR50302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-03-04',
            'php.min' => '5.3.2',
            'php.max' => '',
        );
        $release->constants = array(
            'OPENSSL_TLSEXT_SERVER_NAME'        => null,
        );
        return $release;
    }

    protected function getR50303()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-07-22',
            'php.min' => '5.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'openssl_cipher_iv_length'          => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OPENSSL_CIPHER_AES_128_CBC'        => null,
            'OPENSSL_CIPHER_AES_192_CBC'        => null,
            'OPENSSL_CIPHER_AES_256_CBC'        => null,
            'OPENSSL_RAW_DATA'                  => null,
            'OPENSSL_ZERO_PADDING'              => null,
        );
        return $release;
    }

    protected function getR50408()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.8',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.4.8',
            'php.max' => '',
        );
        if ($this->version_number > 0x0090708f) {
            $release->constants = array(
                'OPENSSL_ALGO_SHA224'               => null,
                'OPENSSL_ALGO_SHA256'               => null,
                'OPENSSL_ALGO_SHA384'               => null,
                'OPENSSL_ALGO_SHA512'               => null,
                'OPENSSL_ALGO_RMD160'               => null,
            );
        }
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
        $release->functions = array(
            'openssl_pbkdf2'                    => null,
        );
        return $release;
    }

    protected function getR50600a1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-01-21',
            'php.min' => '5.6.0alpha1',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'openssl.cafile'                    => null,
            'openssl.capath'                    => null,
        );
        $release->constants = array(
            'OPENSSL_ALGO_SHA224'               => null,
        );
        $release->functions = array(
            'openssl_spki_export'               => null,
            'openssl_spki_export_challenge'     => null,
            'openssl_spki_new'                  => null,
            'openssl_spki_verify'               => null,
            'openssl_x509_fingerprint'          => null,
        );
        return $release;
    }

    protected function getR50600b1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.0beta1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-04-11',
            'php.min' => '5.6.0beta1',
            'php.max' => '',
        );
        $release->constants = array(
            'OPENSSL_DEFAULT_STREAM_CIPHERS'    => null,
        );
        $release->functions = array(
            'openssl_get_cert_locations'        => null,
        );
        return $release;
    }
}
