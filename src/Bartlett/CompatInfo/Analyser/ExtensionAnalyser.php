<?php
/**
 * The CompatInfo Extension analyser accessible through the AnalyserPlugin.
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
 * This analyzer collects versions on all extensions of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class ExtensionAnalyser extends AbstractAnalyser
{
    const METRICS_PREFIX = 'ea';
    const METRICS_GROUP  = 'extensions';

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
        $output->writeln('<info>Extensions Analysis</info>' . PHP_EOL);

        $this->listHelper(
            $output,
            $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP],
            $this->count[self::METRICS_PREFIX . '.versions'],
            func_get_arg(1),
            'Extension'
        );
    }

    /**
     * Explore all elements of each namespace (PackageModel),
     * that may used parameters with classes (type hinting).
     *
     * @param object $package Reflect the current namespace explored
     *
     * @return void
     */
    public function visitPackageModel($package)
    {
        // explore dependencies (DependencyModel)
        parent::visitPackageModel($package);

        // explore all user classes (ClassModel)
        foreach ($package->getClasses() as $class) {
            $class->accept($this);
        }

        // explore all user interfaces (ClassModel)
        foreach ($package->getInterfaces() as $interface) {
            $interface->accept($this);
        }

        // explore all user traits (ClassModel)
        foreach ($package->getTraits() as $trait) {
            $trait->accept($this);
        }

        // explore all user functions (FunctionModel)
        foreach ($package->getFunctions() as $function) {
            $function->accept($this);
        }
    }

    /**
     * Explore user classes (ClassModel) found in the current namespace.
     *
     * @param object $class Reflect the current user class explored
     *
     * @return void
     */
    public function visitClassModel($class)
    {
        parent::visitClassModel($class);

        if ($this->testClass) {
            // do not explore classes of PHPUnit tests suites
            return;
        }

        foreach ($class->getMethods() as $method) {
            $method->accept($this);
        }
    }

    /**
     * Explore methods (MethodModel) of each user classes
     * found in the current namespace.
     *
     * @param object $method Reflect the current method explored
     *
     * @return void
     */
    public function visitMethodModel($method)
    {
        foreach ($method->getParameters() as $parameter) {
            $parameter->accept($this);
        }
    }
}
