<?php
/**
 * Extension report
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/CompatInfo/Report.php';

class PHP_CompatInfo_Report_Extension extends PHP_CompatInfo_Report
{
    /**
     * Prints an extension report
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
            echo 'PHP COMPAT INFO EXTENSION SUMMARY' . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo '  EXTENSION' . str_repeat(' ', ($width - 39))
                . 'PECL   VERSION         COUNT'.PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;

            $extensions = array_keys($elements['extensions']);
            $total = array_merge($total, $extensions);

            foreach ($elements['extensions'] as $extension => $items) {
                if ($items['excluded']) {
                    echo 'E';
                    $totalExcludes++;
                } else {
                    echo ' ';
                }

                $extVersion = array_pop($items['versions']);

                $versions = implode('  ', $items['versions']);
                echo ' ';
                echo $extension;
                if (!empty($extVersion)) {
                    echo str_repeat(' ', (54 - strlen($extension) - strlen($extVersion)));
                    echo $extVersion . '  ';
                } else {
                    echo str_repeat(' ', (56 - strlen($extension)));
                }
                echo $versions
                    . str_repeat(' ', (16 - strlen($versions)));
                echo str_repeat(' ', (5 - strlen('1'))) . '1' . PHP_EOL;

                if ($items['excluded']) {
                    continue;
                }

                if (version_compare(
                    $items['versions'][0],
                    $globalVersions[0],
                    'gt')
                ) {
                    $globalVersions[0] = $items['versions'][0];
                }
                if (version_compare(
                    $items['versions'][1],
                    $globalVersions[1],
                    'gt')
                ) {
                    $globalVersions[1] = $items['versions'][1];
                }

            }

            echo str_repeat('-', $width).PHP_EOL;
            echo 'A TOTAL OF ' . count($total) .' EXTENSION(S) WERE FOUND';
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
