<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class LibxmlExtension extends AbstractReference
{
    const REF_NAME    = 'libxml';
    const REF_VERSION = '';

    private $version_number;

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $this->version_number = $this->getMetaVersion('version_number');

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.11
        if (version_compare($version, '5.2.11', 'ge')) {
            $release = $this->getR50211();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.12
        if (version_compare($version, '5.2.12', 'ge')) {
            $release = $this->getR50212();
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

        // 5.5.2
        if (version_compare($version, '5.5.2', 'ge')) {
            $release = $this->getR50502();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
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
            'libxml_set_streams_context'    => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            'LibXMLError'                   => null,
        );
        $release->constants = array(
            'LIBXML_DOTTED_VERSION'         => null,
            'LIBXML_DTDATTR'                => null,
            'LIBXML_DTDLOAD'                => null,
            'LIBXML_DTDVALID'               => null,
            'LIBXML_ERR_ERROR'              => null,
            'LIBXML_ERR_FATAL'              => null,
            'LIBXML_ERR_NONE'               => null,
            'LIBXML_ERR_WARNING'            => null,
            'LIBXML_NOBLANKS'               => null,
            'LIBXML_NOCDATA'                => null,
            'LIBXML_NOEMPTYTAG'             => null,
            'LIBXML_NOENT'                  => null,
            'LIBXML_NOERROR'                => null,
            'LIBXML_NONET'                  => null,
            'LIBXML_NOWARNING'              => null,
            'LIBXML_NSCLEAN'                => null,
            'LIBXML_VERSION'                => null,
            'LIBXML_XINCLUDE'               => null,
        );
        if ($this->version_number >= 20621) { /* 2.6.21 */
            $items = array(
                'LIBXML_COMPACT'            => null,
                'LIBXML_NOXMLDECL'          => null,
            );
            $release->constants += $items;
        }
        $release->functions = array(
            'libxml_clear_errors'           => null,
            'libxml_get_errors'             => null,
            'libxml_get_last_error'         => null,
            'libxml_use_internal_errors'    => null,
        );
        return $release;
    }

    protected function getR50211()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.11',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-09-16',
            'php.min' => '5.2.11',
            'php.max' => '',
        );
        $release->functions = array(
            'libxml_disable_entity_loader'  => null,
        );
        return $release;
    }

    protected function getR50212()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.12',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-12-17',
            'php.min' => '5.2.12',
            'php.max' => '',
        );
        $release->constants = array();

        if ($this->version_number >= 20703) { /* 2.7.3 */
            $items = array(
                'LIBXML_PARSEHUGE'          => null,
            );
            $release->constants += $items;
        }
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
        $release->constants = array(
            'LIBXML_LOADED_VERSION'         => null,
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
        $release->constants = array(
            'LIBXML_PEDANTIC'                   => null,
        );
        if ($this->version_number >= 20707) { /* 2.7.7 */
            $items = array(
                'LIBXML_HTML_NOIMPLIED'         => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 20708) { /* 2.7.8 */
            $items = array(
                'LIBXML_HTML_NODEFDTD'          => null,
            );
            $release->constants += $items;
        }
        $release->functions = array(
            'libxml_set_external_entity_loader' => null,
        );
        return $release;
    }

    protected function getR50502()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.5.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-08-15',
            'php.min' => '5.5.2',
            'php.max' => '',
        );
        $release->constants = array();
        if ($this->version_number >= 20614) { /* 2.6.14 */
            $items = array(
                'LIBXML_SCHEMA_CREATE'      => null,
            );
            $release->constants += $items;
        }
        return $release;
    }
}
