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
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

require_once 'Net/Growl.php';

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
class PHP_CompatInfo_Listener_Growl implements SplObserver
{
    const GROWL_NOTIFY_INFO = 'info';
    const GROWL_NOTIFY_WARN = 'warning';

    /**
     * @var array
     */
    protected $event;

    /**
     * @var object Net_Growl
     */
    protected $growl;

    /**
     * Class constructor
     *
     * @param string $appName       Application name
     * @param array  $notifications List of notification types
     * @param string $password      Password for Growl client
     * @param array  $options       List of options for Growl client
     */
    public function __construct($appName = null, $notifications = null,
        $password = null, $options = null
    ) {
        if ($appName === null) {
            $appName = 'PHPCompatInfo';
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
            'protocol' => 'tcp',
            'port'     => Net_Growl::GNTP_PORT,
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
        $this->event = $subject->getEvent();

        if (method_exists($this, $this->event['name'])) {
            call_user_func(array($this, $this->event['name']));
        }
    }

    /**
     * Notification for a load reference started
     *
     * @return void
     */
    public function startLoadReference()
    {
        $this->notifyEvent(__FUNCTION__);
    }

    /**
     * Notification for a load reference ended
     *
     * @return void
     */
    public function endLoadReference()
    {
        list($reference, $successuf, $failures) = sscanf(
            $this->event['message'],
            'end load reference %s with %d successful, %d failures'
        );

        $options = array();
        if ($failures > 0) {
            $options['priority'] = Net_Growl::PRIORITY_HIGH;
        }

        $this->notifyEvent(__FUNCTION__, $options);
    }

    /**
     * Notification for a data source scan started
     *
     * @return void
     */
    public function startScanSource()
    {
        $this->notifyEvent(__FUNCTION__);
    }

    /**
     * Notification for a data source scan ended
     *
     * @return void
     */
    public function endScanSource()
    {
        $this->notifyEvent(__FUNCTION__, array('sticky' => true));
    }

    /**
     * Send a notification to the growl client
     * 
     * @param string $title   Title of notification  
     * @param array  $options OPTIONAL specific notification options
     *
     * @return void
     */
    protected function notifyEvent($title, $options = array())
    {
        $name        = $this->event['level'];
        $description = $this->event['message'];
        $this->growl->notify($name, $title, $description, $options);
    }

}
