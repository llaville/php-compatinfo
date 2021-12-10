<?php declare(strict_types=1);

use Bartlett\CompatInfo\Collection\ReferenceCollection;
use Bartlett\CompatInfo\Collection\ReferenceCollectionInterface;
use Bartlett\CompatInfo\Console\Input\Input;
use Bartlett\CompatInfo\Console\Output\Output;
use Bartlett\CompatInfo\Event\Dispatcher\EventDispatcher;
use Bartlett\CompatInfo\Event\Subscriber\LogEventSubscriber;
use Bartlett\CompatInfo\Event\Subscriber\ProfileEventSubscriber;
use Bartlett\CompatInfo\Logger\DefaultLogger;
use Bartlett\CompatInfoDb\Application\Query\ListRef\ListHandler;
use Bartlett\CompatInfoDb\Application\Query\Show\ShowHandler;
use Bartlett\CompatInfoDb\Domain\Repository\FunctionRepository;
use Bartlett\CompatInfoDb\Infrastructure\Persistence\Doctrine\Repository\FunctionRepository as InfrastructureFunctionRepository;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

/**
 * Build the Container with default parameters and services
 *
 * @link https://symfony.com/doc/current/components/dependency_injection.html#avoiding-your-code-becoming-dependent-on-the-container
 *
 * @param ContainerConfigurator $containerConfigurator
 * @return void
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(dirname(__DIR__, 2) . '/vendor/bartlett/php-compatinfo-db/config/set/default.php');
    $containerConfigurator->import(__DIR__ . '/common.php');

    $parameters = $containerConfigurator->parameters();

    $parameters->set('app.log_stream_path', sprintf('/tmp/compatinfo-%s.log', date('YmdHi')));
    $parameters->set('app.log_channel', 'App');
    $parameters->set('app.log_level', LogLevel::DEBUG);

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->public()
    ;

    $services->set(InputInterface::class, Input::class);
    $services->set(OutputInterface::class, Output::class);

    $services->set(Stopwatch::class, Stopwatch::class);

    $services->set(LoggerInterface::class, DefaultLogger::class)
        ->args(['%app.log_stream_path%', '%app.log_channel%', '%app.log_level%'])
    ;

    $services->set(ProfileEventSubscriber::class, ProfileEventSubscriber::class)
        ->args([ref(Stopwatch::class)])
    ;

    $services->set(LogEventSubscriber::class, LogEventSubscriber::class)
        ->args([ref(LoggerInterface::class)])
    ;

    $services->set(EventDispatcherInterface::class, EventDispatcher::class)
        ->args([
            ref(InputInterface::class),
            ref(ProfileEventSubscriber::class),
            ref(LogEventSubscriber::class)
        ])
    ;

    $services->set(ReferenceCollectionInterface::class, ReferenceCollection::class)
        // for unit tests
        ->public()
    ;

    $services->set(ListHandler::class)
        // to reuse php-compatinfo-db handler(s)
        ->public()
    ;
    $services->set(ShowHandler::class)
        // to reuse php-compatinfo-db handler(s)
        ->public()
    ;

    $services->alias(FunctionRepository::class, InfrastructureFunctionRepository::class)
        // for unit tests (ParameterTest)
        ->public()
    ;
};
