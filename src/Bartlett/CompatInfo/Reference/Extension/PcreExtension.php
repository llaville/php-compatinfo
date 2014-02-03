<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PcreExtension extends AbstractReference
{
    const REF_NAME    = 'pcre';
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

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.4
        if (version_compare($version, '5.2.4', 'ge')) {
            $release = $this->getR50204();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.9
        if (version_compare($version, '5.2.9', 'ge')) {
            $release = $this->getR50209();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
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
            'preg_grep'                     => null,
            'preg_match'                    => null,
            'preg_match_all'                => null,
            'preg_quote'                    => null,
            'preg_replace'                  => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.1, 5.1.0'),
            'preg_split'                    => null,
        );
        $release->constants = array(
            'PREG_GREP_INVERT'              => null,
            'PREG_PATTERN_ORDER'            => null,
            'PREG_SET_ORDER'                => null,
            'PREG_SPLIT_NO_EMPTY'           => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->functions = array(
            'preg_replace_callback'         => array('4.0.5', '', '4.0.5, 4.0.5, 4.0.5, 4.0.5, 5.1.0'),
        );
        $release->constants = array(
            'PREG_SPLIT_DELIM_CAPTURE'      => null,
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
        $release->constants = array(
            'PREG_OFFSET_CAPTURE'           => null,
            'PREG_SPLIT_OFFSET_CAPTURE'     => null,
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
        $release->iniEntries = array(
            'pcre.backtrack_limit'          => null,
            'pcre.recursion_limit'          => null,
        );
        $release->functions = array(
            'preg_last_error'               => null,
        );
        $release->constants = array(
            'PREG_BACKTRACK_LIMIT_ERROR'    => null,
            'PREG_BAD_UTF8_ERROR'           => null,
            'PREG_INTERNAL_ERROR'           => null,
            'PREG_NO_ERROR'                 => null,
            'PREG_RECURSION_LIMIT_ERROR'    => null,
        );
        return $release;
    }

    protected function getR50204()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-08-30',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->constants = array(
            'PCRE_VERSION'                  => null,
        );
        return $release;
    }

    protected function getR50209()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.9',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-02-26',
            'php.min' => '5.2.9',
            'php.max' => '',
        );
        $release->constants = array(
            'PREG_BAD_UTF8_OFFSET_ERROR'    => null,
        );
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
        $release->functions = array(
            'preg_filter'                   => null,
        );
        return $release;
    }
}
