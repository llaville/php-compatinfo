<?php
/**
 * Unit tests for PHP_CompatInfo, xdebug extension Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.0.0RC1
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about xdebug extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class XdebugExtensionTest extends GenericTest
{
    const EXTNAME = 'Xdebug';

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalfunctions = array();
        $extname = 'xdebug';
        if (extension_loaded($extname)) {
            if (version_compare(phpversion($extname), '2.0.0beta1', 'ge')) {
                // removed functions in 2.0.0beta1
                array_push(
                    self::$optionalfunctions,
                    'xdebug_get_function_trace',
                    'xdebug_dump_function_trace'
                );
            }

            if (version_compare(phpversion($extname), '2.0.0RC1', 'ge')) {
                // removed functions in 2.0.0RC1
                array_push(
                    self::$optionalfunctions,
                    'xdebug_set_error_handler'
                );
            }
        }

        parent::setUpBeforeClass();
    }
}
