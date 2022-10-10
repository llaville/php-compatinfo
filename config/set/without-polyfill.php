<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Collection\PolyfillCollection;
use Bartlett\CompatInfo\Application\Collection\PolyfillCollectionInterface;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with standard polyfills
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(PolyfillCollectionInterface::class, PolyfillCollection::class)
        ->arg('$polyfills', [])
    ;
};
