<?php
/**
 * Unit tests for PHP_CompatInfo package, Tokenizer Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Tokenizer extension
 */
class PHP_CompatInfo_Reference_TokenizerTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Tokenizer::getExtensions
     * @covers PHP_CompatInfo_Reference_Tokenizer::getFunctions
     * @covers PHP_CompatInfo_Reference_Tokenizer::getConstants
     */
    protected function setUp()
    {
        $this->ignoredconstants = array(
            // Seems to be defined in 5.2.17...
            'T_NAMESPACE',
            'T_USE',
        );
        $this->obj = new PHP_CompatInfo_Reference_Tokenizer();
        parent::setUp();
    }
}
