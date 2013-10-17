<?php
/**
 * Version informations about haru extension
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
 * All interfaces, classes, functions, constants about haru extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.haru.php
 * @since    Class available since Release 2.16.0
 */
class PHP_CompatInfo_Reference_Haru
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'haru';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0.4';  // 2012-12-23 (stable)

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

        $release = '0.0.1';       // 2007-03-26 (beta)
        $items = array(
            // @link http://www.php.net/manual/en/class.haruexception.php        
            'HaruException'                         => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.harudoc.php
            'HaruDoc'                               => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.harupage.php
            'HaruPage'                              => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.harufont.php
            'HaruFont'                              => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.haruimage.php
            'HaruImage'                             => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.harudestination.php
            'HaruDestination'                       => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.haruannotation.php
            'HaruAnnotation'                        => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.haruencoder.php
            'HaruEncoder'                           => array('5.1.3', ''),
            // @link http://www.php.net/manual/en/class.haruoutline.php
            'HaruOutline'                           => array('5.1.3', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

}
