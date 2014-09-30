<?php
/**
 * The CompatInfo Namespace analyser accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * This analyzer collects versions on all namespaces of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class NamespaceAnalyser extends SummaryAnalyser
{
    const METRICS_PREFIX = 'na';
    const METRICS_GROUP  = 'namespaces';

    /**
     * Renders analyser report to output.
     *
     * @param object OutputInterface $output    Console Output
     *
     * @return void
     */
    public function render(OutputInterface $output)
    {
        $output->writeln('<info>Namespaces Analysis</info>' . PHP_EOL);

        $this->listHelper(
            $output,
            $this->count[self::METRICS_PREFIX . '.packages'],
            $this->count[self::METRICS_PREFIX . '.versions'],
            func_get_arg(1),
            'Namespace'
        );
    }
}
