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
 * @version  GIT: $Id$
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

        $extensions = $options['filterReference'];

        if (isset($options['filterVersion'])) {
            self::$filterVersion = $options['filterVersion'];
        }
        $version = self::$filterVersion;

        if (isset($options['filterOperator'])) {
            self::$filterOperator = $options['filterOperator'];
        }
        $condition = self::$filterOperator;

        if (substr($version, 0, 4) == 'php_') {
            // filter references on PHP version
            $version   = substr($version, 4);
            $extension = null;
        } else {
            // filter references on EXT version
            $extension = true;
        }

        $reference = new $referenceClassName($extensions);
        $report    = $reference->getAll($extension, $version, $condition);

        if (isset($options['reportFile'])) {
            ob_start();
        }

        $length = strcasecmp($source, 'classes') == 0 ? -2 : -1;
        $this->typeReport = array(
            'short' => substr($source, 0, $length), 'long' => $source
        );
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
            $generatedReport = ob_get_clean();

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
        $this->totalExcludes = $this->totalConditions = 0;

        $this->total = $report[$this->typeReport['long']];

        $this->printTHead(null, null);
        $this->printTBody($this->total, null, null);
        $this->printTFoot();

        echo PHP_EOL;
    }

    /**
     * Prints header of report
     *
     * @param string $base     not used
     * @param string $filename not used
     *
     * @return void
     */
    protected function printTHead($base, $filename)
    {
        $label = strtoupper($this->typeReport['short']);

        if ('EXTENSION' === $label) {
            $extHeader = 'VERSION' . str_repeat(' ', ($this->width - 68));
        } else {
            $extHeader = 'EXT min/Max' . str_repeat(' ', ($this->width - 72));
        }

        echo PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'PHP COMPAT INFO ' . $label . ' REFERENCE' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo str_pad($label, 10)
            . str_repeat(' ', ($this->width - 49))
            . $extHeader
            . 'PHP min/Max' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints body of report
     *
     * @param array  $elements List of element to print
     * @param string $filename not used
     * @param string $base     not used
     *
     * @return void
     */
    protected function printTBody($elements, $filename, $base)
    {
        if ('extensions' == $this->typeReport['long']) {
            $results = array('_dummy_' => $elements);
            self::applyFilter($results);
            $elements = $results['_dummy_'];
        } else {
            self::applyFilter($elements);
        }
        $this->total = $elements;

        ksort($elements);

        foreach ($elements as $element => $data) {

            if ('extensions' == $this->typeReport['long']) {
                $values    = $data;
                $extension = $element;
            } else {
                list ($extension, $values) = each($data);
            }

            // PHP min/Max
            $versions = $values[0];
            if (!empty($values[1])) {
                $versions .= '/' . $values[1];
            }

            // EXT-min/Max
            if ('extensions' == $this->typeReport['long']) {
                $extension = $values[2];
            } else {
                if (!empty($values[2])) {
                    $extension .= '-' . $values[2];
                }
                if (!empty($values[3])) {
                    $extension .= '/' . $values[3];
                }
            }

            echo $element;
            if (strlen($element) > 40) {
                echo PHP_EOL . str_repeat(' ', 40);
            } else {
                echo str_repeat(' ', (40 - strlen($element)));
            }
            if (strlen($extension) < 18) {
                echo $extension
                    . str_repeat(' ', (18 - strlen($extension)));
            } else {
                echo $extension . PHP_EOL
                    . str_repeat(' ', 58);
            }
            echo $versions . PHP_EOL;
        }
    }

}
