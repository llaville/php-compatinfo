<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SimplexmlExtension extends AbstractReference
{
    const REF_NAME    = 'SimpleXML';
    const REF_VERSION = '0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getLatestPhpVersion();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }

        // 5.0.1
        if (version_compare($version, '5.0.1', 'ge')) {
            $release = $this->getR50001();
            $this->storage->attach($release);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
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
        $release->functions = array(
            'simplexml_import_dom'          => null,
            'simplexml_load_file'           => null,
            'simplexml_load_string'         => null,
        );
        return $release;
    }

    protected function getR50001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-08-12',
            'php.min' => '5.0.1',
            'php.max' => '',
        );
        $release->classes = array(
            'SimpleXMLElement'              => null,
        );
        return $release;
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
            'SimpleXMLIterator'             => null,
        );
        return $release;
    }
}
