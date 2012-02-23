<?php
/**
 * Version informations about SPL extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about SPL extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.spl.php
 */
class PHP_CompatInfo_Reference_SPL implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'SPL' => array('5.0.0', '', '0.2')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/spl.interfaces.php
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'Countable'                      => array('5.1.0', ''),
                'OuterIterator'                  => array('5.1.0', ''),
                'RecursiveIterator'              => array('5.1.0', ''),
                'SeekableIterator'               => array('5.1.0', ''),
                'Traversable'                    => array('5.1.0', ''),
                'Iterator'                       => array('5.1.0', ''),
                'IteratorAggregate'              => array('5.1.0', ''),
                'ArrayAccess'                    => array('5.1.0', ''),
                'Serializable'                   => array('5.1.0', ''),
                'SplObserver'                    => array('5.1.0', ''),
                'SplSubject'                     => array('5.1.0', ''),
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/spl.datastructures.php
     * @link   http://www.php.net/manual/en/spl.iterators.php
     * @link   http://www.php.net/manual/en/spl.exceptions.php
     * @link   http://www.php.net/manual/en/spl.files.php
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'Exception'                      => array('5.1.0', ''),
                'ErrorException'                 => array('5.1.0', ''),
                'LogicException'                 => array('5.1.0', ''),
                'BadFunctionCallException'       => array('5.1.0', ''),
                'BadMethodCallException'         => array('5.1.0', ''),
                'DomainException'                => array('5.1.0', ''),
                'InvalidArgumentException'       => array('5.1.0', ''),
                'LengthException'                => array('5.1.0', ''),
                'OutOfRangeException'            => array('5.1.0', ''),
                'RuntimeException'               => array('5.1.0', ''),
                'OutOfBoundsException'           => array('5.1.0', ''),
                'OverflowException'              => array('5.1.0', ''),
                'RangeException'                 => array('5.1.0', ''),
                'UnderflowException'             => array('5.1.0', ''),
                'UnexpectedValueException'       => array('5.1.0', ''),
                'RecursiveIteratorIterator'      => array('5.1.3', ''),
                'IteratorIterator'               => array('5.1.0', ''),
                'FilterIterator'                 => array('5.1.0', ''),
                'RecursiveFilterIterator'        => array('5.1.0', ''),
                'CallbackFilterIterator'         => array('5.4.0-dev', ''),
                'RecursiveCallbackFilterIterator'
                                                 => array('5.4.0-dev', ''),
                'ParentIterator'                 => array('5.1.0', ''),
                'LimitIterator'                  => array('5.1.0', ''),
                'CachingIterator'                => array('5.0.0', ''),
                'RecursiveCachingIterator'       => array('5.1.0', ''),
                'NoRewindIterator'               => array('5.1.0', ''),
                'AppendIterator'                 => array('5.1.0', ''),
                'InfiniteIterator'               => array('5.1.0', ''),
                'RegexIterator'                  => array('5.2.0', ''),
                'RecursiveRegexIterator'         => array('5.2.0', ''),
                'EmptyIterator'                  => array('5.1.0', ''),
                'RecursiveTreeIterator'          => array('5.3.0', ''),
                'ArrayObject'                    => array('5.0.0', ''),
                'ArrayIterator'                  => array('5.0.0', ''),
                'RecursiveArrayIterator'         => array('5.1.0', ''),
                'SplFileInfo'                    => array('5.1.2', ''),
                'DirectoryIterator'              => array('5.0.0', ''),
                'FilesystemIterator'             => array('5.3.0', ''),
                'RecursiveDirectoryIterator'     => array('5.1.2', ''),
                'GlobIterator'                   => array('5.3.0', ''),
                'SplFileObject'                  => array('5.1.0', ''),
                'SplTempFileObject'              => array('5.1.2', ''),
                'SplDoublyLinkedList'            => array('5.3.0', ''),
                'SplQueue'                       => array('5.3.0', ''),
                'SplStack'                       => array('5.3.0', ''),
                'SplHeap'                        => array('5.3.0', ''),
                'SplMinHeap'                     => array('5.3.0', ''),
                'SplMaxHeap'                     => array('5.3.0', ''),
                'SplPriorityQueue'               => array('5.3.0', ''),
                'SplFixedArray'                  => array('5.3.0', ''),
                'SplObjectStorage'               => array('5.1.0', ''),
                'MultipleIterator'               => array('5.3.0', ''),
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.spl.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'spl_classes'                    => array('5.0.0', ''),
                'spl_autoload'                   => array('5.1.2', ''),
                'spl_autoload_extensions'        => array('5.1.2', ''),
                'spl_autoload_register'          => array('5.1.2', ''),
                'spl_autoload_unregister'        => array('5.1.2', ''),
                'spl_autoload_functions'         => array('5.1.2', ''),
                'spl_autoload_call'              => array('5.1.2', ''),
                'class_parents'                  => array('5.1.0', ''),
                'class_uses'                     => array('5.4.0-dev', ''),
                'class_implements'               => array('5.1.0', ''),
                'spl_object_hash'                => array('5.2.0', ''),
                'iterator_to_array'              => array('5.1.0', ''),
                'iterator_count'                 => array('5.1.0', ''),
                'iterator_apply'                 => array('5.1.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
