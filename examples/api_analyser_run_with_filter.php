<?php
/**
 * Examples of Compatibility Analyser's run with filter applied on final results.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Example available since Release 4.2.0
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Bartlett\Reflect\Client;

// creates an instance of client
$client = new Client();

// request for a Bartlett\Reflect\Api\Analyser
$api = $client->api('analyser');

// perform request, on a data source with default analyser
$dataSource = dirname(__DIR__) . '/src';
$analysers  = array('compatibility');

// filter rules on final results
$closure = function ($data) {
    foreach ($data as $title => &$groups) {
        if (strpos($title, 'CompatibilityAnalyser') === false) {
            continue;
        }
        // looking into Compatibility Analyser metrics only
        foreach ($groups as $group => &$values) {

            if (!in_array($group, array('interfaces', 'traits', 'classes', 'functions', 'constants'))) {
                continue;
            }
            // keep only interfaces, traits, classes, functions, constants that are greater or equal PHP 5.0.0
            foreach ($values as $name => $metrics) {
                if (version_compare($metrics['php.min'], '5.0.0', 'lt')) {
                    unset($values[$name]);
                }
            }
        }
    }
    return $data;
};

// equivalent to CLI command `phpcompatinfo analyser:run --filter=YourFilters.php ../src`
//$metrics = $api->run($dataSource, $analysers, null, false, $closure = 'YourFilters.php');

// OR with embeded $closure code
$metrics = $api->run($dataSource, $analysers, null, false, $closure);

var_export($metrics);
