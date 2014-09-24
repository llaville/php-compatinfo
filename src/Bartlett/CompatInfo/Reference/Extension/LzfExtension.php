<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class LzfExtension extends AbstractReference
{
    const REF_NAME    = 'lzf';
    const REF_VERSION = '1.6.2';  // 2012-07-08 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1
        if (version_compare($version, '0.1', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0
        if (version_compare($version, '1.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-10-14',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
        );
        $release->functions = array(
            'lzf_compress'              => null,
            'lzf_decompress'            => null,        
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-10-24',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'lzf_optimized_for'         => null,
        );
        return $release;
    }
}
