<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\DataCollector\ErrorHandler;

use Bartlett\CompatInfo\DataCollector\ErrorHandler;

use PhpParser\Error;

/**
 * Easy for debugging to know where event/error occurs.
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
