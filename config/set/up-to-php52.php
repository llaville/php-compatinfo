<?php declare(strict_types=1);
/**
 * Build the Container with PHP features detection up to version 5.2
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */

use Bartlett\CompatInfo\Application\Sniffs\Classes\MagicMethodsSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\MethodDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\PropertyDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\ControlStructures\DeclareSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\ParamTypeDeclarationSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    // PHP 4.0
    $services->set(MethodDeclarationSniff::class);
    $services->set(PropertyDeclarationSniff::class);
    $services->set(DeclareSniff::class);

    // PHP 5.1
    $services->set(MagicMethodsSniff::class);
    $services->set(ParamTypeDeclarationSniff::class);

    // PHP 5.2 only
    $containerConfigurator->import(__DIR__ . '/php52.php');
};
