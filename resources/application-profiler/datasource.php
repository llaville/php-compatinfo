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
        \Bartlett\CompatInfo\Application\Profiler\CollectorInterface::class,
        \Bartlett\CompatInfo\Application\Profiler\CollectorTrait::class,
        \Bartlett\CompatInfo\Application\Profiler\Profile::class,
        \Bartlett\CompatInfo\Application\Profiler\Profiler::class,
        \Bartlett\CompatInfo\Application\Profiler\ProfilerInterface::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
