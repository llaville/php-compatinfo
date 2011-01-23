<?php
/**
 * Source tokens report
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PHP/CompatInfo/Report.php';

class PHP_CompatInfo_Report_Source extends PHP_CompatInfo_Report
{
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

        $this->generate($report, $base);

        if (count($warnings) > 0 && $options['verbose'] === TRUE) {
            echo 'Warning messages : (' . count($warnings) . ')' . PHP_EOL;
            echo PHP_EOL;
            foreach($warnings as $warning) {
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
     * Prints a source tokens report
     *
     * @param array  $report Report data to produce
     * @param string $base   Base directory of data source
     *
     * @return void
     */
    public function generate($report, $base)
    {
        $width = 79;

        foreach ($report as $filename => $verbose) {
            $tokenStream = new PHP_Token_Stream($filename);

            echo PHP_EOL;
            echo 'BASE: ' . $base . PHP_EOL;
            echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo 'PHP COMPAT INFO SOURCE SUMMARY' . PHP_EOL;

            if ($verbose) {
                echo str_repeat('-', $width).PHP_EOL;
                echo 'LINE   TOKEN                          TEXT' . PHP_EOL;
                echo str_repeat('-', $width).PHP_EOL;

                foreach ($tokenStream->tokens() as $token) {
                    if ($token instanceof PHP_Token_WHITESPACE) {
                        $text = '';
                    } else {
                        $text = str_replace(array("\r", "\n"), '', (string)$token);

                        if (strlen($text) > 40) {
                            $text = explode("\n", wordwrap($text, 40));
                            $text = $text[0];
                        }
                    }

                    printf(
                        "%5d  %-30s %s\n",
                        $token->getLine(),
                        str_replace('PHP_Token_', '', get_class($token)),
                        $text
                    );
                }
            }

            $total = $tokenStream->getLinesOfCode();

            echo str_repeat('-', $width).PHP_EOL;
            echo 'A TOTAL OF ' . $total['loc'] . ' LINE(S)';
            echo ' WITH ' . $total['cloc'] . ' COMMENT LINE(S)';
            echo ' AND ' . $total['ncloc'] . ' CODE LINE(S)'
                . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
            echo PHP_Timer::resourceUsage() . PHP_EOL;
            echo str_repeat('-', $width).PHP_EOL;
        }
        echo PHP_EOL;
    }
}
