<?php
/**
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

require_once 'PHP/CompatInfo.php';

/**
 * Tests for the PHP_CompatInfo package detection
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta3
 */
class PHP_CompatInfo_PackageTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
    }

    /**
     * Parse source file of PEAR_PackageUpdate 0.5.0
     *
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getClasses
     * @covers PHP_CompatInfo::getFunctions
     * @covers PHP_CompatInfo::getConstants
     */
    public function testParseSource7813()
    {
        // PEAR_PackageUpdate-0.5.0 package and PEAR_PackageUpdate Class
        $this->pci->parse(TEST_FILES_PATH . 'source7813.php');

        $classes = $this->pci->getClasses('user');  
        $classes = array_keys($classes);
        sort($classes);

        $expected = array(
            'PEAR',
            'PEAR_Command',
            'PEAR_Config',
            'PEAR_ErrorStack',
            'PEAR_PackageUpdate',
        );
        $this->assertSame(
            $expected, $classes
        );

        $functions = $this->pci->getFunctions('Core');
        $functions = array_keys($functions);
        sort($functions);

        $expected = array(
            'class_exists',
            'debug_backtrace',
            'define',
            'function_exists',
            'get_class',
            'strlen',
        );
        $this->assertSame(
            $expected, $functions
        );

        $functions = $this->pci->getFunctions('standard');
        $functions = array_keys($functions);
        sort($functions);

        $expected = array(
            'array_keys',
            'array_shift',
            'count',
            'explode',
            'fclose',
            'file_exists',
            'file_get_contents',
            'fopen',
            'fwrite',
            'get_include_path',
            'getenv',
            'is_array',
            'is_int',
            'is_readable',
            'reset',
            'serialize',
            'settype',
            'unserialize',
            'version_compare'
        );
        $this->assertSame(
            $expected, $functions
        );

        $constants = $this->pci->getConstants('user');
        $constants = array_keys($constants);
        sort($constants);

        $expected = array(
            'PEAR_PACKAGEUPDATE_ERROR_INVALIDPREF',
            'PEAR_PACKAGEUPDATE_ERROR_INVALIDSTATE',
            'PEAR_PACKAGEUPDATE_ERROR_INVALIDTYPE',
            'PEAR_PACKAGEUPDATE_ERROR_NOCHANNEL',
            'PEAR_PACKAGEUPDATE_ERROR_NOINFO',
            'PEAR_PACKAGEUPDATE_ERROR_NONEXISTENTDRIVER',
            'PEAR_PACKAGEUPDATE_ERROR_NOPACKAGE',
            'PEAR_PACKAGEUPDATE_ERROR_NOTINSTALLED',
            'PEAR_PACKAGEUPDATE_ERROR_PREFFILE_CORRUPTED',
            'PEAR_PACKAGEUPDATE_ERROR_PREFFILE_READACCESS',
            'PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEACCESS',
            'PEAR_PACKAGEUPDATE_ERROR_PREFFILE_WRITEERROR',
            'PEAR_PACKAGEUPDATE_PREF_NEXTRELEASE',
            'PEAR_PACKAGEUPDATE_PREF_NOUPDATES',
            'PEAR_PACKAGEUPDATE_PREF_STATE',
            'PEAR_PACKAGEUPDATE_PREF_TYPE',
            'PEAR_PACKAGEUPDATE_STATE_ALPHA',
            'PEAR_PACKAGEUPDATE_STATE_BETA',
            'PEAR_PACKAGEUPDATE_STATE_DEVEL',
            'PEAR_PACKAGEUPDATE_STATE_STABLE',
            'PEAR_PACKAGEUPDATE_TYPE_BUG',
            'PEAR_PACKAGEUPDATE_TYPE_MAJOR',
            'PEAR_PACKAGEUPDATE_TYPE_MINOR',
        );
        $this->assertSame(
            $expected, $constants
        );

        $constants = $this->pci->getConstants('Core');
        $constants = array_keys($constants);
        sort($constants);

        $expected = array(
            'E_COMPILE_ERROR',
            'E_COMPILE_WARNING',
            'E_CORE_ERROR',
            'E_CORE_WARNING',
            'E_ERROR',
            'E_NOTICE',
            'E_PARSE',
            'E_USER_ERROR',
            'E_USER_NOTICE',
            'E_USER_WARNING',
            'E_WARNING',
            'FALSE',
            'NULL',
            'TRUE',
        );
        $this->assertSame(
            $expected, $constants
        );

        $constants = $this->pci->getConstants('standard');
        $constants = array_keys($constants);
        sort($constants);

        $expected = array(
            'DIRECTORY_SEPARATOR',
            'PATH_SEPARATOR',
        );
        $this->assertSame(
            $expected, $constants
        );
    }

}
