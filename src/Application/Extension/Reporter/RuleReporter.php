<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Extension\Reporter;

use Bartlett\CompatInfo\Application\Analyser\CompatibilityAnalyser;
use Bartlett\CompatInfo\Application\Collection\SniffCollectionInterface;
use Bartlett\CompatInfo\Application\Extension\Reporter;
use Bartlett\CompatInfo\Presentation\Console\Style;

use function array_keys;
use function count;
use function current;
use function is_array;
use function key;
use function ksort;
use function sprintf;
use function sscanf;
use function str_replace;

/**
 * @author Laurent Laville
 * @since Release 6.3.0
 */
final class RuleReporter extends Reporter implements FormatterInterface
{
    protected const NAME = 'rule';

    public function format(mixed $data): void
    {
        /** @var string[] $format */
        $format = $this->input->getOption('output');
        if (!$this->supportsFormatting($data, $format)) {
            return;
        }

        $output = new Style($this->input, $this->output);
        $response = current($data->getData());

        if (empty($response)) {
            // No reports printed if there are no metrics.
            $output->warning('No metrics.');
            return;
        }

        $metrics = $response[CompatibilityAnalyser::class];
        $rules = [];
        $groups = [
            'namespaces',
            'interfaces', 'traits', 'classes', 'enumerations',
            'generators',
            'functions', 'methods',
            'constants',
            'conditions',
        ];
        foreach ($groups as $section) {
            if (empty($metrics[$section])) {
                continue;
            }
            foreach ($metrics[$section] as $arg => $values) {
                if (!empty($values['rules'])) {
                    foreach ($values['rules'] as $ruleId => $ruleDetails) {
                        if (!isset($rules[$ruleId])) {
                            $helpUri = str_replace(
                                '%baseHelpUri%',
                                SniffCollectionInterface::BASE_HELP_URI,
                                $ruleDetails['helpUri']
                            );
                            $rules[$ruleId] = [
                                'description' => $ruleDetails['fullDescription'],
                                'sniff' => $ruleDetails['name'],
                                'help' => $helpUri,
                            ];
                        }
                        if (!isset($rules[$ruleId][$section])) {
                            $rules[$ruleId][$section] = [];
                        }
                        $rules[$ruleId][$section][] = $arg;
                    }
                }
            }
        }
        ksort($rules);

        $messages = [];

        foreach ($rules as $ruleId => $ruleLines) {
            $messages[] = sprintf('<info>%12s</info> : <comment>%s</comment>', 'code', $ruleId);
            foreach ($ruleLines as $title => $value) {
                if (!is_array($value)) {
                    $messages[] = sprintf('<info>%12s</info> : %s', $title, $value);
                } else {
                    $messages[] = sprintf('<info>%12s</info> : (%d)', $title, count($value));
                    if ($this->output->isVerbose()) {
                        foreach ($value as $line) {
                            $messages[] = $line;
                        }
                    }
                }
            }
            $messages[] = '';
        }

        $output->title('Compatibility Analyser (by rule)');

        $codeByPhpVersion = [];
        $ruleIds = array_keys($rules);
        foreach ($ruleIds as $code) {
            list($phpVersionString, ) = sscanf($code, 'CA%2d%2d');
            if (!isset($codeByPhpVersion[$phpVersionString])) {
                $codeByPhpVersion[$phpVersionString] = 0;
            }
            $codeByPhpVersion[$phpVersionString]++;
        }

        $output->section('Stats');
        foreach ($codeByPhpVersion as $version => $stat) {
            $output->text(sprintf('PHP <info>%s</info> : <comment>%3d</comment> rule(s) found', $version, $stat));
        }

        $output->section('Rules');
        $output->text($messages);

        $output->comment('Produced by ' . $this->getName());
    }
}
