<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XslExtension extends AbstractReference
{
    const REF_NAME    = 'xsl';
    const REF_VERSION = '0.1';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.2
        if (version_compare($version, '5.1.2', 'ge')) {
            $release = $this->getR50102();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.9
        if (version_compare($version, '5.3.9', 'ge')) {
            $release = $this->getR50309();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
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
        $release->classes = array(
            'XSLTProcessor'                     => null,
        );
        $release->constants = array(
            'XSL_CLONE_ALWAYS'                  => null,
            'XSL_CLONE_AUTO'                    => null,
            'XSL_CLONE_NEVER'                   => null,
        );
        return $release;
    }

    protected function getR50102()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.1.2',
            'php.max' => '',
        );
        $release->constants = array(
            'LIBEXSLT_DOTTED_VERSION'           => null,
            'LIBEXSLT_VERSION'                  => null,
            'LIBXSLT_DOTTED_VERSION'            => null,
            'LIBXSLT_VERSION'                   => null,
        );
        return $release;
    }

    protected function getR50309()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.9',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '5.3.9',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xsl.security_prefs'                => null,
        );
        $release->constants = array(
            'XSL_SECPREF_CREATE_DIRECTORY'      => null,
            'XSL_SECPREF_DEFAULT'               => null,
            'XSL_SECPREF_NONE'                  => null,
            'XSL_SECPREF_READ_FILE'             => null,
            'XSL_SECPREF_READ_NETWORK'          => null,
            'XSL_SECPREF_WRITE_FILE'            => null,
            'XSL_SECPREF_WRITE_NETWORK'         => null,
        );
        return $release;
    }
}
