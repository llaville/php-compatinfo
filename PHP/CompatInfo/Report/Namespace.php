<?php
/**
 * Namespace report
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * Namespace report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Namespace extends PHP_CompatInfo_Report
{
    /**
     * Prints a namespace report
     *
     * @param array  $report  Report data to produce
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    public function generate($report, $base, $verbose)
    {
        if ($verbose < 3) {
            // summary report

            $namespaces = $report['namespaces'];
            $conditions = $report['conditions'];

            $this->total          = array();
            $this->totalExcludes  = 0;
            $this->globalVersions = array('5.3.0', '');

            $this->printTHead($base, false);
            $this->printTBody($namespaces, ($verbose == 2), $base);
            $this->printTFoot($conditions);

        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total          = array();
                $this->totalExcludes  = 0;
                $this->globalVersions = array('5.3.0', '');

                $this->printTHead($base, $filename);
                $this->printTBody($elements['namespaces'], false, $base);
                $this->printTFoot($elements['conditions']);
            }
        }
        echo PHP_EOL;
    }

    /**
     * Prints header of report
     *
     * @param string $base     Base directory of data source
     * @param string $filename Current file
     *
     * @return void
     */
    private function printTHead($base, $filename)
    {
        echo PHP_EOL;
        echo 'BASE: ' . $base . PHP_EOL;
        echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
        echo str_repeat('-', $this->width)   . PHP_EOL;
        echo 'PHP COMPAT INFO NAMESPACE SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)   . PHP_EOL;
        echo '  NAMESPACE' . str_repeat(' ', ($this->width - 50))
            . 'EXTENSION' . str_repeat(' ', ($this->width - 70))
            . 'VERSION' . str_repeat(' ', ($this->width - 70))
            . 'COUNT' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints footer of report
     *
     * @param array $conditions List of conditions found on current file
     *
     * @return void
     */
    private function printTFoot($conditions)
    {
        $total = count($this->total);
        echo str_repeat('-', $this->width).PHP_EOL;
        echo 'A TOTAL OF ' . $total
            . ' NAMESPACE' . ($total > 1 ? 'S WERE' : ' WAS')
            . ' FOUND';
        if ($this->totalExcludes > 0) {
            echo ' AND ' . $this->totalExcludes . ' EXCLUDED FROM PARSING';
        }
        echo PHP_EOL;
        $ccn = $this->getCCN($conditions);
        if ($ccn > 0) {
            echo 'WITH CONDITIONAL CODE LEVEL ' . $ccn . PHP_EOL;
        }
        if ($total > 0) {
            echo 'REQUIRED PHP ' . $this->globalVersions[0] .  ' (MIN) ';
            if (!empty($this->globalVersions[1])) {
                echo $this->globalVersions[1] . ' (MAX)';
            }
            echo PHP_EOL;
        }
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_Timer::resourceUsage()    . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints body of report
     *
     * @param array  $elements List of namespace to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    private function printTBody($elements, $filename, $base)
    {
        ksort($elements);

        foreach ($elements as $category => $items) {
            $namespaces = array_keys($items);
            $this->total = array_merge($this->total, $namespaces);

            asort($namespaces);
            foreach ($namespaces as $namespace) {
                if ($items[$namespace]['excluded']) {
                    echo 'E';
                    $this->totalExcludes++;
                } else {
                    echo ' ';
                }
                if ('user' == $category) {
                    $extension = '';
                } else {
                    $extension = $category;
                }
                $versions = implode('  ', $items[$namespace]['versions']);
                echo ' ';
                if (strlen($namespace) < 38) {
                    echo $namespace
                        . str_repeat(' ', (38 - strlen($namespace)));
                } else {
                    echo $namespace . PHP_EOL;
                    echo str_repeat(' ', 40);
                }
                echo $extension
                    . str_repeat(' ', (18 - strlen($extension)));
                echo $versions
                    . str_repeat(' ', (16 - strlen($versions)));
                echo str_repeat(
                    ' ', (5 - strlen((string) $items[$namespace]['uses']))
                );
                echo $items[$namespace]['uses'] . PHP_EOL;

                if ($filename) {
                    foreach ($items[$namespace]['sources'] as $source) {
                        echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                    }
                }

                if ($items[$namespace]['excluded']) {
                    continue;
                }

                $this->updateVersion(
                    $items[$namespace]['versions'][0], $this->globalVersions[0]
                );
                $this->updateVersion(
                    $items[$namespace]['versions'][1], $this->globalVersions[1]
                );
            }
        }
    }

}
