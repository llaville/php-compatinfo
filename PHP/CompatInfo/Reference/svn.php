<?php
/**
 * Version informations about svn extension
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
 * All interfaces, classes, functions, constants about svn extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.svn.php
 * @since    Class available since Release 2.13.0
 */
class PHP_CompatInfo_Reference_Svn
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'svn';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0.2';

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

        $release = '0.3';         // 2008-02-09
        $items = array(
            'Svn'                                   => array('4.0.0', ''),
            'SvnNode'                               => array('4.0.0', ''),
            'SvnWc'                                 => array('4.0.0', ''),
            'SvnWcSchedule'                         => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.svn.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.1';         // 2005-05-29
        $items = array(
            'svn_add'                               => array('4.0.0', ''),
            'svn_auth_get_parameter'                => array('4.0.0', ''),
            'svn_auth_set_parameter'                => array('4.0.0', ''),
            'svn_cat'                               => array('4.0.0', ''),
            'svn_checkout'                          => array('4.0.0', ''),
            'svn_cleanup'                           => array('4.0.0', ''),
            'svn_client_version'                    => array('4.0.0', ''),
            'svn_commit'                            => array('4.0.0', ''),
            'svn_diff'                              => array('4.0.0', ''),
            'svn_fs_check_path'                     => array('4.0.0', ''),
            'svn_fs_dir_entries'                    => array('4.0.0', ''),
            'svn_fs_file_contents'                  => array('4.0.0', ''),
            'svn_fs_file_length'                    => array('4.0.0', ''),
            'svn_fs_node_created_rev'               => array('4.0.0', ''),
            'svn_fs_node_prop'                      => array('4.0.0', ''),
            'svn_fs_revision_prop'                  => array('4.0.0', ''),
            'svn_fs_revision_root'                  => array('4.0.0', ''),
            'svn_fs_youngest_rev'                   => array('4.0.0', ''),
            'svn_log'                               => array('4.0.0', ''),
            'svn_ls'                                => array('4.0.0', ''),
            'svn_repos_create'                      => array('4.0.0', ''),
            'svn_repos_fs'                          => array('4.0.0', ''),
            'svn_repos_hotcopy'                     => array('4.0.0', ''),
            'svn_repos_open'                        => array('4.0.0', ''),
            'svn_repos_recover'                     => array('4.0.0', ''),
            'svn_status'                            => array('4.0.0', ''),
            'svn_update'                            => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.2';         // 2006-03-20
        $items = array(
            'svn_fs_abort_txn'                      => array('4.0.0', ''),
            'svn_fs_apply_text'                     => array('4.0.0', ''),
            'svn_fs_begin_txn2'                     => array('4.0.0', ''),
            'svn_fs_change_node_prop'               => array('4.0.0', ''),
            'svn_fs_contents_changed'               => array('4.0.0', ''),
            'svn_fs_copy'                           => array('4.0.0', ''),
            'svn_fs_delete'                         => array('4.0.0', ''),
            'svn_fs_is_dir'                         => array('4.0.0', ''),
            'svn_fs_is_file'                        => array('4.0.0', ''),
            'svn_fs_make_dir'                       => array('4.0.0', ''),
            'svn_fs_make_file'                      => array('4.0.0', ''),
            'svn_fs_props_changed'                  => array('4.0.0', ''),
            'svn_fs_txn_root'                       => array('4.0.0', ''),
            'svn_import'                            => array('4.0.0', ''),
            'svn_repos_fs_begin_txn_for_commit'     => array('4.0.0', ''),
            'svn_repos_fs_commit_txn'               => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.3';         // 2008-02-09
        $items = array(
            'svn_blame'                             => array('4.0.0', ''),
            'svn_copy'                              => array('4.0.0', ''),
            'svn_export'                            => array('4.0.0', ''),
            'svn_info'                              => array('4.0.0', ''),
            'svn_resolved'                          => array('4.0.0', ''),
            'svn_revert'                            => array('4.0.0', ''),
            'svn_switch'                            => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.4';         // 2008-06-03
        $items = array(
            'svn_delete'                            => array('4.0.0', ''),
            'svn_mkdir'                             => array('4.0.0', ''),
            'svn_move'                              => array('4.0.0', ''),
            'svn_propget'                           => array('4.0.0', ''),
            'svn_proplist'                          => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.5';         // 2008-10-09
        $items = array(
            'svn_config_ensure'                     => array('4.0.0', ''),
            'svn_lock'                              => array('4.0.0', ''),
            'svn_unlock'                            => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/svn.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.1';         // 2005-05-29
        $items = array(
            'PHP_SVN_AUTH_PARAM_IGNORE_SSL_VERIFY_ERRORS'
                                                    => array('4.0.0', ''),
            'SVN_AUTH_PARAM_CONFIG'                 => array('4.0.0', ''),
            'SVN_AUTH_PARAM_CONFIG_DIR'             => array('4.0.0', ''),
            'SVN_AUTH_PARAM_DEFAULT_PASSWORD'       => array('4.0.0', ''),
            'SVN_AUTH_PARAM_DEFAULT_USERNAME'       => array('4.0.0', ''),
            'SVN_AUTH_PARAM_DONT_STORE_PASSWORDS'   => array('4.0.0', ''),
            'SVN_AUTH_PARAM_NON_INTERACTIVE'        => array('4.0.0', ''),
            'SVN_AUTH_PARAM_NO_AUTH_CACHE'          => array('4.0.0', ''),
            'SVN_AUTH_PARAM_SERVER_GROUP'           => array('4.0.0', ''),
            'SVN_AUTH_PARAM_SSL_SERVER_CERT_INFO'   => array('4.0.0', ''),
            'SVN_AUTH_PARAM_SSL_SERVER_FAILURES'    => array('4.0.0', ''),
            'SVN_FS_CONFIG_FS_TYPE'                 => array('4.0.0', ''),
            'SVN_FS_TYPE_BDB'                       => array('4.0.0', ''),
            'SVN_FS_TYPE_FSFS'                      => array('4.0.0', ''),
            'SVN_NODE_DIR'                          => array('4.0.0', ''),
            'SVN_NODE_FILE'                         => array('4.0.0', ''),
            'SVN_NODE_NONE'                         => array('4.0.0', ''),
            'SVN_NODE_UNKNOWN'                      => array('4.0.0', ''),
            'SVN_PROP_REVISION_AUTHOR'              => array('4.0.0', ''),
            'SVN_PROP_REVISION_DATE'                => array('4.0.0', ''),
            'SVN_PROP_REVISION_LOG'                 => array('4.0.0', ''),
            'SVN_PROP_REVISION_ORIG_DATE'           => array('4.0.0', ''),
            'SVN_WC_STATUS_ADDED'                   => array('4.0.0', ''),
            'SVN_WC_STATUS_CONFLICTED'              => array('4.0.0', ''),
            'SVN_WC_STATUS_DELETED'                 => array('4.0.0', ''),
            'SVN_WC_STATUS_EXTERNAL'                => array('4.0.0', ''),
            'SVN_WC_STATUS_IGNORED'                 => array('4.0.0', ''),
            'SVN_WC_STATUS_INCOMPLETE'              => array('4.0.0', ''),
            'SVN_WC_STATUS_MERGED'                  => array('4.0.0', ''),
            'SVN_WC_STATUS_MISSING'                 => array('4.0.0', ''),
            'SVN_WC_STATUS_MODIFIED'                => array('4.0.0', ''),
            'SVN_WC_STATUS_NONE'                    => array('4.0.0', ''),
            'SVN_WC_STATUS_NORMAL'                  => array('4.0.0', ''),
            'SVN_WC_STATUS_OBSTRUCTED'              => array('4.0.0', ''),
            'SVN_WC_STATUS_REPLACED'                => array('4.0.0', ''),
            'SVN_WC_STATUS_UNVERSIONED'             => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '0.3';         // 2008-02-09
        $items = array(
            'SVN_ALL'                               => array('4.0.0', ''),
            'SVN_DISCOVER_CHANGED_PATHS'            => array('4.0.0', ''),
            'SVN_NON_RECURSIVE'                     => array('4.0.0', ''),
            'SVN_NO_IGNORE'                         => array('4.0.0', ''),
            'SVN_OMIT_MESSAGES'                     => array('4.0.0', ''),
            'SVN_REVISION_BASE'                     => array('4.0.0', ''),
            'SVN_REVISION_COMMITTED'                => array('4.0.0', ''),
            'SVN_REVISION_HEAD'                     => array('4.0.0', ''),
            'SVN_REVISION_INITIAL'                  => array('4.0.0', ''),
            'SVN_REVISION_PREV'                     => array('4.0.0', ''),
            'SVN_SHOW_UPDATES'                      => array('4.0.0', ''),
            'SVN_STOP_ON_COPY'                      => array('4.0.0', ''),
            'SVN_WC_SCHEDULE_ADD'                   => array('4.0.0', ''),
            'SVN_WC_SCHEDULE_DELETE'                => array('4.0.0', ''),
            'SVN_WC_SCHEDULE_NORMAL'                => array('4.0.0', ''),
            'SVN_WC_SCHEDULE_REPLACE'               => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.0.1';       // 2010-12-08
        $items = array(
            'SVN_REVISION_UNSPECIFIED'              => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
