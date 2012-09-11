<?php
/**
 * Reference report
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
 * Reference report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Reference extends PHP_CompatInfo_Report
{
    /**
     * @var string
     */
    private $_list;

    /**
     * Class constructor of reference report
     *
     * @param string $source   Data source
     * @param array  $options  Options for parser
     * @param array  $warnings List of warning messages already produced
     */
    public function __construct($source, $options, $warnings)
    {
        $referenceClassName = 'PHP_CompatInfo_Reference_' . $options['reference'];

        if (!class_exists($referenceClassName, true)) {
            throw new PHP_CompatInfo_Exception(
                'Reference type "' . $options['reference'] . '" not found.'
            );
        }

        $extensions = $extension = $options['_filter']['extension'];
        if (!is_null($extension)) {
            if ('all' == $extension ) {
                $extension = null;
            } else {
                // filter on a unique extension
                $extensions = array($extension);
            }
        }
        $version = $options['_filter']['version'];
        if (!is_null($version)) {
            if (substr($version, 0, 4) == 'php_') {
                // filter extension on PHP version
                $version   = substr($version, 4);
                $extension = null;
            } else {
                $extension = true;
            }
        }
        $condition = $options['_filter']['condition'];

        if ($extension !== true) {
            // filter on PHP versions
            if ($version === '4') {
                $version = '5.0.0';
                if (is_null($condition)) {
                    $condition = 'lt';
                } else {
                    $version = '4.0.0';
                }
            }
            if ($version === '5') {
                $version = '5.0.0';
                if (is_null($condition)) {
                    $condition = 'ge';
                }
            }
        }

        $reference = new $referenceClassName($extensions);
        $report    = $reference->getAll($extension, $version, $condition);

        if (isset($options['reportFile'])) {
            ob_start();
        }

        $this->_list = $source;
        $this->generate($report, false, $options['verbose']);

        if (is_array($warnings)) {
            $warnings = array_merge($warnings, $reference->getWarnings());
        } else {
            $warnings = $reference->getWarnings();
        }

        if (count($warnings) > 0 && $options['verbose'] > 0) {
            echo 'Warning messages : (' . count($warnings) . ')' . PHP_EOL;
            echo PHP_EOL;
            foreach ($warnings as $warning) {
                echo '  ' . $warning . PHP_EOL;
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
     * Prints a reference report about extensions, interfaces, classes,
     * functions or constants defined in the data dictionary
     *
     * @param array  $report  Report data to produce
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    public function generate($report, $base, $verbose)
    {
        $listUC = strtoupper($this->_list);

        echo PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'PHP COMPAT INFO ' . $listUC . ' REFERENCE' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo str_pad($listUC, 10)
            . str_repeat(' ', ($this->width - 44))
            . 'EXTENSION          PHP min/Max'  . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;

        $elements = $report[$this->_list];
        ksort($elements);

        foreach ($elements as $element => $data) {

            if ('extensions' == $this->_list) {
                $values    = $data;
                $extension = array_pop($values);
            } else {
                list ($extension, $values) = each($data);
            }
            if (isset($values['extVersions'])
                && is_array($values['extVersions'])
            ) {
                if (is_string($values['extVersions'][0])) {
                    // min extension version
                    $extension .= '-' . $values['extVersions'][0];
                }
                if (is_string($values['extVersions'][1])) {
                    // Max extension version
                    $extension .= '/' . $values['extVersions'][1];
                }
                unset($values['extVersions']);
            }

            $versions = $values[0];
            if (!empty($values[1])) {
                $versions .= '/' . $values[1];
            }

            echo $element
                . str_repeat(' ', (45 - strlen($element)));
            if (strlen($extension) < 18) {
                echo $extension
                    . str_repeat(' ', (19 - strlen($extension)));
            } else {
                echo $extension . PHP_EOL
                    . str_repeat(' ', 64);
            }
            echo $versions . PHP_EOL;
        }
        $total  = count($report[$this->_list]);
        $length = strcasecmp($this->_list, 'classes') == 0 ? -2 : -1;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'A TOTAL OF ' . $total . ' ' . substr($listUC, 0, $length)
            . ($total > 1 ? ($length == -2 ? 'E' : '') . 'S WERE' : ' WAS')
            . ' FOUND' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_Timer::resourceUsage()    . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_EOL;
    }
}
