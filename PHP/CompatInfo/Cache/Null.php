<?php
/**
 * Class that allow to disable cache system
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
 * Class that allow to disable cache system
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Cache_Null implements PHP_CompatInfo_Cache_Interface
{
    /**
     * Tests if $source filename exists in the cache
     *
     * @param string $source Source filename
     *
     * @return bool
     */
    public function isCached($source)
    {
        return false;
    }

    /**
     * Returns contents of $source filename parsed data from the cache
     *
     * @param string $source Source filename
     *
     * @return array
     */
    public function getCache($source)
    {
    }

    /**
     * Saves contents of $source filename parsed data into the cache
     *
     * @param string $source Source filename
     * @param array  $data   Parsed data
     *
     * @return void
     */
    public function setCache($source, $data)
    {
    }

}
