<?php
/**
 * The CompatInfo Constant analyser accessible through the AnalyserPlugin.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Analyser;

/**
 * This analyzer collects versions on all constants of a project.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
class ConstantAnalyser extends AbstractAnalyser
{
    const METRICS_PREFIX = 'ca';
    const METRICS_GROUP  = 'constants';

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

    public function visitPackageModel($package)
    {
        $this->packages[] = $package->getName();

        foreach ($package->getConstants() as $constant) {
            $constant->accept($this);
        }
    }

    public function visitConstantModel($constant)
    {
        $name     = $constant->getName();
        $versions = $this->processInternal($name);
        $type     = $this->loader->getTypeElement();

        if ($type == static::METRICS_GROUP) {
            $this->count[static::METRICS_PREFIX . ".$type"][$name] = $versions;
            $this->updateGlobalVersion($versions['php.min'], $versions['php.max']);
        }
    }
}
