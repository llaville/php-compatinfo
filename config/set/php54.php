<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Arrays\ArrayDereferencingSyntaxSniff;
use Bartlett\CompatInfo\Application\Sniffs\Arrays\ShortArraySyntaxSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\ClassMemberAccessSniff;
use Bartlett\CompatInfo\Application\Sniffs\Expressions\ClassExprSyntaxSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ClosureSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ParamTypeDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\Numbers\BinaryNumberFormatSniff;
use Bartlett\CompatInfo\Application\Sniffs\UseDeclarations\UseTraitSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 5.4 features detection
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(ArrayDereferencingSyntaxSniff::class);
    $services->set(ShortArraySyntaxSniff::class);
    $services->set(ClassMemberAccessSniff::class);
    $services->set(ClassExprSyntaxSniff::class);
    $services->set(ClosureSniff::class);
    $services->set(ParamTypeDeclarationSniff::class);
    $services->set(BinaryNumberFormatSniff::class);
    $services->set(UseTraitSniff::class);
};
