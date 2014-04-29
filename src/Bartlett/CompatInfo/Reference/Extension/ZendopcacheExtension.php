<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ZendopcacheExtension extends AbstractReference
{
    const REF_NAME    = 'Zend OPcache';
    const REF_VERSION = '7.0.4-devFE';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // We forget version 7.0.0 (and previous non-free versions)
        // published as Zend Optimiser+
        // 7.0.1 is the first version named Zend OPcache

        // 7.0.1
        if (version_compare($version, '7.0.1', 'ge')) {
            $release = $this->getR70001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 7.0.2
        if (version_compare($version, '7.0.2', 'ge')) {
            $release = $this->getR70002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 7.0.3-dev
        if (version_compare($version, '7.0.3-dev', 'ge')) {
            $release = $this->getR70003dev();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 7.0.4-devFE
        if (version_compare($version, '7.0.4-devFE', 'ge')) {
            $release = $this->getR70004devFE();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR70001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '7.0.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-03-25',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'opcache.blacklist_filename'        => null,
            'opcache.consistency_checks'        => null,
            'opcache.dups_fix'                  => null,
            'opcache.enable'                    => null,
            'opcache.enable_cli'                => null,
            'opcache.enable_file_override'      => null,
            'opcache.error_log'                 => null,
            'opcache.fast_shutdown'             => null,
            'opcache.file_update_protection'    => null,
            'opcache.force_restart_timeout'     => null,
            'opcache.inherited_hack'            => null,
            'opcache.interned_strings_buffer'   => null,
            'opcache.load_comments'             => null,
            'opcache.log_verbosity_level'       => null,
            'opcache.max_accelerated_files'     => null,
            'opcache.max_file_size'             => null,
            'opcache.max_wasted_percentage'     => null,
            'opcache.memory_consumption'        => null,
            'opcache.mmap_base'                 => null,
            'opcache.optimization_level'        => null,
            'opcache.preferred_memory_model'    => null,
            'opcache.protect_memory'            => null,
            'opcache.restrict_api'              => null,
            'opcache.revalidate_freq'           => null,
            'opcache.revalidate_path'           => null,
            'opcache.save_comments'             => null,
            'opcache.use_cwd'                   => null,
            'opcache.validate_timestamps'       => null,
        );
        $release->functions = array(
            'opcache_reset'                     => null,
            'opcache_get_configuration'         => null,
            'opcache_get_status'                => null,
        );
        return $release;
    }

    protected function getR70002()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '7.0.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-06-05',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'opcache_invalidate'                => null,
        );
        return $release;
    }

    protected function getR70003dev()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '7.0.3-dev',       // (bundled in PHP 5.5.5)
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-10-17',
            'php.min' => '5.5.5',
            'php.max' => '',
        );
        $release->functions = array(
            'opcache_compile_file'              => null,
        );
        return $release;
    }

    protected function getR70004devFE()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '7.0.4-devFE',     // (bundled in PHP 5.5.11)
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-04-03',
            'php.min' => '5.5.11',
            'php.max' => '',
        );
        $release->functions = array(
            'opcache_is_script_cached'          => null,
        );
        return $release;
    }
}
