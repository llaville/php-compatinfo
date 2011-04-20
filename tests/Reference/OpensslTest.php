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
 * @since      Class available since Release 2.0.0RC3
 */
class PHP_CompatInfo_Reference_OpensslTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Openssl::getExtensions
     * @covers PHP_CompatInfo_Reference_Openssl::getFunctions
     * @covers PHP_CompatInfo_Reference_Openssl::getConstants
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
            // requires HAVE_OPENSSL_MD2_H
            'OPENSSL_ALGO_MD2',
            // requires OPENSSL_VERSION_NUMBER >= 0x0090806fL
            'OPENSSL_TLSEXT_SERVER_NAME',
        );
        $this->obj = new PHP_CompatInfo_Reference_Openssl();
        parent::setUp();
    }
}
