<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class StompExtension extends AbstractReference
{
    const REF_NAME    = 'stomp';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1.0
        if (version_compare($version, '0.1', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.3.0
        if (version_compare($version, '0.3.0', 'ge')) {
            $release = $this->getR00300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \StdClass;
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
        $release = new \StdClass;
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
}
