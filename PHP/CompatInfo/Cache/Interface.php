<?php
/**
 * Common Interface to all cache supports
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Common Interface to all cache supports
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
interface PHP_CompatInfo_Cache_Interface
{
    /**
     * Tests if $source filename exists in the cache
     *
     * @param string $source Source filename
     *
     * @return bool
     */
    public function isCached($source);

    /**
     * Returns contents of $source filename parsed data from the cache
     *
     * @param string $source Source filename
     *
     * @return array
     */
    public function getCache($source);

    /**
     * Saves contents of $source filename parsed data into the cache
     *
     * @param string $source Source filename
     * @param array  $data   Parsed data
     *
     * @return void
     */
    public function setCache($source, $data);
}
