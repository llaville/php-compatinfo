<?php
/**
 * Class to write cached data on a local file system
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
 * Class to write cached data on a local file system
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Cache_File implements PHP_CompatInfo_Cache_Interface
{
    /**
     * Normalize cache file by a prefix
     */
    const PREFIX = 'phpci';

    /**
     * Version of cache file
     */
    const VERSION = '@package_version@';

    /**
     * Configuration options of file cache support
     * @var array
     */
    protected $options = array();

    /**
     * Cache TOC
     * @var array
     */
    protected $cache = array();

    /**
     * Class constructor of file cache support
     *
     * @param array $options Configuration options of file cache support
     *              - "save_path" :
     *                directory where to write data
     *              - "gc_probability" :
     *                probability that the gc (garbage collection) routine is started
     *              - "gc_maxlifetime" :
     *                delete all entries not used since n seconds
     *
     * @throws PHP_CompatInfo_Exception
     */
    public function __construct($options)
    {
        $cacheOptions = array_merge(
            array(
                'gc_probability' => 1,       // probability 1/100
                'gc_maxlifetime' => 86400,   // one day, 60 * 60 * 24
            ),
            $options['cacheOptions']
        );

        $cacheOptions['reference'] = $options['reference'];
        $cacheOptions['exclude']   = $options['exclude'];

        $this->options = $cacheOptions;

        if (file_exists($this->options['save_path']) === false) {
            throw new PHP_CompatInfo_Exception(
                "Directory '" . $this->options['save_path'] . "' does not exists.",
                PHP_CompatInfo_Exception::INVALIDARGUMENT
            );
        }

        // Check cache validity
        $current = get_loaded_extensions();
        sort($current);
        $current['reference'] = $this->options['reference'];
        $current['exclude']   = $this->options['exclude'];
        $file = realpath($this->options['save_path']) . DIRECTORY_SEPARATOR . self::PREFIX;

        if (file_exists($file) && !is_file($file)) {
            throw new PHP_CompatInfo_Exception(
                "Directory '$file' exists and cannot be used as the main cache file.",
                PHP_CompatInfo_Exception::INVALIDARGUMENT
            );
        }

        $ok = true;
        if (file_exists($file)) {
            $prev = unserialize(file_get_contents($file));
            if (!is_array($prev)
                || !isset($prev['reference'])
                || !isset($prev['exclude'])
                || (count($prev) !== count($current))
            ) {
                $ok = false;
            } else {
                $excludeKeys1 = array_keys($prev['exclude']);
                $excludeKeys2 = array_keys($this->options['exclude']);
                if (count($excludeKeys1) < count($excludeKeys2)) {
                    $temp         = $excludeKeys1;
                    $excludeKeys1 = $excludeKeys2;
                    $excludeKeys2 = $temp;
                }
                if (count(array_diff($excludeKeys1, $excludeKeys2))) {
                    $ok = false;
                } else {
                    foreach ($prev['exclude'] as $element => $data) {
                        $info = $this->options['exclude'][$element];
                        if (count($data) < count($info)) {
                            $temp = $data;
                            $data = $info;
                            $info = $temp;
                        }
                        if (count(array_diff($data, $info))) {
                            $ok = false;
                            break;
                        }
                    }
                    if ($ok) {
                        unset($prev['exclude'], $current['exclude']);
                        if (count(array_diff($prev, $current))) {
                            $ok = false;
                        }
                    }
                }
            }
        } else {
            $ok = false;
        }
        if (!$ok) {
            // Clean all the cache content
            $this->_clean();
            file_put_contents($file, serialize($current));
        }
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        // Calls the garbage collector with a certain probability
        if (rand(1, 100) < $this->options['gc_probability']) {
            $this->_clean($this->options['gc_maxlifetime']);
        }
    }

    /**
     * Garbage collector
     *
     * @param integer validity delay, default -1 to clean all
     */
    private function _clean($delay=-1)
    {
        $iterator = new DirectoryIterator(
            realpath($this->options['save_path'])
        );
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {
                if (preg_match(
                    '/^' . self::PREFIX . '_/',
                    $fileinfo->getFilename()
                )) {
                    if ($fileinfo->getMTime() <=
                        (time() - $delay)
                    ) {
                        unlink($fileinfo->getPathname());
                    }
                }
            }
        }
    }

    /**
     * Tests if $source filename exists in the cache
     *
     * @param string $source Source filename
     *
     * @return bool
     */
    public function isCached($source)
    {
        $cache_id = sha1_file($source);

        $fn = realpath($this->options['save_path']) . DIRECTORY_SEPARATOR .
            self::PREFIX . '_' .
            sha1($source . '/' . self::VERSION . '/' . $cache_id);

        $cached = file_exists($fn);

        if ($cached) {
            $this->cache[$cache_id] = $fn;
        }
        return $cached;
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
        $cache_id = sha1_file($source);

        if (!isset($this->cache[$cache_id])
            || !file_exists($this->cache[$cache_id])
        ) {
            return false;
        }

        $contents = file_get_contents($this->cache[$cache_id]);
        return unserialize($contents);
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
        $cache_id = sha1_file($source);

        $fn = realpath($this->options['save_path']) . DIRECTORY_SEPARATOR .
            self::PREFIX . '_' .
            sha1($source . '/' . self::VERSION . '/' . $cache_id);

        $bytes = file_put_contents($fn, serialize($data));

        if ($bytes !== false) {
            $this->cache[$cache_id] = $fn;
        }
    }

}
