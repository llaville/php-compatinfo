<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class JsonExtension extends AbstractReference
{
    const REF_NAME    = 'json';
    const REF_VERSION = '1.2.1';    // 2006-03-17 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        //$version  = $this->getCurrentVersion();  // @FIXME
        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.3
        if (version_compare($version, '5.3.3', 'ge')) {
            $release = $this->getR50303();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR50200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'json_decode'                   => array('5.2.0', '', '5.2.0, 5.2.0, 5.3.0, 5.4.0'),
            'json_encode'                   => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'json_last_error'               => null,
        );
        $release->constants = array(
            'JSON_ERROR_CTRL_CHAR'          => null,
            'JSON_ERROR_DEPTH'              => null,
            'JSON_ERROR_NONE'               => null,
            'JSON_ERROR_STATE_MISMATCH'     => null,
            'JSON_ERROR_SYNTAX'             => null,
            'JSON_FORCE_OBJECT'             => null,
            'JSON_HEX_AMP'                  => null,
            'JSON_HEX_APOS'                 => null,
            'JSON_HEX_QUOT'                 => null,
            'JSON_HEX_TAG'                  => null,
        );
        return $release;
    }

    protected function getR50303()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-07-22',
            'php.min' => '5.3.3',
            'php.max' => '',
        );
        $release->constants = array(
            'JSON_ERROR_UTF8'               => null,
            'JSON_NUMERIC_CHECK'            => null,
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
        $release->interfaces = array(
            'JsonSerializable'              => null,
        );
        $release->constants = array(
            'JSON_BIGINT_AS_STRING'         => null,
            'JSON_OBJECT_AS_ARRAY'          => null,
            'JSON_PRETTY_PRINT'             => null,
            'JSON_UNESCAPED_SLASHES'        => null,
            'JSON_UNESCAPED_UNICODE'        => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->functions = array(
            'json_last_error_msg'           => null,
        );
        $release->constants = array(
            'JSON_PARTIAL_OUTPUT_ON_ERROR'  => null,
            'JSON_ERROR_RECURSION'          => null,
            'JSON_ERROR_INF_OR_NAN'         => null,
            'JSON_ERROR_UNSUPPORTED_TYPE'   => null,
        );
        return $release;
    }
}
