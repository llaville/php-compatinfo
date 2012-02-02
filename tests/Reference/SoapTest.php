<?php
/**
 * Unit tests for PHP_CompatInfo package, Soap Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Soap extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_SoapTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Soap::getExtensions
     * @covers PHP_CompatInfo_Reference_Soap::getFunctions
     * @covers PHP_CompatInfo_Reference_Soap::getConstants
     * @covers PHP_CompatInfo_Reference_Soap::getClasses
     * @return void
     */
    protected function setUp()
    {
        $this->ignoredfunctions = array(
            // Found in php < 5.1.6, nothing in doc
            'soap_encode_to_xml',
            'soap_encode_to_zval',
        );
        $this->obj = new PHP_CompatInfo_Reference_Soap();
        parent::setUp();
    }
}
