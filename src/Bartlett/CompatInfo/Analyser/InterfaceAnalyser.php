<?php
/**
 * The CompatInfo Interface analyser accessible through the AnalyserPlugin.
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
 * This analyzer collects versions on all interfaces of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class InterfaceAnalyser extends AbstractAnalyser
{
    const METRICS_PREFIX = 'ia';
    const METRICS_GROUP  = 'interfaces';

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
                'php.min' => '5.0.0',
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
        $output->writeln('<info>Interfaces Analysis</info>' . PHP_EOL);

        $this->listHelper(
            $output,
            $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP],
            $this->count[self::METRICS_PREFIX . '.versions'],
            func_get_arg(1),
            'Interface'
        );
    }

    /**
     * Explore all interfaces (ClassModel) in each namespace (PackageModel).
     *
     * @param object $package Reflect the current namespace explored
     *
     * @return void
     */
    public function visitPackageModel($package)
    {
        $this->packages[] = $package->getName();

        foreach ($package->getInterfaces() as $interface) {
            $interface->accept($this);
        }
    }
}
