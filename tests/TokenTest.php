<?php
/**
 * Unit tests for PHP_CompatInfo package, language token features
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
 * Tests for the PHP_CompatInfo token language features
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_TokenTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * Parse source code to detect features signature
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
     * Test detection of class member access on instantiation
     * (e.g. (new Foo)->bar()). appears with PHP 5.4.0RC1
     *
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @return void
     */
    public function testClassMemberAccessOnInstantiation()
    {
        if (version_compare(PHP_VERSION, '5.4.0RC1', '<')) {
            $this->markTestSkipped();
        }

        $this->pci->parse(TEST_FILES_PATH . 'source5.php');

        $this->assertSame(
            array('5.4.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Test detection of conflicts and aliases traits
     *
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @return void
     */
    public function testTraitsConflictsAndAliases()
    {
        if (version_compare(PHP_VERSION, '5.4.0RC1', '<')) {
            $this->markTestSkipped();
        }

        $this->pci->parse(TEST_FILES_PATH . 'source6.php');

        $this->assertSame(
            array('5.4.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Test detection of array dereferencing implementation
     * PHP-5.4 feature
     *
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @return void
     */
    public function testArrayDereferencing()
    {
        if (version_compare(PHP_VERSION, '5.4.0RC1', '<')) {
            $this->markTestSkipped();
        }

        $this->pci->parse(TEST_FILES_PATH . 'source7.php');

        $this->assertSame(
            array('5.4.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * Test detection of closures (anonymous function)
     * PHP-5.3 feature
     *
     * @covers PHP_CompatInfo::parse
     * @covers PHP_CompatInfo::getVersions
     * @return void
     */
    public function testClosures()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source8.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );

    }

}
