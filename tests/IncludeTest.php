<?php
/**
 * Unit tests for PHP_CompatInfo package, includes informations
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
 * Tests for the PHP_CompatInfo class, retrieving includes informations.
 * 
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_IncludeTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * Parse source code to find all includes
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source3.php');
    }

    /**
     * Tests includes results
     *
     * covers PHP_CompatInfo::getIncludes
     *
     * @return void
     */
    public function testGetIncludesFullReport()
    {
        $includes = $this->pci->getIncludes();

        $expected = array(
            'include' => array(
                'test1.php'
            ),
            'include_once' => array(
                'test2.php',
                'test21.php'
            ),
            'require' => array(
                'test3.php'
            ),
            'require_once' => array(
                'test4.php'
            ),
        );
        $this->assertEquals(
            $expected, $includes
        );
    }

    /**
     * Tests includes results filtering
     *
     * covers PHP_CompatInfo::getIncludes
     *
     * @return void
     */
    public function testGetIncludesFilterByCategory()
    {
        $includes = $this->pci->getIncludes('require_once');

        $expected = array(
            'test4.php'
        );

        $this->assertEquals(
            $expected, $includes
        );
    }

    /**
     * Tests includes results filtering by regular expression
     *
     * covers PHP_CompatInfo::getIncludes
     *
     * @return void
     */
    public function testGetIncludesFilterByCategoryAndPattern()
    {
        $includes = $this->pci->getIncludes('require', 'info');

        $this->assertEquals(
            array(), $includes
        );
    }

}
