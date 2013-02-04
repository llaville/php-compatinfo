<?php
/**
 * Unit tests for PHP_CompatInfo package, Curl Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Curl extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_CurlTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Curl::getExtensions
     * @covers PHP_CompatInfo_Reference_Curl::getFunctions
     * @covers PHP_CompatInfo_Reference_Curl::getConstants
     * @covers PHP_CompatInfo_Reference_Curl::getClasses
     * @return void
     */
    protected function setUp()
    {
        $this->optionalconstants = array(
            'CURLOPT_MUTE',
            'CURLOPT_PASSWDFUNCTION',
        );
        if (function_exists('curl_version')) {
            $ver = curl_version();
            $ver = $ver['version_number'];
            if ($ver<0x071001) {
                array_push(
                    $this->optionalconstants,
                    'CURLFTPMETHOD_MULTICWD',
                    'CURLFTPMETHOD_NOCWD',
                    'CURLFTPMETHOD_SINGLECWD'
                );
            }
            if ($ver<0x071002) {
                array_push(
                    $this->optionalconstants,
                    'CURLOPT_CONNECTTIMEOUT_MS',
                    'CURLOPT_TIMEOUT_MS'
                );
            }
            if ($ver<0x071202) {
                array_push(
                    $this->optionalconstants,
                    'CURLINFO_REDIRECT_URL'
                );
            }
            if ($ver<0x071300) { // 7.19.0
                array_push(
                    $this->optionalconstants,
                    'CURLINFO_PRIMARY_IP',
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
                    'CURLE_SSH'
                );
            }
            if ($ver<0x071301) {
                array_push(
                    $this->optionalconstants,
                    'CURLINFO_CERTINFO',
                    'CURLOPT_CERTINFO',
                    'CURLOPT_POSTREDIR'
                );
            }
            if ($ver<0x071304) {
                array_push(
                    $this->optionalconstants,
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
                    'CURLPROTO_ALL'
                );
            }
            if ($ver<0x071500) { // 7.21.0
                array_push(
                    $this->optionalconstants,
                    'CURLINFO_LOCAL_IP',
                    'CURLINFO_LOCAL_PORT',
                    'CURLINFO_PRIMARY_PORT'
                );
            }
        }
        $this->obj = new PHP_CompatInfo_Reference_Curl();
        parent::setUp();
    }
}
