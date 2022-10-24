<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Classes\AnonymousClassSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\ClassMemberAccessSniff;
use Bartlett\CompatInfo\Application\Sniffs\ControlStructures\DeclareSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ParamTypeDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ReturnTypeDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\Generators\GeneratorSniff;
use Bartlett\CompatInfo\Application\Sniffs\Keywords\ReservedSniff;
use Bartlett\CompatInfo\Application\Sniffs\Operators\CombinedComparisonOperatorSniff;
use Bartlett\CompatInfo\Application\Sniffs\Operators\NullCoalesceOperatorSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 7.0 features detection
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(AnonymousClassSniff::class);
    $services->set(ClassMemberAccessSniff::class);
    $services->set(DeclareSniff::class);
    $services->set(ParamTypeDeclarationSniff::class);
    $services->set(ReturnTypeDeclarationSniff::class);
    $services->set(GeneratorSniff::class);
    $services->set(ReservedSniff::class);
    $services->set(CombinedComparisonOperatorSniff::class);
    $services->set(NullCoalesceOperatorSniff::class);
};
