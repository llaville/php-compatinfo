<?php
/**
 * The CompatInfo Summary analyser accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\Reflect\Model\ClassModel;
use Bartlett\Reflect\Model\FunctionModel;
use Bartlett\Reflect\Model\ConstantModel;

/**
 * This analyzer collects versions on all elements of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class SummaryAnalyser extends AbstractAnalyser
{
    const METRICS_PREFIX = 'sa';

    protected $aliases = array();

    protected function init()
    {
        $this->count = array(
            self::METRICS_PREFIX . '.packages'      => array(),
            self::METRICS_PREFIX . '.extensions'    => array(),
            self::METRICS_PREFIX . '.interfaces'    => array(),
            self::METRICS_PREFIX . '.traits'        => array(),
            self::METRICS_PREFIX . '.classes'       => array(),
            self::METRICS_PREFIX . '.methods'       => array(),
            self::METRICS_PREFIX . '.functions'     => array(),
            self::METRICS_PREFIX . '.constants'     => array(),
            self::METRICS_PREFIX . '.internals'     => array(),
            self::METRICS_PREFIX . '.versions'      => array(
                'ext.min' => '',
                'ext.max' => '',
                'php.min' => '4.0.0',
                'php.max' => '',
            )
        );
    }

    public function visitPackageModel($package)
    {
        parent::visitPackageModel($package);

        $name = $package->getName();

        $this->count[self::METRICS_PREFIX . '.packages'][$name] = self::$php4;
        if ('+global' !== $name) {
            $this->count[self::METRICS_PREFIX . '.packages'][$name]['php.min'] = '5.3.0';

            $this->updateGlobalVersion(
                $this->count[self::METRICS_PREFIX . '.packages'][$name]['php.min'],
                ''
            );
        }

        foreach ($package->getDependencies() as $dependency) {
            $dependency->accept($this);
        }

        foreach ($package->getClasses() as $class) {
            $class->accept($this);
        }

        foreach ($package->getInterfaces() as $interface) {
            $interface->accept($this);
        }

        foreach ($package->getTraits() as $trait) {
            $trait->accept($this);
        }

        foreach ($package->getFunctions() as $function) {
            $function->accept($this);
        }

        foreach ($package->getConstants() as $constant) {
            $constant->accept($this);
        }
    }

    public function visitFunctionModel($function)
    {
        $name = $function->getName();
        $this->count[self::METRICS_PREFIX . '.functions'][$name] = self::$php4;
    }

    public function visitConstantModel($constant)
    {
        $name = $constant->getName();
        $this->count[self::METRICS_PREFIX . '.constants'][$name] = self::$php4;
    }

    public function visitDependencyModel($dependency)
    {
        $name = $dependency->getName();
        $versions = $this->processInternal($name);
        $this->count[self::METRICS_PREFIX . '.internals'][$name] = $versions;

        $this->updateGlobalVersion($versions['php.min'], $versions['php.max']);
    }
}
