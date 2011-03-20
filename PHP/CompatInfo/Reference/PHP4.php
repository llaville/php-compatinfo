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

require_once dirname(dirname(__FILE__)) . '/Autoload.php';

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
     * Class constructor of PHP4 References
     *
     * @param array $extensions OPTIONAL List of extensions to look for
     *                          (default: all supported by current platform)
     */
    public function __construct($extensions = null)
    {
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
