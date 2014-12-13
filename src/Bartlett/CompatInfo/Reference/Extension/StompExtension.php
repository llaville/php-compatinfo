<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class StompExtension extends AbstractReference
{
    const REF_NAME    = 'stomp';
    const REF_VERSION = '1.0.6';    // 2014-12-07 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.1.0
        if (version_compare($version, '0.1', 'ge')) {
            $release = $this->getR00100();
            $this->storage->attach($release);
        }

        // 0.3.0
        if (version_compare($version, '0.3.0', 'ge')) {
            $release = $this->getR00300();
            $this->storage->attach($release);
        }

        // 1.0.6
        if (version_compare($version, '1.0.6', 'ge')) {
            $release = $this->getR10006();
            $this->storage->attach($release);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2009-10-30',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'stomp.default_broker'                  => null,
        );
        $release->classes = array(
            'Stomp'                                 => null,
            'StompException'                        => null,
            'StompFrame'                            => null,
        );
        $release->functions = array(
            'stomp_abort'                           => null,
            'stomp_ack'                             => null,
            'stomp_begin'                           => null,
            'stomp_close'                           => null,
            'stomp_commit'                          => null,
            'stomp_connect'                         => null,
            'stomp_error'                           => null,
            'stomp_get_read_timeout'                => null,
            'stomp_get_session_id'                  => null,
            'stomp_has_frame'                       => null,
            'stomp_read_frame'                      => null,
            'stomp_send'                            => null,
            'stomp_set_read_timeout'                => null,
            'stomp_subscribe'                       => null,
            'stomp_unsubscribe'                     => null,
            'stomp_version'                         => null,
        );
        return $release;
    }

    protected function getR00300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.3.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-11-06',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'stomp.default_connection_timeout_sec'  => null,
            'stomp.default_connection_timeout_usec' => null,
            'stomp.default_read_timeout_sec'        => null,
            'stomp.default_read_timeout_usec'       => null,
        );
        $release->functions = array(
            'stomp_connect_error'                   => null,
        );
        return $release;
    }

    protected function getR10006()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-12-07',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'stomp.default_username'    => null,
            'stomp.default_password'    => null,
        );
        $release->functions = array(
            'stomp_nack'                => null,
        );
        return $release;
    }
}
