<?php
/**
 * Unit tests for PHP_CompatInfo, core extension Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.0.0RC1
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about core extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class CoreExtensionTest extends GenericTest
{
    const EXTNAME = 'Core';

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
            // Not real constant
            '__CLASS__',
            '__FILE__',
            '__FUNCTION__',
            '__LINE__',
            '__COMPILER_HALT_OFFSET__',
            '__DIR__',
            '__METHOD__',
            '__NAMESPACE__',
            '__TRAIT__',
        );
        self::$ignoredconstants = array(
            // add by swig framework as core constant
            'swig_runtime_data_type_pointer',
        );
        self::$ignoredfunctions = array(
            // Provided by PHP/CodeCoverage/Util.php when not available in PHP
            // So no reliable check for this one
            'trait_exists',
        );
        self::$optionalcfgs = array(
            // Requires --enable-zend-multibyte
            'zend.detect_unicode',
            'zend.multibyte'
        );
        if (PATH_SEPARATOR == ':') {
            self::$optionalcfgs = array_merge(
                self::$optionalcfgs,
                array(
                    'windows.show_crt_warning',
                )
            );
            self::$optionalconstants = array_merge(
                self::$optionalconstants,
                array(
                    // Win32 Only
                    'PHP_WINDOWS_VERSION_MAJOR',
                    'PHP_WINDOWS_VERSION_MINOR',
                    'PHP_WINDOWS_VERSION_BUILD',
                    'PHP_WINDOWS_VERSION_PLATFORM',
                    'PHP_WINDOWS_VERSION_SP_MAJOR',
                    'PHP_WINDOWS_VERSION_SP_MINOR',
                    'PHP_WINDOWS_VERSION_SUITEMASK',
                    'PHP_WINDOWS_VERSION_PRODUCTTYPE',
                    'PHP_WINDOWS_NT_DOMAIN_CONTROLLER',
                    'PHP_WINDOWS_NT_SERVER',
                    'PHP_WINDOWS_NT_WORKSTATION',
                )
            );
        } else {
            self::$optionalconstants = array_merge(
                self::$optionalconstants,
                array(
                    // Non Windows only
                    'PHP_MANDIR',
                )
            );
        }
        if (php_sapi_name() != 'cli') {
            array_push(self::$optionalconstants, 'STDIN', 'STDOUT', 'STDERR');
        }

        self::$optionalfunctions = array(
            'empty',
            'isset',
            'list',
            // Requires ZTS
            'zend_thread_id',
        );

        // special classes
        self::$optionalclasses = array(
            'parent',
            'static',
            'self',
        );

        parent::setUpBeforeClass();
    }
}
