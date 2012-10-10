<?php
/**
 * Unit tests for PHP_CompatInfo package, Mhash Reference
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
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Mhash extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_MhashTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Mhash::getExtensions
     * @covers PHP_CompatInfo_Reference_Mhash::getFunctions
     * @covers PHP_CompatInfo_Reference_Mhash::getConstants
     * @return void
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
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

        $this->obj = new PHP_CompatInfo_Reference_Mhash();
        parent::setUp();
    }
}
