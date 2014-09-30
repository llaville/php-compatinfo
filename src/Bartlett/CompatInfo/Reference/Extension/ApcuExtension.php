<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ApcuExtension extends AbstractReference
{
    const REF_NAME    = 'apcu';
    const REF_VERSION = '4.0.6';    // 2014-06-12 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.3
        if (version_compare($version, '4.0.3', 'ge')) {
            $release = $this->getR40003();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-03-26',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.mmap_file_mask'            => null,
            'apc.coredump_unmap'            => null,
            'apc.enable_cli'                => null,
            'apc.enabled'                   => null,
            'apc.entries_hint'              => null,
            'apc.gc_ttl'                    => null,
            'apc.preload_path'              => null,
            'apc.rfc1867'                   => null,
            'apc.rfc1867_freq'              => null,
            'apc.rfc1867_name'              => null,
            'apc.rfc1867_prefix'            => null,
            'apc.rfc1867_ttl'               => null,
            'apc.serializer'                => null,
            'apc.shm_segments'              => null,
            'apc.shm_size'                  => null,
            'apc.slam_defense'              => null,
            'apc.smart'                     => null,
            'apc.ttl'                       => null,
            'apc.use_request_time'          => null,
        );
        $release->functions = array(
            'apcu_add'                      => null,
            'apcu_bin_dump'                 => null,
            'apcu_bin_dumpfile'             => null,
            'apcu_bin_load'                 => null,
            'apcu_bin_loadfile'             => null,
            'apcu_cache_info'               => null,
            'apcu_cas'                      => null,
            'apcu_clear_cache'              => null,
            'apcu_dec'                      => null,
            'apcu_delete'                   => null,
            'apcu_exists'                   => null,
            'apcu_fetch'                    => null,
            'apcu_inc'                      => null,
            'apcu_sma_info'                 => null,
            'apcu_store'                    => null,
        );
        return $release;
    }

    protected function getR40001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-04-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.writable'                  => null,
        );
        $release->constants = array(
            'APCU_APC_FULL_BC'              => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-09-14',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'apcu_key_info'                 => null,
        );
        return $release;
    }

    protected function getR40003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.3',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-01-27',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'apcu_enabled'                  => null,
        );
        return $release;
    }
}
