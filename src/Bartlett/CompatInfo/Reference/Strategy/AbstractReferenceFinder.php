<?php

namespace Bartlett\CompatInfo\Reference\Strategy;

abstract class AbstractReferenceFinder
{
    const FIND_INTERFACES = 'interfaces';
    const FIND_CLASSES    = 'classes';
    const FIND_FUNCTIONS  = 'functions';
    const FIND_CONSTANTS  = 'constants';
    const FIND_INIENTRIES = 'iniEntries';

    protected $extensions = array();
    protected $references = array();
    protected $cache      = array();
    protected $typeElement;

    /**
     * Initializes list of References provided by this distribution.
     */
    public function __construct()
    {
        $path = dirname(__DIR__) . '/Extension';

        if ($uri = \Phar::running(false)) {
            $iterator = new \RecursiveIteratorIterator(new \Phar($uri));
        } else {
            $iterator = new \DirectoryIterator($path);
        }

        foreach ($iterator as $file) {
            if (fnmatch('*Extension.php', $file->getPathName())) {
                $className = basename($file, '.php');
                $extName   = strtolower(str_replace('Extension', '', $className));

                $this->extensions[$extName]
                    = 'Bartlett\\CompatInfo\\Reference\\Extension\\' . $className;
            }
        }
    }

    /**
     * Gets the name of Reference that provide this $element
     *
     * @param string $element Name of element you are searching for Reference
     *
     * @return string
     */
    public function findAny($element)
    {
        $priorities = array();

        $parts = explode('\\', $element);
        $item  = array_pop($parts);

        if (count($parts) > 0 && strtoupper($item) === $item) {
            // seems to be a constant in a namespace
            array_push($priorities, self::FIND_CONSTANTS);
        }
        if (strtoupper($element) === $element) {
            // seems to be a constant
            array_push($priorities, self::FIND_CONSTANTS);
        }
        if (strpos($element, '_') !== false) {
            // seems to be a function
            array_push($priorities, self::FIND_FUNCTIONS);
        }
        if (strpos($element, '\\') !== false) {
            // seems to be a class, interface or trait, with namespace
            array_push($priorities, self::FIND_CLASSES, self::FIND_INTERFACES);
        }
        if (strpos($element, '.') !== false) {
            // seems to be an INI entry
            array_push($priorities, self::FIND_INIENTRIES);
        }
        array_push(
            $priorities,
            self::FIND_INTERFACES,
            self::FIND_CLASSES,
            self::FIND_FUNCTIONS,
            self::FIND_CONSTANTS,
            self::FIND_INIENTRIES
        );
        $priorities = array_unique($priorities);

        return $this->find($element, $priorities);
    }

    /**
     * Gets the name of Reference that provide this interface $element
     *
     * @param string $element Name of element you are searching for Reference
     *
     * @return string
     */
    public function findInterface($element)
    {
        return $this->find($element, array(self::FIND_INTERFACES));
    }

    /**
     * Gets the name of Reference that provide this class $element
     *
     * @param string $element Name of element you are searching for Reference
     *
     * @return string
     */
    public function findClass($element)
    {
        return $this->find($element, array(self::FIND_CLASSES));
    }

    /**
     * Gets the name of Reference that provide this function $element
     *
     * @param string $element Name of element you are searching for Reference
     *
     * @return string
     */
    public function findFunction($element)
    {
        return $this->find($element, array(self::FIND_FUNCTIONS));
    }

    /**
     * Gets the name of Reference that provide this constant $element
     *
     * @param string $element Name of element you are searching for Reference
     *
     * @return string
     */
    public function findConstant($element)
    {
        return $this->find($element, array(self::FIND_CONSTANTS));
    }

    /**
     * Gets the name of Reference that provide this INI entry $element
     *
     * @param string $element Name of element you are searching for Reference
     *
     * @return string
     */
    public function findIniEntry($element)
    {
        return $this->find($element, array(self::FIND_INIENTRIES));
    }

    /**
     * Gets instances list of Reference.
     *
     * @param string $name (optional)
     *
     * @return array Object ReferenceInterface
     */
    public function getLoadedReferences($name = null)
    {
        if (isset($name)) {
            return $this->references[$name];
        }
        return $this->references;
    }

    public function getTypeElement()
    {
        return $this->typeElement;
    }
}
