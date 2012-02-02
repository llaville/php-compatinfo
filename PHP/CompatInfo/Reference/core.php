<?php
/**
 * Version informations about components always available with PHP
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

/**
 * All interfaces, classes, functions, constants always available with PHP
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_Core implements PHP_CompatInfo_Reference
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
        if ((null == $version ) || ('4' == $version)) {
            $extensions = array(
                'Core' => array('4.0.0', '', '')
            );
        }
        if ('5' == $version) {
            $extensions = array(
                'Core' => array('5.0.0', '', '')
            );
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
     * @link   http://www.php.net/manual/en/reserved.interfaces.php
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
     * @link   http://www.php.net/manual/en/reserved.classes.php
     * @link   http://www.php.net/manual/en/reserved.exceptions.php
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'stdClass'                       => array('4.0.0', ''),
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'Closure'                        => array('5.3.0', ''),
                'ErrorException'                 => array('5.1.0', ''),
                'Exception'                      => array('5.1.0', ''),
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
                'zend_version'                   => array('4.0.0', ''),
                'func_num_args'                  => array('4.0.0', ''),
                'func_get_arg'                   => array('4.0.0', ''),
                'func_get_args'                  => array('4.0.0', ''),
                'strlen'                         => array('4.0.0', ''),
                'strcmp'                         => array('4.0.0', ''),
                'strncmp'                        => array('4.0.0', ''),
                'strcasecmp'                     => array('4.0.0', ''),
                'strncasecmp'                    => array('4.0.2', ''),
                'each'                           => array('4.0.0', ''),
                'error_reporting'                => array('4.0.0', ''),
                'define'                         => array('4.0.0', ''),
                'defined'                        => array('4.0.0', ''),
                'get_class'                      => array('4.0.0', ''),
                'get_parent_class'               => array('4.0.0', ''),
                'method_exists'                  => array('4.0.0', ''),
                'class_exists'                   => array('4.0.0', '', '4.0.0, 5.0.0'),
                'function_exists'                => array('4.0.0', ''),
                'get_included_files'             => array('4.0.0', ''),
                'get_required_files'             => array('4.0.0', ''),
                'is_subclass_of'                 => array('4.0.0', ''),
                'is_a'                           => array('4.2.0', '', '4.2.0, 4.2.0, 5.3.9'),
                'get_class_vars'                 => array('4.0.0', ''),
                'get_object_vars'                => array('4.0.0', ''),
                'get_class_methods'              => array('4.0.0', ''),
                'trigger_error'                  => array('4.0.1', ''),
                'user_error'                     => array('4.0.0', ''),
                'set_error_handler'              => array('4.0.1', ''),
                'restore_error_handler'          => array('4.0.1', ''),
                'get_declared_classes'           => array('4.0.0', ''),
                'get_defined_functions'          => array('4.0.4', ''),
                'get_defined_vars'               => array('4.0.4', ''),
                'create_function'                => array('4.0.1', ''),
                'get_resource_type'              => array('4.0.2', ''),
                'get_loaded_extensions'          => array('4.0.0', ''),
                'extension_loaded'               => array('4.0.0', ''),
                'get_extension_funcs'            => array('4.0.0', ''),
                'get_defined_constants'          => array('4.0.7', ''),
                'debug_backtrace'                => array('4.3.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'class_alias'                    => array('5.3.0', ''),
                'debug_print_backtrace'          => array('5.0.0', ''),
                'gc_collect_cycles'              => array('5.3.0', ''),
                'gc_enabled'                     => array('5.3.0', ''),
                'gc_enable'                      => array('5.3.0', ''),
                'gc_disable'                     => array('5.3.0', ''),
                'get_called_class'               => array('5.3.0', ''),
                'get_declared_interfaces'        => array('5.0.0', ''),
                'get_declared_traits'            => array('5.4.0', ''),
                'interface_exists'               => array('5.0.2', ''),
                'property_exists'                => array('5.1.0', ''),
                'restore_exception_handler'      => array('5.0.0', ''),
                'set_exception_handler'          => array('5.0.0', ''),
                'trait_exists'                   => array('5.4.0', ''),
                'zend_thread_id'                 => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/reserved.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                '__CLASS__'                      => array('4.3.0', ''),
                '__FILE__'                       => array('4.0.0', ''),
                '__FUNCTION__'                   => array('4.3.0', ''),
                '__LINE__'                       => array('4.0.0', ''),
                'DEFAULT_INCLUDE_PATH'           => array('4.0.0', ''),
                'E_ALL'                          => array('4.0.0', ''),
                'E_ERROR'                        => array('4.0.0', ''),
                'E_WARNING'                      => array('4.0.0', ''),
                'E_PARSE'                        => array('4.0.0', ''),
                'E_NOTICE'                       => array('4.0.0', ''),
                'E_COMPILE_ERROR'                => array('4.0.0', ''),
                'E_COMPILE_WARNING'              => array('4.0.0', ''),
                'E_CORE_ERROR'                   => array('4.0.0', ''),
                'E_CORE_WARNING'                 => array('4.0.0', ''),
                'E_USER_ERROR'                   => array('4.0.0', ''),
                'E_USER_WARNING'                 => array('4.0.0', ''),
                'E_USER_NOTICE'                  => array('4.0.0', ''),
                'FALSE'                          => array('4.0.0', ''),
                'NULL'                           => array('4.0.0', ''),
                'PEAR_INSTALL_DIR'               => array('4.0.0', ''),
                'PEAR_EXTENSION_DIR'             => array('4.0.0', ''),
                'PHP_BINDIR'                     => array('4.0.0', ''),
                'PHP_CONFIG_FILE_PATH'           => array('4.0.0', ''),
                'PHP_CONFIG_FILE_SCAN_DIR'       => array('4.0.0', ''),
                'PHP_DATADIR'                    => array('4.0.0', ''),
                'PHP_LIBDIR'                     => array('4.0.0', ''),
                'PHP_EOL'                        => array('4.3.10', ''),
                'PHP_EXTENSION_DIR'              => array('4.0.0', ''),
                'PHP_INT_MAX'                    => array('4.4.0', ''),
                'PHP_INT_SIZE'                   => array('4.4.0', ''),
                'PHP_LOCALSTATEDIR'              => array('4.0.0', ''),
                'PHP_PREFIX'                     => array('4.3.0', ''),
                'PHP_OS'                         => array('4.0.0', ''),
                'PHP_OUTPUT_HANDLER_CONT'        => array('4.0.0', ''),
                'PHP_OUTPUT_HANDLER_END'         => array('4.0.0', ''),
                'PHP_OUTPUT_HANDLER_START'       => array('4.0.0', ''),
                'PHP_SAPI'                       => array('4.2.0', ''),
                'PHP_SHLIB_SUFFIX'               => array('4.3.0', ''),
                'PHP_SYSCONFDIR'                 => array('4.0.0', ''),
                'PHP_VERSION'                    => array('4.0.0', ''),
                'STDERR'                         => array('4.3.0', ''),
                'STDIN'                          => array('4.3.0', ''),
                'STDOUT'                         => array('4.3.0', ''),
                'TRUE'                           => array('4.0.0', ''),
                'UPLOAD_ERR_FORM_SIZE'           => array('4.3.0', ''),
                'UPLOAD_ERR_INI_SIZE'            => array('4.3.0', ''),
                'UPLOAD_ERR_NO_FILE'             => array('4.3.0', ''),
                'UPLOAD_ERR_NO_TMP_DIR'          => array('4.3.10', ''),
                'UPLOAD_ERR_OK'                  => array('4.3.0', ''),
                'UPLOAD_ERR_PARTIAL'             => array('4.3.0', ''),
                'ZEND_THREAD_SAFE'               => array('4.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                '__COMPILER_HALT_OFFSET__'          => array('5.1.0', ''),
                '__DIR__'                           => array('5.3.0', ''),
                '__METHOD__'                        => array('5.0.0', ''),
                '__NAMESPACE__'                     => array('5.3.0', ''),
                'DEBUG_BACKTRACE_IGNORE_ARGS'       => array('5.3.6', ''),
                'DEBUG_BACKTRACE_PROVIDE_OBJECT'    => array('5.3.6', ''),
                'E_RECOVERABLE_ERROR'               => array('5.2.0', ''),
                'E_DEPRECATED'                      => array('5.3.0', ''),
                'E_USER_DEPRECATED'                 => array('5.3.0', ''),
                'E_STRICT'                          => array('5.0.0', ''),
                'PHP_BINARY'                        => array('5.4.0', ''),
                'PHP_DEBUG'                         => array('5.2.7', ''),
                'PHP_EXTRA_VERSION'                 => array('5.2.7', ''),
                'PHP_MAJOR_VERSION'                 => array('5.2.7', ''),
                'PHP_MANDIR'                        => array('5.3.7', ''),
                'PHP_MAXPATHLEN'                    => array('5.3.0', ''),
                'PHP_MINOR_VERSION'                 => array('5.2.7', ''),
                'PHP_OUTPUT_HANDLER_CLEAN'          => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_CLEANABLE'      => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_DISABLED'       => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_FINAL'          => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_FLUSH'          => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_FLUSHABLE'      => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_REMOVABLE'      => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_STARTED'        => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_STDFLAGS'       => array('5.4.0', ''),
                'PHP_OUTPUT_HANDLER_WRITE'          => array('5.4.0', ''),
                'PHP_RELEASE_VERSION'               => array('5.2.7', ''),
                'PHP_VERSION_ID'                    => array('5.2.7', ''),
                'PHP_WINDOWS_VERSION_MAJOR'         => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_MINOR'         => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_BUILD'         => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_PLATFORM'      => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_SP_MAJOR'      => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_SP_MINOR'      => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_SUITEMASK'     => array('5.3.0', ''),
                'PHP_WINDOWS_VERSION_PRODUCTTYPE'   => array('5.3.0', ''),
                'PHP_WINDOWS_NT_DOMAIN_CONTROLLER'  => array('5.3.0', ''),
                'PHP_WINDOWS_NT_SERVER'             => array('5.3.0', ''),
                'PHP_WINDOWS_NT_WORKSTATION'        => array('5.3.0', ''),
                'PHP_ZTS'                           => array('5.2.7', ''),
                'UPLOAD_ERR_CANT_WRITE'             => array('5.1.0', ''),
                'UPLOAD_ERR_EXTENSION'              => array('5.2.0', ''),
                'ZEND_DEBUG_BUILD'                  => array('5.3.0', ''),
                'ZEND_MULTIBYTE'                    => array('5.3.4', '5.3.9'),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }
}
