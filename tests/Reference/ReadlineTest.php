<?php
/**
 * Unit tests for PHP_CompatInfo package, Readline Reference
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
 * about Readline extension
 */
class PHP_CompatInfo_Reference_ReadlineTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Readline::getExtensions
     * @covers PHP_CompatInfo_Reference_Readline::getFunctions
     */
    protected function setUp()
    {
        $this->optionnalfunctions = array(
            // Not available with libedit (only with readline)
            'readline_list_history',
            'readline_callback_handler_install',
            'readline_callback_handler_remove',
            'readline_callback_read_char',
            'readline_on_new_line',
            'readline_redisplay',
        );
        $this->obj = new PHP_CompatInfo_Reference_Readline();
        parent::setUp();
    }
}
