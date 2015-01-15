<?php
/**
 * Examples of Compatibility Analyser's run.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Example available since Release 4.0.0-alpha3
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

if (!defined('JSON_PRETTY_PRINT')) {
    define('JSON_PRETTY_PRINT', 128);
}

use Bartlett\Reflect\Client;

// creates an instance of client
$client = new Client();

// request for a Bartlett\Reflect\Api\Analyser
$api = $client->api('analyser');

// perform request, on a data source with default analyser
$dataSource = dirname(__DIR__) . '/src';
$analysers  = array('compatibility');

// equivalent to CLI command `phpcompatinfo analyser:run ../src`
$metrics = $api->run($dataSource, $analysers);

// ... and also
// equivalent to CLI command `phpcompatinfo analyser:run --format=json ../src`

$metrics = json_encode(
    $metrics['Bartlett\\CompatInfo\\Analyser\\CompatibilityAnalyser'],
    JSON_PRETTY_PRINT
);

var_export($metrics);
