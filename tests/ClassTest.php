<?php
/**
 * Unit tests for PHP_CompatInfo package, classes informations
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
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
 * Tests for the PHP_CompatInfo class, retrieving classes informations.
 */
class PHP_CompatInfo_ClassTest extends PHPUnit_Framework_TestCase
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
     * @covers PHP_CompatInfo::toArray
     */
    public function testToArray()
    {
        $expected = array(
            'excludes',
            'includes',
            'versions',
            'extensions',
            'namespaces',
            'interfaces',
            'classes',
            'functions',
            'constants',
            'globals',
            'tokens',
            'conditions',
        );
        $actual = $this->pci->toArray(TEST_FILES_PATH . 'source1.php');

        $this->assertInternalType(
            PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $actual
        );

        $this->assertEquals(
            $expected, array_keys($actual)
        );
    }

    /**
     * covers PHP_CompatInfo::getClasses
     */
    public function testGetClassesFullReport()
    {
        $classes = $this->pci->getClasses();

        $expected = array(
            'user' => array(
                'c' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'excluded' => false,
                ),
                'd' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'excluded' => false,
                ),
            ),
        );

        $this->assertSame(
            $expected, $classes
        );
    }

    /**
     * covers PHP_CompatInfo::getClasses
     */
    public function testGetClassesFilterByCategory()
    {
        $classes = $this->pci->getClasses('Core');

        $this->assertSame(
            array(), $classes
        );

    }

    /**
     * covers PHP_CompatInfo::getClasses
     */
    public function testGetClassesFilterByCategoryAndPattern()
    {
        $classes = $this->pci->getClasses('user', '^d$');

        $expected = array(
            'd' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source1.php'),
                'excluded' => false,
            ),
        );

        $this->assertSame(
            $expected, $classes
        );

    }

}
