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

/**
 * Tests for the PHP_CompatInfo class, retrieving interfaces informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta2
 */
class PHP_CompatInfo_InterfaceTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source1.php');
    }

    /**
     * @covers PHP_CompatInfo::getInterfaces
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
                    'excluded' => false,
                ),
                'a' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 3,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'excluded' => false,
                ),
                'b' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 2,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'excluded' => false,
                ),
            ),
        );

        $this->assertSame(
            $expected, $interfaces
        );
    }

    /**
     * @covers PHP_CompatInfo::getInterfaces
     */
    public function testGetInterfacesFilterByCategory()
    {
        $interfaces = $this->pci->getInterfaces('Core');

        $this->assertSame(
            array(), $interfaces
        );

    }

    /**
     * @covers PHP_CompatInfo::getInterfaces
     */
    public function testGetInterfacesFilterByCategoryAndPattern()
    {
        $interfaces = $this->pci->getInterfaces('user', '^b$');

        $expected = array(
            'b' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source1.php'),
                'excluded' => false,
            ),
        );

        $this->assertSame(
            $expected, $interfaces
        );

    }

}
