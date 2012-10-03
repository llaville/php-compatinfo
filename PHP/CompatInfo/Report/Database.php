<?php
/**
 * Database references report
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
 * Database references report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Database extends PHP_CompatInfo_Report
{
    protected $extensionsCount;

    /**
     * Class constructor of database references report
     *
     * @param string $source   not used
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

        $extensions = PHP_CompatInfo_Reference_ALL::getDatabaseExtensions();

        $reference = new $referenceClassName($extensions);

        switch($options['reference']) {
        case 'PHP4':
            $version = '4';
            break;
        case 'PHP5':
        default:
            $version = null;
        }

        $report = $reference->getExtensions(null, $version);

        if (isset($options['reportFile'])) {
            ob_start();
        }

        $this->typeReport = array('short' => 'extension', 'long' => '');
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
     * Prints a reference report about all extensions supported
     *
     * @param array  $report  Report data to produce
     * @param string $base    not used
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    public function generate($report, $base, $verbose)
    {
        $this->printTHead($base, null);

        $extensions  = get_loaded_extensions();
        $totalLoaded = 0;

        foreach ($report as $element => $data) {

            $values    = $data;
            $extension = $values[2];
            if (isset($values[3])) {
                $extension .= '/' . $values[3];
            }
            $versions  = $values[0];
            if (!empty($values[1])) {
                $versions .= '/' . $values[1];
            }

            if (in_array($element, $extensions)) {
                echo 'L';
                $totalLoaded++;
            } else {
                echo ' ';
            }
            echo ' ';

            echo $element
                . str_repeat(' ', (38 - strlen($element)));
            echo $extension
                . str_repeat(' ', (18 - strlen($extension)));
            echo $versions
                . str_repeat(' ', (16 - strlen($versions)));
            echo PHP_EOL;
        }
        $this->extensionsCount = array(count($report), $totalLoaded);

        $this->printTFoot();
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

        echo PHP_EOL;
        echo str_repeat('-', $this->width)        . PHP_EOL;
        echo 'PHP COMPAT INFO DATABASE REFERENCE' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo '  ' . $label . str_repeat(' ', (38 - strlen($label)))
            . 'VERSION' . str_repeat(' ', ($this->width - 68))
            . 'PHP min/Max' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

    /**
     * Prints footer of report
     *
     * @return void
     */
    protected function printTFoot()
    {
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'A TOTAL OF ' . $this->extensionsCount[0] . ' EXTENSIONS WERE FOUND';
        if ($this->extensionsCount[1] > 0) {
            echo ' AND ' . $this->extensionsCount[1] . ' LOADED';
        }
        echo PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_Timer::resourceUsage()    . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_EOL;
    }

}
