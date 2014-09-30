<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class HaruExtension extends AbstractReference
{
    const REF_NAME    = 'haru';
    const REF_VERSION = '1.0.4';    // 2012-12-23 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.0.1
        if (version_compare($version, '0.0.1', 'ge')) {
            $release = $this->getR00001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.0.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2007-03-26',
            'php.min' => '5.1.3',
            'php.max' => '',
        );

        /**
         * @link http://www.php.net/manual/en/class.haruannotation.php
         * @link http://www.php.net/manual/en/class.harudestination.php
         * @link http://www.php.net/manual/en/class.harudoc.php
         * @link http://www.php.net/manual/en/class.haruencoder.php
         * @link http://www.php.net/manual/en/class.haruexception.php
         * @link http://www.php.net/manual/en/class.harufont.php
         * @link http://www.php.net/manual/en/class.haruimage.php
         * @link http://www.php.net/manual/en/class.haruoutline.php
         * @link http://www.php.net/manual/en/class.harupage.php
         */
        $release->classes = array(
            'HaruAnnotation'        => null,
            'HaruDestination'       => null,
            'HaruDoc'               => null,
            'HaruEncoder'           => null,
            'HaruException'         => null,
            'HaruFont'              => null,
            'HaruImage'             => null,
            'HaruOutline'           => null,
            'HaruPage'              => null,
        );
        return $release;
    }
}
