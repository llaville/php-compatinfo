<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class LibeventExtension extends AbstractReference
{
    const REF_NAME    = 'libevent';
    const REF_VERSION = '0.1.0';  // 2013-05-22 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        if (PATH_SEPARATOR == ';') {
            // windows build issue
            if ($version === '0.0.4' && function_exists('event_priority_set')) {
                // the build 0.0.5 gave a fake version
                $version = '0.0.5';
            }
        }

        // 0.0.2
        if (version_compare($version, '0.0.2', 'ge')) {
            $release = $this->getR00002();
            $this->storage->attach($release);
        }

        // 0.0.4
        if (version_compare($version, '0.0.4', 'ge')) {
            $release = $this->getR00004();
            $this->storage->attach($release);
        }

        // 0.0.5
        if (version_compare($version, '0.0.5', 'ge')) {
            $release = $this->getR00005();
            $this->storage->attach($release);
        }

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $this->storage->attach($release);
        }
    }

    protected function getR00002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.0.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-08-29',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'EVLOOP_NONBLOCK'                       => null,
            'EVLOOP_ONCE'                           => null,
            'EV_PERSIST'                            => null,
            'EV_READ'                               => null,
            'EV_SIGNAL'                             => null,
            'EV_TIMEOUT'                            => null,
            'EV_WRITE'                              => null,
        );
        $release->functions = array(
            'event_add'                             => null,
            'event_base_free'                       => null,
            'event_base_loop'                       => null,
            'event_base_loopbreak'                  => null,
            'event_base_loopexit'                   => null,
            'event_base_new'                        => null,
            'event_base_priority_init'              => null,
            'event_base_set'                        => null,
            'event_buffer_base_set'                 => null,
            'event_buffer_disable'                  => null,
            'event_buffer_enable'                   => null,
            'event_buffer_fd_set'                   => null,
            'event_buffer_free'                     => null,
            'event_buffer_new'                      => null,
            'event_buffer_priority_set'             => null,
            'event_buffer_read'                     => null,
            'event_buffer_timeout_set'              => null,
            'event_buffer_watermark_set'            => null,
            'event_buffer_write'                    => null,
            'event_del'                             => null,
            'event_free'                            => null,
            'event_new'                             => null,
            'event_set'                             => null,
            'event_timer_add'                       => null,
            'event_timer_del'                       => null,
            'event_timer_new'                       => null,
            'event_timer_pending'                   => null,
            'event_timer_set'                       => null,
        );
        return $release;
    }

    protected function getR00004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.0.4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2010-06-23',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'EVBUFFER_EOF'                          => null,
            'EVBUFFER_ERROR'                        => null,
            'EVBUFFER_READ'                         => null,
            'EVBUFFER_TIMEOUT'                      => null,
            'EVBUFFER_WRITE'                        => null,
        );
        $release->functions = array(
            'event_buffer_set_callback'             => null,
        );
        return $release;
    }

    protected function getR00005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.0.5',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-04-02',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'event_priority_set'                    => null,
        );
        return $release;
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-05-22',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'event_base_reinit'                     => null,
        );
        return $release;
    }
}
