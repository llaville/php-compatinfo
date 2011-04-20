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
            // requires libcurl >= 0x070f01
            'CURLFTPMETHOD_MULTICWD',
            'CURLFTPMETHOD_NOCWD',
            'CURLFTPMETHOD_SINGLECWD',
            // requires libcurl >= 0x071002
            'CURLOPT_CONNECTTIMEOUT_MS',
            'CURLOPT_TIMEOUT_MS',
            // requires libcurl >= 0x071300
            'CURLSSH_AUTH_NONE',
            'CURLSSH_AUTH_PUBLICKEY',
            'CURLSSH_AUTH_PASSWORD',
            'CURLSSH_AUTH_HOST',
            'CURLSSH_AUTH_KEYBOARD',
            'CURLSSH_AUTH_DEFAULT',
            'CURLOPT_SSH_AUTH_TYPES',
            'CURLOPT_KEYPASSWD',
            'CURLOPT_SSH_PUBLIC_KEYFILE',
            'CURLOPT_SSH_PRIVATE_KEYFILE',
            'CURLOPT_SSH_HOST_PUBLIC_KEY_MD5',
            'CURLE_SSH',
            // requires libcurl >= 0x071301
            'CURLINFO_CERTINFO',
            'CURLOPT_CERTINFO',
            'CURLOPT_POSTREDIR',
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
