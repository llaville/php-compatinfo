<?php
/**
 * Function report
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/CompatInfo/Report.php';

class PHP_CompatInfo_Report_Function extends PHP_CompatInfo_Report
{
    /**
     * Prints a function report
     *
     * @param array  $report Report data to produce
     * @param string $base   Base directory of data source
     *
     * @return void
     */
    public function generate($report, $base)
    {
        $width = 79;

        foreach ($report as $filename => $elements) {
            $total          = array();
            $totalExcludes  = 0;
            $globalVersions = array('4.0.0', '');

            echo PHP_EOL;
            echo 'BASE: ' . $base . PHP_EOL;
            echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo 'PHP COMPAT INFO FUNCTION SUMMARY' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo '  FUNCTION' . str_repeat(' ', ($width - 49))
                . 'EXTENSION' . str_repeat(' ', ($width - 70))
                . 'VERSION' . str_repeat(' ', ($width - 70))
                . 'COUNT' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;

            foreach ($elements['functions'] as $category => $items) {
                $functions = array_keys($items);
                $total = array_merge($total, $functions);

                asort($functions);
                foreach ($functions as $function) {
                    if ($items[$function]['excluded']) {
                        echo 'E';
                        $totalExcludes++;
                    } else {
                        echo ' ';
                    }
                    if ('user' == $category) {
                        $extension = '';
                    } else {
                        $extension = $category;
                    }
                    $versions = implode('  ', $items[$function]['versions']);
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
                    echo str_repeat(' ', (5 - strlen((string) $items[$function]['uses'])))
                        . $items[$function]['uses'] . PHP_EOL;

                    if ($items[$function]['excluded']) {
                        continue;
                    }

                    if (version_compare(
                        $items[$function]['versions'][0],
                        $globalVersions[0],
                        'gt')
                    ) {
                        $globalVersions[0] = $items[$function]['versions'][0];
                    }
                    if (version_compare(
                        $items[$function]['versions'][1],
                        $globalVersions[1],
                        'gt')
                    ) {
                        $globalVersions[1] = $items[$function]['versions'][1];
                    }

                }
            }

            echo str_repeat('-', $width).PHP_EOL;
            echo 'A TOTAL OF ' . count($total) .' FUNCTION(S) WERE FOUND';
            if ($totalExcludes > 0) {
                echo ' AND ' . $totalExcludes . ' EXCLUDED FROM PARSING';
            }
            echo PHP_EOL;
            $ccn = $this->getCCN($elements['conditions']);
            if ($ccn > 0) {
                echo 'WITH CONDITIONAL CODE LEVEL ' . $ccn . PHP_EOL;
            }
            if (count($total) > 0) {
                echo 'REQUIRED PHP ' . $globalVersions[0] .  ' (MIN) ';
                if (!empty($globalVersions[1])) {
                    echo $globalVersions[1] . ' (MAX)';
                }
                echo PHP_EOL;
            }
            echo str_repeat('-', $width).PHP_EOL;
            echo PHP_Timer::resourceUsage() . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
        }
        echo PHP_EOL;
    }
}
