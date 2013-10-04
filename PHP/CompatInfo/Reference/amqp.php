<?php
/**
 * Version informations about amqp extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about amqp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.amqp.php
 * @since    Class available since Release 2.8.0
 */
class PHP_CompatInfo_Reference_Amqp
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'amqp';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.2.0';  // 2013-05-28 (stable)

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
        // php >= 5.2.0 documented since 1.0.4, but already required by previous
        $extensions = array(
            self::REF_NAME => array('5.2.0', '', self::REF_VERSION)
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
     * @link   http://www.php.net/manual/en/class.amqpconnection.php
     * @link   http://www.php.net/manual/en/class.amqpchannel.php
     * @link   http://www.php.net/manual/en/class.amqpexchange.php
     * @link   http://www.php.net/manual/en/class.amqpqueue.php
     * @link   http://www.php.net/manual/en/class.amqpenvelope.php
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '0.1.0';       // 2010-06-19 (beta)
        $items = array(
            'AMQPConnection'                => array('5.2.0', ''),
            'AMQPConnectionException'       => array('5.2.0', ''),
            'AMQPException'                 => array('5.2.0', ''),
            'AMQPExchange'                  => array('5.2.0', ''),
            'AMQPExchangeException'         => array('5.2.0', ''),
            'AMQPQueue'                     => array('5.2.0', ''),
            'AMQPQueueException'            => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.0.0';       // 2012-02-15 (stable)
        $items = array(
            'AMQPChannel'                   => array('5.2.0', ''),
            'AMQPChannelException'          => array('5.2.0', ''),
            'AMQPEnvelope'                  => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
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
     * @link   http://www.php.net/manual/en/amqp.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.1.0';       // 2008-12-12 (beta)
        $items = array(
            'AMQP_AUTOACK'                            => array('5.2.0', ''),
            'AMQP_AUTODELETE'                         => array('5.2.0', ''),
            'AMQP_DURABLE'                            => array('5.2.0', ''),
            'AMQP_EXCLUSIVE'                          => array('5.2.0', ''),
            'AMQP_EX_TYPE_DIRECT'                     => array('5.2.0', ''),
            'AMQP_EX_TYPE_FANOUT'                     => array('5.2.0', ''),
            'AMQP_EX_TYPE_HEADERS'                    => array('5.2.0', ''),
            'AMQP_EX_TYPE_TOPIC'                      => array('5.2.0', ''),
            'AMQP_IFEMPTY'                            => array('5.2.0', ''),
            'AMQP_IFUNUSED'                           => array('5.2.0', ''),
            'AMQP_IMMEDIATE'                          => array('5.2.0', ''),
            'AMQP_INTERNAL'                           => array('5.2.0', ''),
            'AMQP_MANDATORY'                          => array('5.2.0', ''),
            'AMQP_MULTIPLE'                           => array('5.2.0', ''),
            'AMQP_NOLOCAL'                            => array('5.2.0', ''),
            'AMQP_NOPARAM'                            => array('5.2.0', ''),
            'AMQP_NOWAIT'                             => array('5.2.0', ''),
            'AMQP_PASSIVE'                            => array('5.2.0', ''),
            'AMQP_REQUEUE'                            => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.0.8';       // 2012-11-12 (stable)
        $items = array(
            'AMQP_OS_SOCKET_TIMEOUT_ERRNO'            => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
