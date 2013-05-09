<?php
/**
 * PHP_CompatInfo check compatibility of PHP code and provides minimal and maximal
 * version to run it.
 *
 * It adds the ability to reverse-engineer extensions, interfaces, classes,
 * functions (user or internal), constants and globals.
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
 * Check compatibility of chunk of PHP code
 *
 * @method array getExcludes()   getExcludes(category = null, $pattern = null)
 *         Returns informations on parsing results about excludes
 * @method array getIncludes()   getIncludes(category = null, $pattern = null)
 *         Returns informations on parsing results about includes
 * @method array getExtensions() getExtensions(category = null, $pattern = null)
 *         Returns informations on parsing results about extensions
 * @method array getNamespaces() getNamespaces(category = null, $pattern = null)
 *         Returns informations on parsing results about namespaces
 * @method array getInterfaces() getInterfaces(category = null, $pattern = null)
 *         Returns informations on parsing results about interfaces
 * @method array getTraits()     getTraits(category = null, $pattern = null)
 *         Returns informations on parsing results about traits
 * @method array getClasses()    getClasses(category = null, $pattern = null)
 *         Returns informations on parsing results about classes
 * @method array getFunctions()  getFunctions(category = null, $pattern = null)
 *         Returns informations on parsing results about functions
 * @method array getConstants()  getConstants(category = null, $pattern = null)
 *         Returns informations on parsing results about constants
 * @method array getGlobals()    getGlobals(category = null, $pattern = null)
 *         Returns informations on parsing results about globals
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo extends PHP_CompatInfo_Filter
    implements SplSubject, IteratorAggregate, Countable
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
    protected $namespaces;

    /**
     * @var array
     */
    protected $traits;

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
    protected $globals;

    /**
     * @var array
     */
    protected $tokens;

    /**
     * @var array
     */
    protected $results;

    /**
     * @var array
     */
    private $_namespaces;

    /**
     * Observers connected
     * @var SplObjectStorage
     */
    private $_observers;

    /**
     * Observers unique identifiers
     * @var array
     */
    private $_observersId;

    /**
     * @var array
     */
    private $_versionsRef;

    /**
     * @var object PHP_CompatInfo_Event
     */
    private $_event;


    /**
     * Class constructor
     *
     * @param array $options Configure options
     */
    public function __construct(array $options = null)
    {
        $this->_observers = new SplObjectStorage();

        $defaultOptions = self::getDefaultOptions();

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
     * Returns all options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Returns default options
     *
     * @return array
     */
    public static function getDefaultOptions()
    {
        $default = array(
            'recursive'        => false,
            'reference'        => 'ALL',
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
                'ALL' => array(
                    'class' => 'PHP_CompatInfo_Reference_ALL',
                    'file'  => '',
                    'args'  => array()
                ),
            ),
            'verbose'          => false,
            'fileExtensions'   => array('php', 'inc', 'phtml'),
            'filterVersion'    => 'php_4.0.0',
            'filterOperator'   => 'ge',
            'exclude'          => array(),
            'cacheDriver'      => 'file',
            'cacheOptions'     => array(),
            'listeners'        => array(),
        );

        return $default;
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
        $id = $observer->getHash();

        if (!isset($this->_observersId[$id])) {
            $this->_observers->attach($observer);
            $this->_observersId[$id] = true;
        }
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
        $id = $observer->getHash();

        if (isset($this->_observersId[$id])) {
            $this->_observers->detach($observer);
            unset($this->_observersId[$id]);
        }
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
     * @return SplObserver
     * @link   http://www.php.net/manual/en/class.iteratoraggregate.php
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
     * Returns the latest event.
     * Used by observers connected
     *
     * @return object PHP_CompatInfo_Event
     */
    public function getEvent()
    {
        return $this->_event;
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
        $this->firePushWarning($warn);
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

            if (is_dir($dataSource)) {
                $directory = $dataSource;

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
     * searching for namespaces, interfaces, traits, classes,
     * functions, constants, globals, includes and conditional code
     *
     * @param mixed $dataSource Data source (single file, directory, files list)
     *
     * @return bool FALSE when nothing parsed, TRUE otherwise
     */
    public function parse($dataSource)
    {
        $this->fireStartScanSource($dataSource);

        if (isset($this->options['exclude']['files'])) {
            $excludes = $this->options['exclude']['files'];
        } else {
            $excludes = array();
        }
        $excludes[-1] = '\.(' .
            implode('|', $this->options['fileExtensions']) .
            ')$';

        $files = self::getFilelist(
            $dataSource, $this->options['recursive'], $excludes
        );
        $filesCount = count($files);
        if ($filesCount < 1) {
            return false;
        }

        $i             = 0;
        $this->results = array(
            array(
                'excludes'   => array(),
                'includes'   => array(),
                'versions'   => array('4.0.0', ''),
                'extensions' => array(),
                'namespaces' => array(),
                'traits'     => array(),
                'interfaces' => array(),
                'classes'    => array(),
                'functions'  => array(),
                'constants'  => array(),
                'globals'    => array(),
                'tokens'     => array(),
                'conditions' => array(),
            )
        );

        foreach ($files as $source) {
            $i++;
            $this->fireStartScanFile($source, $i, $filesCount);
            $this->scan($source);

            // consolidate all global results ...

            // excludes
            foreach ($this->results[$source]['excludes'] as $exc => $data) {
                if (isset($this->results[0]['excludes'][$exc])) {
                    // next match
                    $this->results[0]['excludes'][$exc] = array_merge(
                        $this->results[0]['excludes'][$exc], $data
                    );
                } else {
                    // first match
                    $this->results[0]['excludes'][$exc] = $data;
                }
            }

            // includes
            foreach ($this->results[$source]['includes'] as $inc => $data) {
                if (isset($this->results[0]['includes'][$inc])) {
                    // next match
                    $this->results[0]['includes'][$inc] = array_merge(
                        $this->results[0]['includes'][$inc], $data
                    );
                    $this->results[0]['includes'][$inc] = array_unique(
                        $this->results[0]['includes'][$inc]
                    );
                } else {
                    // first match
                    $this->results[0]['includes'][$inc] = $data;
                }
            }

            // extensions
            foreach ($this->results[$source]['extensions'] as $ext => $data) {
                if (isset($this->results[0]['extensions'][$ext])) {
                    // next match
                    $this->results[0]['extensions'][$ext]['uses'] += $data['uses'];
                    $this->results[0]['extensions'][$ext]['sources'] = array_merge(
                        $this->results[0]['extensions'][$ext]['sources'],
                        $data['sources']
                    );
                } else {
                    // first match
                    $this->results[0]['extensions'][$ext] = $data;
                }
            }

            // namespaces, traits, interfaces, classes, functions, constants,
            // globals and tokens
            $keys = array(
                'namespaces', 'traits', 'interfaces', 'classes',
                'functions', 'constants', 'globals', 'tokens'
            );
            foreach ($keys as $key) {
                foreach ($this->results[$source][$key] as $ext => $items) {
                    foreach ($items as $name => $data) {
                        if (isset($this->results[0][$key][$ext][$name])) {
                            // next match
                            $this->results[0][$key][$ext][$name]['uses']
                                += $data['uses'];
                            $this->results[0][$key][$ext][$name]['sources']
                                = array_merge(
                                    $this->results[0][$key][$ext][$name]['sources'],
                                    $data['sources']
                                );
                            if ($this->results[0][$key][$ext][$name]['excluded'] === false
                                && $data['excluded'] !== false
                            ) {
                                $this->results[0][$key][$ext][$name]['excluded']
                                    = $data['excluded'];
                            }

                            $this->updateVersion(
                                $data['versions'][0],
                                $this->results[0][$key][$ext][$name]['versions'][0]
                            );
                            $this->updateVersion(
                                $data['versions'][1],
                                $this->results[0][$key][$ext][$name]['versions'][1]
                            );
                        } else {
                            // first match
                            $this->results[0][$key][$ext][$name] = $data;
                        }
                    }
                }
            }

            // versions
            $this->updateVersion(
                $this->results[$source]['versions'][0],
                $this->results[0]['versions'][0]
            );
            $this->updateVersion(
                $this->results[$source]['versions'][1],
                $this->results[0]['versions'][1]
            );

            // conditions
            foreach ($this->results[$source]['conditions'] as $cond => $data) {
                if (isset($this->results[0]['conditions'][$cond])) {
                    // next match
                    $this->results[0]['conditions'][$cond] += $data;
                } else {
                    // first match
                    $this->results[0]['conditions'][$cond] = $data;
                }
            }

            $this->fireEndScanFile($source, $i, $filesCount);
        }

        if ('ALL' === $this->options['reference']) {
            $keys = array_keys($this->results[0]['extensions']);
            foreach ($keys as $ext) {
                if (!extension_loaded($ext)) {
                    $this->addWarning("Extension '$ext' referenced but not loaded");
                }
            }
        }

        $this->fireEndScanSource();

        return true;
    }

    /**
     * Parse a single file
     * searching for namespaces, interfaces, traits, classes,
     * functions, constants, globals, includes and conditional code
     *
     * @param string $source Source filename
     *
     * @return void
     */
    protected function scan($source)
    {
        $cache = PHP_CompatInfo_Cache::getInstance(
            $this->options['cacheDriver'], $this->options
        );
        $cached = $cache->isCached($source);

        if ($cached) {
            $results = $cache->getCache($source);

            $this->excludes   = $results['excludes'];
            $this->includes   = $results['includes'];
            $this->versions   = $results['versions'];
            $this->extensions = $results['extensions'];
            $this->namespaces = $results['namespaces'];
            $this->traits     = $results['traits'];
            $this->interfaces = $results['interfaces'];
            $this->classes    = $results['classes'];
            $this->functions  = $results['functions'];
            $this->constants  = $results['constants'];
            $this->globals    = $results['globals'];
            $this->tokens     = $results['tokens'];
            $conditions       = $results['conditions'];

        } else {

            $this->excludes   = array();
            $this->includes   = array();
            $this->versions   = array('4.0.0', '');
            $this->extensions = array();
            $this->namespaces = array();
            $this->traits     = array();
            $this->interfaces = array();
            $this->classes    = array();
            $this->functions  = array();
            $this->constants  = array();
            $this->globals    = array();
            $this->tokens     = array();
            $conditions       = false;

            /**
             * @link http://www.php.net/manual/en/tokens.php
             *       List of Parser Tokens
             */
            $options = array(
                'containers' => array(
                    'core'  => 'internalFunctions',
                    'token' => 'tokens',
                    'glob'  => 'globals'
                ),
                'properties' => array(
                    'interface'    => array('keywords', 'methods', 'parent'),
                    'class'        => array('keywords', 'methods', 'parent', 'interfaces'),
                    'function'     => array('keywords', 'visibility', 'arguments'),
                    'require_once' => array(),
                    'require'      => array(),
                    'include_once' => array(),
                    'include'      => array(),
                )
            );
            $reflect = new PHP_Reflect($options);

            // internal functions
            $reflect->connect(
                'T_STRING',
                'PHP_CompatInfo_Token_STRING',
                array('PHP_CompatInfo_TokenParser', 'parseTokenString')
            );

            // user constants
            $reflect->connect(
                'T_CONSTANT_ENCAPSED_STRING',
                'PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING',
                array('PHP_CompatInfo_TokenParser', 'parseTokenConstant')
            );

            // globals and super globals
            $reflect->connect(
                'T_VARIABLE',
                'PHP_Reflect_Token_VARIABLE',
                array('PHP_CompatInfo_TokenParser', 'parseTokenGlobals')
            );

            // language features / tokens
            $reflect->connect(
                'T_CATCH',
                'PHP_Reflect_Token_CATCH',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_CLONE',
                'PHP_Reflect_Token_CLONE',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_INSTANCEOF',
                'PHP_Reflect_Token_INSTANCEOF',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_THROW',
                'PHP_Reflect_Token_THROW',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_TRY',
                'PHP_Reflect_Token_TRY',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_HALT_COMPILER',
                'PHP_Reflect_Token_HALT_COMPILER',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_GOTO',
                'PHP_Reflect_Token_GOTO',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_UNSET_CAST',
                'PHP_Reflect_Token_UNSET_CAST',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_INSTEADOF',
                'PHP_Reflect_Token_INSTEADOF',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );

            $reflect->connect(
                'T_OBJECT_OPERATOR',
                'PHP_CompatInfo_Token_OBJECT_OPERATOR',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );
            $reflect->connect(
                'T_OPEN_SQUARE',
                'PHP_CompatInfo_Token_OPEN_SQUARE',
                array('PHP_CompatInfo_TokenParser', 'parseTokenFeatures')
            );

            $reflect->scan($source);

            $this->_namespaces
                = $reflect->getNamespaces(PHP_Reflect::NAMESPACES_ALL);

            /**
             * @link http://www.php.net/manual/en/language.namespaces.php
             *       Namespaces
             */
            $namespaces = $reflect->getNamespaces();
            if ($namespaces === null) {
                // adds (at least) global namespace
                $ns             = '\\';
                $namespaces     = array($ns => array());
                $defaultVersion = $reflect->isNamespaceWarning() ? '5.3.0' : '4.0.0';
            } else {
                $ns             = true;
                $defaultVersion = '5.3.0';
            }
            $this->getInfo('namespaces', $defaultVersion, $namespaces, $source, $ns);

            /**
             * @link http://www.php.net/manual/en/language.control-structures.php
             *       Control Structures
             */
            $includes = $reflect->getIncludes(true);
            foreach ($includes as $key => $values) {
                $this->includes[$key] = array_keys($values);
            }

            foreach (array_keys($namespaces) as $ns) {
                /**
                 * @link http://www.php.net/manual/en/language.oop5.traits.php
                 *       Traits
                 */
                $traits = $reflect->getTraits($ns);
                $this->getInfo('traits', '5.4.0', $traits, $source, $ns);

                /**
                 * @link http://www.php.net/manual/en/language.oop5.interfaces.php
                 *       Object Interfaces
                 */
                $interfaces = $reflect->getInterfaces($ns);
                $this->getInfo('interfaces', '5.0.0', $interfaces, $source, $ns);

                /**
                 * @link http://www.php.net/manual/en/language.oop5.php
                 *       Classes and Objects
                 */
                $classes = $reflect->getClasses($ns);
                $this->getInfo('classes', '4.0.0', $classes, $source, $ns);

                /**
                 * @link http://www.php.net/manual/en/language.constants.php
                 *       Constants
                 */
                $constants = $reflect->getConstants(false, null, $ns);
                $this->getInfo('constants', '4.0.0', $constants, $source, $ns);

                /**
                 * @link http://www.php.net/manual/en/functions.user-defined.php
                 *       User-defined functions
                 * @link http://www.php.net/manual/en/functions.internal.php
                 *       Internal (built-in) functions
                 */
                $userFunctions = (array)$reflect->getFunctions($ns);
                $coreFunctions = (array)$reflect->getInternalFunctions($ns);

                $functions = array_merge_recursive(
                    $userFunctions,
                    $coreFunctions
                );
                $this->getInfo('functions', '4.0.0', $functions, $source, $ns);

                // language features
                $tokens = (array)$reflect->offsetGet(array('tokens' => $ns));
                $this->getInfo('tokens', '5.0.0', $tokens, $source, $ns);

                /**
                 * @link http://www.php.net/manual/en/language.variables.superglobals.php
                 *       Superglobals
                 */
                $globals = (array)$reflect->getGlobals(true, null, $ns);

                foreach ($globals as $glob => $gdata) {
                    foreach ($gdata as $name => $data) {
                        $data['name'] = $name;
                        $global = array($glob => $data);
                        $this->getInfo('globals', '4.0.0', $global, $source, $ns);
                    }
                }
            }

            // additional search for constants on global namespace
            $constants = $reflect->getConstants(false, null);
            $this->getInfo('constants', '4.0.0', $constants,  $source, '\\');

            // updates current source versions only if element is not excluded
            $keys = array(
                'namespaces', 'traits', 'interfaces', 'classes',
                'functions', 'constants', 'globals', 'tokens'
            );
            foreach ($keys as $key) {
                foreach ($this->$key as $ext => $items) {
                    foreach ($items as $name => $data) {
                        if ($data['excluded'] === false) {
                            $this->updateVersion(
                                $data['versions'][0],
                                $this->versions[0]
                            );
                            $this->updateVersion(
                                $data['versions'][1],
                                $this->versions[1]
                            );
                        }
                    }
                }
            }
        }

        $this->results[$source] = array(
            'excludes'   => $this->excludes,
            'includes'   => $this->includes,
            'versions'   => $this->versions,
            'extensions' => $this->extensions,
            'namespaces' => $this->namespaces,
            'traits'     => $this->traits,
            'interfaces' => $this->interfaces,
            'classes'    => $this->classes,
            'functions'  => $this->functions,
            'constants'  => $this->constants,
            'globals'    => $this->globals,
            'tokens'     => $this->tokens,
            'conditions' => $conditions,
        );

        if ($conditions === false) {
            // search for conditional code
            $this->results[$source]['conditions'] = $this->getConditions(
                null, $source
            );
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
     * @return array
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
     * Magic methods to get informations on parsing results about
     * excludes, includes, extensions,
     * namespaces, interfaces, traits, classes, functions, constants, globals
     *
     * @param string $name Method name invoked
     * @param array  $args Method arguments provided
     *
     * @return array
     * @throws PHP_CompatInfo_Exception
     */
    public function __call($name, $args)
    {
        $pattern = '/get' .
            '(?>(Excludes|Includes' .
            '|Extensions' .
            '|Namespaces|Interfaces|Traits|Classes|Functions|Constants|Globals))/';
        if (preg_match($pattern, $name, $matches) === 0) {
            throw new PHP_CompatInfo_Exception(
                "Invalid method. Given '$name'",
                PHP_CompatInfo_Exception::RUNTIME
            );
        }

        $group = strtolower($matches[1]);

        if ('traits' === $group
            && version_compare(phpversion(), '5.4.0', 'lt')
        ) {
            return;
        }

        $category = isset($args[0]) ? $args[0] : null;
        $pattern  = isset($args[1]) ? $args[1] : null;

        self::$filterVersion = isset($args[2])
            ? $args[2] : $this->options['filterVersion'];
        self::$filterOperator = isset($args[3])
            ? $args[3] : $this->options['filterOperator'];

        if (isset($category) && !$this->isValid($category, $group)) {
            throw new PHP_CompatInfo_Exception(
                "Invalid category. Given '$category'",
                PHP_CompatInfo_Exception::RUNTIME
            );
        }

        $results = array();

        if (in_array(
            $group, array(
                'includes', 'excludes', 'extensions',
                'namespaces', 'interfaces', 'traits', 'classes',
                'functions', 'constants', 'globals'
            )
        )) {
            $results = $this->results[0][$group];
        }

        if (isset($pattern) && is_string($pattern)) {
            foreach ($results[$category] as $name => $values) {
                if (preg_match("/$pattern/", $name) === 0) {
                    unset($results[$category][$name]);
                }
            }
        }

        if (in_array(
            $group, array(
                'extensions',
                'namespaces', 'interfaces', 'traits', 'classes',
                'functions', 'constants'
            )
        )) {
            self::applyFilter($results, $category);
        }

        if (isset($category)) {
            if (isset($results[$category])) {
                $results = $results[$category];
            } else {
                $results = array();
            }
        }

        return $results;
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
     * - trait_exists     (level 128)
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
            'trait_exists'     => 0,
        );

        foreach ($this->results as $file => $results) {
            if (isset($source) && (!is_string($file) || $source != $file)) {
                continue;
            }

            foreach (array_keys($ccl) as $name) {
                if (isset($category) && $category != $name) {
                    continue;
                }
                if (isset($results['functions']['Core'][$name])
                    && $results['functions']['Core'][$name]['excluded'] === false
                ) {
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
        return $this->results[0]['versions'];
    }

    /**
     * Search the namespace of component (class, interface, function, constant)
     * referenced by type hinting uses
     *
     * @param string $typeHint Type of parameter in method or function
     *
     * @return string
     */
    protected function searchNamespace($typeHint)
    {
        // default namespace
        $namespace = '\\';

        if (is_array($this->_namespaces)) {
            foreach ($this->_namespaces as $ns => $data) {
                if (isset($data['alias']) && $typeHint == $data['alias']) {
                    $namespace = $ns;
                    break;
                }
            }
        }

        return $namespace;
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

        if (!class_exists($plugin['class'], false)
            && $plugin['file'] !== ''
        ) {
            include_once $plugin['file'];
        }
        if (class_exists($plugin['class'], true)) {
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

            $this->fireStartLoadReference($name, $extensions);

            $this->warnings = $reference->getWarnings();
            if ($this->options['verbose']) {
                foreach ($this->warnings as $warn) {
                    $this->fireFailLoadReference($warn);
                }
            }

            $this->reference = $reference->getAll();

            $this->fireEndLoadReference(
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
        if ($category == 'namespaces' || $category == 'traits') {
            return 1; // unknown reference
        }

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

        if (count($values) == 4) {
            list ($verMin, $verMax, $extMin, $extMax) = $values;
            $arguments = null;
        } else {
            list ($verMin, $verMax, $extMin, $extMax, $arguments) = $values;
            $arguments = explode(',', str_replace(' ', '', $arguments));
        }

        $ref = array(
            $extension => array(
                $name => array(
                    'versions'  => array($verMin, $verMax, $extMin, $extMax),
                    'arguments' => $arguments
                )
            )
        );
        return $ref;
    }

    /**
     * Check method parameter values provided
     *
     * @param string $category Value to check in $key group
     * @param string $key      Key group
     *
     * @return bool
     */
    protected function isValid($category, $key)
    {
        static $extensions;

        switch ($key) {
        case 'namespaces':
        case 'interfaces':
        case 'traits':
        case 'classes':
        case 'constants':
        case 'functions':
            if (!isset($extensions)) {
                $extensions = array();
                foreach (array_values($this->reference['extensions'])
                    as $name => $versions) {
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
                'namespaces', 'interfaces', 'classes', 'functions', 'constants'
            );
            break;
        case 'globals':
            $search = array(
                '$GLOBALS',
                '$HTTP_SERVER_VARS', '$_SERVER',
                '$HTTP_GET_VARS', '$_GET',
                '$HTTP_POST_VARS', '$HTTP_POST_FILES', '$_POST',
                '$HTTP_COOKIE_VARS', '$_COOKIE',
                '$HTTP_SESSION_VARS', '$_SESSION',
                '$HTTP_ENV_VARS', '$_ENV'
            );
            break;
        case 'conditions':
            $search = array(
                'function_exists', 'extension_loaded', 'defined',
                'method_exists', 'class_exists', 'interface_exists', 'trait_exists'
            );
            break;
        case 'reference':
            $search = array('PHP4', 'PHP5', 'ALL');
            break;
        default:
            return false;
        }
        $valid = in_array($category, $search);
        return $valid;
    }

    /**
     * Update the base version if current ref version is greater
     *
     * @param string $current Current version
     * @param string &$base   Base version
     *
     * @return void
     */
    protected function updateVersion($current, &$base)
    {
        if (version_compare($current, $base, 'gt')) {
            $base = $current;
        }
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
     * @param string $ns             Namespace
     *
     * @return void
     */
    protected function getInfo($category, $defaultVersion, $haystack, $source, $ns)
    {
        if (!is_array($haystack)) {
            return;
        }

        foreach ($haystack as $key => $data) {

            if (isset($data[0])) {
                $uses = count($data);
                // when PHP_Reflect detect multiple instance of same element
                $data = $data[0];
            } elseif (isset($data['uses'])) {
                $uses = false;
            } else {
                $uses = 1;
            }

            if ('constants' == $category && $data['class'] !== false) {
                /**
                 * Class constants :
                 * Do not search reference that can match core/ext constants
                 * @see https://github.com/llaville/php-compat-info/issues/34
                 */
                $ref = 1;
            } else {
                $ref = $this->searchReference($category, $key);
            }

            if ($ns == '\\') {
                // global namespace
            } elseif ($ref === 1) {
                // user namespace
                $defaultVersion = '5.3.0';
            }

            if ($ref === 1) {
                if ($key == 'anonymous function') {
                    $defaultVersion = '5.3.0';
                }
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
                // PHP Reflect results

                if (in_array($category, array('interfaces', 'classes'))) {
                    // look for PHP5 features
                    if (isset($data['keywords']) && !empty($data['keywords'])) {
                        // class abstraction, and final keyword
                        $values[$key]['versions'] = array('5.0.0', '');
                    } elseif (isset($data['methods'])
                        && is_array($data['methods'])
                    ) {
                        // methods visibility and keywords (final, static, abstract)
                        foreach ($data['methods'] as $method => $properties) {
                            if (isset($properties['keywords'])
                                && !empty($properties['keywords'])
                            ) {
                                $values[$key]['versions'] = array('5.0.0', '');
                                break;
                            } elseif (isset($properties['visibility'])
                                && !empty($properties['visibility'])
                            ) {
                                $values[$key]['versions'] = array('5.0.0', '');
                                break;
                            }
                        }
                    }
                }
                $this->_versionsRef = $values[$key]['versions'];

                if (isset($values[$key]['arguments'])
                    && is_array($values[$key]['arguments'])
                    && isset($data['arguments'])
                    && is_array($data['arguments'])
                ) {
                    $a = count($data['arguments']);
                    if ($a > 0) {
                        $a--;
                        $version = $values[$key]['arguments'][$a];

                        $this->updateVersion(
                            $version, $this->_versionsRef[0]
                        );
                        if (!empty($this->_versionsRef[1])) {
                            $this->updateVersion(
                                $version, $this->_versionsRef[1]
                            );
                        }
                    }
                }
            } else {
                // parent or interface result from recursive call
                $this->updateVersion(
                    $values[$key]['versions'][0], $this->_versionsRef[0]
                );
                $this->updateVersion(
                    $values[$key]['versions'][1], $this->_versionsRef[1]
                );
            }
            unset($values[$key]['arguments']);

            if ($category == 'globals') {
                $_extension = $extension;
                $extension  = $key;
                $key        = $data['name'];
            }

            if (!isset($this->{$category}[$extension])) {
                $this->{$category}[$extension] = array();
            }

            if (isset($this->{$category}[$extension][$key]['uses'])) {
                $values[$key]['uses']
                    = $this->{$category}[$extension][$key]['uses'];
                $values[$key]['sources'][] = $source;
                $values[$key]['namespace'] = ('user' === $extension) ? $ns : '\\';
            } else {
                $values[$key]['uses'] = empty($uses) ? count($data['uses']) : $uses;
                $values[$key]['sources'] = array($source);
                $values[$key]['namespace'] = ('user' === $extension) ? $ns : '\\';

                if (isset($data['parent']) && !empty($data['parent'])) {
                    $parent = $data['parent'];
                    if (strpos($parent, '\\') === 0) {
                        $ns = '\\';
                        $parent = substr($parent, 1);
                    }
                    $this->getInfo(
                        $category, '4.0.0',
                        array($parent => ''), $source, $ns
                    );
                }

                if (isset($data['interfaces']) && is_array($data['interfaces'])) {
                    // when a user class implements interfaces, identify them
                    $this->getInfo(
                        'interfaces', '5.0.0',
                        array_flip($data['interfaces']), $source, $ns
                    );
                }
            }
            $values[$key]['excluded']
                = isset($this->{$category}[$extension][$key]['excluded'])
                    ? $this->{$category}[$extension][$key]['excluded'] : false;

            $values[$key]['versions'] = $this->_versionsRef;

            if ($category == 'globals') {
                unset($values[$extension]);
            }

            $this->{$category}[$extension] = array_merge(
                $this->{$category}[$extension],
                $values
            );

            if ($category == 'globals') {
                $extension = $_extension;
            }

            if (!isset($this->extensions[$extension])) {
                // retrieve extension versions information
                foreach ($this->reference['extensions'] as $k => $v) {
                    if ($extension === $k) {
                        $v[2] = '';
                        $v[3] = '';
                        $this->extensions[$extension] = array(
                            'versions' => $v,
                            'excluded' => false,
                            'uses'     => 0,
                            'sources'  => array()
                        );
                        break;
                    }
                }
            }
            if ($extension != 'user') {
                $this->extensions[$extension]['uses'] += $values[$key]['uses'];
                $sources = array_merge(
                    $this->extensions[$extension]['sources'],
                    $values[$key]['sources']
                );
                $this->extensions[$extension]['sources'] = array_unique($sources);

                if (count($values[$key]['versions']) > 2) {
                    $this->updateVersion(
                        $values[$key]['versions'][2],
                        $this->extensions[$extension]['versions'][2]
                    );
                    $this->updateVersion(
                        $values[$key]['versions'][3],
                        $this->extensions[$extension]['versions'][3]
                    );
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
                foreach ($this->options['exclude'][$category] as $excludePattern) {
                    if (preg_match("/$excludePattern/", $key)) {
                        $this->excludes[$category][$key] = true;
                        $this->{$category}[$extension][$key]['excluded'] = true;
                        continue 2;
                    }
                }
            }

            if ($category == 'functions') {
                $this->excludeCodeConditions($key, $data, $source, $ns);
            }

            $functions = array();

            if ('classes' == $category) {
                if (is_array($data) && isset($data['methods'])) {
                    $functions = $data['methods'];
                }

            } elseif ('functions' == $category && 'user' == $extension) {
                $functions = array($key => $data);
            }

            // updates versions depending of arguments in class methods and user functions
            foreach ($functions as $function) {
                if (isset($function['arguments'])
                    && is_array($function['arguments'])
                ) {
                    foreach ($function['arguments'] as $argument) {
                        if (isset($argument['typeHint'])) {
                            $classKey = $argument['typeHint'];
                            if ($classKey != 'mixed'
                                && $classKey != 'object'
                                && $classKey != 'array'
                                && $classKey != 'callable'
                            ) {
                                $catRef = 'interfaces';
                                $ref = $this->searchReference($catRef, $classKey);

                                if ($ref === 1) {
                                    /*
                                        if typeHint is not an interface,
                                        perharps its a class
                                     */
                                    $catRef = 'classes';
                                    $ref = $this->searchReference($catRef, $classKey);
                                }

                                if ($ref === 1) {
                                    // not a PHP class or PHP interface, but just user
                                    if ($classKey == 'anonymous function') {
                                        $defaultVersion = '5.3.0';
                                    } else {
                                        $defaultVersion = '4.0.0';
                                    }
                                    // user component
                                    $ref = array('user' => array(
                                        $classKey => array(
                                            'versions' => array($defaultVersion, ''),
                                            )
                                        )
                                    );
                                }
                                if (!is_array($ref)) {
                                    // multiple occurs for same reference (unpredictable)
                                    $this->addWarning("Multiple values for same reference name '$classKey'");
                                    continue;
                                }
                                list ($ext, $val) = each($ref);

                                if (!isset($this->{$catRef}[$ext])
                                    || !isset($this->{$catRef}[$ext][$classKey])
                                ) {
                                    $namespace = $this->searchNamespace($classKey);
                                    if ('\\' != $namespace && 'user' == $ext) {
                                        $val[$classKey]['versions'] = array('5.3.0', '');
                                    }

                                    $this->{$catRef}[$ext][$classKey] = array(
                                        'versions'  => $val[$classKey]['versions'],
                                        'uses'      => 1,
                                        'sources'   => array($source),
                                        'namespace' => $namespace,
                                        'excluded'  => false
                                    );
                                }

                                $this->_versionsRef = $val[$classKey]['versions'];

                                if (!isset($this->extensions[$ext])) {
                                    // retrieve extension versions information
                                    foreach ($this->reference['extensions'] as $k => $v) {
                                        if ($ext === $k) {
                                            $this->extensions[$ext] = array(
                                                'versions' => $this->_versionsRef,
                                                'excluded' => false,
                                                'uses'     => 1,
                                                'sources'  => array($source)
                                            );
                                            break;
                                        }
                                    }
                                }

                                $this->updateVersion(
                                    $this->_versionsRef[0],
                                    $this->{$category}[$extension][$key]['versions'][0]
                                );
                                $this->updateVersion(
                                    $this->_versionsRef[1],
                                    $this->{$category}[$extension][$key]['versions'][1]
                                );
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Excludes code conditions that are not yet marked as excluded
     *
     * @param string $key    Function name of code conditional
     * @param array  $data   Function properties in current context
     * @param string $source Data source name
     * @param string $ns     Namespace
     *
     * @return void
     */
    private function excludeCodeConditions($key, $data, $source, $ns)
    {
        $condCodeMapping = array(
            'function_exists'  => 'functions',   // level 1
            'extension_loaded' => 'extensions',  // level 2
            'defined'          => 'constants',   // level 4
            'class_exists'     => 'classes',     // level 32
            'interface_exists' => 'interfaces',  // level 64
            'trait_exists'     => 'traits',      // level 128
        );

        if ((array_key_exists($key, $condCodeMapping)
            && isset($data['arguments'][0]['defaultValue'])
            && is_string($data['arguments'][0]['defaultValue'])) === false
        ) {
            // it's not a catchable code condition
            return;
        }

        $categKey = $condCodeMapping[$key];
        $itemKey  = trim($data['arguments'][0]['defaultValue'], "'\"");

        $namespace = '\\';
        if (strpos($itemKey, $namespace) === false) {
            $defaultVersion = '4.0.0';
            $namespace      = $ns;
        } else {
            $defaultVersion = '5.3.0';
            $values         = explode($namespace, $itemKey);
            $itemKey        = array_pop($values);
            $namespace      = implode($namespace, $values);
        }

        // adjust default version depending of component
        if ('trait_exists' === $key) {
            $defaultVersion = '5.4.0';
        } elseif ('interface_exists' === $key
            && '\\' === $namespace
        ) {
            $defaultVersion = '5.0.0';

        } elseif ('extension_loaded' === $key) {
            if (isset($this->reference['extensions'][$itemKey])) {
                // if extension exists in reference, got it
                $versions = $this->reference['extensions'][$itemKey];
            } else {
                // else uses default values
                $versions = array('4.0.0', '', '');
            }
        } else {
            /*
                Others (class, function, constant)
                are already defined depending of namespace
             */
        }

        if ('extensions' === $categKey) {
            if (isset($this->extensions[$itemKey])) {
                // if already exists
                $newProperties = array(
                    'excluded'  => '1',
                );
            } else {
                // if not yet found
                $this->extensions[$itemKey] = array();
                $newProperties = array(
                    'versions'  => $versions,
                    'uses'      => 1,
                    'sources'   => array($source),
                    'excluded'  => '1',
                );
            }
            $this->extensions[$itemKey] = array_merge(
                $this->extensions[$itemKey],
                $newProperties
            );
            $this->excludes[$categKey][$itemKey] = true;

        } elseif (!isset($this->excludes[$categKey][$itemKey])) {
            $ref = $this->searchReference($categKey, $itemKey);

            if ($ref === 1) {
                // user component
                $ref = array('user' => array(
                    $itemKey => array(
                        'versions' => array($defaultVersion, ''),
                        )
                    )
                );
            }
            if (is_array($ref)) {
                list ($ext, $values) = each($ref);

                if ('\\' === $namespace) {
                    $this->excludes[$categKey][$itemKey] = true;
                } else {
                    $this->excludes[$categKey][$namespace . '\\' . $itemKey] = true;
                }
                if (isset($this->{$categKey}[$ext][$itemKey])) {
                    // if already exists
                    $newProperties = array(
                        'excluded'  => '1',
                    );
                } else {
                    // if not yet found
                    $this->{$categKey}[$ext][$itemKey] = array();
                    $newProperties = array(
                        'versions'  => $values[$itemKey]['versions'],
                        'uses'      => 1,
                        'sources'   => array($source),
                        'namespace' => $namespace,
                        'excluded'  => '1',
                    );
                }
                $this->{$categKey}[$ext][$itemKey] = array_merge(
                    $this->{$categKey}[$ext][$itemKey],
                    $newProperties
                );
            }
        }
    }

    /**
     * Fired a startScanSource event
     *
     * @param mixed $source Data source
     *
     * @return void
     */
    protected function fireStartScanSource($source)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'startScanSource', $source
        );
        $this->notify();
    }

    /**
     * Fired a endScanSource event
     *
     * @return void
     */
    protected function fireEndScanSource()
    {
        $this->_event = new PHP_CompatInfo_Event($this, 'endScanSource');
        $this->notify();
    }

    /**
     * Fired a startScanFile event
     *
     * @param string $file         Filename
     * @param int    $currentIndex Position in data source
     * @param int    $maxIndex     Count of files in data source
     *
     * @return void
     */
    protected function fireStartScanFile($file, $currentIndex, $maxIndex)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'startScanFile', $file, $currentIndex, $maxIndex
        );
        $this->notify();
    }

    /**
     * Fired a endScanFile event
     *
     * @param string $file         Filename
     * @param int    $currentIndex Position in data source
     * @param int    $maxIndex     Count of files in data source
     *
     * @return void
     */
    protected function fireEndScanFile($file, $currentIndex, $maxIndex)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'endScanFile', $file, $currentIndex, $maxIndex
        );
        $this->notify();
    }

    /**
     * Fired a startLoadReference event
     *
     * @param string $reference  Name of the reference
     * @param array  $extensions OPTIONAL List of extension to load
     *
     * @return void
     */
    protected function fireStartLoadReference($reference, $extensions)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'startLoadReference', $reference, $extensions
        );
        $this->notify();
    }

    /**
     * Fired a endLoadReference event
     *
     * @param string $reference  Name of the reference
     * @param int    $successful Extensions reference that were successfully loaded
     * @param int    $failures   Extensions reference that were failed to load
     *
     * @return void
     */
    protected function fireEndLoadReference($reference, $successful, $failures)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'endLoadReference', $reference, $successful, $failures
        );
        $this->notify();
    }

    /**
     * Fired a failLoadReference event
     *
     * @param string $warn Reason of failure
     *
     * @return void
     */
    protected function fireFailLoadReference($warn)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'failLoadReference', $warn
        );
        $this->notify();
    }

    /**
     * Fired a pushWarning event
     *
     * @param string $warn Reason of warning
     *
     * @return void
     */
    protected function firePushWarning($warn)
    {
        $this->_event = new PHP_CompatInfo_Event(
            $this, 'pushWarning', $warn
        );
        $this->notify();
    }

}
