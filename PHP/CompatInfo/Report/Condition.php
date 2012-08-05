<?php
/**
 * Condition report
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
 * Condition report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Condition extends PHP_CompatInfo_Report
{
    /**
     * Prints a Condition report
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

            $files = array_keys($report);

            $functions  = array();
            $conditions = array();

            foreach ($files as $filename) {
                foreach ($report[$filename]['functions'] as $extension => $data) {
                    foreach ($data as $key => $values) {
                        if (!isset($functions[$extension][$key])) {
                            $functions[$extension][$key] = $values;
                        } else {
                            $functions[$extension][$key]['uses']
                                += $values['uses'];
                            $functions[$extension][$key]['sources'] = array_merge(
                                $functions[$extension][$key]['sources'],
                                $values['sources']
                            );
                        }
                    }
                }
            }

            $this->total          = array();
            $this->totalExcludes  = 0;
            $this->globalVersions = array('4.0.0', '');

            $this->printTHead($base, false);
            $this->printTBody($functions, ($verbose == 2), $base);
            $this->printTFoot();

        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total          = array();
                $this->totalExcludes  = 0;
                $this->globalVersions = array('4.0.0', '');

                $this->printTHead($base, $filename);
                $this->printTBody($elements['functions'], false, $base);
                $this->printTFoot();
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
        echo str_repeat('-', $this->width)           . PHP_EOL;
        echo 'PHP COMPAT INFO CONDITION SUMMARY'     . PHP_EOL;
        echo str_repeat('-', $this->width)           . PHP_EOL;
        echo '  CONDITION' . str_repeat(' ', ($this->width - 50))
            . 'EXTENSION' . str_repeat(' ', ($this->width - 70))
            . 'VERSION' . str_repeat(' ', ($this->width - 70))
            . 'COUNT' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints footer of report
     *
     * @return void
     */
    private function printTFoot()
    {
        $total = count($this->total);
        echo str_repeat('-', $this->width).PHP_EOL;
        echo 'A TOTAL OF ' . $total
            . ' CONDITION' . ($total > 1 ? 'S WERE' : ' WAS')
            . ' FOUND';
        if ($this->totalExcludes > 0) {
            echo ' AND ' . $this->totalExcludes . ' EXCLUDED FROM PARSING';
        }
        echo PHP_EOL;
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
     * @param array  $elements List of function to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    private function printTBody($elements, $filename, $base)
    {
        if (!isset($elements['Core'])) {
            return;
        }

        $ccl = array(
            'function_exists',
            'extension_loaded',
            'defined',
            'method_exists',
            'class_exists',
            'interface_exists',
            'trait_exists',
        );
        $extension = 'Core';

        foreach ($elements['Core'] as $function => $data) {
            if (!in_array($function, $ccl)) {
                continue;
            }
            $this->total[] = $function;

            if ($data['excluded']) {
                echo 'E';
                $this->totalExcludes++;
            } else {
                echo ' ';
            }
            $versions = implode('  ', $data['versions']);
            echo ' ';
            if (strlen($function) < 38) {
                echo $function
                    . str_repeat(' ', (38 - strlen($function)));
            } else {
                echo $function . PHP_EOL;
                echo str_repeat(' ', 40);
            }
            echo $extension
                . str_repeat(' ', (18 - strlen($extension)));
            echo $versions
                . str_repeat(' ', (16 - strlen($versions)));
            echo str_repeat(
                ' ', (5 - strlen((string) $data['uses']))
            );
            echo $data['uses'] . PHP_EOL;

            if ($filename) {
                foreach ($data['sources'] as $source) {
                    echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                }
            }

            if ($data['excluded']) {
                continue;
            }

            $this->updateVersion(
                $data['versions'][0], $this->globalVersions[0]
            );
            $this->updateVersion(
                $data['versions'][1], $this->globalVersions[1]
            );

        }
    }

}
