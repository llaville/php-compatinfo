<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class EnchantExtension extends AbstractReference
{
    const REF_NAME    = 'enchant';
    const REF_VERSION = '1.1.0';    // 2009-10-08 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.2.0
        if (version_compare($version, '0.2.0', 'ge')) {
            $release = $this->getR00200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.1
        if (version_compare($version, '1.0.1', 'ge')) {
            $release = $this->getR10001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2004-03-08',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'enchant_broker_describe'           => null,
            'enchant_broker_dict_exists'        => null,
            'enchant_broker_free'               => null,
            'enchant_broker_free_dict'          => null,
            'enchant_broker_get_error'          => null,
            'enchant_broker_init'               => null,
            'enchant_broker_request_dict'       => null,
            'enchant_broker_request_pwl_dict'   => null,
            'enchant_broker_set_ordering'       => null,
            'enchant_dict_add_to_personal'      => null,
            'enchant_dict_add_to_session'       => null,
            'enchant_dict_check'                => null,
            'enchant_dict_describe'             => null,
            'enchant_dict_get_error'            => null,
            'enchant_dict_is_in_session'        => null,
            'enchant_dict_store_replacement'    => null,
            'enchant_dict_suggest'              => null,
        );
        return $release;
    }

    protected function getR00200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.2.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2004-03-09',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'enchant_dict_quick_check'          => null,
        );
        return $release;
    }

    protected function getR10001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-03-21',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'enchant_broker_list_dicts'         => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-10-08',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'enchant_broker_get_dict_path'      => null,
            'enchant_broker_set_dict_path'      => null,
        );
        $release->constants = array(
            'ENCHANT_ISPELL'                    => null,
            'ENCHANT_MYSPELL'                   => null,
        );
        return $release;
    }
}
