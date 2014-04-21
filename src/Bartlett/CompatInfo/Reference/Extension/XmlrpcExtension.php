<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XmlrpcExtension extends AbstractReference
{
    const REF_NAME    = 'xmlrpc';
    const REF_VERSION = '0.51';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 4.1.0
        if (version_compare($version, '4.1.0', 'ge')) {
            $release = $this->getR40100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-12-10',
            'php.min' => '4.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'xmlrpc_decode'                                 => null,
            'xmlrpc_decode_request'                         => null,
            'xmlrpc_encode'                                 => null,
            'xmlrpc_encode_request'                         => null,
            'xmlrpc_get_type'                               => null,
            'xmlrpc_parse_method_descriptions'              => null,
            'xmlrpc_server_add_introspection_data'          => null,
            'xmlrpc_server_call_method'                     => null,
            'xmlrpc_server_create'                          => null,
            'xmlrpc_server_destroy'                         => null,
            'xmlrpc_server_register_introspection_callback' => null,
            'xmlrpc_server_register_method'                 => null,
            'xmlrpc_set_type'                               => null,
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
            'xmlrpc_is_fault'                               => null,
        );
        return $release;
    }
}
