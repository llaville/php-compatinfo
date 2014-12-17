<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ExifExtension extends AbstractReference
{
    const REF_NAME    = 'exif';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getLatestPhpVersion();

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $this->storage->attach($release);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $this->storage->attach($release);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $this->storage->attach($release);
        }
    }

    protected function getR40001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-06-28',
            'php.min' => '4.0.1',
            'php.max' => '',
        );
        $release->functions = array(
            'read_exif_data'                => null,
        );
        $release->constants = array(
            'EXIF_USE_MBSTRING'             => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'exif_read_data'                => null,
            'exif_tagname'                  => null,
            'exif_thumbnail'                => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'exif.decode_unicode_intel'     => null,
            'exif.decode_unicode_motorola'  => null,
            'exif.encode_jis'               => null,
            'exif.decode_jis_intel'         => null,
            'exif.decode_jis_motorola'      => null,
            'exif.encode_unicode'           => null,
        );
        $release->functions = array(
            'exif_imagetype'                => null,
        );
        return $release;
    }
}
