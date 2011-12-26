<?php
/**
 * Unit tests for PHP_CompatInfo package, Ftp Reference
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
 * about Ftp extension
 */
class PHP_CompatInfo_Reference_FtpTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Ftp::getExtensions
     * @covers PHP_CompatInfo_Reference_Ftp::getFunctions
     * @covers PHP_CompatInfo_Reference_Ftp::getConstants
     */
    protected function setUp()
    {
        $this->optionnalfunctions = array(
            // This requires HAVE_OPENSSL_EXT
            'ftp_ssl_connect',
        );
        $this->obj = new PHP_CompatInfo_Reference_Ftp();
        parent::setUp();
    }
}
