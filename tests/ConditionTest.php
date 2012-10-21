<?php
/**
 * Unit tests for PHP_CompatInfo package, conditions informations
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
 * @since      Class available since Release 2.9.0
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

/**
 * Tests for the PHP_CompatInfo class, retrieving conditions informations.
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_ConditionTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    /**
     * Sets up the fixture.
     *
     * Parse source code to find all code conditions
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
        $this->pci->parse(TEST_FILES_PATH . 'source9.php');
    }

    /**
     * Tests all elements excluded at once
     *
     * covers PHP_CompatInfo::getExcludes
     *
     * @return void
     */
    public function testGetAllElementsExcluded()
    {
        $excludes = $this->pci->getExcludes();
        $expected = array(
            'constants' => array(
                'PHP_BINARY' => true
            ),
            'functions' => array(
                'mb_convert_encoding' => true
            ),
            'extensions' => array(
                'mbstring' => true
            ),
            'classes' => array(
                'Symfony\Component\Yaml\Dumper' => true
            ),
            'interfaces' => array(
                'PHP_CompatInfo_Reference' => true
            )
        );
        $this->assertEquals(
            $expected, $excludes
        );
    }

}
