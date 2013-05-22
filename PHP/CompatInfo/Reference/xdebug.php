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
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

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
 * @since    Class available since Release 2.0.0RC3
 */
class PHP_CompatInfo_Reference_Xdebug
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'xdebug';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '2.2.3';

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
        $extver = phpversion(self::REF_NAME);
        if ($extver === false) {
            $extver = self::REF_VERSION;
        }
        /*
           Since version 2.1.0
           Support for PHP versions lower than PHP 5.1 have been dropped
         */
        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.0.0';
        } else {
            $version1 = $extver;
            $version2 = '2.1.0';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '4.3.0' : '5.1.0';
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
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '1.2.0';       // 2003-06-08
        $items = array(
            'xdebug_call_class'              => array('4.3.0', ''),
            'xdebug_call_file'               => array('4.3.0', ''),
            'xdebug_call_function'           => array('4.3.0', ''),
            'xdebug_call_line'               => array('4.3.0', ''),
            'xdebug_disable'                 => array('4.3.0', ''),
            'xdebug_dump_function_trace'     => array('4.3.0', ''),
            'xdebug_dump_superglobals'       => array('4.3.0', ''),
            'xdebug_enable'                  => array('4.3.0', ''),
            'xdebug_get_code_coverage'       => array('4.3.0', ''),
            'xdebug_get_function_stack'      => array('4.3.0', ''),
            'xdebug_get_function_trace'      => array('4.3.0', ''),
            'xdebug_is_enabled'              => array('4.3.0', ''),
            'xdebug_memory_usage'            => array('4.3.0', ''),
            'xdebug_set_error_handler'       => array('4.3.0', ''),
            'xdebug_start_code_coverage'     => array('4.3.0', ''),
            'xdebug_start_trace'             => array('4.3.0', ''),
            'xdebug_stop_code_coverage'      => array('4.3.0', ''),
            'xdebug_stop_trace'              => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);
        // removed functions in 2.0.0beta1 (then max version is 1.3.2)
        $this->setMaxExtensionVersion(
            '1.3.2', 'xdebug_get_function_trace', $functions
        );
        $this->setMaxExtensionVersion(
            '1.3.2', 'xdebug_dump_function_trace', $functions
        );
        // removed functions in 2.0.0RC1 (then max version is 2.0.0beta6)
        $this->setMaxExtensionVersion(
            '2.0.0beta6', 'xdebug_set_error_handler', $functions
        );

        $release = '1.3.0RC1';    // 2003-09-18
        $items = array(
            'xdebug_time_index'              => array('4.3.0', ''),
            'xdebug_var_dump'                => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0beta1';  // 2004-09-15
        $items = array(
            'xdebug_break'                   => array('4.3.0', ''),
            'xdebug_get_function_count'      => array('4.3.0', ''),
            'xdebug_get_stack_depth'         => array('4.3.0', ''),
            'xdebug_get_tracefile_name'      => array('4.3.0', ''),
            'xdebug_peak_memory_usage'       => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0beta2';  // 2004-11-28
        $items = array(
            'xdebug_debug_zval'              => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0beta4';  // 2005-09-24
        $items = array(
            'xdebug_debug_zval_stdout'       => array('4.3.0', ''),
            'xdebug_get_profiler_filename'   => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0beta5';  // 2005-12-31
        $items = array(
            'xdebug_get_declared_vars'       => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0beta6';  // 2006-06-30
        $items = array(
            'xdebug_clear_aggr_profiling_data'
                                             => array('4.3.0', ''),
            'xdebug_dump_aggr_profiling_data'
                                             => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0RC1';    // 2006-10-08
        $items = array(
            'xdebug_print_function_stack'    => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.1.0beta1';  // 2010-01-02
        $items = array(
            'xdebug_get_collected_errors'    => array('5.1.0', ''),
            'xdebug_get_formatted_function_stack'
                                             => array('5.1.0', ''),
            'xdebug_get_headers'             => array('5.1.0', ''),
            'xdebug_start_error_collection'  => array('5.1.0', ''),
            'xdebug_stop_error_collection'   => array('5.1.0', ''),
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
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '1.2.0';       // 2003-06-08
        $items = array(
            'XDEBUG_CC_DEAD_CODE'            => array('5.2.0', ''),
            'XDEBUG_CC_UNUSED'               => array('5.2.0', ''),
            'XDEBUG_TRACE_APPEND'            => array('5.2.0', ''),
            'XDEBUG_TRACE_COMPUTERIZED'      => array('5.2.0', ''),
            'XDEBUG_TRACE_HTML'              => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
