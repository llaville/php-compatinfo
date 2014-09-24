<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class UploadprogressExtension extends AbstractReference
{
    const REF_NAME    = 'uploadprogress';
    const REF_VERSION = '1.0.3.1';  // 2011-08-15 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.3.0
        if (version_compare($version, '0.3.0', 'ge')) {
            $release = $this->getR00300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.9.0
        if (version_compare($version, '0.9.0', 'ge')) {
            $release = $this->getR00900();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.3.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-12-05',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'uploadprogress.file.filename_template' => null,
        );
        $release->functions = array(
            'uploadprogress_get_info'               => null,
        );
        return $release;
    }

    protected function getR00900()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.9.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-07-08',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'uploadprogress.file.contents_template' => null,
            'uploadprogress.get_contents'           => null,
        );
        $release->functions = array(
            'uploadprogress_get_contents'           => null,
        );
        return $release;
    }
}
