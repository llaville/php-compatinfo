<?php
/**
 * Data dictionary for PHP4 references
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
 * Data dictionary for PHP4 references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_PHP4
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * @var array
     */
    protected $extensionReferences = array();

    /**
     * Class constructor of PHP4 References
     *
     * @param array $extensions (optional) List of extensions to look for
     *                          (default: all supported by current platform)
     */
    public function __construct($extensions = null)
    {
        if (isset($extensions)) {
            $extensions = (array)$extensions;
        } else {
            $extensions = get_loaded_extensions();

            // forward compatibility with PHP 5.3 and greater
            if (version_compare(PHP_VERSION, '5.3.0', 'lt')) {
                $extensions[] = 'Core';
            }
        }

        foreach ($extensions as $extension) {
            $refClassName = 'PHP_CompatInfo_Reference_' . ucfirst(str_replace(' ', '', $extension));
            $refClassName = str_replace(' ', '_', $refClassName);
            if (class_exists($refClassName, true)) {
                $this->extensionReferences[$extension] = new $refClassName;
            } else {
                $this->warnings[] = "Cannot load extension reference '$extension'";
            }
        }
    }

    /**
     * Returns a PHP_CompatInfo_Reference object.
     *
     * @param  string $element One of reference's element to discover
     * @return mixed  FALSE if reference could not be loaded or is not detected,
     *                reference object instance otherwise
     */
    public function loadReference($element)
    {
        return parent::loadReference($element);
    }

    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants, globals, tokens
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getAll($extension = null, $version = '4', $condition = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version, $condition),
            'interfaces' => $this->getInterfaces($extension, $version, $condition),
            'classes'    => $this->getClasses($extension, $version, $condition),
            'functions'  => $this->getFunctions($extension, $version, $condition),
            'constants'  => $this->getConstants($extension, $version, $condition),
            'globals'    => $this->getGlobals($extension, $version, $condition),
            'tokens'     => $this->getTokens($extension, $version, $condition),
        );
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
    public function getExtensions($extension = null, $version = '4', $condition = null)
    {
        $extensions = array();

        foreach ($this->extensionReferences as $ext => $extRefObject) {
            $values = $extRefObject->getExtensions($extension, $version, $condition);

            $extensions = array_merge(
                $extensions,
                $values
            );
        }
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
    public function getInterfaces($extension = null, $version = '4', $condition = null)
    {
        $interfaces = array();

        foreach ($this->extensionReferences as $ext => $extRefObject) {
            $values = $extRefObject->getInterfaces($extension, $version, $condition);

            $interfaces = array_merge(
                $interfaces,
                $this->combineExtension($ext, $values)
            );
        }
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
    public function getClasses($extension = null, $version = '4', $condition = null)
    {
        $classes = array();

        foreach ($this->extensionReferences as $ext => $extRefObject) {
            $values = $extRefObject->getClasses($extension, $version, $condition);

            $classes = array_merge(
                $classes,
                $this->combineExtension($ext, $values)
            );
        }
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
    public function getFunctions($extension = null, $version = '4', $condition = null)
    {
        $functions = array();

        foreach ($this->extensionReferences as $ext => $extRefObject) {
            $values = $extRefObject->getFunctions($extension, $version, $condition);

            $functions = array_merge(
                $functions,
                $this->combineExtension($ext, $values)
            );
        }
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
    public function getConstants($extension = null, $version = '4', $condition = null)
    {
        $constants = array();

        foreach ($this->extensionReferences as $ext => $extRefObject) {
            $values = $extRefObject->getConstants($extension, $version, $condition);

            $constants = array_merge(
                $constants,
                $this->combineExtension($ext, $values)
            );
        }
        return $constants;
    }

    /**
     * Gets informations about superglobals
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getGlobals($extension = null, $version = '4', $condition = null)
    {
        $globals      = array();
        $ext          = 'standard';
        $extRefObject = $this->extensionReferences[$ext] ;

        if ($extRefObject instanceof PHP_CompatInfo_Reference) {
            $values = $extRefObject->getGlobals($extension, $version, $condition);

            $globals = array_merge(
                $globals,
                $this->combineExtension($ext, $values)
            );
        }
        return $globals;
    }

    /**
     * Gets informations about tokens (language features)
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getTokens($extension = null, $version = '4', $condition = null)
    {
        $tokens       = array();
        $ext          = 'standard';
        $extRefObject = $this->extensionReferences[$ext] ;

        if ($extRefObject instanceof PHP_CompatInfo_Reference) {
            $values = $extRefObject->getTokens($extension, $version, $condition);

            $tokens = array_merge(
                $tokens,
                $this->combineExtension($ext, $values)
            );
        }
        return $tokens;
    }

}
