<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Console\Output;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * @since Class available since Release 5.4.0
 */
final class Output extends ConsoleOutput
{
    /**
     * {@inheritDoc}
     */
    public function __construct(int $verbosity = self::VERBOSITY_NORMAL, bool $decorated = null, OutputFormatterInterface $formatter = null)
    {
        parent::__construct($verbosity, $decorated, $formatter);

        $formatter = $this->getFormatter();
        $formatter->setStyle('warning', new OutputFormatterStyle('black', 'yellow'));
        $formatter->setStyle('debug', new OutputFormatterStyle('black', 'cyan'));
        $formatter->setStyle('php', new OutputFormatterStyle('white', 'magenta'));
        $formatter->setStyle('ext', new OutputFormatterStyle('white', 'blue'));
    }
}
