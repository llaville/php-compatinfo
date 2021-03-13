<?php
/**
 * Example to get list of references supported
 * and available in your platform.
 *
 * <code>
 *  array (
 *    0 =>
 *    stdClass::__set_state(array(
 *       'name' => 'amqp',
 *       'version' => '1.4.0',
 *       'state' => 'stable',
 *       'date' => '2014-04-14',
 *       'loaded' => '1.4.0',
 *       'outdated' => false,
 *    )),
 *
 *    // ...
 *
 *    100 =>
 *    stdClass::__set_state(array(
 *       'name' => 'zlib',
 *       'version' => '5.4.0',
 *       'state' => 'stable',
 *       'date' => '2012-03-01',
 *       'loaded' => '2.0',
 *       'outdated' => true,
 *    )),
 *  )
 * </code>
 *
 * Equivalent to CLI command `phpcompatinfo reference:list`
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Example available since Release 4.0.0-alpha3
 */

require_once dirname(__DIR__) . '/config/bootstrap.php';

use Bartlett\CompatInfo\Client;

// creates an instance of client
$client = new Client();

// request for a Bartlett\CompatInfo\Api\Reference
$api = $client->api('reference');

$refs = $api->dir();

var_export($refs);
