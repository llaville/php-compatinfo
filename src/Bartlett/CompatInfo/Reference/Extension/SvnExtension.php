<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SvnExtension extends AbstractReference
{
    const REF_NAME    = 'svn';
    const REF_VERSION = '1.0.2';  // 2012-03-27 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1
        if (version_compare($version, '0.1', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.2
        if (version_compare($version, '0.2', 'ge')) {
            $release = $this->getR00200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.3
        if (version_compare($version, '0.3', 'ge')) {
            $release = $this->getR00300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.4
        if (version_compare($version, '0.4', 'ge')) {
            $release = $this->getR00400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 0.5
        if (version_compare($version, '0.5', 'ge')) {
            $release = $this->getR00500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.1
        if (version_compare($version, '1.0.1', 'ge')) {
            $release = $this->getR10001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-05-29',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_SVN_AUTH_PARAM_IGNORE_SSL_VERIFY_ERRORS'   => null,
            'SVN_AUTH_PARAM_CONFIG'                         => null,
            'SVN_AUTH_PARAM_CONFIG_DIR'                     => null,
            'SVN_AUTH_PARAM_DEFAULT_PASSWORD'               => null,
            'SVN_AUTH_PARAM_DEFAULT_USERNAME'               => null,
            'SVN_AUTH_PARAM_DONT_STORE_PASSWORDS'           => null,
            'SVN_AUTH_PARAM_NON_INTERACTIVE'                => null,
            'SVN_AUTH_PARAM_NO_AUTH_CACHE'                  => null,
            'SVN_AUTH_PARAM_SERVER_GROUP'                   => null,
            'SVN_AUTH_PARAM_SSL_SERVER_CERT_INFO'           => null,
            'SVN_AUTH_PARAM_SSL_SERVER_FAILURES'            => null,
            'SVN_FS_CONFIG_FS_TYPE'                         => null,
            'SVN_FS_TYPE_BDB'                               => null,
            'SVN_FS_TYPE_FSFS'                              => null,
            'SVN_NODE_DIR'                                  => null,
            'SVN_NODE_FILE'                                 => null,
            'SVN_NODE_NONE'                                 => null,
            'SVN_NODE_UNKNOWN'                              => null,
            'SVN_PROP_REVISION_AUTHOR'                      => null,
            'SVN_PROP_REVISION_DATE'                        => null,
            'SVN_PROP_REVISION_LOG'                         => null,
            'SVN_PROP_REVISION_ORIG_DATE'                   => null,
            'SVN_WC_STATUS_ADDED'                           => null,
            'SVN_WC_STATUS_CONFLICTED'                      => null,
            'SVN_WC_STATUS_DELETED'                         => null,
            'SVN_WC_STATUS_EXTERNAL'                        => null,
            'SVN_WC_STATUS_IGNORED'                         => null,
            'SVN_WC_STATUS_INCOMPLETE'                      => null,
            'SVN_WC_STATUS_MERGED'                          => null,
            'SVN_WC_STATUS_MISSING'                         => null,
            'SVN_WC_STATUS_MODIFIED'                        => null,
            'SVN_WC_STATUS_NONE'                            => null,
            'SVN_WC_STATUS_NORMAL'                          => null,
            'SVN_WC_STATUS_OBSTRUCTED'                      => null,
            'SVN_WC_STATUS_REPLACED'                        => null,
            'SVN_WC_STATUS_UNVERSIONED'                     => null,
        );
        $release->functions = array(
            'svn_add'                                       => null,
            'svn_auth_get_parameter'                        => null,
            'svn_auth_set_parameter'                        => null,
            'svn_cat'                                       => null,
            'svn_checkout'                                  => null,
            'svn_cleanup'                                   => null,
            'svn_client_version'                            => null,
            'svn_commit'                                    => null,
            'svn_diff'                                      => null,
            'svn_fs_check_path'                             => null,
            'svn_fs_dir_entries'                            => null,
            'svn_fs_file_contents'                          => null,
            'svn_fs_file_length'                            => null,
            'svn_fs_node_created_rev'                       => null,
            'svn_fs_node_prop'                              => null,
            'svn_fs_revision_prop'                          => null,
            'svn_fs_revision_root'                          => null,
            'svn_fs_youngest_rev'                           => null,
            'svn_log'                                       => null,
            'svn_ls'                                        => null,
            'svn_repos_create'                              => null,
            'svn_repos_fs'                                  => null,
            'svn_repos_hotcopy'                             => null,
            'svn_repos_open'                                => null,
            'svn_repos_recover'                             => null,
            'svn_status'                                    => null,
            'svn_update'                                    => null,
        );
        return $release;
    }

    protected function getR00200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-03-20',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'svn_fs_abort_txn'                              => null,
            'svn_fs_apply_text'                             => null,
            'svn_fs_begin_txn2'                             => null,
            'svn_fs_change_node_prop'                       => null,
            'svn_fs_contents_changed'                       => null,
            'svn_fs_copy'                                   => null,
            'svn_fs_delete'                                 => null,
            'svn_fs_is_dir'                                 => null,
            'svn_fs_is_file'                                => null,
            'svn_fs_make_dir'                               => null,
            'svn_fs_make_file'                              => null,
            'svn_fs_props_changed'                          => null,
            'svn_fs_txn_root'                               => null,
            'svn_import'                                    => null,
            'svn_repos_fs_begin_txn_for_commit'             => null,
            'svn_repos_fs_commit_txn'                       => null,
        );
        return $release;
    }

    protected function getR00300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.3',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-02-09',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Svn'                                           => null,
            'SvnNode'                                       => null,
            'SvnWc'                                         => null,
            'SvnWcSchedule'                                 => null,
        );
        $release->constants = array(
            'SVN_ALL'                                       => null,
            'SVN_DISCOVER_CHANGED_PATHS'                    => null,
            'SVN_NON_RECURSIVE'                             => null,
            'SVN_NO_IGNORE'                                 => null,
            'SVN_OMIT_MESSAGES'                             => null,
            'SVN_REVISION_BASE'                             => null,
            'SVN_REVISION_COMMITTED'                        => null,
            'SVN_REVISION_HEAD'                             => null,
            'SVN_REVISION_INITIAL'                          => null,
            'SVN_REVISION_PREV'                             => null,
            'SVN_SHOW_UPDATES'                              => null,
            'SVN_STOP_ON_COPY'                              => null,
            'SVN_WC_SCHEDULE_ADD'                           => null,
            'SVN_WC_SCHEDULE_DELETE'                        => null,
            'SVN_WC_SCHEDULE_NORMAL'                        => null,
            'SVN_WC_SCHEDULE_REPLACE'                       => null,
        );
        $release->functions = array(
            'svn_blame'                                     => null,
            'svn_copy'                                      => null,
            'svn_export'                                    => null,
            'svn_info'                                      => null,
            'svn_resolved'                                  => null,
            'svn_revert'                                    => null,
            'svn_switch'                                    => null,
        );
        return $release;
    }

    protected function getR00400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-06-03',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'svn_delete'                                    => null,
            'svn_mkdir'                                     => null,
            'svn_move'                                      => null,
            'svn_propget'                                   => null,
            'svn_proplist'                                  => null,
        );
        return $release;
    }

    protected function getR00500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.5',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2008-10-09',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'svn_config_ensure'                             => null,
            'svn_lock'                                      => null,
            'svn_unlock'                                    => null,
        );
        return $release;
    }

    protected function getR10001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-12-08',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'SVN_REVISION_UNSPECIFIED'                      => null,
        );
        return $release;
    }
}
