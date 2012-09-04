<?php
/**
 * Version informations about posix extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about posix extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.posix.php
 */
class PHP_CompatInfo_Reference_Posix
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'posix';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '306939';

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
     * @link   http://www.php.net/manual/en/ref.posix.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'posix_access'                      => array('5.1.0', ''),
            'posix_ctermid'                     => array('4.0.0', ''),
            'posix_errno'                       => array('4.2.0', ''),
            'posix_get_last_error'              => array('4.2.0', ''),
            'posix_getcwd'                      => array('4.0.0', ''),
            'posix_getegid'                     => array('4.0.0', ''),
            'posix_geteuid'                     => array('4.0.0', ''),
            'posix_getgid'                      => array('4.0.0', ''),
            'posix_getgrgid'                    => array('4.0.0', ''),
            'posix_getgrnam'                    => array('4.0.0', ''),
            'posix_getgroups'                   => array('4.0.0', ''),
            'posix_getlogin'                    => array('4.0.0', ''),
            'posix_getpgid'                     => array('4.0.0', ''),
            'posix_getpgrp'                     => array('4.0.0', ''),
            'posix_getpid'                      => array('4.0.0', ''),
            'posix_getppid'                     => array('4.0.0', ''),
            'posix_getpwnam'                    => array('4.0.0', ''),
            'posix_getpwuid'                    => array('4.0.0', ''),
            'posix_getrlimit'                   => array('4.0.0', ''),
            'posix_getsid'                      => array('4.0.0', ''),
            'posix_getuid'                      => array('4.0.0', ''),
            'posix_initgroups'                  => array('5.2.0', ''),
            'posix_isatty'                      => array('4.0.0', ''),
            'posix_kill'                        => array('4.0.0', ''),
            'posix_mkfifo'                      => array('4.0.0', ''),
            'posix_mknod'                       => array('5.1.0', ''),
            'posix_setegid'                     => array('4.0.2', ''),
            'posix_seteuid'                     => array('4.0.2', ''),
            'posix_setgid'                      => array('4.0.0', ''),
            'posix_setpgid'                     => array('4.0.0', ''),
            'posix_setsid'                      => array('4.0.0', ''),
            'posix_setuid'                      => array('4.0.0', ''),
            'posix_strerror'                    => array('4.2.0', ''),
            'posix_times'                       => array('4.0.0', ''),
            'posix_ttyname'                     => array('4.0.0', ''),
            'posix_uname'                       => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/posix.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            // used only by posix_access
            'POSIX_F_OK'                        => array('5.1.0', ''),
            'POSIX_X_OK'                        => array('5.1.0', ''),
            'POSIX_W_OK'                        => array('5.1.0', ''),
            'POSIX_R_OK'                        => array('5.1.0', ''),
            // used only by posix_mknod
            'POSIX_S_IFREG'                     => array('5.1.0', ''),
            'POSIX_S_IFCHR'                     => array('5.1.0', ''),
            'POSIX_S_IFBLK'                     => array('5.1.0', ''),
            'POSIX_S_IFIFO'                     => array('5.1.0', ''),
            'POSIX_S_IFSOCK'                    => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
