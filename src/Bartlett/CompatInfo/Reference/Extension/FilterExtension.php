<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class FilterExtension extends AbstractReference
{
    const REF_NAME    = 'filter';
    const REF_VERSION = '0.11.0';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.9.0
        if (version_compare($version, '0.9.0', 'ge')) {
            $release = $this->getR00900();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.9.2
        if (version_compare($version, '0.9.2', 'ge')) {
            $release = $this->getR00902();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.9.4
        if (version_compare($version, '0.9.4', 'ge')) {
            $release = $this->getR00904();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.10.0
        if (version_compare($version, '0.10.0', 'ge')) {
            $release = $this->getR01000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.11.0
        if (version_compare($version, '0.11.0', 'ge')) {
            $release = $this->getR01100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00900()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.9.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-10-05',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'filter.default'                        => null,
        );
        $release->constants = array(
            'FILTER_FLAG_ALLOW_FRACTION'            => null,
            'FILTER_FLAG_ALLOW_HEX'                 => null,
            'FILTER_FLAG_ALLOW_OCTAL'               => null,
            'FILTER_FLAG_ALLOW_SCIENTIFIC'          => null,
            'FILTER_FLAG_ALLOW_THOUSAND'            => null,
            'FILTER_FLAG_EMPTY_STRING_NULL'         => null,
            'FILTER_FLAG_ENCODE_AMP'                => null,
            'FILTER_FLAG_ENCODE_HIGH'               => null,
            'FILTER_FLAG_ENCODE_LOW'                => null,
            'FILTER_FLAG_HOST_REQUIRED'             => null,
            'FILTER_FLAG_IPV4'                      => null,
            'FILTER_FLAG_IPV6'                      => null,
            'FILTER_FLAG_NONE'                      => null,
            'FILTER_FLAG_NO_ENCODE_QUOTES'          => null,
            'FILTER_FLAG_NO_PRIV_RANGE'             => null,
            'FILTER_FLAG_NO_RES_RANGE'              => null,
            'FILTER_FLAG_PATH_REQUIRED'             => null,
            'FILTER_FLAG_QUERY_REQUIRED'            => null,
            'FILTER_FLAG_SCHEME_REQUIRED'           => null,
            'FILTER_FLAG_STRIP_HIGH'                => null,
            'FILTER_FLAG_STRIP_LOW'                 => null,

            'INPUT_COOKIE'                          => null,
            'INPUT_ENV'                             => null,
            'INPUT_GET'                             => null,
            'INPUT_POST'                            => null,
            'INPUT_SERVER'                          => null,
            'INPUT_SESSION'                         => null,
        );
        $release->functions = array(
            'filter_data'                           => array('4.0.0', '', 'ext.max' => '0.10.0'),
            'input_filters_list'                    => array('4.0.0', '', 'ext.max' => '0.10.0'),
            'input_get'                             => array('4.0.0', '', 'ext.max' => '0.10.0'),
            'input_has_variable'                    => array('4.0.0', '', 'ext.max' => '0.10.0'),
        );
        return $release;
    }

    protected function getR00902()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.9.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-10-27',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'filter.default_flags'                  => null,
        );
        $release->functions = array(
            'input_name_to_filter'                  => array('4.0.0', '', 'ext.max' => '0.10.0'),
        );
        return $release;
    }

    protected function getR00904()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.9.4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-10-27',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'FILTER_CALLBACK'                       => null,
            'FILTER_DEFAULT'                        => null,
            'FILTER_SANITIZE_ALL'                   => null,
            'FILTER_SANITIZE_EMAIL'                 => null,
            'FILTER_SANITIZE_ENCODED'               => null,
            'FILTER_SANITIZE_MAGIC_QUOTES'          => null,
            'FILTER_SANITIZE_NUMBER_FLOAT'          => null,
            'FILTER_SANITIZE_NUMBER_INT'            => null,
            'FILTER_SANITIZE_SPECIAL_CHARS'         => null,
            'FILTER_SANITIZE_STRING'                => null,
            'FILTER_SANITIZE_STRIPPED'              => null,
            'FILTER_SANITIZE_URL'                   => null,
            'FILTER_UNSAFE_RAW'                     => null,
            'FILTER_VALIDATE_ALL'                   => null,
            'FILTER_VALIDATE_BOOLEAN'               => null,
            'FILTER_VALIDATE_EMAIL'                 => null,
            'FILTER_VALIDATE_FLOAT'                 => null,
            'FILTER_VALIDATE_INT'                   => null,
            'FILTER_VALIDATE_IP'                    => null,
            'FILTER_VALIDATE_REGEXP'                => null,
            'FILTER_VALIDATE_URL'                   => null,
        );
        return $release;
    }

    protected function getR01000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.10.0',
            'ext.max' => '0.10.0',
            'state'   => 'beta',
            'date'    => '2006-08-31',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'FILTER_FLAG_ARRAY'                     => null,
            'FILTER_FLAG_SCALAR'                    => null,
        );
        $release->functions = array(
            'input_get_args'                        => null,
        );
        return $release;
    }

    protected function getR01100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.11.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-10-31',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'FILTER_FORCE_ARRAY'                    => null,
            'FILTER_NULL_ON_FAILURE'                => null,
            'FILTER_REQUIRE_ARRAY'                  => null,
            'FILTER_REQUIRE_SCALAR'                 => null,

            'INPUT_REQUEST'                         => null,

            /*
                additional adds after PECL release 0.11.0
             */
            // 2009-12-07
            'FILTER_FLAG_STRIP_BACKTICK'            => array('5.3.2', ''),
            // 2010-03-31
            'FILTER_SANITIZE_FULL_SPECIAL_CHARS'    => array('5.3.3', ''),
            // 2013-06-20
            'FILTER_VALIDATE_MAC'                   => array('5.5.0', ''),
        );
        $release->functions = array(
            'filter_has_var'                        => null,
            'filter_id'                             => null,
            'filter_input'                          => null,
            'filter_input_array'                    => null,
            'filter_list'                           => null,
            'filter_var'                            => null,
            'filter_var_array'                      => null,
        );
        return $release;
    }
}
