<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Bartlett\CompatInfo\Application\Logger\DefaultLogger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * Build the Container with default logger
 *
 * @author Laurent Laville
 * @since Release 6.5.0
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set('compatinfo.log_stream_path', sprintf('%%kernel.logs_dir%%/compatinfo-%s.log', date('YmdHi')));
    $parameters->set('compatinfo.log_channel', 'App');
    if ((bool) getenv('APP_DEBUG')) {
        $parameters->set('compatinfo.log_level', LogLevel::DEBUG);
    } else {
        $parameters->set('compatinfo.log_level', LogLevel::INFO);
    }

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
    ;

    $services->set(LoggerInterface::class, DefaultLogger::class)
        ->args(['%compatinfo.log_stream_path%', '%compatinfo.log_channel%', '%compatinfo.log_level%'])
    ;
};
