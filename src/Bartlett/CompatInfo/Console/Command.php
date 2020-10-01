<?php declare(strict_types=1);

/**
 * Base class for all console commands
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Console;

use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Base class for all commands.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
 */
class Command extends BaseCommand
{
    protected $enabled = true;

    /**
     * Disables the command in the current environment
     *
     * @return Command The current instance
     */
    public function disable(): self
    {
        $this->enabled = false;
        return $this;
    }

    /**
     * Checks whether the command is enabled or not in the current environment
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
