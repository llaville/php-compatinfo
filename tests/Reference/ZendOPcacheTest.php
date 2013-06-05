<?php
/**
 * Unit tests for PHP_CompatInfo package, Zend OPcache Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Apc extension
 * 
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_ZendOPcacheTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Zend_OPcache::getFunctions
     * @return void
     */
    protected function setUp()
    {
        $extversion = phpversion(PHP_CompatInfo_Reference_ZendOPcache::REF_NAME);

        if (PATH_SEPARATOR == ';') {
            // Win*
            if ('7.0.2FE' === $extversion) {
                array_push($this->ignoredfunctions, 'opcache_invalidate');
            }
        } else {
            // *nix
        }

        $this->obj = new PHP_CompatInfo_Reference_ZendOPcache();
        parent::setUp();
    }
}
