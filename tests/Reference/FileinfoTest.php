<?php
/**
 * Unit tests for PHP_CompatInfo package, Fileinfo Reference
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
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Fileinfo extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_FileinfoTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Fileinfo::getExtensions
     * @covers PHP_CompatInfo_Reference_Fileinfo::getFunctions
     * @covers PHP_CompatInfo_Reference_Fileinfo::getConstants
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $extversion = phpversion(PHP_CompatInfo_Reference_Fileinfo::REF_NAME);

        if (PATH_SEPARATOR == ';') {
            // Win*
            if ('1.0.5-dev' === $extversion) {
                array_push(self::$ignoredfunctions, 'mime_content_type');
                array_push(self::$ignoredconstants, 'FILEINFO_MIME_ENCODING', 'FILEINFO_MIME_TYPE');
            }
        } else {
            // *nix
        }

        self::$obj = new PHP_CompatInfo_Reference_Fileinfo();
        parent::setUpBeforeClass();
    }
}
