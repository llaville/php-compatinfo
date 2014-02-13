<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ReflectionExtension extends AbstractReference
{
    const REF_NAME    = 'Reflection';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR50000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->interfaces = array(
            'Reflector'                     => null,
        );
        $release->classes = array(
            'Reflection'                    => null,
            'ReflectionClass'               => null,
            'ReflectionException'           => null,
            'ReflectionExtension'           => null,
            'ReflectionFunction'            => null,
            'ReflectionFunctionAbstract'    => null,
            'ReflectionMethod'              => null,
            'ReflectionObject'              => null,
            'ReflectionParameter'           => null,
            'ReflectionProperty'            => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->classes = array(
            'ReflectionZendExtension'       => null,
        );
        return $release;
    }
}
