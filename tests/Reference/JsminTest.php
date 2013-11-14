<?php
/**
 * Unit tests for PHP_CompatInfo package, Jsmin Reference
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
 * @since      Class available since Release 2.25.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Jsmin extension
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
class PHP_CompatInfo_Reference_JsminTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Jsmin::getFunctions
     * @covers PHP_CompatInfo_Reference_Jsmin::getConstants
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$obj = new PHP_CompatInfo_Reference_Jsmin();
        parent::setUpBeforeClass();
    }
}
