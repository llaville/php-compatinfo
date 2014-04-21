<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XhprofExtension extends AbstractReference
{
    const REF_NAME    = 'xhprof';
    const REF_VERSION = '0.9.4';  // 2013-09-30 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.9.0
        if (version_compare($version, '0.9.0', 'ge')) {
            $release = $this->getR00900();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00900()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.9.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2009-03-18',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xhprof.output_dir'                 => null,
        );
        $release->constants = array(
            'XHPROF_FLAGS_CPU'                  => null,
            'XHPROF_FLAGS_MEMORY'               => null,
            'XHPROF_FLAGS_NO_BUILTINS'          => null,
        );
        $release->functions = array(
            'xhprof_disable'                    => null,
            'xhprof_enable'                     => null,
            'xhprof_sample_disable'             => null,
            'xhprof_sample_enable'              => null,
        );
        return $release;
    }
}
