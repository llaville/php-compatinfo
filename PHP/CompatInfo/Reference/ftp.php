<?php
/**
 * Version informations about ftp extension
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

require_once 'PHP/CompatInfo/Reference.php';

/**
 * All interfaces, classes, functions, constants about ftp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.ftp.php
 */
class PHP_CompatInfo_Reference_Ftp implements PHP_CompatInfo_Reference
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
            'ftp' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.ftp.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'ftp_cdup'                       => array('4.0.0', ''),
                'ftp_chdir'                      => array('4.0.0', ''),
                'ftp_close'                      => array('4.2.0', ''),
                'ftp_connect'                    => array('4.0.0', ''),
                'ftp_delete'                     => array('4.0.0', ''),
                'ftp_exec'                       => array('4.0.3', ''),
                'ftp_fget'                       => array('4.0.0', ''),
                'ftp_fput'                       => array('4.0.0', ''),
                'ftp_get_option'                 => array('4.2.0', ''),
                'ftp_get'                        => array('4.0.0', ''),              
                'ftp_login'                      => array('4.0.0', ''),
                'ftp_mdtm'                       => array('4.0.0', ''),
                'ftp_mkdir'                      => array('4.0.0', ''),
                'ftp_nb_continue'                => array('4.3.0', ''),
                'ftp_nb_fget'                    => array('4.3.0', ''),
                'ftp_nb_fput'                    => array('4.3.0', ''),
                'ftp_nb_get'                     => array('4.3.0', ''),
                'ftp_nb_put'                     => array('4.3.0', ''),
                'ftp_nlist'                      => array('4.0.0', ''),
                'ftp_pasv'                       => array('4.0.0', ''),
                'ftp_put'                        => array('4.0.0', ''),
                'ftp_pwd'                        => array('4.0.0', ''),
                'ftp_quit'                       => array('4.0.0', ''),
                'ftp_rawlist'                    => array('4.0.0', ''),
                'ftp_rename'                     => array('4.0.0', ''),
                'ftp_rmdir'                      => array('4.0.0', ''),
                'ftp_set_option'                 => array('4.2.0', ''),
                'ftp_site'                       => array('4.0.0', ''),
                'ftp_size'                       => array('4.0.0', ''),
                'ftp_ssl_connect'                => array('4.3.0', ''),
                'ftp_systype'                    => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'ftp_alloc'                      => array('5.0.0', ''),
                'ftp_chmod'                      => array('5.0.0', ''),
                'ftp_raw'                        => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ftp.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'FTP_ASCII'                      => array('4.0.0', ''),
                'FTP_TEXT'                       => array('4.0.0', ''),
                'FTP_BINARY'                     => array('4.0.0', ''),
                'FTP_IMAGE'                      => array('4.0.0', ''),
                'FTP_TIMEOUT_SEC'                => array('4.0.0', ''),
                'FTP_AUTOSEEK'                   => array('4.3.0', ''),
                'FTP_AUTORESUME'                 => array('4.3.0', ''),
                'FTP_FAILED'                     => array('4.3.0', ''),
                'FTP_FINISHED'                   => array('4.3.0', ''),
                'FTP_MOREDATA'                   => array('4.3.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
