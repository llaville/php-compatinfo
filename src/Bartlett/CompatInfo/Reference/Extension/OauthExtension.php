<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class OauthExtension extends AbstractReference
{
    const REF_NAME    = 'OAuth';
    const REF_VERSION = '1.2.3';  // 2012-10-01 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.99.1
        if (version_compare($version, '0.99.1', 'ge')) {
            $release = $this->getR09901();
            $this->storage->attach($release);
        }

        // 0.99.5
        if (version_compare($version, '0.99.5', 'ge')) {
            $release = $this->getR09905();
            $this->storage->attach($release);
        }

        // 0.99.8
        if (version_compare($version, '0.99.8', 'ge')) {
            $release = $this->getR09908();
            $this->storage->attach($release);
        }

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $this->storage->attach($release);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $this->storage->attach($release);
        }

        // 1.2
        if (version_compare($version, '1.2', 'ge')) {
            $release = $this->getR10200();
            $this->storage->attach($release);
        }
    }

    protected function getR09901()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.99.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-11-21',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'oauth_urlencode'                   => null,
        );
        $release->constants = array(
            'OAUTH_AUTH_TYPE_AUTHORIZATION'     => null,
            'OAUTH_AUTH_TYPE_FORM'              => null,
            'OAUTH_AUTH_TYPE_URI'               => null,
            'OAUTH_SIG_METHOD_HMACSHA1'         => null,
        );
        $release->classes = array(
            'OAuth'                             => null,
            'OAuthException'                    => null,
        );
        return $release;
    }

    protected function getR09905()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.99.5',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-04-21',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_AUTH_TYPE_NONE'              => null,
            'OAUTH_HTTP_METHOD_GET'             => null,
            'OAUTH_HTTP_METHOD_HEAD'            => null,
            'OAUTH_HTTP_METHOD_POST'            => null,
            'OAUTH_HTTP_METHOD_PUT'             => null,
        );
        return $release;
    }

    protected function getR09908()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.99.8',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-04-30',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'oauth_get_sbs'                     => null,
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-06-02',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_BAD_NONCE'                   => null,
            'OAUTH_BAD_TIMESTAMP'               => null,
            'OAUTH_CONSUMER_KEY_REFUSED'        => null,
            'OAUTH_CONSUMER_KEY_UNKNOWN'        => null,
            'OAUTH_HTTP_METHOD_DELETE'          => null,
            'OAUTH_INVALID_SIGNATURE'           => null,
            'OAUTH_OK'                          => null,
            'OAUTH_PARAMETER_ABSENT'            => null,
            'OAUTH_REQENGINE_CURL'              => null,
            'OAUTH_REQENGINE_STREAMS'           => null,
            'OAUTH_SIGNATURE_METHOD_REJECTED'   => null,
            'OAUTH_SIG_METHOD_HMACSHA256'       => null,
            'OAUTH_SIG_METHOD_RSASHA1'          => null,
            'OAUTH_TOKEN_EXPIRED'               => null,
            'OAUTH_TOKEN_REJECTED'              => null,
            'OAUTH_TOKEN_REVOKED'               => null,
            'OAUTH_TOKEN_USED'                  => null,
            'OAUTH_VERIFIER_INVALID'            => null,
        );
        $release->classes = array(
            'OAuthProvider'                     => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-02-06',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_SSLCHECK_BOTH'               => null,
            'OAUTH_SSLCHECK_HOST'               => null,
            'OAUTH_SSLCHECK_NONE'               => null,
            'OAUTH_SSLCHECK_PEER'               => null,
        );
        return $release;
    }

    protected function getR10200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-06-27',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_SIG_METHOD_PLAINTEXT'        => null,
        );
        return $release;
    }
}
