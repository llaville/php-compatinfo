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
 * @version  SVN: $Id$
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
    const REF_VERSION = '0.11.0';

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
        $phpMin = '5.0.0';
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

        $release = false;
        $items = array(
            'ssh2_auth_hostbased_file'       => array('5.0.0', ''),
            'ssh2_auth_none'                 => array('5.0.0', ''),
            'ssh2_auth_password'             => array('5.0.0', ''),
            'ssh2_auth_pubkey_file'          => array('5.0.0', ''),
            'ssh2_connect'                   => array('5.0.0', ''),
            'ssh2_exec'                      => array('5.0.0', ''),
            'ssh2_fetch_stream'              => array('5.0.0', ''),
            'ssh2_fingerprint'               => array('5.0.0', ''),
            'ssh2_forward_accept'            => array('5.0.0', ''),
            'ssh2_forward_listen'            => array('5.0.0', ''),
            'ssh2_methods_negotiated'        => array('5.0.0', ''),
            'ssh2_poll'                      => array('5.0.0', ''),
            'ssh2_publickey_add'             => array('5.0.0', ''),
            'ssh2_publickey_init'            => array('5.0.0', ''),
            'ssh2_publickey_list'            => array('5.0.0', ''),
            'ssh2_publickey_remove'          => array('5.0.0', ''),
            'ssh2_scp_recv'                  => array('5.0.0', ''),
            'ssh2_scp_send'                  => array('5.0.0', ''),
            'ssh2_sftp'                      => array('5.0.0', ''),
            'ssh2_sftp_lstat'                => array('5.0.0', ''),
            'ssh2_sftp_mkdir'                => array('5.0.0', ''),
            'ssh2_sftp_readlink'             => array('5.0.0', ''),
            'ssh2_sftp_realpath'             => array('5.0.0', ''),
            'ssh2_sftp_rename'               => array('5.0.0', ''),
            'ssh2_sftp_rmdir'                => array('5.0.0', ''),
            'ssh2_sftp_stat'                 => array('5.0.0', ''),
            'ssh2_sftp_symlink'              => array('5.0.0', ''),
            'ssh2_sftp_unlink'               => array('5.0.0', ''),
            'ssh2_shell'                     => array('5.0.0', ''),
            'ssh2_tunnel'                    => array('5.0.0', ''),
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

        $release = false;
        $items = array(
            'SSH2_DEFAULT_TERMINAL'             => array('5.0.0', ''),
            'SSH2_DEFAULT_TERM_HEIGHT'          => array('5.0.0', ''),
            'SSH2_DEFAULT_TERM_UNIT'            => array('5.0.0', ''),
            'SSH2_DEFAULT_TERM_WIDTH'           => array('5.0.0', ''),
            'SSH2_FINGERPRINT_HEX'              => array('5.0.0', ''),
            'SSH2_FINGERPRINT_MD5'              => array('5.0.0', ''),
            'SSH2_FINGERPRINT_RAW'              => array('5.0.0', ''),
            'SSH2_FINGERPRINT_SHA1'             => array('5.0.0', ''),
            'SSH2_POLLERR'                      => array('5.0.0', ''),
            'SSH2_POLLEXT'                      => array('5.0.0', ''),
            'SSH2_POLLHUP'                      => array('5.0.0', ''),
            'SSH2_POLLIN'                       => array('5.0.0', ''),
            'SSH2_POLLNVAL'                     => array('5.0.0', ''),
            'SSH2_POLLOUT'                      => array('5.0.0', ''),
            'SSH2_POLL_CHANNEL_CLOSED'          => array('5.0.0', ''),
            'SSH2_POLL_LISTENER_CLOSED'         => array('5.0.0', ''),
            'SSH2_POLL_SESSION_CLOSED'          => array('5.0.0', ''),
            'SSH2_STREAM_STDERR'                => array('5.0.0', ''),
            'SSH2_STREAM_STDIO'                 => array('5.0.0', ''),
            'SSH2_TERM_UNIT_CHARS'              => array('5.0.0', ''),
            'SSH2_TERM_UNIT_PIXELS'             => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
