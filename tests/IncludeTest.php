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

$dir = dirname(dirname(dirname(__FILE__)));

if (file_exists($dir . DIRECTORY_SEPARATOR . 'PHP/CompatInfo.php')) {
    // running from repository
    include_once $dir . DIRECTORY_SEPARATOR . 'PHP/CompatInfo.php';
} else {
    // package installed
    include_once 'Bartlett/PHP/CompatInfo.php';
}

/**
 * Tests for the PHP_CompatInfo class, retrieving includes informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta2
 */
class PHP_CompatInfo_IncludeTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source3.php');
    }

    /**
     * @covers PHP_CompatInfo::getIncludes
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
     * @covers PHP_CompatInfo::getIncludes
     */
    public function testGetIncludesFilterByCategory()
    {
        $includes = $this->pci->getIncludes('require_once');

        $expected = array(
            'test4.php'
        );

        $this->assertSame(
            $expected, $includes
        );
    }

    /**
     * @covers PHP_CompatInfo::getIncludes
     */
    public function testGetIncludesFilterByCategoryAndPattern()
    {
        $includes = $this->pci->getIncludes('require', 'info');

        $this->assertSame(
            array(), $includes
        );
    }

}
