<?php
/**
 * Unit tests for PHP_CompatInfo package, xhprof Reference
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
 * about xhprof extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_XhprofTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Xhprof::getExtensions
     * @covers PHP_CompatInfo_Reference_Xhprof::getFunctions
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (PATH_SEPARATOR == ';') {
            // Win*
            array_push(self::$ignoredconstants, 'XHPROF_FLAGS_LONGNAMES');
        } else {
            // *nix
        }

        self::$obj = new PHP_CompatInfo_Reference_Xhprof();
        parent::setUpBeforeClass();
    }
}
