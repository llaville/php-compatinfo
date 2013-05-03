<?php
/**
 * Version informations about libevent extension
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
 * All interfaces, classes, functions, constants about libevent extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.libevent.php
 * @since    Class available since Release 2.16.0
 */
class PHP_CompatInfo_Reference_libevent
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'libevent';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.0.5';

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
        $phpMin = '5.3.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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
     * @link   http://www.php.net/manual/en/ref.libevent.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.0.2';       // 2009-08-29
        $items = array(
            'event_add'                             => array('5.3.0', ''),
            'event_base_free'                       => array('5.3.0', ''),
            'event_base_loop'                       => array('5.3.0', ''),
            'event_base_loopbreak'                  => array('5.3.0', ''),
            'event_base_loopexit'                   => array('5.3.0', ''),
            'event_base_new'                        => array('5.3.0', ''),
            'event_base_priority_init'              => array('5.3.0', ''),
            'event_base_set'                        => array('5.3.0', ''),
            'event_buffer_base_set'                 => array('5.3.0', ''),
            'event_buffer_disable'                  => array('5.3.0', ''),
            'event_buffer_enable'                   => array('5.3.0', ''),
            'event_buffer_fd_set'                   => array('5.3.0', ''),
            'event_buffer_free'                     => array('5.3.0', ''),
            'event_buffer_new'                      => array('5.3.0', ''),
            'event_buffer_priority_set'             => array('5.3.0', ''),
            'event_buffer_read'                     => array('5.3.0', ''),
            'event_buffer_timeout_set'              => array('5.3.0', ''),
            'event_buffer_watermark_set'            => array('5.3.0', ''),
            'event_buffer_write'                    => array('5.3.0', ''),
            'event_del'                             => array('5.3.0', ''),
            'event_free'                            => array('5.3.0', ''),
            'event_new'                             => array('5.3.0', ''),
            'event_set'                             => array('5.3.0', ''),
            'event_timer_add'                       => array('5.3.0', ''),
            'event_timer_del'                       => array('5.3.0', ''),
            'event_timer_new'                       => array('5.3.0', ''),
            'event_timer_pending'                   => array('5.3.0', ''),
            'event_timer_set'                       => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.0.4';       // 2010-06-23
        $items = array(
            'event_buffer_set_callback'             => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.0.5';       // 2012-04-02
        $items = array(
            'event_priority_set'                    => array('5.3.0', ''),
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
     * @link   http://www.php.net/manual/en/libevent.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.0.2';       // 2009-08-29
        $items = array(
            'EVLOOP_NONBLOCK'                       => array('5.3.0', ''),
            'EVLOOP_ONCE'                           => array('5.3.0', ''),
            'EV_PERSIST'                            => array('5.3.0', ''),
            'EV_READ'                               => array('5.3.0', ''),
            'EV_SIGNAL'                             => array('5.3.0', ''),
            'EV_TIMEOUT'                            => array('5.3.0', ''),
            'EV_WRITE'                              => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.0.4';       // 2010-06-23
        $items = array(
            'EVBUFFER_EOF'                          => array('5.3.0', ''),
            'EVBUFFER_ERROR'                        => array('5.3.0', ''),
            'EVBUFFER_READ'                         => array('5.3.0', ''),
            'EVBUFFER_TIMEOUT'                      => array('5.3.0', ''),
            'EVBUFFER_WRITE'                        => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
