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

use Bartlett\CompatInfo\ConsoleApplication;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

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
        $count = $this->count;

        $output->writeln('<info>Conditional Code Analysis</info>' . PHP_EOL);

        $args     = $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP];
        $versions = $this->count[self::METRICS_PREFIX . '.versions'];
        $filter   = func_get_arg(1);
        $title    = 'Condition';

        $rows = ConsoleApplication::versionHelper($args, $filter);

        $headers = array($title, '', '', 'PHP min/Max');

        $versions = empty($versions['php.max'])
            ? $versions['php.min']
            : $versions['php.min'] . ' => ' . $versions['php.max']
        ;

        if ($filter) {
            $footers = array(
                sprintf('<info>Total [%d/%d]</info>', count($rows), count($args)),
                '',
                '',
                sprintf('<info>%s</info>', $versions)
            );
        } else {
            $footers = array(
                sprintf('<info>Total [%d]</info>', count($args)),
                '',
                '',
                sprintf('<info>%s</info>', $versions)
            );
        }
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

            if (!isset($this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP][$name])) {
                $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP][$name] = array();
            }

            $values = self::$php4;
            $values['signature'] = (string) $dependency;

            $this->count[self::METRICS_PREFIX . '.' . self::METRICS_GROUP][$name] = $values;
        }
    }
}
