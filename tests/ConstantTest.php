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
 * @version    SVN: $Id$
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
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * Parse source code to find all constants
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source2.php');
    }

    /**
     * Tests constants results
     * 
     * covers PHP_CompatInfo::getConstants
     *
     * @return void
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
            'TPL_REPOSITORY' => array(
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
     * Tests constants filtering
     *
     * covers PHP_CompatInfo::getConstants
     *
     * @return void
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
            'TPL_REPOSITORY' => array(
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
     * Tests constants filtering by regular expression
     *
     * covers PHP_CompatInfo::getConstants
     *
     * @return void
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
