<?php
/**
 * Unit tests for PHP_CompatInfo package, Imap Reference
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Imap extension
 */
class PHP_CompatInfo_Reference_ImapTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Imap::getExtensions
     * @covers PHP_CompatInfo_Reference_Imap::getFunctions
     * @covers PHP_CompatInfo_Reference_Imap::getConstants
     */
    protected function setUp()
    {
        $this->optionnalfunctions = array(
            // Not available on some 5.2.x but found in code...
            'imap_listscan',
            // requires HAVE_IMAP_MUTF7
            'imap_utf8_to_mutf7',
            'imap_mutf7_to_utf8',
        );
        $this->obj = new PHP_CompatInfo_Reference_Imap();
        parent::setUp();
    }
}
