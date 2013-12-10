<?php
/**
 * Unit tests for PHP_CompatInfo package, http Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.16.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about http extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_HttpTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Http::getClasses
     * @covers PHP_CompatInfo_Reference_Http::getFunctions
     * @covers PHP_CompatInfo_Reference_Http::getConstants
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (version_compare(phpversion("http"), "2.0.0", "ge")) {
            self::$optionalfunctions
                = array_keys(PHP_CompatInfo_Reference_Http::getOldFunctions());
            self::$optionalclasses
                = array_keys(PHP_CompatInfo_Reference_Http::getOldClasses());
            self::$optionalconstants
                = array_keys(PHP_CompatInfo_Reference_Http::getOldConstants());
        }
        self::$obj = new PHP_CompatInfo_Reference_Http();
        parent::setUpBeforeClass();
    }
}
