<?php
/**
 * Version informations about rar extension
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
 * All interfaces, classes, functions, constants about rar extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.rar.php
 * @since    Class available since Release 2.23.0
 */
class PHP_CompatInfo_Reference_Rar
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'rar';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.0.1';

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
        $phpMin = '5.2.0';
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

        $release = '2.0.0b2';     // 2009-12-08 (beta)
        $items = array(
            'RarArchive'                            => array('5.2.0', ''),
            'RarEntry'                              => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '2.0.0RC1';    // 2010-01-17 (beta)
        $items = array(
            'RarException'                          => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.rar.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '2.0.0b2';     // 2009-12-08 (beta)
        $items = array(
            'rar_close'                             => array('5.2.0', ''),
            'rar_comment_get'                       => array('5.2.0', ''),
            'rar_entry_get'                         => array('5.2.0', ''),
            'rar_list'                              => array('5.2.0', ''),
            'rar_open'                              => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0RC1';    // 2010-01-17 (beta)
        $items = array(
            'rar_solid_is'                          => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.0.0';      // 2011-06-12 (stable)
        $items = array(
            'rar_allow_broken_set'                  => array('5.2.0', ''),
            'rar_broken_is'                         => array('5.2.0', ''),
            'rar_wrapper_cache_stats'               => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/rar.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '2.0.0b2';     // 2009-12-08 (beta)
        $items = array(
            'RAR_HOST_MSDOS'                        => array('5.2.0', ''),
            'RAR_HOST_OS2'                          => array('5.2.0', ''),
            'RAR_HOST_WIN32'                        => array('5.2.0', ''),
            'RAR_HOST_UNIX'                         => array('5.2.0', ''),
            'RAR_HOST_MACOS'                        => array('5.2.0', ''),
            'RAR_HOST_BEOS'                         => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
