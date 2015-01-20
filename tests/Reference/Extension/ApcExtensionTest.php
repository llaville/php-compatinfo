<?php
/**
 * Unit tests for PHP_CompatInfo, apc extension Reference
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
 * about apc extension
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
class ApcExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalcfgs = array(
            'apc.mmap_file_mask',  // when APC_MMAP
            'apc.optimization',
        );

        if (PATH_SEPARATOR == ';') {
            // Win*
            array_push(self::$optionalcfgs,
                'apc.shm_strings_buffer'
            );
        }

        if (extension_loaded('apcu')) {
            // and PHP 5.5+
            array_push(self::$optionalcfgs,
                'apc.cache_by_default',
                'apc.canonicalize',
                'apc.file_md5',
                'apc.file_update_protection',
                'apc.filters',
                'apc.include_once_override',
                'apc.lazy_classes',
                'apc.lazy_functions',
                'apc.max_file_size',
                'apc.num_files_hint',
                'apc.report_autofilter',
                'apc.shm_strings_buffer',
                'apc.stat',
                'apc.stat_ctime',
                'apc.user_entries_hint',
                'apc.user_ttl',
                'apc.write_lock'
            );
        }

        // Constants and Classes not available in CLI mode
        self::$optionalconstants = array(
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
        self::$optionalclasses = array(
            'APCIterator',
        );
        if (extension_loaded('apcu')) {
            // APCu is a drop in replacement for APC
            // present as "apc" but only provides user data cache functions
            self::$optionalfunctions = array(
                'apc_define_constants',
                'apc_load_constants',
                'apc_compile_file',
                'apc_delete_file',
            );
        }
        self::$ext = 'Apc';
        parent::setUpBeforeClass();
    }
}
