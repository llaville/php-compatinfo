<?php
/**
 * Unit tests for PHP_CompatInfo package, Memcache Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.1.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Memcache extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_MemcacheTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Memcache::getExtensions
     * @covers PHP_CompatInfo_Reference_Memcache::getFunctions
     * @covers PHP_CompatInfo_Reference_Memcache::getConstants
     * @covers PHP_CompatInfo_Reference_Memcache::getClasses
     * @return void
     */
    protected function setUp()
    {
        if (DIRECTORY_SEPARATOR == '\\') {
            // Win32 only
            $this->optionnalfunctions = array(
                'memcache_append',
                'memcache_cas',
                'memcache_prepend',
                'memcache_set_failure_callback',
            );
            $this->ignoredfunctions = array(
                'memcache_setoptimeout',
            );
        }

        $this->optionnalconstants = array(
            'MEMCACHE_SERIALIZED'
        );

        $this->obj = new PHP_CompatInfo_Reference_Memcache();
        parent::setUp();
    }
}
