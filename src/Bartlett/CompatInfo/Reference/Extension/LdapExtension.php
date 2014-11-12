<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class LdapExtension extends AbstractReference
{
    const REF_NAME    = 'ldap';
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

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.26
        if (version_compare($version, '5.4.26', 'ge')) {
            $release = $this->getR50426();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0alpha1
        if (version_compare($version, '5.6.0alpha1', 'ge')) {
            $release = $this->getR50600a1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
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
        $release->iniEntries = array(
            'ldap.max_links'                => null,
        );
        $release->constants = array(
            'LDAP_DEREF_ALWAYS'             => null,
            'LDAP_DEREF_FINDING'            => null,
            'LDAP_DEREF_NEVER'              => null,
            'LDAP_DEREF_SEARCHING'          => null,
            'LDAP_OPT_CLIENT_CONTROLS'      => null,
            'LDAP_OPT_DEBUG_LEVEL'          => null,
            'LDAP_OPT_DEREF'                => null,
            'LDAP_OPT_ERROR_NUMBER'         => null,
            'LDAP_OPT_ERROR_STRING'         => null,
            'LDAP_OPT_HOST_NAME'            => null,
            'LDAP_OPT_MATCHED_DN'           => null,
            'LDAP_OPT_PROTOCOL_VERSION'     => null,
            'LDAP_OPT_REFERRALS'            => null,
            'LDAP_OPT_RESTART'              => null,
            'LDAP_OPT_SERVER_CONTROLS'      => null,
            'LDAP_OPT_SIZELIMIT'            => null,
            'LDAP_OPT_TIMELIMIT'            => null,
            'LDAP_OPT_X_SASL_AUTHCID'       => null,
            'LDAP_OPT_X_SASL_AUTHZID'       => null,
            'LDAP_OPT_X_SASL_MECH'          => null,
            'LDAP_OPT_X_SASL_REALM'         => null,
        );
        $release->functions = array(
            'ldap_add'                      => null,
            'ldap_bind'                     => null,
            'ldap_close'                    => null,
            'ldap_connect'                  => null,
            'ldap_count_entries'            => null,
            'ldap_delete'                   => null,
            'ldap_dn2ufn'                   => null,
            'ldap_err2str'                  => null,
            'ldap_errno'                    => null,
            'ldap_error'                    => null,
            'ldap_explode_dn'               => null,
            'ldap_first_attribute'          => null,
            'ldap_first_entry'              => null,
            'ldap_free_result'              => null,
            'ldap_get_attributes'           => null,
            'ldap_get_dn'                   => null,
            'ldap_get_entries'              => null,
            'ldap_get_values'               => null,
            'ldap_get_values_len'           => null,
            'ldap_list'                     => null,
            'ldap_mod_add'                  => null,
            'ldap_mod_del'                  => null,
            'ldap_mod_replace'              => null,
            'ldap_modify'                   => null,
            'ldap_next_attribute'           => null,
            'ldap_next_entry'               => null,
            'ldap_read'                     => array(
                '4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.0, 4.0.2, 4.0.2, 4.0.2, 4.0.2'
            ),
            'ldap_search'                   => array(
                '4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.0, 4.0.2, 4.0.2, 4.0.2, 4.0.2'
            ),
            'ldap_unbind'                   => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'ldap_compare'                  => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'ldap_get_option'               => null,
            'ldap_set_option'               => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->functions = array(
            'ldap_first_reference'          => null,
            'ldap_next_reference'           => null,
            'ldap_parse_reference'          => null,
            'ldap_parse_result'             => null,
            'ldap_rename'                   => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ldap_set_rebind_proc'          => null,
            'ldap_sort'                     => null,
            'ldap_start_tls'                => null,
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
            'ldap_sasl_bind'                => null,
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
        $release->constants = array(
            'LDAP_OPT_NETWORK_TIMEOUT'      => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ldap_control_paged_result'             => null,
            'ldap_control_paged_result_response'    => null,
        );
        return $release;
    }

    protected function getR50426()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.26',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-03-06',
            'php.min' => '5.4.26',
            'php.max' => '',
        );
        $release->constants = array(
            'LDAP_MODIFY_BATCH_ADD'                 => null,
            'LDAP_MODIFY_BATCH_REMOVE'              => null,
            'LDAP_MODIFY_BATCH_REMOVE_ALL'          => null,
            'LDAP_MODIFY_BATCH_REPLACE'             => null,
            'LDAP_MODIFY_BATCH_ATTRIB'              => null,
            'LDAP_MODIFY_BATCH_MODTYPE'             => null,
            'LDAP_MODIFY_BATCH_VALUES'              => null,
        );
        $release->functions = array(
            'ldap_modify_batch'                     => null,
        );
        return $release;
    }

    protected function getR50600a1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-01-21',
            'php.min' => '5.6.0alpha1',
            'php.max' => '',
        );
        $release->constants = array(
            'LDAP_ESCAPE_DN'                        => null,
            'LDAP_ESCAPE_FILTER'                    => null,
        );
        $release->functions = array(
            'ldap_escape'                           => null,
        );
        return $release;
    }
}
