<?php
/**
 * Extension report
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
 * Extension report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Extension extends PHP_CompatInfo_Report
{
    /**
     * Prints an extension report
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

            $extensions = array();
            $conditions = array();

            foreach ($files as $filename) {
                foreach ($report[$filename]['extensions'] as $key => $values) {
                    if (!isset($extensions[$key])) {
                        $extensions[$key] = $values;
                    } else {
                        $extensions[$key]['uses'] += $values['uses'];
                        $extensions[$key]['sources'] = array_merge(
                            $extensions[$key]['sources'],
                            $values['sources']
                        );
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

            $this->printTHead($base, false, $extensions);
            $this->printTBody($extensions, ($verbose == 2), $base);
            $this->printTFoot($conditions);

        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total    = array();
                $this->totalExcludes  = 0;
                $this->globalVersions = array('4.0.0', '');

                $this->printTHead($base, $filename, $elements['extensions']);
                $this->printTBody($elements['extensions'], false, $base);
                $this->printTFoot($elements['conditions']);
            }
        }
        echo PHP_EOL;
    }

    /**
     * Prints header of report
     *
     * @param string $base       Base directory of data source
     * @param string $filename   Current file
     * @param array  $extensions List of extensions to print
     *
     * @return void
     */
    private function printTHead($base, $filename, $extensions)
    {
        echo PHP_EOL;
        echo 'BASE: ' . $base . PHP_EOL;
        if ($filename) {
            echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
        }
        echo str_repeat('-', $this->width)       . PHP_EOL;
        echo 'PHP COMPAT INFO EXTENSION SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)       . PHP_EOL;
        echo '  EXTENSION' . str_repeat(' ', ($this->width - 39))
            . 'PECL   VERSION         COUNT'     . PHP_EOL;
        echo str_repeat('-', $this->width)       . PHP_EOL;

        $keys = array_keys($extensions);
        $this->total = array_merge($this->total, $keys);
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
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'A TOTAL OF ' . count($this->total) .' EXTENSION(S) WERE FOUND';
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
     * @param array  $elements List of extensions to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    private function printTBody($elements, $filename, $base)
    {
        ksort($elements);

        foreach ($elements as $extension => $items) {
            if ($items['excluded']) {
                echo 'E';
                $this->totalExcludes++;
            } else {
                echo ' ';
            }

            $extVersion = array_pop($items['versions']);

            $versions = implode('  ', $items['versions']);
            echo ' ';
            echo $extension;
            if (!empty($extVersion)) {
                echo str_repeat(
                    ' ', (54 - strlen($extension) - strlen($extVersion))
                );
                echo $extVersion . '  ';
            } else {
                echo str_repeat(' ', (56 - strlen($extension)));
            }
            echo $versions
                . str_repeat(' ', (16 - strlen($versions)));
            echo str_repeat(' ', (5 - strlen($items['uses']))) . $items['uses']
                . PHP_EOL;

            if ($filename) {
                foreach ($items['sources'] as $source) {
                    echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                }
            }

            if ($items['excluded']) {
                continue;
            }

            $this->updateVersion(
                $items['versions'][0], $this->globalVersions[0]
            );
            $this->updateVersion(
                $items['versions'][1], $this->globalVersions[1]
            );
        }
    }

}
