<?php
/**
 * Unit tests for PHP_CompatInfo package, interfaces informations
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
 * @since      Class available since Release 2.0.0beta2
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

/**
 * Tests for the PHP_CompatInfo class, retrieving interfaces informations.
 * 
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_InterfaceTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * Parse source code to find all interfaces
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source1.php');
    }

    /**
     * Tests interfaces results
     *
     * covers PHP_CompatInfo::getInterfaces
     * @group  main
     * @return void
     */
    public function testGetInterfacesFullReport()
    {
        $interfaces = $this->pci->getInterfaces();

        $expected = array(
            'user' => array(
                'iTemplate' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
                'a' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 3,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
                'b' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 2,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            ),
        );

        $this->assertEquals(
            $expected, $interfaces
        );
    }

    /**
     * Tests interfaces results filtering
     *
     * covers PHP_CompatInfo::getInterfaces
     * @group  main
     * @return void
     */
    public function testGetInterfacesFilterByCategory()
    {
        $interfaces = $this->pci->getInterfaces('Core');

        $this->assertEquals(
            array(), $interfaces
        );

    }

    /**
     * Tests interfaces results filtering by regular expression
     *
     * covers PHP_CompatInfo::getInterfaces
     * @group  main
     * @return void
     */
    public function testGetInterfacesFilterByCategoryAndPattern()
    {
        $interfaces = $this->pci->getInterfaces('user', '^b$');

        $expected = array(
            'b' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source1.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );

        $this->assertEquals(
            $expected, $interfaces
        );

    }

}
