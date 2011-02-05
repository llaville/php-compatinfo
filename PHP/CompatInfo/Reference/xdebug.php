<?php
/**
 * Version informations about Xdebug extension
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
 * All interfaces, classes, functions, constants about Xdebug extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://xdebug.org/
 */
class PHP_CompatInfo_Reference_Xdebug implements PHP_CompatInfo_Reference
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
        if ((null == $version ) || ('5' == $version)) {
            $extensions = array(
                'xdebug' => array('5.2.0', '', '2.1.0')
            );
        } else {
            /*
               Since version 2.1.0
               Support for PHP versions lower than PHP 5.1 have been dropped
             */
            $extensions = array();
        }
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
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'xdebug_get_stack_depth'         => array('5.2.0', ''),
                'xdebug_get_function_stack'      => array('5.2.0', ''),
                'xdebug_get_formatted_function_stack'
                                                 => array('5.2.0', ''),
                'xdebug_print_function_stack'    => array('5.2.0', ''),
                'xdebug_get_declared_vars'       => array('5.2.0', ''),
                'xdebug_call_class'              => array('5.2.0', ''),
                'xdebug_call_function'           => array('5.2.0', ''),
                'xdebug_call_file'               => array('5.2.0', ''),
                'xdebug_call_line'               => array('5.2.0', ''),
                'xdebug_var_dump'                => array('5.2.0', ''),
                'xdebug_debug_zval'              => array('5.2.0', ''),
                'xdebug_debug_zval_stdout'       => array('5.2.0', ''),
                'xdebug_enable'                  => array('5.2.0', ''),
                'xdebug_disable'                 => array('5.2.0', ''),
                'xdebug_is_enabled'              => array('5.2.0', ''),
                'xdebug_break'                   => array('5.2.0', ''),
                'xdebug_start_trace'             => array('5.2.0', ''),
                'xdebug_stop_trace'              => array('5.2.0', ''),
                'xdebug_get_tracefile_name'      => array('5.2.0', ''),
                'xdebug_get_profiler_filename'   => array('5.2.0', ''),
                'xdebug_dump_aggr_profiling_data'
                                                 => array('5.2.0', ''),
                'xdebug_clear_aggr_profiling_data'
                                                 => array('5.2.0', ''),
                'xdebug_memory_usage'            => array('5.2.0', ''),
                'xdebug_peak_memory_usage'       => array('5.2.0', ''),
                'xdebug_time_index'              => array('5.2.0', ''),
                'xdebug_start_error_collection'  => array('5.2.0', ''),
                'xdebug_stop_error_collection'   => array('5.2.0', ''),
                'xdebug_get_collected_errors'    => array('5.2.0', ''),
                'xdebug_start_code_coverage'     => array('5.2.0', ''),
                'xdebug_stop_code_coverage'      => array('5.2.0', ''),
                'xdebug_get_code_coverage'       => array('5.2.0', ''),
                'xdebug_get_function_count'      => array('5.2.0', ''),
                'xdebug_dump_superglobals'       => array('5.2.0', ''),
                'xdebug_get_headers'             => array('5.2.0', ''),
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
                'XDEBUG_TRACE_APPEND'            => array('5.2.0', ''),
                'XDEBUG_TRACE_COMPUTERIZED'      => array('5.2.0', ''),
                'XDEBUG_TRACE_HTML'              => array('5.2.0', ''),
                'XDEBUG_CC_UNUSED'               => array('5.2.0', ''),
                'XDEBUG_CC_DEAD_CODE'            => array('5.2.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
