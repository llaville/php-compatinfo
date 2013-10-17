<?php
/**
 * Unit tests for PHP_CompatInfo package, classes informations
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
 * Tests for the PHP_CompatInfo class, retrieving classes informations.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_ClassTest extends PHPUnit_Framework_TestCase
{
    protected static $compatInfo;

    /**
     * Sets up the shared fixture.
     *
     * @return void
     * @link   http://phpunit.de/manual/current/en/fixtures.html#fixtures.sharing-fixture
     */
    public static function setUpBeforeClass()
    {
        $options = array(
            'cacheDriver' => 'null',
        );
        self::$compatInfo = new PHP_CompatInfo($options);
        self::$compatInfo->parse(TEST_FILES_PATH . 'source1.php');
    }

    /**
     * Tests array results output
     *
     * @covers PHP_CompatInfo::toArray
     * @group  main
     * @return void
     */
    public function testToArray()
    {
        $expected = array(
            'excludes',
            'includes',
            'versions',
            'extensions',
            'namespaces',
            'traits',
            'interfaces',
            'classes',
            'functions',
            'constants',
            'globals',
            'tokens',
            'conditions',
        );
        $actual = self::$compatInfo->toArray(TEST_FILES_PATH . 'source1.php');

        $this->assertInternalType(
            PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $actual
        );

        $this->assertEquals(
            $expected, array_keys($actual)
        );
    }

    /**
     * Tests classes results
     *
     * covers PHP_CompatInfo::getClasses
     * @group  main
     * @return void
     */
    public function testGetClassesFullReport()
    {
        $classes = self::$compatInfo->getClasses();

        $expected = array(
            'user' => array(
                'c' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
                'd' => array(
                    'versions' => array('5.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
                'Baz' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 2,
                    'sources' => array(TEST_FILES_PATH . 'source1.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            ),
        );

        $this->assertEquals(
            $expected, $classes
        );
    }

    /**
     * Tests classes results filtering
     *
     * covers PHP_CompatInfo::getClasses
     * @group  main
     * @return void
     */
    public function testGetClassesFilterByCategory()
    {
        $classes = self::$compatInfo->getClasses('Core');

        $this->assertEquals(
            array(), $classes
        );

    }

    /**
     * Tests classes results filtering by regular expression
     *
     * covers PHP_CompatInfo::getClasses
     * @group  main
     * @return void
     */
    public function testGetClassesFilterByCategoryAndPattern()
    {
        $classes = self::$compatInfo->getClasses('user', '^d$');

        $expected = array(
            'd' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source1.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );

        $this->assertEquals(
            $expected, $classes
        );

    }

}
