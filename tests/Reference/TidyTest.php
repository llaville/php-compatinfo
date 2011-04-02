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
class PHP_CompatInfo_Reference_TidyTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Tidy::getExtensions
     * @covers PHP_CompatInfo_Reference_Tidy::getFunctions
     * @covers PHP_CompatInfo_Reference_Tidy::getConstants
     * @covers PHP_CompatInfo_Reference_Tidy::getClasses
     */
    protected function setUp()
    {

        $this->obj = new PHP_CompatInfo_Reference_Tidy();
        parent::setUp();
    }
}
