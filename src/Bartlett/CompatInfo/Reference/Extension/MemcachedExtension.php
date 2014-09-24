<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MemcachedExtension extends AbstractReference
{
    const REF_NAME    = 'memcached';
    const REF_VERSION = '2.2.0';  // 2014-04-01 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0
        if (version_compare($version, '2.0.0', 'ge')) {
            $release = $this->getR20000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.2.0b1
        if (version_compare($version, '2.2.0b1', 'ge')) {
            $release = $this->getR20200b1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-01-29',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Memcached'                 => null,
            'MemcachedException'        => null,
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
            'date'    => '2012-03-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcached.compression_factor'       => null,
            'memcached.compression_threshold'    => null,
            'memcached.compression_type'         => null,
            'memcached.serializer'               => null,
            'memcached.sess_binary'              => null,
            'memcached.sess_locking'             => null,
            'memcached.sess_lock_wait'           => null,
            'memcached.sess_prefix'              => null,
            'memcached.use_sasl'                 => null,
        );
        return $release;
    }

    protected function getR20200b1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.2.0b1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-11-25',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'memcached.sess_connect_timeout'        => null,
            'memcached.sess_consistent_hash'        => null,
            'memcached.sess_lock_expire'            => null,
            'memcached.sess_lock_max_wait'          => null,
            'memcached.sess_number_of_replicas'     => null,
            'memcached.sess_randomize_replica_read' => null,
            'memcached.sess_remove_failed'          => null,
            'memcached.sess_sasl_username'          => null,
            'memcached.sess_sasl_password'          => null,
            'memcached.store_retry_count'           => null,
        );
        $release->classes = array(
            'MemcachedServer'           => null,
        );
        return $release;
    }
}
