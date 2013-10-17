<?php
/**
 * Unit tests for PHP_CompatInfo package, constants informations
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
 * Tests for the PHP_CompatInfo class, retrieving constants informations.
 * 
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_ConstantTest extends PHPUnit_Framework_TestCase
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
        self::$compatInfo->parse(TEST_FILES_PATH . 'source2.php');
    }

    /**
     * Tests constants results
     * 
     * covers PHP_CompatInfo::getConstants
     * @group  main
     * @return void
     */
    public function testGetConstantsFullReport()
    {
        $constants = self::$compatInfo->getConstants();

        $this->assertArrayHasKey(
            'user', $constants
        );
        $this->assertArrayHasKey(
            'Core', $constants
        );

        $expected = array(
            'APPLICATION_ENV' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'TPL_REPOSITORY' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );
        $this->assertEquals(
            $expected, $constants['user']
        );

        $expected = array(
            'NULL' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'FALSE' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );
        $this->assertEquals(
            $expected, $constants['Core']
        );
    }

    /**
     * Tests constants filtering
     *
     * covers PHP_CompatInfo::getConstants
     * @group  main
     * @return void
     */
    public function testGetConstantsFilterByCategory()
    {
        $constants = self::$compatInfo->getConstants('user');

        $expected = array(
            'APPLICATION_ENV' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'TPL_REPOSITORY' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );

        $this->assertEquals(
            $expected, $constants
        );
    }

    /**
     * Tests constants filtering by regular expression
     *
     * covers PHP_CompatInfo::getConstants
     * @group  main
     * @return void
     */
    public function testGetConstantsFilterByCategoryAndPattern()
    {
        $constants = self::$compatInfo->getConstants('Core', '^NULL$');

        $expected = array(
            'NULL' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );

        $this->assertEquals(
            $expected, $constants
        );
    }

}
