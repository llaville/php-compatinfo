<?php
/**
 * Autoloader for PHP_CompatInfo
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

function phpCompatInfo_autoload($className)
{
    static $classes = null;
    static $path    = null;

    if ($classes === null) {

        $classes = array(
            'PHP_CompatInfo_TokenParser'
                => 'PHP/CompatInfo/TokenParser.php',
            'PHP_CompatInfo_Token_STRING'
                => 'PHP/CompatInfo/Token/String.php',
            'PHP_CompatInfo_Token_CONSTANT_ENCAPSED_STRING'
                => 'PHP/CompatInfo/Token/ConstantEncapsedString.php',
            'PHP_CompatInfo_Exception'
                => 'PHP/CompatInfo/Exception.php',
            'PHP_CompatInfo_Cache'
                => 'PHP/CompatInfo/Cache.php',
            'PHP_CompatInfo_Reference'
                => 'PHP/CompatInfo/Reference.php',
            'PHP_CompatInfo_Reference_PluginsAbstract'
                => 'PHP/CompatInfo/Reference/PluginsAbstract.php',
            'PHP_CompatInfo_Reference_PHP4'
                => 'PHP/CompatInfo/Reference/PHP4.php',
            'PHP_CompatInfo_Reference_PHP5'
                => 'PHP/CompatInfo/Reference/PHP5.php',
        );
        $path = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
    }

    if (isset($classes[$className])) {
        include $path . $classes[$className];
    } elseif ('PHP_Reflect' == $className) {
        include 'Bartlett/PHP/Reflect.php';
    }
}

spl_autoload_register('phpCompatInfo_autoload');

require_once 'ezc/Base/base.php';
spl_autoload_register(array('ezcBase', 'autoload'));
