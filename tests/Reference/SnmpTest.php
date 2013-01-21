<?php
/**
 * Unit tests for PHP_CompatInfo package, Snmp Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Snmp extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_SnmpTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Snmp::getExtensions
     * @covers PHP_CompatInfo_Reference_Snmp::getFunctions
     * @covers PHP_CompatInfo_Reference_Snmp::getConstants
     * @return void
     */
    protected function setUp()
    {
        if (DIRECTORY_SEPARATOR == '\\') {
            // Win32 only
            $this->optionalconstants = array(
                'SNMP_OID_OUTPUT_FULL',
                'SNMP_OID_OUTPUT_NUMERIC',
            );
            $this->optionalfunctions = array(
                'snmp_set_enum_print',
                'snmp_set_oid_output_format',
                'snmp_set_oid_numeric_print',
            );
        }

        $this->obj = new PHP_CompatInfo_Reference_Snmp();
        parent::setUp();
    }
}
