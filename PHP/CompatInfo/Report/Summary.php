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
     * Conditional Code number_format
     * @var int
     */
    protected $ccn;

    /**
     * Elements count group by category
     * @var array
     */
    protected $count;

    /**
     * Number of file in data source parsed
     * @var int
     */
    protected $filesCount;

    /**
     * Prints a summary report with count of extensions, interfaces, classes,
     * functions and constants, for each file of the data source
     *
     * @param array  $report  Report data to produce
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    public function generate($report, $base, $verbose)
    {
        $this->ccn            = 0;
        $this->total          = array();
        $this->totalExcludes  = 0;
        $this->globalVersions = array('4.0.0', '');

        $this->count = array(
            'extensions' => array(),
            'interfaces' => array(),
            'classes'    => array(),
            'functions'  => array(),
            'constants'  => array(),
        );

        $this->printTHead($base, $verbose);
        if ($verbose < 3) {

            $this->globalVersions = $report['versions'];
            $files                = array();

            foreach ($report as $element => $items) {
                switch ($element) {
                case 'extensions':
                    $values = array_keys($items);
                    foreach ($values as $key) {
                        $this->count[$element][] = $key;
                    }
                    break;
                case 'interfaces':
                case 'classes':
                case 'functions':
                case 'constants':
                    foreach ($items as $ext => $data) {
                        $values = array_keys($data);
                        foreach ($values as $key) {
                            $this->count[$element][] = $key;
                            $files = array_merge($files, $items[$ext][$key]['sources']);
                        }
                    }
                    break;
                case 'conditions':
                    $this->ccn = $this->ccn | $this->getCCN($items);
                    break;
                }
            }
            $files            = array_unique($files);
            $this->filesCount = count($files);

        } else {
            $this->printTBody($report, null, $base);
            $this->filesCount = count($report);
        }
        $this->printTFoot();
    }

    /**
     * Prints header of report
     *
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    protected function printTHead($base, $verbose)
    {
        echo PHP_EOL;
        echo str_repeat('-', $this->width)    . PHP_EOL;
        echo 'PHP COMPAT INFO REPORT SUMMARY' . PHP_EOL;
        if ($verbose < 3) {
            return;
        }
        echo str_repeat('-', $this->width)    . PHP_EOL;
        echo 'FILES' . str_repeat(' ', ($this->width - 54))
            . 'EXTENSIONS INTERFACES CLASSES FUNCTIONS CONSTANTS' . PHP_EOL;
        echo str_repeat('-', $this->width)    . PHP_EOL;
        if ($base) {
            echo 'BASE: ' . $base . PHP_EOL;
        }
    }

    /**
     * Prints footer of report
     *
     * @param int $filesCount Number of file parsed in report
     *
     * @return void
     */
    protected function printTFoot()
    {
        if ($this->filesCount > 0) {
            echo str_repeat('-', $this->width) . PHP_EOL;
            echo 'A TOTAL OF ' . PHP_EOL . ' ';
            foreach (array_keys($this->count) as $category) {
                $$category = count(array_count_values($this->count[$category]));

                if ($$category > 0) {
                    if ($category == 'classes') {
                        $length = -2;
                        $plural = 'ES';
                    } else {
                        $length = -1;
                        $plural = 'S';
                    }
                    echo $$category . ' '
                        . strtoupper(substr($category, 0, $length))
                        . ($$category > 1 ? $plural : '')
                        . ' ';
                }
            }
            echo PHP_EOL;
            echo 'WERE FOUND IN ' . $this->filesCount
                . ' FILE' . ($this->filesCount > 1 ? 'S' : '') . PHP_EOL;
            if ($this->ccn > 0) {
                echo 'WITH CONDITIONAL CODE LEVEL ' . $this->ccn . PHP_EOL;
            }
            echo 'REQUIRED PHP ' . $this->globalVersions[0] .  ' (MIN) ';
            if (!empty($this->globalVersions[1])) {
                echo $this->globalVersions[1] . ' (MAX)';
            }
            echo PHP_EOL;
        }
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_Timer::resourceUsage()    . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_EOL;
    }

    /**
     * Prints body of report
     *
     * @param array  $elements Elements of report
     * @param string $filename not used
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    protected function printTBody($report, $filename, $base)
    {
        $currentFolder = '';

        foreach ($report as $filename => $elements) {
            if (dirname($filename) !== $currentFolder) {
                $currentFolder = dirname($filename);
                echo str_repeat('-', $this->width).PHP_EOL;
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
                        $this->count[$element][] = $key;
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
                            $this->count[$element][] = $key;
                        }
                        $$element += count($values);
                    }
                    break;
                case 'versions':
                    $this->updateVersion(
                        $data[0], $this->globalVersions[0]
                    );
                    $this->updateVersion(
                        $data[1], $this->globalVersions[1]
                    );
                    break;
                case 'conditions':
                    $this->ccn = $this->ccn | $this->getCCN($data);
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
    }

}
