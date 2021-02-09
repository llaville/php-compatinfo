<?php declare(strict_types=1);

/**
 * Easy for debugging to know where event/error occurs.
 */

namespace Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;

use Bartlett\CompatInfo\Application\DataCollector\ErrorHandler;

use PhpParser\Error;

/**
 * @since 5.4.0, 6.0.0
 */
final class Throwing implements ErrorHandler
{
    /**
     * {@inheritDoc}
     */
    public function handleError(Error $error)
    {
        throw $error;
    }

    /**
     * Check whether there are any errors.
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return false;
    }

    /**
     * Get collected errors.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return [];
    }
}
