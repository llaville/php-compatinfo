<?php
/**
 * Unit tests for PHP_CompatInfo, hash extension Reference
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
 * @since      Class available since Release 3.0.0RC1
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about hash extension
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
class HashExtensionTest extends GenericTest
{
    const EXTNAME = 'Hash';

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $mhashconstants = array(
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
        $mhashfunctions = array(
            'mhash',
            'mhash_count',
            'mhash_get_block_size',
            'mhash_get_hash_name',
            'mhash_keygen_s2k',
        );
        // Since php 5.3.0 mhash is emulated by hash ext.
        // So this constants/functions are reported in "hash"
        if (version_compare(PHP_VERSION, '5.3.0', 'ge')) {
            if (!extension_loaded('mash')) {
                // Only available if hash emulates mhash
                // so will not be found, while in reference
                self::$optionalfunctions = $mhashfunctions;
                self::$optionalconstants = $mhashconstants;
            }
        } else {
            if (extension_loaded('mash')) {
                // Provided by mhash, not by hash
                // so will be detected, while not in reference
                self::$ignoredfunctions = $mhashfunctions;
                self::$ignoredconstants = $mhashconstants;
            }
        }
        self::$ext = 'Hash';
        parent::setUpBeforeClass();
    }
}
