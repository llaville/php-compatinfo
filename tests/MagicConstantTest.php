<?php
/**
 * Unit tests for PHP_CompatInfo package, magic constants informations
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
 * @since      Class available since Release 2.0.0RC4
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

/**
 * Tests for the PHP_CompatInfo class, retrieving magic constants informations.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_MagicConstantTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * Parse source code to find all magic constants
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null'
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source4.php');
    }

    /**
     * Tests magic constants results
     *
     * covers PHP_CompatInfo::getConstants
     *
     * @return void
     */
    public function testGetConstants()
    {
        $constants = $this->pci->getConstants();

        $this->assertArrayHasKey(
            'Core', $constants
        );

        $expected = array(
            '__NAMESPACE__' => array(
                'versions' => array('5.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
            '__DIR__' => array(
                'versions' => array('5.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
            '__FILE__' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
            '__CLASS__' => array(
                'versions' => array('4.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
            '__METHOD__' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
            '__LINE__' => array(
                'versions' => array('4.0.0', ''),
                'uses' => 2,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
            '__FUNCTION__' => array(
                'versions' => array('4.3.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source4.php'),
                'excluded' => false,
            ),
        );

        $this->assertSame(
            $expected, $constants['Core']
        );
    }

}
