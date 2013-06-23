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
 * @version  GIT: $Id$
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
class PHP_CompatInfo_Reference_Core
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'Core';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = self::LATEST_PHP_5_5;

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
        $phpMin = version_compare($version, '5.0.0', 'lt') ? '4.0.0' : '5.0.0';

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
     * @link   http://www.php.net/manual/en/reserved.classes.php
     * @link   http://www.php.net/manual/en/reserved.exceptions.php
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'stdClass'                       => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '5.1.0';       // 2005-11-24 (stable)
        $items = array(
            'ErrorException'                 => array('5.1.0', ''),
            'Exception'                      => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '5.3.0';       // 2009-06-30 (stable)
        $items = array(
            'Closure'                        => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '5.5.0';       // 2013-06-20 (stable)
        $items = array(
            'Generator'                      => array('5.5.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $interfaces = array();

        $release = '5.3.0';       // 2009-06-30 (stable)
        $items = array(
            'ArrayAccess'                    => array('5.3.0', ''),
            'Iterator'                       => array('5.3.0', ''),
            'Iterator'                       => array('5.3.0', ''),
            'IteratorAggregate'              => array('5.3.0', ''),
            'Serializable'                   => array('5.3.0', ''),
            'Traversable'                    => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $interfaces);

        return $interfaces;
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

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'zend_version'                   => array('4.0.0', ''),
            'func_num_args'                  => array('4.0.0', ''),
            'func_get_arg'                   => array('4.0.0', ''),
            'func_get_args'                  => array('4.0.0', ''),
            'strlen'                         => array('4.0.0', ''),
            'strcmp'                         => array('4.0.0', ''),
            'strncmp'                        => array('4.0.0', ''),
            'strcasecmp'                     => array('4.0.0', ''),
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
            'get_class_vars'                 => array('4.0.0', ''),
            'get_object_vars'                => array('4.0.0', ''),
            'get_class_methods'              => array('4.0.0', ''),
            'user_error'                     => array('4.0.0', ''),
            'get_declared_classes'           => array('4.0.0', ''),
            'get_loaded_extensions'          => array('4.0.0', ''),
            'extension_loaded'               => array('4.0.0', ''),
            'get_extension_funcs'            => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.1';       // 2000-06-28 (stable)
        $items = array(
            'create_function'                => array('4.0.1', ''),
            'restore_error_handler'          => array('4.0.1', ''),
            'set_error_handler'              => array('4.0.1', ''),
            'trigger_error'                  => array('4.0.1', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.2';       // 2000-08-29 (stable)
        $items = array(
            'get_resource_type'              => array('4.0.2', ''),
            'strncasecmp'                    => array('4.0.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.4';       // 2000-12-19 (stable)
        $items = array(
            'get_defined_functions'          => array('4.0.4', ''),
            'get_defined_vars'               => array('4.0.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.7';       //
        $items = array(
            'get_defined_constants'          => array('4.0.7', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.2.0';       // 2002-04-22 (stable)
        $items = array(
            'is_a'                           => array('4.2.0', '', '4.2.0, 4.2.0, 5.3.9'),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.3.0';       // 2002-12-27 (stable)
        $items = array(
            'debug_backtrace'                => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.0.0';       // 2004-07-13 (stable)
        $items = array(
            'debug_print_backtrace'          => array('5.0.0', ''),
            'get_declared_interfaces'        => array('5.0.0', ''),
            'restore_exception_handler'      => array('5.0.0', ''),
            'set_exception_handler'          => array('5.0.0', ''),
            'zend_thread_id'                 => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.0.2';       // 2004-09-23 (stable)
        $items = array(
            'interface_exists'               => array('5.0.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.1.0';       // 2005-11-24 (stable)
        $items = array(
            'property_exists'                => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.3.0';       // 2009-06-30 (stable)
        $items = array(
            'class_alias'                    => array('5.3.0', ''),
            'gc_collect_cycles'              => array('5.3.0', ''),
            'gc_disable'                     => array('5.3.0', ''),
            'gc_enable'                      => array('5.3.0', ''),
            'gc_enabled'                     => array('5.3.0', ''),
            'get_called_class'               => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.4.0';       // 2012-03-01 (stable)
        $items = array(
            'get_declared_traits'            => array('5.4.0', ''),
            'trait_exists'                   => array('5.4.0', ''),
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
     * @link   http://www.php.net/manual/en/reserved.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'DEFAULT_INCLUDE_PATH'           => array('4.0.0', ''),
            'E_ALL'                          => array('4.0.0', ''),
            'E_COMPILE_ERROR'                => array('4.0.0', ''),
            'E_COMPILE_WARNING'              => array('4.0.0', ''),
            'E_CORE_ERROR'                   => array('4.0.0', ''),
            'E_CORE_WARNING'                 => array('4.0.0', ''),
            'E_ERROR'                        => array('4.0.0', ''),
            'E_NOTICE'                       => array('4.0.0', ''),
            'E_PARSE'                        => array('4.0.0', ''),
            'E_USER_ERROR'                   => array('4.0.0', ''),
            'E_USER_NOTICE'                  => array('4.0.0', ''),
            'E_USER_WARNING'                 => array('4.0.0', ''),
            'E_WARNING'                      => array('4.0.0', ''),
            'FALSE'                          => array('4.0.0', ''),
            'NULL'                           => array('4.0.0', ''),
            'PEAR_EXTENSION_DIR'             => array('4.0.0', ''),
            'PEAR_INSTALL_DIR'               => array('4.0.0', ''),
            'PHP_BINDIR'                     => array('4.0.0', ''),
            'PHP_CONFIG_FILE_PATH'           => array('4.0.0', ''),
            'PHP_CONFIG_FILE_SCAN_DIR'       => array('4.0.0', ''),
            'PHP_DATADIR'                    => array('4.0.0', ''),
            'PHP_EXTENSION_DIR'              => array('4.0.0', ''),
            'PHP_LIBDIR'                     => array('4.0.0', ''),
            'PHP_LOCALSTATEDIR'              => array('4.0.0', ''),
            'PHP_OS'                         => array('4.0.0', ''),
            'PHP_OUTPUT_HANDLER_CONT'        => array('4.0.0', ''),
            'PHP_OUTPUT_HANDLER_END'         => array('4.0.0', ''),
            'PHP_OUTPUT_HANDLER_START'       => array('4.0.0', ''),
            'PHP_SYSCONFDIR'                 => array('4.0.0', ''),
            'PHP_VERSION'                    => array('4.0.0', ''),
            'TRUE'                           => array('4.0.0', ''),
            'ZEND_THREAD_SAFE'               => array('4.0.0', ''),
            '__FILE__'                       => array('4.0.0', ''),
            '__LINE__'                       => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.2.0';       // 2002-04-22 (stable)
        $items = array(
            'PHP_SAPI'                       => array('4.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.3.0';       // 2002-12-27 (stable)
        $items = array(
            'PHP_PREFIX'                     => array('4.3.0', ''),
            'PHP_SHLIB_SUFFIX'               => array('4.3.0', ''),
            'STDERR'                         => array('4.3.0', ''),
            'STDIN'                          => array('4.3.0', ''),
            'STDOUT'                         => array('4.3.0', ''),
            'UPLOAD_ERR_FORM_SIZE'           => array('4.3.0', ''),
            'UPLOAD_ERR_INI_SIZE'            => array('4.3.0', ''),
            'UPLOAD_ERR_NO_FILE'             => array('4.3.0', ''),
            'UPLOAD_ERR_OK'                  => array('4.3.0', ''),
            'UPLOAD_ERR_PARTIAL'             => array('4.3.0', ''),
            '__CLASS__'                      => array('4.3.0', ''),
            '__FUNCTION__'                   => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.3.10';      // 2004-12-14 (stable)
        $items = array(
            'PHP_EOL'                        => array('4.3.10', ''),
            'UPLOAD_ERR_NO_TMP_DIR'          => array('4.3.10', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.4.0';      // 2005-07-11 (stable)
        $items = array(
            'PHP_INT_MAX'                    => array('4.4.0', ''),
            'PHP_INT_SIZE'                   => array('4.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.0.0';      // 2004-07-13 (stable)
        $items = array(
            'E_STRICT'                       => array('5.0.0', ''),
            '__METHOD__'                     => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.1.0';      // 2005-11-24 (stable)
        $items = array(
            'UPLOAD_ERR_CANT_WRITE'          => array('5.1.0', ''),
            '__COMPILER_HALT_OFFSET__'       => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.2.0';      // 2006-11-02 (stable)
        $items = array(
            'E_RECOVERABLE_ERROR'            => array('5.2.0', ''),
            'UPLOAD_ERR_EXTENSION'           => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.2.7';      // 2008-12-04 (stable)
        $items = array(
            'PHP_DEBUG'                      => array('5.2.7', ''),
            'PHP_EXTRA_VERSION'              => array('5.2.7', ''),
            'PHP_MAJOR_VERSION'              => array('5.2.7', ''),
            'PHP_MANDIR'                     => array('5.3.7', ''),
            'PHP_MINOR_VERSION'              => array('5.2.7', ''),
            'PHP_RELEASE_VERSION'            => array('5.2.7', ''),
            'PHP_VERSION_ID'                 => array('5.2.7', ''),
            'PHP_ZTS'                        => array('5.2.7', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.0';      // 2009-06-30 (stable)
        $items = array(
            'E_DEPRECATED'                   => array('5.3.0', ''),
            'E_USER_DEPRECATED'              => array('5.3.0', ''),
            'PHP_MAXPATHLEN'                 => array('5.3.0', ''),
            'PHP_WINDOWS_NT_DOMAIN_CONTROLLER'  
                                             => array('5.3.0', ''),
            'PHP_WINDOWS_NT_SERVER'          => array('5.3.0', ''),
            'PHP_WINDOWS_NT_WORKSTATION'     => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_BUILD'      => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_MAJOR'      => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_MINOR'      => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_PLATFORM'   => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_PRODUCTTYPE'
                                             => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_SP_MAJOR'   => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_SP_MINOR'   => array('5.3.0', ''),
            'PHP_WINDOWS_VERSION_SUITEMASK'  => array('5.3.0', ''),
            'ZEND_DEBUG_BUILD'               => array('5.3.0', ''),
            '__DIR__'                        => array('5.3.0', ''),
            '__NAMESPACE__'                  => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.4';      // 2010-12-09  (stable)
        $items = array(
            'ZEND_MULTIBYTE'                 => array('5.3.4', self::LATEST_PHP_5_3),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.6';      // 2011-03-17 (stable)
        $items = array(
            'DEBUG_BACKTRACE_IGNORE_ARGS'    => array('5.3.6', ''),
            'DEBUG_BACKTRACE_PROVIDE_OBJECT' => array('5.3.6', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.4.0';      // 2012-03-01 (stable)
        $items = array(
            'PHP_BINARY'                     => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_CLEAN'       => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_CLEANABLE'   => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_DISABLED'    => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_FINAL'       => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_FLUSH'       => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_FLUSHABLE'   => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_REMOVABLE'   => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_STARTED'     => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_STDFLAGS'    => array('5.4.0', ''),
            'PHP_OUTPUT_HANDLER_WRITE'       => array('5.4.0', ''),
            '__TRAIT__'                      => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }
}
