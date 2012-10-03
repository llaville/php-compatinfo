<?php
/**
 * Condition report
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
 * Condition report
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Report_Condition extends PHP_CompatInfo_Report
{
    /**
     * Prints body of report
     *
     * @param array  $elements List of function to print
     * @param string $filename Current file
     * @param string $base     Base directory of data source
     *
     * @return void
     */
    protected function printTBody($elements, $filename, $base)
    {
        if (!isset($elements['Core'])) {
            return;
        }

        self::applyFilter($elements, 'Core');

        $ccl = array(
            'function_exists',
            'extension_loaded',
            'defined',
            'method_exists',
            'class_exists',
            'interface_exists',
            'trait_exists',
        );

        foreach ($elements['Core'] as $function => $data) {
            if (!in_array($function, $ccl)) {
                continue;
            }
            $this->total[] = $function;

            if ($data['excluded']) {
                echo 'E';
                $this->totalExcludes++;
            } else {
                echo ' ';
            }

            // PHP min/Max
            $versions = $data['versions'][0];
            if (!empty($data['versions'][1])) {
                $versions .= '/' . $data['versions'][1];
            }

            // EXT-min/Max
            $extension = 'Core';
            if (!empty($data['versions'][2])) {
                $extension .= '-' . $data['versions'][2];
            }
            if (!empty($values[3])) {
                $extension .= '/' . $data['versions'][3];
            }

            echo ' ';
            if (strlen($function) < 38) {
                echo $function
                    . str_repeat(' ', (38 - strlen($function)));
            } else {
                echo $function . PHP_EOL;
                echo str_repeat(' ', 40);
            }
            if (strlen($extension) < 18) {
                echo $extension
                    . str_repeat(' ', (18 - strlen($extension)));
            } else {
                echo $extension . PHP_EOL
                    . str_repeat(' ', 40);
            }
            echo $versions
                . str_repeat(' ', (16 - strlen($versions)));
            echo str_repeat(
                ' ', (5 - strlen((string) $data['uses']))
            );
            echo $data['uses'] . PHP_EOL;

            if ($filename) {
                foreach ($data['sources'] as $source) {
                    echo '    ' . str_replace($base, '', $source) . PHP_EOL;
                }
            }

            if ($data['excluded']) {
                continue;
            }

            $this->updateVersion(
                $data['versions'][0], $this->globalVersions[0]
            );
            $this->updateVersion(
                $data['versions'][1], $this->globalVersions[1]
            );

        }
    }

}
