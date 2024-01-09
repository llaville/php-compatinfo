<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Presentation\Console;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Laurent Laville
 * @since Release 6.0.0
 */
final class Style extends SymfonyStyle implements StyleInterface
{
    public function createProgressBar(int $max = 0): ProgressBar
    {
        $progressBar = parent::createProgressBar($max);

        $formats = [
            'very_verbose' => ' %current%/%max% %percent:3s%% %elapsed:6s% %message%',
            'very_verbose_nomax' => ' %current% %elapsed:6s% %message%',

            'debug' => ' %current%/%max% %percent:3s%% %elapsed:6s% %memory:6s% %message%',
            'debug_nomax' => ' %current% %elapsed:6s% %memory:6s% %message%',
        ];
        foreach ($formats as $name => $format) {
            $progressBar::setFormatDefinition($name, $format);
        }

        $progressBar->setMessage('');
        return $progressBar;
    }

    /**
     * @inheritDoc
     */
    public function table(array $headers, array $rows, string $style = 'compact'): void
    {
        $style = clone Table::getStyleDefinition($style);
        $style->setCellHeaderFormat('<info>%s</info>');

        $table = new Table($this);
        $table->setHeaders($headers);
        $table->setRows($rows);
        $table->setStyle($style);

        $table->render();
        $this->newLine();
    }

    public function columns(mixed $lines, string $format): void
    {
        if (!is_array($lines)) {
            $lines = [$lines];
        }

        foreach ($lines as $args) {
            parent::text(vsprintf($format, [$args]));
        }
    }
}
