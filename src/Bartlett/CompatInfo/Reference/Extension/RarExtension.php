<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class RarExtension extends AbstractReference
{
    const REF_NAME    = 'rar';
    const REF_VERSION = '3.0.2';  // 2013-10-14 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 2.0.0b2
        if (version_compare($version, '2.0.0b2', 'ge')) {
            $release = $this->getR20000b2();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0RC1
        if (version_compare($version, '2.0.0RC1', 'ge')) {
            $release = $this->getR20000RC1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.0
        if (version_compare($version, '3.0.0', 'ge')) {
            $release = $this->getR30000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR20000b2()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0b2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-12-08',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->classes = array(
            'RarArchive'                        => null,
            'RarEntry'                          => null,
        );
        $release->constants = array(
            'RAR_HOST_MSDOS'                    => null,
            'RAR_HOST_OS2'                      => null,
            'RAR_HOST_WIN32'                    => null,
            'RAR_HOST_UNIX'                     => null,
            'RAR_HOST_MACOS'                    => null,
            'RAR_HOST_BEOS'                     => null,
        );
        $release->functions = array(
            'rar_close'                         => null,
            'rar_comment_get'                   => null,
            'rar_entry_get'                     => null,
            'rar_list'                          => null,
            'rar_open'                          => null,
        );
        return $release;
    }

    protected function getR20000RC1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2010-01-17',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->classes = array(
            'RarException'                      => null,
        );
        $release->functions = array(
            'rar_solid_is'                      => null,
        );
        return $release;
    }

    protected function getR30000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '3.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-06-12',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'rar_allow_broken_set'              => null,
            'rar_broken_is'                     => null,
            'rar_wrapper_cache_stats'           => null,

        );
        return $release;
    }
}
