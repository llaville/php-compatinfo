<?php
/**
 * Version informations about ssh2 extension
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
 * All interfaces, classes, functions, constants about ssh2 extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.ssh2.php
 */
class PHP_CompatInfo_Reference_Ssh2
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'ssh2';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.12';

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
        $phpMin = '4.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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
     * @link   http://www.php.net/manual/en/ref.ssh2.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.5';         // 2005-01-11
        $items = array(
            'ssh2_auth_none'                 => array('4.0.0', ''),
            'ssh2_auth_password'             => array('4.0.0', ''),
            'ssh2_auth_pubkey_file'          => array('4.0.0', ''),
            'ssh2_connect'                   => array('4.0.0', ''),
            'ssh2_exec'                      => array('4.0.0', ''),
            'ssh2_fetch_stream'              => array('4.0.0', ''),
            'ssh2_fingerprint'               => array('4.0.0', ''),
            'ssh2_forward_accept'            => array('4.0.0', ''),
            'ssh2_forward_listen'            => array('4.0.0', ''),
            'ssh2_methods_negotiated'        => array('4.0.0', ''),
            'ssh2_scp_recv'                  => array('4.0.0', ''),
            'ssh2_scp_send'                  => array('4.0.0', ''),
            'ssh2_sftp'                      => array('4.0.0', ''),
            'ssh2_sftp_lstat'                => array('4.0.0', ''),
            'ssh2_sftp_mkdir'                => array('4.0.0', ''),
            'ssh2_sftp_readlink'             => array('4.0.0', ''),
            'ssh2_sftp_realpath'             => array('4.0.0', ''),
            'ssh2_sftp_rename'               => array('4.0.0', ''),
            'ssh2_sftp_rmdir'                => array('4.0.0', ''),
            'ssh2_sftp_stat'                 => array('4.0.0', ''),
            'ssh2_sftp_symlink'              => array('4.0.0', ''),
            'ssh2_sftp_unlink'               => array('4.0.0', ''),
            'ssh2_shell'                     => array('4.0.0', ''),
            'ssh2_tunnel'                    => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.7';         // 2005-02-24
        $items = array(
            'ssh2_auth_hostbased_file'       => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.8';         // 2005-05-17
        $items = array(
            'ssh2_poll'                      => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.10';        // 2005-11-01
        $items = array(
            'ssh2_publickey_add'             => array('4.0.0', ''),
            'ssh2_publickey_init'            => array('4.0.0', ''),
            'ssh2_publickey_list'            => array('4.0.0', ''),
            'ssh2_publickey_remove'          => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.12';        // 2012-10-15
        $items = array(
            'ssh2_sftp_chmod'                => array('4.0.0', ''),
            'ssh2_auth_agent'                => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ssh2.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.5';         // 2005-01-11
        $items = array(
            'SSH2_TERM_UNIT_CHARS'              => array('4.0.0', ''),
            'SSH2_TERM_UNIT_PIXELS'             => array('4.0.0', ''),
            'SSH2_STREAM_STDERR'                => array('4.0.0', ''),
            'SSH2_STREAM_STDIO'                 => array('4.0.0', ''),
            'SSH2_DEFAULT_TERMINAL'             => array('4.0.0', ''),
            'SSH2_DEFAULT_TERM_HEIGHT'          => array('4.0.0', ''),
            'SSH2_DEFAULT_TERM_UNIT'            => array('4.0.0', ''),
            'SSH2_DEFAULT_TERM_WIDTH'           => array('4.0.0', ''),
            'SSH2_FINGERPRINT_HEX'              => array('4.0.0', ''),
            'SSH2_FINGERPRINT_MD5'              => array('4.0.0', ''),
            'SSH2_FINGERPRINT_RAW'              => array('4.0.0', ''),
            'SSH2_FINGERPRINT_SHA1'             => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.8';         // 2005-05-17
        $items = array(
            'SSH2_POLLERR'                      => array('4.0.0', ''),
            'SSH2_POLLEXT'                      => array('4.0.0', ''),
            'SSH2_POLLHUP'                      => array('4.0.0', ''),
            'SSH2_POLLIN'                       => array('4.0.0', ''),
            'SSH2_POLLNVAL'                     => array('4.0.0', ''),
            'SSH2_POLLOUT'                      => array('4.0.0', ''),
            'SSH2_POLL_CHANNEL_CLOSED'          => array('4.0.0', ''),
            'SSH2_POLL_LISTENER_CLOSED'         => array('4.0.0', ''),
            'SSH2_POLL_SESSION_CLOSED'          => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
