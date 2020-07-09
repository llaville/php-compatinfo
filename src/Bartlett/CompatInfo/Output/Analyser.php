<?php declare(strict_types=1);

/**
 * Default console output class for Analyser Api.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Output;

use Bartlett\CompatInfo\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Console\Formatter\CompatibilityOutputFormatter;
use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Analyser results default render on console
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 5.4.0
 */
class Analyser extends OutputFormatter
{
    /**
     * Results of analysers metrics
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Analyser metrics
     *
     * @return void
     */
    public function run(OutputInterface $output, array $response): void
    {
        if (empty($response)) {
            // No reports printed if there are no metrics.
            $output->writeln('<info>No metrics.</info>');
            return;
        }

        $output->writeln('<info>Data Source Analysed</info>');

        $directories = [];
        $files = $response['files'];
        $errors = $response['errors'];

        foreach ($files as $file) {
            $directories[] = dirname($file);
        }
        $directories = array_unique($directories);

        // print Data Source summaries
        if (count($files) > 0) {
            $text = sprintf(
                "%s" .
                "Directories                                 %10d%s" .
                "Files                                       %10d%s" .
                "Errors                                      %10d%s",
                PHP_EOL,
                count($directories),
                PHP_EOL,
                count($files),
                PHP_EOL,
                count($errors),
                PHP_EOL
            );
            $output->writeln($text);
        }

        if (count($errors)) {
            $output->writeln('<info>Errors found</info>');

            foreach ($errors as $msg) {
                $text = sprintf(
                    '%s <info>></info> %s',
                    PHP_EOL,
                    $msg
                );
                $output->writeln($text);
            }
        }

        $obj = new CompatibilityOutputFormatter();
        $obj($output, $response[CompatibilityAnalyser::class]);
    }
}
