<?php
/**
 * Compatibility Analyser formatter class for console output.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Console\Formatter;

use Bartlett\Reflect\Console\Formatter\OutputFormatter;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\TableSeparator;

/**
 * Compatibility Analyser formatter class for console output.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha3
 */
class CompatibilityOutputFormatter extends OutputFormatter
{
    /**
     * Compatibility Analyser console output format
     *
     * @param OutputInterface $output   Console Output concrete instance
     * @param array           $response Analyser Metrics
     *
     * @return void
     */
    public function __invoke(OutputInterface $output, $response)
    {
        $filter = false;
        $groups = array(
            'extensions',
            'namespaces',
            'interfaces', 'traits', 'classes',
            'functions',  'constants',
            'conditions',
        );
        foreach ($groups as $group) {
            $this->listHelper($output, $group, $response[$group], $filter);
        }

        $min = sprintf('PHP %s (min)', $response['versions']['php.min']);

        if (empty($response['versions']['php.max'])) {
            $max = '';
        } else {
            $max = sprintf(', PHP %s (max)', $response['versions']['php.max']);
        }
        $output->writeln(
            sprintf(
                '%s<php>Requires %s%s</php>',
                PHP_EOL,
                $min,
                $max
            )
        );
    }

    /**
     * Helper that convert analyser result to a formatted console table
     *
     * @param OutputInterface $output Console Output concrete instance
     * @param string          $group  Identify group of elements
     * @param array           $args   Parsing results of the $group
     * @param mixed           $filter (reserved)
     *
     * @return void
     */
    private function listHelper(OutputInterface $output, $group, $args, $filter)
    {
        $length = ('classes' == $group) ? -2 : -1;
        $title  = substr($group, 0, $length);

        if (empty($args)) {
            $output->writeln(sprintf('%s<warning>No %s found</warning>', PHP_EOL, $title));
            return;
        }

        $versions = array(
            'ext.name' => 'user',
            'ext.min'  => '',
            'ext.max'  => '',
            'php.min'  => '4.0.0',
            'php.max'  => '',
        );
        // compute global versions of the $group
        foreach ($args as $name => $base) {
            if (isset($base['optional'])) {
                // do not compute conditional elements
                continue;
            }
            foreach ($base as $id => $version) {
                if (!in_array(substr($id, -3), array('min', 'max'))
                    || 'arg.max' == $id
                ) {
                    continue;
                }
                if (version_compare($version, $versions[$id], 'gt')) {
                    $versions[$id] = $version;
                }
            }
        }

        $output->writeln(
            sprintf('%s<info>%s Analysis</info>%s', PHP_EOL, ucfirst($group), PHP_EOL)
        );

        $rows = $this->versionHelper($args, $filter);

        $headers = array(' ', ucfirst($title), 'Matches', 'REF', 'EXT min/Max', 'PHP min/Max');

        $versions = empty($versions['php.max'])
            ? $versions['php.min']
            : $versions['php.min'] . ' => ' . $versions['php.max']
        ;

        if ($filter) {
            $footers = array(
                '',
                sprintf('<info>Total [%d/%d]</info>', count($rows), count($args)),
                '',
                '',
                '',
                sprintf('<info>%s</info>', $versions)
            );
        } else {
            $footers = array(
                '',
                sprintf('<info>Total [%d]</info>', count($args)),
                '',
                '',
                '',
                sprintf('<info>%s</info>', $versions)
            );
        }
        $rows[] = new TableSeparator();
        $rows[] = $footers;

        $this->tableHelper($output, $headers, $rows);
    }

    /**
     * Helper to print versions of each element in current group
     *
     * @param array $args   Parsing results
     * @param mixed $filter (reserved)
     * @return string
     */
    private function versionHelper(array $args, $filter)
    {
        $rows = array();
        ksort($args);

        foreach ($args as $arg => $versions) {
            if ($filter) {
                if (version_compare($versions['php.min'], $filter[1], $filter[0]) === false) {
                    continue;
                }
            }
            $row = array(
                isset($versions['optional']) ? 'C' : ' ',
                $arg,
                $versions['matches'] > 0 ? $versions['matches'] : '',
                isset($versions['ext.name']) ? $versions['ext.name'] : '',
                empty($versions['ext.max'])
                    ? $versions['ext.min']
                    : $versions['ext.min'] . ' => ' . $versions['ext.max'],
                empty($versions['php.max'])
                    ? $versions['php.min']
                    : $versions['php.min'] . ' => ' . $versions['php.max'],
            );
            /*
                for reference:show command,
                tell us if there are some PHP versions excluded
             */
            if (!empty($versions['php.excludes'])) {
                $row[0] = 'W';
            }
            $rows[] = $row;
        }
        return $rows;
    }
}
