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
        \Bartlett\CompatInfo\Application\Analyser\AbstractSniffAnalyser::class,
        \Bartlett\CompatInfo\Application\Analyser\AnalyserInterface::class,
        \Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser::class,
        \Bartlett\CompatInfo\Application\Analyser\SniffAnalyserInterface::class,
        \Bartlett\CompatInfo\Application\Analyser\SniffVisitorInterface::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
};
