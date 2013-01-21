<?php
/**
 * Unit tests for PHP_CompatInfo package, Filter Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Filter extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_FilterTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Filter::getExtensions
     * @covers PHP_CompatInfo_Reference_Filter::getFunctions
     * @covers PHP_CompatInfo_Reference_Filter::getConstants
     * @return void
     */
    protected function setUp()
    {
        $this->optionalconstants = array(
            'FILTER_SANITIZE_ALL',
            'FILTER_VALIDATE_ALL',

            // ignores all old API constants before 0.11.0
            'FILTER_FLAG_ARRAY',
            'FILTER_FLAG_SCALAR',
        );

        // ignores all old API functions before 0.11.0
        $this->optionalfunctions = array(
            'input_get',
            'input_filters_list',
            'input_has_variable',
            'filter_data',
            'input_name_to_filter',
            'input_get_args',
        );

        $this->obj = new PHP_CompatInfo_Reference_Filter();
        parent::setUp();
    }
}
