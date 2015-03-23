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
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
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
    public function __invoke(OutputInterface $output, $response)
    {
        $this->metrics = $response;

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

        if (empty($response['versions']['php.all'])) {
            $all = '';
        } else {
            $all = sprintf(', PHP %s (all)', $response['versions']['php.all']);
        }

        $output->writeln(
            sprintf(
                '%s<php>Requires %s%s%s</php>',
                PHP_EOL,
                $min,
                $max,
                $all
            )
        );
    }

    /**
     * Helper that convert analyser result to a formatted console table
     *
     * @param OutputInterface $output Console Output concrete instance
     * @param string          $group  Identify group of elements
     * @param array           $args   Parsing results of the $group
     *
     * @return void
     */
    private function listHelper(OutputInterface $output, $group, $args)
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
        $phpAll      = Version::all($versions);

        $output->writeln(
            sprintf('%s<info>%s Analysis</info>%s', PHP_EOL, ucfirst($group), PHP_EOL)
        );

        $rows = array();
        ksort($args);

        foreach ($args as $arg => $versions) {
            $flags = isset($versions['optional']) ? 'C' : ' ';

            if (in_array($group, array('classes', 'interfaces', 'traits'))) {
                if ('user' == $versions['ext.name']
                    && !isset($versions['declared'])
                ) {
                    $flags .= 'U';
                }
            }

            $row = array(
                $flags,
                $arg,
                $versions['matches'] > 0 ? $versions['matches'] : '',
                isset($versions['ext.name']) ? $versions['ext.name'] : '',
                Version::ext($versions),
                Version::php($versions),
                Version::all($versions),
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

        $headers = array('  ', ucfirst($title), 'Matches', 'REF', 'EXT min/Max', 'PHP min/Max', 'PHP all');
        $footers = array(
            '',
            sprintf('<info>Total [%d]</info>', count($args)),
            '',
            '',
            '',
            sprintf('<info>%s</info>', $phpRequired),
            sprintf('<info>%s</info>', $phpAll)
        );
        $rows[] = new TableSeparator();
        $rows[] = $footers;

        $this->tableHelper($output, $headers, $rows);
    }

    private function getMethods($className, &$rows)
    {
        foreach ($this->metrics['methods'] as $method => $versions) {
            if (strpos($method, "$className::") === 0) {
                $rows[] = array(
                    ' ',
                    sprintf('<info>function</info> %s', str_replace("$className::", '', $method)),
                    $versions['matches'] > 0 ? $versions['matches'] : '',
                    isset($versions['ext.name']) ? $versions['ext.name'] : '',
                    Version::ext($versions),
                    Version::php($versions),
                    Version::all($versions),
                );
            }
        }
    }
}
