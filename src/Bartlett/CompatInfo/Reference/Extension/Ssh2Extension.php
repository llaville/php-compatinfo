<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class Ssh2Extension extends AbstractReference
{
    const REF_NAME    = 'ssh2';
    const REF_VERSION = '0.12'; // 2012-10-15

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.5
        if (version_compare($version, '0.5', 'ge')) {
            $release = $this->getR00500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.7
        if (version_compare($version, '0.7', 'ge')) {
            $release = $this->getR00700();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.8
        if (version_compare($version, '0.8', 'ge')) {
            $release = $this->getR00800();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.10
        if (version_compare($version, '0.10', 'ge')) {
            $release = $this->getR01000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.12
        if (version_compare($version, '0.12', 'ge')) {
            $release = $this->getR01200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.5',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-01-11',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ssh2_auth_none'                    => null,
            'ssh2_auth_password'                => null,
            'ssh2_auth_pubkey_file'             => null,
            'ssh2_connect'                      => null,
            'ssh2_exec'                         => null,
            'ssh2_fetch_stream'                 => null,
            'ssh2_fingerprint'                  => null,
            'ssh2_forward_accept'               => null,
            'ssh2_forward_listen'               => null,
            'ssh2_methods_negotiated'           => null,
            'ssh2_scp_recv'                     => null,
            'ssh2_scp_send'                     => null,
            'ssh2_sftp'                         => null,
            'ssh2_sftp_lstat'                   => null,
            'ssh2_sftp_mkdir'                   => null,
            'ssh2_sftp_readlink'                => null,
            'ssh2_sftp_realpath'                => null,
            'ssh2_sftp_rename'                  => null,
            'ssh2_sftp_rmdir'                   => null,
            'ssh2_sftp_stat'                    => null,
            'ssh2_sftp_symlink'                 => null,
            'ssh2_sftp_unlink'                  => null,
            'ssh2_shell'                        => null,
            'ssh2_tunnel'                       => null,
        );
        $release->constants = array(
            'SSH2_DEFAULT_TERMINAL'             => null,
            'SSH2_DEFAULT_TERM_HEIGHT'          => null,
            'SSH2_DEFAULT_TERM_UNIT'            => null,
            'SSH2_DEFAULT_TERM_WIDTH'           => null,
            'SSH2_FINGERPRINT_HEX'              => null,
            'SSH2_FINGERPRINT_MD5'              => null,
            'SSH2_FINGERPRINT_RAW'              => null,
            'SSH2_FINGERPRINT_SHA1'             => null,
            'SSH2_STREAM_STDERR'                => null,
            'SSH2_STREAM_STDIO'                 => null,
            'SSH2_TERM_UNIT_CHARS'              => null,
            'SSH2_TERM_UNIT_PIXELS'             => null,
        );
        return $release;
    }

    protected function getR00700()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.7',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-02-24',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ssh2_auth_hostbased_file'          => null,
        );
        return $release;
    }

    protected function getR00800()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.8',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-05-17',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ssh2_poll'                         => null,
        );
        $release->constants = array(
            'SSH2_POLLERR'                      => null,
            'SSH2_POLLEXT'                      => null,
            'SSH2_POLLHUP'                      => null,
            'SSH2_POLLIN'                       => null,
            'SSH2_POLLNVAL'                     => null,
            'SSH2_POLLOUT'                      => null,
            'SSH2_POLL_CHANNEL_CLOSED'          => null,
            'SSH2_POLL_LISTENER_CLOSED'         => null,
            'SSH2_POLL_SESSION_CLOSED'          => null,
        );
        return $release;
    }

    protected function getR01000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.10',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-11-01',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ssh2_publickey_add'                => null,
            'ssh2_publickey_init'               => null,
            'ssh2_publickey_list'               => null,
            'ssh2_publickey_remove'             => null,
        );
        return $release;
    }

    protected function getR01200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.12',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-10-15',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ssh2_auth_agent'                   => null,
            'ssh2_sftp_chmod'                   => null,
        );
        return $release;
    }
}
