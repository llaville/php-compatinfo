<?php
/**
 * Version informations about session extension
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
 * All interfaces, classes, functions, constants about session extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.session.php
 */
class PHP_CompatInfo_Reference_Session
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'session';

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
        $phpMin = '4.0.0';
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
            'SessionHandlerInterface'        => array('5.4.0', ''),
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
            'SessionHandler'                 => array('5.4.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.session.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'session_cache_expire'           => array('4.2.0', ''),
            'session_cache_limiter'          => array('4.0.3', ''),
            'session_commit'                 => array('4.4.0', ''),
            'session_decode'                 => array('4.0.0', ''),
            'session_destroy'                => array('4.0.0', ''),
            'session_encode'                 => array('4.0.0', ''),
            'session_get_cookie_params'      => array('4.0.0', ''),
            'session_id'                     => array('4.0.0', ''),
            'session_is_registered'          => array('4.0.0', '5.3.16'),
            'session_module_name'            => array('4.0.0', ''),
            'session_name'                   => array('4.0.0', ''),
            'session_regenerate_id'          => array('4.3.2', '', '5.1.0'),
            'session_register'               => array('4.0.0', '5.3.16'),
            'session_register_shutdown'      => array('5.4.0', ''),
            'session_save_path'              => array('4.0.0', ''),
            'session_set_cookie_params'      => array('4.0.0', ''),
            'session_set_save_handler'       => array('4.0.0', ''),
            'session_start'                  => array('4.0.0', ''),
            'session_status'                 => array('5.4.0', ''),
            'session_unregister'             => array('4.0.0', '5.3.16'),
            'session_unset'                  => array('4.0.0', ''),
            'session_write_close'            => array('4.0.4', ''),
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
     * @link   http://www.php.net/manual/en/session.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'PHP_SESSION_ACTIVE'             => array('5.4.0', ''),
            'PHP_SESSION_DISABLED'           => array('5.4.0', ''),
            'PHP_SESSION_NONE'               => array('5.4.0', ''),
            'SID'                            => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
