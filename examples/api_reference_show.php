<?php
/**
 * Example to get informations on a reference.
 *
 * Equivalent to CLI commands
 *   `phpcompatinfo reference:show amqp`
 *   `phpcompatinfo reference:show amqp --releases`
 *   `phpcompatinfo reference:show amqp --classes --filter=YourFilters.php`
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Example available since Release 4.0.0-alpha3+1
 */

require_once dirname(__DIR__) . '/config/bootstrap.php';

use Bartlett\CompatInfo\Client;

// creates an instance of client
$client = new Client();

// request for a Bartlett\CompatInfo\Api\Reference
$api = $client->api('reference');

// summary
$infos = $api->show('amqp');

// OR get releases only
$infos = $api->show('amqp', false, true);

// OR get classes only, filtered by a closure
$closure = function ($data) {
    $filteredArray = [];
    foreach ($data as $title => $collection) {
        foreach ($collection as $key => $valueObject) {
            switch ($title) {
                case 'classes':
                    if (version_compare($valueObject->getExtMin(), '1.0.0', 'ge')) {
                        $filteredArray[$title][$key] = $valueObject;
                    }
                    break;
            }
        }
    }
    return $filteredArray;
};
$infos = $api->show('amqp', $closure, false, false, false, false, false, true);

var_export($infos);
