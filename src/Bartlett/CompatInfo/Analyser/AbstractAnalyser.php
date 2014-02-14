<?php
/**
 * Base class to all CompatInfo analysers accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

use Bartlett\CompatInfo\Reference\ReferenceLoader;
use Bartlett\CompatInfo\Reference\Strategy\PreFetchStrategy;
use Bartlett\CompatInfo\Reference\Strategy\AutoDiscoverStrategy;

use Bartlett\Reflect;
use Bartlett\Reflect\Analyser\AbstractAnalyser as ReflectAnalyser;
use Bartlett\Reflect\Model\PackageModel;
use Bartlett\Reflect\Model\ClassModel;
use Bartlett\Reflect\Model\MethodModel;
use Bartlett\Reflect\Model\ConstantModel;

/**
 * Provides common metrics for all CompatInfo analysers.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
abstract class AbstractAnalyser extends ReflectAnalyser
{
    protected static $php4 = array(
        'ext.min' => '',
        'ext.max' => '',
        'php.min' => '4.0.0',
        'php.max' => '',
    );
    protected $loader;

    public function visitPackageModel($package)
    {
        parent::visitPackageModel($package);

        foreach ($package->getDependencies() as $dependency) {
            $dependency->accept($this);
        }
    }

    public function visitClassModel($class)
    {
        parent::visitClassModel($class);

        if ($this->testClass) {
            return;
        }

        $name = $class->getName();
        $type = static::METRICS_PREFIX;

        if ($class->isTrait()) {
            $type .= '.traits';
        } elseif ($class->isInterface()) {
            $type .= '.interfaces';
        } else {
            $type .= '.classes';
        }
        $this->count[$type][$name] = self::$php4;

        list($min, $max) = $this->processClass($class);
        $this->count[$type][$name]['php.min'] = $min;
        $this->count[$type][$name]['php.max'] = $max;

        $this->updateGlobalVersion($min, $max);

        foreach ($class->getMethods() as $method) {
            $method->accept($this);
        }
    }

    public function visitMethodModel($method)
    {
        $name = $method->getName();
        $this->count[static::METRICS_PREFIX . '.methods'][$name] = self::$php4;

        // Methods constructor/destructor, visibility
        // and modifiers (final, static, abstract)
        if ($method->isFinal()
            || $method->isStatic()
            || $method->isAbstract()
            || $method->isPrivate()
            || $method->isProtected()
            || $method->isPublic()
            || $method->isConstructor()
            || $method->isDestructor()
        ) {
            $min = '5.0.0';
            $this->count[static::METRICS_PREFIX . '.methods'][$name]['php.min'] = $min;

            // update object versions
            $class = $method->getClassName();
            self::updateVersion(
                $min,
                $this->count[static::METRICS_PREFIX . '.classes'][$class]['php.min']
            );
        }

        $this->updateGlobalVersion(
            $this->count[static::METRICS_PREFIX . '.methods'][$name]['php.min'],
            $this->count[static::METRICS_PREFIX . '.methods'][$name]['php.max']
        );
    }

    public function visitConstantModel($constant)
    {
    }

    public function visitDependencyModel($dependency)
    {
        $name = $dependency->getName();
        $argc = 0;

        $versions = $this->processInternal($name, $argc);
        $type     = $this->loader->getTypeElement();

        if ($type == static::METRICS_GROUP) {
            $this->count[static::METRICS_PREFIX . ".$type"][$name] = $versions;
            $this->updateGlobalVersion($versions['php.min'], $versions['php.max']);
        }
    }

    /**
     * Update the base version if current ref version is greater
     *
     * @param string $current Current version
     * @param string &$base   Base version
     *
     * @return void
     */
    protected static function updateVersion($current, &$base)
    {
        if (version_compare($current, $base, 'gt')) {
            $base = $current;
        }
    }

    protected function updateGlobalVersion($min, $max)
    {
        self::updateVersion(
            $min,
            $this->count[static::METRICS_PREFIX . '.versions']['php.min']
        );
        self::updateVersion(
            $max,
            $this->count[static::METRICS_PREFIX . '.versions']['php.max']
        );
    }

    protected function findReference($element)
    {
        if (!$this->loader) {
            $extensions = array(
                'standard',
                'core',
                'bcmath',
                'bz2',
                'calendar',
                'date',
                'dom',
                'ereg',
                'fileinfo',
                'filter',
                'gd',
                'gettext',
                'mbstring',
                'mcrypt',
                'odbc',
                'pcre',
                'pdflib',
                'sockets',
                'spl',
                'tokenizer',
                'XCache',
                'xml',
                'zlib',
            );
            $this->loader = new ReferenceLoader;
            $this->loader->register(
                new PreFetchStrategy($extensions)
            );
            $this->loader->register(new AutoDiscoverStrategy);
        }
        return $this->loader->loadRef($element);
    }

    protected function processInternal($element, $argc = 0)
    {
        $ref = $this->findReference($element);

        if ($ref) {
            $elements = $ref->{'get' . ucfirst($this->loader->getTypeElement())}();

            $versions = $elements[$element];
            $versions['ref'] = $ref::REF_NAME;
        } else {
            // not found; probably user component or reference not yet supported
            $versions = self::$php4;
            $versions['ref'] = 'user';
        }

        $refName = $versions['ref'];

        if (isset($this->count[static::METRICS_PREFIX . '.extensions'][$refName])) {
            self::updateVersion(
                $versions['ext.min'],
                $this->count[static::METRICS_PREFIX . '.extensions'][$refName]['ext.min']
            );
            self::updateVersion(
                $versions['ext.max'],
                $this->count[static::METRICS_PREFIX . '.extensions'][$refName]['ext.max']
            );
        } else {
            $this->count[static::METRICS_PREFIX . '.extensions'][$refName] = array(
                'ext.min' => '',
                'ext.max' => '',
            );
        }

        return $versions;
    }

    /**
     * Explore class/interface/trait signature
     *
     * @param object $element A ClassModel definition
     */
    protected function processClass($element)
    {
        $max        = '';
        $name       = $element->getName();
        $parent     = $element->getParentClass();
        $interfaces = $element->getInterfaceNames();

        if ($element->getName() == 'Generator') {
            $min = '5.5.0';
            $this->count[static::METRICS_PREFIX . '.classes'][$name]['php.min'] = $min;

        } elseif ($element->isTrait()) {
            $min = '5.4.0';
            $this->count[static::METRICS_PREFIX . '.traits'][$name]['php.min'] = $min;

        } elseif (!empty($interfaces)) {
            $min = '5.0.0';
            $this->count[static::METRICS_PREFIX . '.interfaces'][$name]['php.min'] = $min;

            // inspect each interface implemented and checks their versions
            foreach ($element->getInterfaces() as $interface) {
                $name = $interface->getName();

                list ($min, $max) = $this->processClass($interface);

                self::updateVersion(
                    $min,
                    $this->count[static::METRICS_PREFIX . '.interfaces'][$name]['php.min']
                );
                self::updateVersion(
                    $max,
                    $this->count[static::METRICS_PREFIX . '.interfaces'][$name]['php.max']
                );
            }

        } elseif ($parent) {
            // inspect parent class and checks versions
            return $this->processClass($parent);

        } elseif ($element->inNamespace()) {
            $min = '5.3.0';

        } elseif ($element->isInterface()) {
            $min = '5.0.0';

        } else {
            /**
             * Look for PHP5 features
             */
            if ($element->isAbstract()
                || $element->isFinal()
            ) {
                $min = '5.0.0';
            } else {
                $min = '4.0.0';
            }
        }
        return array($min, $max);
    }
}
