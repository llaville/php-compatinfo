<?php
/**
 * Source tokens report
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
 * Source tokens report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Source
{
    /**
     * @var int Report character width (default to 79)
     */
    protected $width = 79;

    /**
     * Class constructor of source tokens report
     *
     * @param string $source   Data source
     * @param array  $options  Options for parser
     * @param array  $warnings List of warning messages already produced
     */
    public function __construct($source, $options, $warnings)
    {
        if (isset($options['exclude']['files'])) {
            $excludes = $options['exclude']['files'];
        } else {
            $excludes = array();
        }
        if (isset($options['fileExtensions'])) {
            $excludes[-1] = '\.(' . implode('|', $options['fileExtensions']) . ')$';
        }

        $files = PHP_CompatInfo::getFilelist(
            $source, $options['recursive'], $excludes
        );

        $report = array_fill_keys($files, $options['verbose']);
        $base   = realpath(dirname($source));

        if (isset($options['reportFile'])) {
            ob_start();
        }

        $this->generate($report, $base, $options['verbose']);

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
     * Prints a source tokens report
     *
     * @param array  $report  Report data to produce
     * @param string $base    Base directory of data source
     * @param int    $verbose Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    public function generate($report, $base, $verbose)
    {
        foreach ($report as $filename => $verbose) {
            $reflect = new PHP_Reflect();
            $tokens  = $reflect->scan($filename);

            $this->printTHead($base, $filename, $verbose);

            if ($verbose == 1) {
                foreach ($tokens as $token) {
                    if ($token[0] == 'T_WHITESPACE') {
                        $text = '';
                    } else {
                        $text = str_replace(array("\r", "\n"), '', $token[1]);

                        if (strlen($text) > 40) {
                            $text = explode("\n", wordwrap($text, 40));
                            $text = $text[0];
                        }
                    }

                    printf(
                        "%5d  %-30s %s\n",
                        $token[2],
                        $token[0],
                        $text
                    );
                }
            }

            $total = $reflect->getLinesOfCode();
            $this->printTFoot($total);
        }
        echo PHP_EOL;
    }

    /**
     * Prints header of report
     *
     * @param string $base     Base directory of data source
     * @param string $filename Current file
     * @param int    $verbose  Verbose level (0: none, 1: warnings, ...)
     *
     * @return void
     */
    protected function printTHead($base, $filename, $verbose)
    {
        echo PHP_EOL;
        echo 'BASE: ' . $base . PHP_EOL;
        echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
        echo str_repeat('-', $this->width)           . PHP_EOL;
        echo 'PHP COMPAT INFO SOURCE SUMMARY'        . PHP_EOL;

        if ($verbose == 1) {
            echo str_repeat('-', $this->width) . PHP_EOL;
            echo 'LINE   TOKEN                          TEXT' . PHP_EOL;
            echo str_repeat('-', $this->width).PHP_EOL;
        }
    }

    /**
     * Prints footer of report
     *
     * @param array $total Count of code and comment lines
     *
     * @return void
     */
    protected function printTFoot($total)
    {
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo 'A TOTAL OF ' . $total['loc'] . ' LINE(S)';
        echo ' WITH ' . $total['cloc'] . ' COMMENT LINE(S)';
        echo ' AND ' . $total['ncloc'] . ' CODE LINE(S)'
            . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
        echo PHP_Timer::resourceUsage()    . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

}
