<?php

namespace Bartlett\CompatInfo;

use Bartlett\Reflect\AbstractEnvironment;

/**
 * Application Environment.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.6.0
 */
class Environment extends AbstractEnvironment
{
    const JSON_FILE = 'phpcompatinfo.json';
    const ENV       = 'COMPATINFO';
}
