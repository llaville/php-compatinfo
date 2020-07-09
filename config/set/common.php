<?php declare(strict_types=1);

use Bartlett\CompatInfo\Collection\SniffCollection;
use Bartlett\CompatInfo\Console\Application;
use Bartlett\CompatInfo\Console\ApplicationInterface;
use Bartlett\CompatInfo\Sniffs\SniffInterface;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

/**
 * Build the Container with common parameters and services
 *
 * @link https://symfony.com/doc/current/components/dependency_injection.html#avoiding-your-code-becoming-dependent-on-the-container
 *
 * @param ContainerConfigurator $containerConfigurator
 * @return void
 */
return static function (ContainerConfigurator $containerConfigurator): void {

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->public()
    ;

    $services->set(ApplicationInterface::class, Application::class)
        // for bin file
        ->public()
    ;

    // @link https://symfony.com/doc/current/service_container/tags.html#autoconfiguring-tags
    $services->instanceof(SniffInterface::class)
        ->tag('phpcompatinfo.compatibility_sniff')
    ;

    $services->load('Bartlett\CompatInfo\Sniffs\\', __DIR__ . '/../../src/Bartlett/CompatInfo/Sniffs')
    ;

    // @link https://symfony.com/doc/current/service_container/tags.html#reference-tagged-services
    $services->set(SniffCollection::class, SniffCollection::class)
        ->args([tagged_iterator('phpcompatinfo.compatibility_sniff')])
    ;
};
