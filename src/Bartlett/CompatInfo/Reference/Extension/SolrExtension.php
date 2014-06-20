<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SolrExtension extends AbstractReference
{
    const REF_NAME    = 'solr';
    const REF_VERSION = '1.1.1';    // 2014-06-20 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.9.11
        if (version_compare($version, '0.9.11', 'ge')) {
            $release = $this->getR00911();
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

    protected function getR00911()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.9.11',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2010-06-22',
            'php.min' => '5.2.3',
            'php.max' => '',
        );
        $release->classes = array(
            'SolrClient'                        => null,
            'SolrClientException'               => null,
            'SolrDocument'                      => null,
            'SolrDocumentField'                 => null,
            'SolrException'                     => null,
            'SolrGenericResponse'               => null,
            'SolrIllegalArgumentException'      => null,
            'SolrIllegalOperationException'     => null,
            'SolrInputDocument'                 => null,
            'SolrModifiableParams'              => null,
            'SolrObject'                        => null,
            'SolrParams'                        => null,
            'SolrPingResponse'                  => null,
            'SolrQuery'                         => null,
            'SolrQueryResponse'                 => null,
            'SolrResponse'                      => null,
            'SolrUpdateResponse'                => null,
            'SolrUtils'                         => null,
        );
        $release->constants = array(
            'SOLR_EXTENSION_VERSION'            => null,
            'SOLR_MAJOR_VERSION'                => null,
            'SOLR_MINOR_VERSION'                => null,
            'SOLR_PATCH_VERSION'                => null,
        );
        $release->functions = array(
            'solr_get_version'                  => null,
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
            'date'    => '2014-06-19',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'SolrServerException'               => null,
        );
        return $release;
    }
}
