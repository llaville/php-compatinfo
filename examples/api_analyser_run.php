<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

require_once dirname(__DIR__) . '/config/bootstrap.php';

/**
 * Examples of Compatibility Analyser's run.
 *
 * @author Laurent Laville
 * @since  Release 4.0.0-alpha3
 */

use Bartlett\CompatInfo\Application\Kernel\ConsoleKernel;
use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Messenger\Exception\HandlerFailedException;


$kernel = new ConsoleKernel('prod', false);
$container = $kernel->createFromInput(new ArgvInput());

$queryBus = $container->get(QueryBusInterface::class);

// perform request, on a data source with default analyser
$dataSource = dirname(__DIR__) . '/src';

// equivalent to CLI command `phpcompatinfo analyser:run ../src`
$compatibilityQuery = new GetCompatibilityQuery($dataSource, [], false, '');
try {
    /** @var Profile $profile */
    $profile = $queryBus->query($compatibilityQuery);
    $data = $profile->getData();
    $dump = reset($data);
    var_export($dump);
} catch (HandlerFailedException $e) {
    foreach ($e->getWrappedExceptions() as $ex) {
        printf('Exception -- %s%s%s%s', $ex->getMessage(), PHP_EOL, $ex->getTraceAsString(), PHP_EOL);
    };
}
