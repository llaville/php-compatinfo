<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.1.0
 * @author Laurent Laville
 */

return function (): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\Extension\Reporter\ConsoleReporter::class,
        \Bartlett\CompatInfo\Application\Extension\Reporter\DumpReporter::class,
        \Bartlett\CompatInfo\Application\Extension\Reporter\FormatterInterface::class,
        \Bartlett\CompatInfo\Application\Extension\Reporter\JsonReporter::class,
        \Bartlett\CompatInfo\Application\Extension\Reporter\SarifReporter::class,
        \Bartlett\CompatInfo\Application\Extension\ExtensionInterface::class,
        \Bartlett\CompatInfo\Application\Extension\ExtensionLoaderInterface::class,
        \Bartlett\CompatInfo\Application\Extension\FactoryExtensionLoader::class,
        \Bartlett\CompatInfo\Application\Extension\Logger::class,
        \Bartlett\CompatInfo\Application\Extension\ProgressBar::class,
        \Bartlett\CompatInfo\Application\Extension\Reporter::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
