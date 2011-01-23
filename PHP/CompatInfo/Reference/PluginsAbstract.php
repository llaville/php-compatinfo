<?php

require_once 'PHP/CompatInfo/Reference.php';

/**
 * Plugins Abstract
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
     * @param string $ext  
     * @param array  $arr
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
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        trigger_error(
            sprintf(
                "You should implement the %s function in your reference plugin",
                __FUNCTION__
            )
        );
        return array();
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        trigger_error(
            sprintf(
                "You should implement the %s function in your reference plugin",
                __FUNCTION__
            )
        );
        return array();
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null)
    {
        trigger_error(
            sprintf(
                "You should implement the %s function in your reference plugin",
                __FUNCTION__
            )
        );
        return array();
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getFunctions($extension = null, $version = null)
    {
        trigger_error(
            sprintf(
                "You should implement the %s function in your reference plugin",
                __FUNCTION__
            )
        );
        return array();
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getConstants($extension = null, $version = null)
    {
        trigger_error(
            sprintf(
                "You should implement the %s function in your reference plugin",
                __FUNCTION__
            )
        );
        return array();
    }

}
