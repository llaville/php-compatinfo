<?php
/**
 * Base classe to produce report of type requested
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/Timer.php';

abstract class PHP_CompatInfo_Report
{
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
        if ($pci->parse($source) === TRUE) {
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

        $this->generate($report, $base);

        if (count($allWarnings) > 0 && $options['verbose'] === TRUE) {
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

        if (isset($options['reportFile'])) {
            $generatedReport = ob_get_contents();
            ob_end_flush();

            file_put_contents(
                $options['reportFile'], $generatedReport,
                $options['reportFileFlags']
            );
        }
    }

    /**
     * Abstract function to implement on each report to produce results of type
     * reference, extension, interface, class, function, constant
     *
     * @param array  $report Report data to produce
     * @param string $base   Base directory of data source
     *
     * @return void
     */
    abstract public function generate($report, $base);

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
}
