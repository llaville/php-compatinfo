<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SysvshmExtension extends AbstractReference
{
    const REF_NAME    = 'sysvshm';
    const REF_VERSION = '';

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

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
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
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'shm_attach'                        => null,
            'shm_detach'                        => null,
            'shm_get_var'                       => null,
            'shm_put_var'                       => null,
            'shm_remove'                        => null,
            'shm_remove_var'                    => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'shm_has_var'                       => null,
        );
        return $release;
    }
}
