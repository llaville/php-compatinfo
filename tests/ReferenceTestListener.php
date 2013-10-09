<?php
/**
 * Copyright (c) 2013, Laurent Laville <pear@laurent-laville.org>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the authors nor the names of its contributors
 *       may be used to endorse or promote products derived from this software
 *       without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS
 * BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
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
 * @since      Class available since Release 2.24.0
 */

/**
 * A PHPUnit TestListener pushing the test results to PHP's system logger.
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class ReferenceTestListener implements PHPUnit_Framework_TestListener
{
    /**
     * An error occurred.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @return void
     */
    public function addError(PHPUnit_Framework_Test $test,
        Exception $e, $time)
    {
        error_log(sprintf("Error while running test '%s'.", $test->getName()));
    }

    /**
     * A failure occurred.
     *
     * @param PHPUnit_Framework_Test                 $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float                                  $time
     *
     * @return void
     */
    public function addFailure(PHPUnit_Framework_Test $test,
        PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        error_log(sprintf("Test '%s' failed.", $test->getName()));
    }

    /**
     * Incomplete test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @return void
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test,
        Exception $e, $time)
    {
        error_log(sprintf("Test '%s' is incomplete.", $test->getName()));
    }

    /**
     * Skipped test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception              $e
     * @param float                  $time
     *
     * @return void
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test,
        Exception $e, $time)
    {
        $name = $test->getName();
        $info = $e->getMessage();
        error_log(sprintf("Test '%s' has been skipped. %s", $name, $info));
    }

    /**
     * A test started.
     *
     * @param PHPUnit_Framework_Test $test
     *
     * @return void
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
        error_log(sprintf("Test '%s' started.", $test->getName()));
    }

    /**
     * A test ended.
     *
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     *
     * @return void
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        if ($test->getName() === 'testReference') {

            $class   = str_replace('Test', '', get_class($test));
            $extname = $class::REF_NAME;

            $current = phpversion($extname);
            $current = $current === FALSE ? '' :  sprintf("and current '%s'", $current);
            error_log(sprintf("Reference '%s' versions dist '%s'%s.", $extname, $class::REF_VERSION, $current));
        } else {
            error_log(sprintf("Test '%s' ended.", $test->getName()));
        }
    }

    /**
     * A test suite started.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @return void
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        error_log(sprintf("TestSuite '%s' started.", $suite->getName()));
    }

    /**
     * A test suite ended.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     *
     * @return void
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        error_log(sprintf("TestSuite '%s' ended.", $suite->getName()));
    }
}
