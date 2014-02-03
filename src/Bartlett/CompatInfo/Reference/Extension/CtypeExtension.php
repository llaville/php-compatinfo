<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class CtypeExtension extends AbstractReference
{
    const REF_NAME    = 'ctype';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40004()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'ctype_alnum'                   => null,
            'ctype_alpha'                   => null,
            'ctype_cntrl'                   => null,
            'ctype_digit'                   => null,
            'ctype_graph'                   => null,
            'ctype_lower'                   => null,
            'ctype_print'                   => null,
            'ctype_punct'                   => null,
            'ctype_space'                   => null,
            'ctype_upper'                   => null,
            'ctype_xdigit'                  => null,
        );
        return $release;
    }
}
