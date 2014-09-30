<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MemcacheExtension extends AbstractReference
{
    const REF_NAME    = 'memcache';
    const REF_VERSION = '3.0.8';  // 2013-04-07 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.2
        if (version_compare($version, '0.2', 'ge')) {
            $release = $this->getR00200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.4
        if (version_compare($version, '0.4', 'ge')) {
            $release = $this->getR00400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0
        if (version_compare($version, '1.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0
        if (version_compare($version, '2.0.0', 'ge')) {
            $release = $this->getR20000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.2
        if (version_compare($version, '2.0.2', 'ge')) {
            $release = $this->getR20002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.1.0
        if (version_compare($version, '2.1.0', 'ge')) {
            $release = $this->getR20100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.2.0
        if (version_compare($version, '2.2.0', 'ge')) {
            $release = $this->getR20200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.0
        if (version_compare($version, '3.0.0', 'ge')) {
            $release = $this->getR30000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.3
        if (version_compare($version, '3.0.3', 'ge')) {
            $release = $this->getR30003();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.4
        if (version_compare($version, '3.0.4', 'ge')) {
            $release = $this->getR30004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.8
        if (version_compare($version, '3.0.8', 'ge')) {
            $release = $this->getR30008();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2004-02-26',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->classes = array(
            'Memcache'                  => null,
        );
        $release->constants = array(
            'MEMCACHE_COMPRESSED'       => null,
            'MEMCACHE_SERIALIZED'       => array('ext.max' => '0.2'),
        );
        $release->functions = array(
            'memcache_add'              => null,
            'memcache_connect'          => null,
            'memcache_debug'            => null,
            'memcache_decrement'        => null,
            'memcache_delete'           => null,
            'memcache_get'              => null,
            'memcache_get_stats'        => null,
            'memcache_get_version'      => null,
            'memcache_increment'        => null,
            'memcache_replace'          => null,
            'memcache_set'              => null,
        );
        return $release;
    }

    protected function getR00400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2004-03-26',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'memcache_close'            => null,
            'memcache_pconnect'         => null,
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2004-05-21',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'memcache_flush'            => null,
        );
        return $release;
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-12-23',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'memcache_add_server'               => null,
            'memcache_get_extended_stats'       => null,
            'memcache_set_compress_threshold'   => null,
        );
        return $release;
    }

    protected function getR20002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-05-14',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcache.allow_failover'           => null,
            'memcache.chunk_size'               => null,
            'memcache.default_port'             => null,
        );
        return $release;
    }

    protected function getR20100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-10-09',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcache.max_failover_attempts'    => null,
        );
        $release->functions = array(
            'memcache_get_server_status'        => null,
            'memcache_set_server_params'        => null,
        );
        return $release;
    }

    protected function getR20200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-09-21',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcache.hash_function'            => null,
            'memcache.hash_strategy'            => null,
        );
        $release->constants = array(
            'MEMCACHE_HAVE_SESSION'             => null,
        );
        return $release;
    }

    protected function getR30000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2007-11-26',
            'php.min' => '4.3.11',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcache.protocol'                 => null,
            'memcache.redundancy'               => null,
            'memcache.session_redundancy'       => null,
        );
        $release->functions = array(
            'memcache_append'                   => null,
            'memcache_cas'                      => null,
            'memcache_prepend'                  => null,
            'memcache_set_failure_callback'     => null,
        );
        $release->classes = array(
            'MemcachePool'                      => null,
        );
        return $release;
    }

    protected function getR30003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.3',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-01-13',
            'php.min' => '4.3.11',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcache.compress_threshold'       => null,
        );
        return $release;
    }

    protected function getR30004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-02-22',
            'php.min' => '4.3.11',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcache.lock_timeout'             => null,
        );
        return $release;
    }

    protected function getR30008()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.8',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-04-10',
            'php.min' => '4.3.11',
            'php.max' => '',
        );
        $release->constants = array(
            'MEMCACHE_USER1'                    => null,
            'MEMCACHE_USER2'                    => null,
            'MEMCACHE_USER3'                    => null,
            'MEMCACHE_USER4'                    => null,
        );
        return $release;
    }
}
