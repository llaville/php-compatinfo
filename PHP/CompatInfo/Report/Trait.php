<?php
/**
 * Trait report
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
 * Trait report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Trait extends PHP_CompatInfo_Report
{
    /**
     * Prints header of report
     *
     * @param string $base     Base directory of data source
     * @param string $filename Current file
     *
     * @return void
     */
    protected function printTHead($base, $filename)
    {
        echo PHP_EOL;
        echo 'BASE: ' . $base . PHP_EOL;
        echo str_replace($base, 'FILE: ', $filename) . PHP_EOL;
        echo str_repeat('-', $this->width)      . PHP_EOL;
        echo 'PHP COMPAT INFO TRAIT SUMMARY' . PHP_EOL;
        echo str_repeat('-', $this->width)      . PHP_EOL;
        echo '  TRAIT' . str_repeat(' ', ($this->width - 46))
            . str_repeat(' ', ($this->width - 61))
            . 'PHP min/Max' . str_repeat(' ', ($this->width - 74))
            . 'COUNT' . PHP_EOL;
        echo str_repeat('-', $this->width) . PHP_EOL;
    }

}
