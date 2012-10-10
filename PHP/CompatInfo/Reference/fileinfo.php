<?php
/**
 * Version informations about fileinfo extension
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
 * All interfaces, classes, functions, constants about fileinfo extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.fileinfo.php
 */
class PHP_CompatInfo_Reference_Fileinfo
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'fileinfo';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0.5';

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
        $phpMin = '4.0.0';
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

        $release = '0.1.0';       // 2004-02-13
        $items = array(
            'finfo'                   => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.fileinfo.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.1.0';       // 2004-02-13
        $items = array(
            'finfo_buffer'            => array('4.0.0', ''),
            'finfo_close'             => array('4.0.0', ''),
            'finfo_file'              => array('4.0.0', ''),
            'finfo_open'              => array('4.0.0', ''),
            'finfo_set_flags'         => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        /*
            Since 1.0.5 enables by default in PHP 5.3.0
         */
        $release = '1.0.5';       // 2009-06-30 (PHP 5.3.0)
        $items = array(
            'mime_content_type'       => array('5.3.0', ''),
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
     * @link   http://www.php.net/manual/en/fileinfo.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.1.0';       // 2004-02-13
        $items = array(
            'FILEINFO_COMPRESS'         => array('4.0.0', '5.2.17'),
            'FILEINFO_CONTINUE'         => array('4.0.0', ''),
            'FILEINFO_DEVICES'          => array('4.0.0', ''),
            'FILEINFO_MIME'             => array('4.0.0', ''),
            'FILEINFO_NONE'             => array('4.0.0', ''),
            'FILEINFO_PRESERVE_ATIME'   => array('4.0.0', ''),
            'FILEINFO_RAW'              => array('4.0.0', ''),
            'FILEINFO_SYMLINK'          => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.0.5';       // 2009-06-30 (PHP 5.3.0)
        $items = array(
            'FILEINFO_MIME_ENCODING'    => array('5.3.0', ''),
            'FILEINFO_MIME_TYPE'        => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
