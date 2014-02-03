<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class CoreExtension extends AbstractReference
{
    const REF_NAME    = 'Core';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.10
        if (version_compare($version, '4.3.10', 'ge')) {
            $release = $this->getR40310();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.4.0
        if (version_compare($version, '4.4.0', 'ge')) {
            $release = $this->getR40400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.2
        if (version_compare($version, '5.0.2', 'ge')) {
            $release = $this->getR50002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.7
        if (version_compare($version, '5.2.7', 'ge')) {
            $release = $this->getR50207();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.4
        if (version_compare($version, '5.3.4', 'ge')) {
            $release = $this->getR50304();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.6
        if (version_compare($version, '5.3.6', 'ge')) {
            $release = $this->getR50306();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.7
        if (version_compare($version, '5.3.7', 'ge')) {
            $release = $this->getR50307();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
        
        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'SMTP'                          => null,
            'allow_url_fopen'               => null,
            'allow_url_include'             => null,
            'always_populate_raw_post_data' => null,
            'arg_separator.input'           => null,
            'arg_separator.output'          => null,
            'asp_tags'                      => null,
            'auto_append_file'              => null,
            'auto_globals_jit'              => null,
            'auto_prepend_file'             => null,
            'browscap'                      => null,
            'default_charset'               => null,
            'default_mimetype'              => null,
            'disable_classes'               => null,
            'disable_functions'             => null,
            'display_errors'                => null,
            'display_startup_errors'        => null,
            'doc_root'                      => null,
            'docref_ext'                    => null,
            'docref_root'                   => null,
            'enable_dl'                     => null,
            'enable_post_data_reading'      => null,
            'error_append_string'           => null,
            'error_log'                     => null,
            'error_prepend_string'          => null,
            'error_reporting'               => null,
            'exit_on_timeout'               => null,
            'expose_php'                    => null,
            'extension_dir'                 => null,
            'file_uploads'                  => null,
            'highlight.comment'             => null,
            'highlight.default'             => null,
            'highlight.html'                => null,
            'highlight.keyword'             => null,
            'highlight.string'              => null,
            'html_errors'                   => null,
            'ignore_repeated_errors'        => null,
            'ignore_repeated_source'        => null,
            'ignore_user_abort'             => null,
            'implicit_flush'                => null,
            'include_path'                  => null,
            'log_errors'                    => null,
            'log_errors_max_len'            => null,
            'mail.add_x_header'             => null,
            'mail.force_extra_parameters'   => null,
            'mail.log'                      => null,
            'max_execution_time'            => null,
            'max_file_uploads'              => null,
            'max_input_nesting_level'       => null,
            'max_input_time'                => null,
            'max_input_vars'                => null,
            'memory_limit'                  => null,
            'open_basedir'                  => null,
            'output_buffering'              => null,
            'output_handler'                => null,
            'post_max_size'                 => null,
            'precision'                     => null,
            'realpath_cache_size'           => null,
            'realpath_cache_ttl'            => null,
            'register_argc_argv'            => null,
            'report_memleaks'               => null,
            'report_zend_debug'             => null,
            'request_order'                 => null,
            'sendmail_from'                 => null,
            'sendmail_path'                 => null,
            'serialize_precision'           => null,
            'short_open_tag'                => null,
            'smtp_port'                     => null,
            'sql.safe_mode'                 => null,
            'sys_temp_dir'                  => null,
            'track_errors'                  => null,
            'unserialize_callback_func'     => null,
            'upload_max_filesize'           => null,
            'upload_tmp_dir'                => null,
            'user_dir'                      => null,
            'user_ini.cache_ttl'            => null,
            'user_ini.filename'             => null,
            'variables_order'               => null,
            'windows.show_crt_warning'      => null,
            'xmlrpc_error_number'           => null,
            'xmlrpc_errors'                 => null,
            'zend.detect_unicode'           => null,
            'zend.enable_gc'                => null,
            'zend.multibyte'                => null,
            'zend.script_encoding'          => null,
        );
        $release->constants = array(
            'DEFAULT_INCLUDE_PATH'          => null,
            'E_ALL'                         => null,
            'E_COMPILE_ERROR'               => null,
            'E_COMPILE_WARNING'             => null,
            'E_CORE_ERROR'                  => null,
            'E_CORE_WARNING'                => null,
            'E_ERROR'                       => null,
            'E_NOTICE'                      => null,
            'E_PARSE'                       => null,
            'E_USER_ERROR'                  => null,
            'E_USER_NOTICE'                 => null,
            'E_USER_WARNING'                => null,
            'E_WARNING'                     => null,
            'FALSE'                         => null,
            'NULL'                          => null,
            'PEAR_EXTENSION_DIR'            => null,
            'PEAR_INSTALL_DIR'              => null,
            'PHP_BINDIR'                    => null,
            'PHP_CONFIG_FILE_PATH'          => null,
            'PHP_CONFIG_FILE_SCAN_DIR'      => null,
            'PHP_DATADIR'                   => null,
            'PHP_EXTENSION_DIR'             => null,
            'PHP_LIBDIR'                    => null,
            'PHP_LOCALSTATEDIR'             => null,
            'PHP_OS'                        => null,
            'PHP_OUTPUT_HANDLER_CONT'       => null,
            'PHP_OUTPUT_HANDLER_END'        => null,
            'PHP_OUTPUT_HANDLER_START'      => null,
            'PHP_SYSCONFDIR'                => null,
            'PHP_VERSION'                   => null,
            'TRUE'                          => null,
            'ZEND_THREAD_SAFE'              => null,
            '__FILE__'                      => null,
            '__LINE__'                      => null,
        );
        $release->functions = array(
            'zend_version'                  => null,
            'func_num_args'                 => null,
            'func_get_arg'                  => null,
            'func_get_args'                 => null,
            'strlen'                        => null,
            'strcmp'                        => null,
            'strncmp'                       => null,
            'strcasecmp'                    => null,
            'each'                          => null,
            'error_reporting'               => null,
            'define'                        => null,
            'defined'                       => null,
            'get_class'                     => null,
            'get_parent_class'              => null,
            'method_exists'                 => null,
            'class_exists'                  => array('4.0.0', '', '4.0.0, 5.0.0'),
            'function_exists'               => null,
            'get_included_files'            => null,
            'get_required_files'            => null,
            'is_subclass_of'                => null,
            'get_class_vars'                => null,
            'get_object_vars'               => null,
            'get_class_methods'             => null,
            'user_error'                    => null,
            'get_declared_classes'          => null,
            'get_loaded_extensions'         => null,
            'extension_loaded'              => null,
            'get_extension_funcs'           => null,
        );
        $release->classes = array(
            'stdClass'                      => null,
        );
        return $release;
    }

    protected function getR40001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-06-28',
            'php.min' => '4.0.1',
            'php.max' => '',
        );
        $release->functions = array(
            'create_function'               => null,
            'restore_error_handler'         => null,
            'set_error_handler'             => null,
            'trigger_error'                 => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'get_resource_type'             => null,
            'strncasecmp'                   => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'get_defined_functions'         => null,
            'get_defined_vars'              => null,
        );
        return $release;
    }

    protected function getR40007()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.0.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.0.7',
            'php.max' => '',
        );
        $release->functions = array(
            'get_defined_constants'         => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_SAPI'                      => null,
        );
        $release->functions = array(
            'is_a'                          => array('4.2.0', '', '4.2.0, 4.2.0, 5.3.9'),
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_PREFIX'                    => null,
            'PHP_SHLIB_SUFFIX'              => null,
            'STDERR'                        => null,
            'STDIN'                         => null,
            'STDOUT'                        => null,
            'UPLOAD_ERR_FORM_SIZE'          => null,
            'UPLOAD_ERR_INI_SIZE'           => null,
            'UPLOAD_ERR_NO_FILE'            => null,
            'UPLOAD_ERR_OK'                 => null,
            'UPLOAD_ERR_PARTIAL'            => null,
            '__CLASS__'                     => null,
            '__FUNCTION__'                  => null,
        );
        $release->functions = array(
            'debug_backtrace'               => null,
        );
        return $release;
    }

    protected function getR40310()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.3.10',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-12-14',
            'php.min' => '4.3.10',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_EOL'                       => null,
            'UPLOAD_ERR_NO_TMP_DIR'         => null,
        );
        return $release;
    }

    protected function getR40400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '4.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-07-11',
            'php.min' => '4.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_INT_MAX'                   => null,
            'PHP_INT_SIZE'                  => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'E_STRICT'                      => null,
            '__METHOD__'                    => null,
        );
        $release->functions = array(
            'debug_print_backtrace'         => null,
            'get_declared_interfaces'       => null,
            'restore_exception_handler'     => null,
            'set_exception_handler'         => null,
            'zend_thread_id'                => null,
        );
        return $release;
    }

    protected function getR50002()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-09-23',
            'php.min' => '5.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'interface_exists'              => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-11-24',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'UPLOAD_ERR_CANT_WRITE'         => null,
            '__COMPILER_HALT_OFFSET__'      => null,
        );
        $release->functions = array(
            'property_exists'               => null,
        );
        $release->classes = array(
            'ErrorException'                => null,
            'Exception'                     => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->constants = array(
            'E_RECOVERABLE_ERROR'           => null,
            'UPLOAD_ERR_EXTENSION'          => null,
        );
        return $release;
    }

    protected function getR50207()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.2.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-12-04',
            'php.min' => '5.2.7',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_DEBUG'                     => null,
            'PHP_EXTRA_VERSION'             => null,
            'PHP_MAJOR_VERSION'             => null,
            'PHP_MINOR_VERSION'             => null,
            'PHP_RELEASE_VERSION'           => null,
            'PHP_VERSION_ID'                => null,
            'PHP_ZTS'                       => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'E_DEPRECATED'                      => null,
            'E_USER_DEPRECATED'                 => null,
            'PHP_MAXPATHLEN'                    => null,
            'PHP_WINDOWS_NT_DOMAIN_CONTROLLER'  => null,
            'PHP_WINDOWS_NT_SERVER'             => null,
            'PHP_WINDOWS_NT_WORKSTATION'        => null,
            'PHP_WINDOWS_VERSION_BUILD'         => null,
            'PHP_WINDOWS_VERSION_MAJOR'         => null,
            'PHP_WINDOWS_VERSION_MINOR'         => null,
            'PHP_WINDOWS_VERSION_PLATFORM'      => null,
            'PHP_WINDOWS_VERSION_PRODUCTTYPE'
                                                => null,
            'PHP_WINDOWS_VERSION_SP_MAJOR'      => null,
            'PHP_WINDOWS_VERSION_SP_MINOR'      => null,
            'PHP_WINDOWS_VERSION_SUITEMASK'     => null,
            'ZEND_DEBUG_BUILD'                  => null,
            '__DIR__'                           => null,
            '__NAMESPACE__'                     => null,
        );
        $release->functions = array(
            'class_alias'                       => null,
            'gc_collect_cycles'                 => null,
            'gc_disable'                        => null,
            'gc_enable'                         => null,
            'gc_enabled'                        => null,
            'get_called_class'                  => null,
        );
        $release->classes = array(
            'Closure'                           => null,
        );
        $release->interfaces = array(
            'ArrayAccess'                       => null,
            'Iterator'                          => null,
            'IteratorAggregate'                 => null,
            'Serializable'                      => null,
            'Traversable'                       => null,
        );
        return $release;
    }

    protected function getR50304()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-12-09',
            'php.min' => '5.3.4',
            'php.max' => '',
        );
        $release->constants = array(
            'ZEND_MULTIBYTE'    => array('5.3.4', self::LATEST_PHP_5_3),
        );
        return $release;
    }

    protected function getR50306()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-03-17',
            'php.min' => '5.3.6',
            'php.max' => '',
        );
        $release->constants = array(
            'DEBUG_BACKTRACE_IGNORE_ARGS'       => null,
            'DEBUG_BACKTRACE_PROVIDE_OBJECT'    => null,
        );
        return $release;
    }

    protected function getR50307()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.3.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-08-18',
            'php.min' => '5.3.7',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_MANDIR'        => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PHP_BINARY'                    => null,
            'PHP_OUTPUT_HANDLER_CLEAN'      => null,
            'PHP_OUTPUT_HANDLER_CLEANABLE'  => null,
            'PHP_OUTPUT_HANDLER_DISABLED'   => null,
            'PHP_OUTPUT_HANDLER_FINAL'      => null,
            'PHP_OUTPUT_HANDLER_FLUSH'      => null,
            'PHP_OUTPUT_HANDLER_FLUSHABLE'  => null,
            'PHP_OUTPUT_HANDLER_REMOVABLE'  => null,
            'PHP_OUTPUT_HANDLER_STARTED'    => null,
            'PHP_OUTPUT_HANDLER_STDFLAGS'   => null,
            'PHP_OUTPUT_HANDLER_WRITE'      => null,
            '__TRAIT__'                     => null,
        );
        $release->functions = array(
            'get_declared_traits'           => null,
            'trait_exists'                  => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Generator'                     => null,
        );
        return $release;
    }
}
