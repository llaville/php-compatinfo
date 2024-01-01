<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with PHP features detection up to version 8.3
 *
 * @author Laurent Laville
 * @since Release 7.1.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/up-to-php82.php');
    $containerConfigurator->import(__DIR__ . '/php83.php');
};
