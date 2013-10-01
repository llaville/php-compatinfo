<?php
/**
 * Unit tests for PHP_CompatInfo package, Generic base class
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_GenericTest extends PHPUnit_Framework_TestCase
{
    protected static $obj = NULL;
    protected static $ref = NULL;

    // Could be defined in Reference but missing (system dependant)
    protected static $optionalconstants   = array();
    protected static $optionalfunctions   = array();
    protected static $optionalclasses     = array();
    protected static $optionalinterfaces  = array();

    // Could be present but missing in Reference (alias, ...)
    protected static $ignoredfunctions     = array();
    protected static $ignoredconstants     = array();
    protected static $ignoredclasses       = array();
    protected static $ignoredinterfaces    = array();

    /**
     * Sets up the shared fixture.
     *
     * @return void
     * @link   http://phpunit.de/manual/current/en/fixtures.html#fixtures.sharing-fixture
     */
    public static function setUpBeforeClass()
    {
        if (self::$obj instanceof PHP_CompatInfo_Reference) {
            self::$ref = self::$obj->getAll();
        }
        if (isset(self::$ref['extensions'])) {
            foreach (self::$ref['extensions'] as $extname => $opt) {
                if (!extension_loaded($extname)) {
                    // if dynamic extension load is activated
                    $loaded = (bool) ini_get('enable_dl');
                    if ($loaded) {
                        // give a second chance
                        $prefix = (PHP_SHLIB_SUFFIX === 'dll') ? 'php_' : '';
                        $loaded = @dl($prefix . $extname . '.' . PHP_SHLIB_SUFFIX);
                    }
                    if ($loaded === false) {
                        self::markTestSkipped(
                            "The '$extname' extension is not available."
                        );
                    }
                }
            }
        }
    }

    /**
     * Test the reference structure of an extension
     * @group  reference
     * @return void
     */
    public function testReference()
    {
        if (is_null(self::$ref)) {
            return;
        }

        $this->assertArrayHasKey(
            'extensions',
            self::$ref,
            "No extension in Reference"
        );

        $this->assertArrayHasKey(
            'functions',
            self::$ref,
            "No function in Reference"
        );

        $this->assertArrayHasKey(
            'constants',
            self::$ref,
            "No constant in Reference"
        );

        $this->assertArrayHasKey(
            'classes',
            self::$ref,
            "No classe in Reference"
        );

        $this->assertArrayHasKey(
            'interfaces',
            self::$ref,
            "No interface in Reference"
        );
    }

    /**
     * Test than all referenced functions exists
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetFunctionsFromReference()
    {
        if (is_null(self::$ref)) {
            return;
        }

        foreach (self::$ref['functions'] as $fctname => $range) {
            list($min, $max) = $range;
            if (array_key_exists('excludes', $range)
                && in_array(PHP_VERSION, $range['excludes'])
            ) {
                array_push(self::$ignoredfunctions, $fctname);
            }
            if (!in_array($fctname, self::$optionalfunctions)
                && (empty($min) || version_compare(PHP_VERSION, $min)>=0)
                && (empty($max) || version_compare(PHP_VERSION, $max)<=0)
            ) {
                $this->assertTrue(
                    function_exists($fctname),
                    "Function '$fctname', found in Reference, does not exists."
                );
            }
            if (!in_array($fctname, self::$ignoredfunctions)) {
                if (($min && version_compare(PHP_VERSION, $min)<0)
                    || ($max && version_compare(PHP_VERSION, $max)>0)
                ) {
                    $this->assertFalse(
                        function_exists($fctname),
                        "Function '$fctname', found in Reference ($min,$max), exists."
                    );
                }
            }
        }
    }

    /**
     * Test that each functions are defined in reference
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetFunctionsFromExtension()
    {
        if (is_null(self::$ref)) {
            return;
        }

        foreach (self::$ref['extensions'] as $extname => $opt) {
            $ext = get_extension_funcs($extname);
            if (!is_array($ext)) {
                // At least, for sqlite3 (PHP Bug ?)
                continue;
            }

            foreach ($ext as $fctname) {
                if (!in_array($fctname, self::$ignoredfunctions)) {
                    $this->assertArrayHasKey(
                        $fctname,
                        self::$ref['functions'],
                        "Defined function '$fctname' not known in Reference."
                    );
                }
            }
        }
    }

    /**
     * Test than all referenced constants exists
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetConstantsFromReference()
    {
        if (is_null(self::$ref)) {
            return;
        }

        foreach (self::$ref['constants'] as $constname => $range) {
            list($min, $max) = $range;
            if (array_key_exists('excludes', $range)
                && in_array(PHP_VERSION, $range['excludes'])
            ) {
                array_push(self::$ignoredconstants, $constname);
            }
            if (!in_array($constname, self::$optionalconstants)
                && (empty($min) || version_compare(PHP_VERSION, $min)>=0)
                && (empty($max) || version_compare(PHP_VERSION, $max)<=0)
            ) {
                $this->assertTrue(
                    defined($constname),
                    "Constant '$constname', found in Reference, does not exists."
                );
            }
            if (!in_array($constname, self::$ignoredconstants)) {
                if (($min && version_compare(PHP_VERSION, $min)<0)
                    || ($max && version_compare(PHP_VERSION, $max)>0)
                ) {
                    $this->assertFalse(
                        defined($constname),
                        "Constant '$constname', found in Reference ($min,$max), exists."
                    );
                }
            }
        }
    }

    /**
     * Test that each constants are defined in reference
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetConstantsFromExtension()
    {
        if (is_null(self::$ref)) {
            return;
        }

        $const = get_defined_constants(true);

        foreach (self::$ref['extensions'] as $extname => $opt) {
            if (isset($const[$extname])) {
                // Test if each constants are in reference
                foreach ($const[$extname] as $constname => $value) {
                    if (!in_array($constname, self::$ignoredconstants)) {
                        $this->assertArrayHasKey(
                            $constname,
                            self::$ref['constants'],
                            "Defined constant '$constname' not known in Reference."
                        );
                    }
                }
            }
        }
    }

    /**
     * Test than all referenced classes exists
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetClassesFromReference()
    {
        if (is_null(self::$ref)) {
            return;
        }

        foreach (self::$ref['classes'] as $classname => $range) {
            list($min, $max) = $range;
            if (array_key_exists('excludes', $range)
                && in_array(PHP_VERSION, $range['excludes'])
            ) {
                array_push(self::$ignoredclasses, $constname);
            }
            if (!in_array($classname, self::$optionalclasses)
                && (empty($min) || version_compare(PHP_VERSION, $min)>=0)
                && (empty($max) || version_compare(PHP_VERSION, $max)<=0)
            ) {
                $this->assertTrue(
                    class_exists($classname, false),
                    "Class '$classname', found in Reference, does not exists."
                );
            }
            if (!in_array($classname, self::$ignoredclasses)) {
                if (($min && version_compare(PHP_VERSION, $min)<0)
                    || ($max && version_compare(PHP_VERSION, $max)>0)
                ) {
                    $this->assertFalse(
                        class_exists($classname, false),
                        "Class '$classname', found in Reference ($min,$max), exists."
                    );
                }
            }
        }
    }

    /**
     * Test that each classes are defined in reference
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetClassesFromExtension()
    {
        if (is_null(self::$ref)) {
            return;
        }

        foreach (self::$ref['extensions'] as $extname => $opt) {
            if ('internal' == $extname) {
                // only Core is a valid extension name for API reflection
                continue;
            }
            $extension = new ReflectionExtension($extname);
            $classes   = $extension->getClassNames();

            foreach ($classes as $classname) {
                if (class_exists($classname)) {
                    if (!in_array($classname, self::$ignoredclasses)) {
                        $this->assertArrayHasKey(
                            $classname,
                            self::$ref['classes'],
                            "Defined class '$classname' not known in Reference."
                        );
                    }
                } else {
                    if (!in_array($classname, self::$ignoredinterfaces)) {
                        $this->assertArrayHasKey(
                            $classname,
                            self::$ref['interfaces'],
                            "Defined interface '$classname' not known in Reference."
                        );
                    }
                }
            }
        }
    }

    /**
     * Test than all referenced interfaces exists
     *
     * @depends testReference
     * @group  reference
     * @return void
     */
    public function testGetInterfacesFromReference()
    {
        if (is_null(self::$ref)) {
            return;
        }

        foreach (self::$ref['interfaces'] as $intname => $range) {
            list($min, $max) = $range;
            if (array_key_exists('excludes', $range)
                && in_array(PHP_VERSION, $range['excludes'])
            ) {
                array_push(self::$optionalinterfaces, $intname);
            }

            if (!in_array($intname, self::$optionalinterfaces)
                && (empty($min) || version_compare(PHP_VERSION, $min)>=0)
                && (empty($max) || version_compare(PHP_VERSION, $max)<=0)
            ) {
                $this->assertTrue(
                    interface_exists($intname, false),
                    "Interface '$intname', found in Reference, does not exists."
                );
            }
        }
    }

}
