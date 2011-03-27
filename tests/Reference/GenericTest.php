<?php
/**
 */

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
class PHP_CompatInfo_Reference_GenericTest extends PHPUnit_Framework_TestCase
{
    protected $obj = NULL;
    protected $ref = NULL;
    
    // Could be defined in Reference but missing (system dependant)
    protected $optionnalconstants   = array();
    protected $optionnalfunctions   = array();
    protected $optionnalclasses     = array();
    
    // Could be present but missing in Refence (alias, ...)
    protected $ignoredfunctions     = array();
    protected $ignoredconstants     = array();

    protected function setUp()
    {
        if ($this->obj instanceof PHP_CompatInfo_Reference) {
            $this->ref = $this->obj->getAll();
        }
        if (isset($this->ref['extensions'])) {
            foreach ($this->ref['extensions'] as $extname => $opt) {
                if (!extension_loaded($extname)) {
                    $this->markTestSkipped(
                      "The '$extname' extension is not available."
                    );
                }
            }
        }
    }

    public function testReference()
    {
        if (is_null($this->ref)) {
            return;
        }

        $this->assertArrayHasKey(
            'extensions',
            $this->ref,
            "No extension in Reference"
        );

        $this->assertArrayHasKey(
            'functions',
            $this->ref,
            "No function in Reference"
        );

        $this->assertArrayHasKey(
            'constants',
            $this->ref,
            "No function in Reference"
        );

        $this->assertArrayHasKey(
            'classes',
            $this->ref,
            "No classe in Reference"
        );

        $this->assertArrayHasKey(
            'interfaces',
            $this->ref,
            "No interface in Reference"
        );
    }

    /**
     * @depends testReference
     */
    public function testGetFunctionsFromReference()
    {
        if (is_null($this->ref)) {
            return;
        }

        // Test than all referenced functions exists
        foreach ($this->ref['functions'] as $fctname => $range) {
            list($min, $max) = $range;
            if (!in_array($fctname, $this->optionnalfunctions)
                && (empty($min) || version_compare(PHP_VERSION,$min)>=0)
                && (empty($max) || version_compare(PHP_VERSION,$max)<0)) {
                $this->assertTrue(
                    function_exists($fctname),
                    "Function '$fctname', found in Reference, doesnt exists."
                );
            }
        }
    }

    /**
     * @depends testReference
     */
    public function testGetFunctionsFromExtension()
    {
        if (is_null($this->ref)) {
            return;
        }

        foreach ($this->ref['extensions'] as $extname => $opt) {
            // Test if each functions are in reference
            foreach (get_extension_funcs($extname) as $fctname) {
                if (!in_array($fctname, $this->ignoredfunctions)) {
                    $this->assertArrayHasKey(
                        $fctname,
                        $this->ref['functions'],
                        "Defined function '$fctname' not known in Reference."
                    );
                }
            }
        }
    }

    /**
     * @depends testReference
     */
    public function testgetConstantsFromReference()
    {
        if (is_null($this->ref)) {
            return;
        }

        // Test than all referenced constant exists
        foreach ($this->ref['constants'] as $constname => $range) {
            list($min, $max) = $range;
            if (!in_array($constname, $this->optionnalconstants)
                && (empty($min) || version_compare(PHP_VERSION,$min)>=0)
                && (empty($max) || version_compare(PHP_VERSION,$max)<0)) {
                $this->assertTrue(
                    defined($constname),
                    "Constant '$constname', found in Reference, doesnt exists."
                );
            }
        }
    }

    /**
     * @depends testReference
     */
    public function testgetClassesFromReference()
    {
        if (is_null($this->ref)) {
            return;
        }

        // Test than all referenced constant exists
        foreach ($this->ref['classes'] as $constname => $range) {
            list($min, $max) = $range;
            if (!in_array($constname, $this->optionnalclasses)
                && (empty($min) || version_compare(PHP_VERSION,$min)>=0)
                && (empty($max) || version_compare(PHP_VERSION,$max)<0)) {
                $this->assertTrue(
                    class_exists($constname, false),
                    "Class '$constname', found in Reference, doesnt exists."
                );
            }
        }
    }

    /**
     * @depends testReference
     */
    public function testgetConstantsFromExtension()
    {
        if (is_null($this->ref)) {
            return;
        }

        $const = get_defined_constants(true);

        foreach ($this->ref['extensions'] as $extname => $opt) {
            if (isset($const[$extname])) {
                // Test if each constants are in reference
                foreach ($const[$extname] as $constname => $value) {
	                if (!in_array($constname, $this->ignoredconstants)) {
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
}
