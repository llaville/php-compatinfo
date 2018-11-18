<?php
/**
 * Display references summaries
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Api;

use Bartlett\Reflect\Api\BaseApi;

/**
 * Api to obtain information about one or more references (extensions)
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha2+1
 */
class Reference extends BaseApi
{
    /**
     * List all references supported.
     *
     * @return array
     * @alias  list
     */
    public function dir()
    {
        return $this->request('reference/list');
    }

    /**
     * Show information about a reference.
     *
     * @param string $name       Introspection of a reference (case insensitive)
     * @param mixed  $filter     Resource that provide a closure to filter results
     * @param mixed  $releases   Show releases
     * @param mixed  $ini        Show ini Entries
     * @param mixed  $constants  Show constants
     * @param mixed  $functions  Show functions
     * @param mixed  $interfaces Show interfaces
     * @param mixed  $classes    Show classes
     * @param mixed  $methods    Show methods
     * @param mixed  $classConstants Show class constants
     *
     * @return array
     */
    public function show(
        $name,
        $filter = false,
        $releases = null,
        $ini = null,
        $constants = null,
        $functions = null,
        $interfaces = null,
        $classes = null,
        $methods = null,
        $classConstants = null
    ) {
        if ($filter instanceof \Closure) {
            $closure = $filter;

        } elseif ($filter === false) {
            $closure = function ($data) {
                return $data;
            };

        } else {
            if ($filterRes = stream_resolve_include_path($filter)) {
                include_once $filterRes;
            }
            if (!isset($closure) || !is_callable($closure)) {
                throw new \RuntimeException(
                    sprintf(
                        'Invalid filter provided by file "%s"',
                        $filterRes ? : $filter
                    )
                );
            }
        }
        return $this->request(
            'reference/show',
            'POST',
            array($name, $closure, $releases, $ini, $constants, $functions, $interfaces, $classes, $methods, $classConstants)
        );
    }
}
