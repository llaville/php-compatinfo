<?php
/**
 * Unit tests for PHP_CompatInfo package, XCache Reference
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
 * @since      Class available since Release 2.8.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about XCache extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_XCacheTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_XCache::getExtensions
     * @covers PHP_CompatInfo_Reference_XCache::getFunctions
     * @covers PHP_CompatInfo_Reference_XCache::getClasses
     * @return void
     */
    protected function setUp()
    {
        $this->optionalfunctions = array(
            // Requires specific build optons
            // so not available everywhere
            'xcache_dasm_file',
            'xcache_dasm_string',
        );
        $this->obj = new PHP_CompatInfo_Reference_XCache();
        parent::setUp();
    }
}
