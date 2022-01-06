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
        \Bartlett\CompatInfo\Application\Collection\ReferenceCollection::class,
        \Bartlett\CompatInfo\Application\Collection\ReferenceCollectionInterface::class,
        \Bartlett\CompatInfo\Application\Collection\SniffCollection::class,
        \Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface::class,
    ];
    foreach ($classes as $class) {
        yield $class;
    }
}
