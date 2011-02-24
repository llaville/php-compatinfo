<?php
/**
 * Base class for cache system
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

/**
 * Base class for cache system
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Cache
{
    /**
     * @var array
     */
    protected static $cache = array();

    /**
     * Autoloader for PHP_CompatInfo_Cache
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
                'PHP_CompatInfo_Cache_Interface'
                    => 'PHP/CompatInfo/Cache/Interface.php',
                'PHP_CompatInfo_Cache_Null' 
                    => 'PHP/CompatInfo/Cache/Null.php',
                'PHP_CompatInfo_Cache_File' 
                    => 'PHP/CompatInfo/Cache/File.php',
            );
            $path = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
        }

        if (isset($classes[$className])) {
            include $path . $classes[$className];
        }
    }

    /**
     * Gets unique instance of a cache system
     *
     * @param string $driver  Cache type
     * @param array  $options OPTIONAL Configuration options of this $driver
     *
     * @return PHP_CompatInfo_Cache_Interface
     */
    public static function getInstance($driver = 'file', array $options = null)
    {
        spl_autoload_register('PHP_CompatInfo_Cache::autoload');

        if (!isset(self::$cache[$driver])) {
            $className = 'PHP_CompatInfo_Cache_' . ucfirst($driver);

            if (!class_exists($className, true)) {
                throw new PHP_CompatInfo_Exception(
                    'Cache driver "' . $driver . '" not found.'
                );
            }
            self::$cache[$driver] = new $className($options);
        }

        return self::$cache[$driver];
    }

}
