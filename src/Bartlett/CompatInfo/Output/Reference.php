<?php declare(strict_types=1);

/**
 * Default console output class for Reference Api.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Output;

use Bartlett\CompatInfoDb\Domain\Factory\LibraryVersionProviderTrait;
use Bartlett\CompatInfoDb\Domain\ValueObject\Constant_;
use Bartlett\CompatInfoDb\Domain\ValueObject\Dependency;
use Bartlett\CompatInfoDb\Domain\ValueObject\Function_;
use Bartlett\CompatInfoDb\Domain\ValueObject\Release;
use Bartlett\CompatInfoDb\Presentation\Console\ApplicationInterface;
use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Composer\Semver\Semver;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableSeparator;

/**
 * Reference results default render on console
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 4.0.0-alpha3
 */
class Reference extends OutputFormatter
{
    use LibraryVersionProviderTrait;

    /**
     * Prints the database current build version
     *
     * @param OutputInterface $output Console Output concrete instance
     *
     * @return void
     */
    protected function printDbBuildVersion(OutputInterface $output): void
    {
        $output->writeln(
            sprintf(
                '<info>Reference Database Version</info> => %s%s',
                ApplicationInterface::VERSION,
                PHP_EOL
            )
        );
    }

    /**
     * Prints the list of references (extensions) supported
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response References list
     *
     * @return void
     */
    public function dir(OutputInterface $output, array $response): void
    {
        $this->printDbBuildVersion($output);

        $loaded  = 0;
        $headers = array('Reference', 'Version', 'State', 'Release Date', 'Loaded');

        foreach ($response as $ref) {
            if (empty($ref->loaded) || $ref->outdated) {
                $style = 'warning';
                $style = $output->getFormatter()->hasStyle($style) ? $style : 'comment';
                $name = sprintf('<%s>%s</%s>', $style, $ref->name, $style);
            } else {
                $name = $ref->name;
            }
            $style  = 'ext';
            $style1 = $output->getFormatter()->hasStyle($style) ? $style : 'comment';
            $style  = 'php';
            $style2 = $output->getFormatter()->hasStyle($style) ? $style : 'comment';
            $rows[] = array(
                $name,
                sprintf('<%s>%s</%s>', $style1, $ref->version, $style1),
                $ref->state,
                $ref->date,
                sprintf('<%s>%s</%s>', $style2, $ref->loaded, $style2),
            );
            if (!empty($ref->loaded)) {
                $loaded++;
            }
        }

        $footers = array(
            '<info>Total</info>',
            sprintf('<info>[%d]</info>', count($response)),
            '',
            '',
            sprintf('<info>[%d]</info>', $loaded)
        );

        $rows[] = new TableSeparator();
        $rows[] = $footers;

        $this->tableHelper($output, $headers, $rows);
    }

    /**
     * Show information about a reference.
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Reference informations
     *
     * @return void
     */
    public function show(OutputInterface $output, array $response): void
    {
        $this->printDbBuildVersion($output);

        if (array_key_exists('summary', $response)) {
            $summary = $response['summary'];
            $output->writeln(sprintf('%s<info>Reference Summary</info>', PHP_EOL));
            $summary['releases'] = array(
                '  Releases                                  %10d',
                array($summary['releases'])
            );
            $summary['iniEntries'] = array(
                '  INI entries                               %10d',
                array($summary['iniEntries'])
            );
            $summary['constants'] = array(
                '  Constants                                 %10d',
                array($summary['constants'])
            );
            $summary['functions'] = array(
                '  Functions                                 %10d',
                array($summary['functions'])
            );
            $summary['interfaces'] = array(
                '  Interfaces                                %10d',
                array($summary['interfaces'])
            );
            $summary['classes'] = array(
                '  Classes                                   %10d',
                array($summary['classes'])
            );
            $summary['class-constants'] = array(
                '  Class Constants                           %10d',
                array($summary['class-constants'])
            );
            $summary['methods'] = array(
                '  Methods                                   %10d',
                array($summary['methods'])
            );
            $summary['dependencies'] = array(
                '  Dependencies                              %10d',
                array($summary['dependencies'])
            );
            $this->printFormattedLines($output, $summary);
            return;
        }

        if (array_key_exists('dependencies', $response)) {
            $this->formatDependency($response['dependencies'], $output);
            unset($response['dependencies']);
        }

        foreach ($response as $title => $data) {
            $args = array();

            foreach ($data as $key => $domain) {
                if ($domain instanceof Release) {
                    $key = sprintf(
                        '%s (%s) - %s',
                        $domain->getDate()->format('Y-m-d'),
                        $domain->getState(),
                        $domain->getVersion()
                    );
                } elseif ($domain instanceof Function_ || $domain instanceof Constant_) {
                    $key = $domain->getName();
                    if (!empty($domain->getDeclaringClass())) {
                        $key = $domain->getDeclaringClass() . '::' . $key;
                    }
                } else {
                    $key = $domain->getName();
                }

                $args[$key] = [
                    $this->ext($domain) ? : $domain->getVersion(),
                    $this->php($domain),
                    ''
                ];
            }

            ksort($args);

            $results = [];
            foreach ($args as $key => $values) {
                $parts = explode(' - ', $key);
                array_unshift($values, $parts[0]);
                $results[] = $values;
            }

            $output->writeln(sprintf('%s<info>%s</info>', PHP_EOL, ucfirst($title)));

            $headers = ['', 'EXT min/Max', 'PHP min/Max', 'Deprecated'];
            $footers = [
                sprintf('<info>Total [%d]</info>', count($results)),
                '',
                '',
                ''
            ];
            $rows = $results;
            $rows[] = new TableSeparator();
            $rows[] = $footers;
            $this->tableHelper($output, $headers, $rows);
        }
    }

    /**
     * @param object $domain
     * @return string
     */
    private function ext($domain): string
    {
        return empty($domain->getExtMax())
            ? $domain->getExtMin()
            : $domain->getExtMin() . ' => ' . $domain->getExtMax()
            ;
    }

    /**
     * @param object $domain
     * @return string
     */
    private function php($domain): string
    {
        return empty($domain->getPhpMax())
            ? $domain->getPhpMin()
            : $domain->getPhpMin() . ' => ' . $domain->getPhpMax()
            ;
    }

    /**
     * @param Dependency[] $data
     * @param OutputInterface $output
     * @return void
     */
    private function formatDependency(array $data, OutputInterface $output): void
    {
        $rows = [];
        $failures = 0;
        foreach ($data as $domain) {
            $name = $domain->getName();
            $ver = $this->getPrettyVersion($name);
            $constraint = $domain->getConstraint();
            $verified = $ver !== '' && Semver::satisfies($ver, $constraint);
            $rows[$constraint] = [$name, $verified ? $constraint : '<error>' . $constraint . '</error>', $verified ? 'Y' : 'N'];
            if (!$verified) {
                $failures++;
            }
        }

        $output->writeln(sprintf('%s<info>%s</info>%s', PHP_EOL, 'Dependencies', PHP_EOL));

        $headers = ['Library', 'Constraint', 'Satisfied'];
        $footers = [
            '<info>Total</info>',
            sprintf('<info>[%d]</info>', count($rows)),
            sprintf('<info>[%d/%d]</info>', count($rows) - $failures, count($rows)),
        ];
        $rows[] = new TableSeparator();
        $rows[] = $footers;
        $this->tableHelper($output, $headers, $rows);
    }
}
