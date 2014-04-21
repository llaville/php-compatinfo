<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class YamlExtension extends AbstractReference
{
    const REF_NAME    = 'yaml';
    const REF_VERSION = '1.1.1';  // 2013-11-18 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 0.6.2
        if (version_compare($version, '0.6.2', 'ge')) {
            $release = $this->getR00602();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00602()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.6.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2010-02-06',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'yaml.decode_binary'                => null,
            'yaml.decode_timestamp'             => null,
            'yaml.output_canonical'             => null,
            'yaml.output_indent'                => null,
            'yaml.output_width'                 => null,
        );
        $release->constants = array(
            'YAML_ANY_BREAK'                    => null,
            'YAML_ANY_ENCODING'                 => null,
            'YAML_ANY_SCALAR_STYLE'             => null,
            'YAML_BINARY_TAG'                   => null,
            'YAML_BOOL_TAG'                     => null,
            'YAML_CRLN_BREAK'                   => null,
            'YAML_CR_BREAK'                     => null,
            'YAML_DOUBLE_QUOTED_SCALAR_STYLE'   => null,
            'YAML_FLOAT_TAG'                    => null,
            'YAML_FOLDED_SCALAR_STYLE'          => null,
            'YAML_INT_TAG'                      => null,
            'YAML_LITERAL_SCALAR_STYLE'         => null,
            'YAML_LN_BREAK'                     => null,
            'YAML_MAP_TAG'                      => null,
            'YAML_MERGE_TAG'                    => null,
            'YAML_NULL_TAG'                     => null,
            'YAML_PHP_TAG'                      => null,
            'YAML_PLAIN_SCALAR_STYLE'           => null,
            'YAML_SEQ_TAG'                      => null,
            'YAML_SINGLE_QUOTED_SCALAR_STYLE'   => null,
            'YAML_STR_TAG'                      => null,
            'YAML_TIMESTAMP_TAG'                => null,
            'YAML_UTF16BE_ENCODING'             => null,
            'YAML_UTF16LE_ENCODING'             => null,
            'YAML_UTF8_ENCODING'                => null,
        );
        $release->functions = array(
            'yaml_emit'                         => null,
            'yaml_emit_file'                    => null,
            'yaml_parse'                        => null,
            'yaml_parse_file'                   => null,
            'yaml_parse_url'                    => null,
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-02-20',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        return $release;
    }
}
