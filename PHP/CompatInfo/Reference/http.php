<?php
/**
 * Version informations about http extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about http extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.http.php
 * @since    Class available since Release 2.16.0
 */
class PHP_CompatInfo_Reference_Http
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'http';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.7.5';

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        $phpMin = '4.3.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = false;
        $items = array(
            'HttpDeflateStream'                     => array('4.3.0', ''),
            'HttpEncodingException'                 => array('4.3.0', ''),
            'HttpException'                         => array('4.3.0', ''),
            'HttpHeaderException'                   => array('4.3.0', ''),
            'HttpInflateStream'                     => array('4.3.0', ''),
            'HttpInvalidParamException'             => array('4.3.0', ''),
            'HttpMalformedHeadersException'         => array('4.3.0', ''),
            'HttpMessage'                           => array('4.3.0', ''),
            'HttpMessageTypeException'              => array('4.3.0', ''),
            'HttpQueryString'                       => array('4.3.0', ''),
            'HttpQueryStringException'              => array('4.3.0', ''),
            'HttpRequest'                           => array('4.3.0', ''),
            'HttpRequestDataShare'                  => array('4.3.0', ''),
            'HttpRequestException'                  => array('4.3.0', ''),
            'HttpRequestMethodException'            => array('4.3.0', ''),
            'HttpRequestPool'                       => array('4.3.0', ''),
            'HttpRequestPoolException'              => array('4.3.0', ''),
            'HttpResponse'                          => array('4.3.0', ''),
            'HttpResponseException'                 => array('4.3.0', ''),
            'HttpRuntimeException'                  => array('4.3.0', ''),
            'HttpSocketException'                   => array('4.3.0', ''),
            'HttpUrlException'                      => array('4.3.0', ''),
            'HttpUtil'                              => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.http.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'http_build_cookie'                     => array('4.3.0', ''),
            'http_build_str'                        => array('4.3.0', ''),
            'http_build_url'                        => array('4.3.0', ''),
            'http_cache_etag'                       => array('4.3.0', ''),
            'http_cache_last_modified'              => array('4.3.0', ''),
            'http_chunked_decode'                   => array('4.3.0', ''),
            'http_date'                             => array('4.3.0', ''),
            'http_deflate'                          => array('4.3.0', ''),
            'http_get'                              => array('4.3.0', ''),
            'http_get_request_body'                 => array('4.3.0', ''),
            'http_get_request_body_stream'          => array('4.3.0', ''),
            'http_get_request_headers'              => array('4.3.0', ''),
            'http_head'                             => array('4.3.0', ''),
            'http_inflate'                          => array('4.3.0', ''),
            'http_match_etag'                       => array('4.3.0', ''),
            'http_match_modified'                   => array('4.3.0', ''),
            'http_match_request_header'             => array('4.3.0', ''),
            'http_negotiate'                        => array('4.3.0', ''),
            'http_negotiate_charset'                => array('4.3.0', ''),
            'http_negotiate_content_type'           => array('4.3.0', ''),
            'http_negotiate_language'               => array('4.3.0', ''),
            'http_parse_cookie'                     => array('4.3.0', ''),
            'http_parse_headers'                    => array('4.3.0', ''),
            'http_parse_message'                    => array('4.3.0', ''),
            'http_parse_params'                     => array('4.3.0', ''),
            'http_persistent_handles_clean'         => array('4.3.0', ''),
            'http_persistent_handles_count'         => array('4.3.0', ''),
            'http_persistent_handles_ident'         => array('4.3.0', ''),
            'http_post_data'                        => array('4.3.0', ''),
            'http_post_fields'                      => array('4.3.0', ''),
            'http_put_data'                         => array('4.3.0', ''),
            'http_put_file'                         => array('4.3.0', ''),
            'http_put_stream'                       => array('4.3.0', ''),
            'http_redirect'                         => array('4.3.0', ''),
            'http_request'                          => array('4.3.0', ''),
            'http_request_body_encode'              => array('4.3.0', ''),
            'http_request_method_exists'            => array('4.3.0', ''),
            'http_request_method_name'              => array('4.3.0', ''),
            'http_request_method_register'          => array('4.3.0', ''),
            'http_request_method_unregister'        => array('4.3.0', ''),
            'http_send_content_disposition'         => array('4.3.0', ''),
            'http_send_content_type'                => array('4.3.0', ''),
            'http_send_data'                        => array('4.3.0', ''),
            'http_send_file'                        => array('4.3.0', ''),
            'http_send_last_modified'               => array('4.3.0', ''),
            'http_send_status'                      => array('4.3.0', ''),
            'http_send_stream'                      => array('4.3.0', ''),
            'http_support'                          => array('4.3.0', ''),
            'http_throttle'                         => array('4.3.0', ''),
            'ob_deflatehandler'                     => array('4.3.0', ''),
            'ob_etaghandler'                        => array('4.3.0', ''),
            'ob_inflatehandler'                     => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/http.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'HTTP_AUTH_ANY'                         => array('4.3.0', ''),
            'HTTP_AUTH_BASIC'                       => array('4.3.0', ''),
            'HTTP_AUTH_DIGEST'                      => array('4.3.0', ''),
            'HTTP_AUTH_DIGEST_IE'                   => array('4.3.0', ''),
            'HTTP_AUTH_GSSNEG'                      => array('4.3.0', ''),
            'HTTP_AUTH_NTLM'                        => array('4.3.0', ''),
            'HTTP_COOKIE_HTTPONLY'                  => array('4.3.0', ''),
            'HTTP_COOKIE_PARSE_RAW'                 => array('4.3.0', ''),
            'HTTP_COOKIE_SECURE'                    => array('4.3.0', ''),
            'HTTP_DEFLATE_LEVEL_DEF'                => array('4.3.0', ''),
            'HTTP_DEFLATE_LEVEL_MAX'                => array('4.3.0', ''),
            'HTTP_DEFLATE_LEVEL_MIN'                => array('4.3.0', ''),
            'HTTP_DEFLATE_STRATEGY_DEF'             => array('4.3.0', ''),
            'HTTP_DEFLATE_STRATEGY_FILT'            => array('4.3.0', ''),
            'HTTP_DEFLATE_STRATEGY_FIXED'           => array('4.3.0', ''),
            'HTTP_DEFLATE_STRATEGY_HUFF'            => array('4.3.0', ''),
            'HTTP_DEFLATE_STRATEGY_RLE'             => array('4.3.0', ''),
            'HTTP_DEFLATE_TYPE_GZIP'                => array('4.3.0', ''),
            'HTTP_DEFLATE_TYPE_RAW'                 => array('4.3.0', ''),
            'HTTP_DEFLATE_TYPE_ZLIB'                => array('4.3.0', ''),
            'HTTP_ENCODING_STREAM_FLUSH_FULL'       => array('4.3.0', ''),
            'HTTP_ENCODING_STREAM_FLUSH_NONE'       => array('4.3.0', ''),
            'HTTP_ENCODING_STREAM_FLUSH_SYNC'       => array('4.3.0', ''),
            'HTTP_E_ENCODING'                       => array('4.3.0', ''),
            'HTTP_E_HEADER'                         => array('4.3.0', ''),
            'HTTP_E_INVALID_PARAM'                  => array('4.3.0', ''),
            'HTTP_E_MALFORMED_HEADERS'              => array('4.3.0', ''),
            'HTTP_E_MESSAGE_TYPE'                   => array('4.3.0', ''),
            'HTTP_E_QUERYSTRING'                    => array('4.3.0', ''),
            'HTTP_E_REQUEST'                        => array('4.3.0', ''),
            'HTTP_E_REQUEST_METHOD'                 => array('4.3.0', ''),
            'HTTP_E_REQUEST_POOL'                   => array('4.3.0', ''),
            'HTTP_E_RESPONSE'                       => array('4.3.0', ''),
            'HTTP_E_RUNTIME'                        => array('4.3.0', ''),
            'HTTP_E_SOCKET'                         => array('4.3.0', ''),
            'HTTP_E_URL'                            => array('4.3.0', ''),
            'HTTP_IPRESOLVE_ANY'                    => array('4.3.0', ''),
            'HTTP_IPRESOLVE_V4'                     => array('4.3.0', ''),
            'HTTP_IPRESOLVE_V6'                     => array('4.3.0', ''),
            'HTTP_METH_ACL'                         => array('4.3.0', ''),
            'HTTP_METH_BASELINE_CONTROL'            => array('4.3.0', ''),
            'HTTP_METH_CHECKIN'                     => array('4.3.0', ''),
            'HTTP_METH_CHECKOUT'                    => array('4.3.0', ''),
            'HTTP_METH_CONNECT'                     => array('4.3.0', ''),
            'HTTP_METH_COPY'                        => array('4.3.0', ''),
            'HTTP_METH_DELETE'                      => array('4.3.0', ''),
            'HTTP_METH_GET'                         => array('4.3.0', ''),
            'HTTP_METH_HEAD'                        => array('4.3.0', ''),
            'HTTP_METH_LABEL'                       => array('4.3.0', ''),
            'HTTP_METH_LOCK'                        => array('4.3.0', ''),
            'HTTP_METH_MERGE'                       => array('4.3.0', ''),
            'HTTP_METH_MKACTIVITY'                  => array('4.3.0', ''),
            'HTTP_METH_MKCOL'                       => array('4.3.0', ''),
            'HTTP_METH_MKWORKSPACE'                 => array('4.3.0', ''),
            'HTTP_METH_MOVE'                        => array('4.3.0', ''),
            'HTTP_METH_OPTIONS'                     => array('4.3.0', ''),
            'HTTP_METH_POST'                        => array('4.3.0', ''),
            'HTTP_METH_PROPFIND'                    => array('4.3.0', ''),
            'HTTP_METH_PROPPATCH'                   => array('4.3.0', ''),
            'HTTP_METH_PUT'                         => array('4.3.0', ''),
            'HTTP_METH_REPORT'                      => array('4.3.0', ''),
            'HTTP_METH_TRACE'                       => array('4.3.0', ''),
            'HTTP_METH_UNCHECKOUT'                  => array('4.3.0', ''),
            'HTTP_METH_UNLOCK'                      => array('4.3.0', ''),
            'HTTP_METH_UPDATE'                      => array('4.3.0', ''),
            'HTTP_METH_VERSION_CONTROL'             => array('4.3.0', ''),
            'HTTP_MSG_NONE'                         => array('4.3.0', ''),
            'HTTP_MSG_REQUEST'                      => array('4.3.0', ''),
            'HTTP_MSG_RESPONSE'                     => array('4.3.0', ''),
            'HTTP_PARAMS_ALLOW_COMMA'               => array('4.3.0', ''),
            'HTTP_PARAMS_ALLOW_FAILURE'             => array('4.3.0', ''),
            'HTTP_PARAMS_DEFAULT'                   => array('4.3.0', ''),
            'HTTP_PARAMS_RAISE_ERROR'               => array('4.3.0', ''),
            'HTTP_POSTREDIR_301'                    => array('4.3.0', ''),
            'HTTP_POSTREDIR_302'                    => array('4.3.0', ''),
            'HTTP_POSTREDIR_ALL'                    => array('4.3.0', ''),
            'HTTP_PROXY_HTTP'                       => array('4.3.0', ''),
            'HTTP_PROXY_HTTP_1_0'                   => array('4.3.0', ''),
            'HTTP_PROXY_SOCKS4'                     => array('4.3.0', ''),
            'HTTP_PROXY_SOCKS4A'                    => array('4.3.0', ''),
            'HTTP_PROXY_SOCKS5'                     => array('4.3.0', ''),
            'HTTP_PROXY_SOCKS5_HOSTNAME'            => array('4.3.0', ''),
            'HTTP_QUERYSTRING_TYPE_ARRAY'           => array('4.3.0', ''),
            'HTTP_QUERYSTRING_TYPE_BOOL'            => array('4.3.0', ''),
            'HTTP_QUERYSTRING_TYPE_FLOAT'           => array('4.3.0', ''),
            'HTTP_QUERYSTRING_TYPE_INT'             => array('4.3.0', ''),
            'HTTP_QUERYSTRING_TYPE_OBJECT'          => array('4.3.0', ''),
            'HTTP_QUERYSTRING_TYPE_STRING'          => array('4.3.0', ''),
            'HTTP_REDIRECT'                         => array('4.3.0', ''),
            'HTTP_REDIRECT_FOUND'                   => array('4.3.0', ''),
            'HTTP_REDIRECT_PERM'                    => array('4.3.0', ''),
            'HTTP_REDIRECT_POST'                    => array('4.3.0', ''),
            'HTTP_REDIRECT_PROXY'                   => array('4.3.0', ''),
            'HTTP_REDIRECT_TEMP'                    => array('4.3.0', ''),
            'HTTP_SSL_VERSION_ANY'                  => array('4.3.0', ''),
            'HTTP_SSL_VERSION_SSLv2'                => array('4.3.0', ''),
            'HTTP_SSL_VERSION_SSLv3'                => array('4.3.0', ''),
            'HTTP_SSL_VERSION_TLSv1'                => array('4.3.0', ''),
            'HTTP_SUPPORT'                          => array('4.3.0', ''),
            'HTTP_SUPPORT_ENCODINGS'                => array('4.3.0', ''),
            'HTTP_SUPPORT_EVENTS'                   => array('4.3.0', ''),
            'HTTP_SUPPORT_MAGICMIME'                => array('4.3.0', ''),
            'HTTP_SUPPORT_REQUESTS'                 => array('4.3.0', ''),
            'HTTP_SUPPORT_SSLREQUESTS'              => array('4.3.0', ''),
            'HTTP_URL_FROM_ENV'                     => array('4.3.0', ''),
            'HTTP_URL_JOIN_PATH'                    => array('4.3.0', ''),
            'HTTP_URL_JOIN_QUERY'                   => array('4.3.0', ''),
            'HTTP_URL_REPLACE'                      => array('4.3.0', ''),
            'HTTP_URL_STRIP_ALL'                    => array('4.3.0', ''),
            'HTTP_URL_STRIP_AUTH'                   => array('4.3.0', ''),
            'HTTP_URL_STRIP_FRAGMENT'               => array('4.3.0', ''),
            'HTTP_URL_STRIP_PASS'                   => array('4.3.0', ''),
            'HTTP_URL_STRIP_PATH'                   => array('4.3.0', ''),
            'HTTP_URL_STRIP_PORT'                   => array('4.3.0', ''),
            'HTTP_URL_STRIP_QUERY'                  => array('4.3.0', ''),
            'HTTP_URL_STRIP_USER'                   => array('4.3.0', ''),
            'HTTP_VERSION_1_0'                      => array('4.3.0', ''),
            'HTTP_VERSION_1_1'                      => array('4.3.0', ''),
            'HTTP_VERSION_ANY'                      => array('4.3.0', ''),
            'HTTP_VERSION_NONE'                     => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
