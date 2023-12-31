<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Attributes\OverrideAttributeSniff;
use Bartlett\CompatInfo\Application\Sniffs\Constants\DynamicClassConstantFetchSniff;
use Bartlett\CompatInfo\Application\Sniffs\Constants\TypedClassConstantSniff;
use Bartlett\CompatInfo\Application\Sniffs\Expressions\StaticVarInitializerSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 8.3 features detection
 *
 * @author Laurent Laville
 * @since Release 7.1.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(OverrideAttributeSniff::class);
    $services->set(DynamicClassConstantFetchSniff::class);
    $services->set(TypedClassConstantSniff::class);
    $services->set(StaticVarInitializerSniff::class);
};
