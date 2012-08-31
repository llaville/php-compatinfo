<?php
/**
 * Version informations about cURL extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about cURL extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.curl.php
 */
class PHP_CompatInfo_Reference_Curl implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'curl' => array('4.0.2', '', '')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }

        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.curl.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'curl_close'                     => array('4.0.2', ''),
                'curl_errno'                     => array('4.0.3', ''),
                'curl_error'                     => array('4.0.3', ''),
                'curl_exec'                      => array('4.0.2', ''),
                'curl_getinfo'                   => array('4.0.4', ''),
                'curl_init'                      => array('4.0.2', ''),
                'curl_setopt'                    => array('4.0.2', ''),
                'curl_version'                   => array('4.0.2', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'curl_copy_handle'               => array('5.0.0', ''),
                'curl_multi_add_handle'          => array('5.0.0', ''),
                'curl_multi_close'               => array('5.0.0', ''),
                'curl_multi_exec'                => array('5.0.0', ''),
                'curl_multi_getcontent'          => array('5.0.0', ''),
                'curl_multi_info_read'           => array('5.0.0', ''),
                'curl_multi_init'                => array('5.0.0', ''),
                'curl_multi_remove_handle'       => array('5.0.0', ''),
                'curl_multi_select'              => array('5.0.0', ''),
                'curl_setopt_array'              => array('5.1.3', ''),
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }

        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/curl.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'CURL_HTTP_VERSION_NONE'         => array('4.0.2', ''),
                'CURL_HTTP_VERSION_1_0'          => array('4.0.2', ''),
                'CURL_HTTP_VERSION_1_1'          => array('4.0.2', ''),
                'CURL_NETRC_OPTIONAL'            => array('4.0.2', ''),
                'CURL_NETRC_IGNORED'             => array('4.0.2', ''),
                'CURL_NETRC_REQUIRED'            => array('4.0.2', ''),
                'CURL_TIMECOND_IFMODSINCE'       => array('4.0.2', ''),
                'CURL_TIMECOND_IFUNMODSINCE'     => array('4.0.2', ''),
                'CURL_TIMECOND_LASTMOD'          => array('4.0.2', ''),
                'CURL_VERSION_IPV6'              => array('4.0.2', ''),
                'CURL_VERSION_KERBEROS4'         => array('4.0.2', ''),
                'CURL_VERSION_SSL'               => array('4.0.2', ''),
                'CURL_VERSION_LIBZ'              => array('4.0.2', ''),

                'CURLAUTH_ANY'                   => array('4.0.2', ''),
                'CURLAUTH_ANYSAFE'               => array('4.0.2', ''),
                'CURLAUTH_BASIC'                 => array('4.0.2', ''),
                'CURLAUTH_DIGEST'                => array('4.0.2', ''),
                'CURLAUTH_GSSNEGOTIATE'          => array('4.0.2', ''),
                'CURLAUTH_NTLM'                  => array('4.0.2', ''),

                'CURLCLOSEPOLICY_CALLBACK'       => array('4.0.2', ''),
                'CURLCLOSEPOLICY_LEAST_RECENTLY_USED'
                                                 => array('4.0.2', ''),
                'CURLCLOSEPOLICY_LEAST_TRAFFIC'  => array('4.0.2', ''),
                'CURLCLOSEPOLICY_OLDEST'         => array('4.0.2', ''),
                'CURLCLOSEPOLICY_SLOWEST'        => array('4.0.2', ''),

                'CURLE_ABORTED_BY_CALLBACK'      => array('4.0.2', ''),
                'CURLE_BAD_CALLING_ORDER'        => array('4.0.2', ''),
                'CURLE_BAD_CONTENT_ENCODING'     => array('4.0.2', ''),
                'CURLE_BAD_FUNCTION_ARGUMENT'    => array('4.0.2', ''),
                'CURLE_BAD_PASSWORD_ENTERED'     => array('4.0.2', ''),
                'CURLE_COULDNT_CONNECT'          => array('4.0.2', ''),
                'CURLE_COULDNT_RESOLVE_HOST'     => array('4.0.2', ''),
                'CURLE_COULDNT_RESOLVE_PROXY'    => array('4.0.2', ''),
                'CURLE_FAILED_INIT'              => array('4.0.2', ''),
                'CURLE_FILESIZE_EXCEEDED'        => array('4.0.2', ''),
                'CURLE_FILE_COULDNT_READ_FILE'   => array('4.0.2', ''),
                'CURLE_FTP_ACCESS_DENIED'        => array('4.0.2', ''),
                'CURLE_FTP_BAD_DOWNLOAD_RESUME'  => array('4.0.2', ''),
                'CURLE_FTP_CANT_GET_HOST'        => array('4.0.2', ''),
                'CURLE_FTP_CANT_RECONNECT'       => array('4.0.2', ''),
                'CURLE_FTP_COULDNT_GET_SIZE'     => array('4.0.2', ''),
                'CURLE_FTP_COULDNT_RETR_FILE'    => array('4.0.2', ''),
                'CURLE_FTP_COULDNT_SET_ASCII'    => array('4.0.2', ''),
                'CURLE_FTP_COULDNT_SET_BINARY'   => array('4.0.2', ''),
                'CURLE_FTP_COULDNT_STOR_FILE'    => array('4.0.2', ''),
                'CURLE_FTP_COULDNT_USE_REST'     => array('4.0.2', ''),
                'CURLE_FTP_PORT_FAILED'          => array('4.0.2', ''),
                'CURLE_FTP_QUOTE_ERROR'          => array('4.0.2', ''),
                'CURLE_FTP_SSL_FAILED'           => array('4.0.2', ''),
                'CURLE_FTP_USER_PASSWORD_INCORRECT'
                                                 => array('4.0.2', ''),
                'CURLE_FTP_WEIRD_227_FORMAT'     => array('4.0.2', ''),
                'CURLE_FTP_WEIRD_PASS_REPLY'     => array('4.0.2', ''),
                'CURLE_FTP_WEIRD_PASV_REPLY'     => array('4.0.2', ''),
                'CURLE_FTP_WEIRD_SERVER_REPLY'   => array('4.0.2', ''),
                'CURLE_FTP_WEIRD_USER_REPLY'     => array('4.0.2', ''),
                'CURLE_FTP_WRITE_ERROR'          => array('4.0.2', ''),
                'CURLE_FUNCTION_NOT_FOUND'       => array('4.0.2', ''),
                'CURLE_GOT_NOTHING'              => array('4.0.2', ''),
                'CURLE_HTTP_NOT_FOUND'           => array('4.0.2', ''),
                'CURLE_HTTP_PORT_FAILED'         => array('4.0.2', ''),
                'CURLE_HTTP_POST_ERROR'          => array('4.0.2', ''),
                'CURLE_HTTP_RANGE_ERROR'         => array('4.0.2', ''),
                'CURLE_LDAP_CANNOT_BIND'         => array('4.0.2', ''),
                'CURLE_LDAP_INVALID_URL'         => array('4.0.2', ''),
                'CURLE_LDAP_SEARCH_FAILED'       => array('4.0.2', ''),
                'CURLE_LIBRARY_NOT_FOUND'        => array('4.0.2', ''),
                'CURLE_MALFORMAT_USER'           => array('4.0.2', ''),
                'CURLE_OBSOLETE'                 => array('4.0.2', ''),
                'CURLE_OK'                       => array('4.0.2', ''),
                'CURLE_OPERATION_TIMEOUTED'      => array('4.0.2', ''),
                'CURLE_OUT_OF_MEMORY'            => array('4.0.2', ''),
                'CURLE_PARTIAL_FILE'             => array('4.0.2', ''),
                'CURLE_READ_ERROR'               => array('4.0.2', ''),
                'CURLE_RECV_ERROR'               => array('4.0.2', ''),
                'CURLE_SEND_ERROR'               => array('4.0.2', ''),
                'CURLE_SHARE_IN_USE'             => array('4.0.2', ''),
                'CURLE_SSL_CACERT'               => array('4.0.2', ''),
                'CURLE_SSL_CERTPROBLEM'          => array('4.0.2', ''),
                'CURLE_SSL_CIPHER'               => array('4.0.2', ''),
                'CURLE_SSL_CONNECT_ERROR'        => array('4.0.2', ''),
                'CURLE_SSL_ENGINE_NOTFOUND'      => array('4.0.2', ''),
                'CURLE_SSL_ENGINE_SETFAILED'     => array('4.0.2', ''),
                'CURLE_SSL_PEER_CERTIFICATE'     => array('4.0.2', ''),
                'CURLE_TELNET_OPTION_SYNTAX'     => array('4.0.2', ''),
                'CURLE_TOO_MANY_REDIRECTS'       => array('4.0.2', ''),
                'CURLE_UNKNOWN_TELNET_OPTION'    => array('4.0.2', ''),
                'CURLE_UNSUPPORTED_PROTOCOL'     => array('4.0.2', ''),
                'CURLE_URL_MALFORMAT'            => array('4.0.2', ''),
                'CURLE_URL_MALFORMAT_USER'       => array('4.0.2', ''),
                'CURLE_WRITE_ERROR'              => array('4.0.2', ''),

                'CURLFTPSSL_TRY'                 => array('4.0.2', ''),

                'CURLINFO_CONNECT_TIME'          => array('4.0.2', ''),
                'CURLINFO_CONTENT_LENGTH_DOWNLOAD'
                                                 => array('4.0.2', ''),
                'CURLINFO_CONTENT_LENGTH_UPLOAD' => array('4.0.2', ''),
                'CURLINFO_CONTENT_TYPE'          => array('4.0.2', ''),
                'CURLINFO_EFFECTIVE_URL'         => array('4.0.2', ''),
                'CURLINFO_FILETIME'              => array('4.0.2', ''),
                'CURLINFO_HEADER_SIZE'           => array('4.0.2', ''),
                'CURLINFO_HTTP_CODE'             => array('4.0.2', ''),
                'CURLINFO_NAMELOOKUP_TIME'       => array('4.0.2', ''),
                'CURLINFO_PRETRANSFER_TIME'      => array('4.0.2', ''),
                'CURLINFO_REDIRECT_COUNT'        => array('4.0.2', ''),
                'CURLINFO_REDIRECT_TIME'         => array('4.0.2', ''),
                'CURLINFO_REQUEST_SIZE'          => array('4.0.2', ''),
                'CURLINFO_SIZE_DOWNLOAD'         => array('4.0.2', ''),
                'CURLINFO_SIZE_UPLOAD'           => array('4.0.2', ''),
                'CURLINFO_SPEED_DOWNLOAD'        => array('4.0.2', ''),
                'CURLINFO_SPEED_UPLOAD'          => array('4.0.2', ''),
                'CURLINFO_SSL_VERIFYRESULT'      => array('4.0.2', ''),
                'CURLINFO_STARTTRANSFER_TIME'    => array('4.0.2', ''),
                'CURLINFO_TOTAL_TIME'            => array('4.0.2', ''),

                'CURLM_BAD_EASY_HANDLE'          => array('4.0.2', ''),
                'CURLM_BAD_HANDLE'               => array('4.0.2', ''),
                'CURLM_CALL_MULTI_PERFORM'       => array('4.0.2', ''),
                'CURLM_INTERNAL_ERROR'           => array('4.0.2', ''),
                'CURLM_OK'                       => array('4.0.2', ''),
                'CURLM_OUT_OF_MEMORY'            => array('4.0.2', ''),

                'CURLMSG_DONE'                   => array('4.0.2', ''),

                'CURLOPT_BINARYTRANSFER'         => array('4.0.2', ''),
                'CURLOPT_BUFFERSIZE'             => array('4.0.2', ''),
                'CURLOPT_CAINFO'                 => array('4.0.2', ''),
                'CURLOPT_CAPATH'                 => array('4.0.2', ''),
                'CURLOPT_CLOSEPOLICY'            => array('4.0.2', ''),
                'CURLOPT_CONNECTTIMEOUT'         => array('4.0.2', ''),
                'CURLOPT_CONNECTTIMEOUT_MS'      => array('4.0.2', ''),
                'CURLOPT_COOKIE'                 => array('4.0.2', ''),
                'CURLOPT_COOKIEFILE'             => array('4.0.2', ''),
                'CURLOPT_COOKIEJAR'              => array('4.0.2', ''),
                'CURLOPT_CRLF'                   => array('4.0.2', ''),
                'CURLOPT_CUSTOMREQUEST'          => array('4.0.2', ''),
                'CURLOPT_DNS_CACHE_TIMEOUT'      => array('4.0.2', ''),
                'CURLOPT_DNS_USE_GLOBAL_CACHE'   => array('4.0.2', ''),
                'CURLOPT_EGDSOCKET'              => array('4.0.2', ''),
                'CURLOPT_ENCODING'               => array('4.0.2', ''),
                'CURLOPT_FAILONERROR'            => array('4.0.2', ''),
                'CURLOPT_FILE'                   => array('4.0.2', ''),
                'CURLOPT_FILETIME'               => array('4.0.2', ''),
                'CURLOPT_FOLLOWLOCATION'         => array('4.0.2', ''),
                'CURLOPT_FORBID_REUSE'           => array('4.0.2', ''),
                'CURLOPT_FRESH_CONNECT'          => array('4.0.2', ''),
                'CURLOPT_FTPAPPEND'              => array('4.0.2', ''),
                'CURLOPT_FTPLISTONLY'            => array('4.0.2', ''),
                'CURLOPT_FTPPORT'                => array('4.0.2', ''),
                'CURLOPT_FTP_CREATE_MISSING_DIRS'
                                                 => array('4.0.2', ''),
                'CURLOPT_FTP_USE_EPRT'           => array('4.0.2', ''),
                'CURLOPT_FTP_USE_EPSV'           => array('4.0.2', ''),
                'CURLOPT_HEADER'                 => array('4.0.2', ''),
                'CURLOPT_HEADERFUNCTION'         => array('4.0.2', ''),
                'CURLOPT_HTTP200ALIASES'         => array('4.0.2', ''),
                'CURLOPT_HTTPAUTH'               => array('4.0.2', ''),
                'CURLOPT_HTTPGET'                => array('4.0.2', ''),
                'CURLOPT_HTTPHEADER'             => array('4.0.2', ''),
                'CURLOPT_HTTPPROXYTUNNEL'        => array('4.0.2', ''),
                'CURLOPT_HTTP_VERSION'           => array('4.0.2', ''),
                'CURLOPT_INFILE'                 => array('4.0.2', ''),
                'CURLOPT_INFILESIZE'             => array('4.0.2', ''),
                'CURLOPT_INTERFACE'              => array('4.0.2', ''),
                'CURLOPT_KRB4LEVEL'              => array('4.0.2', ''),
                'CURLOPT_LOW_SPEED_LIMIT'        => array('4.0.2', ''),
                'CURLOPT_LOW_SPEED_TIME'         => array('4.0.2', ''),
                'CURLOPT_MAXCONNECTS'            => array('4.0.2', ''),
                'CURLOPT_MAXREDIRS'              => array('4.0.2', ''),
                'CURLOPT_MUTE'                   => array('4.0.2', ''),
                'CURLOPT_NETRC'                  => array('4.0.2', ''),
                'CURLOPT_NOBODY'                 => array('4.0.2', ''),
                'CURLOPT_NOPROGRESS'             => array('4.0.2', ''),
                'CURLOPT_NOSIGNAL'               => array('4.0.2', ''),
                'CURLOPT_PASSWDFUNCTION'         => array('4.0.2', ''),
                'CURLOPT_PORT'                   => array('4.0.2', ''),
                'CURLOPT_POST'                   => array('4.0.2', ''),
                'CURLOPT_POSTFIELDS'             => array('4.0.2', ''),
                'CURLOPT_POSTQUOTE'              => array('4.0.2', ''),
                'CURLOPT_PROTOCOLS'              => array('4.0.2', ''),
                'CURLOPT_PROXY'                  => array('4.0.2', ''),
                'CURLOPT_PROXYAUTH'              => array('4.0.2', ''),
                'CURLOPT_PROXYPORT'              => array('4.0.2', ''),
                'CURLOPT_PROXYTYPE'              => array('4.0.2', ''),
                'CURLOPT_PROXYUSERPWD'           => array('4.0.2', ''),
                'CURLOPT_PUT'                    => array('4.0.2', ''),
                'CURLOPT_QUOTE'                  => array('4.0.2', ''),
                'CURLOPT_RANDOM_FILE'            => array('4.0.2', ''),
                'CURLOPT_RANGE'                  => array('4.0.2', ''),
                'CURLOPT_READDATA'               => array('4.0.2', ''),
                'CURLOPT_READFUNCTION'           => array('4.0.2', ''),
                'CURLOPT_REDIR_PROTOCOLS'        => array('4.0.2', ''),
                'CURLOPT_REFERER'                => array('4.0.2', ''),
                'CURLOPT_RESUME_FROM'            => array('4.0.2', ''),
                'CURLOPT_RETURNTRANSFER'         => array('4.0.2', ''),
                'CURLOPT_SSLCERT'                => array('4.0.2', ''),
                'CURLOPT_SSLCERTPASSWD'          => array('4.0.2', ''),
                'CURLOPT_SSLCERTTYPE'            => array('4.0.2', ''),
                'CURLOPT_SSLENGINE'              => array('4.0.2', ''),
                'CURLOPT_SSLENGINE_DEFAULT'      => array('4.0.2', ''),
                'CURLOPT_SSLKEY'                 => array('4.0.2', ''),
                'CURLOPT_SSLKEYPASSWD'           => array('4.0.2', ''),
                'CURLOPT_SSLKEYTYPE'             => array('4.0.2', ''),
                'CURLOPT_SSLVERSION'             => array('4.0.2', ''),
                'CURLOPT_SSL_CIPHER_LIST'        => array('4.0.2', ''),
                'CURLOPT_SSL_VERIFYHOST'         => array('4.0.2', ''),
                'CURLOPT_SSL_VERIFYPEER'         => array('4.0.2', ''),
                'CURLOPT_STDERR'                 => array('4.0.2', ''),
                'CURLOPT_TIMECONDITION'          => array('4.0.2', ''),
                'CURLOPT_TIMEOUT'                => array('4.0.2', ''),
                'CURLOPT_TIMEOUT_MS'             => array('4.0.2', ''),
                'CURLOPT_TIMEVALUE'              => array('4.0.2', ''),
                'CURLOPT_TRANSFERTEXT'           => array('4.0.2', ''),
                'CURLOPT_UNRESTRICTED_AUTH'      => array('4.0.2', ''),
                'CURLOPT_UPLOAD'                 => array('4.0.2', ''),
                'CURLOPT_URL'                    => array('4.0.2', ''),
                'CURLOPT_USERAGENT'              => array('4.0.2', ''),
                'CURLOPT_USERPWD'                => array('4.0.2', ''),
                'CURLOPT_VERBOSE'                => array('4.0.2', ''),
                'CURLOPT_WRITEFUNCTION'          => array('4.0.2', ''),
                'CURLOPT_WRITEHEADER'            => array('4.0.2', ''),

                'CURLPROTO_ALL'                  => array('4.0.2', ''),
                'CURLPROTO_DICT'                 => array('4.0.2', ''),
                'CURLPROTO_FILE'                 => array('4.0.2', ''),
                'CURLPROTO_FTP'                  => array('4.0.2', ''),
                'CURLPROTO_FTPS'                 => array('4.0.2', ''),
                'CURLPROTO_HTTP'                 => array('4.0.2', ''),
                'CURLPROTO_HTTPS'                => array('4.0.2', ''),
                'CURLPROTO_LDAP'                 => array('4.0.2', ''),
                'CURLPROTO_LDAPS'                => array('4.0.2', ''),
                'CURLPROTO_SCP'                  => array('4.0.2', ''),
                'CURLPROTO_SFTP'                 => array('4.0.2', ''),
                'CURLPROTO_TELNET'               => array('4.0.2', ''),
                'CURLPROTO_TFTP'                 => array('4.0.2', ''),

                'CURLPROXY_HTTP'                 => array('4.0.2', ''),
                'CURLPROXY_SOCKS5'               => array('4.0.2', ''),

                'CURLVERSION_NOW'                => array('4.0.2', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'CURL_IPRESOLVE_WHATEVER'        => array('5.3.0', ''),
                'CURL_IPRESOLVE_V4'              => array('5.3.0', ''),
                'CURL_IPRESOLVE_V6'              => array('5.3.0', ''),

                'CURLE_SSH'                      => array('5.3.0', ''),

                'CURLFTPMETHOD_MULTICWD'         => array('5.3.0', ''),
                'CURLFTPMETHOD_NOCWD'            => array('5.3.0', ''),
                'CURLFTPMETHOD_SINGLECWD'        => array('5.3.0', ''),

                'CURLINFO_CERTINFO'              => array('5.3.2', ''),
                'CURLINFO_HEADER_OUT'            => array('5.1.3', ''),
                'CURLINFO_LOCAL_IP'              => array('5.4.7-dev', ''),
                'CURLINFO_LOCAL_PORT'            => array('5.4.7-dev', ''),
                'CURLINFO_PRIMARY_IP'            => array('5.4.7-dev', ''),
                'CURLINFO_PRIMARY_PORT'          => array('5.4.7-dev', ''),
                'CURLINFO_PRIVATE'               => array('5.2.4', ''),
                'CURLINFO_REDIRECT_URL'          => array('5.3.7', ''),

                'CURLOPT_AUTOREFERER'            => array('5.1.0', ''),
                'CURLOPT_CERTINFO'               => array('5.3.2', ''),
                'CURLOPT_COOKIESESSION'          => array('5.1.0', ''),
                'CURLOPT_FTP_FILEMETHOD'         => array('5.3.0', ''),
                'CURLOPT_FTP_SKIP_PASV_IP'       => array('5.3.2', ''),
                'CURLOPT_FTP_SSL'                => array('5.2.0', ''),
                'CURLOPT_FTPSSLAUTH'             => array('5.1.0', ''),
                'CURLOPT_IPRESOLVE'              => array('5.3.0', ''),
                'CURLOPT_KEYPASSWD'              => array('5.3.0', ''),
                'CURLOPT_MAX_RECV_SPEED_LARGE'   => array('5.3.7', ''),
                'CURLOPT_MAX_SEND_SPEED_LARGE'   => array('5.3.7', ''),
                'CURLOPT_POSTREDIR'              => array('5.3.2', ''),
                'CURLOPT_PRIVATE'                => array('5.2.4', ''),
                'CURLOPT_PROGRESSFUNCTION'       => array('5.3.0', ''),
                'CURLOPT_SSH_AUTH_TYPES'         => array('5.3.0', ''),
                'CURLOPT_SSH_HOST_PUBLIC_KEY_MD5'
                                                 => array('5.3.0', ''),
                'CURLOPT_SSH_PRIVATE_KEYFILE'    => array('5.3.0', ''),
                'CURLOPT_SSH_PUBLIC_KEYFILE'     => array('5.3.0', ''),
                'CURLOPT_TCP_NODELAY'            => array('5.2.1', ''),

                'CURLFTPAUTH_DEFAULT'            => array('5.1.0', ''),
                'CURLFTPAUTH_SSL'                => array('5.1.0', ''),
                'CURLFTPAUTH_TLS'                => array('5.1.0', ''),

                'CURLFTPSSL_ALL'                 => array('5.2.0', ''),
                'CURLFTPSSL_CONTROL'             => array('5.2.0', ''),
                'CURLFTPSSL_NONE'                => array('5.2.0', ''),

                'CURLPROXY_SOCKS4'               => array('5.2.10', ''),

                'CURLSSH_AUTH_DEFAULT'           => array('5.3.0', ''),
                'CURLSSH_AUTH_HOST'              => array('5.3.0', ''),
                'CURLSSH_AUTH_KEYBOARD'          => array('5.3.0', ''),
                'CURLSSH_AUTH_NONE'              => array('5.3.0', ''),
                'CURLSSH_AUTH_PASSWORD'          => array('5.3.0', ''),
                'CURLSSH_AUTH_PUBLICKEY'         => array('5.3.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
