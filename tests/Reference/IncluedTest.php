<?php
/**
 * Unit tests for PHP_CompatInfo package, Inclued Reference
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
 * @since      Class available since Release 2.8.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about inclued extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_IncluedTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Inclued::getExtensions
     * @covers PHP_CompatInfo_Reference_Inclued::getFunctions
     * @return void
     */
    protected function setUp()
    {
        $this->obj = new PHP_CompatInfo_Reference_Inclued();
        parent::setUp();
    }
}
