<?php
/**
 * Token report
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
 * Token report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Token extends PHP_CompatInfo_Report
{
    /**
     * Prints a token (language features) report
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

            $tokens     = array();
            $conditions = array();

            foreach ($files as $filename) {
                foreach ($report[$filename]['tokens'] as $extension => $data) {
                    foreach ($data as $key => $values) {
                        if (!isset($tokens[$extension][$key])) {
                            $tokens[$extension][$key] = $values;
                        } else {
                            $tokens[$extension][$key]['uses']
                                += $values['uses'];
                            $tokens[$extension][$key]['sources'] = array_merge(
                                $tokens[$extension][$key]['sources'],
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
            $this->globalVersions = array('5.0.0', '');

            $this->printTHead($base, false);
            $this->printTBody($tokens, ($verbose == 2), $base);
            $this->printTFoot($conditions);
        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total          = array();
                $this->totalExcludes  = 0;
                $this->globalVersions = array('5.0.0', '');

                $this->printTHead($base, $filename);
                $this->printTBody($elements['tokens'], false, $base);
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
        echo str_repeat('-', $this->width)      . PHP_EOL;
        echo 'PHP COMPAT INFO TOKEN SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)      . PHP_EOL;
        echo '  TOKEN' . str_repeat(' ', ($this->width - 46))
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
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'A TOTAL OF ' . $total
            . ' TOKEN' . ($total > 1 ? 'S WERE' : ' WAS')
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
     * @param array  $elements List of token to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    private function printTBody($elements, $filename, $base)
    {
        ksort($elements);

        foreach ($elements as $category => $items) {
            $tokens = array_keys($items);
            $this->total = array_merge($this->total, $tokens);

            asort($tokens);
            foreach ($tokens as $token) {
                if ($items[$token]['excluded']) {
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
                $versions = implode('  ', $items[$token]['versions']);
                echo ' ';
                if (strlen($token) < 38) {
                    echo $token
                        . str_repeat(' ', (38 - strlen($token)));
                } else {
                    echo $token . PHP_EOL;
                    echo str_repeat(' ', 40);
                }
                echo $extension
                    . str_repeat(' ', (18 - strlen($extension)));
                echo $versions
                    . str_repeat(' ', (16 - strlen($versions)));
                echo str_repeat(
                    ' ', (5 - strlen((string) $items[$token]['uses']))
                );
                echo $items[$token]['uses'] . PHP_EOL;

                if ($filename) {
                    foreach ($items[$token]['sources'] as $source) {
                        echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                    }
                }

                if ($items[$token]['excluded']) {
                    continue;
                }

                $this->updateVersion(
                    $items[$token]['versions'][0], $this->globalVersions[0]
                );
                $this->updateVersion(
                    $items[$token]['versions'][1], $this->globalVersions[1]
                );
            }
        }
    }

}
