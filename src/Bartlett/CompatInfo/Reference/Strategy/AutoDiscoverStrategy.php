<?php

namespace Bartlett\CompatInfo\Reference\Strategy;

class AutoDiscoverStrategy extends AbstractReferenceFinder implements ReferenceFinderInterface
{
    /**
     * Finds an element following priority rules
     *
     * @param string $element    Name of element you are searching for Reference
     * @param array  $priorities Seaching priority rules
     *
     * @return string
     */
    protected function find($element, $priorities)
    {
        $needle = strtolower($element);
        $index  = substr($needle, 0, 1);

        if (isset($this->cache[$index])) {
            if (isset($this->cache[$index][$needle])) {
                // already found
                $this->typeElement = $this->cache[$index][$needle]['type'];
                return $this->cache[$index][$needle]['name'];
            }
        }

        foreach ($this->extensions as $name => $path) {
            // try with this extension if its name match part of element name
            if (strpos($needle, $name) === false) {
                continue;
            }

            // first, load extension Reference (if not yet done)
            if (!isset($this->references[$name])) {
                $this->references[$name] = new $path;
            }

            // second, seach element following the priority rules
            foreach ($priorities as $priority) {
                $method = 'get' . ucfirst($priority);
                $items  = $this->references[$name]->{$method}();

                if (array_key_exists($needle, array_change_key_case($items))) {
                    // found element. Save in cache to speed up next searches
                    $this->cache[$index][$needle]['name'] = $name;
                    $this->cache[$index][$needle]['type'] = $priority;
                    $this->typeElement = $priority;
                    return $name;
                }
            }
        }
        // element seems not provided by any extension.
        // Save in cache to speed up next searches
        $this->cache[$index][$needle]['name'] = $name = 'user';
        $this->cache[$index][$needle]['type'] = $priority = array_shift($priorities);
        $this->typeElement = $priority;
        return $name;
    }
}
