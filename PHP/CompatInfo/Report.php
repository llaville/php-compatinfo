<?php
/**
 * Base class to produce report of type requested
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */


/**
 * Abstract base class of each report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
abstract class PHP_CompatInfo_Report extends PHP_CompatInfo_Filter
{
    /**
     * @var int Report character width (default to 79)
     */
    protected $width = 79;

    /**
     * @var array PHP Minimum and Maximum versions
     */
    protected $globalVersions;

    /**
     * @var int Total of elements excluded from scope due to rulesets
     */
    protected $totalExcludes;

    /**
     * @var int Total of elements excluded from scope due to code conditions
     */
    protected $totalConditions;

    /**
     * @var array Elements found on scope
     */
    protected $total;

    /**
     * @var string Type of report requested
     */
    protected $typeReport;

    /**
     * Class constructor for each report
     *
     * @param string $source   Data source
     * @param array  $options  Options for parser
     * @param array  $warnings List of warning messages already produced
     * @param array  $report   (optional) Parse results (full or combined reports)
     */
    public function __construct($source, $options, $warnings, $report = null)
    {
        $base = realpath($source);

        self::$filterVersion  = $options['filterVersion'];
        self::$filterOperator = $options['filterOperator'];

        $reportMapping = array(
            'PHP_CompatInfo_Report_Class' => array(
                'short' => 'class', 'long'  => 'classes'
            ),
            'PHP_CompatInfo_Report_Condition' => array(
                'short' => 'condition', 'long'  => 'functions'
            ),
            'PHP_CompatInfo_Report_Constant' => array(
                'short' => 'constant', 'long'  => 'constants'
            ),
            'PHP_CompatInfo_Report_Extension' => array(
                'short' => 'extension', 'long'  => 'extensions'
            ),
            'PHP_CompatInfo_Report_Function' => array(
                'short' => 'function', 'long'  => 'functions'
            ),
            'PHP_CompatInfo_Report_Global' => array(
                'short' => 'global', 'long'  => 'globals'
            ),
            'PHP_CompatInfo_Report_Interface' => array(
                'short' => 'interface', 'long'  => 'interfaces'
            ),
            'PHP_CompatInfo_Report_Namespace' => array(
                'short' => 'namespace', 'long'  => 'namespaces'
            ),
            'PHP_CompatInfo_Report_Summary' => array(
                'short' => '', 'long'  => ''
            ),
            'PHP_CompatInfo_Report_Token' => array(
                'short' => 'token', 'long'  => 'tokens'
            ),
            'PHP_CompatInfo_Report_Trait' => array(
                'short' => 'trait', 'long'  => 'traits'
            ),
            'PHP_CompatInfo_Report_Xml' => array(
                'short' => '', 'long'  => ''
            ),
        );
        $this->typeReport = $reportMapping[get_class($this)];

        if (isset($options['reportFile'])) {
            ob_start();
        }

        if (!empty($report)) {
            $this->generate($report, $base, $options['verbose']);
        }

        if (isset($options['reportFile'])) {
            $generatedReport = ob_get_clean();

            file_put_contents(
                $options['reportFile'], $generatedReport,
                $options['reportFileFlags']
            );
        }
    }

    /**
     * Returns conditional code number
     *
     * @param array $conditions Conditional code uses
     *
     * @return int
     */
    protected function getCCN($conditions)
    {
        $ccn = 0;

        foreach ($conditions as $category => $count) {
            if ($count > 0) {
                switch ($category) {
                case 'function_exists':
                    $ccn = $ccn | 1;
                    break;
                case 'extension_loaded':
                    $ccn = $ccn | 2;
                    break;
                case 'defined':
                    $ccn = $ccn | 4;
                    break;
                case 'method_exists':
                    $ccn = $ccn | 16;
                    break;
                case 'class_exists':
                    $ccn = $ccn | 32;
                    break;
                case 'interface_exists':
                    $ccn = $ccn | 64;
                    break;
                case 'trait_exists':
                    $ccn = $ccn | 128;
                    break;
                }
            }
        }
        return $ccn;
    }

    /**
     * Update the base version if current ref version is greater
     *
     * @param string $current Current version
     * @param string &$base   Base version
     *
     * @return void
     */
    protected function updateVersion($current, &$base)
    {
        if (version_compare($current, $base, 'gt')) {
            $base = $current;
        }
    }

    /**
     * Prints a report to produce results of type
     * reference, extension, interface, class, trait, function, constant
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

            $elements = $report[$this->typeReport['long']];

            $this->total           = array();
            $this->totalExcludes   = 0;
            $this->totalConditions = 0;
            $this->globalVersions  = array('4.0.0', '');

            $this->printTHead($base, false);
            $this->printTBody($elements, ($verbose == 2), $base);
            $this->printTFoot();

        } else {
            // group by files report

            foreach ($report as $filename => $elements) {
                $this->total           = array();
                $this->totalExcludes   = 0;
                $this->totalConditions = 0;
                $this->globalVersions  = array('4.0.0', '');

                $this->printTHead($base, $filename);
                $this->printTBody($elements[$this->typeReport['long']], false, $base);
                $this->printTFoot();
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
    protected function printTHead($base, $filename)
    {
        $label = strtoupper($this->typeReport['short']);

        echo PHP_EOL;
        echo 'BASE: ' . $base . PHP_EOL;
        echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
        echo str_repeat('-', $this->width)   . PHP_EOL;
        echo 'PHP COMPAT INFO ' . $label . ' SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)   . PHP_EOL;
        echo '  ' . $label . str_repeat(' ', (38 - strlen($label)))
            . 'EXT min/Max' . str_repeat(' ', ($this->width - 72))
            . 'PHP min/Max' . str_repeat(' ', ($this->width - 74))
            . 'COUNT' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints footer of report
     *
     * @return void
     */
    protected function printTFoot()
    {
        $total  = count($this->total);
        $length = strcasecmp($this->typeReport['long'], 'classes') == 0 ? -2 : -1;

        echo str_repeat('-', $this->width).PHP_EOL;
        echo 'A TOTAL OF ' . $total
            . ' ' . substr(strtoupper($this->typeReport['long']), 0, $length)
            . ($total > 1 ? ($length == -2 ? 'E' : '') . 'S WERE' : ' WAS')
            . ' FOUND';
        if ($this->totalExcludes > 0 || $this->totalConditions > 0) {
            echo PHP_EOL . 'WITH ';
        }
        if ($this->totalExcludes > 0) {
            echo $this->totalExcludes . ' EXCLUDED FROM PARSING';
        }
        if ($this->totalConditions > 0) {
            if ($this->totalExcludes > 0) {
                echo ', ';
            }
            echo $this->totalConditions . ' EXCLUDED ON CONDITIONAL CODE';
        }
        echo PHP_EOL;
        if ($total > 0
            && get_class($this) !== 'PHP_CompatInfo_Report_Reference'
        ) {
            echo 'REQUIRED PHP ' . $this->globalVersions[0] .  ' (MIN) ';
            if (!empty($this->globalVersions[1])) {
                echo $this->globalVersions[1] . ' (MAX)';
            }
            echo PHP_EOL;
        }
        $this->printResourceUsage();
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints body of report
     *
     * @param array  $elements List of element to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    protected function printTBody($elements, $filename, $base)
    {
        self::applyFilter($elements);

        ksort($elements);

        foreach ($elements as $category => $items) {
            $keys = array_keys($items);
            $this->total = array_merge($this->total, $keys);

            asort($keys);
            foreach ($keys as $key) {
                if ($items[$key]['excluded'] === true) {
                    echo 'E';
                    $this->totalExcludes++;
                } elseif ($items[$key]['excluded'] === '1') {
                    echo 'C';
                    $this->totalConditions++;
                } else {
                    echo ' ';
                }
                if ('user' == $category) {
                    $extension = '';
                } elseif('global' === $this->typeReport['short']) {
                    $extension = $category;
                } else {
                    $extension = $category;
                    if (!empty($items[$key]['versions'][2])) {
                        $extension .= '-' . $items[$key]['versions'][2];
                    }
                    if (!empty($items[$key]['versions'][3])) {
                        $extension .= '/' . $items[$key]['versions'][3];
                    }
                }
                $versions = $items[$key]['versions'][0];
                if (!empty($items[$key]['versions'][1])) {
                    $versions .= '/' . $items[$key]['versions'][1];
                }
                echo ' ';
                if (!isset($items[$key]['namespace']) || $items[$key]['namespace'] == '\\') {
                    $fullName = $key;
                } else {
                    $fullName = $items[$key]['namespace'] . "\\" . $key;
                }
                if (strlen($fullName) < 38) {
                    echo $fullName
                        . str_repeat(' ', (38 - strlen($fullName)));
                } else {
                    echo $fullName . PHP_EOL;
                    echo str_repeat(' ', 40);
                }
                if (strlen($extension) < 18) {
                    echo $extension
                        . str_repeat(' ', (18 - strlen($extension)));
                } else {
                    echo $extension . PHP_EOL
                        . str_repeat(' ', 40);
                }
                echo $versions
                    . str_repeat(' ', (16 - strlen($versions)));
                echo str_repeat(
                    ' ', (5 - strlen((string) $items[$key]['uses']))
                );
                echo $items[$key]['uses'] . PHP_EOL;

                if ($filename) {
                    foreach ($items[$key]['sources'] as $source) {
                        echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                    }
                }

                if ($items[$key]['excluded']) {
                    continue;
                }

                $this->updateVersion(
                    $items[$key]['versions'][0], $this->globalVersions[0]
                );
                $this->updateVersion(
                    $items[$key]['versions'][1], $this->globalVersions[1]
                );
            }
        }
    }

    /**
     * Prints the resources (time, memory) usage
     *
     * @return void
     */
    protected function printResourceUsage()
    {
        if (class_exists('PHP_Timer', true) === true) {
            echo str_repeat('-', $this->width) . PHP_EOL;
            echo PHP_Timer::resourceUsage()    . PHP_EOL;
        }
    }

}
