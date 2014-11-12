<?php
/**
 * The CompatInfo Function analyser accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfo\Metrics;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * This analyzer collects versions on all functions of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class FunctionAnalyser extends AbstractAnalyser
{
    const METRICS_PREFIX = Metrics::FUNCTION_ANALYSER;
    const METRICS_GROUP  = Metrics::FUNCTIONS;

    protected function init()
    {
        $this->count = array(
            self::METRICS_PREFIX . '.' . self::METRICS_GROUP => array(),
            self::METRICS_PREFIX . '.' . Metrics::VERSIONS   => self::$php4
        );
    }

    /**
     * Renders analyser report to output.
     *
     * @param object OutputInterface $output    Console Output
     *
     * @return void
     */
    public function render(OutputInterface $output)
    {
        $output->writeln('<info>Functions Analysis</info>' . PHP_EOL);

        $this->listHelper(
            $output,
            $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP],
            $this->count[self::METRICS_PREFIX . '.' . Metrics::VERSIONS],
            func_get_arg(1),
            'Function'
        );
    }

    public function visitPackageModel($package)
    {
        parent::visitPackageModel($package);

        foreach ($package->getFunctions() as $function) {
            $function->accept($this);
        }
    }
}
