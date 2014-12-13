<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class GenderExtension extends AbstractReference
{
    const REF_NAME    = 'gender';
    const REF_VERSION = '1.0.0';    // 2013-06-02 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.6.0
        if (version_compare($version, '0.6.0', 'ge')) {
            $release = $this->getR00600();
            $this->storage->attach($release);
        }
    }

    protected function getR00600()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.6.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-12-17',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Gender\Gender'                 => null,
        );
        return $release;
    }
}
