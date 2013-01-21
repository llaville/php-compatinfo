<?php
/**
 * Unit tests for PHP_CompatInfo package, sphinx Reference
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
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about sphinx extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_SphinxTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Sphinx::getExtensions
     * @covers PHP_CompatInfo_Reference_Sphinx::getFunctions
     * @return void
     */
    protected function setUp()
    {
        // Constants conditionnaly exists (according to libsphinx version)
        $this->optionalconstants = array(
            'SPH_RANK_FIELDMASK',
            'SPH_RANK_MATCHANY',
            'SPH_RANK_PROXIMITY',
        );
        $this->obj = new PHP_CompatInfo_Reference_Sphinx();
        parent::setUp();
    }
}
