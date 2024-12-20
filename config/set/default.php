<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Collection\ReferenceCollection;
use Bartlett\CompatInfo\Application\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Application\Collection\SniffCollection;
use Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface;
use Bartlett\CompatInfo\Application\Event\Dispatcher\EventDispatcher;
use Bartlett\CompatInfo\Application\Extension\ExtensionInterface;
use Bartlett\CompatInfo\Application\Extension\ExtensionLoaderInterface;
use Bartlett\CompatInfo\Application\Extension\FactoryExtensionLoader;
use Bartlett\CompatInfo\Application\Profiler\Profiler;
use Bartlett\CompatInfo\Application\Profiler\ProfilerInterface;
use Bartlett\CompatInfo\Application\Query\QueryBusInterface;
use Bartlett\CompatInfo\Application\Query\QueryHandlerInterface;
use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;
use Bartlett\CompatInfo\Infrastructure\Bus\Query\MessengerQueryBus;
use Bartlett\CompatInfoDb\Presentation\Console\Command\Debug\ContainerDebugCommand;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

use Ramsey\Uuid\Uuid;

use Symfony\Bundle\FrameworkBundle\Command\EventDispatcherDebugCommand;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Command\DebugCommand;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

/**
 * Build the Container with default parameters and services
 *
 * @author Laurent Laville
 *
 * @link https://symfony.com/doc/current/components/dependency_injection.html#avoiding-your-code-becoming-dependent-on-the-container
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->instanceof(QueryHandlerInterface::class)
        ->tag('messenger.message_handler', ['bus' => 'query.bus'])
    ;

    $services->instanceof(ExtensionInterface::class)
        ->tag('app.extension')
    ;

    // @link https://symfony.com/doc/current/service_container/tags.html#autoconfiguring-tags
    $services->instanceof(SniffInterface::class)
        ->tag('app.sniff')
    ;

    $services->set(ProfilerInterface::class, Profiler::class)
        ->arg('$token', Uuid::uuid4()->toString())
        // for unit tests
        ->public()
    ;

    $services->set(QueryBusInterface::class, MessengerQueryBus::class)
        // for unit tests
        ->public()
    ;

    $services->set(LoggerInterface::class, NullLogger::class);

    $services->set(EventDispatcherInterface::class, SymfonyEventDispatcher::class);
    $services->alias(EventDispatcherInterface::class . ' $compatibilityEventDispatcher', EventDispatcher::class);
    $services->alias('event_dispatcher', EventDispatcher::class)
        // for debug:event-dispatcher command
        ->public()
    ;

    // @see https://github.com/symfony/dependency-injection/commit/9591cba6e215ce688fcc301cc6eef1e39daa5ad9 since Symfony 5.1
    $services->alias(ContainerInterface::class, 'service_container');
    $services->alias(SymfonyContainerInterface::class, 'service_container');

    // @link https://symfony.com/doc/current/service_container/tags.html
    $services->set(ExtensionLoaderInterface::class, FactoryExtensionLoader::class)
        ->arg('$extensions', tagged_iterator('app.extension'))
    ;

    $services->load('Bartlett\\CompatInfo\\Application\\', __DIR__ . '/../../src/Application')
        ->exclude(__DIR__ . '/../../src/Application/Polyfills')
    ;

    // @link https://symfony.com/doc/current/service_container/tags.html#reference-tagged-services
    $services->set(SniffCollectionInterface::class, SniffCollection::class)
        ->arg('$sniffs', tagged_iterator('app.sniff'))
        // for unit tests
        ->public()
    ;

    $services->set(ReferenceCollectionInterface::class, ReferenceCollection::class);
};
