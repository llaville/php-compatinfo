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
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    GPLv2 or PHP License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.2.0
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
 * source13873      is under GPLv2+ License
 * source3657.php   is under PHP License
 * source7813.php   is under PHP License
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    GPLv2 or PHP License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_IssueTest2 extends PHPUnit_Framework_TestCase
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
        );

        $this->pci = new PHP_CompatInfo($options);
    }


    /**
     * Regression test for bug #3657
     *
     * @link http://pear.php.net/bugs/bug.php?id=3657
     *       php5 clone constant/token in all sources
     * @covers PHP_CompatInfo::parse
     * @return void
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
     * @return void
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
     * @return void
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
     * Regression test for bug #13873
     *
     * @link http://pear.php.net/bugs/bug.php?id=13873
     *       PHP_CompatInfo fails to scan conditional code
     *       if it finds other than encapsed string
     * @covers PHP_CompatInfo::parse
     * @return void
     */
    public function testBug13873()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source13873.php');

        $this->assertSame(
            array('4.1.0', ''), $this->pci->getVersions()
        );
    }

}
