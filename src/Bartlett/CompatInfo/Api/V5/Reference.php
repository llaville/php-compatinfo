<?php declare(strict_types=1);

/**
 * Display references summaries
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Api\V5;

use Bartlett\CompatInfoDb\ExtensionFactory;

use Bartlett\Reflect\Api\V3\Common;

use Closure;
use PDO;

/**
 * Api to obtain information about one or more references (extensions)
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 4.0.0-alpha2+1
 */
class Reference extends Common
{
    public function __call(string $name, array $args)
    {
        if ('list' == $name) {
            return $this->dir();
        }
    }

    /**
     * List all references supported.
     *
     * @return array
     */
    public function dir(): array
    {
        $factory = new ExtensionFactory('');
        return $factory->getExtensions();
    }

    /**
     * Show information about a reference.
     *
     * @param string   $name       Introspection of a reference (case insensitive)
     * @param Closure  $closure    Function used to filter results
     * @param mixed    $releases   Show releases
     * @param mixed    $ini        Show ini Entries
     * @param mixed    $constants  Show constants
     * @param mixed    $functions  Show functions
     * @param mixed    $interfaces Show interfaces
     * @param mixed    $classes    Show classes
     * @param mixed    $methods    Show methods
     * @param mixed    $classConstants Show class constants
     *
     * @return array
     */
    public function show(
        string $name,
        Closure $closure,
        $releases,
        $ini,
        $constants,
        $functions,
        $interfaces,
        $classes,
        $methods,
        $classConstants
    ): array {
        $reference = new ExtensionFactory($name);
        $results   = array();
        $summary   = array();

        $raw = $reference->getReleases();
        $summary['releases'] = count($raw);
        if ($releases) {
            $results['releases'] = $raw;
        }

        $raw = $reference->getIniEntries();
        $summary['iniEntries'] = count($raw);
        if ($ini) {
            $results['iniEntries'] = $raw;
        }

        $raw = $reference->getConstants();
        $summary['constants'] = count($raw);
        if ($constants) {
            $results['constants'] = $raw;
        }

        $raw = $reference->getFunctions();
        $summary['functions'] = count($raw);
        if ($functions) {
            $results['functions'] = $raw;
        }

        $raw = $reference->getInterfaces();
        $summary['interfaces'] = count($raw);
        if ($interfaces) {
            $results['interfaces'] = $raw;
        }

        $raw = $reference->getClasses();
        $summary['classes'] = count($raw);
        if ($classes) {
            $results['classes'] = $raw;
        }

        $raw = $reference->getClassConstants();
        $summary['class-constants'] = 0;
        foreach ($raw as $values) {
            $summary['class-constants'] += count($values);
        }
        if ($classConstants) {
            $results['class-constants'] = $raw;
        }

        $raw = $reference->getClassMethods();
        $summary['methods'] = 0;
        foreach ($raw as $values) {
            $summary['methods'] += count($values);
        }
        if ($methods) {
            $results['methods'] = $raw;
        }

        $raw = $reference->getClassStaticMethods();
        $summary['static methods'] = 0;
        foreach ($raw as $values) {
            $summary['static methods'] += count($values);
        }
        if ($methods) {
            $results['static methods'] = $raw;
        }

        if (empty($results)) {
            return array('summary' => $summary);
        }
        return $closure($results);
    }
}
