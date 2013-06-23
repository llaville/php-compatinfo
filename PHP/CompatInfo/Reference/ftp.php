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
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

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
class PHP_CompatInfo_Reference_Ftp
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'ftp';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

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
     * @link   http://www.php.net/manual/en/ref.ftp.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'ftp_cdup'                       => array('4.0.0', ''),
            'ftp_chdir'                      => array('4.0.0', ''),
            'ftp_connect'                    => array('4.0.0', ''),
            'ftp_delete'                     => array('4.0.0', ''),
            'ftp_fget'                       => array('4.0.0', ''),
            'ftp_fput'                       => array('4.0.0', ''),
            'ftp_get'                        => array('4.0.0', ''),
            'ftp_login'                      => array('4.0.0', ''),
            'ftp_mdtm'                       => array('4.0.0', ''),
            'ftp_mkdir'                      => array('4.0.0', ''),
            'ftp_nlist'                      => array('4.0.0', ''),
            'ftp_pasv'                       => array('4.0.0', ''),
            'ftp_put'                        => array('4.0.0', ''),
            'ftp_pwd'                        => array('4.0.0', ''),
            'ftp_quit'                       => array('4.0.0', ''),
            'ftp_rawlist'                    => array('4.0.0', ''),
            'ftp_rename'                     => array('4.0.0', ''),
            'ftp_rmdir'                      => array('4.0.0', ''),
            'ftp_site'                       => array('4.0.0', ''),
            'ftp_size'                       => array('4.0.0', ''),
            'ftp_systype'                    => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.3';       // 2000-10-11 (stable)
        $items = array(
            'ftp_exec'                       => array('4.0.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.2.0';       // 2002-04-22 (stable)
        $items = array(
            'ftp_close'                      => array('4.2.0', ''),
            'ftp_get_option'                 => array('4.2.0', ''),
            'ftp_set_option'                 => array('4.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.3.0';       // 2002-12-27 (stable)
        $items = array(
            'ftp_nb_continue'                => array('4.3.0', ''),
            'ftp_nb_fget'                    => array('4.3.0', ''),
            'ftp_nb_fput'                    => array('4.3.0', ''),
            'ftp_nb_get'                     => array('4.3.0', ''),
            'ftp_nb_put'                     => array('4.3.0', ''),
            'ftp_ssl_connect'                => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.0.0';       // 2004-07-13 (stable)
        $items = array(
            'ftp_alloc'                      => array('5.0.0', ''),
            'ftp_chmod'                      => array('5.0.0', ''),
            'ftp_raw'                        => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ftp.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'FTP_ASCII'                      => array('4.0.0', ''),
            'FTP_BINARY'                     => array('4.0.0', ''),
            'FTP_IMAGE'                      => array('4.0.0', ''),
            'FTP_TEXT'                       => array('4.0.0', ''),
            'FTP_TIMEOUT_SEC'                => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.3.0';       // 2002-12-27 (stable)
        $items = array(
            'FTP_AUTORESUME'                 => array('4.3.0', ''),
            'FTP_AUTOSEEK'                   => array('4.3.0', ''),
            'FTP_FAILED'                     => array('4.3.0', ''),
            'FTP_FINISHED'                   => array('4.3.0', ''),
            'FTP_MOREDATA'                   => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
