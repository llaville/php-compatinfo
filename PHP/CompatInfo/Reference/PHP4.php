<?php
/**
 * Data dictionary for PHP4 references
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/CompatInfo/Reference/PluginsAbstract.php';

/**
 * Data dictionary for PHP4 references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_PHP4 extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * @var array
     */
    protected $extensionReferences = array();

    /**
     * Autoloader for PHP_CompatInfo_Reference_PHP4 or 5
     *
     * @param string $className Name of the class trying to load
     *
     * @return void
     */
    public static function autoload($className)
    {
        static $classes = null;
        static $path    = null;

        if ($classes === null) {
            $classes = array(
                'PHP_CompatInfo_Reference_Bcmath'
                    => 'PHP/CompatInfo/Reference/bcmath.php',
                'PHP_CompatInfo_Reference_Bz2'
                    => 'PHP/CompatInfo/Reference/bz2.php',
                'PHP_CompatInfo_Reference_Calendar'
                    => 'PHP/CompatInfo/Reference/calendar.php',
                'PHP_CompatInfo_Reference_Core'
                    => 'PHP/CompatInfo/Reference/core.php',
                'PHP_CompatInfo_Reference_Ctype'
                    => 'PHP/CompatInfo/Reference/ctype.php',
                'PHP_CompatInfo_Reference_Curl'
                    => 'PHP/CompatInfo/Reference/curl.php',
                'PHP_CompatInfo_Reference_Date'
                    => 'PHP/CompatInfo/Reference/date.php',
                'PHP_CompatInfo_Reference_Dom'
                    => 'PHP/CompatInfo/Reference/dom.php',
                'PHP_CompatInfo_Reference_Gd'
                    => 'PHP/CompatInfo/Reference/gd.php',
                'PHP_CompatInfo_Reference_Hash'
                    => 'PHP/CompatInfo/Reference/hash.php',
                'PHP_CompatInfo_Reference_Libxml'
                    => 'PHP/CompatInfo/Reference/libxml.php',
                'PHP_CompatInfo_Reference_Mbstring'
                    => 'PHP/CompatInfo/Reference/mbstring.php',
                'PHP_CompatInfo_Reference_Pcre'
                    => 'PHP/CompatInfo/Reference/pcre.php',
                'PHP_CompatInfo_Reference_PDO'
                    => 'PHP/CompatInfo/Reference/pdo.php',
                'PHP_CompatInfo_Reference_SPL'
                    => 'PHP/CompatInfo/Reference/spl.php',
                'PHP_CompatInfo_Reference_Sockets'
                    => 'PHP/CompatInfo/Reference/sockets.php',
                'PHP_CompatInfo_Reference_Standard'
                    => 'PHP/CompatInfo/Reference/standard.php',
                'PHP_CompatInfo_Reference_Tokenizer'
                    => 'PHP/CompatInfo/Reference/tokenizer.php',
                'PHP_CompatInfo_Reference_Xdebug'
                    => 'PHP/CompatInfo/Reference/xdebug.php',
                'PHP_CompatInfo_Reference_Xml'
                    => 'PHP/CompatInfo/Reference/xml.php',
                'PHP_CompatInfo_Reference_Zlib'
                    => 'PHP/CompatInfo/Reference/zlib.php',
            );
            $path = dirname(dirname(dirname(dirname(__FILE__)))) 
                . DIRECTORY_SEPARATOR;
        }

        if (isset($classes[$className])) {
            include $path . $classes[$className];
        }
    }

    /**
     * Class constructor of PHP4 References
     *
     * @param array $extensions OPTIONAL List of extensions to look for
     *                          (default: all supported by current platform)
     */
    public function __construct($extensions = null)
    {
        spl_autoload_register('self::autoload');

        if (isset($extensions)) {
            $extensions = (array)$extensions;
        } else {
            $extensions = get_loaded_extensions();
        }
        // forward compatibility with PHP 5.3 and greater
        if (version_compare(PHP_VERSION, '5.3.0', 'lt')) {
            $extensions[] = 'Core';
        }

        foreach ($extensions as $extension) {
            $refClassName = 'PHP_CompatInfo_Reference_' . ucfirst($extension);
            if (class_exists($refClassName, true)) {
                $this->extensionReferences[$extension] = $refClassName;
            } else {
                $this->warnings[] = "Cannot load extension reference '$extension'";
            }
        }
    }

    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = '4')
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = '4')
    {
        $extensions = array();

        foreach ($this->extensionReferences as $ext => $extRefClass) {
            if (is_null($extension) || ($ext == $extension)) {
                $ref = new $extRefClass;
                $values = $ref->getExtensions($extension, $version);

                $extensions = array_merge(
                    $extensions,
                    $values
                );
                unset($ref);
            }
        }

        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = '4')
    {
        $interfaces = array();

        foreach ($this->extensionReferences as $ext => $extRefClass) {
            if (is_null($extension) || ($ext == $extension)) {
                $ref = new $extRefClass;
                $values = $ref->getInterfaces($extension, $version);

                $interfaces = array_merge(
                    $interfaces,
                    $this->combineExtension($ext, $values)
                );
                unset($ref);
            }
        }

        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = '4')
    {
        $classes = array();

        foreach ($this->extensionReferences as $ext => $extRefClass) {
            if (is_null($extension) || ($ext == $extension)) {
                $ref = new $extRefClass;
                $values = $ref->getClasses($extension, $version);

                $classes = array_merge(
                    $classes,
                    $this->combineExtension($ext, $values)
                );
                unset($ref);
            }
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getFunctions($extension = null, $version = '4')
    {
        $functions = array();

        foreach ($this->extensionReferences as $ext => $extRefClass) {
            if (is_null($extension) || ($ext == $extension)) {
                $ref = new $extRefClass;
                $values = $ref->getFunctions($extension, $version);

                $functions = array_merge(
                    $functions,
                    $this->combineExtension($ext, $values)
                );
                unset($ref);
            }
        }

        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getConstants($extension = null, $version = '4')
    {
        $constants = array();

        foreach ($this->extensionReferences as $ext => $extRefClass) {
            if (is_null($extension) || ($ext == $extension)) {
                $ref = new $extRefClass;
                $values = $ref->getConstants($extension, $version);

                $constants = array_merge(
                    $constants,
                    $this->combineExtension($ext, $values)
                );
                unset($ref);
            }
        }

        return $constants;
    }

}
