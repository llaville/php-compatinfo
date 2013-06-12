<?php
/**
 * Unit tests for PHP_CompatInfo package, Amqp Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.8.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about amqp extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_AmqpTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Amqp::getClasses
     * @covers PHP_CompatInfo_Reference_Amqp::getConstants
     * @return void
     */
    protected function setUp()
    {
        $extversion = phpversion(PHP_CompatInfo_Reference_Amqp::REF_NAME);

        if (PATH_SEPARATOR == ';') {
            // Win*
            if ('0.1' === $extversion) {
                // only available since version 1.0.8
                array_push($this->ignoredconstants, 'AMQP_OS_SOCKET_TIMEOUT_ERRNO');
                // only available since version 1.0.0
                array_push($this->ignoredclasses, 'AMQPChannel', 'AMQPChannelException', 'AMQPEnvelope');
            }
        } else {
            // *nix
        }

        $this->obj = new PHP_CompatInfo_Reference_Amqp();
        parent::setUp();
    }
}
