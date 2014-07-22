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

use Bartlett\Reflect\Printer\Text;

use Symfony\Component\Console\Output\OutputInterface;

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
    const METRICS_GROUP  = 'internals';

    /**
     * Initializes all metrics.
     *
     * @return void
     */
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
            self::METRICS_PREFIX . '.versions'      => array(
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
        $count = $this->count;
        $lines = array();

        $userFunctions = $internalFunctions = 0;

        foreach ($count[self::METRICS_PREFIX . '.functions'] as $function) {
            if ($function['ref'] == 'user') {
                $userFunctions++;
            } else {
                $internalFunctions++;
            }
        }

        $lines['reportTitle'] = array(
            '%s<info>Summary Analysis</info>',
            array(PHP_EOL)
        );

        $lines['summary'] = array(
            '%sSummary',
            array(PHP_EOL)
        );
        $lines['extensions'] = array(
            '  Extensions                                %10d',
            array(count($count[self::METRICS_PREFIX . '.extensions']))
        );
        $lines['namespaces'] = array(
            '  Namespaces                                %10d',
            array($count['namespaces'])
        );
        $lines['interfaces'] = array(
            '  Interfaces                                %10d',
            array(count($count[self::METRICS_PREFIX . '.interfaces']))
        );
        $lines['traits'] = array(
            '  Traits                                    %10d',
            array(count($count[self::METRICS_PREFIX . '.traits']))
        );
        $lines['classes'] = array(
            '  Classes                                   %10d',
            array(count($count[self::METRICS_PREFIX . '.classes']))
        );
        $lines['methods'] = array(
            '  Methods                                   %10d',
            array(count($count[self::METRICS_PREFIX . '.methods']))
        );
        $lines['functions'] = array(
            '  Functions                                 %10d',
            array($userFunctions)

        );
        $lines['constants'] = array(
            '  Constants                                 %10d',
            array(count($count[self::METRICS_PREFIX . '.constants']))
        );
        $lines['internalFunctions'] = array(
            '  Internal Functions                        %10d',
            array($internalFunctions)
        );

        $lines['versions'] = array(
            '%sVersions',
            array(PHP_EOL)
        );
        $lines['php.min'] = array(
            '  PHP min                                   %10s',
            array($count[self::METRICS_PREFIX . '.versions']['php.min'])
        );
        $lines['php.max'] = array(
            '  PHP max                                   %10s',
            array($count[self::METRICS_PREFIX . '.versions']['php.max'])
        );

        $printer = new Text;
        $printer->write($output, $lines);
    }

    /**
     * Explore contents of each namespace (PackageModel).
     *
     * @param object $package Reflect the current namespace explored
     *
     * @return void
     */
    public function visitPackageModel($package)
    {
        $name = $package->getName();

        $this->count[static::METRICS_PREFIX . '.packages'][$name] = self::$php4;
        if ('+global' !== $name) {
            $this->count[static::METRICS_PREFIX . '.packages'][$name]['php.min'] = '5.3.0';

            $this->updateGlobalVersion(
                $this->count[static::METRICS_PREFIX . '.packages'][$name]['php.min'],
                ''
            );
        }

        parent::visitPackageModel($package);

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
}
