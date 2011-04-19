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
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta2
 */
class PHP_CompatInfo_FunctionTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source2.php');
    }

    /**
     * covers PHP_CompatInfo::getFunctions
     */
    public function testGetFunctionsFullReport()
    {
        $functions = $this->pci->getFunctions();

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
                    'excluded' => false,
                ),
                'xdebug_start_trace' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'excluded' => false,
                ),
            );
        }
        $this->assertSame(
            $expected, $functions['user']
        );

        $expected = array(
            'function_exists' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'define' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'debug_backtrace' => array(
                'versions' => array('4.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'debug_print_backtrace' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
        );
        $this->assertSame(
            $expected, $functions['Core']
        );

        $expected = array(
            'file_put_contents' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'fopen' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'fwrite' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'fclose' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'array_fill' => array(
                'versions' => array('4.2.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
        );
        $this->assertSame(
            $expected, $functions['standard']
        );

        if (extension_loaded('xdebug')) {
            $expected = array(
                'xdebug_start_trace' => array(
                    'versions' => array('5.2.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'excluded' => false,
                ),
            );
            $this->assertSame(
                $expected, $functions['xdebug']
            );
        }

    }

    /**
     * covers PHP_CompatInfo::getFunctions
     */
    public function testGetFunctionsFilterByCategory()
    {
        $functions = $this->pci->getFunctions('user');

        if (extension_loaded('xdebug')) {
            $expected = array(
                'toFile' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
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
                    'excluded' => false,
                ),
                'xdebug_start_trace' => array(
                    'versions' => array('4.0.0', ''),
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'source2.php'),
                    'excluded' => false,
                ),
            );
        }

        $this->assertSame(
            $expected, $functions
        );
    }

    /**
     * covers PHP_CompatInfo::getFunctions
     */
    public function testGetFunctionsFilterByCategoryAndPattern()
    {
        $functions = $this->pci->getFunctions('Core', '^debug');

        $expected = array(
            'debug_backtrace' => array(
                'versions' => array('4.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'debug_print_backtrace' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
        );

        $this->assertSame(
            $expected, $functions
        );
    }

}
