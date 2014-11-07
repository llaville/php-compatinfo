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

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

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
            self::METRICS_PREFIX . '.conditions'    => array(),
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
        $limit = function($elements, $title) {
            uasort(
                $elements,
                function ($a, $b) {
                    // sort by descending order
                    return -1 * version_compare($a['php.min'], $b['php.min']);
                }
            );
            $optional = 0;
            foreach ($elements as $ext => $values) {
                if (isset($values['optional'])) {
                    $optional++;
                }
            }
            reset($elements);
            do {
                list($ext, $values) = each($elements);
            } while (isset($values['optional']));
            return array(
                sprintf('<info>%s</info>', $title),
                count($elements),
                $optional,
                $values['php.min'],
                $ext
            );
        };

        $output->writeln('<info>Global Analysis</info>' . PHP_EOL);

        $filter = func_get_arg(1);

        if ($filter) {
            $reports = array(
                'Extension' => '.extensions',
                'Namespace' => '.packages',
                'Interface' => '.interfaces',
                'Trait'     => '.traits',
                'Class'     => '.classes',
                'Function'  => '.functions',
                'Constant'  => '.constants',
                'Condition' => '.conditions',
            );
            foreach ($reports as $title => $group) {
                $count[self::METRICS_PREFIX . '.versions'] = self::$php4;

                foreach ($count[self::METRICS_PREFIX . $group] as $key => $versions) {
                    if (isset($versions['optional'])) {
                        continue;
                    }
                    self::updateVersion(
                        $versions['php.min'],
                        $count[self::METRICS_PREFIX . '.versions']['php.min']
                    );
                    self::updateVersion(
                        $versions['php.max'],
                        $count[self::METRICS_PREFIX . '.versions']['php.min']
                    );
                }

                $this->listHelper(
                    $output,
                    $count[self::METRICS_PREFIX . $group],
                    $count[self::METRICS_PREFIX . '.versions'],
                    $filter,
                    $title
                );
                $output->write(PHP_EOL);
            }
        } else {
            $userFunctions = $internalFunctions = array();

            foreach ($count[self::METRICS_PREFIX . '.functions'] as $name => $function) {
                if ($function['ref'] == 'user') {
                    $userFunctions[$name] = $function;
                } else {
                    $internalFunctions[$name] = $function;
                }
            }

            $headers = array('', 'Count', 'Cond', 'PHP min', 'Elements highlight');
            $rows    = array();

            $elements = $count[self::METRICS_PREFIX . '.extensions'];
            $rows[] = $limit($elements, 'Extensions');

            $elements = $count[self::METRICS_PREFIX . '.packages'];
            $rows[] = $limit($elements, 'Namespaces');

            $elements = $count[self::METRICS_PREFIX . '.interfaces'];
            $rows[] = $limit($elements, 'Interfaces');

            $elements = $count[self::METRICS_PREFIX . '.traits'];
            $rows[] = $limit($elements, 'Traits');

            $elements = $count[self::METRICS_PREFIX . '.classes'];
            $rows[] = $limit($elements, 'Classes');

            $elements = $userFunctions;
            $rows[] = $limit($elements, 'User Functions');

            $elements = $internalFunctions;
            $rows[] = $limit($elements, 'Internal Functions');

            $elements = $count[self::METRICS_PREFIX . '.constants'];
            $rows[] = $limit($elements, 'Constants');

            $footers = array(
                '<info>Total</info>',
                '',
                '',
                sprintf(
                    '<info>%s</info>',
                    $count[self::METRICS_PREFIX . '.versions']['php.min']
                ),
                ''
            );
            $rows[] = new TableSeparator();
            $rows[] = $footers;

            $table = new Table($output);
            $table
                ->setHeaders($headers)
                ->setRows($rows)
                ->setStyle('compact')
            ;
            $table->render();
        }
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

        foreach ($package->getUses() as $use) {
            $use->accept($this);
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
}
