<?php
/**
 * Copyright (c) 2012-2013, Laurent Laville <pear@laurent-laville.org>
 *
 * Credits to Raphael Stolt on base concept
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
 * @category PHPUnit
 * @package  GrowlTestListener
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/llaville/phpunit-GrowlTestListener
 * @link     http://raphaelstolt.blogspot.com/2010/06/growling-phpunits-test-status.html
 */

/**
 * A PHPUnit TestListener pushing the test results to Growl on Mac OS X or Windows
 *
 * PHP version 5
 *
 * @category PHPUnit
 * @package  GrowlTestListener
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     https://github.com/llaville/phpunit-GrowlTestListener
 */
class GrowlTestListener implements PHPUnit_Framework_Testlistener
{
    /**
     * Notification types (channels)
     */
    const SUCCESS    = 'success';
    const FAILURE    = 'failure';
    const INCOMPLETE = 'incomplete';

    /**
     * Notification icons (of channels)
     */
    protected $successIcon;
    protected $incompleteIcon;
    protected $failureIcon;

    /**
     * Results
     */
    protected $errors      = array();
    protected $failures    = array();
    protected $incompletes = array();
    protected $skips       = array();
    protected $tests       = array();
    protected $suites      = array();
    protected $endedSuites    = 0;
    protected $assertionCount = 0;

    /**
     * Growl parameters
     */
    protected $host;
    protected $password;
    protected $sticky;
    protected $growl;

    /**
     * Initialize Growl test listener
     *
     * @param string $successIcon    (optional)
     *                               Icon on notification for successful tests 
     * @param string $incompleteIcon (optional)
     *                               Icon on notification for incomplete tests
     * @param string $failureIcon    (optional)
     *                               Icon on notification for failed tests
     * @param string $host           (optional)
     *                               Host address to send the notification to
     * @param string $password       (optional)
     *                               Password to send request to a remote host
     * @param bool   $sticky         (optional) Notification should be sticky
     *
     * @throws RuntimeException When growlnotify is not available
     * @return void
     */
    public function __construct($successIcon = false, $incompleteIcon = false,
        $failureIcon = false, $host = '127.0.0.1', $password = false,
        $sticky = false)
    {
        if (strpos($successIcon, 'file://') === false) {
            // remote resource
            $this->successIcon = $successIcon;
        } else {
            // local resource
            $successIcon       = realpath(substr($successIcon, 7));
            $this->successIcon = file_exists($successIcon)
                ? $successIcon : false;
        }
        if (strpos($incompleteIcon, 'file://') === false) {
            // remote resource
            $this->incompleteIcon = $incompleteIcon;
        } else {
            // local resource
            $incompleteIcon       = realpath(substr($incompleteIcon, 7));
            $this->incompleteIcon = file_exists($incompleteIcon)
                ? $incompleteIcon : false;
        }
        if (strpos($failureIcon, 'file://') === false) {
            // remote resource
            $this->failureIcon = $failureIcon;
        } else {
            // local resource
            $failureIcon       = realpath(substr($failureIcon, 7));
            $this->failureIcon = file_exists($failureIcon)
                ? $failureIcon : false;
        }

        $this->host     = (string)$host;
        $this->password = (string)$password;
        $this->sticky   = (bool)$sticky;

        $autoloader = 'Net/Growl/Autoload.php';

        if (!$handle = @fopen($autoloader, 'r', true)) {
            throw new RuntimeException(
                'The Growl Listener requires the Net_Growl PEAR package.'
            );
        } else {
            fclose($handle);
            include_once $autoloader;
        }

        $this->registerGrowl();
    }

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
        $this->errors[] = $test->getName();
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
        $this->failures[] = $test->getName();
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
        $this->incompletes[] = $test->getName();
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
        $this->skips[] = $test->getName();
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
        $this->suites[] = $suite->getName();
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
        $this->endedSuites++;

        if (count($this->suites) > $this->endedSuites) {
            return;
        }

        $testCount       = count($this->tests);
        $failureCount    = count($this->failures);
        $errorCount      = count($this->errors);
        $incompleteCount = count($this->incompletes);
        $skipCount       = count($this->skips);

        $channel = self::SUCCESS;

        $resultMessage  = "Tests: {$testCount}, ";
        $resultMessage .= "Assertions: {$this->assertionCount}";

        if ($failureCount > 0) {
            $resultMessage .= ", Failures: {$failureCount}";
            $channel = self::FAILURE;
        }

        if ($errorCount > 0) {
            $resultMessage .= ", Errors: {$errorCount}";
            $channel = self::FAILURE;
        }

        if ($incompleteCount > 0) {
            $resultMessage .= ", Incompleted: {$incompleteCount}";
            if ($channel != self::FAILURE) {
                $channel = self::INCOMPLETE;
            }
        }

        if ($skipCount > 0) {
            $resultMessage .= ", Skipped: {$skipCount}";
            if ($channel != self::FAILURE) {
                $channel = self::INCOMPLETE;
            }
        }

        if ($failureCount > 0 || $errorCount > 0) {
            $resultTitle = $suite->getName() . ' failed';
        } else {
            $resultTitle = $suite->getName() . ' is successful';
        }

        $this->growlNotify($channel, $resultTitle, $resultMessage);
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
        $this->tests[] = $test->getName();
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
        $this->assertionCount += $test->getNumAssertions();
    }

    /**
     * Registers Growl to send notification from PHPUnit test listener
     *
     * @throws RuntimeException When an error occurs with Growl registering
     * @return void
     */
    protected function registerGrowl()
    {
        $name = 'Growl for PHPUnit';

        $notifications = array(
            self::SUCCESS => array(
                'display' => 'Successful tests',
            ),
            self::INCOMPLETE => array(
                'display' => 'Incomplete tests',
            ),
            self::FAILURE => array(
                'display' => 'Failure tests',
            )
        );
        if ($this->successIcon) {
            $notifications[self::SUCCESS]['icon'] = $this->successIcon;
        }
        if ($this->incompleteIcon) {
            $notifications[self::INCOMPLETE]['icon'] = $this->incompleteIcon;
        }
        if ($this->failureIcon) {
            $notifications[self::FAILURE]['icon'] = $this->failureIcon;
        }

        $options  = array(
            'host'     => $this->host,
            'protocol' => 'gntp',
        );

        $this->growl = Net_Growl::singleton(
            $name, $notifications, $this->password, $options
        );

        try {
            $response = $this->growl->register();
            if ($response->getStatus() != 'OK') {
                throw new RuntimeException(
                    'Growl Error ' . $response->getErrorCode() .
                    ' - ' . $response->getErrorDescription()
                );
            }

        } catch (Net_Growl_Exception $e) {
            throw new RuntimeException(
                'Growl Exception : ' . $e->getMessage()
            );
        }
    }

    /**
     * Sends PHPUnit results to Growl application
     *
     * @param string $channel Type of notification
     * @param string $title   Title of notification window
     * @param string $message Message of notification window
     *
     * @throws RuntimeException When an error occurs with Growl notifications
     * @return void
     */
    protected function growlNotify($channel, $title, $message)
    {
        try {
            $options = array(
                'sticky' => $this->sticky,
            );
            $response = $this->growl->publish(
                $channel, $title, $message, $options
            );

        } catch (Net_Growl_Exception $e) {
            throw new RuntimeException(
                'Growl Exception : ' . $e->getMessage()
            );
        }
    }
}
