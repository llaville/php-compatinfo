<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class HttpExtension extends AbstractReference
{
    const REF_NAME    = 'http';
    const REF_VERSION = '2.1.4';    // 2014-11-06 (stable)

    private $curl_version;

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION, array('curl'));

        // cURL 24 bit version number
        $this->curl_version = $this->getMetaVersion('version_number', 'curl');

        $version  = $this->getCurrentVersion();
        $releases = array();

        if (version_compare($version, '2.0.0', 'lt')) {
            // 0.7.0
            if (version_compare($version, '0.7.0', 'ge')) {
                $release = $this->getR00700();
                $count = array_push($releases, $release);
                $this->storage->attach($releases[--$count]);
            }

            // 1.0.0
            if (version_compare($version, '1.0.0', 'ge')) {
                $release = $this->getR10000();
                $count = array_push($releases, $release);
                $this->storage->attach($releases[--$count]);
            }

            // 1.3.0
            if (version_compare($version, '1.3.0', 'ge')) {
                $release = $this->getR10300();
                $count = array_push($releases, $release);
                $this->storage->attach($releases[--$count]);
            }

            // 1.5.0
            if (version_compare($version, '1.5.0', 'ge')) {
                $release = $this->getR10500();
                $count = array_push($releases, $release);
                $this->storage->attach($releases[--$count]);
            }
        } else {
            // 2.0.0
            if (version_compare($version, '2.0.0', 'ge')) {
                $release = $this->getR20000();
                $count = array_push($releases, $release);
                $this->storage->attach($releases[--$count]);
            }
            if (version_compare($version, '2.1.2', 'ge')) {
                $release = $this->getR20102();
                $count = array_push($releases, $release);
                $this->storage->attach($releases[--$count]);
            }
        }
    }

    protected function getR00700()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.7.0',
            'ext.max' => '1.7.6',
            'state'   => 'beta',
            'date'    => '2005-03-24',
            'php.min' => '4.3.0',
            'php.max' => self::LATEST_PHP_5_5,
        );
        $release->classes = array(
            'HttpRequest'                       => array(
                'methods' => array(
                    'addCookies'                => null,
                    'addHeaders'                => null,
                    'getCookies'                => null,
                    'getHeaders'                => null,
                    'getSslOptions'             => null,
                    'setSslOptions'             => null,
                    'unsetCookies'              => null,
                    'unsetHeaders'              => null,
                    'unsetOptions'              => null,
                    'unsetSslOptions'           => null,
                ),
            ),
            'HttpResponse'                      => null,
            'HttpUtil'                          => null,
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '1.7.6',
            'state'   => 'stable',
            'date'    => '2006-06-08',
            'php.min' => '4.3.0',
            'php.max' => self::LATEST_PHP_5_5,
        );
        $release->iniEntries = array(
            'http.etag.mode'                    => null,
            'http.force_exit'                   => null,
            'http.log.allowed_methods'          => null,
            'http.log.cache'                    => null,
            'http.log.composite'                => null,
            'http.log.not_found'                => null,
            'http.log.redirect'                 => null,
            'http.only_exceptions'              => null,
            'http.request.methods.allowed'      => null,
            'http.request.methods.custom'       => null,
            'http.send.deflate.start_auto'      => null,
            'http.send.deflate.start_flags'     => null,
            'http.send.inflate.start_auto'      => null,
            'http.send.inflate.start_flags'     => null,
            'http.send.not_found_404'           => null,
        );
        $release->classes = array(
            'HttpDeflateStream'                 => null,
            'HttpEncodingException'             => null,
            'HttpException'                     => null,
            'HttpHeaderException'               => null,
            'HttpInflateStream'                 => null,
            'HttpInvalidParamException'         => null,
            'HttpMalformedHeadersException'     => null,
            'HttpMessage'                       => array(
                'methods' => array(
                    'guessContentType'          => null,
                )
            ),
            'HttpMessageTypeException'          => null,
            'HttpQueryString'                   => null,
            'HttpQueryStringException'          => null,
            'HttpRequestException'              => null,
            'HttpRequestMethodException'        => null,
            'HttpRequestPool'                   => null,
            'HttpRequestPoolException'          => null,
            'HttpResponseException'             => null,
            'HttpRuntimeException'              => null,
            'HttpSocketException'               => null,
            'HttpUrlException'                  => null,
        );
        $release->functions = array(
            'http_build_cookie'                 => null,
            'http_build_str'                    => null,
            'http_build_url'                    => null,
            'http_cache_etag'                   => null,
            'http_cache_last_modified'          => null,
            'http_chunked_decode'               => null,
            'http_date'                         => null,
            'http_deflate'                      => null,
            'http_get'                          => null,
            'http_get_request_body'             => null,
            'http_get_request_body_stream'      => null,
            'http_get_request_headers'          => null,
            'http_head'                         => null,
            'http_inflate'                      => null,
            'http_match_etag'                   => null,
            'http_match_modified'               => null,
            'http_match_request_header'         => null,
            'http_negotiate'                    => null,
            'http_negotiate_charset'            => null,
            'http_negotiate_content_type'       => null,
            'http_negotiate_language'           => null,
            'http_parse_cookie'                 => null,
            'http_parse_headers'                => null,
            'http_parse_message'                => null,
            'http_parse_params'                 => null,
            'http_persistent_handles_clean'     => null,
            'http_persistent_handles_count'     => null,
            'http_persistent_handles_ident'     => null,
            'http_post_data'                    => null,
            'http_post_fields'                  => null,
            'http_put_data'                     => null,
            'http_put_file'                     => null,
            'http_put_stream'                   => null,
            'http_redirect'                     => null,
            'http_request'                      => null,
            'http_request_body_encode'          => null,
            'http_request_method_exists'        => null,
            'http_request_method_name'          => null,
            'http_request_method_register'      => null,
            'http_request_method_unregister'    => null,
            'http_send_content_disposition'     => null,
            'http_send_content_type'            => null,
            'http_send_data'                    => null,
            'http_send_file'                    => null,
            'http_send_last_modified'           => null,
            'http_send_status'                  => null,
            'http_send_stream'                  => null,
            'http_support'                      => null,
            'http_throttle'                     => null,
            'ob_deflatehandler'                 => null,
            'ob_etaghandler'                    => null,
            'ob_inflatehandler'                 => null,
        );
        $release->constants = array(
            'HTTP_AUTH_ANY'                     => null,
            'HTTP_AUTH_BASIC'                   => null,
            'HTTP_AUTH_DIGEST'                  => null,
            'HTTP_AUTH_DIGEST_IE'               => null,
            'HTTP_AUTH_GSSNEG'                  => null,
            'HTTP_AUTH_NTLM'                    => null,
            'HTTP_COOKIE_HTTPONLY'              => null,
            'HTTP_COOKIE_PARSE_RAW'             => null,
            'HTTP_COOKIE_SECURE'                => null,
            'HTTP_DEFLATE_LEVEL_DEF'            => null,
            'HTTP_DEFLATE_LEVEL_MAX'            => null,
            'HTTP_DEFLATE_LEVEL_MIN'            => null,
            'HTTP_DEFLATE_STRATEGY_DEF'         => null,
            'HTTP_DEFLATE_STRATEGY_FILT'        => null,
            'HTTP_DEFLATE_STRATEGY_FIXED'       => null,
            'HTTP_DEFLATE_STRATEGY_HUFF'        => null,
            'HTTP_DEFLATE_STRATEGY_RLE'         => null,
            'HTTP_DEFLATE_TYPE_GZIP'            => null,
            'HTTP_DEFLATE_TYPE_RAW'             => null,
            'HTTP_DEFLATE_TYPE_ZLIB'            => null,
            'HTTP_ENCODING_STREAM_FLUSH_FULL'   => null,
            'HTTP_ENCODING_STREAM_FLUSH_NONE'   => null,
            'HTTP_ENCODING_STREAM_FLUSH_SYNC'   => null,
            'HTTP_E_ENCODING'                   => null,
            'HTTP_E_HEADER'                     => null,
            'HTTP_E_INVALID_PARAM'              => null,
            'HTTP_E_MALFORMED_HEADERS'          => null,
            'HTTP_E_MESSAGE_TYPE'               => null,
            'HTTP_E_QUERYSTRING'                => null,
            'HTTP_E_REQUEST'                    => null,
            'HTTP_E_REQUEST_METHOD'             => null,
            'HTTP_E_REQUEST_POOL'               => null,
            'HTTP_E_RESPONSE'                   => null,
            'HTTP_E_RUNTIME'                    => null,
            'HTTP_E_SOCKET'                     => null,
            'HTTP_E_URL'                        => null,
            'HTTP_IPRESOLVE_ANY'                => null,
            'HTTP_IPRESOLVE_V4'                 => null,
            'HTTP_IPRESOLVE_V6'                 => null,
            'HTTP_METH_ACL'                     => null,
            'HTTP_METH_BASELINE_CONTROL'        => null,
            'HTTP_METH_CHECKIN'                 => null,
            'HTTP_METH_CHECKOUT'                => null,
            'HTTP_METH_CONNECT'                 => null,
            'HTTP_METH_COPY'                    => null,
            'HTTP_METH_DELETE'                  => null,
            'HTTP_METH_GET'                     => null,
            'HTTP_METH_HEAD'                    => null,
            'HTTP_METH_LABEL'                   => null,
            'HTTP_METH_LOCK'                    => null,
            'HTTP_METH_MERGE'                   => null,
            'HTTP_METH_MKACTIVITY'              => null,
            'HTTP_METH_MKCOL'                   => null,
            'HTTP_METH_MKWORKSPACE'             => null,
            'HTTP_METH_MOVE'                    => null,
            'HTTP_METH_OPTIONS'                 => null,
            'HTTP_METH_POST'                    => null,
            'HTTP_METH_PROPFIND'                => null,
            'HTTP_METH_PROPPATCH'               => null,
            'HTTP_METH_PUT'                     => null,
            'HTTP_METH_REPORT'                  => null,
            'HTTP_METH_TRACE'                   => null,
            'HTTP_METH_UNCHECKOUT'              => null,
            'HTTP_METH_UNLOCK'                  => null,
            'HTTP_METH_UPDATE'                  => null,
            'HTTP_METH_VERSION_CONTROL'         => null,
            'HTTP_MSG_NONE'                     => null,
            'HTTP_MSG_REQUEST'                  => null,
            'HTTP_MSG_RESPONSE'                 => null,
            'HTTP_PARAMS_ALLOW_COMMA'           => null,
            'HTTP_PARAMS_ALLOW_FAILURE'         => null,
            'HTTP_PARAMS_DEFAULT'               => null,
            'HTTP_PARAMS_RAISE_ERROR'           => null,
            'HTTP_POSTREDIR_301'                => null,
            'HTTP_POSTREDIR_302'                => null,
            'HTTP_POSTREDIR_ALL'                => null,
            'HTTP_PROXY_HTTP'                   => null,
            'HTTP_PROXY_HTTP_1_0'               => null,
            'HTTP_PROXY_SOCKS4'                 => null,
            'HTTP_PROXY_SOCKS4A'                => null,
            'HTTP_PROXY_SOCKS5'                 => null,
            'HTTP_PROXY_SOCKS5_HOSTNAME'        => null,
            'HTTP_QUERYSTRING_TYPE_ARRAY'       => null,
            'HTTP_QUERYSTRING_TYPE_BOOL'        => null,
            'HTTP_QUERYSTRING_TYPE_FLOAT'       => null,
            'HTTP_QUERYSTRING_TYPE_INT'         => null,
            'HTTP_QUERYSTRING_TYPE_OBJECT'      => null,
            'HTTP_QUERYSTRING_TYPE_STRING'      => null,
            'HTTP_REDIRECT'                     => null,
            'HTTP_REDIRECT_FOUND'               => null,
            'HTTP_REDIRECT_PERM'                => null,
            'HTTP_REDIRECT_POST'                => null,
            'HTTP_REDIRECT_PROXY'               => null,
            'HTTP_REDIRECT_TEMP'                => null,
            'HTTP_SSL_VERSION_ANY'              => null,
            'HTTP_SSL_VERSION_SSLv2'            => null,
            'HTTP_SSL_VERSION_SSLv3'            => null,
            'HTTP_SSL_VERSION_TLSv1'            => null,
            'HTTP_SUPPORT'                      => null,
            'HTTP_SUPPORT_ENCODINGS'            => null,
            'HTTP_SUPPORT_EVENTS'               => null,
            'HTTP_SUPPORT_MAGICMIME'            => null,
            'HTTP_SUPPORT_REQUESTS'             => null,
            'HTTP_SUPPORT_SSLREQUESTS'          => null,
            'HTTP_URL_FROM_ENV'                 => null,
            'HTTP_URL_JOIN_PATH'                => null,
            'HTTP_URL_JOIN_QUERY'               => null,
            'HTTP_URL_REPLACE'                  => null,
            'HTTP_URL_STRIP_ALL'                => null,
            'HTTP_URL_STRIP_AUTH'               => null,
            'HTTP_URL_STRIP_FRAGMENT'           => null,
            'HTTP_URL_STRIP_PASS'               => null,
            'HTTP_URL_STRIP_PATH'               => null,
            'HTTP_URL_STRIP_PORT'               => null,
            'HTTP_URL_STRIP_QUERY'              => null,
            'HTTP_URL_STRIP_USER'               => null,
            'HTTP_VERSION_1_0'                  => null,
            'HTTP_VERSION_1_1'                  => null,
            'HTTP_VERSION_ANY'                  => null,
            'HTTP_VERSION_NONE'                 => null,
        );
        return $release;
    }

    protected function getR10300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.3.0',
            'ext.max' => '1.7.6',
            'state'   => 'stable',
            'date'    => '2006-09-19',
            'php.min' => '4.3.0',
            'php.max' => self::LATEST_PHP_5_5,
        );
        $release->iniEntries = array(
            'http.request.datashare.connect'    => null,
            'http.request.datashare.cookie'     => null,
            'http.request.datashare.dns'        => null,
            'http.request.datashare.ssl'        => null,
        );
        $release->classes = array(
            'HttpRequestDataShare'              => null,
            'HttpRequestPool'                   => array(
                'methods' => array(
                    'enablePipelining'          => null,
                )
            ),
        );
        return $release;
    }

    protected function getR10500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.5.0',
            'ext.max' => '1.7.6',
            'state'   => 'stable',
            'date'    => '2007-02-20',
            'php.min' => '4.3.0',
            'php.max' => self::LATEST_PHP_5_5,
        );
        $release->iniEntries = array(
            'http.persistent.handles.limit'     => null,
            'http.persistent.handles.ident'     => null,
        );
        return $release;
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-11-22',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'http.etag.mode'                            => null,
        );
        $release->classes = array(
            'http\\Client'                              => null,
            'http\\Client\\Request'                     => null,
            'http\\Client\\Response'                    => null,
            'http\\Cookie'                              => null,
            'http\\Encoding\\Stream'                    => null,
            'http\\Encoding\\Stream\\Dechunk'           => null,
            'http\\Encoding\\Stream\\Deflate'           => null,
            'http\\Encoding\\Stream\\Inflate'           => null,
            'http\\Env'                                 => null,
            'http\\Env\\Request'                        => null,
            'http\\Env\\Response'                       => null,
            'http\\Exception\\BadConversionException'   => null,
            'http\\Exception\\BadHeaderException'       => null,
            'http\\Exception\\BadMessageException'      => null,
            'http\\Exception\\BadMethodCallException'   => null,
            'http\\Exception\\BadQueryStringException'  => null,
            'http\\Exception\\BadUrlException'          => null,
            'http\\Exception\\InvalidArgumentException' => null,
            'http\\Exception\\RuntimeException'         => null,
            'http\\Exception\\UnexpectedValueException' => null,
            'http\\Header'                              => null,
            'http\\Message'                             => null,
            'http\\Message\\Body'                       => null,
            'http\\Params'                              => null,
            'http\\QueryString'                         => null,
            'http\\Url'                                 => null,
        );
        $release->interfaces = array(
            'http\\Exception'                           => null,
        );
        $release->constants = array(
            'http\\Client\\Curl\\AUTH_ANY'              => null,
            'http\\Client\\Curl\\AUTH_BASIC'            => null,
            'http\\Client\\Curl\\AUTH_DIGEST'           => null,
            'http\\Client\\Curl\\AUTH_GSSNEG'           => null,
            'http\\Client\\Curl\\AUTH_NTLM'             => null,
            'http\\Client\\Curl\\HTTP_VERSION_1_0'      => null,
            'http\\Client\\Curl\\HTTP_VERSION_1_1'      => null,
            'http\\Client\\Curl\\HTTP_VERSION_ANY'      => null,
            'http\\Client\\Curl\\IPRESOLVE_ANY'         => null,
            'http\\Client\\Curl\\IPRESOLVE_V4'          => null,
            'http\\Client\\Curl\\IPRESOLVE_V6'          => null,
            'http\\Client\\Curl\\PROXY_HTTP'            => null,
            'http\\Client\\Curl\\PROXY_SOCKS4'          => null,
            'http\\Client\\Curl\\PROXY_SOCKS4A'         => null,
            'http\\Client\\Curl\\PROXY_SOCKS5'          => null,
            'http\\Client\\Curl\\PROXY_SOCKS5_HOSTNAME' => null,
            'http\\Client\\Curl\\SSL_VERSION_ANY'       => null,
            'http\\Client\\Curl\\SSL_VERSION_SSLv2'     => null,
            'http\\Client\\Curl\\SSL_VERSION_SSLv3'     => null,
            'http\\Client\\Curl\\SSL_VERSION_TLSv1'     => null,
        );
        if ($this->curl_version >= 0x071301) { /* libcurl 7.19.1 */
            $items = array(
                'http\\Client\\Curl\\POSTREDIR_301'     => null,
                'http\\Client\\Curl\\POSTREDIR_302'     => null,
                'http\\Client\\Curl\\POSTREDIR_ALL'     => null,
            );
            $release->constants += $items;
        }
        if ($this->curl_version >= 0x071303) { /* libcurl 7.19.3 */
            $items = array(
                'http\\Client\\Curl\\AUTH_DIGEST_IE'    => null,
            );
            $release->constants += $items;
        }
        if ($this->curl_version >= 0x071304) { /* libcurl 7.19.4 */
            $items = array(
                'http\\Client\\Curl\\PROXY_HTTP_1_0'    => null,
            );
            $release->constants += $items;
        }
        return $release;
    }

    protected function getR20102()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-09-25',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array();

        if ($this->curl_version >= 0x072600) { /* libcurl 7.38 */
            $items = array(
                'http\\Client\\Curl\\AUTH_SPNEGO'           => null,
            );
            $release->constants += $items;
        }
        if ($this->curl_version >= 0x072200) { /* libcurl 7.34 */
            $items = array(
                'http\\Client\\Curl\\SSL_VERSION_TLSv1_0'   => null,
                'http\\Client\\Curl\\SSL_VERSION_TLSv1_1'   => null,
                'http\\Client\\Curl\\SSL_VERSION_TLSv1_2'   => null,
            );
            $release->constants += $items;
        }
        if ($this->curl_version >= 0x071a00) { /* libcurl 7.26 */
            $items = array(
                'http\\Client\\Curl\\POSTREDIR_303'         => null,
            );
            $release->constants += $items;
        }
        return $release;
    }
}
