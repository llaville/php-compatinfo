<?php
/**
 * Interface report
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

require_once 'PHP/CompatInfo/Report.php';

/**
 * Interface report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Interface extends PHP_CompatInfo_Report
{
    /**
     * Prints an interface report
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
            echo 'PHP COMPAT INFO INTERFACE SUMMARY' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo '  INTERFACE' . str_repeat(' ', ($width - 50))
                . 'EXTENSION' . str_repeat(' ', ($width - 70))
                . 'VERSION' . str_repeat(' ', ($width - 70))
                . 'COUNT' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;

            foreach ($elements['interfaces'] as $category => $items) {
                $interfaces = array_keys($items);
                $total = array_merge($total, $interfaces);

                asort($interfaces);
                foreach ($interfaces as $interface) {
                    if ($items[$interface]['excluded']) {
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
                    $versions = implode('  ', $items[$interface]['versions']);
                    echo ' ';
                    if (strlen($interface) < 38) {
                        echo $interface
                            . str_repeat(' ', (38 - strlen($interface)));
                    } else {
                        echo $interface . PHP_EOL;
                        echo str_repeat(' ', 40);
                    }
                    echo $extension
                        . str_repeat(' ', (18 - strlen($extension)));
                    echo $versions
                        . str_repeat(' ', (16 - strlen($versions)));
                    echo str_repeat(
                        ' ', (5 - strlen((string) $items[$interface]['uses']))
                    );
                    echo $items[$interface]['uses'] . PHP_EOL;

                    if ($items[$interface]['excluded']) {
                        continue;
                    }

                    $this->updateVersion(
                        $items[$interface]['versions'][0], $globalVersions[0]
                    );
                    $this->updateVersion(
                        $items[$interface]['versions'][1], $globalVersions[1]
                    );
                }
            }

            echo str_repeat('-', $width).PHP_EOL;
            echo 'A TOTAL OF ' . count($total) .' INTERFACE(S) WERE FOUND';
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
