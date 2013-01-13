<?php
/**
 * Console listener
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

/**
 * Console listener
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Listener_Console extends PHP_CompatInfo_Listener_Abstract
    implements SplObserver, PHP_CompatInfo_Observable
{
    /**
     * @var integer
     */
    protected $maxColumn;

    /**
     * @var object PHP_CompatInfo
     */
    protected $subject;

    /**
     * Build a Console listener
     *
     * @param integer $maxColumn (optional) Console output maximum width
     *
     * @return object PHP_CompatInfo_Listener_Console
     */
    public function __construct($maxColumn = null)
    {
        if (!empty($maxColumn) && is_integer($maxColumn)) {
            $this->maxColumn = $maxColumn;
        } else {
            $this->maxColumn = 60;
        }

        $this->setHash($this->maxColumn);
    }

    /**
     * Receive update from subject
     *
     * @param SplSubject $subject Subject observed that contains event to write
     *
     * @return void
     */
    public function update(SplSubject $subject)
    {
        $this->subject = $subject;

        $event = $subject->getEvent();

        // delegate to right event implementation
        call_user_func(array($this, $event->getName()), $event);
    }

    /**
     * A data source scan started
     *
     * @param object $event The event
     *
     * @return array
     */
    public function startScanSource($event)
    {
        printf(
            'PHP_CompatInfo %s by Laurent Laville%s',
            PHP_CompatInfo_CLI::getVersion(),
            PHP_EOL
        );
        echo PHP_EOL;
    }

    /**
     * A data source scan ended
     *
     * @param object $event The event
     *
     * @return array
     */
    public function endScanSource($event)
    {
        echo PHP_EOL;
    }

    /**
     * A file scan started
     *
     * @param object $event The event
     *
     * @return array
     */
    public function startScanFile($event)
    {
    }

    /**
     * A file scan ended
     *
     * @param object $event The event
     *
     * @return array
     */
    public function endScanFile($event)
    {
        list($file, $currentIndex, $maxIndex) = $event->getArguments();

        $results = $this->subject->toArray($file);

        $progress = '.';
        foreach ($results['conditions'] as $condition => $value) {
            if ($value > 0) {
                $progress = 'C';  // conditional code found in $file
                break;
            }
        }
        print($progress);

        if ($currentIndex % $this->maxColumn === 0) {
            printf(
                ' %' .
                strlen($maxIndex) . 'd / %' .
                strlen($maxIndex) . 'd (%3s%%)',
                $currentIndex,
                $maxIndex,
                floor(($currentIndex / $maxIndex) * 100)
            );
            echo PHP_EOL;
        }
    }

    /**
     * A load reference started
     *
     * @param object $event The event
     *
     * @return array
     */
    public function startLoadReference($event)
    {
    }

    /**
     * A load reference ended
     *
     * @param object $event The event
     *
     * @return array
     */
    public function endLoadReference($event)
    {
    }

    /**
     * A load reference failed
     *
     * @param object $event The event
     *
     * @return array
     */
    public function failLoadReference($event)
    {
    }

    /**
     * A warning pushed on stack
     *
     * @param object $event The event
     *
     * @return array
     */
    public function pushWarning($event)
    {
    }

}
