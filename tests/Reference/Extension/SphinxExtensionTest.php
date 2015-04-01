<?php
/**
 * Unit tests for PHP_CompatInfo, sphinx extension Reference
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
 * @since      Class available since Release 3.0.0
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about sphinx extension
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
class SphinxExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        // Constants conditionnaly exists (according to libsphinx version)
        self::$optionalconstants = array(
            'SPH_RANK_EXPR',
            'SPH_RANK_FIELDMASK',
            'SPH_RANK_MATCHANY',
            'SPH_RANK_PROXIMITY',
            'SPH_RANK_SPH04',
            'SPH_RANK_TOTAL',
            // only defined when build with --enable-redis-igbinary option
            'SERIALIZER_IGBINARY'
        );

        self::$ext = 'Sphinx';
        parent::setUpBeforeClass();
    }
}
