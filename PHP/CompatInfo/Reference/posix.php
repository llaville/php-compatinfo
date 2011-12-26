<?php
/**
 * Version informations about posix extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
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
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.posix.php
 */
class PHP_CompatInfo_Reference_Posix implements PHP_CompatInfo_Reference
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
            'posix' => array('4.0.0', '', '306939')
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
     * @link   http://www.php.net/manual/en/ref.posix.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
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
                'posix_isatty'                      => array('4.0.0', ''),
                'posix_kill'                        => array('4.0.0', ''),
                'posix_mkfifo'                      => array('4.0.0', ''),
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
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'posix_access'                      => array('5.1.0', ''),
                'posix_initgroups'                  => array('5.2.0', ''),
                'posix_mknod'                       => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/posix.constants.php
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
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
