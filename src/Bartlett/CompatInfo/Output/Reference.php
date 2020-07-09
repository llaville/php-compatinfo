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

use Bartlett\CompatInfo\Util\Database;
use Bartlett\CompatInfo\Util\Version;

use Bartlett\Reflect\Console\Formatter\OutputFormatter;

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
                Database::versionRefDb()['build.version'],
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
            $summary['static methods'] = array(
                '  Static Methods                            %10d',
                array($summary['static methods'])
            );
            $this->printFormattedLines($output, $summary);
            return;
        }

        foreach ($response as $title => $values) {
            $args = array();

            foreach ($values as $key => $val) {
                if (strcasecmp($title, 'releases') == 0) {
                    $key = sprintf('%s (%s)', $val['date'], $val['state']);

                } elseif (strcasecmp($title, 'methods') == 0
                    || strcasecmp($title, 'static methods') == 0
                    || strcasecmp($title, 'class-constants') == 0
                ) {
                    foreach ($val as $meth => $v) {
                        $k = sprintf('%s::%s', $key, $meth);
                        $args[$k] = $v;
                    }
                    continue;
                }
                $args[$key] = $val;
            }

            $rows = array();
            ksort($args);

            foreach ($args as $arg => $versions) {
                $row = array(
                    $arg,
                    Version::ext($versions),
                    Version::php($versions),
                    Version::deprecated($versions),
                );
                $rows[] = $row;
            }

            $headers = array(ucfirst($title), 'EXT min/Max', 'PHP min/Max', 'Deprecated');
            $footers = array(
                sprintf('<info>Total [%d]</info>', count($args)),
                '',
                '',
                ''
            );
            $rows[] = new TableSeparator();
            $rows[] = $footers;

            $this->tableHelper($output, $headers, $rows);
            $output->writeln('');
        }
    }
}
