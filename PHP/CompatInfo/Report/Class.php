<?php
/**
 * Class report
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/CompatInfo/Report.php';

class PHP_CompatInfo_Report_Class extends PHP_CompatInfo_Report
{
    /**
     * Prints a class report
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
            echo 'PHP COMPAT INFO CLASS SUMMARY' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo '  CLASS' . str_repeat(' ', ($width - 46))
                . 'EXTENSION' . str_repeat(' ', ($width - 70))
                . 'VERSION' . str_repeat(' ', ($width - 70))
                . 'COUNT' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;

            foreach ($elements['classes'] as $category => $items) {
                $classes = array_keys($items);
                $total = array_merge($total, $classes);

                asort($classes);
                foreach ($classes as $class) {
                    if ($items[$class]['excluded']) {
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
                    echo str_repeat(' ', (5 - strlen((string) $items[$class]['uses'])))
                        . $items[$class]['uses'] . PHP_EOL;

                    if ($items[$class]['excluded']) {
                        continue;
                    }

                    if (version_compare(
                        $items[$class]['versions'][0],
                        $globalVersions[0],
                        'gt')
                    ) {
                        $globalVersions[0] = $items[$class]['versions'][0];
                    }
                    if (version_compare(
                        $items[$class]['versions'][1],
                        $globalVersions[1],
                        'gt')
                    ) {
                        $globalVersions[1] = $items[$class]['versions'][1];
                    }
                }
            }

            echo str_repeat('-', $width).PHP_EOL;
            echo 'A TOTAL OF ' . count($total) .' CLASS(S) WERE FOUND';
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
