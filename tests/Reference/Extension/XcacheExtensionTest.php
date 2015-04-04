<?php
/**
 * Unit tests for PHP_CompatInfo, XCache extension Reference
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
 * about XCache extension
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
class XcacheExtensionTest extends GenericTest
{
    const EXTNAME = 'Xcache';

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalcfgs = array(
            'xcache.admin.user',
            'xcache.admin.pass',
            'xcache.optimizer',
            // removed in 1.2.0
            'xcache.coveragedumper',
            // Windows only
            'xcache.coredump_type',
        );
        self::$optionalfunctions = array(
            // Requires specific build options
            // so not available everywhere
            'xcache_dasm_file',
            'xcache_dasm_string',
        );
        self::$ignoredconstants = array(
            'XC_OPSPEC_FETCHTYPE',
        );
        parent::setUpBeforeClass();
    }
}
