<?php
/**
 * Unit tests for PHP_CompatInfo, amqp extension Reference
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
 * @since      Class available since Release 3.0.0RC1
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about amqp extension
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
class AmqpExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (PATH_SEPARATOR == ';') {
            // Win*
            // only available since version 1.0.8
            array_push(self::$ignoredconstants, 'AMQP_OS_SOCKET_TIMEOUT_ERRNO');
            // only available since version 1.0.0
            array_push(self::$ignoredclasses, 'AMQPChannel', 'AMQPChannelException', 'AMQPEnvelope');
        } else {
            // *nix
        }
        self::$ext = 'Amqp';
        parent::setUpBeforeClass();
    }
}
