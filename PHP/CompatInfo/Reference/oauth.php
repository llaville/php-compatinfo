<?php
/**
 * Version informations about OAuth extension
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
 * All interfaces, classes, functions, constants about OAuth extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.oauth.php
 */
class PHP_CompatInfo_Reference_OAuth
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'OAuth';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0-dev';

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
        $phpMin = '5.1.0';
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
            'OAuth'                          => array('5.1.0', ''),
            'OAuthException'                 => array('5.1.0', ''),
            'OAuthProvider'                  => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.oauth.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'oauth_get_sbs'                  => array('5.1.0', ''),
            'oauth_urlencode'                => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/oauth.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'OAUTH_AUTH_TYPE_AUTHORIZATION'  => array('5.1.0', ''),
            'OAUTH_AUTH_TYPE_FORM'           => array('5.1.0', ''),
            'OAUTH_AUTH_TYPE_NONE'           => array('5.1.0', ''),
            'OAUTH_AUTH_TYPE_URI'            => array('5.1.0', ''),
            'OAUTH_BAD_NONCE'                => array('5.1.0', ''),
            'OAUTH_BAD_TIMESTAMP'            => array('5.1.0', ''),
            'OAUTH_CONSUMER_KEY_REFUSED'     => array('5.1.0', ''),
            'OAUTH_CONSUMER_KEY_UNKNOWN'     => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_DELETE'       => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_GET'          => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_HEAD'         => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_POST'         => array('5.1.0', ''),
            'OAUTH_HTTP_METHOD_PUT'          => array('5.1.0', ''),
            'OAUTH_INVALID_SIGNATURE'        => array('5.1.0', ''),
            'OAUTH_OK'                       => array('5.1.0', ''),
            'OAUTH_PARAMETER_ABSENT'         => array('5.1.0', ''),
            'OAUTH_REQENGINE_CURL'           => array('5.1.0', ''),
            'OAUTH_REQENGINE_STREAMS'        => array('5.1.0', ''),
            'OAUTH_SIGNATURE_METHOD_REJECTED'
                                             => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_HMACSHA1'      => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_HMACSHA256'    => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_PLAINTEXT'     => array('5.1.0', ''),
            'OAUTH_SIG_METHOD_RSASHA1'       => array('5.1.0', ''),
            'OAUTH_SSLCHECK_BOTH'            => array('5.1.0', ''),
            'OAUTH_SSLCHECK_HOST'            => array('5.1.0', ''),
            'OAUTH_SSLCHECK_NONE'            => array('5.1.0', ''),
            'OAUTH_SSLCHECK_PEER'            => array('5.1.0', ''),
            'OAUTH_TOKEN_EXPIRED'            => array('5.1.0', ''),
            'OAUTH_TOKEN_REJECTED'           => array('5.1.0', ''),
            'OAUTH_TOKEN_REVOKED'            => array('5.1.0', ''),
            'OAUTH_TOKEN_USED'               => array('5.1.0', ''),
            'OAUTH_VERIFIER_INVALID'         => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
