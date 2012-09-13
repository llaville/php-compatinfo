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
 * @version  SVN: $Id$
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
        } else {
            list($extension, $version) = $args;
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

        } elseif ($version === null) {
            $version   = '4.0.0';
            $condition = 'ge';
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
        foreach ($items as $name => $versions) {
            if ($this->filter['extension'] === true) {
                $compare = $release;
            } else {
                $compare = $versions[0];
            }
            if (version_compare(
                $compare, $this->filter['version'], $this->filter['condition']
            )) {
                $versions['extVersions'][0] = $release;
                $versions['extVersions'][1] = false;
                $elements[$name]            = $versions;
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
        if (isset($elements[$name]['extVersions'])) {
            $elements[$name]['extVersions'][1] = $version;
        }
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
