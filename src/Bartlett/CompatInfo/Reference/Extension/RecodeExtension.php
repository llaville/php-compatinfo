<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class RecodeExtension extends AbstractReference
{
    const REF_NAME    = 'recode';
    const REF_VERSION = '2.0.1';

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
            'recode'                    => null,
            'recode_file'               => null,
            'recode_string'             => null,
        );
        return $release;
    }
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'READLINE_LIB'                      => null,
        );
        return $release;
    }
}