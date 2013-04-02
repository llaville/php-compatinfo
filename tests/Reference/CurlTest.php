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
                    'CURLINFO_PRIMARY_PORT',
                    'CURLOPT_FNMATCH_FUNCTION',
                    'CURLOPT_WILDCARDMATCH',
                    'CURLPROTO_RTMP',
                    'CURLPROTO_RTMPE',
                    'CURLPROTO_RTMPS',
                    'CURLPROTO_RTMPT',
                    'CURLPROTO_RTMPTE',
                    'CURLPROTO_RTMPTS',
                    'CURL_FNMATCHFUNC_FAIL',
                    'CURL_FNMATCHFUNC_MATCH',
                    'CURL_FNMATCHFUNC_NOMATCH'
                );
            }
            if ($ver<0x071502) { /* Available since 7.21.2 */
                array_push(
                    $this->optionalconstants,
                        'CURLPROTO_GOPHER'
                );
            }
            if ($ver<0x071503) { /* Available since 7.21.3 */
                array_push(
                    $this->optionalconstants,
                        'CURLAUTH_ONLY',
                        'CURLOPT_RESOLVE'
                );
            }
            if ($ver<0x071504) { /* Available since 7.21.4 */
                array_push(
                    $this->optionalconstants,
                        'CURLOPT_TLSAUTH_PASSWORD',
                        'CURLOPT_TLSAUTH_TYPE',
                        'CURLOPT_TLSAUTH_USERNAME',
                        'CURL_TLSAUTH_SRP'
                );
            }
            if ($ver<0x071506) { /* Available since 7.21.6 */
                array_push(
                    $this->optionalconstants,
                        'CURLOPT_ACCEPT_ENCODING',
                        'CURLOPT_TRANSFER_ENCODING'
                );
            }
            if ($ver<0x071600) { /* Available since 7.22.0 */
                array_push(
                    $this->optionalconstants,
                        'CURLGSSAPI_DELEGATION_FLAG',
                        'CURLGSSAPI_DELEGATION_POLICY_FLAG',
                        'CURLOPT_GSSAPI_DELEGATION'
                );
            }
            if ($ver<0x071800) { /* Available since 7.24.0 */
                array_push(
                    $this->optionalconstants,
                        'CURLOPT_ACCEPTTIMEOUT_MS',
                        'CURLOPT_DNS_SERVERS'
                );
            }
            if ($ver<0x071900) { /* Available since 7.25.0 */
                array_push(
                    $this->optionalconstants,
                        'CURLOPT_MAIL_AUTH',
                        'CURLOPT_SSL_OPTIONS',
                        'CURLOPT_TCP_KEEPALIVE',
                        'CURLOPT_TCP_KEEPIDLE',
                        'CURLOPT_TCP_KEEPINTVL',
                        'CURLSSLOPT_ALLOW_BEAST'
                );
            }
        }
        $this->obj = new PHP_CompatInfo_Reference_Curl();
        parent::setUp();
    }
}
