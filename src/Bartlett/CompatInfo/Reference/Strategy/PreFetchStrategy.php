<?php

namespace Bartlett\CompatInfo\Reference\Strategy;

class PreFetchStrategy extends AbstractReferenceFinder implements ReferenceFinderInterface
{
    protected $buffer = array();

    /**
     * Initializes list of References always loaded.
     */
    public function __construct(array $extensions = null)
    {
        parent::__construct();

        if (empty($extensions)) {
            $extensions = array_keys($this->extensions);
        }

        while (!empty($extensions)) {
            $name = strtolower(array_shift($extensions));

            if (!array_key_exists($name, $this->extensions)) {
                trigger_error(
                    sprintf(
                        'The %s extension is not supported by distribution %s',
                        $name,
                        strpos('@package_version@', '@') === 0 ? 'DEV' : '@package_version@'
                    ),
                    E_USER_NOTICE
                );
                continue;
            }

            // load extension Reference (if not yet done)
            if (!isset($this->references[$name])) {
                $this->references[$name] = new $this->extensions[$name];
            }
            $this->buffer[] = $name;
        }
    }

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
        //error_log(sprintf('Find "%s" following priorities "%s" [PreFetchStrategy]', $element, json_encode($priorities)));

        $needle = strtolower($element);
        $index  = substr($needle, 0, 1);

        if (isset($this->cache[$index])) {
            if (isset($this->cache[$index][$needle])) {
                // already found
                //error_log(sprintf('--> Found in cache; "%s" (as %s) Reference [PreFetchStrategy]', $this->cache[$index][$needle]['name'], $this->cache[$index][$needle]['type']));
                $this->typeElement = $this->cache[$index][$needle]['type'];
                return $this->cache[$index][$needle]['name'];
            }
        }

        foreach ($this->buffer as $name) {
            // seach element following the priority rules
            foreach ($priorities as $priority) {
                $method = 'get' . ucfirst($priority);
                $items  = $this->references[$name]->{$method}();

                if (array_key_exists($needle, array_change_key_case($items))) {
                    // found element. Save in cache to speed up next searches
                    $this->cache[$index][$needle]['name'] = $name;
                    $this->cache[$index][$needle]['type'] = $priority;
                    //error_log(sprintf('--> Found in "%s" Reference by "%s" rule [PreFetchStrategy]', $name, $priority));
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
        //error_log('--> Not Found [PreFetchStrategy] on ' . $this->typeElement);
        return $name;
    }
}
