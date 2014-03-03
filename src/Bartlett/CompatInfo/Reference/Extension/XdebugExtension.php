<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class XdebugExtension extends AbstractReference
{
    const REF_NAME    = 'xdebug';
    const REF_VERSION = '2.2.4';    // 2014-02-28 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 1.2.0
        if (version_compare($version, '1.2.0', 'ge')) {
            $release = $this->getR10200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.3.0
        if (version_compare($version, '1.3.0RC1', 'ge')) {
            $release = $this->getR10300RC1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0beta1
        if (version_compare($version, '2.0.0beta1', 'ge')) {
            $release = $this->getR20000beta1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0beta2
        if (version_compare($version, '2.0.0beta2', 'ge')) {
            $release = $this->getR20000beta2();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0beta3
        if (version_compare($version, '2.0.0beta3', 'ge')) {
            $release = $this->getR20000beta3();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0beta4
        if (version_compare($version, '2.0.0beta4', 'ge')) {
            $release = $this->getR20000beta4();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0beta5
        if (version_compare($version, '2.0.0beta5', 'ge')) {
            $release = $this->getR20000beta5();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0beta6
        if (version_compare($version, '2.0.0beta6', 'ge')) {
            $release = $this->getR20000beta6();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.0.0RC1
        if (version_compare($version, '2.0.0RC1', 'ge')) {
            $release = $this->getR20000RC1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.1.0beta1
        if (version_compare($version, '2.1.0beta1', 'ge')) {
            $release = $this->getR20100beta1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 2.2.0RC1
        if (version_compare($version, '2.2.0RC1', 'ge')) {
            $release = $this->getR20200RC1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10200()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-06-08',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.auto_trace'             => null,
            'xdebug.collect_params'         => null,
            'xdebug.default_enable'         => null,
            'xdebug.dump.COOKIE'            => null,
            'xdebug.dump.ENV'               => null,
            'xdebug.dump.FILES'             => null,
            'xdebug.dump.GET'               => null,
            'xdebug.dump.POST'              => null,
            'xdebug.dump.REQUEST'           => null,
            'xdebug.dump.SERVER'            => null,
            'xdebug.dump.SESSION'           => null,
            'xdebug.dump_once'              => null,
            'xdebug.dump_undefined'         => null,
            'xdebug.max_nesting_level'      => null,
            'xdebug.remote_enable'          => null,
            'xdebug.remote_handler'         => null,
            'xdebug.remote_host'            => null,
            'xdebug.remote_mode'            => null,
            'xdebug.remote_port'            => null,
        );
        $release->functions = array(
            'xdebug_call_class'             => null,
            'xdebug_call_file'              => null,
            'xdebug_call_function'          => null,
            'xdebug_call_line'              => null,
            'xdebug_disable'                => null,
            'xdebug_dump_function_trace'    => array('4.3.0', '', 'ext.max' => '1.3.2'),
            'xdebug_dump_superglobals'      => null,
            'xdebug_enable'                 => null,
            'xdebug_get_code_coverage'      => null,
            'xdebug_get_function_stack'     => null,
            'xdebug_get_function_trace'     => array('4.3.0', '', 'ext.max' => '1.3.2'),
            'xdebug_is_enabled'             => null,
            'xdebug_memory_usage'           => null,
            'xdebug_set_error_handler'      => array('4.3.0', '', 'ext.max' => '2.0.0beta6'),
            'xdebug_start_code_coverage'    => null,
            'xdebug_start_trace'            => null,
            'xdebug_stop_code_coverage'     => null,
            'xdebug_stop_trace'             => null,
        );
        return $release;
    }

    protected function getR10300RC1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.3.0RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2003-09-18',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'xdebug_time_index'             => null,
            'xdebug_var_dump'               => null,
        );
        return $release;
    }

    protected function getR20000beta1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0beta1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2004-09-15',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.collect_assignments'        => null,
            'xdebug.collect_includes'           => null,
            'xdebug.collect_return'             => null,
            'xdebug.dump_globals'               => null,
            'xdebug.extended_info'              => null,
            'xdebug.file_link_format'           => null,
            'xdebug.idekey'                     => null,
            'xdebug.overload_var_dump'          => null,
            'xdebug.profiler_enable'            => null,
            'xdebug.profiler_output_dir'        => null,
            'xdebug.profiler_output_name'       => null,
            'xdebug.remote_autostart'           => null,
            'xdebug.remote_connect_back'        => null,
            'xdebug.remote_cookie_expire_time'  => null,
            'xdebug.scream'                     => null,
            'xdebug.show_local_vars'            => null,
            'xdebug.show_mem_delta'             => null,
            'xdebug.trace_format'               => null,
            'xdebug.trace_options'              => null,
            'xdebug.trace_output_dir'           => null,
            'xdebug.trace_output_name'          => null,
        );

        $release->functions = array(
            'xdebug_break'                      => null,
            'xdebug_get_function_count'         => null,
            'xdebug_get_stack_depth'            => null,
            'xdebug_get_tracefile_name'         => null,
            'xdebug_peak_memory_usage'          => null,
        );
        $release->constants = array(
            'XDEBUG_TRACE_APPEND'               => null,
            'XDEBUG_TRACE_COMPUTERIZED'         => null,
        );
        return $release;
    }

    protected function getR20000beta2()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0beta2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2004-11-28',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'xdebug_debug_zval'             => null,
        );
        $release->constants = array(
            'XDEBUG_CC_UNUSED'              => null,
        );
        return $release;
    }

    protected function getR20000beta3()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0beta3',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-05-12',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.profiler_enable_trigger'  => null,
        );
        return $release;
    }

    protected function getR20000beta4()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0beta4',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-09-24',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.profiler_append'        => null,

        );
        $release->functions = array(
            'xdebug_debug_zval_stdout'      => null,
            'xdebug_get_profiler_filename'  => null,
        );
        return $release;
    }

    protected function getR20000beta5()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0beta5',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2005-12-31',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'xdebug_get_declared_vars'      => null,
        );
        return $release;
    }

    protected function getR20000beta6()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0beta6',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-06-30',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.profiler_aggregate'         => null,
            'xdebug.remote_log'                 => null,
            'xdebug.show_exception_trace'       => null,
        );
        $release->functions = array(
            'xdebug_clear_aggr_profiling_data'  => null,
            'xdebug_dump_aggr_profiling_data'   => null,
        );
        return $release;
    }

    protected function getR20000RC1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.0.0RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2006-10-08',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.cli_color'                  => null,
            'xdebug.collect_vars'               => null,
            'xdebug.coverage_enable'            => null,
            'xdebug.var_display_max_children'   => null,
            'xdebug.var_display_max_data'       => null,
            'xdebug.var_display_max_depth'      => null,
        );
        $release->functions = array(
            'xdebug_print_function_stack'       => null,
        );
        $release->constants = array(
            'XDEBUG_CC_DEAD_CODE'               => null,
            'XDEBUG_TRACE_HTML'                 => null,
        );
        return $release;
    }

    protected function getR20100beta1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.1.0beta1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2010-01-02',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'xdebug_get_collected_errors'           => null,
            'xdebug_get_formatted_function_stack'   => null,
            'xdebug_get_headers'                    => null,
            'xdebug_start_error_collection'         => null,
            'xdebug_stop_error_collection'          => null,
        );
        return $release;
    }

    protected function getR20200RC1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '2.2.0RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-03-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'xdebug.trace_enable_trigger'  => null,

        );
        return $release;
    }
}
