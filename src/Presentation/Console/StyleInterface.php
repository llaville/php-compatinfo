<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface as SymfonyStyleInterface;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
interface StyleInterface extends SymfonyStyleInterface, OutputInterface
{
    public function columns(mixed $lines, string $format): void;

    public function createProgressBar(int $max = 0): ProgressBar;

    /**
     * @param array<string> $headers
     * @param array<string>|array<TableSeparator> $rows
     * @param string $style default to 'compact' rather than 'symfony-style-guide'
     */
    public function table(array $headers, array $rows, string $style = 'compact'): void;
}
