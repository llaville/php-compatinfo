<?php
/**
 */

require_once 'PHP/CompatInfo/Reference.php';
require_once 'PHP/CompatInfo/Reference/pcntl.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0beta2
 */
class PHP_CompatInfo_Reference_PcntlTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $ref = new PHP_CompatInfo_Reference_Pcntl();
        $this->ref = $ref->getAll();
        $this->optionnalconstants = array('SI_NOINFO');
        $this->optionnalfunctions = array();

        foreach ($this->ref['extensions'] as $extname => $opt) {
            if (!extension_loaded($extname)) {
                $this->markTestSkipped(
                  "The '$extname' extension is not available."
                );
            }
        }
    }

    /**
     * @covers PHP_CompatInfo_Reference_Pcntl::getFunctions
     */
    public function testGetFunctions()
    {
        if (is_null($this->ref)) {
            return;
        }

        $this->assertArrayHasKey(
            'functions',
            $this->ref,
            "No function in Reference"
        );

        $this->assertArrayHasKey(
            'extensions',
            $this->ref,
            "No extension in Reference"
        );

        // Test than all referenced functions exists
        foreach ($this->ref['functions'] as $fctname => $range) {
            list($min, $max) = $range;
            if (!in_array($fctname, $this->optionnalfunctions)
                && (empty($min) || version_compare(PHP_VERSION,$min)>=0)
                && (empty($max) || version_compare(PHP_VERSION,$max)<=0)) {
                $this->assertTrue(
                    function_exists($fctname),
                    "Function '$fctname', found in Reference, doesnt exists."
                );
            }
        }

        foreach ($this->ref['extensions'] as $extname => $opt) {
            // Test if each functions are in reference
            foreach (get_extension_funcs($extname) as $fctname) {
                $this->assertArrayHasKey(
                    $fctname,
                    $this->ref['functions'],
                    "Defined function '$fctname' not known in Reference."
                );
            }
        }
    }

    /**
     * @covers PHP_CompatInfo_Reference_Pcntl::getConstants
     */
    public function testgetConstants()
    {
        if (is_null($this->ref)) {
            return;
        }

        $this->assertArrayHasKey(
            'constants',
            $this->ref,
            "No function in Reference"
        );

        $this->assertArrayHasKey(
            'extensions',
            $this->ref,
            "No extension in Reference"
        );

        // Test than all referenced constant exists
        foreach ($this->ref['constants'] as $constname => $range) {
            list($min, $max) = $range;
            if (!in_array($constname, $this->optionnalconstants)
                && (empty($min) || version_compare(PHP_VERSION,$min)>=0)
                && (empty($max) || version_compare(PHP_VERSION,$max)<=0)) {
                $this->assertTrue(
                    defined($constname),
                    "Constant '$constname', found in Reference, doesnt exists."
                );
            }
        }

        $const     = get_defined_constants(true);

        foreach ($this->ref['extensions'] as $extname => $opt) {
            if (isset($const[$extname])) {
                // Test if each constants are in reference
                foreach ($const[$extname] as $constname => $value) {
                    $this->assertArrayHasKey(
                        $constname,
                        $this->ref['constants'],
                        "Defined constant '$constname' not known in Reference."
                    );
                }
            }
        }
    }
}
