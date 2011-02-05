<?php
/**
 * Data dictionary for PEAR references
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

require_once 'PHP/CompatInfo/Reference/PHP5.php';

/**
 * Data dictionary for PEAR references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_PEAR extends PHP_CompatInfo_Reference_PHP5
{
    /**
     * Autoloader for PHP_CompatInfo_Reference_PEAR
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
                'PHP_CompatInfo_Reference_Net_Growl'
                    => 'PHP/CompatInfo/Reference/netgrowl.php',
            );
            $path = dirname(dirname(dirname(dirname(__FILE__))))
                . DIRECTORY_SEPARATOR;
        }

        if (isset($classes[$className])) {
            include $path . $classes[$className];
        }
    }

    /**
     * Class constructor of PEAR References
     *
     * @param array $extensions OPTIONAL List of extensions/packages to look for
     *                          (default: all supported by current platform)
     */
    public function __construct($extensions = null)
    {
        spl_autoload_register('PHP_CompatInfo_Reference_PHP4::autoload');
        spl_autoload_register('PHP_CompatInfo_Reference_PEAR::autoload');

        if (isset($extensions)) {
            $extensions = (array)$extensions;
        } else {
            $extensions = get_loaded_extensions();
        }
        // forward compatibility with PHP 5.3 and greater
        if (version_compare(PHP_VERSION, '5.3.0', 'lt')) {
            $extensions[] = 'Core';
        }

        $extensions[] = 'Net_Growl';

        foreach ($extensions as $extension) {
            $refClassName = 'PHP_CompatInfo_Reference_' . ucfirst($extension);
            if (class_exists($refClassName, true)) {
                $this->extensionReferences[$extension] = $refClassName;
            } else {
                $this->warnings[] = "Cannot load package reference '$extension'";
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
    /*      
    public function getAll($extension = null, $version = null)
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
    */
}
