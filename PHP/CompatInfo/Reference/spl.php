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
class PHP_CompatInfo_Reference_SPL
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'SPL';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.2';

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        $phpMin = '5.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/spl.interfaces.php
     */
    public function getInterfaces($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $interfaces = array();

        $release = false;
        $items = array(
            'ArrayAccess'                    => array('5.1.0', ''),
            'Countable'                      => array('5.1.0', ''),
            'Iterator'                       => array('5.1.0', ''),
            'IteratorAggregate'              => array('5.1.0', ''),
            'OuterIterator'                  => array('5.1.0', ''),
            'RecursiveIterator'              => array('5.1.0', ''),
            'SeekableIterator'               => array('5.1.0', ''),
            'Serializable'                   => array('5.1.0', ''),
            'SplObserver'                    => array('5.1.0', ''),
            'SplSubject'                     => array('5.1.0', ''),
            'Traversable'                    => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $interfaces);

        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/spl.datastructures.php
     * @link   http://www.php.net/manual/en/spl.iterators.php
     * @link   http://www.php.net/manual/en/spl.exceptions.php
     * @link   http://www.php.net/manual/en/spl.files.php
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $classes = array();

        $release = false;
        $items = array(
            'AppendIterator'                    => array('5.1.0', ''),
            'ArrayIterator'                     => array('5.0.0', ''),
            'ArrayObject'                       => array('5.0.0', ''),
            'BadFunctionCallException'          => array('5.1.0', ''),
            'BadMethodCallException'            => array('5.1.0', ''),
            'CachingIterator'                   => array('5.0.0', ''),
            'CallbackFilterIterator'            => array('5.4.0', ''),
            'DirectoryIterator'                 => array('5.0.0', ''),
            'DomainException'                   => array('5.1.0', ''),
            'EmptyIterator'                     => array('5.1.0', ''),
            'ErrorException'                    => array('5.1.0', ''),
            'Exception'                         => array('5.1.0', ''),
            'FilesystemIterator'                => array('5.3.0', ''),
            'FilterIterator'                    => array('5.1.0', ''),
            'GlobIterator'                      => array('5.3.0', ''),
            'InfiniteIterator'                  => array('5.1.0', ''),
            'InvalidArgumentException'          => array('5.1.0', ''),
            'IteratorIterator'                  => array('5.1.0', ''),
            'LengthException'                   => array('5.1.0', ''),
            'LimitIterator'                     => array('5.1.0', ''),
            'LogicException'                    => array('5.1.0', ''),
            'MultipleIterator'                  => array('5.3.0', ''),
            'NoRewindIterator'                  => array('5.1.0', ''),
            'OutOfBoundsException'              => array('5.1.0', ''),
            'OutOfRangeException'               => array('5.1.0', ''),
            'OverflowException'                 => array('5.1.0', ''),
            'ParentIterator'                    => array('5.1.0', ''),
            'RangeException'                    => array('5.1.0', ''),
            'RecursiveArrayIterator'            => array('5.1.0', ''),
            'RecursiveCachingIterator'          => array('5.1.0', ''),
            'RecursiveCallbackFilterIterator'   => array('5.4.0', ''),
            'RecursiveDirectoryIterator'        => array('5.1.2', ''),
            'RecursiveFilterIterator'           => array('5.1.0', ''),
            'RecursiveIteratorIterator'         => array('5.1.3', ''),
            'RecursiveRegexIterator'            => array('5.2.0', ''),
            'RecursiveTreeIterator'             => array('5.3.0', ''),
            'RegexIterator'                     => array('5.2.0', ''),
            'RuntimeException'                  => array('5.1.0', ''),
            'SplDoublyLinkedList'               => array('5.3.0', ''),
            'SplFileInfo'                       => array('5.1.2', ''),
            'SplFileObject'                     => array('5.1.0', ''),
            'SplFixedArray'                     => array('5.3.0', ''),
            'SplHeap'                           => array('5.3.0', ''),
            'SplMaxHeap'                        => array('5.3.0', ''),
            'SplMinHeap'                        => array('5.3.0', ''),
            'SplObjectStorage'                  => array('5.1.0', ''),
            'SplPriorityQueue'                  => array('5.3.0', ''),
            'SplQueue'                          => array('5.3.0', ''),
            'SplStack'                          => array('5.3.0', ''),
            'SplTempFileObject'                 => array('5.1.2', ''),
            'UnderflowException'                => array('5.1.0', ''),
            'UnexpectedValueException'          => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.spl.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'class_implements'               => array('5.1.0', ''),
            'class_parents'                  => array('5.1.0', ''),
            'class_uses'                     => array('5.4.0', ''),
            'iterator_apply'                 => array('5.1.0', ''),
            'iterator_count'                 => array('5.1.0', ''),
            'iterator_to_array'              => array('5.1.0', ''),
            'spl_autoload'                   => array('5.1.2', ''),
            'spl_autoload_call'              => array('5.1.2', ''),
            'spl_autoload_extensions'        => array('5.1.2', ''),
            'spl_autoload_functions'         => array('5.1.2', ''),
            'spl_autoload_register'          => array('5.1.2', ''),
            'spl_autoload_unregister'        => array('5.1.2', ''),
            'spl_classes'                    => array('5.0.0', ''),
            'spl_object_hash'                => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
