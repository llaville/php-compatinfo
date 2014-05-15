<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class RiakExtension extends AbstractReference
{
    const REF_NAME    = 'riak';
    const REF_VERSION = '1.1.6';    // 2014-05-15 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.4.0
        if (version_compare($version, '0.4.0', 'ge')) {
            $release = $this->getR00400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.4.2
        if (version_compare($version, '0.4.2', 'ge')) {
            $release = $this->getR00402();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.5.0
        if (version_compare($version, '0.5.0', 'ge')) {
            $release = $this->getR00500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.6.0
        if (version_compare($version, '0.6.0', 'ge')) {
            $release = $this->getR00600();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.7.0
        if (version_compare($version, '0.7.0', 'ge')) {
            $release = $this->getR00700();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.8.0
        if (version_compare($version, '0.8.0', 'ge')) {
            $release = $this->getR00800();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.9.0
        if (version_compare($version, '0.9.0', 'ge')) {
            $release = $this->getR00900();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.4.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2013-06-13',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Riak\\Bucket'                              => null,
            'Riak\\Connection'                          => null,
            'Riak\\Exception\\BadArgumentsException'    => null,
            'Riak\\Exception\\CommunicationException'   => null,
            'Riak\\Exception\\ConnectionException'      => null,
            'Riak\\Exception\\RiakException'            => null,
            'Riak\\Link'                                => null,
            'Riak\\MapReduce\\MapReduce'                => null,
            'Riak\\MapReduce\\Phase\\Phase'             => null,
            'Riak\\MapReduce\\Phase\\ReducePhase'       => null,
            'Riak\\Object'                              => null,
            'Riak\\Query\\IndexQuery'                   => null,
        );
        return $release;
    }

    protected function getR00402()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.4.2',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2013-06-13',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'riak.persistent.connections'   => null,
            'riak.persistent.timeout'       => null,
        );
        return $release;
    }

    protected function getR00500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.5.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-07-05',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->interfaces = array(
            'Riak\\MapReduce\\Output\\StreamOutput'             => null,
            'Riak\\Output\\KeyStreamOutput'                     => null,
        );
        $release->classes = array(
            'Riak\\BucketPropertyList'                          => null,
            'Riak\\Exception\\UnexpectedResponseException'      => null,
            'Riak\\Input\\DeleteInput'                          => null,
            'Riak\\Input\\GetInput'                             => null,
            'Riak\\Input\\Input'                                => null,
            'Riak\\Input\\PutInput'                             => null,
            'Riak\\MapReduce\\Functions\\BaseFunction'          => null,
            'Riak\\MapReduce\\Functions\\ErlangFunction'        => null,
            'Riak\\MapReduce\\Functions\\JavascriptFunction'    => null,
            'Riak\\MapReduce\\Output\\Output'                   => null,
            'Riak\\MapReduce\\Phase\\MapPhase'                  => null,
            'Riak\\ObjectList'                                  => null,
            'Riak\\Output\\GetOutput'                           => null,
            'Riak\\Output\\Output'                              => null,
            'Riak\\Output\\PutOutput'                           => null,
            'Riak\\PoolInfo'                                    => null,
            'Riak\\Search\\Input\\ParameterBag'                 => null,
            'Riak\\Search\\Output\\DocumentOutput'              => null,
            'Riak\\Search\\Output\\Output'                      => null,
            'Riak\\Search\\Search'                              => null,
        );
        return $release;
    }

    protected function getR00600()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.6.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-10-09',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'riak.socket.keep_alive'                                => null,
            'riak.socket.recv_timeout'                              => null,
            'riak.socket.send_timeout'                              => null,
        );
        $release->interfaces = array(
            'Riak\\Property\\ReplicationMode\\ReplicationMode'      => null,
        );
        $release->classes = array(
            'Riak\\MapReduce\\Input\\BucketInput'                   => null,
            'Riak\\MapReduce\\Input\\Input'                         => null,
            'Riak\\MapReduce\\Input\\KeyDataListInput'              => null,
            'Riak\\MapReduce\\Input\\KeyListInput'                  => null,
            'Riak\\Property\\CommitHook'                            => null,
            'Riak\\Property\\CommitHookList'                        => null,
            'Riak\\Property\\ModuleFunction'                        => null,
            'Riak\\Property\\ReplicationMode\\Disabled'             => null,
            'Riak\\Property\\ReplicationMode\\FullSyncOnly'         => null,
            'Riak\\Property\\ReplicationMode\\RealTimeAndFullSync'  => null,
            'Riak\\Property\\ReplicationMode\\RealTimeOnly'         => null,
        );
        return $release;
    }

    protected function getR00700()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.7.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-10-31',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Riak\\Input\\IndexInput'           => null,
            'Riak\\Output\\IndexOutput'         => null,
            'Riak\\Output\\IndexResult'         => null,
            'Riak\\Output\\IndexResultList'     => null,
        );
        return $release;
    }

    protected function getR00800()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.8.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-11-02',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Riak\\Crdt\\Counter'               => null,
            'Riak\\Crdt\\Input\\GetInput'       => null,
            'Riak\\Crdt\\Input\\UpdateInput'    => null,
        );
        return $release;
    }

    protected function getR00900()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.9.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-11-08',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Riak\\ServerInfo'      => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-12-14',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'riak.default.retries'                          => null,
        );
        $release->interfaces = array(
            'Riak\\Output\\ConflictResolver'                => null,
        );
        $release->classes = array(
            'Riak\\Exception\\NonUniqueException'           => null,
            'Riak\\Exception\\UnresolvedConflictException'  => null,
            'Riak\\Input\\GetResolverInput'                 => null,
            'Riak\\Output\\YoungestSiblingResolver'         => null,
        );
        return $release;
    }
}
