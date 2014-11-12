<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ReadlineExtension extends AbstractReference
{
    const REF_NAME    = 'readline';
    const REF_VERSION = '2.0.1';

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

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'readline'                          => null,
            'readline_add_history'              => null,
            'readline_clear_history'            => null,
            'readline_completion_function'      => null,
            'readline_info'                     => null,
            'readline_list_history'             => null,
            'readline_read_history'             => null,
            'readline_write_history'            => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-11-24',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'readline_callback_handler_install' => null,
            'readline_callback_handler_remove'  => null,
            'readline_callback_read_char'       => null,
            'readline_on_new_line'              => null,
            'readline_redisplay'                => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'cli.pager'                         => null,
            'cli.prompt'                        => null,
        );
        $release->constants = array(
            'READLINE_LIB'                      => null,
        );
        return $release;
    }
}
