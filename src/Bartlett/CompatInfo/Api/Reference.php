<?php declare(strict_types=1);

/**
 * Display references summaries
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Api;

use Bartlett\CompatInfoDb\Application\Query\Show\ShowHandler;
use Bartlett\Reflect\Api\BaseApi;

use Closure;

/**
 * Api to obtain information about one or more references (extensions)
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
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
    public function dir(): array
    {
        return $this->request('reference/list', 'GET', func_get_args());
    }

    /**
     * Show information about a reference.
     *
     * @param string $name Introspection of a reference (case insensitive)
     * @param mixed $filter Resource that provide a closure to filter results
     * @param mixed $releases Show releases
     * @param mixed $ini Show ini Entries
     * @param mixed $constants Show constants
     * @param mixed $functions Show functions
     * @param mixed $interfaces Show interfaces
     * @param mixed $classes Show classes
     * @param mixed $methods Show methods
     * @param mixed $classConstants Show class constants
     * @param ShowHandler|null $showHandler
     *
     * @return array
     */
    public function show(
        string $name,
        $filter = false,
        $releases = null,
        $ini = null,
        $constants = null,
        $functions = null,
        $interfaces = null,
        $classes = null,
        $methods = null,
        $classConstants = null,
        ShowHandler $showHandler = null
    ) {
        if (null === $showHandler) {
            $container = require dirname(__DIR__, 4) . '/config/container.php';
            $showHandler = $container->get(ShowHandler::class);
        }

        if ($filter instanceof Closure) {
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
            array($name, $closure, $releases, $ini, $constants, $functions, $interfaces, $classes, $methods, $classConstants, $showHandler)
        );
    }
}
