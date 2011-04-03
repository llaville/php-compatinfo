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
 * @since      Class available since Release 2.0.0RC4
 */
class PHP_CompatInfo_Reference_CurlTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Curl::getExtensions
     * @covers PHP_CompatInfo_Reference_Curl::getFunctions
     * @covers PHP_CompatInfo_Reference_Curl::getConstants
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
            'CURLOPT_MUTE',
            'CURLOPT_PASSWDFUNCTION',
            // requires libcurl >= 0x071002
            'CURLOPT_CONNECTTIMEOUT_MS',
            'CURLOPT_TIMEOUT_MS',
            // requires libcurl >= 0x071304
            'CURLOPT_REDIR_PROTOCOLS',
            'CURLOPT_PROTOCOLS',
            'CURLPROTO_HTTP',
            'CURLPROTO_HTTPS',
            'CURLPROTO_FTP',
            'CURLPROTO_FTPS',
            'CURLPROTO_SCP',
            'CURLPROTO_SFTP',
            'CURLPROTO_TELNET',
            'CURLPROTO_LDAP',
            'CURLPROTO_LDAPS',
            'CURLPROTO_DICT',
            'CURLPROTO_FILE',
            'CURLPROTO_TFTP',
            'CURLPROTO_ALL',
        );
        $this->obj = new PHP_CompatInfo_Reference_Curl();
        parent::setUp();
    }
}
