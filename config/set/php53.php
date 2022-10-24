<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Sniffs\Classes\DynamicAccessSniff;
use Bartlett\CompatInfo\Application\Sniffs\Classes\MagicMethodsSniff;
use Bartlett\CompatInfo\Application\Sniffs\Constants\ConstSyntaxSniff;
use Bartlett\CompatInfo\Application\Sniffs\ControlStructures\DeclareSniff;
use Bartlett\CompatInfo\Application\Sniffs\ControlStructures\GotoSniff;
use Bartlett\CompatInfo\Application\Sniffs\Operators\ShortTernaryOperatorSniff;
use Bartlett\CompatInfo\Application\Sniffs\TextProcessing\CryptStringSniff;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP 5.3 features detection
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(DynamicAccessSniff::class);
    $services->set(MagicMethodsSniff::class);
    $services->set(ConstSyntaxSniff::class);
    $services->set(DeclareSniff::class);
    $services->set(GotoSniff::class);
    $services->set(ShortTernaryOperatorSniff::class);
    $services->set(CryptStringSniff::class);
};
