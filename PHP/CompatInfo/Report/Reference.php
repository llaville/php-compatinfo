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

        if (isset($options['extensions'])) {
            $extensions = $options['extensions'];
            $extension  = $extensions[0];
            unset($options['extensions']);
        } else {
            $extensions = $extension = null;
        }
        $reference = new $referenceClassName($extensions);

        switch($options['reference']) {
        case 'PHP4':
            $version = '4';
            break;
        case 'PHP5':
        default:
            $version = null;
        }

        $report = $reference->getAll($extension, $version);

        if ('all' == $source) {
            $lists = array(
                'extensions', 'interfaces', 'classes', 'functions', 'constants'
            );
        } else {
            $lists = array($source);
        }

        if (isset($options['reportFile'])) {
            ob_start();
        }

        foreach ($lists as $list) {
            $this->_list = $list;
            $this->generate($report, false, $options['verbose']);
        }

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
        echo PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'PHP COMPAT INFO ' . strtoupper($this->_list) . ' REFERENCE' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo str_pad(strtoupper($this->_list), 10)
            . str_repeat(' ', ($this->width - 44))
            . 'EXTENSION         VERSION'  . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;

        foreach ($report[$this->_list] as $element => $data) {

            if ('extensions' == $this->_list) {
                $values    = $data;
                $extension = array_pop($values);
            } else {
                list ($extension, $values) = each($data);
            }
            $versions = implode('  ', $values);

            echo $element
                . str_repeat(' ', (45 - strlen($element)));
            echo $extension
                . str_repeat(' ', (18 - strlen($extension)));
            echo $versions
                . str_repeat(' ', (16 - strlen($versions)));
            echo PHP_EOL;
        }
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'A TOTAL OF ' . count($report[$this->_list]) . ' ' .
            strtoupper($this->_list) . ' ';
        echo 'WERE FOUND '                 . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_Timer::resourceUsage()    . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_EOL;
    }
}
