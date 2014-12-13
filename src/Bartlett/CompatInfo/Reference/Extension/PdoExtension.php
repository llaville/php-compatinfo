<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PdoExtension extends AbstractReference
{
    const REF_NAME    = 'PDO';
    const REF_VERSION = '1.0.4dev';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        //$version  = $this->getCurrentVersion();  // (@FIXME)
        $version = $this->getLatestPhpVersion();

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $this->storage->attach($release);
        }
    }

    protected function getR50100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            'PDO'                           => null,
            'PDOException'                  => null,
            'PDORow'                        => null,
            'PDOStatement'                  => null,
        );
        $release->functions = array(
            'pdo_drivers'                   => null,
        );
        return $release;
    }
}
