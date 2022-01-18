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

function dataSource(): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\DataCollector\ErrorHandler\Collecting::class,
        \Bartlett\CompatInfo\Application\DataCollector\ErrorHandler\Throwing::class,
        \Bartlett\CompatInfo\Application\DataCollector\Normalizer\NodeNormalizer::class,
        \Bartlett\CompatInfo\Application\DataCollector\DataCollector::class,
        \Bartlett\CompatInfo\Application\DataCollector\DataCollectorInterface::class,
        \Bartlett\CompatInfo\Application\DataCollector\ErrorHandler::class,
        \Bartlett\CompatInfo\Application\DataCollector\RuleUpdater::class,
        \Bartlett\CompatInfo\Application\DataCollector\VersionDataCollector::class,
        \Bartlett\CompatInfo\Application\DataCollector\VersionUpdater::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
}
