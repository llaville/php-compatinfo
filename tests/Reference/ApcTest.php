<?php
/**
 * Unit tests for PHP_CompatInfo package, Apc Reference
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
 * @since      Class available since Release 2.0.0RC4
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
class PHP_CompatInfo_Reference_ApcTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Apc::getExtensions
     * @covers PHP_CompatInfo_Reference_Apc::getFunctions
     * @covers PHP_CompatInfo_Reference_Apc::getClasses
     * @return void
     */
    protected function setUp()
    {
        // Constants and Classes not available in CLI mode
        $this->optionalconstants = array(
            'APC_LIST_ACTIVE',
            'APC_LIST_DELETED',
            'APC_ITER_TYPE',
            'APC_ITER_KEY',
            'APC_ITER_FILENAME',
            'APC_ITER_DEVICE',
            'APC_ITER_INODE',
            'APC_ITER_VALUE',
            'APC_ITER_MD5',
            'APC_ITER_NUM_HITS',
            'APC_ITER_MTIME',
            'APC_ITER_CTIME',
            'APC_ITER_DTIME',
            'APC_ITER_ATIME',
            'APC_ITER_REFCOUNT',
            'APC_ITER_MEM_SIZE',
            'APC_ITER_TTL',
            'APC_ITER_NONE',
            'APC_ITER_ALL',
            'APC_BIN_VERIFY_MD5',
            'APC_BIN_VERIFY_CRC32',
        );
        $this->optionalclasses = array(
            'APCIterator',
        );
        $this->obj = new PHP_CompatInfo_Reference_Apc();
        parent::setUp();
    }
}
