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

require_once 'Bartlett/PHP/Reflect.php';

$dir = dirname(dirname(__FILE__));

if (file_exists($dir . DIRECTORY_SEPARATOR . 'PHP/CompatInfo.php')) {
    // running from repository
    include_once $dir . DIRECTORY_SEPARATOR . 'PHP/CompatInfo.php';
} else {
    // package installed
    include_once 'Bartlett/PHP/CompatInfo.php';
}

/**
 * Tests for the PHP_CompatInfo class known issues
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta3
 */
class PHP_CompatInfo_IssueTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
    }

    /**
     * Regression test for bug #1626
     *
     * @link http://pear.php.net/bugs/bug.php?id=1626
     *       Class calls are seen wrong
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getExtensions
     */
    public function testBug1626()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source1626.php');

        $extensions = $this->pci->getExtensions();

        $this->assertSame(
            array(), $extensions
        );
    }

    /**
     * Regression test for bug #3657
     *
     * @link http://pear.php.net/bugs/bug.php?id=3657
     *       php5 clone constant/token in all sources
     * @covers PHP_CompatInfo::parse
     */
    public function testBug3657()
    {
        // http://cvs.php.net/co.php/phpdoc/scripts/phpweb-entities.php.in?r=1.2
        $this->pci->parse(TEST_FILES_PATH . 'source3657.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #6581
     *
     * @link http://pear.php.net/bugs/bug.php?id=6581
     *       Functions missing in func_array.php
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     */
    public function testBug6581()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source6581.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #7813
     *
     * Parse source file of PEAR_PackageUpdate 0.5.0
     *
     * @link http://pear.php.net/bugs/bug.php?id=7813
     *       wrong PHP minimum version detection
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     */
    public function testBug7813()
    {
        // PEAR_PackageUpdate-0.5.0 package and PEAR_PackageUpdate Class
        $this->pci->parse(TEST_FILES_PATH . 'source7813.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #8559
     *
     * @link http://pear.php.net/bugs/bug.php?id=8559
     *       PHP_CompatInfo fails to scan if it finds empty file in path
     * @covers PHP_CompatInfo::parse
     */
    public function testBug8559()
    {
        $this->assertFalse(
            $this->pci->parse(
                TEST_FILES_PATH . DIRECTORY_SEPARATOR . 'emptyDir'
            )
        );
    }

    /**
     * Regression test for bug #10100
     *
     * @link http://pear.php.net/bugs/bug.php?id=10100
     *       Wrong parsing of possible attributes in strings
     * @covers PHP_CompatInfo::parse
     */
    public function testBug10100()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source10100.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #13417
     *
     * @link http://pear.php.net/bugs/bug.php?id=13417
     *       Parser ignore class-method that are named as standard php functions
     * @covers PHP_CompatInfo::parse
     */
    public function testBug13417()
    {
        // HTML_CSS-1.5.1 package and HTML_CSS_Error Class
        $this->pci->parse(TEST_FILES_PATH . 'source13417.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #13568
     *
     * @link http://pear.php.net/bugs/bug.php?id=13568
     *       User functions are not ignored
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getExtensions
     */
    public function testBug13568()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source13568.php');

        $this->assertSame(
            array(), $this->pci->getExtensions()
        );
    }

    /**
     * Regression test for bug #13873
     *
     * @link http://pear.php.net/bugs/bug.php?id=13873
     *       PHP_CompatInfo fails to scan conditional code
     *       if it finds other than encapsed string
     * @covers PHP_CompatInfo::parse
     */
    public function testBug13873()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source13873.php');

        $this->assertSame(
            array('4.0.6', ''), $this->pci->getVersions()
        );

    }

    /**
     * Regression test for bug #14696
     *
     * @link http://pear.php.net/bugs/bug.php?id=14696
     *       PHP_CompatInfo fails to scan code line when not ended with semicolon
     * @covers PHP_CompatInfo::parse
     */
    public function testBug14696()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source14696.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #16302
     *
     * @link http://pear.php.net/bugs/bug.php?id=16302
     *       Exception class is detected as 4.0.0 code
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getClasses
     */
    public function testBug16302()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source16302.php');

        $classes = $this->pci->getClasses('user');

        $expected = array(
            'Foo_Exception' => array(
                'versions' => array('5.0.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source16302.php'),
                'excluded' => false,
            ),
        );
        $this->assertSame(
            $expected, $classes
        );
    }

    /**
     * Regression test for request #6056
     *
     * @link http://pear.php.net/bugs/bug.php?id=6056
     *       Add support for reporting max PHP version
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     */
    public function testRequest6056()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source6056.php');

        $this->assertSame(
            array('5.1.0', '5.0.4'), $this->pci->getVersions()
        );
    }

}
