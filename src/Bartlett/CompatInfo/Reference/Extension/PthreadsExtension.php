<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

// @link http://docs.php.net/manual/en/book.pthreads.php

class PthreadsExtension extends AbstractReference
{
    const REF_NAME    = 'pthreads';
    const REF_VERSION = '2.0.10';    // 2014-10-01 (stable)

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

        // 2.0.8
        if (version_compare($version, '2.0.8', 'ge')) {
            $release = $this->getR20008();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00033()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.0.33',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2012-09-25',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Cond'                          => array(
                'methods' => array(
                    '__construct'           => array('ext.min' => '0.0.39'),
                ),
                'staticMethods' => array(
                    'create'                => array('ext.min' => '0.0.39'),
                    'signal'                => array('ext.min' => '0.0.37'),
                    'wait'                  => array('ext.min' => '0.0.37'),
                    'broadcast'             => array('ext.min' => '0.0.37'),
                    'destroy'               => array('ext.min' => '0.0.37'),
                ),
            ),
            'Mutex'                         => array(
                'methods' => array(
                    '__construct'           => array('ext.min' => '0.0.39'),
                ),
                'staticMethods' => array(
                    'create'                => array('ext.min' => '0.0.37'),
                    'lock'                  => array('ext.min' => '0.0.37'),
                    'trylock'               => array('ext.min' => '0.0.37'),
                    'unlock'                => array('ext.min' => '0.0.37'),
                    'destroy'               => array('ext.min' => '0.0.37'),
                ),
            ),
            'Thread'                        => array(
                'methods' => array(
                    'detach'                => null,
                    'getCreatorId'          => null,
                    'getThreadId'           => null,
                    'isRunning'             => null,
                    'isWaiting'             => null,
                    'isJoined'              => null,
                    'isStarted'             => null,
                    'isTerminated'          => array('ext.min' => '0.0.45'),
                    'getTerminationInfo'    => array('ext.min' => '0.0.45'),
                    'join'                  => null,
                    'kill'                  => null,
                    'notify'                => null,
                    'start'                 => null,
                    'wait'                  => null,
                    'run'                   => array('ext.min' => '2.0.0'),
                    'synchronized'          => array('ext.min' => '0.0.40'),
                    'lock'                  => array('ext.min' => '0.0.40'),
                    'unlock'                => array('ext.min' => '0.0.40'),
                    'merge'                 => array('ext.min' => '0.0.44'),
                    'shift'                 => array('ext.min' => '0.0.45'),
                    'chunk'                 => array('ext.min' => '0.0.45'),
                    'pop'                   => array('ext.min' => '0.0.45'),
                    'count'                 => array('ext.min' => '1.0.0'),
                ),
                'staticMethods' => array(
                    'getCurrentThread'      => array('ext.min' => '1.0.0'),
                    'getCurrentThreadId'    => array('ext.min' => '1.0.0'),
                    'globally'              => array('ext.min' => '2.0.1'),
                    'extend'                => array('ext.min' => '2.0.8'),
                    'from'                  => array('ext.min' => '2.0.9'),
                ),
            ),
            'Worker'                        => array(
                'methods' => array(
                    'shutdown'              => array('ext.min' => '0.0.37'),
                    'stack'                 => array('ext.min' => '0.0.37'),
                    'unstack'               => array('ext.min' => '0.0.37'),
                    'getStacked'            => array('ext.min' => '0.0.37'),
                    'isShutdown'            => array('ext.min' => '0.0.37'),
                    'isWorking'             => array('ext.min' => '0.0.37'),
                    'start'                 => array('ext.min' => '0.0.37'),
                    'join'                  => array('ext.min' => '0.0.37'),
                    'detach'                => array('ext.min' => '0.0.37'),
                    'isStarted'             => array('ext.min' => '0.0.37'),
                    'isJoined'              => array('ext.min' => '0.0.37'),
                    'getThreadId'           => array('ext.min' => '0.0.37'),
                    'getCreatorId'          => array('ext.min' => '0.0.37'),
                    'kill'                  => array('ext.min' => '0.0.37'),
                    'run'                   => array('ext.min' => '0.0.37'),
                    'wait'                  => array('ext.min' => '0.0.37'),
                    'notify'                => array('ext.min' => '0.0.37'),
                    'isRunning'             => array('ext.min' => '0.0.37'),
                    'isWaiting'             => array('ext.min' => '0.0.37'),
                    'isTerminated'          => array('ext.min' => '0.0.37'),
                    'getTerminationInfo'    => array('ext.min' => '0.0.37'),
                    'synchronized'          => array('ext.min' => '0.0.40'),
                    'lock'                  => array('ext.min' => '0.0.40'),
                    'unlock'                => array('ext.min' => '0.0.40'),
                    'merge'                 => array('ext.min' => '0.0.44'),
                    'shift'                 => array('ext.min' => '0.0.45'),
                    'chunk'                 => array('ext.min' => '0.0.45'),
                    'pop'                   => array('ext.min' => '0.0.45'),
                    'count'                 => array('ext.min' => '1.0.0'),
                ),
                'staticMethods' => array(
                    'getCurrentThread'      => array('ext.min' => '1.0.0'),
                    'getCurrentThreadId'    => array('ext.min' => '1.0.0'),
                    'globally'              => array('ext.min' => '2.0.1'),
                    'extend'                => array('ext.min' => '2.0.8'),
                    'from'                  => array('ext.min' => '2.0.9'),
                ),
            ),
        );
        return $release;
    }

    protected function getR00036()
    {
        $release = new \stdClass;
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
        $release = new \stdClass;
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
        $release = new \stdClass;
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
        $release = new \stdClass;
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
        $release = new \stdClass;
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
                'staticMethods' => array(
                    'extend'                => array('ext.min' => '2.0.8'),
                    'from'                  => array('ext.min' => '2.0.9'),
                ),
            ),
        );
        return $release;
    }

    protected function getR20001()
    {
        $release = new \stdClass;
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

    protected function getR20008()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.8',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-09-15',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Collectable'                   => array(
                'methods' => array(
                    'chunk'                 => null,
                    'count'                 => null,
                    'getTerminationInfo'    => null,
                    'isGarbage'             => null,
                    'isRunning'             => null,
                    'isTerminated'          => null,
                    'isWaiting'             => null,
                    'lock'                  => null,
                    'merge'                 => null,
                    'notify'                => null,
                    'pop'                   => null,
                    'run'                   => null,
                    'setGarbage'            => null,
                    'shift'                 => null,
                    'synchronized'          => null,
                    'unlock'                => null,
                    'wait'                  => null,
                ),
                'staticMethods' => array(
                    'extend'                => null,
                    'from'                  => array('ext.min' => '2.0.9'),
                )
            )
        );
        return $release;
    }
}
