<?php

namespace Bartlett\CompatInfo\Reference;

abstract class AbstractReference implements ReferenceInterface
{
    const LATEST_PHP_5_2 = '5.2.17';
    const LATEST_PHP_5_3 = '5.3.28';
    const LATEST_PHP_5_4 = '5.4.27RC1';
    const LATEST_PHP_5_5 = '5.5.11RC1';
    const LATEST_PHP_5_6 = '5.6.0alpha3';

    protected $storage;

    private $name;
    private $version;

    public function __construct($name, $version)
    {
        $this->storage = new \SplObjectStorage;
        $this->name    = $name;
        $this->version = $version;
    }

    public function __toString()
    {
        $eol = "\n";
        $str = '';

        $versioning = function ($versions) use ($eol) {
            $str = sprintf(
                '      Version EXT => %s %s%s',
                $versions['ext.min'],
                !empty($versions['ext.max']) ? '=> ' . $versions['ext.max'] : '',
                $eol
            );
            $str .= sprintf(
                '      Version PHP => %s %s%s',
                $versions['php.min'],
                !empty($versions['php.max']) ? '=> ' . $versions['php.max'] : '',
                $eol
            );
            $str .= '    ]' . $eol;
            return $str;
        };

        $str .= sprintf(
            'Extension [ %s version %s ] {%s',
            $this->getName(),
            $this->getLatestVersion(),
            $eol
        );

        $iniEntries = $this->getIniEntries();
        if (count($iniEntries)) {
            $str .= sprintf(
                '%s  - IniEntries [%d] {%s',
                $eol,
                count($iniEntries),
                $eol
            );
            foreach ($iniEntries as $iniEntry => $versions) {
                $str .= sprintf(
                    '    %s [%s',
                    $iniEntry,
                    $eol
                );
                $str .= $versioning($versions);
            }
            $str .= $eol . '  }' . $eol;
        }

        $interfaces = $this->getInterfaces();
        if (count($interfaces)) {
            $str .= sprintf(
                '%s  - Interfaces [%d] {%s',
                $eol,
                count($interfaces),
                $eol
            );
            foreach ($interfaces as $interface => $versions) {
                $str .= sprintf(
                    '    %s [%s',
                    $interface,
                    $eol
                );
                $str .= $versioning($versions);
            }
            $str .= $eol . '  }' . $eol;
        }

        $classes = $this->getClasses();
        if (count($classes)) {
            $str .= sprintf(
                '%s  - Classes [%d] {%s',
                $eol,
                count($classes),
                $eol
            );
            foreach ($classes as $class => $versions) {
                $str .= sprintf(
                    '    %s [%s',
                    $class,
                    $eol
                );
                $str .= $versioning($versions);
            }
            $str .= $eol . '  }' . $eol;
        }

        $functions = $this->getFunctions();
        if (count($functions)) {
            $str .= sprintf(
                '%s  - Functions [%d] {%s',
                $eol,
                count($functions),
                $eol
            );
            foreach ($functions as $function => $versions) {
                $str .= sprintf(
                    '    %s [%s',
                    $function,
                    $eol
                );
                $str .= $versioning($versions);
            }
            $str .= $eol . '  }' . $eol;
        }

        $constants = $this->getConstants();
        if (count($constants)) {
            $str .= sprintf(
                '%s  - Constants [%d] {%s',
                $eol,
                count($constants),
                $eol
            );
            foreach ($constants as $constant => $versions) {
                $str .= sprintf(
                    '    %s [%s',
                    $constant,
                    $eol
                );
                $str .= $versioning($versions);
            }
            $str .= $eol . '  }' . $eol;
        }

        $str .= '}' . $eol;
        return $str;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMetaVersion($key = null)
    {
        if ('curl' == $this->name && function_exists('curl_version')) {
            $meta = curl_version();
        
        } elseif ('libxml' == $this->name) {
            $meta = array('version_number' => LIBXML_VERSION);
        }
        if (isset($meta)) {
            if (isset($key) && array_key_exists($key, $meta)) {
                return $meta[$key];
            }
            return $meta;
        }
        return false;
    }

    public function getCurrentVersion()
    {
        $version = phpversion($this->name);
        $pattern = '/^[0-9]+\.[0-9]+\.[0-9]+([+-][^+-][0-9A-Za-z-.]*)?$/';
        if (!preg_match($pattern, $version)) {
            /**
             * When version is not provided by the extension, or not standard format
             * be sure at least to return latest PHP version supported.
             */
            $version = $this->getLatestPhpVersion();
        }
        return $version;
    }

    public function getLatestVersion()
    {
        if (!empty($this->version)) {
            return $this->version;
        }
        return $this->getLatestPhpVersion();
    }

    public function getLatestPhpVersion()
    {
        if (version_compare(PHP_VERSION, '5.3', 'lt')) {
            return self::LATEST_PHP_5_2;
        }
        if (version_compare(PHP_VERSION, '5.4', 'lt')) {
            return self::LATEST_PHP_5_3;
        }
        if (version_compare(PHP_VERSION, '5.5', 'lt')) {
            return self::LATEST_PHP_5_4;
        }
        return self::LATEST_PHP_5_5;
    }

    public function getReleases()
    {
        $releases = array();

        foreach ($this->storage as $release) {
            $releases[] = $release->info;
        }
        return $releases;
    }

    public function getInterfaces()
    {
        return $this->getMetaData('interfaces');
    }

    public function getClasses()
    {
        return $this->getMetaData('classes');
    }

    public function getFunctions()
    {
        return $this->getMetaData('functions');
    }

    public function getConstants()
    {
        return $this->getMetaData('constants');
    }

    public function getIniEntries()
    {
        return $this->getMetaData('iniEntries');
    }

    public function getClassConstants()
    {
        return $this->getMetaData('classes', 'constants');
    }

    public function getClassStaticMethods()
    {
        return $this->getMetaData('classes', 'staticMethods');
    }

    public function getClassMethods()
    {
        return $this->getMetaData('classes', 'methods');
    }

    protected function getMetaData($meta, $element = null)
    {
        $results = array();

        foreach ($this->storage as $release) {
            if (!isset($release->{$meta})
                || empty($release->{$meta})
            ) {
                continue;
            }
            foreach ($release->{$meta} as $name => $values) {

                // closure to retrieve all meta informations
                $versioning = function ($values) use ($release) {
                    $versions = array(
                        'ext.min'       => $release->info['ext.min'],
                        'ext.max'       => $release->info['ext.max'],
                        'php.min'       => $release->info['php.min'],
                        'php.max'       => $release->info['php.max'],
                        //'php.excludes'  => '',
                        //'parameters'    => null,
                    );
                    if (isset($values['ext.max'])) {
                        $versions['ext.max'] = $values['ext.max'];
                    }
                    if (isset($values['php.min'])
                        || isset($values[0])  // backward compatibility with old v2 format
                    ) {
                        $versions['php.min'] = isset($values['php.min'])
                            ? $values['php.min'] : $values[0];
                    }
                    if (isset($values['php.max'])
                        || isset($values[1])  // backward compatibility with old v2 format
                    ) {
                        $versions['php.max'] = isset($values['php.max'])
                            ? $values['php.max'] : $values[1];
                    }
                    if (isset($values['php.excludes'])) {
                        $versions['php.excludes'] = $values['php.excludes'];
                    }
                    if (isset($values['parameters'])
                        || isset($values[2])  // backward compatibility with old v2 format
                    ) {
                        $versions['parameters'] = isset($values['parameters'])
                            ? $values['parameters'] : $values[2];
                    }
                    return $versions;
                };

                if ($element === null) {
                    $versions = $versioning($values);
                    $results[$name] = $versions;

                } else {
                    if (is_array($values)
                        && array_key_exists($element, $values)
                        && !empty($values[$element])
                    ) {
                        foreach ($values[$element] as $key => $val) {
                            $versions = $versioning($val);
                            $results[$name][$key] = $versions;
                        }
                    }
                }
            }
        }
        ksort($results);
        return $results;
    }
}
