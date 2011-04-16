<?php
/**
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */
class PHP_CompatInfo_Reference_Ssh2Test extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Ssh2::getExtensions
     * @covers PHP_CompatInfo_Reference_Ssh2::getFunctions
     */
    protected function setUp()
    {
        $this->optionnalfunctions = array(
            // Requires PHP_SSH2_REMOTE_FORWARDING
            'ssh2_forward_accept',
            'ssh2_forward_listen',
            // Requires PHP_SSH2_POLL
            'ssh2_poll',
        );
        $this->obj = new PHP_CompatInfo_Reference_Ssh2();
        parent::setUp();
    }
}
