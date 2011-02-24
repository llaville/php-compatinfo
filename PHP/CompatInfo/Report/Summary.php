<?php
/**
 * Summary report
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
 * Summary report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Summary extends PHP_CompatInfo_Report
{
    /**
     * Prints a summary report with count of extensions, interfaces, classes,
     * functions and constants, for each file of the data source
     *
     * @param array  $report Report data to produce
     * @param string $base   Base directory of data source
     *
     * @return void
     */
    public function generate($report, $base)
    {
        $width = 79;
        $globalVersions = array('4.0.0', '');

        echo PHP_EOL;
        echo 'PHP COMPAT INFO REPORT SUMMARY' . PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        echo 'FILES' . str_repeat(' ', ($width - 54))
            . 'EXTENSIONS INTERFACES CLASSES FUNCTIONS CONSTANTS'.PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        if ($base) {
            echo 'BASE: ' . $base . PHP_EOL;
        }

        $count = array(
            'extensions' => array(),
            'interfaces' => array(),
            'classes'    => array(),
            'functions'  => array(),
            'constants'  => array(),
        );
        $ccn           = 0;
        $currentFolder = '';

        foreach ($report as $filename => $elements) {
            if (dirname($filename) !== $currentFolder) {
                $currentFolder = dirname($filename);
                echo str_repeat('-', $width).PHP_EOL;
                echo str_replace($base, 'DIR.: ', $currentFolder) . PHP_EOL;
            }

            $extensions = 0;
            $interfaces = 0;
            $classes    = 0;
            $functions  = 0;
            $constants  = 0;

            foreach ($elements as $element => $data) {
                switch ($element) {
                case 'extensions':
                    $values = array_keys($data);
                    foreach ($values as $key) {
                        $count[$element][] = $key;
                    }
                    $$element += count($values);
                    break;
                case 'interfaces':
                case 'classes':
                case 'functions':
                case 'constants':
                    foreach ($data as $category => $items) {
                        $values = array_keys($items);
                        foreach ($values as $key) {
                            $count[$element][] = $key;
                        }
                        $$element += count($values);
                    }
                    break;
                case 'versions':
                    $this->updateVersion(
                        $data[0], $globalVersions[0]
                    );
                    $this->updateVersion(
                        $data[1], $globalVersions[1]
                    );
                    break;
                case 'conditions':
                    $ccn = $ccn | $this->getCCN($data);
                    break;
                default:
                    continue 2;
                }
            }

            $fn = basename($filename);
            if (strlen($fn) < 30) {
                echo $fn
                    . str_repeat(' ', (30 - strlen($fn)));
            } else {
                echo $fn . PHP_EOL;
                echo str_repeat(' ', 30);
            }
            echo str_repeat(' ', ( 9 - strlen((string) $extensions)))
                . $extensions;
            echo str_repeat(' ', (11 - strlen((string) $interfaces)))
                . $interfaces;
            echo str_repeat(' ', ( 8 - strlen((string) $classes)))
                . $classes;
            echo str_repeat(' ', (10 - strlen((string) $functions)))
                . $functions;
            echo str_repeat(' ', (10 - strlen((string) $constants)))
                . $constants;
            echo PHP_EOL;
        }

        if (count($report) > 0) {
            echo str_repeat('-', $width).PHP_EOL;
            echo 'A TOTAL OF ' . PHP_EOL . ' ';
            foreach (array_keys($count) as $category) {
                $$category = count(array_count_values($count[$category]));

                if ($$category > 0) {
                    echo $$category . ' '
                        . strtoupper(substr($category, 0, -1)) . '(S) ';
                }
            }
            echo PHP_EOL;
            echo 'WERE FOUND IN '.count($report).' FILE(S)'.PHP_EOL;
            if ($ccn > 0) {
                echo 'WITH CONDITIONAL CODE LEVEL ' . $ccn . PHP_EOL;
            }
            echo 'REQUIRED PHP ' . $globalVersions[0] .  ' (MIN) ';
            if (!empty($globalVersions[1])) {
                echo $globalVersions[1] . ' (MAX)';
            }
            echo PHP_EOL;
        }
        echo str_repeat('-', $width).PHP_EOL;
        echo PHP_Timer::resourceUsage() . PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        echo PHP_EOL;
    }
}
