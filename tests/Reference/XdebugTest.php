<?php
/**
 * Unit tests for PHP_CompatInfo package, Xdebug Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Xdebug extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_XdebugTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Xdebug::getExtensions
     * @covers PHP_CompatInfo_Reference_Xdebug::getFunctions
     * @covers PHP_CompatInfo_Reference_Xdebug::getClasses
     * @return void
     */
    protected function setUp()
    {
        $extname = 'xdebug';
        if (extension_loaded($extname)) {
            if (version_compare(phpversion($extname), '2.0.0beta1', 'ge')) {
                // removed functions in 2.0.0beta1
                $this->optionalfunctions = array_merge(
                    $this->optionalfunctions,
                    array(
                        'xdebug_get_function_trace',
                        'xdebug_dump_function_trace',
                    )
                );
            }

            if (version_compare(phpversion($extname), '2.0.0RC1', 'ge')) {
                // removed functions in 2.0.0RC1
                $this->optionalfunctions = array_merge(
                    $this->optionalfunctions,
                    array(
                        'xdebug_set_error_handler',
                    )
                );
            }
        }

        $this->obj = new PHP_CompatInfo_Reference_Xdebug();
        parent::setUp();
    }
}
