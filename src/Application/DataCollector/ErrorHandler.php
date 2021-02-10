<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Error;

/**
 * @since 5.4.0, 6.0.0
 */
interface ErrorHandler extends \PhpParser\ErrorHandler
{
    /**
     * Get collected errors.
     *
     * @return Error[]
     */
    public function getErrors(): array;

    /**
     * Check whether there are any errors.
     *
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * Reset/clear collected errors.
     *
     * @return void
     */
    public function clearErrors(): void;
}
