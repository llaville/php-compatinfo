<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Attributes\AllowDynamicPropertiesAttributeSniff;
use Bartlett\CompatInfo\Application\Sniffs\Attributes\SensitiveParameterAttributeSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\ReadonlyClassSniff;
use Bartlett\CompatInfo\Application\Sniffs\Constants\ConstantsInTraitsSniff;
use Bartlett\CompatInfo\Application\Sniffs\TextProcessing\DeprecateDollarBraceStringInterpolationSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 8.2 features detection
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(AllowDynamicPropertiesAttributeSniff::class);
    $services->set(SensitiveParameterAttributeSniff::class);
    $services->set(ReadonlyClassSniff::class);
    $services->set(ConstantsInTraitsSniff::class);
    $services->set(DeprecateDollarBraceStringInterpolationSniff::class);
};
