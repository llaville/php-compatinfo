<?php declare(strict_types=1);

/**
 * Keep BC between Symfony 4.4 and Symfony 5.x
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @link       http://bartlett.laurent-laville.org/php-compatinfo/
 */

namespace Bartlett\CompatInfo\Infrastructure\Framework\Symfony;

use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;

/**
 * @since 6.0.0
 */
final class Polyfill
{
    /**
     * Creates a reference to a service.
     *
     * @param string $serviceId
     * @return ReferenceConfigurator
     */
    public static function service(string $serviceId): ReferenceConfigurator
    {
        return new ReferenceConfigurator($serviceId);
    }
}

function service(string $serviceId): ReferenceConfigurator
{
    return Polyfill::service($serviceId);
}
