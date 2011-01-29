<?php
/**
 * Check compatibility of chunk of PHP code
 *
 * @method array getExcludes()   getExcludes(category = null, $pattern = null)
 *         Returns informations on parsing results about excludes
 * @method array getIncludes()   getIncludes(category = null, $pattern = null)
 *         Returns informations on parsing results about includes
 * @method array getInterfaces() getInterfaces(category = null, $pattern = null)
 *         Returns informations on parsing results about interfaces
 * @method array getClasses()    getClasses(category = null, $pattern = null)
 *         Returns informations on parsing results about classes
 * @method array getFunctions()  getFunctions(category = null, $pattern = null)
 *         Returns informations on parsing results about functions
 * @method array getConstants()  getConstants(category = null, $pattern = null)
 *         Returns informations on parsing results about constants
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

class PHP_CompatInfo implements SplSubject, IteratorAggregate, Countable
{
    /**
     * @var array
     */
    protected $reference;

    /**
     * @var array
     */
    protected $warnings = array();

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $excludes;

    /**
     * @var array
     */
    protected $includes;

    /**
     * @var array
     */
    protected $versions;

    /**
     * @var array
     */
    protected $extensions;

    /**
     * @var array
     */
    protected $interfaces;

    /**
     * @var array
     */
    protected $classes;

    /**
     * @var array
     */
    protected $functions;

    /**
     * @var array
     */
    protected $constants;

    /**
     * @var array
     */
    protected $results;

    /**
     * Observers connected
     * @var SplObjectStorage
     */
    private $_observers;

    /**
     * @var array
     */
    private $_versionsRef;

    /**
     * @var array
     */
    private $_versionsLatest;

    /**
     * @var array
     */
    private $_event;

    /**
     * @var integer
     */
    protected $startTime;

    /**
     * Autoloader for PHP_CompatInfo
     *
     * @param string $className Name of the class trying to load
     *
     * @return void
     */
    public static function autoload($className)
    {
        static $classes = NULL;
        static $path = NULL;

        if ($classes === NULL) {
            //include 'PHP/Token/Stream/Autoload.php';

            $classes = array(
                'PHP_CompatInfo_TokenStream'      => 'PHP/CompatInfo/TokenStream.php',

                'PHP_CompatInfo_TokenParser'      => 'PHP/CompatInfo/TokenParser.php',
                'PHP_CompatInfo_Token_STRING'     => 'PHP/CompatInfo/TokenParser.php',
                'PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING'
                                                  => 'PHP/CompatInfo/TokenParser.php',
                'PHP_CompatInfo_Exception'        => 'PHP/CompatInfo/Exception.php',
                'PHP_CompatInfo_Cache'            => 'PHP/CompatInfo/Cache.php',
                'PHP_CompatInfo_Reference_PHP4'   => 'PHP/CompatInfo/Reference/PHP4.php',
                'PHP_CompatInfo_Reference_PHP5'   => 'PHP/CompatInfo/Reference/PHP5.php',
            );
            $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
        }

        if (isset($classes[$className])) {
            include $path . $classes[$className];
        }
    }

    /**
     * Class constructor
     *
     * @param array $options Configure options
     */
    public function __construct(array $options = null)
    {
        spl_autoload_register('PHP_CompatInfo::autoload');

        $this->_observers = new SplObjectStorage();

        $this->_versionsLatest = array('4.0.0', '');

        $defaultOptions = array(
            'recursive'        => false,
            'reference'        => 'PHP5',
            'referencePlugins' => array(
                'PHP4' => array(
                    'class' => 'PHP_CompatInfo_Reference_PHP4',
                    'file'  => '',
                    'args'  => array()
                ),
                'PHP5' => array(
                    'class' => 'PHP_CompatInfo_Reference_PHP5',
                    'file'  => '',
                    'args'  => array()
                ),
            ),
            'verbose'          => false,
            'fileExtensions'   => array('php', 'inc', 'phtml'),
            'cacheDriver'      => 'file',
            'cacheOptions'     => array(
                'save_path' => '/tmp'
            ),
            'listeners'        => array(),
        );

        if (isset($options)) {
            $options = array_merge($defaultOptions, $options);
        } else {
            $options = $defaultOptions;
        }
        $this->options = $options;

        if (isset($this->options['extensions'])) {
            $options = array(
                'extensions' => $this->options['extensions']
            );
        } else {
            $options = null;
        }

        // attaches all valid observers
        foreach ($this->options['listeners'] as $listener) {
            if ($listener instanceof SplObserver) {
                $this->attach($listener);
            }
        }

        // loads data dictionaries reference
        $this->loadReference($this->options['reference'], $options);
    }

    /**
     * Attaches an observer so that it can be notified of updates
     *
     * @param SplObserver $observer Instance of SplObserver to attach
     *
     * @return PHP_CompatInfo
     */
    public function attach(SplObserver $observer)
    {
        $this->_observers->attach($observer);
        return $this;
    }

    /**
     * Detaches an observer from the subject to no longer notify it of updates
     *
     * @param SplObserver $observer Instance of SplObserver to detach
     *
     * @return PHP_CompatInfo
     */
    public function detach(SplObserver $observer)
    {
        $this->_observers->detach($observer);
        return $this;
    }

    /**
     * Notifies all attached observers
     *
     * @return void
     */
    public function notify()
    {
        // $this is intercepted by the iterator (@see getIterator())
        foreach ($this as $observer) {
            try {
                $observer->update($this); // delegation

            } catch(Exception $e) {
                /**
                 * serious problem occurred in the observer
                 * that is recorded in the system log
                 */
                error_log($e->getMessage());
            }
        }
    }

    /**
     * Creates an external iterator to allow to get connected observers
     *
     * @link http://www.php.net/manual/en/class.iteratoraggregate.php
     */
    public function getIterator()
    {
        return $this->_observers;           // SplObjectStorage is iterative
    }

    /**
     * Count all observers connected
     *
     * @return int
     * @link   http://www.php.net/manual/en/class.countable.php
     */
    public function count()
    {
        return count($this->_observers);    // SplObjectStorage is countable
    }

    /**
     * Returns informations of latest event.
     * Used by observers connected
     *
     * @return array
     */
    public function getEvent()
    {
        return $this->_event;
    }

    /**
     * Publish the most recent event
     *
     * @param array $event
     *
     * @return void
     */
    protected function setEvent($event)
    {
        $this->_event = array_merge(
            $event,
            array('timestamp' => time())
        );

        $this->notify();
    }

    /**
     * Tells if some messages were emitted in the current session
     *
     * @return bool
     */
    public function hasWarnings()
    {
        return (count($this->warnings) > 0);
    }

    /**
     * Returns messages emitted in the current session since last purge
     *
     * @param bool $purge Set in order to empty the warning stack
     *
     * @return array
     */
    public function getWarnings($purge = false)
    {
        $ret = $this->warnings;
        if ($purge) {
            $this->warnings = array();
        }
        return $ret;
    }

    /**
     * Adds a new message to the stack,
     * and notify all listeners.
     *
     * @param string $warn new message
     *
     * @return void
     */
    public function addWarning($warn)
    {
        $this->warnings[] = $warn;

        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'warning',
                'message' => $warn
            )
        );
    }

    /**
     * Returns file list to process
     *
     * That will exclude all files that match regular expression given on
     * position key of array $excludesPattern.
     * That will also excluse all files that don't match regular expression
     * given on position -1 of array $excludesPattern (file extensions).
     *
     * @param mixed $dataSource      Data source (single file, folder, or file list)
     * @param bool  $recursive       Includes the contents of subdirectories
     * @param array $excludesPattern Rules that files should match
     *
     * @return array
     * @throws PHP_CompatInfo_Exception If invalid data source format
     */
    public static function getFilelist($dataSource, $recursive, $excludesPattern)
    {
        if (is_string($dataSource)) {
            $files = array();

            $suffix = '.php';
            if (is_dir($dataSource)) {
                $directory = $dataSource;
                $prefix    = '';

                if ($recursive === false) {
                    $iterator = new DirectoryIterator($directory);
                } else {
                    $iterator = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($directory)
                    );
                }

                foreach ($iterator as $fileinfo) {
                    if ($fileinfo->isFile()) {
                        $files[] = $fileinfo->getPathname();
                    }
                }
            } else {
                $directory = dirname($dataSource);
                $prefix    = basename($dataSource, $suffix);

                $files[] = realpath($dataSource);
            }

        } elseif (is_array($dataSource)) {
            $files = $dataSource;

        } else {
            throw new PHP_CompatInfo_Exception(
                "Invalid data source format. " .
                "Given '" . gettype($dataSource) . "'",
                PHP_CompatInfo_Exception::INVALIDARGUMENT
            );
        }

        if (is_array($excludesPattern) && (count($excludesPattern) > 0)) {
            for ($f = count($files) - 1; $f >= 0; $f--) {
                foreach ($excludesPattern as $p => $pattern) {
                    if ((bool)preg_match("/$pattern/", $files[$f]) === ($p >= 0)) {
                        unset($files[$f]);
                        continue 2;
                    }
                }
            }
        }
        return $files;
    }

    /**
     * Parse a data source
     * searching for interfaces, classes, functions, constants, includes
     * and conditional code
     *
     * @param mixed $dataSource Data source (single file, directory, files list)
     *
     * @return bool FALSE when nothing parsed, TRUE otherwise
     */
    public function parse($dataSource)
    {
        $this->startScanSource($dataSource);

        if (isset($this->options['exclude']['files'])) {
            $excludes = $this->options['exclude']['files'];
        } else {
            $excludes = array();
        }
        $excludes[-1] = '\.(' . implode('|', $this->options['fileExtensions']) . ')$';

        $files = self::getFilelist(
            $dataSource, $this->options['recursive'], $excludes
        );

        if (php_sapi_name() === 'cli'
            && isset($this->options['consoleProgress'])
            && ($this->options['consoleProgress'] === true)
        ) {
            $consoleProgress = true;
        } else {
            $consoleProgress = false;
        }
        if ($consoleProgress) {
            $out      = new ezcConsoleOutput();
            $progress = new ezcConsoleProgressbar($out, count($files));
        }

        $this->results = array();
        $i             = 0;
        $indexes       = count($files);
        $process       = ($indexes > 0);

        foreach($files as $source) {
            $i++;
            $this->startScanFile($source, $i, $indexes);
            $this->scan($source);
            $this->endScanFile($source, $i, $indexes);

            if ($consoleProgress) {
                $progress->advance();
            }
        }
        if ($consoleProgress) {
            $progress->finish();
        }

        $this->endScanSource();

        return $process;
    }

    /**
     * Parse a single file
     * searching for interfaces, classes, functions, constants, includes
     * and conditional code
     *
     * @param string $source Source filename
     *
     * @return void
     */
    protected function scan($source)
    {
        $cache = PHP_CompatInfo_Cache::getInstance(
            $this->options['cacheDriver'], $this->options['cacheOptions']
        );
        $cached = $cache->isCached($source);

        if ($cached) {
            $results = $cache->getCache($source);

            $this->excludes   = $results['excludes'];
            $this->includes   = $results['includes'];
            $this->versions   = $results['versions'];
            $this->extensions = $results['extensions'];
            $this->interfaces = $results['interfaces'];
            $this->classes    = $results['classes'];
            $this->functions  = $results['functions'];
            $this->constants  = $results['constants'];
            $conditions       = $results['conditions'];

        } else {

            $this->excludes   = array();
            $this->includes   = array();
            $this->versions   = array('4.0.0', '');
            $this->extensions = array();
            $this->interfaces = array();
            $this->classes    = array();
            $this->functions  = array();
            $this->constants  = array();
            $conditions       = false;

            /**
             * @link http://www.php.net/manual/en/tokens.php
             *       List of Parser Tokens
             */

            $options = array(
                'PHP_Token_STRING' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenString'),
                    'PHP_CompatInfo_Token_STRING'
                ),
                'PHP_Token_CONSTANT_ENCAPSED_STRING' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenConstant'),
                    'PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING'
                ),
                // already available in master branch of PHP_TokenStream,
                // but still waiting for a stable release !
                'PHP_Token_REQUIRE_ONCE' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenIncludes'),
                    'PHP_CompatInfo_Token_REQUIRE_ONCE'
                ),
                'PHP_Token_REQUIRE' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenIncludes'),
                    'PHP_CompatInfo_Token_REQUIRE'
                ),
                'PHP_Token_INCLUDE_ONCE' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenIncludes'),
                    'PHP_CompatInfo_Token_INCLUDE_ONCE'
                ),
                'PHP_Token_INCLUDE' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenIncludes'),
                    'PHP_CompatInfo_Token_INCLUDE'
                ),
                'PHP_Token_INTERFACE' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenInterface'),
                    'PHP_CompatInfo_Token_INTERFACE'
                ),
                'PHP_Token_CLASS' => array(
                    array('PHP_CompatInfo_TokenParser', 'parseTokenClass'),
                    'PHP_CompatInfo_Token_CLASS'
                ),
            );
            $tokenStream = new PHP_CompatInfo_TokenStream($source, $options);

            /**
             * @link http://www.php.net/manual/en/language.control-structures.php
             *       Control Structures
             */
            $this->includes = $tokenStream->getIncludes(true);

            /**
             * @link http://www.php.net/manual/en/language.oop5.interfaces.php
             *       Object Interfaces
             */
            $interfaces = array_merge_recursive(
                $tokenStream->getInterfaces(),
                (array)$tokenStream['allInterfaces']
            );
            $this->getInfo('interfaces', '5.0.0', $interfaces, $source);

            /**
             * @link http://www.php.net/manual/en/language.oop5.php
             *       Classes and Objects
             */
            $classes = array_merge_recursive(
                $tokenStream->getClasses(),
                (array)$tokenStream['allClasses']
            );
            $this->getInfo('classes', '4.0.0', $classes, $source);

            /**
             * @link http://www.php.net/manual/en/language.constants.php
             *       Constants
             */
            $constants = $tokenStream['constants'];
            $this->getInfo('constants', '4.0.0', $constants, $source);

            /**
             * @link http://www.php.net/manual/en/functions.user-defined.php
             *       User-defined functions
             * @link http://www.php.net/manual/en/functions.internal.php
             *       Internal (built-in) functions
             */
            $functions = array_merge_recursive(
                $tokenStream->getFunctions(),
                (array)$tokenStream['internalFunctions']
            );
            $this->getInfo('functions', '4.0.0', $functions, $source);

        }

        $this->results[$source] = array(
            'excludes'   => $this->excludes,
            'includes'   => $this->includes,
            'versions'   => $this->versions,
            'extensions' => $this->extensions,
            'interfaces' => $this->interfaces,
            'classes'    => $this->classes,
            'functions'  => $this->functions,
            'constants'  => $this->constants,
            'conditions' => $conditions,
        );

        if ($conditions === false) {
            // search for conditional code
            $this->results[$source]['conditions'] = $this->getConditions(
                null, $source
            );
        }
        foreach ($this->results[$source]['conditions'] as $condition => $count) {
            if ($count > 0) {
                $this->addWarning("Found conditional code '$condition'");
            }
        }

        if (!$cached) {
            // write results in a cache to improve speed for later uses
            $cache->setCache($source, $this->results[$source]);
        }
    }

    /**
     * Returns parsing results for a single file or all data source
     *
     * @param string $source OPTIONAL Source filename
     *
     * @throws PHP_CompatInfo_Exception If source has not been parsed
     */
    public function toArray($source = null)
    {
        if (isset($source)) {
            if (isset($this->results[$source])) {
                $results = $this->results[$source];
            } else {
                throw new PHP_CompatInfo_Exception(
                    "Invalid source ID. Given '" . (string)$source . "'",
                    PHP_CompatInfo_Exception::RUNTIME
                );
            }
        } else {
            $results = $this->results;
        }
        return $results;
    }

    /**
     * Returns informations on parsing results about extensions
     *
     * @return array
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Magic methods to get informations on parsing results about
     * excludes, includes, interfaces, classes, functions, constants
     *
     * @param string $name Method name invoked
     * @param array  $args Method arguments provided
     *
     * @return array
     * @throws PHP_CompatInfo_Exception
     */
    public function __call($name, $args)
    {
        if (preg_match(
            '/get(?>(Excludes|Includes|Interfaces|Classes|Functions|Constants))/',
            $name,
            $matches)) {

            $group = strtolower($matches[1]);

            $category = (isset($args[0])) ? $args[0] : null;
            $pattern  = (isset($args[1])) ? $args[1] : null;

            if (isset($category) && !$this->isValid($category, $group)) {
                throw new PHP_CompatInfo_Exception(
                    "Invalid category. Given '$category'",
                    PHP_CompatInfo_Exception::RUNTIME
                );
            }

            if (!isset($category)) {
                $$group = $this->{$group};
            } elseif (isset($this->{$group}[$category])) {
                $$group = $this->{$group}[$category];
            } else {
                $$group = array();
            }
            if (isset($pattern)) {
                $items  = $$group;
                $$group = array();
                $n      = 0;
                foreach ($items as $i => $values) {
                    if (is_numeric($i)) {
                        if (preg_match("/$pattern/", $values)) {
                            ${$group}[$n] = $values;
                            $n++;
                        }
                    } else {
                        if (preg_match("/$pattern/", $i)) {
                            ${$group}[$i] = $values;
                        }
                    }
                }
            }

            return $$group;

        } else {
            throw new PHP_CompatInfo_Exception(
                "Invalid method. Given '$name'",
                PHP_CompatInfo_Exception::RUNTIME
            );
        }
    }

    /**
     * Gives for each conditional code level or just the $category
     * the usage count. Levels many be combined
     *
     * $category are either :
     * - function_exists  (level  1)
     * - extension_loaded (level  2)
     * - defined          (level  4)
     * - method_exists    (level 16)
     * - class_exists     (level 32)
     * - interface_exists (level 64)
     *
     * @param string $category OPTIONAL Level of conditional code
     * @param string $source   OPTIONAL Source filename
     *
     * @return array
     * @throws PHP_CompatInfo_Exception
     */
    public function getConditions($category = null, $source = null)
    {
        if (isset($category) && !$this->isValid($category, 'conditions')) {
            throw new PHP_CompatInfo_Exception(
                "Invalid category. Given '$category'",
                PHP_CompatInfo_Exception::RUNTIME
            );
        }

        if (isset($source)) {
            if (!isset($this->results[$source])) {
                throw new PHP_CompatInfo_Exception(
                    "Invalid source ID. Given '" . (string)$source . "'",
                    PHP_CompatInfo_Exception::RUNTIME
                );
            }
        }

        $ccl = array(
            'function_exists'  => 0,
            'extension_loaded' => 0,
            'defined'          => 0,
            'method_exists'    => 0,
            'class_exists'     => 0,
            'interface_exists' => 0,
        );

        foreach ($this->results as $file => $results) {
            if (isset($source) && $source != $file) {
                continue;
            }

            foreach (array_keys($ccl) as $name) {
                if (isset($category) && $category != $name) {
                    continue;
                }
                if (isset($results['functions']['Core'][$name]) &&
                    $results['functions']['Core'][$name]['excluded'] === false) {
                    $ccl[$name] += $results['functions']['Core'][$name]['uses'];
                }
            }
        }

        return $ccl;
    }

    /**
     * Returns the minimum and maximum PHP versions required
     * to run all files of the data source
     *
     * @return array
     */
    public function getVersions()
    {
        return $this->_versionsLatest;
    }

    /**
     * Loads a data dictionary references ($name)
     *
     * @param string $name    The data dictionary reference (PHP4, PHP5, ...)
     * @param array  $options OPTIONAL The driver configure options
     *
     * @return void
     * @throws PHP_CompatInfo_Exception
     */
    protected function loadReference($name, $options = null)
    {
        if (!isset($this->options['referencePlugins'][$name])) {
            throw new PHP_CompatInfo_Exception(
                "Plugin for reference '$name' is not registered",
                PHP_CompatInfo_Exception::RUNTIME
            );
        }
        $plugin = $this->options['referencePlugins'][$name];

        if (isset($options['extensions'])) {
            $extensions = $options['extensions'];
        } else {
            $extensions = null;
        }

        if (!class_exists($plugin['class'], FALSE) &&
            $plugin['file'] !== '') {
            include_once $plugin['file'];
        }
        if (class_exists($plugin['class'], TRUE)) {
            $arguments = $plugin['args'];
            array_unshift($arguments, $extensions);

            $pluginClass = new ReflectionClass($plugin['class']);
            $reference   = $pluginClass->newInstanceArgs($arguments);

            if (!$reference instanceof PHP_CompatInfo_Reference_PluginsAbstract) {
                throw new PHP_CompatInfo_Exception(
                    "Plugin '" . $plugin['class'] . "' is not valid",
                    PHP_CompatInfo_Exception::RUNTIME
                );
            }

            $this->startLoadReference($name, $extensions);

            $this->warnings = $reference->getWarnings();
            if ($this->options['verbose']) {
                foreach ($this->warnings as $warn) {
                    $this->failLoadReference($warn);
                }
            }

            $this->reference = $reference->getAll();

            $this->endLoadReference(
                $name, count($reference->getExtensions()), count($this->warnings)
            );
        }
    }

    /**
     * Search reference information for an element $name in a $category group
     *
     * @param string $category Element's category
     * @param string $name     Element's name
     *
     * @return mixed INT if warning occured, ARRAY if reference found
     */
    protected function searchReference($category, $name)
    {
        if (!isset($this->reference[$category])) {
            throw new PHP_CompatInfo_Exception(
                "Invalid search category. Given '$category'",
                PHP_CompatInfo_Exception::RUNTIME
            );
        }

        $data = $this->reference[$category];

        if (!isset($data[$name])) {
            return 1; // unknown reference
        }
        if (count($data[$name]) > 1) {
            return 2; // multiple reference
        }

        list ($extension, $values) = each($data[$name]);
        list ($verMin, $verMax)    = $values;

        $ref = array(
            $extension => array(
                $name => array(
                    'versions' => array($verMin, $verMax)
                )
            )
        );
        return $ref;
    }

    /**
     * Check method parameter values provided
     *
     * @param string $category
     * @param string $key
     *
     * @return bool
     */
    protected function isValid($category, $key)
    {
        static $extensions;

        switch ($key) {
            case 'interfaces':
            case 'classes':
            case 'constants':
            case 'functions':
                if (!isset($extensions)) {
                    $extensions = array();
                    foreach (array_values($this->reference['extensions']) as $name => $versions) {
                        $extensions[] = $name;
                    }
                }
                $search = $extensions; ;
                array_unshift($search, 'user');
                break;
            case 'includes':
                $search = array(
                    'require_once', 'require', 'include_once', 'include'
                );
                break;
            case 'excludes':
                $search = array(
                    'extensions',
                    'interfaces', 'classes', 'functions', 'constants'
                );
                break;
            case 'conditions':
                $search = array(
                    'function_exists', 'extension_loaded', 'defined',
                    'method_exists', 'class_exists', 'interface_exists'
                );
                break;
            case 'reference':
                $search = array('PHP4', 'PHP5');
                break;
            default:
                return false;
        }
        $valid = in_array($category, $search);
        return $valid;
    }

    /**
     * Combine informations from reference and source uses
     *
     * @param string $category       Category of information : either extensions,
     *                               functions, constants, classes, interfaces
     * @param string $defaultVersion Default version
     *                               for user or undefined component
     * @param array  $haystack       Data list
     * @param string $source         Data source name
     *
     * @return void
     */
    private function getInfo($category, $defaultVersion, $haystack, $source)
    {
        if (!is_array($haystack)) {
            return;
        }

        foreach ($haystack as $key => $data) {
            $ref = $this->searchReference($category, $key);
            if ($ref === 1) {
                // user component
                $ref = array('user' => array(
                    $key => array(
                        'versions' => array($defaultVersion, ''),
                        )
                    )
                );
            }
            if (!is_array($ref)) {
                // multiple occurs for same reference (unpredictable)
                $this->addWarning("Multiple values for same reference name '$key'");
                continue;
            }
            list ($extension, $values) = each($ref);

            if (is_array($data)) {
                // PHP TokenStream results
                $this->_versionsRef = $values[$key]['versions'];
            } else {
                // parent or interface result from recursive call
                if (version_compare(
                    $values[$key]['versions'][0],
                    $this->_versionsRef[0],
                    'gt')
                ) {
                    $this->_versionsRef[0] = $values[$key]['versions'][0];
                }
                if (version_compare(
                    $values[$key]['versions'][1],
                    $this->_versionsRef[1],
                    'gt')
                ) {
                    $this->_versionsRef[1] = $values[$key]['versions'][1];
                }
            }

            if (!isset($this->{$category}[$extension])) {
                $this->{$category}[$extension] = array();
            }

            if (isset($this->{$category}[$extension][$key])) {
                $values[$key]['uses'] =
                    $this->{$category}[$extension][$key]['uses'];
                $values[$key]['sources'][] = $source;
            } else {
                $values[$key]['uses']     = isset($data['uses']) ? count($data['uses']) : 1;
                $values[$key]['sources']  = array($source);

                if (isset($data['parent']) && !empty($data['parent'])) {
                    $this->getInfo($category,
                        '4.0.0', array($data['parent'] => ''), $source
                    );
                }

                if (isset($data['interfaces']) && is_array($data['interfaces'])) {
                    // when a user class implements interfaces, identify them
                    $this->getInfo('interfaces',
                        '5.0.0', array_flip($data['interfaces']), $source
                    );
                }
            }
            $values[$key]['excluded'] = false;
            $values[$key]['versions'] = $this->_versionsRef;

            $this->{$category}[$extension] = array_merge(
                $this->{$category}[$extension],
                $values
            );

            if (!isset($this->extensions[$extension])) {
                // retrieve extension versions information
                foreach ($this->reference['extensions'] as $k => $v) {
                    if ($extension === $k) {
                        $this->extensions[$extension] = array(
                            'versions' => $v,
                            'excluded' => false
                        );
                        break;
                    }
                }
            }

            // mark elements in excludes list
            if (isset($this->options['exclude']['extensions'])) {
                if (in_array($extension, $this->options['exclude']['extensions'])) {
                    $this->excludes['extensions'][$extension] = true;
                    $this->extensions[$extension]['excluded'] = true;
                    // all elements of this extension are also excluded
                    $this->excludes[$category][$key] = true;
                    $this->{$category}[$extension][$key]['excluded'] = true;
                    continue;
                }
            }
            if (isset($this->options['exclude'][$category])) {
                foreach($this->options['exclude'][$category] as $excludePattern) {
                    if (preg_match("/$excludePattern/", $key)) {
                        $this->excludes[$category][$key] = true;
                        $this->{$category}[$extension][$key]['excluded'] = true;
                        continue 2;
                    }
                }
            }

            // updates the minimum and maximum versions of current source
            if (version_compare(
                $this->_versionsRef[0],
                $this->versions[0],
                'gt')
            ) {
                $this->versions[0] = $this->_versionsRef[0];
            }
            if (version_compare(
                $this->_versionsRef[1],
                $this->versions[1],
                'gt')
            ) {
                $this->versions[1] = $this->_versionsRef[1];
            }

            // updates the minimum and maximum versions of all data source
            if (version_compare(
                $this->_versionsRef[0],
                $this->_versionsLatest[0],
                'gt')
            ) {
                $this->_versionsLatest[0] = $this->_versionsRef[0];
            }
            if (version_compare(
                $this->_versionsRef[1],
                $this->_versionsLatest[1],
                'gt')
            ) {
                $this->_versionsLatest[1] = $this->_versionsRef[1];
            }
        }
    }

    /**
     * A data source scan started
     *
     * @param mixed $source Data source
     *
     * @return void
     */
    protected function startScanSource($source)
    {
        $message = 'Audit started';

        if (is_string($source)) {
            if (is_dir($source)) {
                $message .= ' for directory ' . realpath($source);
            } else {
                $message .= ' for file ' . realpath($source);
            }
        } elseif (is_array($source)) {
                $message .= ' for a list of ' . count($source) .
                    ' different(s) data source';
        }
        $this->startTime = time();
        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'info',
                'message' => $message
            )
        );
    }

    /**
     * A data source scan ended
     *
     * @return void
     */
    protected function endScanSource()
    {
        list($min, $max) = $this->getVersions();
        $versions = $min . ' (min)';
        if (!empty($max)) {
            $versions .= $max . ' (max)';
        }

        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'info',
                'message' => sprintf(
                    'Audit finished in %s minutes. Required PHP %s',
                    (date('i:s', time() - $this->startTime)),
                    $versions
                )
            )
        );
    }

    /**
     * A file scan started
     *
     * @param string $file         Filename
     * @param int    $currentIndex Position in data source
     * @param int    $maxIndex     Count of files in data source
     *
     * @return void
     */
    protected function startScanFile($file, $currentIndex, $maxIndex)
    {
        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'info',
                'message' => sprintf(
                    'start scan file %s/%s: dir=%s, file=%s',
                    $currentIndex,
                    $maxIndex,
                    dirname($file),
                    basename($file)
                )
            )
        );
    }

    /**
     * A file scan ended
     *
     * @param string $file         Filename
     * @param int    $currentIndex Position in data source
     * @param int    $maxIndex     Count of files in data source
     *
     * @return void
     */
    protected function endScanFile($file, $currentIndex, $maxIndex)
    {
        $summary = array();

        list($min, $max) = $this->results[$file]['versions'];
        $versions = 'required PHP ' . $min . ' (min)';
        if (!empty($max)) {
            $versions .= $max . ' (max)';
        }
        $summary[] = $versions;

        $count = count($this->results[$file]['extensions']);
        if ($count > 0) {
            $summary[] = 'extensions=' . $count;
        }

        foreach (array('interfaces', 'classes', 'functions', 'constants') as $key) {
            $count = 0;
            foreach ($this->results[$file][$key] as $extensionElements) {
                $count += count($extensionElements);
            }
            if ($count > 0) {
                $summary[] = $key . '=' . $count;
            }
        }

        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'info',
                'message' => sprintf(
                    'end scan file %s/%s: %s',
                    $currentIndex,
                    $maxIndex,
                    implode(', ', $summary)
                )
            )
        );
    }

    /**
     * A load reference started
     *
     * @param string $reference  Name of the reference
     * @param array  $extensions OPTIONAL List of extension to load
     *
     * @return void
     */
    protected function startLoadReference($reference, $extensions)
    {
        if (is_array($extensions)) {
            $extra = 'modules list: '. implode(', ', $extensions);
        } else {
            $extra = 'modules loaded in the PHP interpreter';
        }

        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'info',
                'message' => sprintf(
                    'start load reference %s with %s',
                    $reference,
                    $extra
                )
            )
        );
    }

    /**
     * A load reference ended
     *
     * @param string $reference  Name of the reference
     * @param int    $successful Extensions reference that were successfully loaded
     * @param int    $failures   Extensions reference that were failed to load
     *
     * @return void
     */
    protected function endLoadReference($reference, $successful, $failures)
    {
        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'info',
                'message' => sprintf(
                    'end load reference %s with %d successful, %d failures',
                    $reference,
                    $successful,
                    $failures
                )
            )
        );
    }

    /**
     * A load reference failed
     *
     * @param string $warn Reason of failure
     *
     * @return void
     */
    protected function failLoadReference($warn)
    {
        $this->setEvent(
            array(
                'name'    => __FUNCTION__,
                'level'   => 'warning',
                'message' => $warn
            )
        );
    }

}
