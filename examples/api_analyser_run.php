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

use Bartlett\CompatInfo\Application\Profiler\Profile;
use Bartlett\CompatInfo\Application\Query\Analyser\Compatibility\GetCompatibilityQuery;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;
use Bartlett\CompatInfo\Infrastructure\Framework\Symfony\DependencyInjection\ContainerFactory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

/** @var ContainerBuilder $container */
$container = (new ContainerFactory())->create();

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
    foreach ($e->getNestedExceptions() as $ex) {
        printf('Exception -- %s >> %s%s' . $ex->getMessage(), $ex->getTraceAsString(), PHP_EOL);
    };
}
