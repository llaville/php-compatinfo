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
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/Timer.php';

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
abstract class PHP_CompatInfo_Report
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
     * @var array Elements found on scope
     */
    protected $total;

    /**
     * Class constructor for each report
     *
     * @param string $source   Data source
     * @param array  $options  Options for parser
     * @param array  $warnings List of warning messages already produced
     */
    public function __construct($source, $options, $warnings)
    {
        $pci = new PHP_CompatInfo($options);
        if ($pci->parse($source) === true) {
            $report = $pci->toArray();
            $base   = realpath($source);
            if (is_file($base)) {
                $base = dirname($base);
            }
        } else {
            $report = array();
            $base   = false;
        }

        $allWarnings = array_unique(
            array_merge($warnings, $pci->getWarnings())
        );

        if (isset($options['reportFile'])) {
            ob_start();
        }

        $this->generate($report, $base, $options['verbose']);

        if (isset($options['reportFile'])) {
            $generatedReport = ob_get_clean();

            file_put_contents(
                $options['reportFile'], $generatedReport,
                $options['reportFileFlags']
            );
        }

        if (count($allWarnings) > 0 && $options['verbose'] > 0) {
            echo 'Warning messages : (' . count($allWarnings) . ')' . PHP_EOL;
            echo PHP_EOL;
            foreach ($allWarnings as $warn) {
                if (in_array($warn, $warnings)) {
                    // other listeners need to be notifed about console warnings
                    $pci->addWarning($warn);
                }
                echo '  ' . $warn . PHP_EOL;
            }
        }
    }

    /**
     * Abstract function to implement on each report to produce results of type
     * reference, extension, interface, class, function, constant
     *
     * @param array  $report  Report data to produce
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    abstract public function generate($report, $base, $verbose);

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

}
