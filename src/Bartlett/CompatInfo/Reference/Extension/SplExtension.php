<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SplExtension extends AbstractReference
{
    const REF_NAME    = 'spl';
    const REF_VERSION = '0.2';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.2
        if (version_compare($version, '5.1.2', 'ge')) {
            $release = $this->getR50102();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.3
        if (version_compare($version, '5.1.3', 'ge')) {
            $release = $this->getR50103();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
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

    protected function getR50000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->classes = array(
            'ArrayIterator'                 => null,
            'ArrayObject'                   => null,
            'CachingIterator'               => null,
            'DirectoryIterator'             => null,
        );
        $release->functions = array(
            'spl_classes'                   => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->interfaces = array(
            'ArrayAccess'                   => array('5.1.0', '', 'ext.max' => self::LATEST_PHP_5_2),
            'Countable'                     => null,
            'Iterator'                      => array('5.1.0', '', 'ext.max' => self::LATEST_PHP_5_2),
            'IteratorAggregate'             => array('5.1.0', '', 'ext.max' => self::LATEST_PHP_5_2),
            'OuterIterator'                 => null,
            'RecursiveIterator'             => null,
            'SeekableIterator'              => null,
            'Serializable'                  => array('5.1.0', '', 'ext.max' => self::LATEST_PHP_5_2),
            'SplObserver'                   => null,
            'SplSubject'                    => null,
            'Traversable'                   => array('5.1.0', '', 'ext.max' => self::LATEST_PHP_5_2),
        );
        $release->classes = array(
            'AppendIterator'                => null,
            'BadFunctionCallException'      => null,
            'BadMethodCallException'        => null,
            'DomainException'               => null,
            'EmptyIterator'                 => null,
            'FilterIterator'                => null,
            'InfiniteIterator'              => null,
            'InvalidArgumentException'      => null,
            'IteratorIterator'              => null,
            'LengthException'               => null,
            'LimitIterator'                 => null,
            'LogicException'                => null,
            'NoRewindIterator'              => null,
            'OutOfBoundsException'          => null,
            'OutOfRangeException'           => null,
            'OverflowException'             => null,
            'ParentIterator'                => null,
            'RangeException'                => null,
            'RecursiveArrayIterator'        => null,
            'RecursiveCachingIterator'      => null,
            'RecursiveFilterIterator'       => null,
            'RuntimeException'              => null,
            'SimpleXMLIterator'             => array('5.1.0', '', 'ext.max' => self::LATEST_PHP_5_2),
            'SplFileObject'                 => null,
            'SplObjectStorage'              => null,
            'UnderflowException'            => null,
            'UnexpectedValueException'      => null,
        );
        $release->functions = array(
            'class_implements'              => null,
            'class_parents'                 => null,
            'iterator_apply'                => null,
            'iterator_count'                => null,
            'iterator_to_array'             => null,
        );
        return $release;
    }

    protected function getR50102()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-01-12',
            'php.min' => '5.1.2',
            'php.max' => '',
        );
        $release->classes = array(
            'RecursiveDirectoryIterator'    => null,
            'SplFileInfo'                   => null,
            'SplTempFileObject'             => null,
        );
        $release->functions = array(
            'spl_autoload'                  => null,
            'spl_autoload_call'             => null,
            'spl_autoload_extensions'       => null,
            'spl_autoload_functions'        => null,
            'spl_autoload_register'         => null,
            'spl_autoload_unregister'       => null,
        );
        return $release;
    }

    protected function getR50103()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-05-02',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->classes = array(
            'RecursiveIteratorIterator'     => null,
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
        $release->classes = array(
            'RecursiveRegexIterator'        => null,
            'RegexIterator'                 => null,
        );
        $release->functions = array(
            'spl_object_hash'               => null,
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
        $release->classes = array(
            'FilesystemIterator'            => null,
            'GlobIterator'                  => null,
            'MultipleIterator'              => null,
            'RecursiveTreeIterator'         => null,
            'SplDoublyLinkedList'           => null,
            'SplFixedArray'                 => null,
            'SplHeap'                       => null,
            'SplMaxHeap'                    => null,
            'SplMinHeap'                    => null,
            'SplPriorityQueue'              => null,
            'SplQueue'                      => null,
            'SplStack'                      => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->functions = array(
            'class_uses'                        => null,
        );
        $release->classes = array(
            'CallbackFilterIterator'            => null,
            'RecursiveCallbackFilterIterator'   => null,
        );
        return $release;
    }
}
