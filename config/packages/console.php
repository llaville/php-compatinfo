<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Presentation\Console\Application;
use Bartlett\CompatInfo\Presentation\Console\ApplicationInterface;
use Bartlett\CompatInfo\Presentation\Console\Command\CommandInterface;
use Bartlett\CompatInfo\Presentation\Console\FactoryCommandLoader;
use Bartlett\CompatInfo\Presentation\Console\Input\Input;
use Bartlett\CompatInfo\Presentation\Console\Output\Output;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

/**
 * Build the Container with Symfony Console services
 *
 * @link https://github.com/symfony/console
 *
 * @since 6.5.0
 * @author Laurent Laville
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    // @link https://symfony.com/doc/current/service_container/tags.html#autoconfiguring-tags
    $services->instanceof(CommandInterface::class)
        ->tag('console.command')
    ;

    // @link https://symfony.com/doc/current/console/lazy_commands.html#factorycommandloader
    $services->set(CommandLoaderInterface::class, FactoryCommandLoader::class)
        ->arg('$commands', tagged_iterator('console.command'))
    ;

    $services->set(InputInterface::class, Input::class);
    $services->set(OutputInterface::class, Output::class);

    $services->set(ApplicationInterface::class, Application::class)
        ->call('setCommandLoader', [service(CommandLoaderInterface::class)])
        ->call('setContainer', [service(ContainerInterface::class)])
        // for kernel file
        ->public()
    ;
    $services->load('Bartlett\\CompatInfo\\Presentation\\Console\\', __DIR__ . '/../../src/Presentation/Console');
};
