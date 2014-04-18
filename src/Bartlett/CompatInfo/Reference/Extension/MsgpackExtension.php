<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MsgpackExtension extends AbstractReference
{
    const REF_NAME    = 'msgpack';
    const REF_VERSION = '0.5.5';  // 2013-02-18 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.5.2
        if (version_compare($version, '0.5.2', 'ge')) {
            $release = $this->getR00502();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00502()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.5.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-09-14',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'msgpack.error_display'         => null,
            'msgpack.illegal_key_insert'    => null,
            'msgpack.php_only'              => null,
        );
        $release->classes = array(
            'MessagePack'                   => null,
            'MessagePackUnpacker'           => null,
        );
        $release->functions = array(
            'msgpack_pack'                  => null,
            'msgpack_serialize'             => null,
            'msgpack_unpack'                => null,
            'msgpack_unserialize'           => null,
        );
        return $release;
    }
}
