<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

// @link http://docs.php.net/manual/en/book.pthreads.php

class PthreadsExtension extends AbstractReference
{
    const REF_NAME    = 'pthreads';
    const REF_VERSION = '0.1.0';    // 2014-01-18 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.0.33
        if (version_compare($version, '0.0.33', 'ge')) {
            $release = $this->getR00033();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.0.36
        if (version_compare($version, '0.0.36', 'ge')) {
            $release = $this->getR00036();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.0.43
        if (version_compare($version, '0.0.43', 'ge')) {
            $release = $this->getR00043();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00033()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.0.33',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2012-09-25',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Cond'                          => null,
            'Mutex'                         => null,
            'Thread'                        => null,
            'Worker'                        => null,
        );
        return $release;
    }

    protected function getR00036()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.0.36',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-10-27',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Stackable'                     => null,
        );
        return $release;
    }

    protected function getR00043()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.0.43',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-03-26',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PTHREADS_INHERIT_ALL'          => null,
            'PTHREADS_INHERIT_CLASSES'      => null,
            'PTHREADS_INHERIT_CONSTANTS'    => null,
            'PTHREADS_INHERIT_FUNCTIONS'    => null,
            'PTHREADS_INHERIT_INCLUDES'     => null,
            'PTHREADS_INHERIT_INI'          => null,
            'PTHREADS_INHERIT_NONE'         => null,
        );
        return $release;
    }

    protected function getR00100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-01-18',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PTHREADS_ALLOW_HEADERS'        => null,
            'PTHREADS_INHERIT_COMMENTS'     => null,
        );
        return $release;
    }
}
