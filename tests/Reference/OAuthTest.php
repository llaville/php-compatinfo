<?php
/**
 * Unit tests for PHP_CompatInfo package, OAuth Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.2.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about OAuth extension
 */
class PHP_CompatInfo_Reference_OAuthTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_OAuth::getExtensions
     * @covers PHP_CompatInfo_Reference_OAuth::getClasses
     */
    protected function setUp()
    {
        $this->obj = new PHP_CompatInfo_Reference_OAuth();
        parent::setUp();
    }
}
