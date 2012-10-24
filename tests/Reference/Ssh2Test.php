<?php
/**
 * Unit tests for PHP_CompatInfo package, Ssh2 Reference
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
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Ssh2 extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_Ssh2Test
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Ssh2::getExtensions
     * @covers PHP_CompatInfo_Reference_Ssh2::getFunctions
     * @return void
     */
    protected function setUp()
    {
        $this->optionnalfunctions = array(
            // Requires PHP_SSH2_REMOTE_FORWARDING
            'ssh2_forward_accept',
            'ssh2_forward_listen',
            // Requires PHP_SSH2_POLL
            'ssh2_poll',
            // Requires libssh >= 1.2.3
            'ssh2_auth_agent',
        );
        $this->optionnalconstants = array(
            // Requires PHP_SSH2_POLL
            'SSH2_POLLIN',
            'SSH2_POLLEXT',
            'SSH2_POLLOUT',
            'SSH2_POLLERR',
            'SSH2_POLLHUP',
            'SSH2_POLLNVAL',
            'SSH2_POLL_SESSION_CLOSED',
            'SSH2_POLL_CHANNEL_CLOSED',
            'SSH2_POLL_LISTENER_CLOSED',
        );
        $this->obj = new PHP_CompatInfo_Reference_Ssh2();
        parent::setUp();
    }
}
