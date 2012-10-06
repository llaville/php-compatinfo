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

            $extensions = $report['extensions'];

            $this->total           = array();
            $this->totalExcludes   = 0;
            $this->totalConditions = 0;
            $this->globalVersions  = array('4.0.0', '');

            $this->printTHeader($base, false, $extensions);
            $this->printTBody($extensions, ($verbose == 2), $base);
            $this->printTFoot();

        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total           = array();
                $this->totalExcludes   = 0;
                $this->totalConditions = 0;
                $this->globalVersions  = array('4.0.0', '');

                $this->printTHeader($base, $filename, $elements['extensions']);
                $this->printTBody($elements['extensions'], false, $base);
                $this->printTFoot();
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
    protected function printTHeader($base, $filename, $extensions)
    {
        echo PHP_EOL;
        echo 'BASE: ' . $base . PHP_EOL;
        if ($filename) {
            echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
        }
        echo str_repeat('-', $this->width)       . PHP_EOL;
        echo 'PHP COMPAT INFO EXTENSION SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)       . PHP_EOL;
        echo '  EXTENSION' . str_repeat(' ', ($this->width - 50))
            . 'VERSION' . str_repeat(' ', ($this->width - 68))
            . 'PHP min/Max' . str_repeat(' ', ($this->width - 74))
            . 'COUNT' . PHP_EOL;
        echo str_repeat('-', $this->width)       . PHP_EOL;

        $keys = array_keys($extensions);
        $this->total = array_merge($this->total, $keys);
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
    protected function printTBody($elements, $filename, $base)
    {
        $results = array('_dummy_' => $elements);
        self::applyFilter($results);
        $elements = $results['_dummy_'];

        ksort($elements);

        foreach ($elements as $extension => $items) {
            if ($items['excluded'] === true) {
                echo 'E';
                $this->totalExcludes++;
            } elseif ($items['excluded'] === '1') {
                echo 'C';
                $this->totalConditions++;
            } else {
                echo ' ';
            }

            $extVersions = $items['versions'][2];
            if (isset($items['versions'][3])) {
                $extVersions .= '/' . $items['versions'][3];
            }
            $versions = $items['versions'][0];
            if (!empty($items['versions'][1])) {
                $versions .= '/' . $items['versions'][1];
            }

            echo ' ';
            if (strlen($extension) < 38) {
                echo $extension
                    . str_repeat(' ', (38 - strlen($extension)));
            } else {
                echo $extension . PHP_EOL;
                echo str_repeat(' ', 40);
            }

            echo $extVersions
                . str_repeat(' ', (18 - strlen($extVersions)));

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
