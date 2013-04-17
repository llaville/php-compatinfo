<?php
/**
 * Version informations about stomp extension
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
 * All interfaces, classes, functions, constants about stomp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.stomp.php
 * @since    Class available since Release 2.16.0
 */
class PHP_CompatInfo_Reference_Stomp
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'stomp';

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
        $phpMin = '5.2.2';
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

        $release = '0.1.0';       // 2009-10-30
        $items = array(
            'Stomp'                                 => array('5.2.2', ''),
            'StompException'                        => array('5.2.2', ''),
            'StompFrame'                            => array('5.2.2', ''),
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
     * @link   http://www.php.net/manual/en/ref.stomp.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.1.0';       // 2009-10-30
        $items = array(
            'stomp_abort'                           => array('5.2.2', ''),
            'stomp_ack'                             => array('5.2.2', ''),
            'stomp_begin'                           => array('5.2.2', ''),
            'stomp_close'                           => array('5.2.2', ''),
            'stomp_commit'                          => array('5.2.2', ''),
            'stomp_connect'                         => array('5.2.2', ''),
            'stomp_error'                           => array('5.2.2', ''),
            'stomp_get_read_timeout'                => array('5.2.2', ''),
            'stomp_get_session_id'                  => array('5.2.2', ''),
            'stomp_has_frame'                       => array('5.2.2', ''),
            'stomp_read_frame'                      => array('5.2.2', ''),
            'stomp_send'                            => array('5.2.2', ''),
            'stomp_set_read_timeout'                => array('5.2.2', ''),
            'stomp_subscribe'                       => array('5.2.2', ''),
            'stomp_unsubscribe'                     => array('5.2.2', ''),
            'stomp_version'                         => array('5.2.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.3.0';       // 2009-11-06
        $items = array(
            'stomp_connect_error'                   => array('5.2.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
