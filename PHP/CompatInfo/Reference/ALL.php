<?php
/**
 * Data dictionary for ALL references
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Data dictionary for ALL references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_ALL
    extends PHP_CompatInfo_Reference_PHP4
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
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getAll($extension = null, $version = null, $condition = null)
    {
        $references = parent::getAll($extension, $version, $condition);
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null , $version = null, $condition = null)
    {
        $extensions = parent::getExtensions($extension, $version, $condition);
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getInterfaces($extension = null , $version = null, $condition = null)
    {
        $interfaces = parent::getInterfaces($extension, $version, $condition);
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $classes = parent::getClasses($extension, $version, $condition);
        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $functions = parent::getFunctions($extension, $version, $condition);
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $constants = parent::getConstants($extension, $version, $condition);
        return $constants;
    }
}
