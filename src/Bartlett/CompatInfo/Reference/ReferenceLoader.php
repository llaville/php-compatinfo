<?php

namespace Bartlett\CompatInfo\Reference;

use Bartlett\CompatInfo\Reference\Strategy\ReferenceFinderInterface;

class ReferenceLoader implements \Countable
{
    protected $loaders;
    protected $typeElement;

    /**
     * Creates a new instance of ReferenceLoader.
     */
    public function __construct()
    {
        $this->loaders = new \SplObjectStorage;
    }

    /**
     * Unregisters a Reference autoloader.
     *
     * @param ReferenceFinderInterface $finder The class to remove from stack
     *
     * @return self for fluent interface
     */
    public function unregister(ReferenceFinderInterface $finder)
    {
        if (!$this->loaders->contains($finder)) {
            throw new \OutOfBoundsException(
                'Reference Finder "'. get_class($finder) . '" is not registered'
            );
        }
        $this->loaders->detach($finder);
        return $this;
    }

    /**
     * Registers a Reference autoloader.
     *
     * @param ReferenceFinderInterface $finder A class that have ability
     *                                         to search and load references
     *
     * @return self for fluent interface
     */
    public function register(ReferenceFinderInterface $finder)
    {
        $this->loaders->attach($finder);
        return $this;
    }

    /**
     * Returns the number of Reference loaders already registered.
     *
     * @return int
     */
    public function count()
    {
        return $this->loaders->count();
    }

    /**
     * Loads the given Reference that provides searched element.
     *
     * @param string $element  Name of element to find
     * @param string $priority (optional) Restrict search group
     *                         (any of AbstractReferenceFinder::FIND_* constant)
     *
     * @return null|object Instance of Reference
     */
    public function loadRef($element, $priority = null)
    {
        if ($this->loaders->count() === 0) {
            return;
        }

        foreach ($this->loaders as $loader) {
            switch ($priority) {
                case $loader::FIND_INTERFACES:
                    $name = $loader->findInterface($element);
                    break;
                case $loader::FIND_CLASSES:
                    $name = $loader->findClass($element);
                    break;
                case $loader::FIND_FUNCTIONS:
                    $name = $loader->findFunction($element);
                    break;
                case $loader::FIND_CONSTANTS:
                    $name = $loader->findConstant($element);
                    break;
                case $loader::FIND_INIENTRIES:
                    $name = $loader->findIniEntry($element);
                    break;
                default:
                    $name = $loader->findAny($element);
            }
            $this->typeElement = $loader->getTypeElement();
            if ('user' !== $name) {
                return $loader->getLoadedReferences($name);
            }
            // try to see if other loader can find element provider
        }
    }

    /**
     *
     */
    public function getTypeElement()
    {
        return $this->typeElement;
    }

    /**
     * Returns list of all References provided.
     *
     * @return array
     */
    public function getProvidedReferences()
    {
        $refs = array();
        $path = __DIR__ . '/Extension/';

        $iterator = new \DirectoryIterator($path);

        foreach ($iterator as $item) {
            if ($item->isDot()) {
                continue;
            }
            if (strpos($item->getFilename(), 'Extension') === false) {
                continue;
            }
            $className = basename($item->getFilename(), '.php');
            $extName   = strtolower(str_replace('Extension', '', $className));

            // special case for "Zend OPcache" (with a blank in its name)
            if ('zendopcache' == $extName) {
                $extName = 'zend opcache';
            }

            $refs[$extName] = new \stdClass;
        }

        foreach ($this->loaders as $loader) {
            $loadedRefs = $loader->getLoadedReferences();
            foreach ($loadedRefs as $ref) {
                $extName = strtolower($ref->getName());
                $refs[$extName]->name    = $ref->getName();
                $refs[$extName]->version = $ref->getLatestVersion();
                if (extension_loaded($extName)) {
                    $refs[$extName]->loaded = $ref->getCurrentVersion();
                } else {
                    $refs[$extName]->loaded = '';
                }
            }
        }
        return $refs;
    }

    /**
     * String representation of References list.
     *
     * @return string
     */
    public function __toString()
    {
        $eol = "\n";
        $str = '';

        $refs = $this->getProvidedReferences();

        $loadedCount = 0;

        $str .= sprintf(
            'References [%d], loaded [%%loaded%%]%s',
            count($refs),
            $eol
        );

        foreach ($refs as $name => $ref) {
            if (isset($ref->loaded)) {
                if (empty($ref->loaded)) {
                    $loaded = '';
                } else {
                    $loadedCount++;
                    $loaded = sprintf(' loaded%s',
                        $ref->loaded == $ref->version ? '' : ' ' . $ref->loaded
                    );
                }
                $str .= sprintf(
                    '  - Extension [ %s version %s%s ]%s',
                    $ref->name,
                    $ref->version,
                    $loaded,
                    $eol
                );
            } else {
                $str .= sprintf(
                    '  - Extension [ %s ]%s',
                    $name,
                    $eol
                );
            }
        }
        $str = str_replace('%loaded%', $loadedCount, $str);
        return $str;
    }
}
