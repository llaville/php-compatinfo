<?php
/**
 * Class report
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
 * Class report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Class extends PHP_CompatInfo_Report
{
    /**
     * Prints a class report
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

            $classes    = array();
            $conditions = array();

            foreach ($files as $filename) {
                foreach ($report[$filename]['classes'] as $extension => $data) {
                    foreach ($data as $key => $values) {
                        if (!isset($classes[$extension][$key])) {
                            $classes[$extension][$key] = $values;
                        } else {
                            $classes[$extension][$key]['uses']
                                += $values['uses'];
                            $classes[$extension][$key]['sources'] = array_merge(
                                $classes[$extension][$key]['sources'],
                                $values['sources']
                            );
                        }
                    }
                }
                foreach ($report[$filename]['conditions'] as $key => $values) {
                    if (!isset($conditions[$key])) {
                        $conditions[$key] = $values;
                    }
                }
            }

            $this->total          = array();
            $this->totalExcludes  = 0;
            $this->globalVersions = array('4.0.0', '');

            $this->printTHead($base, false);
            $this->printTBody($classes, ($verbose == 2), $base);
            $this->printTFoot($conditions);

        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total          = array();
                $this->totalExcludes  = 0;
                $this->globalVersions = array('4.0.0', '');

                $this->printTHead($base, $filename);
                $this->printTBody($elements['classes'], false, $base);
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
        echo 'PHP COMPAT INFO CLASS SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)   . PHP_EOL;
        echo '  CLASS' . str_repeat(' ', ($this->width - 46))
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
        echo str_repeat('-', $this->width).PHP_EOL;
        echo 'A TOTAL OF ' . count($this->total) . ' CLASS(S) WERE FOUND';
        if ($this->totalExcludes > 0) {
            echo ' AND ' . $this->totalExcludes . ' EXCLUDED FROM PARSING';
        }
        echo PHP_EOL;
        $ccn = $this->getCCN($conditions);
        if ($ccn > 0) {
            echo 'WITH CONDITIONAL CODE LEVEL ' . $ccn . PHP_EOL;
        }
        if (count($this->total) > 0) {
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
     * @param array  $elements List of class to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    private function printTBody($elements, $filename, $base)
    {
        ksort($elements);

        foreach ($elements as $category => $items) {
            $classes = array_keys($items);
            $this->total = array_merge($this->total, $classes);

            asort($classes);
            foreach ($classes as $class) {
                if ($items[$class]['excluded']) {
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
                $versions = implode('  ', $items[$class]['versions']);
                echo ' ';
                if (strlen($class) < 38) {
                    echo $class
                        . str_repeat(' ', (38 - strlen($class)));
                } else {
                    echo $class . PHP_EOL;
                    echo str_repeat(' ', 40);
                }
                echo $extension
                    . str_repeat(' ', (18 - strlen($extension)));
                echo $versions
                    . str_repeat(' ', (16 - strlen($versions)));
                echo str_repeat(
                    ' ', (5 - strlen((string) $items[$class]['uses']))
                );
                echo $items[$class]['uses'] . PHP_EOL;

                if ($filename) {
                    foreach ($items[$class]['sources'] as $source) {
                        echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                    }
                }

                if ($items[$class]['excluded']) {
                    continue;
                }

                $this->updateVersion(
                    $items[$class]['versions'][0], $this->globalVersions[0]
                );
                $this->updateVersion(
                    $items[$class]['versions'][1], $this->globalVersions[1]
                );
            }
        }
    }

}
