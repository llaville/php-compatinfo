<?php
/**
 * Unit tests for PHP_CompatInfo, filter extension Reference
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
use Bartlett\CompatInfo\Reference\Extension\FilterExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about filter extension
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
class FilterExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
            'FILTER_SANITIZE_ALL',
            'FILTER_VALIDATE_ALL',

            // ignores all old API constants before 0.11.0
            'FILTER_FLAG_ARRAY',
            'FILTER_FLAG_SCALAR',
        );

        // ignores all old API functions before 0.11.0
        self::$optionalfunctions = array(
            'input_get',
            'input_filters_list',
            'input_has_variable',
            'filter_data',
            'input_name_to_filter',
            'input_get_args',
        );

        self::$obj = new FilterExtension();
        parent::setUpBeforeClass();
    }
}
