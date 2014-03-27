<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

// @link http://docs.php.net/manual/en/book.pthreads.php

class PthreadsExtension extends AbstractReference
{
    const REF_NAME    = 'pthreads';
    const REF_VERSION = '2.0.3';    // 2014-03-27 (stable)

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

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0
        if (version_compare($version, '2.0.0', 'ge')) {
            $release = $this->getR20000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.1
        if (version_compare($version, '2.0.1', 'ge')) {
            $release = $this->getR20001();
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
            'Thread'                        => array(
                'methods' => array(
                    'detach'                => null,
                    'getCreatorId'          => null,
                    'getThreadId'           => null,
                    'isJoined'              => null,
                    'isStarted'             => null,
                    'join'                  => null,
                    'kill'                  => null,
                    'notify'                => null,
                    'start'                 => null,
                    'wait'                  => null,
                ),
                'staticMethods' => array(
                    'getCurrentThread'      => null,
                    'getCurrentThreadId'    => null,
                    'globally'              => array('ext.min' => '2.0.1'),
                ),
            ),
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

    protected function getR10000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-03-07',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Pool'                          => array(
                'methods' => array(
                    '__construct'           => null,
                    '__destruct'            => null,
                    'collect'               => null,
                    'resize'                => null,
                    'shutdown'              => null,
                    'submit'                => null,
                    'submitTo'              => null,
                ),
            ),
        );
        return $release;
    }

    protected function getR20000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-03-14',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Threaded'                      => array(
                'methods' => array(
                    'chunk'                 => null,
                    'count'                 => null,
                    'getTerminationInfo'    => null,
                    'isRunning'             => null,
                    'isTerminated'          => null,
                    'isWaiting'             => null,
                    'lock'                  => null,
                    'merge'                 => null,
                    'notify'                => null,
                    'pop'                   => null,
                    'run'                   => null,
                    'shift'                 => null,
                    'synchronized'          => null,
                    'unlock'                => null,
                    'wait'                  => null,
                ),
            ),
        );
        return $release;
    }

    protected function getR20001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-03-16',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PTHREADS_ALLOW_GLOBALS'        => null,
        );
        return $release;
    }
}
