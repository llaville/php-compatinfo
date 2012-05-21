<?php
/**
 * Data dictionary for PHP5 references
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
 * Data dictionary for ALL references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release ?????
 */
class PHP_CompatInfo_Reference_ALL extends PHP_CompatInfo_Reference_PHP4
{
    /**
     * Class constructor of ALL References
     *
     * @param array $extensions OPTIONAL List of extensions to look for
     *                          (default: all supported by current platform)
     */
    public function __construct($extensions = null)
    {
        if (!isset($extensions)) {
            $extensions = self::getDatabaseExtensions();
        }
        parent::__construct($extensions);
    }

    /**
     * Get all extensions know in the database
     * 
     * @return array
     */
    static public function getDatabaseExtensions()
    {
        $dir = new DirectoryIterator(dirname(__FILE__));
        $excludes = array(
            'PluginsAbstract.php', 'PHP4.php', 'PHP5.php', 'ALL.php'
        );
        $exceptions = array(
            'core'       => 'Core',
            'oauth'      => 'OAuth',
            'pdo'        => 'PDO',
            'phar'       => 'Phar',
            'reflection' => 'Reflection',
            'simplexml'  => 'SimpleXML',
            'spl'        => 'SPL',
            'sqlite'     => 'SQLite',
        );
        $extensions = array();
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile()) {
                $fn = $fileinfo->getFilename();
                if (in_array($fn, $excludes)) {
                    continue;
                }
                $name = basename($fn, '.php');
                if (array_key_exists($name, $exceptions)) {
                    $name = $exceptions[$name];
                }
                $extensions[] = $name;
            }
        }

        return $extensions;
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
    public function getAll($extension = null, $version = null)
    {
        $references = parent::getAll($extension, $version);
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
    public function getExtensions($extension = null , $version = null)
    {
        $extensions = parent::getExtensions($extension, $version);
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
    public function getInterfaces($extension = null , $version = null)
    {
        $interfaces = parent::getInterfaces($extension, $version);
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
    public function getClasses($extension = null, $version = null)
    {
        $classes = parent::getClasses($extension, $version);
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
    public function getFunctions($extension = null, $version = null)
    {
        $functions = parent::getFunctions($extension, $version);
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
    public function getConstants($extension = null, $version = null)
    {
        $constants = parent::getConstants($extension, $version);
        return $constants;
    }
}
