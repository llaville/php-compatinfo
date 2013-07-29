<?php
/**
 * Unit tests for PHP_CompatInfo package, issues reported
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    All sources used are Licensed : BSD or public domain
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta3
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

/**
 * Tests for the PHP_CompatInfo class known issues
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    All sources used are Licensed : BSD or public domain
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_IssueTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
            'reference'   => 'PHP5',
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
     * @group  regression
     * @return void
     */
    public function testBug1626()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source1626.php');

        $extensions = $this->pci->getExtensions();

        $this->assertEquals(
            array(), $extensions
        );
    }

    /**
     * Regression test for bug #6581
     *
     * @link http://pear.php.net/bugs/bug.php?id=6581
     *       Functions missing in func_array.php
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @group  regression
     * @return void
     */
    public function testBug6581()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source6581.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #8559
     *
     * @link http://pear.php.net/bugs/bug.php?id=8559
     *       PHP_CompatInfo fails to scan if it finds empty file in path
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
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
     * @group  regression
     * @return void
     */
    public function testBug10100()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source10100.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #13417
     *
     * @link http://pear.php.net/bugs/bug.php?id=13417
     *       Parser ignore class-method that are named as standard php functions
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBug13417()
    {
        // HTML_CSS-1.5.1 package and HTML_CSS_Error Class
        $this->pci->parse(TEST_FILES_PATH . 'source13417.php');

        $this->assertEquals(
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
     * @group  regression
     * @return void
     */
    public function testBug13568()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source13568.php');

        $this->assertEquals(
            array(), $this->pci->getExtensions()
        );
    }

    /**
     * Regression test for bug #14696
     *
     * @link http://pear.php.net/bugs/bug.php?id=14696
     *       PHP_CompatInfo fails to scan code line when not ended with semicolon
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBug14696()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source14696.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #16302
     *
     * @link http://pear.php.net/bugs/bug.php?id=16302
     *       Exception class is detected as 4.0.0 code
     * @covers PHP_CompatInfo::parse
     * covers PHP_CompatInfo::getClasses
     * @group  regression
     * @return void
     */
    public function testBug16302()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source16302.php');

        $classes = $this->pci->getClasses('user');

        $expected = array(
            'Foo_Exception' => array(
                'versions' => array('5.1.0', ''),
                'uses' => 1,
                'sources' => array(TEST_FILES_PATH . 'source16302.php'),
                'namespace' => '\\',
                'excluded' => false,
            ),
        );
        $this->assertEquals(
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
     * @group  regression
     * @return void
     */
    public function testRequest6056()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source6056.php');

        $this->assertEquals(
            array('5.1.0', '5.0.4'), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug #18881
     *
     * @link http://pear.php.net/bugs/bug.php?id=18881
     *       Parameter count isn't recognized
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @group  regression
     * @return void
     */
    public function testBug18881()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881.php');

        $this->assertEquals(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for request #13094
     *
     * @link http://pear.php.net/bugs/bug.php?id=13094
     *       PHP5 method chaining
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @group  regression
     * @return void
     */
    public function testRequest13094()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source13094.php');

        $this->assertEquals(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-26
     *
     * @link https://github.com/llaville/php-compat-info/issues/26
     *       Mistake in classMemberAccessOnInstantiation detection
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @group  regression
     * @return void
     */
    public function testBugGH26()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh26.php');

        $this->assertEquals(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-27
     *
     * @link https://github.com/llaville/php-compat-info/issues/27
     *       Mistake in arrayDereferencing detection
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @group  regression
     * @return void
     */
    public function testBugGH27()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh27.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-28
     *
     * @link https://github.com/llaville/php-compat-info/issues/28
     *       Mistake in classMemberAccessOnInstantiation detection
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @group  regression
     * @return void
     */
    public function testBugGH28()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh28.php');

        $this->assertEquals(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-29
     *
     * @link https://github.com/llaville/php-compat-info/issues/29
     *       Inconsistent magic constants detection on PHP 5.2, 5.3 and 5.4
     * @link http://www.php.net/manual/en/language.constants.predefined.php
     * @covers PHP_CompatInfo::parse
     *  covers PHP_CompatInfo::getConstants
     * @group  regression
     * @return void
     */
    public function testBugGH29()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped(
                'NAMESPACE is fully supported only with PHP 5.3.0 or greater'
            );
        } else {
            $this->pci->parse(TEST_FILES_PATH . 'gh29.php');

            $constantsPredefined = array_keys(
                $this->pci->getConstants('Core', '^__(.*)__$')
            );
            sort($constantsPredefined);

            $this->assertEquals(
                array(
                    '__CLASS__',
                    '__DIR__',
                    '__FILE__',
                    '__FUNCTION__',
                    '__LINE__',
                    '__METHOD__',
                    '__NAMESPACE__',
                    '__TRAIT__',
                ),
                $constantsPredefined
            );
        }
    }

    /**
     * Regression test for request GH-30
     *
     * @link https://github.com/llaville/php-compat-info/issues/30
     *       mb_ereg_replace_callback support for PHP 5.4.1
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testRequestGH30()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh30-1.php');

        if (!extension_loaded('mbstring')) {
            $expected = '5.3.0';   // detect closure function
        } else {
            $expected = '5.4.1';   // detect mb_ereg_replace_callback function
        }

        $this->assertEquals(
            array($expected, ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-32
     *
     * @link https://github.com/llaville/php-compat-info/issues/32
     *       Remove false positive on id(new stdClass)->c signature
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBugGH32()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh32.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-33
     *
     * @link https://github.com/llaville/php-compat-info/issues/33
     *       Avoid deadlock in object operator
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBugGH33()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh33.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-34
     *
     * @link https://github.com/llaville/php-compat-info/issues/34
     *       Remove false positive on A::CONST_NAME
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBugGH34()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh34.php');

        $this->assertEquals(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Regression test for bug GH-38
     *
     * @link https://github.com/llaville/php-compat-info/issues/38
     *       type hinting in function prototype
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBugGH38()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh38.php');

        $classes = $this->pci->getClasses();

        if (extension_loaded('PDO')) {
            /*
                Detect PDO class on type hint of $db parameter
                in Foo's class constructor
             */
            $versions = array('5.1.0', '');
        } else {
            /*
                Detect simple Foo PHP 5 class, due to public keyword
             */
            $versions = array('5.0.0', '');
        }
        $expected = array(
            'user' => array(
                'Foo' => array(
                    'versions' => $versions,
                    'uses' => 1,
                    'sources' => array(TEST_FILES_PATH . 'gh38.php'),
                    'namespace' => '\\',
                    'excluded' => false,
                )
            ),
        );

        if (extension_loaded('memcache')) {
            $category = 'memcache';
            $versions = array('4.3.3', '', '0.2', '');
        } else {
            $category = 'user';
            $versions = array('4.0.0', '');
        }
        $expected[$category]['Memcache'] = array(
            'versions' => $versions,
            'uses' => 1,
            'sources' => array(TEST_FILES_PATH . 'gh38.php'),
            'namespace' => '\\',
            'excluded' => false,
        );

        if (extension_loaded('PDO')) {
            $category = 'PDO';
            $versions = array('5.1.0', '', '', '');
        } else {
            $category = 'user';
            $versions = array('4.0.0', '');
        }
        $expected[$category]['PDO'] = array(
            'versions' => $versions,
            'uses' => 1,
            'sources' => array(TEST_FILES_PATH . 'gh38.php'),
            'namespace' => '\\',
            'excluded' => false,
        );

        $this->assertEquals(
            $expected, $classes
        );

    }

    /**
     * Regression test for bug GH-97
     *
     * @link https://github.com/llaville/php-compat-info/issues/97
     *       False positive classMemberAccessOnInstantiation detection
     * @covers PHP_CompatInfo::parse
     * @group  regression
     * @return void
     */
    public function testBugGH97()
    {
        $this->pci->parse(TEST_FILES_PATH . 'gh97.php');

        $this->assertEquals(
            array('5.0.0', ''), $this->pci->getVersions()
        );

    }

}
