<?php
/**
 * Exception for PHP_CompatInfo
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */

class PHP_CompatInfo_Exception extends Exception
{
    const RUNTIME         = -1000;
    const INVALIDARGUMENT = -1100;
}
