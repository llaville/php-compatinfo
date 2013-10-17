<?php
/**
 * Unit tests for PHP_CompatInfo package, functions informations
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
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_FunctionTest extends PHPUnit_Framework_TestCase
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
     * Tests functions results
     *
     * covers PHP_CompatInfo::getFunctions
     * @group  main
     * @return void
     */
    public function testGetFunctionsFullReport()
    {
        $functions = self::$compatInfo->getFunctions();

        $this->assertArrayHasKey(
            'user', $functions
        );
        $this->assertArrayHasKey(
            'Core', $functions
        );
        $this->assertArrayHasKey(
            'standard', $functions
        );
        if (extension_loaded('xdebug')) {
            $this->assertArrayHasKey(
                'xdebug', $functions
            );
        }

        if (extension_loaded('xdebug')) {
            $expected = array(
                'toFile' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            );
        } else {
            /**
             * When xdebug extension is not loaded, xdebug_start_trace
             * is considered as a user function
             */
            $expected = array(
                'toFile' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
                'xdebug_start_trace' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            );
        }
        $this->assertEquals(
            $expected, $functions['user']
        );

        $expected = array(
            'function_exists' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'define' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'debug_backtrace' => array(
                'versions' => array('4.3.0', '', '4.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => '1',  // excluded by code condition: function_exists
            ),
            'debug_print_backtrace' => array(
                'versions' => array('5.0.0', '', '5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );
        $this->assertEquals(
            $expected, $functions['Core']
        );

        $expected = array(
            'file_put_contents' => array(
                'versions' => array('5.0.0', '', '5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,  // excluded by code condition: function_exists
            ),
            'fopen' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'fwrite' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'fclose' => array(
                'versions' => array('4.0.0', '', '4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
            'array_fill' => array(
                'versions' => array('4.2.0', '', '4.2.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );
        $this->assertEquals(
            $expected, $functions['standard']
        );

        if (extension_loaded('xdebug')) {
            $expected = array(
                'xdebug_start_trace' => array(
                    'versions' => array('4.3.0', '', '1.2.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            );
            $this->assertEquals(
                $expected, $functions['xdebug']
            );
        }

    }

    /**
     * Tests functions results filtering
     *
     * covers PHP_CompatInfo::getFunctions
     * @group  main
     * @return void
     */
    public function testGetFunctionsFilterByCategory()
    {
        $functions = self::$compatInfo->getFunctions('user');

        if (extension_loaded('xdebug')) {
            $expected = array(
                'toFile' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            );
        } else {
            /**
             * When xdebug extension is not loaded, xdebug_start_trace
             * is considered as a user function
             */
            $expected = array(
                'toFile' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
                'xdebug_start_trace' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                ),
            );
        }

        $this->assertEquals(
            $expected, $functions
        );
    }

    /**
     * Tests functions results filtering by regular expression
     *
     * covers PHP_CompatInfo::getFunctions
     * @group  main
     * @return void
     */
    public function testGetFunctionsFilterByCategoryAndPattern()
    {
        $functions = self::$compatInfo->getFunctions('Core', '^debug');

        $expected = array(
            'debug_backtrace' => array(
                'versions' => array('4.3.0', '', '4.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => '1',  // excluded by code condition: function_exists
            ),
            'debug_print_backtrace' => array(
                'versions' => array('5.0.0', '', '5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );

        $this->assertEquals(
            $expected, $functions
        );
    }

}
