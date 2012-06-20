<?php
/**
 * Registers autoloader for PHP_CompatInfo and all other dependencies
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

require_once dirname(__FILE__) . '/Autoloader.php';

spl_autoload_register('phpCompatInfo_autoload');

require_once 'ezc/Base/base.php';
spl_autoload_register(array('ezcBase', 'autoload'));

require_once 'Bartlett/PHP/Reflect/Autoload.php';
