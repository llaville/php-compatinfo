<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class DateExtension extends AbstractReference
{
    const REF_NAME    = 'date';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $this->storage->attach($release);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $this->storage->attach($release);
        }

        // 5.1.1
        if (version_compare($version, '5.1.1', 'ge')) {
            $release = $this->getR50101();
            $this->storage->attach($release);
        }

        // 5.1.2
        if (version_compare($version, '5.1.2', 'ge')) {
            $release = $this->getR50102();
            $this->storage->attach($release);
        }

        // 5.1.3
        if (version_compare($version, '5.1.3', 'ge')) {
            $release = $this->getR50103();
            $this->storage->attach($release);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $this->storage->attach($release);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $this->storage->attach($release);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $this->storage->attach($release);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'checkdate'                     => null,
            'date'                          => null,
            'getdate'                       => null,
            'gmdate'                        => null,
            'gmmktime'                      => null,
            'gmstrftime'                    => null,
            'localtime'                     => null,
            'mktime'                        => null,
            'strftime'                      => null,
            'strtotime'                     => null,
            'time'                          => null,
        );
        return $release;
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
            'date_sunrise'                  => null,
            'date_sunset'                   => null,
            'idate'                         => null,
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
            'date'    => '2005-11-24',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'date.default_latitude'         => null,
            'date.default_longitude'        => null,
            'date.sunrise_zenith'           => null,
            'date.sunset_zenith'            => null,
            'date.timezone'                 => null,
        );
        $release->functions = array(
            'date_default_timezone_get'     => null,
            'date_default_timezone_set'     => null,
            'timezone_abbreviations_list'   => null,
            'timezone_identifiers_list'     => null,
            'timezone_name_get'             => null,
            'timezone_offset_get'           => null,
            'timezone_open'                 => null,
        );
        return $release;
    }

    protected function getR50101()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.1.1',
            'php.max' => '',
        );
        $release->constants = array(
            'DATE_ATOM'                     => null,
            'DATE_COOKIE'                   => null,
            'DATE_ISO8601'                  => null,
            'DATE_RFC1036'                  => null,
            'DATE_RFC1123'                  => null,
            'DATE_RFC2822'                  => null,
            'DATE_RFC822'                   => null,
            'DATE_RFC850'                   => null,
            'DATE_RSS'                      => null,
            'DATE_W3C'                      => null,
        );
        return $release;
    }

    protected function getR50102()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.1.2',
            'php.max' => '',
        );
        $release->functions = array(
            'date_sun_info'                 => null,
        );
        $release->constants = array(
            'SUNFUNCS_RET_DOUBLE'           => null,
            'SUNFUNCS_RET_STRING'           => null,
            'SUNFUNCS_RET_TIMESTAMP'        => null,
        );
        return $release;
    }

    protected function getR50103()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-05-02',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->functions = array(
            'timezone_name_from_abbr'       => null,
        );
        $release->constants = array(
            'DATE_RFC3339'                  => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'date_create'                   => null,
            'date_date_set'                 => null,
            'date_format'                   => null,
            'date_isodate_set'              => null,
            'date_modify'                   => null,
            'date_offset_get'               => null,
            'date_parse'                    => null,
            'date_time_set'                 => null,
            'date_timezone_get'             => null,
            'date_timezone_set'             => null,
            'timezone_transitions_get'      => null,
        );
        $release->classes = array(
            'DateTime'                      => array(
                'methods' => array(
                    'diff'                  => array(
                        'php.min' => '5.3.0'
                    ),
                ),
            ),
            'DateTimeZone'                  => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'date_add'                              => null,
            'date_create_from_format'               => null,
            'date_diff'                             => null,
            'date_get_last_errors'                  => null,
            'date_interval_create_from_date_string' => null,
            'date_interval_format'                  => null,
            'date_parse_from_format'                => null,
            'date_sub'                              => null,
            'date_timestamp_get'                    => null,
            'date_timestamp_set'                    => null,
            'timezone_location_get'                 => null,
            'timezone_version_get'                  => null,
        );
        $release->classes = array(
            'DateInterval'                          => null,
            'DatePeriod'                            => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->functions = array(
            'date_create_immutable'             => null,
            'date_create_immutable_from_format' => null,
        );
        $release->classes = array(
            'DateTimeImmutable'                 => null,
        );
        $release->interfaces = array(
            'DateTimeInterface'                 => null,
        );
        return $release;
    }
}
