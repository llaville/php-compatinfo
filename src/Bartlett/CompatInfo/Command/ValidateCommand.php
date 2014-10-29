<?php
/**
 * Validate console command.
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

namespace Bartlett\CompatInfo\Command;

use Bartlett\CompatInfo\Environment;
use Bartlett\Reflect\Command\AbstractValidateCommand;

/**
 * Console command to validate structure of the JSON configuration file.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.3.0
 */
class ValidateCommand extends AbstractValidateCommand
{
    protected $jsonFile = Environment::JSON_FILE;
    protected $env      = Environment::ENV;
}
