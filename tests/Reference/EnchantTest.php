<?php
/**
 */

require_once 'GenericTest.php';

$dir = dirname(dirname(dirname(__FILE__)));

if (file_exists($dir . DIRECTORY_SEPARATOR . 'PHP/CompatInfo/Reference/enchant.php')) {
    // running from repository
    include_once $dir . DIRECTORY_SEPARATOR . 'PHP/CompatInfo/Reference/enchant.php';
} else {
    // package installed
    include_once 'Bartlett/PHP/CompatInfo/Reference/enchant.php';
}

/**
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */
class PHP_CompatInfo_Reference_EnchantTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Enchant::getExtensions
     * @covers PHP_CompatInfo_Reference_Enchant::getFunctions
     * @covers PHP_CompatInfo_Reference_Enchant::getConstants
     */
    protected function setUp()
    {
        $this->obj = new PHP_CompatInfo_Reference_Enchant();
        parent::setUp();
    }
}
