<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class GeoipExtension extends AbstractReference
{
    const REF_NAME    = 'geoip';
    const REF_VERSION = '1.1.0';    // 2014-05-01 (beta)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.2.0
        if (version_compare($version, '0.2.0', 'ge')) {
            $release = $this->getR00200();
            $this->storage->attach($release);
        }

        // 1.0.1
        if (version_compare($version, '1.0.1', 'ge')) {
            $release = $this->getR10001();
            $this->storage->attach($release);
        }

        // 1.0.2
        if (version_compare($version, '1.0.2', 'ge')) {
            $release = $this->getR10002();
            $this->storage->attach($release);
        }

        // 1.0.3
        if (version_compare($version, '1.0.3', 'ge')) {
            $release = $this->getR10003();
            $this->storage->attach($release);
        }

        // 1.0.5
        if (version_compare($version, '1.0.5', 'ge')) {
            $release = $this->getR10005();
            $this->storage->attach($release);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $this->storage->attach($release);
        }
    }

    protected function getR00200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.2.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-08-22',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'geoip_country_code3_by_name'           => null,
            'geoip_country_code_by_name'            => null,
            'geoip_country_name_by_name'            => null,
            'geoip_database_info'                   => null,
            'geoip_id_by_name'                      => null,
            'geoip_org_by_name'                     => null,
            'geoip_record_by_name'                  => null,
            'geoip_region_by_name'                  => null,
        );
        $release->constants = array(
            /* For database type constants */
            'GEOIP_ASNUM_EDITION'                   => null,
            'GEOIP_CITY_EDITION_REV0'               => null,
            'GEOIP_CITY_EDITION_REV1'               => null,
            'GEOIP_COUNTRY_EDITION'                 => null,
            'GEOIP_DOMAIN_EDITION'                  => null,
            'GEOIP_ISP_EDITION'                     => null,
            'GEOIP_NETSPEED_EDITION'                => null,
            'GEOIP_ORG_EDITION'                     => null,
            'GEOIP_PROXY_EDITION'                   => null,
            'GEOIP_REGION_EDITION_REV0'             => null,
            'GEOIP_REGION_EDITION_REV1'             => null,

            /* For netspeed constants */
            'GEOIP_CABLEDSL_SPEED'                  => null,
            'GEOIP_CORPORATE_SPEED'                 => null,
            'GEOIP_DIALUP_SPEED'                    => null,
            'GEOIP_UNKNOWN_SPEED'                   => null,
        );
        return $release;
    }

    protected function getR10001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-08-22',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'geoip.custom_directory'                => null,
        );
        $release->functions = array(
            'geoip_db_avail'                        => null,
            'geoip_db_filename'                     => null,
            'geoip_db_get_all_info'                 => null,
        );
        return $release;
    }

    protected function getR10002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-11-20',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'geoip_isp_by_name'                     => null,
        );
        return $release;
    }

    protected function getR10003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-06-12',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'geoip_continent_code_by_name'          => null,
        );
        return $release;
    }

    protected function getR10005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-12-19',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'geoip_region_name_by_code'             => null,
            'geoip_time_zone_by_country_and_region' => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-05-01',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'geoip_setup_custom_directory'          => null,
            'geoip_asnum_by_name'                   => null,
            'geoip_domain_by_name'                  => null,
            'geoip_netspeedcell_by_name'            => null,
        );
        $release->constants = array(
            'GEOIP_NETSPEED_EDITION_REV1'           => null,
        );
        return $release;
    }
}
