<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Collection;

use Bartlett\CompatInfo\Application\Sniffs\SniffInterface;

use IteratorAggregate;

/**
 * @phpstan-template T of SniffInterface
 * @phpstan-extends  IteratorAggregate<T>
 * @author Laurent Laville
 * @since Release 6.0.0
 */
interface SniffCollectionInterface extends IteratorAggregate
{
    public const BASE_HELP_URI = 'https://llaville.github.io/php-compatinfo/7.2';
}
