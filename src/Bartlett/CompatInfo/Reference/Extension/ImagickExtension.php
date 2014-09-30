<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ImagickExtension extends AbstractReference
{
    const REF_NAME    = 'imagick';
    const REF_VERSION = '3.1.2';  // 2013-09-25 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 2.0.0a1
        if (version_compare($version, '2.0.0a1', 'ge')) {
            $release = $this->getR20000a1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 3.0.1
        if (version_compare($version, '3.0.1', 'ge')) {
            $release = $this->getR30001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR20000a1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0a1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2007-05-02',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->classes = array(
            'Imagick'                       => null,
            'ImagickDraw'                   => null,
            'ImagickDrawException'          => null,
            'ImagickException'              => null,
            'ImagickPixel'                  => null,
            'ImagickPixelException'         => null,
            'ImagickPixelIterator'          => null,
            'ImagickPixelIteratorException' => null,
        );
        return $release;
    }

    protected function getR30001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-11-18',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'imagick.locale_fix'            => null,
            'imagick.progress_monitor'      => null,
        );
        return $release;
    }

}
