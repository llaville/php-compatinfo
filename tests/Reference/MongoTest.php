<?php
/**
 * Unit tests for PHP_CompatInfo package, Mongo Reference
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
 * @since      Class available since Release 2.8.0beta2
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Mongo extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_MongoTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Mongo::getExtensions
     * @covers PHP_CompatInfo_Reference_Mongo::getFunctions
     * @covers PHP_CompatInfo_Reference_Mongo::getClasses
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalclasses = array(
            // only available with 0.9.0
            'MongoUtil',
        );
        /*
            On windows
            PHP 5.2 latest version is 1.2.0, while
            PHP 5.3 latest version is 1.2.7
         */

        // classes available since 1.2.3
        array_push(
            self::$optionalclasses,
            'MongoLog',
            'MongoPool'
        );
        // classes available since 1.3.0
        array_push(
            self::$optionalclasses,
            'MongoClient',
            'MongoResultException'
        );

        // found on windows 1.2.0 version but not declared in any sources
        self::$ignoredfunctions = array(
            'mongoPoolDebug'
        );

        self::$obj = new PHP_CompatInfo_Reference_Mongo();
        parent::setUpBeforeClass();
    }
}
