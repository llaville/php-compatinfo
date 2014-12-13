<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class IconvExtension extends AbstractReference
{
    const REF_NAME    = 'iconv';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $this->storage->attach($release);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $this->storage->attach($release);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }
    }

    protected function getR40005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'iconv.input_encoding'          => null,
            'iconv.internal_encoding'       => null,
            'iconv.output_encoding'         => null,
        );
        $release->functions = array(
            'iconv'                         => null,
            'iconv_get_encoding'            => null,
            'iconv_set_encoding'            => null,
            'ob_iconv_handler'              => array('4.0.5', self::LATEST_PHP_5_3),
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
        $release->constants = array(
            'ICONV_IMPL'                    => null,
            'ICONV_VERSION'                 => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'ICONV_MIME_DECODE_CONTINUE_ON_ERROR'   => null,
            'ICONV_MIME_DECODE_STRICT'              => null,
        );
        $release->functions = array(
            'iconv_mime_decode'                     => null,
            'iconv_mime_decode_headers'             => null,
            'iconv_mime_encode'                     => null,
            'iconv_strlen'                          => null,
            'iconv_strpos'                          => null,
            'iconv_strrpos'                         => null,
            'iconv_substr'                          => null,
        );
        return $release;
    }
}
