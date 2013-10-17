<?php
/**
 * Version informations about imagick extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about imagick extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.imagick.php
 */
class PHP_CompatInfo_Reference_Imagick
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'imagick';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.1.2';  // 2013-09-25 (stable)

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
        $phpMin = '5.1.3';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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

        $release = '2.0.0a1';       // 2007-05-02 - first public release
        $items = array(
            'Imagick'                       => array('5.1.3', ''),
            'ImagickException'              => array('5.1.3', ''),
            'ImagickDraw'                   => array('5.1.3', ''),
            'ImagickDrawException'          => array('5.1.3', ''),
            'ImagickPixel'                  => array('5.1.3', ''),
            'ImagickPixelException'         => array('5.1.3', ''),
            'ImagickPixelIterator'          => array('5.1.3', ''),
            'ImagickPixelIteratorException' => array('5.1.3', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }
}
