<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Collection;

use IteratorAggregate;

/**
 * @phpstan-template T of \Bartlett\CompatInfo\Application\Sniffs\SniffInterface
 * @phpstan-extends  IteratorAggregate<T>
 * @since Release 6.0.0
 */
interface SniffCollectionInterface extends IteratorAggregate
{
}
