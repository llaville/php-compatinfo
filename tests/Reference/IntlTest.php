<?php
/**
 * Unit tests for PHP_CompatInfo package, Intl Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Intl extension
 */
class PHP_CompatInfo_Reference_IntlTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Intl::getExtensions
     * @covers PHP_CompatInfo_Reference_Intl::getFunctions
     * @covers PHP_CompatInfo_Reference_Intl::getConstants
     * @covers PHP_CompatInfo_Reference_Intl::getClasses
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
            // requires libicu >= 3.8
            'U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR',
        );
        $this->obj = new PHP_CompatInfo_Reference_Intl();
        parent::setUp();
    }
}
