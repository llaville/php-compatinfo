<?php
/**
 * Base class to filter output results on version (PHP/Extension) conditions
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Abstract class of filter output system
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.9.0
 */
abstract class PHP_CompatInfo_Filter
{
    /**
     * PHP/Ext version to compare to each element
     * @var string
     */
    protected static $filterVersion = 'php_4.0.0';

    /**
     * The version test relationship ('lt', 'le', 'gt', 'ge', 'eq', 'ne')
     * @var string
     */
    protected static $filterOperator = 'ge';

    /**
     * Apply the filter criteria on each element of $results array
     *
     * @param array  &$results Full results of parsed data source
     * @param string $category (optional) Group of information:
     *                         functions, constants, classes, interfaces ...
     *
     * @return void
     */
    protected static function applyFilter(&$results, $category = null)
    {
        $version = self::$filterVersion;

        if (substr($version, 0, 4) == 'php_') {
            // filter results on PHP version
            $version   = substr($version, 4);
            $extension = false;
        } else {
            // filter results on extension version
            $extension = true;
        }

        foreach ($results as $categ => $items) {
            if (isset($category) && $category !== $categ) {
                continue;
            }
            foreach ($items as $name => $values) {
                if (isset($values['versions'])) {
                    $compare = $extension
                        ? $values['versions'][2] : $values['versions'][0];
                } else {
                    $compare = $extension ? $values[2] : $values[0];
                }
                if (!version_compare($compare, $version, self::$filterOperator)) {
                    unset($results[$categ][$name]);
                }
            }
        }
    }

}
