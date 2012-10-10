<?php
/**
 * Version informations about Reflection extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about Reflection extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.reflection.php
 */
class PHP_CompatInfo_Reference_Reflection
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'Reflection';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

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
     */
    public function getInterfaces($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $interfaces = array();

        $release = false;
        $items = array(
            'Reflector'                      => array('5.0.0', ''),
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
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = false;
        $items = array(
            'ReflectionException'            => array('5.0.0', ''),
            'Reflection'                     => array('5.0.0', ''),
            'ReflectionFunctionAbstract'     => array('5.0.0', ''),
            'ReflectionFunction'             => array('5.0.0', ''),
            'ReflectionParameter'            => array('5.0.0', ''),
            'ReflectionMethod'               => array('5.0.0', ''),
            'ReflectionClass'                => array('5.0.0', ''),
            'ReflectionObject'               => array('5.0.0', ''),
            'ReflectionProperty'             => array('5.0.0', ''),
            'ReflectionExtension'            => array('5.0.0', ''),
            'ReflectionZendExtension'        => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

}
