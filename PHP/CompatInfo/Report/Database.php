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
    /**
     * Class constructor of database references report
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

        $dir = new DirectoryIterator(
            dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Reference'
        );
        $excludes = array(
            'PluginsAbstract.php', 'PHP4.php', 'PHP5.php', 'PEAR.php'
        );
        $extensions = array();
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile()) {
                $fn = $fileinfo->getFilename();
                if (in_array($fn, $excludes)) {
                    continue;
                }
                $extensions[] = basename($fn, '.php');
            }
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

        $report = $reference->getExtensions(null, $version);

        if (isset($options['reportFile'])) {
            ob_start();
        }

        $this->generate($report, false);

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
     * Prints a reference report about all extensions supported
     *
     * @param array  $report Report data to produce
     * @param string $base   Base directory of data source
     *
     * @return void
     */
    public function generate($report, $base)
    {
        $width = 79;

        echo PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        echo 'PHP COMPAT INFO DATABASE REFERENCE' . PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        echo '  EXTENSIONS' . str_repeat(' ', ($width - 46))
            . 'EXTENSION         VERSION' . PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;

        $extensions  = get_loaded_extensions();
        $totalLoaded = 0;

        foreach ($report as $element => $data) {

            $values    = $data;
            $extension = array_pop($values);
            $versions  = implode('  ', $values);

            if (in_array($element, $extensions)) {
                echo 'L';
                $totalLoaded++;
            } else {
                echo ' ';
            }
            echo ' ';

            echo $element
                . str_repeat(' ', (43 - strlen($element)));
            echo $extension
                . str_repeat(' ', (18 - strlen($extension)));
            echo $versions
                . str_repeat(' ', (16 - strlen($versions)));
            echo PHP_EOL;
        }
        echo str_repeat('-', $width).PHP_EOL;
        echo 'A TOTAL OF ' . count($report) . ' EXTENSIONS WERE FOUND';
        if ($totalLoaded > 0) {
            echo ' AND ' . $totalLoaded . ' LOADED';
        }
        echo PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        echo PHP_Timer::resourceUsage() . PHP_EOL;
        echo str_repeat('-', $width).PHP_EOL;
        echo PHP_EOL;
    }
}
