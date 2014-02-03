<?php
/**
 * Unit tests for PHP_CompatInfo, mhash extension Reference
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
use Bartlett\CompatInfo\Reference\Extension\MhashExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about mhash extension
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
class MhashExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
            'MHASH_MD2',
            'MHASH_RIPEMD128',
            'MHASH_RIPEMD256',
            'MHASH_RIPEMD320',
            'MHASH_SHA224',
            'MHASH_SHA384',
            'MHASH_SHA512',
            'MHASH_SNEFRU128',
            'MHASH_SNEFRU256',
            'MHASH_WHIRLPOOL',
        );    
        self::$obj = new MhashExtension();
        parent::setUpBeforeClass();
    }
}
