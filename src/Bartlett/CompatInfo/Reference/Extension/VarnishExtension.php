<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

// Varnish
// @link https://www.varnish-cache.org/
//

class VarnishExtension extends AbstractReference
{
    const REF_NAME    = 'varnish';
    const REF_VERSION = '1.1.1';    // 2013-10-20 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.3
        if (version_compare($version, '0.3', 'ge')) {
            $release = $this->getR00300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.4
        if (version_compare($version, '0.4', 'ge')) {
            $release = $this->getR00400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.8
        if (version_compare($version, '0.8', 'ge')) {
            $release = $this->getR00800();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.9.2
        if (version_compare($version, '0.9.2', 'ge')) {
            $release = $this->getR00902();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.3',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2011-08-23',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'VarnishAdmin'                  => null,
            'VarnishException'              => null,
            'VarnishLog'                    => null,
            'VarnishStat'                   => null,
        );
        $release->constants = array(
            // Status/return codes in the varnish CLI protocol
            'VARNISH_STATUS_AUTH'           => null,
            'VARNISH_STATUS_CANT'           => null,
            'VARNISH_STATUS_CLOSE'          => null,
            'VARNISH_STATUS_COMMS'          => null,
            'VARNISH_STATUS_OK'             => null,
            'VARNISH_STATUS_PARAM'          => null,
            'VARNISH_STATUS_SYNTAX'         => null,
            'VARNISH_STATUS_TOOFEW'         => null,
            'VARNISH_STATUS_TOOMANY'        => null,
            'VARNISH_STATUS_UNIMPL'         => null,
            'VARNISH_STATUS_UNKNOWN'        => null,
        );
        return $release;
    }

    protected function getR00400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.4',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2011-08-26',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'VarnishLog'                    => null,
        );
        return $release;
    }

    protected function getR00800()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.8',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2011-09-02',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'VARNISH_CONFIG_HOST'           => null,
            'VARNISH_CONFIG_IDENT'          => null,
            'VARNISH_CONFIG_PORT'           => null,
            'VARNISH_CONFIG_SECRET'         => null,
            'VARNISH_CONFIG_TIMEOUT'        => null,
        );
        return $release;
    }

    protected function getR00902()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.9.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2011-10-06',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'VARNISH_CONFIG_COMPAT'         => null,
            'VARNISH_COMPAT_2'              => null,
            'VARNISH_COMPAT_3'              => null,
        );
        return $release;
    }
}
