<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Attributes\AttributeSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\PropertyPromotionSniff;
use Bartlett\CompatInfo\Application\Sniffs\ControlStructures\MatchSniff;
use Bartlett\CompatInfo\Application\Sniffs\ControlStructures\NonCapturingCatchSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\NamedArgumentDeclarationSniff;
use Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations\TrailingCommaSniff;
use Bartlett\CompatInfo\Application\Sniffs\Operators\NullsafeOperatorSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 8.0 features detection
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(AttributeSniff::class);
    $services->set(PropertyPromotionSniff::class);
    $services->set(MatchSniff::class);
    $services->set(NonCapturingCatchSniff::class);
    $services->set(NamedArgumentDeclarationSniff::class);
    $services->set(TrailingCommaSniff::class);
    $services->set(NullsafeOperatorSniff::class);
};
