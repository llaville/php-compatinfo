<?php
/**
 * File listener
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
 * File listener
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Listener_File
    implements SplObserver, PHP_CompatInfo_Observable
{
    /**
     * @var string Destination (output) file
     */
    protected $destFile;

    /**
     * @var string Time format
     */
    protected $timeFormat;

    /**
     * @var integer
     */
    protected $startTime;

    /**
     * @var object PHP_CompatInfo
     */
    protected $subject;

    /**
     * Build a File listener
     *
     * @param string $destFile   (optional) Destination (output) file
     * @param string $timeFormat (optional) Time format
     *
     * @return object PHP_CompatInfo_Listener_File
     */
    public function __construct($destFile = null, $timeFormat = null)
    {
        if (!empty($destFile) && is_dir(dirname($destFile))) {
            $this->destFile = $destFile;
        } else {
            $this->destFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'phpci.log';
        }

        if (empty($timeFormat)) {
            $this->timeFormat = '%b %d %H:%M:%S';
        } else {
            $this->timeFormat = $timeFormat;
        }
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
        $data = call_user_func(array($this, $event->getName()), $event);

        error_log(
            sprintf(
                '%s [%s] %s %s',
                strftime($this->timeFormat, $data['timestamp']),
                $data['level'],
                $data['message'],
                PHP_EOL
            ),
            3, $this->destFile
        );
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
        list($source) = $event->getArguments();

        $message = 'Audit started';

        if (is_string($source)) {
            if (is_dir($source)) {
                $message .= ' for directory ' . realpath($source);
            } else {
                $message .= ' for file ' . realpath($source);
            }
        } elseif (is_array($source)) {
                $message .= ' for a list of ' . count($source) .
                    ' different(s) data source';
        }
        $this->startTime = time();

        return array(
            'timestamp' => $this->startTime,
            'level'     => 'info',
            'message'   => $message
        );
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
        list($min, $max) = $this->subject->getVersions();
        $versions = $min . ' (min)';
        if (!empty($max)) {
            $versions .= $max . ' (max)';
        }

        return array(
            'timestamp' => time(),
            'level'   => 'info',
            'message' => sprintf(
                'Audit finished in %s minutes. Required PHP %s',
                (date('i:s', time() - $this->startTime)),
                $versions
            )
        );
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
        list($file, $currentIndex, $maxIndex) = $event->getArguments();

        return array(
            'timestamp' => time(),
            'level'     => 'info',
            'message'   => sprintf(
                'start scan file %s/%s: dir=%s, file=%s',
                $currentIndex,
                $maxIndex,
                dirname($file),
                basename($file)
            )
        );
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
        $summary = array();

        list($min, $max) = $results['versions'];
        $versions = 'required PHP ' . $min . ' (min)';
        if (!empty($max)) {
            $versions .= $max . ' (max)';
        }
        $summary[] = $versions;

        $count = count($results['extensions']);
        if ($count > 0) {
            $summary[] = 'extensions=' . $count;
        }

        foreach (array('interfaces', 'classes', 'functions', 'constants') as $key) {
            $count = 0;
            foreach ($results[$key] as $extensionElements) {
                $count += count($extensionElements);
            }
            if ($count > 0) {
                $summary[] = $key . '=' . $count;
            }
        }

        return array(
            'timestamp' => time(),
            'level'     => 'info',
            'message'   => sprintf(
                'end scan file %s/%s: %s',
                $currentIndex,
                $maxIndex,
                implode(', ', $summary)
            )
        );
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
        list($reference, $extensions) = $event->getArguments();

        if (is_array($extensions)) {
            $extra = 'modules list: '. implode(', ', $extensions);
        } else {
            $extra = 'modules loaded in the PHP interpreter';
        }

        return array(
            'timestamp' => time(),
            'level'     => 'info',
            'message'   => sprintf(
                'start loading reference %s with %s',
                $reference,
                $extra
            )
        );
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
        list($reference, $successful, $failures) = $event->getArguments();

        return array(
            'timestamp' => time(),
            'level'     => 'info',
            'message'   => sprintf(
                'end loading reference %s with %d successful, %d failures',
                $reference,
                $successful,
                $failures
            )
        );
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
        list($warn) = $event->getArguments();

        return array(
            'timestamp' => time(),
            'level'     => 'warning',
            'message'   => $warn
        );
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
        list($warn) = $event->getArguments();

        return array(
            'timestamp' => time(),
            'level'     => 'warning',
            'message'   => $warn
        );
    }

}
