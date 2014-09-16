<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SysvsemExtension extends AbstractReference
{
    const REF_NAME    = 'sysvsem';
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

        // 4.1.0
        if (version_compare($version, '4.1.0', 'ge')) {
            $release = $this->getR40100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'sem_acquire'                       => array('4.0.0', '5.6.1RC1'),
            'sem_get'                           => null,
            'sem_release'                       => null,
        );
        return $release;
    }

    protected function getR40100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-12-10',
            'php.min' => '4.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'sem_remove'                        => null,
        );
        return $release;
    }
}
