<?php
/**
 * Full report
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
 * Full report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Full
{
    /**
     * Class constructor for full/combined report
     *
     * @param string $source       Data source
     * @param array  $options      Options for parser
     * @param array  $warnings     List of warning messages already produced
     * @param array  $reportChilds List of reports to print 
     */
    public function __construct($source, $options, $warnings, $reportChilds)
    {
        $pci = new PHP_CompatInfo($options);
        if ($pci->parse($source) === false) {
            return;
        }
        $reportResults = $pci->toArray();
        $base   = realpath($source);
        if (is_file($base)) {
            $base = dirname($base);
        }
        $allWarnings = array_unique(
            array_merge($warnings, $pci->getWarnings())
        );

        $options = $pci->getOptions();

        if (empty($reportChilds)) {
            $reportChilds = array(
                'summary', 'extension',
                'interface', 'trait', 'class', 'function', 'constant',
                'global', 'token', 'condition'
            );
        }

        foreach ($reportChilds as $report) {
            $classReport = 'PHP_CompatInfo_Report_' . ucfirst($report);
            new $classReport($source, $options, $allWarnings, $reportResults);
        }
    }

}
