<?php
/**
 * The CompatInfo CodeCond analyser accessible through the AnalyserPlugin.
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
 * This analyzer collects versions on conditional code of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.4.0
 */
class CodeCondAnalyser extends AbstractAnalyser
{
    const METRICS_PREFIX = 'cca';
    const METRICS_GROUP  = 'conditions';

    /**
     * Initializes all metrics.
     *
     * @return void
     */
    protected function init()
    {
        $this->count = array(
            self::METRICS_PREFIX . '.' . self::METRICS_GROUP => array(),
            self::METRICS_PREFIX . '.versions'               => array(
                'ext.min' => '',
                'ext.max' => '',
                'php.min' => '4.0.0',
                'php.max' => '',
            )
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
        $output->writeln('<info>Conditional Code Analysis</info>' . PHP_EOL);

        $this->listHelper(
            $output,
            $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP],
            $this->count[self::METRICS_PREFIX . '.versions'],
            func_get_arg(1),
            'Condition'
        );
    }

    /**
     * Explore contents of each dependency (DependencyModel)
     * found in the current namespace.
     *
     * @param object $dependency Reflect the current dependency explored
     *
     * @return void
     */
    public function visitDependencyModel($dependency)
    {
        $name = $dependency->getName();

        if ($dependency->isConditionalFunction()) {
            $versions = $this->processInternal($name);
            $args     = $dependency->getArguments();

            if ('Scalar_String' == $args[0]['type']) {
                $versions = $this->processInternal($args[0]['value']);
                $name     = sprintf('%s(%s)', $name, $args[0]['value']);
                $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP][$name] = $versions;

                $this->updateGlobalVersion($versions['php.min'], $versions['php.max']);
            }
        }
    }
}
