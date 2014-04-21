<?php
/**
 * Unit tests for PHP_CompatInfo, ssh2 extension Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.0.0
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;
use Bartlett\CompatInfo\Reference\Extension\Ssh2Extension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about ssh2 extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class Ssh2ExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalfunctions = array(
            // Requires PHP_SSH2_REMOTE_FORWARDING
            'ssh2_forward_accept',
            'ssh2_forward_listen',
            // Requires PHP_SSH2_POLL
            'ssh2_poll',
            // Requires libssh >= 1.2.3
            'ssh2_auth_agent',
        );
        self::$optionalconstants = array(
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

        self::$obj = new Ssh2Extension();
        parent::setUpBeforeClass();
    }
}
