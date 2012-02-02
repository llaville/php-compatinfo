<?php
/**
 * Unit tests for PHP_CompatInfo package, Tidy Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Tidy extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_TidyTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Tidy::getExtensions
     * @covers PHP_CompatInfo_Reference_Tidy::getFunctions
     * @covers PHP_CompatInfo_Reference_Tidy::getConstants
     * @covers PHP_CompatInfo_Reference_Tidy::getClasses
     * @return void
     */
    protected function setUp()
    {
        $this->optionnalfunctions = array(
            // Requires HAVE_TIDYOPTGETDOC
            'tidy_get_opt_doc',
        );
        $this->obj = new PHP_CompatInfo_Reference_Tidy();
        parent::setUp();
    }
}
