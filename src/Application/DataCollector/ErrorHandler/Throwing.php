<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;

use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;

use PhpParser\Error;

/**
 * Easy for debugging to know where event/error occurs.
 *
 * @author Laurent Laville
 * @since 5.4.0, 6.0.0
 */
final class Throwing implements ErrorHandler
{
    /**
     * @inheritDoc
     */
    public function handleError(Error $error): void
    {
        throw $error;
    }

    /**
     * @inheritDoc
     */
    public function hasErrors(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getErrors(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function clearErrors(): void
    {
    }
}
