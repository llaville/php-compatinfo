<?php
/**
 * Class to write cached data on a local file system
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/CompatInfo/Cache/Interface.php';

class PHP_CompatInfo_Cache_File implements PHP_CompatInfo_Cache_Interface
{
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
     */
    public function __construct($options)
    {
        $this->options = array_merge(
            array(
                'gc_probability' => 1,       // probability 1/100
                'gc_maxlifetime' => 86400,   // one day, 60 * 60 * 24
            ),
            $options
        );
    }
    
    /**
     * Garbage collector
     */
    public function __destruct()
    {
        // Calls the garbage collector with a certain probability
        if (rand(1, 100) < $this->options['gc_probability']) {
        
            $iterator = new DirectoryIterator(
                realpath($this->options['save_path'])
            );
            foreach ($iterator as $fileinfo) {
                if ($fileinfo->isFile()) {
                    if ($fileinfo->getMTime() <= 
                        (time() - $this->options['gc_maxlifetime'])) {
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
        $fn = realpath($this->options['save_path']) . DIRECTORY_SEPARATOR .
            'pci_' . md5($source);

        $cached = file_exists($fn);
        if ($cached) {
            $cache_id = md5_file($source);
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
        $cache_id = md5_file($source);

        if (!isset($this->cache[$cache_id]) ||
            !file_exists($this->cache[$cache_id])
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
        $fn = realpath($this->options['save_path']) . DIRECTORY_SEPARATOR .
            'pci_' . md5($source);

        $bytes = file_put_contents($fn, serialize($data));

        if ($bytes !== false) {
            $cache_id = md5_file($source);
            $this->cache[$cache_id] = $fn;
        }
    }

}
