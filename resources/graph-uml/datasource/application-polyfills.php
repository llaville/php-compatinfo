<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @since Release 6.4.0
 * @author Laurent Laville
 */

function dataSource(): Generator
{
    $classes = [
        \Bartlett\CompatInfo\Application\Polyfills\PolyfillInterface::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyCtype::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyIconv::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyMbstring::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp70::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp71::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp72::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp73::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp74::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp80::class,
        \Bartlett\CompatInfo\Application\Polyfills\SymfonyPhp81::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
}
