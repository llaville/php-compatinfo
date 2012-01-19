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
class PHP_CompatInfo_Reference_OAuth implements PHP_CompatInfo_Reference
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
            'OAuth' => array('5.1.0', '', '1.0-dev')
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
                'OAuth'                          => array('5.1.0', ''),
                'OAuthProvider'                  => array('5.1.0', ''),
                'OAuthException'                 => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.oauth.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'oauth_get_sbs'                  => array('5.1.0', ''),
                'oauth_urlencode'                => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/oauth.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'OAUTH_SIG_METHOD_HMACSHA1'      => array('5.1.0', ''),
                'OAUTH_SIG_METHOD_HMACSHA256'    => array('5.1.0', ''),
                'OAUTH_SIG_METHOD_RSASHA1'       => array('5.1.0', ''),
                'OAUTH_SIG_METHOD_PLAINTEXT'     => array('5.1.0', ''),
                'OAUTH_AUTH_TYPE_AUTHORIZATION'  => array('5.1.0', ''),
                'OAUTH_AUTH_TYPE_URI'            => array('5.1.0', ''),
                'OAUTH_AUTH_TYPE_FORM'           => array('5.1.0', ''),
                'OAUTH_AUTH_TYPE_NONE'           => array('5.1.0', ''),
                'OAUTH_HTTP_METHOD_GET'          => array('5.1.0', ''),
                'OAUTH_HTTP_METHOD_POST'         => array('5.1.0', ''),
                'OAUTH_HTTP_METHOD_PUT'          => array('5.1.0', ''),
                'OAUTH_HTTP_METHOD_HEAD'         => array('5.1.0', ''),
                'OAUTH_HTTP_METHOD_DELETE'       => array('5.1.0', ''),
                'OAUTH_REQENGINE_STREAMS'        => array('5.1.0', ''),
                'OAUTH_REQENGINE_CURL'           => array('5.1.0', ''),
                'OAUTH_SSLCHECK_NONE'            => array('5.1.0', ''),
                'OAUTH_SSLCHECK_HOST'            => array('5.1.0', ''),
                'OAUTH_SSLCHECK_PEER'            => array('5.1.0', ''),
                'OAUTH_SSLCHECK_BOTH'            => array('5.1.0', ''),
                'OAUTH_OK'                       => array('5.1.0', ''),
                'OAUTH_BAD_NONCE'                => array('5.1.0', ''),
                'OAUTH_BAD_TIMESTAMP'            => array('5.1.0', ''),
                'OAUTH_CONSUMER_KEY_UNKNOWN'     => array('5.1.0', ''),
                'OAUTH_CONSUMER_KEY_REFUSED'     => array('5.1.0', ''),
                'OAUTH_INVALID_SIGNATURE'        => array('5.1.0', ''),
                'OAUTH_TOKEN_USED'               => array('5.1.0', ''),
                'OAUTH_TOKEN_EXPIRED'            => array('5.1.0', ''),
                'OAUTH_TOKEN_REVOKED'            => array('5.1.0', ''),
                'OAUTH_TOKEN_REJECTED'           => array('5.1.0', ''),
                'OAUTH_VERIFIER_INVALID'         => array('5.1.0', ''),
                'OAUTH_PARAMETER_ABSENT'         => array('5.1.0', ''),
                'OAUTH_SIGNATURE_METHOD_REJECTED'
                                                 => array('5.1.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
