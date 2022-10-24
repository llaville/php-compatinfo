<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Arrays\ArrayUnpackingSyntaxSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\NewInitializerSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\ReadonlyPropertySniff;
use Bartlett\CompatInfo\Application\Sniffs\Constants\ClassConstantSniff;
use Bartlett\CompatInfo\Application\Sniffs\Enumerations\EnumerationSniff;
use Bartlett\CompatInfo\Application\Sniffs\Fibers\FiberSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\FirstClassCallableSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ReturnTypeDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\Numbers\OctalNumberFormatSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 8.1 features detection
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
    $services->set(NewInitializerSniff::class);
    $services->set(ReadonlyPropertySniff::class);
    $services->set(ClassConstantSniff::class);
    $services->set(EnumerationSniff::class);
    $services->set(FiberSniff::class);
    $services->set(FirstClassCallableSniff::class);
    $services->set(ReturnTypeDeclarationSniff::class);
    $services->set(OctalNumberFormatSniff::class);
};
