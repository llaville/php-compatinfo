<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Collection\PolyfillCollection;
use Bartlett\CompatInfo\Application\Collection\PolyfillCollectionInterface;
use Bartlett\CompatInfo\Application\Polyfills\PolyfillInterface;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyCtype;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyIconv;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyMbstring;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp70;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp71;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp72;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp73;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp74;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp80;
use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp81;

use Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp82;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

/**
 * Build the Container with standard polyfills
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->instanceof(PolyfillInterface::class)
        ->tag('app.polyfill')
    ;

    $services->set(SymfonyCtype::class);
    $services->set(SymfonyIconv::class);
    $services->set(SymfonyMbstring::class);
    $services->set(SymfonyPhp70::class);
    $services->set(SymfonyPhp71::class);
    $services->set(SymfonyPhp72::class);
    $services->set(SymfonyPhp73::class);
    $services->set(SymfonyPhp74::class);
    $services->set(SymfonyPhp80::class);
    $services->set(SymfonyPhp81::class);
    $services->set(SymfonyPhp82::class);

    $services->load('Bartlett\\CompatInfo\\Application\\Polyfills\\', __DIR__ . '/../../src/Application/Polyfills');

    $services->set(PolyfillCollectionInterface::class, PolyfillCollection::class)
        ->arg('$polyfills', tagged_iterator('app.polyfill'))
    ;
};
