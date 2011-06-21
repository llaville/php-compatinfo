<?php
/**
 * Unit tests for PHP_CompatInfo package, Posix Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Posix extension
 */
class PHP_CompatInfo_Reference_PosixTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Posix::getExtensions
     * @covers PHP_CompatInfo_Reference_Posix::getFunctions
     * @covers PHP_CompatInfo_Reference_Posix::getConstants
     */
    protected function setUp()
    {
        $this->obj = new PHP_CompatInfo_Reference_Posix();
        parent::setUp();
    }
}
