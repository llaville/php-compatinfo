<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ZipExtension extends AbstractReference
{
    const REF_NAME    = 'zip';
    const REF_VERSION = '1.12.4';   // 2014-01-29 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        //$version  = $this->getCurrentVersion();  // @FIXME
        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 1.0
        if (version_compare($version, '1.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.6.0
        if (version_compare($version, '1.6.0', 'ge')) {
            $release = $this->getR10600();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-05-21',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'zip_close'                     => null,
            'zip_entry_close'               => null,
            'zip_entry_compressedsize'      => null,
            'zip_entry_compressionmethod'   => null,
            'zip_entry_filesize'            => null,
            'zip_entry_name'                => null,
            'zip_entry_open'                => null,
            'zip_entry_read'                => null,
            'zip_open'                      => null,
            'zip_read'                      => null,
        );
        return $release;
    }

    protected function getR10600()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.6.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-07-25',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->classes = array(
            'ZipArchive'                    => array(
                'methods' => array(
                    'setExternalAttributesName'     => array(
                        'ext.min' => '1.12.4'
                    ),
                    'setExternalAttributesIndex'    => array(
                        'ext.min' => '1.12.4'
                    ),
                    'getExternalAttributesName'     => array(
                        'ext.min' => '1.12.4'
                    ),
                    'getExternalAttributesIndex'    => array(
                        'ext.min' => '1.12.4'
                    ),
                ),
            ),
        );
        return $release;
    }
}
