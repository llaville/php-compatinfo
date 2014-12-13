<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ApcExtension extends AbstractReference
{
    const REF_NAME    = 'apc';
    const REF_VERSION = '3.1.13';   // 2012-09-03 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 2.0.0
        if (version_compare($version, '2.0.0', 'ge')) {
            $release = $this->getR20000();
            $this->storage->attach($release);
        }

        // 3.0.0
        if (version_compare($version, '3.0.0', 'ge')) {
            $release = $this->getR30000();
            $this->storage->attach($release);
        }

        // 3.0.11
        if (version_compare($version, '3.0.11', 'ge')) {
            $release = $this->getR30011();
            $this->storage->attach($release);
        }

        // 3.0.13
        if (version_compare($version, '3.0.13', 'ge')) {
            $release = $this->getR30013();
            $this->storage->attach($release);
        }

        // 3.0.19
        if (version_compare($version, '3.0.19', 'ge')) {
            $release = $this->getR30019();
            $this->storage->attach($release);
        }

        // 3.1.1
        if (version_compare($version, '3.1.1', 'ge')) {
            $release = $this->getR30101();
            $this->storage->attach($release);
        }

        // 3.1.4
        if (version_compare($version, '3.1.4', 'ge')) {
            $release = $this->getR30104();
            $this->storage->attach($release);
        }

        // 3.1.12
        if (version_compare($version, '3.1.12', 'ge')) {
            $release = $this->getR30112();
            $this->storage->attach($release);
        }
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-07-01',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.enabled'                   => null,
            'apc.filters'                   => null,
            'apc.gc_ttl'                    => null,
            'apc.mmap_file_mask'            => null,
            'apc.num_files_hint'            => null,
            'apc.optimization'              => null,
            'apc.shm_segments'              => null,
            'apc.shm_size'                  => null,
        );
        $release->functions = array(
            'apc_cache_info'                => null,
            'apc_clear_cache'               => null,
            'apc_sma_info'                  => null,
        );
        return $release;
    }

    protected function getR30000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-07-05',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.cache_by_default'          => null,
            'apc.slam_defense'              => null,
            'apc.ttl'                       => null,
            'apc.user_entries_hint'         => null,
            'apc.user_ttl'                  => null,
        );
        $release->functions = array(
            'apc_define_constants'          => null,
            'apc_delete'                    => null,
            'apc_fetch'                     => null,
            'apc_load_constants'            => null,
            'apc_store'                     => null,
        );
        return $release;
    }

    protected function getR30011()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.11',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-08-17',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.enable_cli'                => null,
            'apc.file_update_protection'    => null,
            'apc.max_file_size'             => null,
            'apc.report_autofilter'         => null,
            'apc.stat'                      => null,
            'apc.write_lock'                => null,
        );
        return $release;
    }

    protected function getR30013()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.13',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-02-24',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'apc_add'                       => null,
            'apc_compile_file'              => null,
        );
        return $release;
    }

    protected function getR30019()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.19',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-05-15',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.coredump_unmap'            => null,
            'apc.include_once_override'     => null,
            'apc.rfc1867'                   => null,
            'apc.rfc1867_prefix'            => null,
            'apc.rfc1867_name'              => null,
            'apc.rfc1867_freq'              => null,
            'apc.stat_ctime'                => null,
        );
        return $release;
    }

    protected function getR30101()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.1.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-12-12',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.canonicalize'              => null,
            'apc.file_md5'                  => null,
            'apc.rfc1867_ttl'               => null,
            'apc.preload_path'              => null,
        );
        $release->functions = array(
            'apc_cas'                       => null,
            'apc_dec'                       => null,
            'apc_delete_file'               => null,
            'apc_inc'                       => null,
        );
        $release->classes = array(
            'APCIterator'                   => null
        );
        $release->constants = array(
            'APC_ITER_ALL'                  => null,
            'APC_ITER_ATIME'                => null,
            'APC_ITER_CTIME'                => null,
            'APC_ITER_DEVICE'               => null,
            'APC_ITER_DTIME'                => null,
            'APC_ITER_FILENAME'             => null,
            'APC_ITER_INODE'                => null,
            'APC_ITER_KEY'                  => null,
            'APC_ITER_MD5'                  => null,
            'APC_ITER_MEM_SIZE'             => null,
            'APC_ITER_MTIME'                => null,
            'APC_ITER_NONE'                 => null,
            'APC_ITER_NUM_HITS'             => null,
            'APC_ITER_REFCOUNT'             => null,
            'APC_ITER_TTL'                  => null,
            'APC_ITER_TYPE'                 => null,
            'APC_ITER_VALUE'                => null,
            'APC_LIST_ACTIVE'               => null,
            'APC_LIST_DELETED'              => null,
        );
        return $release;
    }

    protected function getR30104()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.1.4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-12-12',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'APC_BIN_VERIFY_MD5'            => null,
            'APC_BIN_VERIFY_CRC32'          => null,
        );
        $release->functions = array(
            'apc_bin_dump'                  => null,
            'apc_bin_dumpfile'              => null,
            'apc_bin_load'                  => null,
            'apc_bin_loadfile'              => null,
            'apc_exists'                    => null,
        );
        return $release;
    }

    protected function getR30112()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.1.12',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-12-12',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'apc.lazy_classes'              => null,
            'apc.lazy_functions'            => null,
            'apc.serializer'                => null,
            'apc.shm_strings_buffer'        => null,
            'apc.use_request_time'          => null,
        );
        return $release;
    }
}
