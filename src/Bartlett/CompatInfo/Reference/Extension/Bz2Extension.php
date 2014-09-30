<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class Bz2Extension extends AbstractReference
{
    const REF_NAME    = 'bz2';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'bzclose'                   => null,
            'bzcompress'                => null,
            'bzdecompress'              => null,
            'bzerrno'                   => null,
            'bzerror'                   => null,
            'bzerrstr'                  => null,
            'bzflush'                   => null,
            'bzopen'                    => null,
            'bzread'                    => null,
            'bzwrite'                   => null,
        );
        return $release;
    }
}
