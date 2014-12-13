<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XmlreaderExtension extends AbstractReference
{
    const REF_NAME    = 'xmlreader';
    const REF_VERSION = '0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        //$version  = $this->getCurrentVersion();  // @FIXME
        $version = $this->getLatestPhpVersion();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }
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
        $release->classes = array(
            'XMLReader'                     => null,
        );
        return $release;
    }
}
