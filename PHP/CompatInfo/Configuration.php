<?php
/**
 * Wrapper for the PHP_CompatInfo XML configuration file
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
 * Wrapper for the PHP_CompatInfo XML configuration file
 *
 * Example XML configuration file:
 * <code>
 * <?xml version="1.0" encoding="utf-8" ?>
 *
 * <phpcompatinfo
 *     reference="PHP5"
 *     report="summary"
 *     reportFile="/path/to/reportFile"
 *     reportFileAppend="false"
 *     cacheDriver="file"
 *     recursive="false"
 *     fileExtensions="php,inc,phtml"
 *     consoleProgress="true"
 *     verbose="false"
 *     >
 *
 *   <cache id="file">
 *       <options>
 *           <save_path>/path/to/cacheDir</save_path>
 *           <gc_probability>1</gc_probability>
 *           <gc_maxlifetime>86400</gc_maxlifetime>
 *       </options>
 *   <cache>
 *
 *   <references>
 *       <reference name="Core" />
 *       <reference name="standard" />
 *   </references>
 *
 *   <php>
 *       <ini name="memory_limit" value="140M" />
 *       <ini name="short_open_tag" />
 *       <ini name="zend.ze1_compatibility_mode" value="false" />
 *   </php>
 *
 *   <excludes>
 *       <exclude id="demo">
 *           <directory name=".*\/Zend\/.*" />
 *           <file name=".*\.php5" />
 *           <extension name="xdebug">
 *           <interface name="SplSubject" />
 *           <class name=".*Compat.*" />
 *           <function name="ereg.*" />
 *           <function name="debug_print_backtrace" />
 *       </exclude>
 *
 *       <exclude id="phpunit">
 *           <constant name="T_NAMESPACE" />
 *           <constant name="T_USE" />
 *       </exclude>
 *   </excludes>
 *
 *   <listeners>
 *       <listener class="className" file="/path/to/filename">
 *           <arguments>
 *           </arguments>
 *       </listener>
 *       <listener class="PHP_CompatInfo_Listener_File" />
 *       <listener class="PHP_CompatInfo_Listener_Growl">
 *           <arguments>
 *               <string>PHP_CompatInfo</string>
 *               <array>
 *                   <element key="info">
 *                       <array>
 *                           <element key="display">
 *                               <string>Information</string>
 *                           </element>
 *                           <element key="enabled">
 *                               <boolean>true</boolean>
 *                           </element>
 *                       </array>
 *                   </element>
 *                   <element key="warning">
 *                       <array>
 *                           <element key="enabled">
 *                               <boolean>true</boolean>
 *                           </element>
 *                       </array>
 *                   </element>
 *               </array>
 *               <string>mamasam</string>
 *               <array>
 *                   <element key="host">
 *                       <string>192.168.1.2</string>
 *                   </element>
 *                   <element key="timeout">
 *                       <integer>10</integer>
 *                   </element>
 *                   <element key="debug">
 *                       <string>/path/to/logFile</string>
 *                   </element>
 *               </array>
 *           </arguments>
 *       </listener>
 *   </listeners>
 *
 *   <plugins>
 *        <reference name="PHP5"
 *           class="PEAR_CompatInfo"
 *           file="/path/to/PEARCompatInfo.php">
 *           <arguments>
 *           </arguments>
 *       </reference>
 *   </plugins>
 *
 * </phpcompatinfo>
 * </code>
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Configuration
{
    protected static $instance;

    protected $document;
    protected $xpath;
    protected $filename;

    /**
     * Loads a PHP_CompatInfo configuration file
     *
     * @param string $filename The configuration file name
     */
    protected function __construct($filename)
    {
        $this->filename = $filename;
        $this->document = self::loadFile($filename);
        $this->xpath    = new DOMXPath($this->document);
    }

    /**
     * Returns a PHP_CompatInfo configuration object
     *
     * @param string $filename The configuration file name
     *
     * @return PHP_CompatInfo_Configuration
     * @throws PHP_CompatInfo_Exception
     */
    public static function getInstance($filename)
    {
        $realpath = realpath($filename);

        if ($realpath === false) {
            throw new PHP_CompatInfo_Exception(
                sprintf(
                    'Could not read "%s".',
                    $filename
                )
            );
        }

        if (!isset(self::$instance)) {
            self::$instance = new PHP_CompatInfo_Configuration($realpath);
        }

        return self::$instance;
    }

    /**
     * Returns the configuration for listeners
     *
     * @return array
     */
    public function getPluginConfiguration()
    {
        $plugins = array();

        foreach ($this->xpath->query('plugins/reference[@name]') as $plugin) {
            $name = (string)$plugin->getAttribute('name');
            if ($plugin->hasAttribute('class')) {
                $class = (string)$plugin->getAttribute('class');
            } else {
                $class = '';
            }
            if (empty($class)) {
                continue;
            }
            $arguments = array();

            if ($plugin->hasAttribute('file')) {
                $file = realpath((string)$plugin->getAttribute('file'));
            } else {
                $file = '';
            }

            if ($plugin->childNodes->item(1) instanceof DOMElement
                && $plugin->childNodes->item(1)->tagName == 'arguments'
            ) {
                foreach ($plugin->childNodes->item(1)->childNodes as $argument) {
                    if ($argument instanceof DOMElement) {
                        $arguments[] = self::xmlToVariable($argument);
                    }
                }
            }

            $plugins[$name] = array(
              'class' => $class,
              'file'  => $file,
              'args'  => $arguments
            );
        }

        return $plugins;
    }

    /**
     * Returns the configuration for listeners
     *
     * @return array
     */
    public function getListenerConfiguration()
    {
        $listeners = array();

        foreach ($this->xpath->query('listeners/listener') as $listener) {
            if ($listener->hasAttribute('class')) {
                $class = (string)$listener->getAttribute('class');
            } else {
                $class = '';
            }
            if (empty($class)) {
                continue;
            }
            $arguments = array();

            if ($listener->hasAttribute('file')) {
                $file = realpath((string)$listener->getAttribute('file'));
            } else {
                $file = '';
            }

            if ($listener->childNodes->item(1) instanceof DOMElement
                && $listener->childNodes->item(1)->tagName == 'arguments'
            ) {
                foreach ($listener->childNodes->item(1)->childNodes as $argument) {
                    if ($argument instanceof DOMElement) {
                        $arguments[] = self::xmlToVariable($argument);
                    }
                }
            }

            $listeners[] = array(
              'class'     => $class,
              'file'      => $file,
              'arguments' => $arguments
            );
        }

        return $listeners;
    }

    /**
     * Returns the configuration for exclusions
     *
     * @param string $id Pattern components list ID
     *
     * @return array
     */
    public function getExcludeConfiguration($id)
    {
        $excludes = array();

        foreach ($this->xpath->query("excludes/exclude[@id='$id']") as $exclude) {
            foreach ($exclude->childNodes as $element) {
                if ($element instanceof DOMElement) {
                    $category = $element->tagName;
                    $name     = $element->getAttribute('name');

                    $excludes[$category][] = $name;
                }
            }
        }

        return $excludes;
    }

    /**
     * Returns the PHP configuration
     *
     * @return array
     */
    public function getPHPConfiguration()
    {
        $directives = array();

        foreach ($this->xpath->query('php/ini') as $ini) {
            if ($ini->hasAttribute('name')) {
                $name = (string)$ini->getAttribute('name');

                if ($ini->hasAttribute('value')) {
                    $value = (string)$ini->getAttribute('value');
                } else {
                    $value = 'true';
                }

                $directives[$name] = $this->getBoolean($value, $value);
            }
        }
        return $directives;
    }

    /**
     * Returns the configuration for references
     *
     * @return array
     */
    public function getReferenceConfiguration()
    {
        $references = array();

        foreach ($this->xpath->query('references/reference') as $reference) {
            $references[] = (string)$reference->getAttribute('name');
        }

        return $references;
    }

    /**
     * Returns the cache options for driver used
     *
     * @param string $driver Cache driver to use (null, file, memory, pdo)
     *
     * @return array
     */
    public function getCacheConfiguration($driver)
    {
        $cache = array();

        foreach ($this->xpath->query("cache[@id='$driver']/options") as $options) {
            foreach ($options->childNodes as $element) {
                if ($element instanceof DOMElement) {
                    $cache[$element->tagName] = $element->nodeValue;
                }
            }
        }
        return $cache;
    }

    /**
     * Returns the main PHP_CompatInfo configuration
     *
     * @return array
     */
    public function getMainConfiguration()
    {
        $result = array();
        $root   = $this->document->documentElement;

        if ($root->hasAttribute('reference')) {
            $result['reference'] = (string)$root->getAttribute('reference');
        }

        if ($root->hasAttribute('report')) {
            $result['report'] = (string)$root->getAttribute('report');
        }

        if ($root->hasAttribute('reportFile')) {
            $result['reportFile'] = (string)$root->getAttribute('reportFile');
        }

        if ($root->hasAttribute('reportFileAppend')) {
            $result['reportFileAppend'] = $this->getBoolean(
                (string)$root->getAttribute('reportFileAppend'), false
            );
        }

        if ($root->hasAttribute('cacheDriver')) {
            $result['cacheDriver'] = (string)$root->getAttribute('cacheDriver');
        }

        if ($root->hasAttribute('recursive')) {
            $result['recursive'] = $this->getBoolean(
                (string)$root->getAttribute('recursive'), false
            );
        }

        if ($root->hasAttribute('fileExtensions')) {
            $fileExtensions = explode(
                ',', (string)$root->getAttribute('fileExtensions')
            );
            $result['fileExtensions'] = array_map('trim', $fileExtensions);
        }

        if ($root->hasAttribute('consoleProgress')) {
            $result['consoleProgress'] = $this->getBoolean(
                (string)$root->getAttribute('consoleProgress'), false
            );
        }

        if ($root->hasAttribute('verbose')) {
            $result['verbose'] = $this->getBoolean(
                (string)$root->getAttribute('verbose'), false
            );
        }

        return $result;
    }

    /**
     * Casting a string to boolean value
     *
     * @param string  $value   The string to transform
     * @param boolean $default The default value if casting is impossible
     *
     * @return boolean
     */
    protected function getBoolean($value, $default)
    {
        if (strtolower($value) == 'false') {
            return false;

        } elseif (strtolower($value) == 'true') {
            return true;
        }

        return $default;
    }

    /**
     * Loads an XML file into a DOMDocument object
     *
     * @param string $filename The configuration file name
     *
     * @return DOMDocument
     * @throws PHP_CompatInfo_Exception
     */
    protected static function loadFile($filename)
    {
        $reporting = error_reporting(0);
        $contents  = file_get_contents($filename);
        error_reporting($reporting);

        if ($contents === false) {
            throw new PHP_CompatInfo_Exception(
                sprintf(
                    'Could not read "%s".',
                    $filename
                )
            );
        }

        $internal  = libxml_use_internal_errors(true);
        $message   = '';
        $reporting = error_reporting(0);
        $dom       = new DOMDocument;
        $loaded    = $dom->loadXML($contents);

        foreach (libxml_get_errors() as $error) {
            $message .= $error->message;
        }

        libxml_use_internal_errors($internal);
        error_reporting($reporting);

        if ($loaded === false) {
            if ($filename != '') {
                throw new PHP_CompatInfo_Exception(
                    sprintf(
                        'Could not load "%s".%s',
                        $filename,
                        $message != '' ? "\n" . $message : ''
                    )
                );
            } else {
                throw new PHP_CompatInfo_Exception($message);
            }
        }

        return $dom;
    }

    /**
     * "Convert" a DOMElement object into a PHP variable
     *
     * @param DOMElement $element DOM element that corresponding to the variable
     *
     * @return mixed
     */
    public static function xmlToVariable(DOMElement $element)
    {
        $variable = null;

        switch ($element->tagName) {
        case 'array':
            $variable = array();

            $doc  = new DOMDocument;
            $node = $doc->importNode($element, true);
            $doc->appendChild($node);

            $xpath = new DOMXPath($doc);

            foreach ($xpath->query('//element[not(ancestor::element)]')
                as $element) {
                if ($element->childNodes->item(1) instanceof DOMElement) {
                    $value = self::xmlToVariable($element->childNodes->item(1));
                } else {
                    $value = null;
                }

                if ($element->hasAttribute('key')) {
                    $variable[(string)$element->getAttribute('key')] = $value;
                } else {
                    $variable[] = $value;
                }
            }
            break;

        case 'object':
            $className = $element->getAttribute('class');

            if ($element->hasChildNodes()) {
                $arguments       = $element->childNodes->item(1)->childNodes;
                $constructorArgs = array();

                foreach ($arguments as $argument) {
                    if ($argument instanceof DOMElement) {
                        $constructorArgs[] = self::xmlToVariable($argument);
                    }
                }

                $class    = new ReflectionClass($className);
                $variable = $class->newInstanceArgs($constructorArgs);
            } else {
                $variable = new $className;
            }
            break;

        case 'boolean':
            $variable = $element->nodeValue == 'true' ? true : false;
            break;

        case 'integer':
        case 'double':
        case 'string':
            $variable = $element->nodeValue;

            settype($variable, $element->tagName);
            break;
        }

        return $variable;
    }

}
