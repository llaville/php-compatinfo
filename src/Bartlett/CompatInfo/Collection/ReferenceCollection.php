<?php declare(strict_types=1);
/**
 * Reference Collection
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Collection;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;

use PDO;

/**
 * Reference collection that collect informations for the compatibility analyser.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha3
 */
class ReferenceCollection extends AbstractLazyCollection
{
    // database abstraction layer
    private $dbal;

    private $stmtIniEntries;
    private $stmtTraits;
    private $stmtClasses;
    private $stmtInterfaces;
    private $stmtFunctions;
    private $stmtConstants;
    private $stmtMethods;
    private $elements;

    /**
     * Creates a new Reference Collection
     *
     * @param array $elements Inital elements
     * @param PDO   $pdo      PDO instance representing a connection to a database
     */
    public function __construct(array $elements = array(), PDO $pdo = null)
    {
        $this->elements  = $elements;
        $this->dbal      = $pdo;
        $this->dbal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Fetch the database to retrieve, when possible, element informations.
     *
     * @param string $group  May be either 'classes', 'methods', 'functions',
     *                       'constants', 'traits', 'interfaces'
     * @param string $key    Name of elment to search for
     * @param int    $argc   Number of arguments used in current element signature
     * @param string &$extra Name of class when searching for methods
     *
     * @return array
     */
    public function find($group, $key, $argc = 0, &$extra = null)
    {
        $this->initialize();

        if ($this->containsKey($key)) {
            $result = $this->get($key);
        } else {
            $stmt = 'stmt' . ucfirst($group);
            $inputParameters = array(':name' => $key);
            if ('methods' == $group && isset($extra)) {
                $inputParameters[':class_name'] = $extra;
            }
            $this->$stmt->execute($inputParameters);
            $result = $this->$stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($result['prototype'])) {
                $prototype = $result['prototype'];
                $inputParameters[':class_name'] = $prototype;
                $this->$stmt->execute($inputParameters);
                $versions = $this->$stmt->fetch(PDO::FETCH_ASSOC);
                $result['php.max'] = $versions['php.max'];
            }

            if (!$result) {
                // when not found in database, should be a user or an unknown extension element
                if (strpos($key, '\\') === false) {
                    // not qualified
                    $min = '4.0.0';
                } else {
                    $min = '5.3.0';
                }
                $result = array(
                    'ext.name'     => 'user',
                    'ext.min'      => '',
                    'ext.max'      => '',
                    'php.min'      => $min,
                    'php.max'      => '',
                );
            }
            // cache to speed-up later uses
            $this->set($key, $result);
        }

        // compute the right version depending on number of arguments used
        if (isset($result['parameters']) && !empty($result['parameters'])) {
            $parameters = explode(',', $result['parameters']);
            $parameters = array_map('trim', $parameters);
            $result['parameters'] = $parameters;
            $parameters = array_slice($parameters, 0, $argc);

            if (!empty($parameters)) {
                $result['php.min'] = array_pop($parameters);

                if (in_array($result['ext.name'], array('Core', 'standard'))) {
                    $result['ext.min'] = $result['php.min'];
                }
            }
        }
        $result['arg.max'] = $argc;
        return $result;
    }

    /**
     * Initializes collection and DB statements
     *
     * @return void
     */
    protected function doInitialize()
    {
        $this->collection = new ArrayCollection();

        $this->stmtIniEntries = $this->dbal->prepare(
            'SELECT i.name,' .
            ' ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' deprecated' .
            ' FROM bartlett_compatinfo_inientries i,  bartlett_compatinfo_extensions e' .
            ' WHERE i.ext_name_fk = e.id AND i.name = :name COLLATE NOCASE'
        );

        $this->stmtTraits = $this->dbal->prepare(
            'SELECT e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max"' .
            ' FROM bartlett_compatinfo_classes c,  bartlett_compatinfo_extensions e' .
            ' WHERE c.ext_name_fk = e.id AND c.name = :name COLLATE NOCASE'
        );

        $this->stmtClasses = $this->dbal->prepare(
            'SELECT e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max"' .
            ' FROM bartlett_compatinfo_classes c,  bartlett_compatinfo_extensions e' .
            ' WHERE c.ext_name_fk = e.id AND c.name = :name COLLATE NOCASE'
        );

        $this->stmtInterfaces = $this->dbal->prepare(
            'SELECT e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max"' .
            ' FROM bartlett_compatinfo_interfaces i,  bartlett_compatinfo_extensions e' .
            ' WHERE i.ext_name_fk = e.id AND i.name = :name COLLATE NOCASE'
        );

        $this->stmtFunctions = $this->dbal->prepare(
            'SELECT e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' parameters, php_excludes as "php.excludes",' .
            ' deprecated' .
            ' FROM bartlett_compatinfo_functions f,  bartlett_compatinfo_extensions e' .
            ' WHERE f.ext_name_fk = e.id AND f.name = :name COLLATE NOCASE'
        );

        $this->stmtConstants = $this->dbal->prepare(
            'SELECT e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' php_excludes as "php.excludes"' .
            ' FROM bartlett_compatinfo_constants c,  bartlett_compatinfo_extensions e' .
            ' WHERE c.ext_name_fk = e.id AND c.name = :name COLLATE NOCASE'
        );

        $this->stmtMethods = $this->dbal->prepare(
            'SELECT e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' prototype, proto_since' .
            ' FROM bartlett_compatinfo_methods m,  bartlett_compatinfo_extensions e' .
            ' WHERE m.ext_name_fk = e.id' .
            ' AND m.class_name = :class_name AND m.name = :name COLLATE NOCASE'
        );
    }
}
