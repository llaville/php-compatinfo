<?php
/**
 * Growl listener
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

require_once 'Net/Growl/Autoload.php';

/**
 * Growl listener
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Listener_Growl
    implements SplObserver, PHP_CompatInfo_Observable
{
    const GROWL_NOTIFY_INFO = 'info';
    const GROWL_NOTIFY_WARN = 'warning';

    /**
     * @var object Net_Growl
     */
    protected $growl;

    /**
     * @var object PHP_CompatInfo
     */
    protected $subject;

    /**
     * Build a Growl listener
     *
     * @param string $appName       Application name
     * @param array  $notifications List of notification types
     * @param string $password      Password for Growl client
     * @param array  $options       List of options for Growl client
     *
     * @return object PHP_CompatInfo_Listener_Growl
     */
    public function __construct($appName = null, $notifications = null,
        $password = null, $options = null
    ) {
        if ($appName === null) {
            $appName = 'PHP_CompatInfo';
        }

        $defaultNotifications = array(
            self::GROWL_NOTIFY_INFO => array(
                'display' => 'Info',
            ),

            self::GROWL_NOTIFY_WARN => array(
                'display' => 'Warning'
            )
        );

        if ($notifications === null) {
            $notifications = $defaultNotifications;
        }

        if ($password === null) {
            $password = '';
        }

        $defaultOptions  = array(
            'host'     => '127.0.0.1',
            'protocol' => 'gntp',
            'timeout'  => 15,
        );

        if ($options === null) {
            $options = $defaultOptions;
        } else {
            $options = array_merge($defaultOptions, $options);
        }

        $this->growl = Net_Growl::singleton(
            $appName, $notifications, $password, $options
        );
        $this->growl->register();
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

        if (empty($data)) {
            return;
        }

        $this->growl->publish(
            $data['name'], $data['title'], $data['description'], $data['options']
        );
    }

    /**
     * Notification when load reference started
     *
     * @param object $event The event
     *
     * @return array
     */
    public function startLoadReference($event)
    {
        list($reference, ) = $event->getArguments();

        return array(
            'name'        => self::GROWL_NOTIFY_INFO,
            'title'       => 'Load Reference started',
            'description' => 'start loading reference ' . $reference,
            'options'     => array()
        );
    }

    /**
     * Notification when load reference ended
     *
     * @param object $event The event
     *
     * @return array
     */
    public function endLoadReference($event)
    {
        list($reference, $successful, $failures) = $event->getArguments();

        $description = sprintf(
            'end loading reference %s with %d successful, %d failures',
            $reference,
            $successful,
            $failures
        );
        $options = array();
        if ($failures > 0) {
            $options['priority'] = Net_Growl::PRIORITY_HIGH;
        }

        return array(
            'name'        => self::GROWL_NOTIFY_INFO,
            'title'       => 'Load Reference ended',
            'description' => $description,
            'options'     => $options
        );
    }

    /**
     * Notification when load reference failed
     *
     * @param object $event The event
     *
     * @return array
     */
    public function failLoadReference($event)
    {
    }

    /**
     * Notification when data source scan started
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

        return array(
            'name'        => self::GROWL_NOTIFY_INFO,
            'title'       => 'Scan Source started',
            'description' => $message,
            'options'     => array()
        );
    }

    /**
     * Notification when data source scan ended
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
            'name'        => self::GROWL_NOTIFY_INFO,
            'title'       => 'Scan Source ended',
            'description' => 'Required PHP ' . $versions,
            'options'     => array('sticky' => true)
        );
    }

    /**
     * Notification when file scan started
     *
     * @param object $event The event
     *
     * @return void
     */
    public function startScanFile($event)
    {
    }

    /**
     * Notification when file scan ended
     *
     * @param object $event The event
     *
     * @return void
     */
    public function endScanFile($event)
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
        list($warn) = $event->getArguments();

        return array(
            'name'        => self::GROWL_NOTIFY_WARN,
            'title'       => 'Warning',
            'description' => $warn,
            'options'     => array('priority' => Net_Growl::PRIORITY_HIGH)
        );
    }

}
