<?php
/**
 * Unit tests for PHP_CompatInfo package, Session Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Session extension
 */
class PHP_CompatInfo_Reference_SessionTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Session::getExtensions
     * @covers PHP_CompatInfo_Reference_Session::getFunctions
     * @covers PHP_CompatInfo_Reference_Session::getConstants
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
            // Only defined after session_start
            'SID',
        );
        $this->obj = new PHP_CompatInfo_Reference_Session();
        parent::setUp();
    }

    public function testgetConstantsFromExtension() {
        if (version_compare(PHP_VERSION,'5.2.9') <= 0) {
            // Most functions have move to 'standard' in 5.2.10
            $this->markTestSkipped(
              "Can't be tested in php " . PHP_VERSION
            );
        } else {
            parent::testgetConstantsFromExtension();
        }
    }
}
