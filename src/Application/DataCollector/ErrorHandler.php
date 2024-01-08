<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\DataCollector;

use PhpParser\Error;

/**
 * @author Laurent Laville
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
     */
    public function hasErrors(): bool;

    /**
     * Reset/clear collected errors.
     */
    public function clearErrors(): void;
}
