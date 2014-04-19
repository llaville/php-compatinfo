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

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.99.1
        if (version_compare($version, '0.99.1', 'ge')) {
            $release = $this->getR09901();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.99.5
        if (version_compare($version, '0.99.5', 'ge')) {
            $release = $this->getR09905();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.99.8
        if (version_compare($version, '0.99.8', 'ge')) {
            $release = $this->getR09908();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.2
        if (version_compare($version, '1.2', 'ge')) {
            $release = $this->getR10200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR09901()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.99.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-11-21',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'oauth_urlencode'                   => array('5.1.0', ''),
        );
        $release->constants = array(
            'OAUTH_AUTH_TYPE_AUTHORIZATION'     => array('5.1.0', ''),
            'OAUTH_AUTH_TYPE_FORM'              => array('5.1.0', ''),
            'OAUTH_AUTH_TYPE_URI'               => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_HMACSHA1'         => array('5.1.0', ''),
        );
        $release->classes = array(
            'OAuth'                             => array('5.1.0', ''),
            'OAuthException'                    => array('5.1.0', ''),
        );
        return $release;
    }

    protected function getR09905()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.99.5',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-04-21',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_AUTH_TYPE_NONE'              => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_GET'             => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_HEAD'            => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_POST'            => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_PUT'             => array('5.1.0', ''),
        );
        return $release;
    }

    protected function getR09908()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.99.8',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-04-30',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'oauth_get_sbs'                     => array('5.1.0', ''),
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-06-02',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_BAD_NONCE'                   => array('5.1.0', ''),
            'OAUTH_BAD_TIMESTAMP'               => array('5.1.0', ''),
            'OAUTH_CONSUMER_KEY_REFUSED'        => array('5.1.0', ''),
            'OAUTH_CONSUMER_KEY_UNKNOWN'        => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_DELETE'          => array('5.1.0', ''),
            'OAUTH_INVALID_SIGNATURE'           => array('5.1.0', ''),
            'OAUTH_OK'                          => array('5.1.0', ''),
            'OAUTH_PARAMETER_ABSENT'            => array('5.1.0', ''),
            'OAUTH_REQENGINE_CURL'              => array('5.1.0', ''),
            'OAUTH_REQENGINE_STREAMS'           => array('5.1.0', ''),
            'OAUTH_SIGNATURE_METHOD_REJECTED'   => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_HMACSHA256'       => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_RSASHA1'          => array('5.1.0', ''),
            'OAUTH_TOKEN_EXPIRED'               => array('5.1.0', ''),
            'OAUTH_TOKEN_REJECTED'              => array('5.1.0', ''),
            'OAUTH_TOKEN_REVOKED'               => array('5.1.0', ''),
            'OAUTH_TOKEN_USED'                  => array('5.1.0', ''),
            'OAUTH_VERIFIER_INVALID'            => array('5.1.0', ''),
        );
        $release->classes = array(
            'OAuthProvider'                     => array('5.1.0', ''),
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-02-06',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_SSLCHECK_BOTH'               => array('5.1.0', ''),
            'OAUTH_SSLCHECK_HOST'               => array('5.1.0', ''),
            'OAUTH_SSLCHECK_NONE'               => array('5.1.0', ''),
            'OAUTH_SSLCHECK_PEER'               => array('5.1.0', ''),
        );
        return $release;
    }

    protected function getR10200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-06-27',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'OAUTH_SIG_METHOD_PLAINTEXT'        => array('5.1.0', ''),
        );
        return $release;
    }
}
