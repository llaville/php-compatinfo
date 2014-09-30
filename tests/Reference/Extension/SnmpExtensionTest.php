<?php
/**
 * Unit tests for PHP_CompatInfo, snmp extension Reference
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
use Bartlett\CompatInfo\Reference\Extension\SnmpExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about snmp extension
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
class SnmpExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (PATH_SEPARATOR == ';') {
            // Win32 only
            self::$optionalconstants = array(
                'SNMP_OID_OUTPUT_FULL',
                'SNMP_OID_OUTPUT_NUMERIC',
            );
            self::$optionalfunctions = array(
                'snmp_set_enum_print',
                'snmp_set_oid_output_format',
                'snmp_set_oid_numeric_print',
            );
        }

        self::$obj = new SnmpExtension();
        parent::setUpBeforeClass();
    }
}
