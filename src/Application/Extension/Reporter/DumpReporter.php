<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Extension\Reporter;

use Bartlett\CompatInfo\Application\Extension\Reporter;
use Bartlett\CompatInfo\Presentation\Console\Style;

use function var_dump;

/**
 * @author Laurent Laville
 * @since Release 6.1.0
 */
final class DumpReporter extends Reporter implements FormatterInterface
{
    protected const NAME = 'dump';

    /**
     * {@inheritDoc}
     */
    public function format($data): void
    {
        /** @var string[] $format */
        $format = $this->input->getOption('output');
        if (!$this->supportsFormatting($data, $format)) {
            return;
        }

        var_dump($data);

        $output = new Style($this->input, $this->output);
        $output->comment('Produced by ' . $this->getName());
    }
}
