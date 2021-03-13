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

use Bartlett\CompatInfoDb\Application\Query\ListRef\ListHandler;
use Bartlett\CompatInfoDb\Application\Query\ListRef\ListQuery;
use Bartlett\CompatInfoDb\Application\Query\Show\ShowHandler;
use Bartlett\CompatInfoDb\Application\Query\Show\ShowQuery;
use Bartlett\CompatInfoDb\Domain\ValueObject\Extension;
use Bartlett\CompatInfoDb\Domain\ValueObject\Platform;
use Bartlett\CompatInfoDb\Infrastructure\Persistence\Doctrine\Entity\Release;
use Bartlett\CompatInfoDb\Presentation\Console\ApplicationInterface;
use Bartlett\Reflect\Api\V3\Common;

use Closure;
use stdClass;
use function array_values;
use function array_walk;
use function extension_loaded;
use function ksort;
use function version_compare;

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
            if (count($args) === 0) {
                $container = require dirname(__DIR__, 5) . '/config/container.php';
                $handler = $container->get(ListHandler::class);
                return $this->dir($handler);
            }
            return $this->dir(...$args);
        }
        return null;
    }

    /**
     * List all references supported.
     *
     * @param ListHandler $handler
     * @return array
     */
    public function dir(ListHandler $handler): array
    {
        $query = new ListQuery(true, false, ApplicationInterface::VERSION);

        /** @var Platform $platform */
        $platform = $handler($query);

        $rows = [];

        foreach ($platform->getExtensions() as $extension) {
            $key = $extension->getName();

            $releases = $extension->getReleases();
            /** @var Release $latest */
            $latest = $releases->last();

            $ref = new stdClass();
            $ref->name = $key;
            $ref->version = $latest->getVersion();
            $ref->state = $latest->getState();
            $ref->date = $latest->getDate()->format('Y-m-d');

            if (extension_loaded($key)) {
                $version = \phpversion($key);
            } else {
                $version = '';
            }
            $ref->loaded   = $version;
            $ref->outdated = version_compare($ref->version, $version, 'gt') ;

            $rows[$key] = $ref;
        }

        ksort($rows);
        return array_values($rows);
    }

    /**
     * Show information about a reference.
     *
     * @param string $name Introspection of a reference (case insensitive)
     * @param Closure $closure Function used to filter results
     * @param mixed $releases Show releases
     * @param mixed $ini Show ini Entries
     * @param mixed $constants Show constants
     * @param mixed $functions Show functions
     * @param mixed $interfaces Show interfaces
     * @param mixed $classes Show classes
     * @param mixed $methods Show methods
     * @param mixed $classConstants Show class constants
     * @param ShowHandler $handler
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
        $classConstants,
        ShowHandler $handler
    ): array {
        $flags = [$releases, $ini, $constants, $functions, $interfaces, $classes, $methods, $classConstants];
        array_walk($flags, function(&$value) {
            if (null === $value) {
                $value = true;
            }
        });

        $query = new ShowQuery($name, ...$flags);

        /** @var Extension $extension */
        $reference = $handler($query);

        $results   = array();
        $summary   = array();

        $raw = $reference->getReleases();
        $summary['releases'] = count($raw);
        if ($query->isReleases()) {
            $results['releases'] = $raw;
        }

        $raw = $reference->getIniEntries();
        $summary['iniEntries'] = count($raw);
        if ($query->isIni()) {
            $results['iniEntries'] = $raw;
        }

        $raw = $reference->getConstants();
        $summary['constants'] = count($raw);
        if ($query->isConstants()) {
            $results['constants'] = $raw;
        }

        $raw = $reference->getFunctions();
        $summary['functions'] = count($raw);
        if ($query->isFunctions()) {
            $results['functions'] = $raw;
        }

        $raw = $reference->getInterfaces();
        $summary['interfaces'] = count($raw);
        if ($query->isInterfaces()) {
            $results['interfaces'] = $raw;
        }

        $raw = $reference->getClasses();
        $summary['classes'] = count($raw);
        if ($query->isClasses()) {
            $results['classes'] = $raw;
        }

        $raw = $reference->getClassConstants();
        $summary['class-constants'] = count($raw);
        if ($query->isClassConstants()) {
            $results['class-constants'] = $raw;
        }

        $raw = $reference->getMethods();
        $summary['methods'] = count($raw);
        if ($query->isMethods()) {
            $results['methods'] = $raw;
        }

        if (empty($results)) {
            return array('summary' => $summary);
        }
        return $closure($results);
    }
}
