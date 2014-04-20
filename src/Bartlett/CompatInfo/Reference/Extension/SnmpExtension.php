<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SnmpExtension extends AbstractReference
{
    const REF_NAME    = 'snmp';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.3
        if (version_compare($version, '4.3.3', 'ge')) {
            $release = $this->getR40303();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.11
        if (version_compare($version, '4.3.11', 'ge')) {
            $release = $this->getR40311();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.4
        if (version_compare($version, '5.0.4', 'ge')) {
            $release = $this->getR50004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
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

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'snmp_get_quick_print'              => null,
            'snmp_set_quick_print'              => null,
            'snmpget'                           => null,
            'snmprealwalk'                      => null,
            'snmpset'                           => null,
            'snmpwalk'                          => null,
            'snmpwalkoid'                       => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'snmp3_get'                         => null,
            'snmp3_real_walk'                   => null,
            'snmp3_set'                         => null,
            'snmp3_walk'                        => null,
            'snmp_set_enum_print'               => null,
            'snmp_set_oid_numeric_print'        => null,
        );
        return $release;
    }

    protected function getR40303()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'snmp_get_valueretrieval'           => null,
            'snmp_set_valueretrieval'           => null,
        );
        $release->constants = array(
            'SNMP_BIT_STR'                      => null,
            'SNMP_COUNTER'                      => null,
            'SNMP_COUNTER64'                    => null,
            'SNMP_INTEGER'                      => null,
            'SNMP_IPADDRESS'                    => null,
            'SNMP_NULL'                         => null,
            'SNMP_OBJECT_ID'                    => null,
            'SNMP_OCTET_STR'                    => null,
            'SNMP_OPAQUE'                       => null,
            'SNMP_TIMETICKS'                    => null,
            'SNMP_UINTEGER'                     => null,
            'SNMP_UNSIGNED'                     => null,
            'SNMP_VALUE_LIBRARY'                => null,
            'SNMP_VALUE_OBJECT'                 => null,
            'SNMP_VALUE_PLAIN'                  => null,
        );
        return $release;
    }

    protected function getR40311()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.11',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.3.11',
            'php.max' => '',
        );
        $release->functions = array(
            'snmp2_get'                         => null,
            'snmp2_real_walk'                   => null,
            'snmp2_set'                         => null,
            'snmp2_walk'                        => null,
        );
        return $release;
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
        $release->functions = array(
            'snmp3_getnext'                     => null,
            'snmp_read_mib'                     => null,
            'snmpgetnext'                       => null,
        );
        return $release;
    }

    protected function getR50004()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'snmp2_getnext'                     => null,
        );
        return $release;
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
            'snmp_set_oid_output_format'        => null,
        );
        $release->constants = array(
            'SNMP_OID_OUTPUT_FULL'              => null,
            'SNMP_OID_OUTPUT_NUMERIC'           => null,
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
            'SNMP'                              => null,
            'SNMPException'                     => null,
        );
        $release->constants = array(
            'SNMP_OID_OUTPUT_MODULE'            => null,
            'SNMP_OID_OUTPUT_NONE'              => null,
            'SNMP_OID_OUTPUT_SUFFIX'            => null,
            'SNMP_OID_OUTPUT_UCD'               => null,
        );
        return $release;
    }
}
