<?php
/**
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */
class PHP_CompatInfo_Reference_MbstringTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Mbstring::getExtensions
     * @covers PHP_CompatInfo_Reference_Mbstring::getFunctions
     * @covers PHP_CompatInfo_Reference_Mbstring::getConstants
     */
    protected function setUp()
    {
        $this->ignoredfunctions = array(
            // Function aliases
            'mbregex_encoding',
            'mbereg',
            'mberegi',
            'mbereg_replace',
            'mberegi_replace',
            'mbsplit',
            'mbereg_match',
            'mbereg_search',
            'mbereg_search_pos',
            'mbereg_search_regs',
            'mbereg_search_init',
            'mbereg_search_getregs',
            'mbereg_search_getpos',
            'mbereg_search_setpos',
        );
        $this->obj = new PHP_CompatInfo_Reference_Mbstring();
        parent::setUp();
    }
}
