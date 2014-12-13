<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SphinxExtension extends AbstractReference
{
    const REF_NAME    = 'sphinx';
    const REF_VERSION = '1.3.2';    // 2014-05-06 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $this->storage->attach($release);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $this->storage->attach($release);
        }

        // 1.3.0
        if (version_compare($version, '1.3.0', 'ge')) {
            $release = $this->getR10300();
            $this->storage->attach($release);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-07-21',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->classes = array(
            'SphinxClient'                      => null,
        );
        $release->constants = array(
            'SEARCHD_ERROR'                     => null,
            'SEARCHD_OK'                        => null,
            'SEARCHD_RETRY'                     => null,
            'SEARCHD_WARNING'                   => null,

            'SPH_ATTR_BOOL'                     => null,
            'SPH_ATTR_FLOAT'                    => null,
            'SPH_ATTR_INTEGER'                  => null,
            'SPH_ATTR_MULTI'                    => null,
            'SPH_ATTR_ORDINAL'                  => null,
            'SPH_ATTR_TIMESTAMP'                => null,
            'SPH_FILTER_FLOATRANGE'             => null,

            'SPH_FILTER_RANGE'                  => null,
            'SPH_FILTER_VALUES'                 => null,
            'SPH_GROUPBY_ATTR'                  => null,
            'SPH_GROUPBY_ATTRPAIR'              => null,

            'SPH_GROUPBY_DAY'                   => null,
            'SPH_GROUPBY_MONTH'                 => null,
            'SPH_GROUPBY_WEEK'                  => null,
            'SPH_GROUPBY_YEAR'                  => null,
            'SPH_MATCH_ALL'                     => null,
            'SPH_MATCH_ANY'                     => null,

            'SPH_MATCH_BOOLEAN'                 => null,
            'SPH_MATCH_EXTENDED'                => null,
            'SPH_MATCH_EXTENDED2'               => null,

            'SPH_MATCH_FULLSCAN'                => null,
            'SPH_MATCH_PHRASE'                  => null,
            'SPH_RANK_BM25'                     => null,
            'SPH_RANK_NONE'                     => null,
            'SPH_RANK_PROXIMITY_BM25'           => null,
            'SPH_RANK_WORDCOUNT'                => null,

            'SPH_SORT_ATTR_ASC'                 => null,
            'SPH_SORT_ATTR_DESC'                => null,
            'SPH_SORT_EXPR'                     => null,
            'SPH_SORT_EXTENDED'                 => null,
            'SPH_SORT_RELEVANCE'                => null,
            'SPH_SORT_TIME_SEGMENTS'            => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-09-17',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->constants = array(
            'SPH_RANK_FIELDMASK'                => null,
            'SPH_RANK_MATCHANY'                 => null,
            'SPH_RANK_PROXIMITY'                => null,
        );
        return $release;
    }

    protected function getR10300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-04-04',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->constants = array(
            'SPH_RANK_EXPR'                     => null,
            'SPH_RANK_SPH04'                    => null,
            'SPH_RANK_TOTAL'                    => null,
        );
        return $release;
    }
}
