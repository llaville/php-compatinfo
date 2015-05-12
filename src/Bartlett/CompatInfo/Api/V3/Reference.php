<?php
/**
 * Display references summaries
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Api\V3;

use Bartlett\CompatInfo\Environment;
use Bartlett\CompatInfo\Reference\ExtensionFactory;

use Bartlett\Reflect\Api\V3\Common;

use PDO;

/**
 * Api to obtain information about one or more references (extensions)
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha2+1
 */
class Reference extends Common
{
    public function __call($name, $args)
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
    public function dir()
    {
        $pdo = Environment::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query(
            'SELECT e.name, rel_date as "date", rel_state as "state",' .
            ' rel_version as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max"' .
            ' FROM bartlett_compatinfo_releases r,  bartlett_compatinfo_extensions e' .
            ' WHERE r.ext_name_fk = e.id' .
            ' ORDER BY e.name asc, date desc, rel_version desc'
        );

        $rows = array();

        foreach ($stmt as $rec) {
            $key = strtolower($rec['name']);

            if (!empty($rec['date']) && !array_key_exists($key, $rows)) {
                $ref = new \stdClass;
                $ref->name    = $rec['name'];
                $ref->version = $rec['ext.min'];
                $ref->state   = $rec['state'];
                $ref->date    = $rec['date'];

                if (extension_loaded($ref->name)) {
                    $version = phpversion($ref->name);
                    $pattern = '/^[0-9]+\.[0-9]+/';
                    if (!preg_match($pattern, $version)) {
                        /**
                         * When version is not provided by the extension,
                         * or not standard format or we don't have it
                         * in our reference (ex snmp) because have no sense
                         * be sure at least to return latest PHP version supported.
                         */
                        $version = ExtensionFactory::getLatestPhpVersion();
                    }
                } else {
                    $version = '';
                }
                $ref->loaded   = $version;
                $ref->outdated = version_compare($ref->version, $version, 'gt') ;

                $rows[$key] = $ref;
            }
        }

        ksort($rows);
        return array_values($rows);
    }

    /**
     * Show information about a reference.
     *
     * @param string   $name       Introspection of a reference (case insensitive)
     * @param \Closure $closure    Function used to filter results
     * @param mixed    $releases   Show releases
     * @param mixed    $ini        Show ini Entries
     * @param mixed    $constants  Show constants
     * @param mixed    $functions  Show functions
     * @param mixed    $interfaces Show interfaces
     * @param mixed    $classes    Show classes
     * @param mixed    $methods    Show methods
     *
     * @return array
     */
    public function show(
        $name,
        $closure,
        $releases,
        $ini,
        $constants,
        $functions,
        $interfaces,
        $classes,
        $methods
    ) {
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
