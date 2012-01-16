<?php
/**
 * Unit tests for PHP_CompatInfo package, Ldap Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.2.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Ldap extension
 */
class PHP_CompatInfo_Reference_LdapTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Ldap::getExtensions
     * @covers PHP_CompatInfo_Reference_Ldap::getFunctions
     * @covers PHP_CompatInfo_Reference_Ldap::getConstants
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
            'LDAP_OPT_X_SASL_AUTHCID',
            'LDAP_OPT_X_SASL_AUTHZID',
            'LDAP_OPT_X_SASL_MECH',
            'LDAP_OPT_X_SASL_REALM',
        );
        $this->optionnalfunctions = array(
            // Requires LDAP SASL
            'ldap_sasl_bind',
            // Requires OpenLdap
            'ldap_set_rebind_proc',
        );
        $this->obj = new PHP_CompatInfo_Reference_Ldap();
        parent::setUp();
    }
}
