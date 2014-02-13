<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XmlwriterExtension extends AbstractReference
{
    const REF_NAME    = 'xmlwriter';
    const REF_VERSION = '0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        //$version  = $this->getCurrentVersion();  // @FIXME
        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 5.1.2
        if (version_compare($version, '5.1.2', 'ge')) {
            $release = $this->getR50102();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR50102()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-01-12',
            'php.min' => '5.1.2',
            'php.max' => '',
        );
        $release->classes = array(
            'XMLWriter'                     => null,
        );
        $release->functions = array(
            'xmlwriter_end_attribute'       => null,
            'xmlwriter_end_cdata'           => null,
            'xmlwriter_end_comment'         => null,
            'xmlwriter_end_document'        => null,
            'xmlwriter_end_dtd'             => null,
            'xmlwriter_end_dtd_attlist'     => null,
            'xmlwriter_end_dtd_element'     => null,
            'xmlwriter_end_dtd_entity'      => null,
            'xmlwriter_end_element'         => null,
            'xmlwriter_end_pi'              => null,
            'xmlwriter_flush'               => null,
            'xmlwriter_open_memory'         => null,
            'xmlwriter_open_uri'            => null,
            'xmlwriter_output_memory'       => null,
            'xmlwriter_set_indent'          => null,
            'xmlwriter_set_indent_string'   => null,
            'xmlwriter_start_attribute'     => null,
            'xmlwriter_start_attribute_ns'  => null,
            'xmlwriter_start_cdata'         => null,
            'xmlwriter_start_comment'       => null,
            'xmlwriter_start_document'      => null,
            'xmlwriter_start_dtd'           => null,
            'xmlwriter_start_dtd_attlist'   => null,
            'xmlwriter_start_dtd_element'   => null,
            'xmlwriter_start_dtd_entity'    => null,
            'xmlwriter_start_element'       => null,
            'xmlwriter_start_element_ns'    => null,
            'xmlwriter_start_pi'            => null,
            'xmlwriter_text'                => null,
            'xmlwriter_write_attribute'     => null,
            'xmlwriter_write_attribute_ns'  => null,
            'xmlwriter_write_cdata'         => null,
            'xmlwriter_write_comment'       => null,
            'xmlwriter_write_dtd'           => null,
            'xmlwriter_write_dtd_attlist'   => null,
            'xmlwriter_write_dtd_element'   => null,
            'xmlwriter_write_dtd_entity'    => null,
            'xmlwriter_write_element'       => null,
            'xmlwriter_write_element_ns'    => null,
            'xmlwriter_write_pi'            => null,
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
            'xmlwriter_full_end_element'    => null,
            'xmlwriter_write_raw'           => null,
        );
        return $release;
    }
}
