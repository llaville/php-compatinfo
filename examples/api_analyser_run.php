<?php
/**
 * Examples of Compatibility Analyser's run.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Example available since Release 4.0.0-alpha3
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;

use Symfony\Component\Messenger\Exception\HandlerFailedException;

$container = require dirname(__DIR__) . '/config/container.php';

$queryBus = $container->get(QueryBusInterface::class);

// perform request, on a data source with default analyser
$dataSource = dirname(__DIR__) . '/src';

// equivalent to CLI command `phpcompatinfo analyser:run ../src`
$compatibilityQuery = new GetCompatibilityQuery($dataSource, false);
try {
    /** @var Profile $profile */
    $profile = $queryBus->query($compatibilityQuery);
    $data = $profile->getData();
    $dump = reset($data);
    var_export($dump);
} catch (HandlerFailedException $e) {
    foreach ($e->getNestedExceptions() as $ex) {
        printf('Exception -- %s >> %s%s' . $ex->getMessage(), $ex->getTraceAsString(), PHP_EOL);
    };
}
