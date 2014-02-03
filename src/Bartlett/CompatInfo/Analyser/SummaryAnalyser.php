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
            self::METRICS_PREFIX . '.internals'     => 0,
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

    public function visitStatement($dependency)
    {
        $this->count[self::METRICS_PREFIX . '.internals']++;

        $versions = $this->processInternal(
            $dependency->getAttribute('name'),
            $dependency->getAttribute('args')
        );

        $this->updateGlobalVersion($versions['php.min'], $versions['php.max']);
    }

    public function visitExpression($dependency)
    {
        $depType = $dependency->getType();

        if ('Alloc' == $depType) {
            if ($name = ltrim($dependency->getAttribute('class'), '\\')) {

                $versions = $this->processInternal(
                    $name,
                    $dependency->count()
                );

                $type = self::METRICS_PREFIX . '.classes';
                $this->count[$type][$name] = $versions;

                $this->updateGlobalVersion($versions['php.min'], $versions['php.max']);

                // name class resolver
                $node = $dependency->getParent()->getChild(0);

                if ($node->getType() == 'Variable') {
                    // local variable that host the class instance
                    $this->aliases[$node->getAttribute('name')] = $name;
                }
            }

        } elseif (
            in_array($depType, array('MethodCall', 'ClassMemberAccessOnInstantiation'))
        ) {
            if ('ClassMemberAccessOnInstantiation' == $depType) {
                $this->updateGlobalVersion('5.4.0RC1', '');
                $name = $dependency->getAttribute('name');
                $name = array_shift($name);
                $this->aliases[$name] = $name;
            }

            list ($class, $method) = $dependency->getAttribute('name');
            $argc = $dependency->getAttribute('args');

            if ('this' !== $class && isset($this->aliases[$class])) {
                // name class resolver  (see issue GH-100)
                $name = $this->aliases[$class];

                $ref = $this->findReference($name);
                $methods = $ref->getClassMethods();

                if (array_key_exists(strtolower($method), array_change_key_case($methods[$name]))) {

                    $min = $methods[$name][$method]['php.min'];
                    $max = $methods[$name][$method]['php.max'];

                    $this->updateGlobalVersion($min, $max);

                    $type = self::METRICS_PREFIX . '.classes';
                    $this->count[$type][$name]['php.min'] = $min;
                    $this->count[$type][$name]['php.max'] = $max;
                }
            }
        }
    }
}
