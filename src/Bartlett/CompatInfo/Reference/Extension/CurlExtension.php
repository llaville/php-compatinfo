<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class CurlExtension extends AbstractReference
{
    const REF_NAME    = 'curl';
    const REF_VERSION = '';

    private $version_number;

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $this->version_number = $this->getMetaVersion('version_number');

        $version = $this->getCurrentVersion();

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $this->storage->attach($release);
        }

        // 4.0.3
        if (version_compare($version, '4.0.3', 'ge')) {
            $release = $this->getR40003();
            $this->storage->attach($release);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $this->storage->attach($release);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $this->storage->attach($release);
        }

        // 5.1.3
        if (version_compare($version, '5.1.3', 'ge')) {
            $release = $this->getR50103();
            $this->storage->attach($release);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $this->storage->attach($release);
        }

        // 5.2.1
        if (version_compare($version, '5.2.1', 'ge')) {
            $release = $this->getR50201();
            $this->storage->attach($release);
        }

        // 5.2.4
        if (version_compare($version, '5.2.4', 'ge')) {
            $release = $this->getR50204();
            $this->storage->attach($release);
        }

        // 5.2.10
        if (version_compare($version, '5.2.10', 'ge')) {
            $release = $this->getR50210();
            $this->storage->attach($release);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $this->storage->attach($release);
        }

        // 5.3.2
        if (version_compare($version, '5.3.2', 'ge')) {
            $release = $this->getR50302();
            $this->storage->attach($release);
        }

        // 5.3.7
        if (version_compare($version, '5.3.7', 'ge')) {
            $release = $this->getR50307();
            $this->storage->attach($release);
        }

        // 5.4.7
        if (version_compare($version, '5.4.7', 'ge')) {
            $release = $this->getR50407();
            $this->storage->attach($release);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $this->storage->attach($release);
        }

        // 5.5.19RC1
        if (version_compare($version, '5.5.19RC1', 'ge')) {
            $release = $this->getR50519RC1();
            $this->storage->attach($release);
        }
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->constants = array(
            'CURL_HTTP_VERSION_1_0'                 => null,
            'CURL_HTTP_VERSION_1_1'                 => null,
            'CURL_HTTP_VERSION_NONE'                => null,
            'CURL_NETRC_IGNORED'                    => null,
            'CURL_NETRC_OPTIONAL'                   => null,
            'CURL_NETRC_REQUIRED'                   => null,
            'CURL_TIMECOND_IFMODSINCE'              => null,
            'CURL_TIMECOND_IFUNMODSINCE'            => null,
            'CURL_TIMECOND_LASTMOD'                 => null,
            'CURL_VERSION_IPV6'                     => null,
            'CURL_VERSION_KERBEROS4'                => null,
            'CURL_VERSION_LIBZ'                     => null,
            'CURL_VERSION_SSL'                      => null,

            'CURLCLOSEPOLICY_CALLBACK'              => array('php.max' => self::LATEST_PHP_5_5),
            'CURLCLOSEPOLICY_LEAST_RECENTLY_USED'   => array('php.max' => self::LATEST_PHP_5_5),
            'CURLCLOSEPOLICY_LEAST_TRAFFIC'         => array('php.max' => self::LATEST_PHP_5_5),
            'CURLCLOSEPOLICY_OLDEST'                => array('php.max' => self::LATEST_PHP_5_5),
            'CURLCLOSEPOLICY_SLOWEST'               => array('php.max' => self::LATEST_PHP_5_5),

            'CURLE_ABORTED_BY_CALLBACK'             => null,
            'CURLE_BAD_CALLING_ORDER'               => null,
            'CURLE_BAD_CONTENT_ENCODING'            => null,
            'CURLE_BAD_FUNCTION_ARGUMENT'           => null,
            'CURLE_BAD_PASSWORD_ENTERED'            => null,
            'CURLE_COULDNT_CONNECT'                 => null,
            'CURLE_COULDNT_RESOLVE_HOST'            => null,
            'CURLE_COULDNT_RESOLVE_PROXY'           => null,
            'CURLE_FAILED_INIT'                     => null,
            'CURLE_FILE_COULDNT_READ_FILE'          => null,
            'CURLE_FTP_ACCESS_DENIED'               => null,
            'CURLE_FTP_BAD_DOWNLOAD_RESUME'         => null,
            'CURLE_FTP_CANT_GET_HOST'               => null,
            'CURLE_FTP_CANT_RECONNECT'              => null,
            'CURLE_FTP_COULDNT_GET_SIZE'            => null,
            'CURLE_FTP_COULDNT_RETR_FILE'           => null,
            'CURLE_FTP_COULDNT_SET_ASCII'           => null,
            'CURLE_FTP_COULDNT_SET_BINARY'          => null,
            'CURLE_FTP_COULDNT_STOR_FILE'           => null,
            'CURLE_FTP_COULDNT_USE_REST'            => null,
            'CURLE_FTP_PORT_FAILED'                 => null,
            'CURLE_FTP_QUOTE_ERROR'                 => null,
            'CURLE_FTP_USER_PASSWORD_INCORRECT'     => null,
            'CURLE_FTP_WEIRD_227_FORMAT'            => null,
            'CURLE_FTP_WEIRD_PASS_REPLY'            => null,
            'CURLE_FTP_WEIRD_PASV_REPLY'            => null,
            'CURLE_FTP_WEIRD_SERVER_REPLY'          => null,
            'CURLE_FTP_WEIRD_USER_REPLY'            => null,
            'CURLE_FTP_WRITE_ERROR'                 => null,
            'CURLE_FUNCTION_NOT_FOUND'              => null,
            'CURLE_GOT_NOTHING'                     => null,
            'CURLE_HTTP_NOT_FOUND'                  => null,
            'CURLE_HTTP_PORT_FAILED'                => null,
            'CURLE_HTTP_POST_ERROR'                 => null,
            'CURLE_HTTP_RANGE_ERROR'                => null,
            'CURLE_LDAP_CANNOT_BIND'                => null,
            'CURLE_LDAP_SEARCH_FAILED'              => null,
            'CURLE_LIBRARY_NOT_FOUND'               => null,
            'CURLE_MALFORMAT_USER'                  => null,
            'CURLE_OBSOLETE'                        => null,
            'CURLE_OK'                              => null,
            'CURLE_OPERATION_TIMEOUTED'             => null,
            'CURLE_OUT_OF_MEMORY'                   => null,
            'CURLE_PARTIAL_FILE'                    => null,
            'CURLE_READ_ERROR'                      => null,
            'CURLE_RECV_ERROR'                      => null,
            'CURLE_SEND_ERROR'                      => null,
            'CURLE_SHARE_IN_USE'                    => null,
            'CURLE_SSL_CACERT'                      => null,
            'CURLE_SSL_CERTPROBLEM'                 => null,
            'CURLE_SSL_CIPHER'                      => null,
            'CURLE_SSL_CONNECT_ERROR'               => null,
            'CURLE_SSL_ENGINE_NOTFOUND'             => null,
            'CURLE_SSL_ENGINE_SETFAILED'            => null,
            'CURLE_SSL_PEER_CERTIFICATE'            => null,
            'CURLE_TELNET_OPTION_SYNTAX'            => null,
            'CURLE_TOO_MANY_REDIRECTS'              => null,
            'CURLE_UNKNOWN_TELNET_OPTION'           => null,
            'CURLE_UNSUPPORTED_PROTOCOL'            => null,
            'CURLE_URL_MALFORMAT'                   => null,
            'CURLE_URL_MALFORMAT_USER'              => null,
            'CURLE_WRITE_ERROR'                     => null,

            'CURLINFO_CONNECT_TIME'                 => null,
            'CURLINFO_CONTENT_LENGTH_DOWNLOAD'      => null,
            'CURLINFO_CONTENT_LENGTH_UPLOAD'        => null,
            'CURLINFO_CONTENT_TYPE'                 => null,
            'CURLINFO_EFFECTIVE_URL'                => null,
            'CURLINFO_FILETIME'                     => null,
            'CURLINFO_HEADER_SIZE'                  => null,
            'CURLINFO_HTTP_CODE'                    => null,
            'CURLINFO_NAMELOOKUP_TIME'              => null,
            'CURLINFO_PRETRANSFER_TIME'             => null,
            'CURLINFO_REDIRECT_COUNT'               => null,
            'CURLINFO_REDIRECT_TIME'                => null,
            'CURLINFO_REQUEST_SIZE'                 => null,
            'CURLINFO_SIZE_DOWNLOAD'                => null,
            'CURLINFO_SIZE_UPLOAD'                  => null,
            'CURLINFO_SPEED_DOWNLOAD'               => null,
            'CURLINFO_SPEED_UPLOAD'                 => null,
            'CURLINFO_SSL_VERIFYRESULT'             => null,
            'CURLINFO_STARTTRANSFER_TIME'           => null,
            'CURLINFO_TOTAL_TIME'                   => null,

            'CURLM_BAD_EASY_HANDLE'                 => null,
            'CURLM_BAD_HANDLE'                      => null,
            'CURLM_CALL_MULTI_PERFORM'              => null,
            'CURLM_INTERNAL_ERROR'                  => null,
            'CURLM_OK'                              => null,
            'CURLM_OUT_OF_MEMORY'                   => null,

            'CURLMSG_DONE'                          => null,

            'CURLOPT_BINARYTRANSFER'                => null,
            'CURLOPT_BUFFERSIZE'                    => null,
            'CURLOPT_CAINFO'                        => null,
            'CURLOPT_CAPATH'                        => null,
            'CURLOPT_CLOSEPOLICY'                   => array('php.max' => self::LATEST_PHP_5_5),
            'CURLOPT_CONNECTTIMEOUT'                => null,
            'CURLOPT_COOKIE'                        => null,
            'CURLOPT_COOKIEFILE'                    => null,
            'CURLOPT_COOKIEJAR'                     => null,
            'CURLOPT_CRLF'                          => null,
            'CURLOPT_CUSTOMREQUEST'                 => null,
            'CURLOPT_DNS_CACHE_TIMEOUT'             => null,
            'CURLOPT_DNS_USE_GLOBAL_CACHE'          => null,
            'CURLOPT_EGDSOCKET'                     => null,
            'CURLOPT_ENCODING'                      => null,
            'CURLOPT_FAILONERROR'                   => null,
            'CURLOPT_FILE'                          => null,
            'CURLOPT_FILETIME'                      => null,
            'CURLOPT_FOLLOWLOCATION'                => null,
            'CURLOPT_FORBID_REUSE'                  => null,
            'CURLOPT_FRESH_CONNECT'                 => null,
            'CURLOPT_FTPAPPEND'                     => null,
            'CURLOPT_FTPLISTONLY'                   => null,
            'CURLOPT_FTPPORT'                       => null,
            'CURLOPT_FTP_USE_EPRT'                  => null,
            'CURLOPT_FTP_USE_EPSV'                  => null,
            'CURLOPT_HEADER'                        => null,
            'CURLOPT_HEADERFUNCTION'                => null,
            'CURLOPT_HTTP200ALIASES'                => null,
            'CURLOPT_HTTPGET'                       => null,
            'CURLOPT_HTTPHEADER'                    => null,
            'CURLOPT_HTTPPROXYTUNNEL'               => null,
            'CURLOPT_HTTP_VERSION'                  => null,
            'CURLOPT_INFILE'                        => null,
            'CURLOPT_INFILESIZE'                    => null,
            'CURLOPT_INTERFACE'                     => null,
            'CURLOPT_KRB4LEVEL'                     => null,
            'CURLOPT_LOW_SPEED_LIMIT'               => null,
            'CURLOPT_LOW_SPEED_TIME'                => null,
            'CURLOPT_MAXCONNECTS'                   => null,
            'CURLOPT_MAXREDIRS'                     => null,
            'CURLOPT_MUTE'                          => null,
            'CURLOPT_NETRC'                         => null,
            'CURLOPT_NOBODY'                        => null,
            'CURLOPT_NOPROGRESS'                    => null,
            'CURLOPT_NOSIGNAL'                      => null,
            'CURLOPT_PASSWDFUNCTION'                => null,
            'CURLOPT_PORT'                          => null,
            'CURLOPT_POST'                          => null,
            'CURLOPT_POSTFIELDS'                    => null,
            'CURLOPT_POSTQUOTE'                     => null,
            'CURLOPT_PROXY'                         => null,
            'CURLOPT_PROXYPORT'                     => null,
            'CURLOPT_PROXYTYPE'                     => null,
            'CURLOPT_PROXYUSERPWD'                  => null,
            'CURLOPT_PUT'                           => null,
            'CURLOPT_QUOTE'                         => null,
            'CURLOPT_RANDOM_FILE'                   => null,
            'CURLOPT_RANGE'                         => null,
            'CURLOPT_READDATA'                      => null,
            'CURLOPT_READFUNCTION'                  => null,
            'CURLOPT_REFERER'                       => null,
            'CURLOPT_RESUME_FROM'                   => null,
            'CURLOPT_RETURNTRANSFER'                => null,
            'CURLOPT_SSLCERT'                       => null,
            'CURLOPT_SSLCERTPASSWD'                 => null,
            'CURLOPT_SSLCERTTYPE'                   => null,
            'CURLOPT_SSLENGINE'                     => null,
            'CURLOPT_SSLENGINE_DEFAULT'             => null,
            'CURLOPT_SSLKEY'                        => null,
            'CURLOPT_SSLKEYPASSWD'                  => null,
            'CURLOPT_SSLKEYTYPE'                    => null,
            'CURLOPT_SSLVERSION'                    => null,
            'CURLOPT_SSL_CIPHER_LIST'               => null,
            'CURLOPT_SSL_VERIFYHOST'                => null,
            'CURLOPT_SSL_VERIFYPEER'                => null,
            'CURLOPT_STDERR'                        => null,
            'CURLOPT_TIMECONDITION'                 => null,
            'CURLOPT_TIMEOUT'                       => null,
            'CURLOPT_TIMEVALUE'                     => null,
            'CURLOPT_TRANSFERTEXT'                  => null,
            'CURLOPT_UNRESTRICTED_AUTH'             => null,
            'CURLOPT_UPLOAD'                        => null,
            'CURLOPT_URL'                           => null,
            'CURLOPT_USERAGENT'                     => null,
            'CURLOPT_USERPWD'                       => null,
            'CURLOPT_VERBOSE'                       => null,
            'CURLOPT_WRITEFUNCTION'                 => null,
            'CURLOPT_WRITEHEADER'                   => null,

            'CURLPROXY_HTTP'                        => null,
            'CURLPROXY_SOCKS5'                      => null,

            'CURLVERSION_NOW'                       => null,
        );
        if ($this->version_number >= 0x070a06) {
            /* 7.10.6 */
            $items = array(
                'CURLAUTH_ANY'                      => null,
                'CURLAUTH_ANYSAFE'                  => null,
                'CURLAUTH_BASIC'                    => null,
                'CURLAUTH_DIGEST'                   => null,
                'CURLAUTH_GSSNEGOTIATE'             => null,
                'CURLAUTH_NTLM'                     => null,

                'CURLOPT_HTTPAUTH'                  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070a07) {
            /* 7.10.7 */
            $items = array(
                'CURLOPT_FTP_CREATE_MISSING_DIRS'
                                                    => null,
                'CURLOPT_PROXYAUTH'                 => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070a08) {
            /* 7.10.8 */
            $items = array(
                'CURLE_FILESIZE_EXCEEDED'           => null,
                'CURLE_LDAP_INVALID_URL'            => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070b00) {
            /* 7.11.0 */
            $items = array(
                'CURLE_FTP_SSL_FAILED'              => null,

                'CURLFTPSSL_TRY'                    => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071002) {
            /* 7.16.2 */
            $items = array(
                'CURLOPT_CONNECTTIMEOUT_MS'         => null,
                'CURLOPT_TIMEOUT_MS'                => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071304) {
            /* 7.19.4 */
            $items = array(
                'CURLOPT_PROTOCOLS'                 => null,
                'CURLOPT_REDIR_PROTOCOLS'           => null,

                'CURLPROTO_ALL'                     => null,
                'CURLPROTO_DICT'                    => null,
                'CURLPROTO_FILE'                    => null,
                'CURLPROTO_FTP'                     => null,
                'CURLPROTO_FTPS'                    => null,
                'CURLPROTO_HTTP'                    => null,
                'CURLPROTO_HTTPS'                   => null,
                'CURLPROTO_LDAP'                    => null,
                'CURLPROTO_LDAPS'                   => null,
                'CURLPROTO_SCP'                     => null,
                'CURLPROTO_SFTP'                    => null,
                'CURLPROTO_TELNET'                  => null,
                'CURLPROTO_TFTP'                    => null,
            );
            $release->constants += $items;
        }
        $release->functions = array(
            'curl_close'                            => null,
            'curl_exec'                             => null,
            'curl_init'                             => null,
            'curl_setopt'                           => null,
            'curl_version'                          => null,
        );
        return $release;
    }

    protected function getR40003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-10-11',
            'php.min' => '4.0.3',
            'php.max' => '',
        );
        $release->functions = array(
            'curl_errno'                    => null,
            'curl_error'                    => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'curl_getinfo'                  => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'curl_copy_handle'              => null,
            'curl_multi_add_handle'         => null,
            'curl_multi_close'              => null,
            'curl_multi_exec'               => null,
            'curl_multi_getcontent'         => null,
            'curl_multi_info_read'          => null,
            'curl_multi_init'               => null,
            'curl_multi_remove_handle'      => null,
            'curl_multi_select'             => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-11-24',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'CURLOPT_AUTOREFERER'           => null,
            'CURLOPT_COOKIESESSION'         => null,
        );
        if ($this->version_number >= 0x070c02) {
            /* 7.12.2 */
            $items = array(
                'CURLFTPAUTH_DEFAULT'       => null,
                'CURLFTPAUTH_SSL'           => null,
                'CURLFTPAUTH_TLS'           => null,

                'CURLOPT_FTPSSLAUTH'        => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR50103()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-05-02',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->functions = array(
            'curl_setopt_array'             => null,
        );
        $release->constants = array(
            'CURLINFO_HEADER_OUT'           => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->constants = array();
        if ($this->version_number >= 0x070b00) {
            /* 7.11.0 */
            $items = array(
                'CURLFTPSSL_ALL'            => null,
                'CURLFTPSSL_CONTROL'        => null,
                'CURLFTPSSL_NONE'           => null,

                'CURLOPT_FTP_SSL'           => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR50201()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-02-08',
            'php.min' => '5.2.1',
            'php.max' => '',
        );
        $release->constants = array();
        if ($this->version_number >= 0x070b02) {
            /* 7.11.2 */
            $items = array(
                'CURLOPT_TCP_NODELAY'       => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR50204()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-08-30',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->constants = array(
            'CURLINFO_PRIVATE'              => null,

            'CURLOPT_PRIVATE'               => null,
        );
        return $release;
    }

    protected function getR50210()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.10',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-18',
            'php.min' => '5.2.10',
            'php.max' => '',
        );
        $release->constants = array(
            'CURLPROXY_SOCKS4'              => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'CURLOPT_PROGRESSFUNCTION'              => null,
        );
        if ($this->version_number >= 0x070a08) {
            /* 7.10.8 */
            $items = array(
                'CURLOPT_IPRESOLVE'                 => null,

                'CURL_IPRESOLVE_V4'                 => null,
                'CURL_IPRESOLVE_V6'                 => null,
                'CURL_IPRESOLVE_WHATEVER'           => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070f01) {
            /* 7.15.1 */
            $items = array(
                'CURLOPT_FTP_FILEMETHOD'            => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070f03) {
            /* 7.15.3 */
            $items = array(
                'CURLFTPMETHOD_MULTICWD'            => null,
                'CURLFTPMETHOD_NOCWD'               => null,
                'CURLFTPMETHOD_SINGLECWD'           => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071001) {
            /* 7.16.1 */
            $items = array(
                'CURLE_SSH'                         => null,

                'CURLOPT_SSH_AUTH_TYPES'            => null,
                'CURLOPT_SSH_PRIVATE_KEYFILE'       => null,
                'CURLOPT_SSH_PUBLIC_KEYFILE'        => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071101) {
            /* 7.17.1 */
            $items = array(
                'CURLOPT_SSH_HOST_PUBLIC_KEY_MD5'   => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071300) {
            /* 7.19.0 */
            $items = array(
                'CURLOPT_KEYPASSWD'                 => null,

                'CURLSSH_AUTH_DEFAULT'              => null,
                'CURLSSH_AUTH_HOST'                 => null,
                'CURLSSH_AUTH_KEYBOARD'             => null,
                'CURLSSH_AUTH_NONE'                 => null,
                'CURLSSH_AUTH_PASSWORD'             => null,
                'CURLSSH_AUTH_PUBLICKEY'            => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR50302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-03-04',
            'php.min' => '5.3.2',
            'php.max' => '',
        );
        $release->constants = array();
        if ($this->version_number >= 0x070f00) {
            /* 7.15.0 */
            $items = array(
                'CURLOPT_FTP_SKIP_PASV_IP'  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071301) {
            /* 7.19.1 */
            $items = array(
                'CURLINFO_CERTINFO'         => null,

                'CURLOPT_CERTINFO'          => null,
                'CURLOPT_POSTREDIR'         => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR50307()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-08-18',
            'php.min' => '5.3.7',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'curl.cainfo'                       => null,
        );
        $release->constants = array();
        if ($this->version_number >= 0x070f05) {
            /* 7.15.5 */
            $items = array(
                'CURLOPT_MAX_RECV_SPEED_LARGE'  => null,
                'CURLOPT_MAX_SEND_SPEED_LARGE'  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071202) {
            /* 7.18.2 */
            $items = array(
                'CURLINFO_REDIRECT_URL'         => null,
            );
            $release->constants += $items;
        }
        return $release;

    }

    protected function getR50407()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-09-13',
            'php.min' => '5.4.7',
            'php.max' => '',
        );
        $release->constants = array();
        if ($this->version_number >= 0x071300) {
            /* 7.19.0 */
            $items = array(
                'CURLINFO_PRIMARY_IP'       => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071500) {
            /* 7.21.0 */
            $items = array(
                'CURLINFO_LOCAL_IP'         => null,
                'CURLINFO_LOCAL_PORT'       => null,
                'CURLINFO_PRIMARY_PORT'     => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR50500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->constants = array(
            'CURL_LOCK_DATA_COOKIE'                 => null,
            'CURL_LOCK_DATA_DNS'                    => null,
            'CURL_LOCK_DATA_SSL_SESSION'            => null,
            'CURL_SSLVERSION_DEFAULT'               => null,
            'CURL_SSLVERSION_SSLv2'                 => null,
            'CURL_SSLVERSION_SSLv3'                 => null,
            'CURL_SSLVERSION_TLSv1'                 => null,
            'CURL_TIMECOND_NONE'                    => null,

            'CURLE_BAD_DOWNLOAD_RESUME'             => null,
            'CURLE_FTP_PARTIAL_FILE'                => null,
            'CURLE_HTTP_RETURNED_ERROR'             => null,
            'CURLE_OPERATION_TIMEDOUT'              => null,

            'CURLINFO_LASTONE'                      => null,

            'CURLOPT_PREQUOTE'                      => null,
            'CURLOPT_SAFE_UPLOAD'                   => null,
            'CURLOPT_SHARE'                         => null,
            'CURLOPT_TELNETOPTIONS'                 => null,

            'CURLSHOPT_NONE'                        => null,
            'CURLSHOPT_SHARE'                       => null,
            'CURLSHOPT_UNSHARE'                     => null,
        );
        if ($this->version_number >= 0x070a06) {
            /* 7.10.6 */
            $items = array(
                'CURLAUTH_NONE'                     => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070a07) {
            /* 7.10.7 */
            $items = array(
                'CURLINFO_HTTP_CONNECTCODE'         => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070a08) {
            /* 7.10.8 */
            $items = array(
                'CURLINFO_HTTPAUTH_AVAIL'           => null,
                'CURLINFO_RESPONSE_CODE'            => null,
                'CURLINFO_PROXYAUTH_AVAIL'          => null,

                'CURLOPT_FTP_RESPONSE_TIMEOUT'      => null,
                'CURLOPT_MAXFILESIZE'               => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070b00) {
            /* 7.11.0 */
            $items = array(
                'CURLOPT_NETRC_FILE'                => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070c02) {
            /* 7.12.2 */
            $items = array(
                'CURLINFO_OS_ERRNO'                 => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070c03) {
            /* 7.12.3 */
            $items = array(
                'CURLINFO_NUM_CONNECTS'             => null,
                'CURLINFO_SSL_ENGINES'              => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070d00) {
            /* 7.13.0 */
            $items = array(
                'CURLOPT_FTP_ACCOUNT'               => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070e01) {
            /* 7.14.1 */
            $items = array(
                'CURLINFO_COOKIELIST'               => null,

                'CURLOPT_COOKIELIST'                => null,
                'CURLOPT_IGNORE_CONTENT_LENGTH'     => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070f02) {
            /* 7.15.2 */
            $items = array(
                'CURLOPT_CONNECT_ONLY'              => null,
                'CURLOPT_LOCALPORT'                 => null,
                'CURLOPT_LOCALPORTRANGE'            => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070f04) {
            /* 7.15.4 */
            $items = array(
                'CURLINFO_FTP_ENTRY_PATH'           => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x070f05) {
            /* 7.15.5 */
            $items = array(
                'CURLOPT_FTP_ALTERNATIVE_TO_USER'   => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071000) {
            /* 7.16.0 */
            $items = array(
                'CURLOPT_SSL_SESSIONID_CACHE'       => null,

                'CURLMOPT_PIPELINING'               => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071001) {
            /* 7.16.1 */
            $items = array(
                'CURLOPT_FTP_SSL_CCC'               => null,

                'CURLFTPSSL_CCC_ACTIVE'             => null,
                'CURLFTPSSL_CCC_NONE'               => null,
                'CURLFTPSSL_CCC_PASSIVE'            => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071002) {
            /* 7.16.2 */
            $items = array(
                'CURLOPT_HTTP_CONTENT_DECODING'     => null,
                'CURLOPT_HTTP_TRANSFER_DECODING'    => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071003) {
            /* 7.16.3 */
            $items = array(
                'CURLMOPT_MAXCONNECTS'              => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071004) {
            /* 7.16.4 */
            $items = array(
                'CURLOPT_KRBLEVEL'                  => null,
                'CURLOPT_NEW_DIRECTORY_PERMS'       => null,
                'CURLOPT_NEW_FILE_PERMS'            => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071100) {
            /* 7.17.0 */
            $items = array(
                'CURLOPT_APPEND'                    => null,
                'CURLOPT_DIRLISTONLY'               => null,
                'CURLOPT_USE_SSL'                   => null,

                'CURLUSESSL_ALL'                    => null,
                'CURLUSESSL_CONTROL'                => null,
                'CURLUSESSL_NONE'                   => null,
                'CURLUSESSL_TRY'                    => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071200) {
            /* 7.18.0 */
            $items = array(
                'CURLOPT_PROXY_TRANSFER_MODE'       => null,

                'CURLPAUSE_ALL'                     => null,
                'CURLPAUSE_CONT'                    => null,
                'CURLPAUSE_RECV'                    => null,
                'CURLPAUSE_RECV_CONT'               => null,
                'CURLPAUSE_SEND'                    => null,
                'CURLPAUSE_SEND_CONT'               => null,

                'CURL_READFUNC_PAUSE'               => null,
                'CURL_WRITEFUNC_PAUSE'              => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071300) {
            /* 7.19.0 */
            $items = array(
                'CURLINFO_APPCONNECT_TIME'          => null,

                'CURLOPT_ADDRESS_SCOPE'             => null,
                'CURLOPT_CRLFILE'                   => null,
                'CURLOPT_ISSUERCERT'                => null,

                'CURLSSH_AUTH_ANY'                  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071301) {
            /* 7.19.1 */
            $items = array(
                'CURLOPT_PASSWORD'                  => null,
                'CURLOPT_PROXYPASSWORD'             => null,
                'CURLOPT_PROXYUSERNAME'             => null,
                'CURLOPT_USERNAME'                  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071303) {
            /* 7.19.3 */
            $items = array(
                'CURLAUTH_DIGEST_IE'                => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071304) {
            /* 7.19.4 */
            $items = array(
                'CURLINFO_CONDITION_UNMET'          => null,

                'CURLOPT_NOPROXY'                   => null,
                'CURLOPT_SOCKS5_GSSAPI_NEC'         => null,
                'CURLOPT_SOCKS5_GSSAPI_SERVICE'     => null,
                'CURLOPT_TFTP_BLKSIZE'              => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071306) {
            /* 7.19.6 */
            $items = array(
                'CURLOPT_SSH_KNOWNHOSTS'            => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071400) {
            /* 7.20.0 */
            $items = array(
                'CURLINFO_RTSP_CLIENT_CSEQ'         => null,
                'CURLINFO_RTSP_CSEQ_RECV'           => null,
                'CURLINFO_RTSP_SERVER_CSEQ'         => null,
                'CURLINFO_RTSP_SESSION_ID'          => null,

                'CURLOPT_FTP_USE_PRET'              => null,
                'CURLOPT_MAIL_FROM'                 => null,
                'CURLOPT_MAIL_RCPT'                 => null,
                'CURLOPT_RTSP_CLIENT_CSEQ'          => null,
                'CURLOPT_RTSP_REQUEST'              => null,
                'CURLOPT_RTSP_SERVER_CSEQ'          => null,
                'CURLOPT_RTSP_SESSION_ID'           => null,
                'CURLOPT_RTSP_STREAM_URI'           => null,
                'CURLOPT_RTSP_TRANSPORT'            => null,

                'CURLPROTO_IMAP'                    => null,
                'CURLPROTO_IMAPS'                   => null,
                'CURLPROTO_POP3'                    => null,
                'CURLPROTO_POP3S'                   => null,
                'CURLPROTO_RTSP'                    => null,
                'CURLPROTO_SMTP'                    => null,
                'CURLPROTO_SMTPS'                   => null,

                'CURL_RTSPREQ_ANNOUNCE'             => null,
                'CURL_RTSPREQ_DESCRIBE'             => null,
                'CURL_RTSPREQ_GET_PARAMETER'        => null,
                'CURL_RTSPREQ_OPTIONS'              => null,
                'CURL_RTSPREQ_PAUSE'                => null,
                'CURL_RTSPREQ_PLAY'                 => null,
                'CURL_RTSPREQ_RECEIVE'              => null,
                'CURL_RTSPREQ_RECORD'               => null,
                'CURL_RTSPREQ_SETUP'                => null,
                'CURL_RTSPREQ_SET_PARAMETER'        => null,
                'CURL_RTSPREQ_TEARDOWN'             => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071500) {
            /* 7.21.0 */
            $items = array(
                'CURLOPT_FNMATCH_FUNCTION'          => null,
                'CURLOPT_WILDCARDMATCH'             => null,

                'CURLPROTO_RTMP'                    => null,
                'CURLPROTO_RTMPE'                   => null,
                'CURLPROTO_RTMPS'                   => null,
                'CURLPROTO_RTMPT'                   => null,
                'CURLPROTO_RTMPTE'                  => null,
                'CURLPROTO_RTMPTS'                  => null,

                'CURL_FNMATCHFUNC_FAIL'             => null,
                'CURL_FNMATCHFUNC_MATCH'            => null,
                'CURL_FNMATCHFUNC_NOMATCH'          => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071502) {
            /* 7.21.2 */
            $items = array(
                'CURLPROTO_GOPHER'                  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071503) {
            /* 7.21.3 */
            $items = array(
                'CURLAUTH_ONLY'                     => null,

                'CURLOPT_RESOLVE'                   => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071504) {
            /* 7.21.4 */
            $items = array(
                'CURLOPT_TLSAUTH_PASSWORD'          => null,
                'CURLOPT_TLSAUTH_TYPE'              => null,
                'CURLOPT_TLSAUTH_USERNAME'          => null,

                'CURL_TLSAUTH_SRP'                  => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071506) {
            /* 7.21.6 */
            $items = array(
                'CURLOPT_ACCEPT_ENCODING'           => null,
                'CURLOPT_TRANSFER_ENCODING'         => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071600) {
            /* 7.22.0 */
            $items = array(
                'CURLGSSAPI_DELEGATION_FLAG'        => null,
                'CURLGSSAPI_DELEGATION_POLICY_FLAG' => null,

                'CURLOPT_GSSAPI_DELEGATION'         => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071800) {
            /* 7.24.0 */
            $items = array(
                'CURLOPT_ACCEPTTIMEOUT_MS'          => null,
                'CURLOPT_DNS_SERVERS'               => null,
            );
            $release->constants += $items;
        }
        if ($this->version_number >= 0x071900) {
            /* 7.25.0 */
            $items = array(
                'CURLOPT_MAIL_AUTH'                 => null,
                'CURLOPT_SSL_OPTIONS'               => null,
                'CURLOPT_TCP_KEEPALIVE'             => null,
                'CURLOPT_TCP_KEEPIDLE'              => null,
                'CURLOPT_TCP_KEEPINTVL'             => null,

                'CURLSSLOPT_ALLOW_BEAST'            => null,
            );
            $release->constants += $items;
        }
        $release->functions = array(
            'curl_file_create'                      => null,
            'curl_share_close'                      => null,
            'curl_share_init'                       => null,
            'curl_share_setopt'                     => null,
        );
        if ($this->version_number >= 0x070c00) {
            /* 7.12.0 */
            $items = array(
                'curl_multi_strerror'               => null,
                'curl_strerror'                     => null,
            );
            $release->functions += $items;
        }
        if ($this->version_number >= 0x070c01) {
            /* 7.12.1 */
            $items = array(
                'curl_reset'                        => null,
            );
            $release->functions += $items;
        }
        if ($this->version_number >= 0x070f04) {
            /* 7.15.4 */
            $items = array(
                'curl_escape'                       => null,
                'curl_unescape'                     => null,
                'curl_multi_setopt'                 => null,
            );
            $release->functions += $items;
        }
        if ($this->version_number >= 0x071200) {
            /* 7.18.0 */
            $items = array(
                'curl_pause'                        => null,
            );
            $release->functions += $items;
        }
        $release->classes = array(
            'CURLFile'                              => null,
        );
        return $release;
    }

    protected function getR50519RC1()
    {
        $excludePhp506 = array(
            '5.6.0',
            '5.6.0RC1',
            '5.6.0RC2',
            '5.6.0RC3',
            '5.6.0RC4',
            '5.6.1',
            '5.6.1RC1',
            '5.6.2',
        );

        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.19RC1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-10-28',
            'php.min' => '5.5.19RC1',
            'php.max' => '',
        );
        $release->constants = array();

        if ($this->version_number >= 0x072200) {
            /* 7.34.0 */
            $items = array(
                'CURL_SSLVERSION_TLSv1_0'           => array(
                    'php.excludes' => $excludePhp506,
                ),
                'CURL_SSLVERSION_TLSv1_1'           => array(
                    'php.excludes' => $excludePhp506,
                ),
                'CURL_SSLVERSION_TLSv1_2'           => array(
                    'php.excludes' => $excludePhp506,
                ),
            );
            $release->constants += $items;
        }
        return $release;
    }
}
