<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class FileinfoExtension extends AbstractReference
{
    const REF_NAME    = 'fileinfo';
    const REF_VERSION = '1.0.5';    // 2014-02-18

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.5-dev
        if (version_compare($version, '1.0.5-dev', 'ge')) {
            $release = $this->getR10005dev();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2004-02-13',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'FILEINFO_COMPRESS'         => array('4.0.0', self::LATEST_PHP_5_2),
            'FILEINFO_CONTINUE'         => null,
            'FILEINFO_DEVICES'          => null,
            'FILEINFO_MIME'             => null,
            'FILEINFO_NONE'             => null,
            'FILEINFO_PRESERVE_ATIME'   => null,
            'FILEINFO_RAW'              => null,
            'FILEINFO_SYMLINK'          => null,
        );
        $release->functions = array(
            'finfo_buffer'              => null,
            'finfo_close'               => null,
            'finfo_file'                => null,
            'finfo_open'                => null,
            'finfo_set_flags'           => null,
        );
        $release->classes = array(
            'finfo'                     => null,
        );
        return $release;
    }

    protected function getR10005dev()
    {
        // enables by default in PHP 5.3.0
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.5-dev',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'FILEINFO_MIME_ENCODING'    => null,
            'FILEINFO_MIME_TYPE'        => null,
        );
        $release->functions = array(
            'mime_content_type'         => null,
        );
        return $release;
    }
}
