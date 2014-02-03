<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class JsminExtension extends AbstractReference
{
    const REF_NAME    = 'jsmin';
    const REF_VERSION = '0.1.1';    // 2013-09-14 (beta)

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
    }

    protected function getR00100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-07-26',
            'php.min' => '5.3.10',
            'php.max' => '',
        );
        $release->constants = array(
            'JSMIN_ERROR_NONE'                  => null,
            'JSMIN_ERROR_UNTERMINATED_COMMENT'  => null,
            'JSMIN_ERROR_UNTERMINATED_STRING'   => null,
            'JSMIN_ERROR_UNTERMINATED_REGEX'    => null,
        );
        $release->functions = array(
            'jsmin'                             => null,
            'jsmin_last_error'                  => null,
            'jsmin_last_error_msg'              => null,
        );
        return $release;
    }
}
