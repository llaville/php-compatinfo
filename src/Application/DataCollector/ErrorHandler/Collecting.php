<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;

use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;

use Doctrine\Common\Collections\ArrayCollection;

use PhpParser\Error;

/**
 * Error handler that collects all events/errors into an array.
 *
 * @phpstan-extends ArrayCollection<int, Error>
 * @author Laurent Laville
 * @since 5.4.0, 6.0.0
 */
final class Collecting extends ArrayCollection implements ErrorHandler
{
    /**
     * @inheritDoc
     */
    public function handleError(Error $error): void
    {
        $this->add($error);
    }

    /**
     * @inheritDoc
     */
    public function getErrors(): array
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function hasErrors(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function clearErrors(): void
    {
        $this->clear();
    }
}
