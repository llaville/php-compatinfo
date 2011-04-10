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
 * Tests for the PHP_CompatInfo class, retrieving constants informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta2
 */
class PHP_CompatInfo_ConstantTest extends PHPUnit_Framework_TestCase
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
     * covers PHP_CompatInfo::getConstants
     */
    public function testGetConstantsFullReport()
    {
        $constants = $this->pci->getConstants();

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
                'excluded' => false,
            ),
        );
        $this->assertSame(
            $expected, $constants['user']
        );

        $expected = array(
            'NULL' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
            'FALSE' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
        );
        $this->assertSame(
            $expected, $constants['Core']
        );
    }

    /**
     * covers PHP_CompatInfo::getConstants
     */
    public function testGetConstantsFilterByCategory()
    {
        $constants = $this->pci->getConstants('user');

        $expected = array(
            'APPLICATION_ENV' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
        );

        $this->assertSame(
            $expected, $constants
        );
    }

    /**
     * covers PHP_CompatInfo::getConstants
     */
    public function testGetConstantsFilterByCategoryAndPattern()
    {
        $constants = $this->pci->getConstants('Core', '^NULL$');

        $expected = array(
            'NULL' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source2.php'),
                'excluded' => false,
            ),
        );

        $this->assertSame(
            $expected, $constants
        );
    }

}
