<?php
/**
 * Plugins Abstract
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
 * Abstract base class for any plugins
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
abstract class PHP_CompatInfo_Reference_PluginsAbstract
    implements PHP_CompatInfo_Reference
{
    /**
     * Define latest versions of PHP branches (5.2, 5.3, 5.4, 5.5)
     */
    const LATEST_PHP_5_2 = '5.2.17';
    const LATEST_PHP_5_3 = '5.3.27';
    const LATEST_PHP_5_4 = '5.4.21RC1';
    const LATEST_PHP_5_5 = '5.5.5RC1';

    /**
     * Warning messages generated during loading of extensions references
     * @var array
     */
    protected $warnings = array();

    /**
     * Extension/Version/Condition to filter data reference
     * @var array
     */
    protected $filter;

    /**
     * Tells if some extensions references could not be loaded
     *
     * @return bool
     */
    public function hasWarnings()
    {
        return (count($this->warnings) > 0);
    }

    /**
     * Returns list of warning messages emitted
     * during loading of extensions references
     *
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Update data informations
     *
     * @param string $ext Extension name
     * @param array  $arr Components of this extension
     *
     * @return array
     */
    protected function combineExtension($ext, $arr)
    {
        $values = array();

        foreach ($arr as $name => $versions) {
            $values[$name][$ext] = $versions;
        }
        return $values;
    }

    /**
     * Defines the filter to get data reference that match your need
     *
     * @param array $args Array of variable argument (extension, version, condition)
     *
     * @return void
     */
    protected function setFilter($args)
    {
        if (count($args) > 2) {
            list($extension, $version, $condition) = $args;
        } elseif (count($args) > 1) {
            list($extension, $version) = $args;
        } else {
            $extension = $version = $condition = null;
        }

        if ($extension === true && $version === null) {
            $class = new ReflectionClass(get_class($this));
            $name  = 'REF_VERSION';
            if ($class->hasConstant($name)) {
                $version = $class->getConstant($name);
            } else {
                $version = '';
            }

        } elseif ($version === '4') {
            $version   = '5.0.0';
            $condition = 'lt';

        } elseif ($version === '5') {
            $version   = '5.0.0';
            $condition = 'ge';

        } elseif (empty($version)) {
            $version   = '4.0.0';
            $condition = 'ge';

        } elseif (substr_count($version, '.') === 1) {
            // try to normalize version number
            $version .= '.0';
        }

        if (!isset($condition)) {
            $condition = 'le';
        }
        $this->filter = array(
            'extension' => $extension,
            'version'   => $version,
            'condition' => $condition
        );
    }

    /**
     * Apply the filter criteria on each element of $items array
     *
     * @param string $release  Release version
     * @param array  $items    Release informations
     * @param array  $elements Variable that host data
     *
     * @return void
     */
    protected function applyFilter($release, $items, &$elements)
    {
        if ($release === false) {
            // to all references that are not yet fully releases explained
            $release = '';
        }

        foreach ($items as $name => $versions) {
            if ($this->filter['extension'] === true) {
                $compare = $release;
            } else {
                $compare = $versions[0];
            }
            if (version_compare(
                $compare, $this->filter['version'], $this->filter['condition']
            )) {
                /**
                 * offset description
                 *  0     php min value
                 *  1     php Max value
                 *  2     ext/release min value
                 *  3     ext/release Max value
                 *  4+    (optional) argument with php min value
                 */
                array_splice($versions, 2, 0, array($release, ''));
                $elements[$name] = $versions;
            }
        }
    }

    /**
     * Sets the maximum version where an element is still available in an extension
     *
     * @param string $version  Maximum extension version where an element exists
     * @param string $name     Element name
     * @param array  $elements Variable that host data
     *
     * @return void
     */
    protected function setMaxExtensionVersion($version, $name, &$elements)
    {
        if (isset($elements[$name])) {
            $elements[$name][3] = $version;
        }
    }

    /**
     * Sets the exclusion list of PHP version an element is not available
     *
     * @param mixed  $versions One version or a list of PHP versions to exclude
     *                         about the element $name
     * @param string $name     Element name
     * @param array  $elements Variable that host data
     *
     * @return void
     */
    protected function setExcludeVersions($versions, $name, &$elements)
    {
        if (!isset($elements[$name])) {
            return;
        }
        if (!is_array($versions)) {
            $versions = array($versions);
        }
        $elements[$name]['excludes'] = $versions;
    }

    /**
     * Returns a PHP_CompatInfo_Reference object.
     *
     * @param string $element  One of reference's element to discover
     * @param bool   $prefetch (optional) When FALSE, do a matching rules search.
     *                         Otherwise force a prefetch with $element
     *                         that identify a reference.
     *
     * @return mixed FALSE if reference could not be loaded or is not detected,
     *               reference object instance otherwise
     */
    public function loadReference($element, $prefetch = FALSE)
    {
        return $this;
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
        $references = array(
            'extensions' => $this->getExtensions($extension, $version, $condition),
            'interfaces' => $this->getInterfaces($extension, $version, $condition),
            'classes'    => $this->getClasses($extension, $version, $condition),
            'functions'  => $this->getFunctions($extension, $version, $condition),
            'constants'  => $this->getConstants($extension, $version, $condition),
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
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        return array();
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
    public function getInterfaces($extension = null, $version = null, $condition = null)
    {
        return array();
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
        return array();
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
        return array();
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
        return array();
    }

}
