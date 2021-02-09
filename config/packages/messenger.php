<?php declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

/**
 * Build the Container with Symfony Messenger services
 *
 * @link https://symfony.com/components/Messenger
 *
 * @param ContainerConfigurator $containerConfigurator
 * @return void
 * @since Release 6.0.0
 */
return static function (ContainerConfigurator $containerConfigurator): void
{
    $parameters = $containerConfigurator->parameters();

    $parameters->set('query.bus.middleware', [['id' => 'handle_message']]);

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autoconfigure()
        ->autowire()
    ;

    $services->set('messenger.middleware.handle_message', HandleMessageMiddleware::class)
        ->abstract()
        ->args([[]])
    ;

    $services->set('query.bus', MessageBus::class)
        ->args([[]])
        ->tag('messenger.bus')
    ;
    $services->alias(MessageBusInterface::class . ' $queryBus', 'query.bus');
};
