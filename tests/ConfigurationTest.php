<?php
/**
 * Unit tests for PHP_CompatInfo package, configuration options
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.7.0
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

/**
 * Tests for the PHP_CompatInfo class, handle configuration and options
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_ConfigurationTest extends PHPUnit_Framework_TestCase
{
    protected $conf;

    /**
     * Sets up the fixture.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->conf = PHP_CompatInfo_Configuration::getInstance(
            TEST_FILES_PATH . 'phpcompatinfo.xml'
        );
    }

    /**
     * Tests the main PHP_CompatInfo default configuration
     *
     * covers PHP_CompatInfo_Configuration::getMainConfiguration
     * @group  cli
     * @return void
     */
    public function testMainDefaultConfiguration()
    {
        $actual   = $this->conf->getMainConfiguration();
        $expected = array(
            'reference'        => 'PHP5',
            'report'           => array('summary'),
            'reportFileAppend' => false,
            'cacheDriver'      => 'file',
            'recursive'        => false,
            'fileExtensions'   => array('php', 'inc', 'phtml'),
            'consoleProgress'  => true,
            'verbose'          => false
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the cache options for driver used
     *
     * covers PHP_CompatInfo_Configuration::getCacheConfiguration
     * @group  cli
     * @return void
     */
    public function testCacheConfiguration()
    {
        $actual   = $this->conf->getCacheConfiguration('file');
        $expected = array(
            'save_path'      => '/tmp',
            'gc_probability' => 1,
            'gc_maxlifetime' => 86400
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the configuration for references
     *
     * covers PHP_CompatInfo_Configuration::getReferenceConfiguration
     * @group  cli
     * @return void
     */
    public function testReferenceConfiguration()
    {
        $actual   = $this->conf->getReferenceConfiguration();
        $expected = array(
            'Core',
            'standard',
            'date',
            'xdebug'
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the PHP configuration options
     *
     * covers PHP_CompatInfo_Configuration::getPHPConfiguration
     * @group  cli
     * @return void
     */
    public function testPHPConfiguration()
    {
        $actual   = $this->conf->getPHPConfiguration();
        $expected = array(
            'memory_limit'                => '140M',
            'short_open_tag'              => true,
            'zend.ze1_compatibility_mode' => false,
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests exclusion of a files list
     *
     * covers PHP_CompatInfo_Configuration::getExcludeConfiguration
     * @group  cli
     * @return void
     */
    public function testExcludeFilesConfiguration()
    {
        $actual   = $this->conf->getExcludeConfiguration('sample_files');
        $expected = array(
            'directory' => array('.*\/Zend\/.*', '.*\/tests\/.*'),
            'file'      => array('.*\.php5', '.*\.inc\.php'),
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests exclusion of a functions list
     *
     * covers PHP_CompatInfo_Configuration::getExcludeConfiguration
     * @group  cli
     * @return void
     */
    public function testExcludeFunctionsConfiguration()
    {
        $actual   = $this->conf->getExcludeConfiguration('sample_functions');
        $expected = array(
            'function' => array('defined', 'trait_exists'),
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests exclusion of all kind of elements
     *
     * covers PHP_CompatInfo_Configuration::getExcludeConfiguration
     * @group  cli
     * @return void
     */
    public function testExcludeMixedConfiguration()
    {
        $actual   = $this->conf->getExcludeConfiguration('sample_mixed');
        $expected = array(
            'directory' => array('.*\/Zend\/.*'),
            'file'      => array('.*\.php5'),
            'extension' => array('xdebug'),
            'interface' => array('SplSubject'),
            'class'     => array('.*Compat.*'),
            'function'  => array('ereg.*', 'debug_print_backtrace'),
            'constant'  => array('T_USE')
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the configuration for listeners
     *
     * covers PHP_CompatInfo_Configuration::getListenerConfiguration
     * @group  cli
     * @return void
     */
    public function testListenerConfiguration()
    {
        $actual   = $this->conf->getListenerConfiguration();
        $expected = array(
            array(
                'class'     => 'className',
                'file'      => false,
                'arguments' => array(),
            ),
            array(
                'class'     => 'PHP_CompatInfo_Listener_File',
                'file'      => '',
                'arguments' => array(),
            ),
            array(
                'class'     => 'PHP_CompatInfo_Listener_Growl',
                'file'      => '',
                'arguments' => array(
                    'PHP_CompatInfo',
                    array(
                        'info'    => array('display' => 'Information', 'enabled' => true),
                        'warning' => array('enabled' => true),
                    ),
                    'mamasam',
                    array(
                        'host'    => '192.168.1.2',
                        'timeout' => 10,
                        'debug'   => '/path/to/logFile'
                    )
                ),
            ),
        );
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests plugins options
     *
     * covers PHP_CompatInfo_Configuration::getPluginConfiguration
     * @group  cli
     * @return void
     */
    public function testPluginConfiguration()
    {
        $actual   = $this->conf->getPluginConfiguration();
        $expected = array(
            'MyReference' => array(
                'class' => 'PEAR_CompatInfo',
                'file'  => false,
                'args'  => array()
            ),
        );
        $this->assertEquals($expected, $actual);
    }

}
