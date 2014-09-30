<?php
/**
 * Unit tests for PHP_CompatInfo, ldap extension Reference
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
use Bartlett\CompatInfo\Reference\Extension\LdapExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about ldap extension
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
class LdapExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
            'LDAP_OPT_X_SASL_AUTHCID',
            'LDAP_OPT_X_SASL_AUTHZID',
            'LDAP_OPT_X_SASL_MECH',
            'LDAP_OPT_X_SASL_REALM',
        );
        self::$optionalfunctions = array(
            // Requires LDAP SASL
            'ldap_sasl_bind',
            // Requires OpenLdap
            'ldap_set_rebind_proc',
        );

        self::$obj = new LdapExtension();
        parent::setUpBeforeClass();
    }
}
