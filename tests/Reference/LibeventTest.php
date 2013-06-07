<?php
/**
 * Unit tests for PHP_CompatInfo package, libevent Reference
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
 * about libevent extension
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
class PHP_CompatInfo_Reference_LibeventTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Libevent::getClasses
     * @covers PHP_CompatInfo_Reference_Libevent::getFunctions
     * @covers PHP_CompatInfo_Reference_Libevent::getConstants
     * @return void
     */
    protected function setUp()
    {
        $extversion = phpversion(PHP_CompatInfo_Reference_Libevent::REF_NAME);

        if (PATH_SEPARATOR == ';') {
            // Win*
            if ('0.0.4' === $extversion) {
                // only available since version 0.0.5
                array_push($this->ignoredfunctions, 'event_priority_set');
            }
        } else {
            // *nix
        }

        $this->obj = new PHP_CompatInfo_Reference_Libevent();
        parent::setUp();
    }
}
