<?php declare(strict_types=1);

/**
 * Compatibility Analyser formatter class for console output.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 */

namespace Bartlett\CompatInfo\Console\Formatter;

use Bartlett\CompatInfo\Util\Version;
use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableSeparator;

/**
 * Compatibility Analyser formatter class for console output.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  https://opensource.org/licenses/BSD-3-Clause The 3-Clause BSD License
 * @since    Class available since Release 4.0.0-alpha3
 */
class CompatibilityOutputFormatter extends OutputFormatter
{
    private $metrics;

    /**
     * Compatibility Analyser console output format
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Analyser Metrics
     *
     * @return void
     */
    public function __invoke(OutputInterface $output, array $response): void
    {
        $this->metrics = $response;

        $groups = array(
            'extensions',
            'namespaces',
            'interfaces', 'traits', 'classes',
            'generators',
            'functions',  'constants',
            'conditions',
        );
        foreach ($groups as $group) {
            $args = array_key_exists($group, $response) ? $response[$group] : false;
            $this->listHelper($output, $group, $args, count($args));
        }

        if (!array_key_exists('versions', $response)
            || empty($response['versions'])
        ) {
            return;
        }

        $min = sprintf('PHP %s (min)', $response['versions']['php.min']);

        if (empty($response['versions']['php.max'])) {
            $max = '';
        } else {
            $max = sprintf(', PHP %s (max)', $response['versions']['php.max']);
        }

        $style = 'php';
        $style = $output->getFormatter()->hasStyle($style) ? $style : 'comment';

        $output->writeln(
            sprintf(
                '%s<%s>Requires %s%s</%s>',
                PHP_EOL,
                $style,
                $min,
                $max,
                $style
            )
        );
    }

    /**
     * Helper that convert analyser result to a formatted console table
     *
     * @param OutputInterface $output Console Output concrete instance
     * @param string          $group  Identify group of elements
     * @param mixed           $args   Parsing results of the $group
     * @param int             $total  Total of results in the $group
     *
     * @return void
     */
    private function listHelper(OutputInterface $output, string $group, $args, int $total): void
    {
        $length = ('classes' == $group) ? -2 : -1;
        $title  = substr($group, 0, $length);

        if (!is_array($args)) {
            // metrics of the $group are not available
            return;
        }

        if (empty($args)) {
            $style = 'warning';
            $style = $output->getFormatter()->hasStyle($style) ? $style : 'comment';

            $output->writeln(sprintf('%s<%s>No %s found</%s>', PHP_EOL, $style, $title, $style));
            return;
        }

        $versions = array(
            'ext.name' => 'user',
            'ext.min'  => '',
            'ext.max'  => '',
            'ext.all'  => '',
            'php.min'  => '4.0.0',
            'php.max'  => '',
            'php.all'  => '',
        );
        // compute global versions of the $group
        foreach ($args as $name => $base) {
            if (isset($base['optional'])) {
                // do not compute conditional elements
                continue;
            }
            foreach ($base as $id => $version) {
                if (!in_array(substr($id, -3), array('min', 'max', 'all'))
                    || 'arg.max' == $id
                ) {
                    continue;
                }
                if (version_compare($version, $versions[$id], 'gt')) {
                    $versions[$id] = $version;
                }
            }
        }
        $phpRequired = Version::php($versions);

        $output->writeln(
            sprintf('%s<info>%s Analysis</info>%s', PHP_EOL, ucfirst($group), PHP_EOL)
        );

        $rows = array();
        ksort($args);

        foreach ($args as $arg => $versions) {
            $flags = isset($versions['optional']) ? 'C' : ' ';

            if (in_array($group, array('classes', 'interfaces', 'traits'))) {
                if ('user' == $versions['ext.name']
                    && ($versions['declared'] ?? false) === false
                ) {
                    $flags .= 'U';
                }
            }

            $row = array(
                $flags,
                $arg,
                isset($versions['ext.name']) ? $versions['ext.name'] : '',
                Version::ext($versions),
                Version::php($versions),
            );
            /*
                for reference:show command,
                tell us if there are some PHP versions excluded
             */
            if (!empty($versions['php.excludes'])) {
                $row[0] = 'W';
            }
            $rows[] = $row;

            if (in_array($group, array('classes', 'interfaces', 'traits'))
                && $output->isVerbose()
                && !in_array($arg, array('parent', 'self', 'static'))
            ) {
                $this->getMethods($arg, $rows);
            }
        }

        $headers = array('  ', ucfirst($title), 'REF', 'EXT min/Max', 'PHP min/Max');

        $footers = array(
            '',
            sprintf('<info>Total [%d]</info>', $total),
            '',
            '',
            sprintf('<info>%s</info>', $phpRequired)
        );
        $rows[] = new TableSeparator();
        $rows[] = $footers;

        $this->tableHelper($output, $headers, $rows);
    }

    private function getMethods(string $className, &$rows): void
    {
        foreach ($this->metrics['methods'] as $method => $versions) {
            if (strpos($method, "$className\\") === 0) {
                $flags = isset($versions['optional']) ? 'C' : ' ';
                $rows[] = array(
                    $flags,
                    sprintf('<info>function</info> %s', str_replace("$className\\", '', $method)),
                    isset($versions['ext.name']) ? $versions['ext.name'] : '',
                    Version::ext($versions),
                    Version::php($versions),
                );
            }
        }
    }
}
