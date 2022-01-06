<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Reporter;

use Bartlett\CompatInfo\Application\Extension\Reporter;
use Bartlett\CompatInfo\Presentation\Console\Style;

use function file_put_contents;
use function json_encode;
use function key;

/**
 * @author Laurent Laville
 * @since Release 6.1.0
 */
final class JsonReporter extends Reporter implements FormatterInterface
{
    protected const NAME = 'json';

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

        $data = $data->getData();
        $token = key($data);
        $target = '/tmp/' . $token . '-compatinfo.json';
        @file_put_contents($target, json_encode($data[$token]));

        $output = new Style($this->input, $this->output);
        $output->note('Profile results are being formatted as JSON to file ' . $target);
        $output->comment('Produced by ' . $this->getName());
    }
}
