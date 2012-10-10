<?php
/**
 * Unit tests for PHP_CompatInfo package, Hash Reference
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
 * about Hash extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_HashTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Hash::getExtensions
     * @covers PHP_CompatInfo_Reference_Hash::getFunctions
     * @covers PHP_CompatInfo_Reference_Hash::getConstants
     * @return void
     */
    protected function setUp()
    {
        // Since php 5.3.0 mhash is emulated by hash ext.
        // So this constants/functions are reported in "hash"
        $this->ignoredconstants = array(
            'MHASH_CRC32',
            'MHASH_MD5',
            'MHASH_SHA1',
            'MHASH_HAVAL256',
            'MHASH_RIPEMD160',
            'MHASH_TIGER',
            'MHASH_GOST',
            'MHASH_CRC32B',
            'MHASH_HAVAL224',
            'MHASH_HAVAL192',
            'MHASH_HAVAL160',
            'MHASH_HAVAL128',
            'MHASH_TIGER128',
            'MHASH_TIGER160',
            'MHASH_MD4',
            'MHASH_SHA256',
            'MHASH_ADLER32',
            'MHASH_SHA224',
            'MHASH_SHA512',
            'MHASH_SHA384',
            'MHASH_WHIRLPOOL',
            'MHASH_RIPEMD128',
            'MHASH_RIPEMD256',
            'MHASH_RIPEMD320',
            'MHASH_SNEFRU256',
            'MHASH_MD2',
            'MHASH_FNV132',
            'MHASH_FNV1A32',
            'MHASH_FNV164',
            'MHASH_FNV1A64',
            'MHASH_JOAAT',
        );
        $this->ignoredfunctions = array(
            'mhash',
            'mhash_count',
            'mhash_get_block_size',
            'mhash_get_hash_name',
            'mhash_keygen_s2k',
        );
        $this->obj = new PHP_CompatInfo_Reference_Hash();
        parent::setUp();
    }
}
