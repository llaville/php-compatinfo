<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Arrays\ArrayUnpackingSyntaxSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\TypedPropertySniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ArrowFunctionSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 7.4 features detection
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(ArrayUnpackingSyntaxSniff::class);
    $services->set(TypedPropertySniff::class);
    $services->set(ArrowFunctionSniff::class);
};
