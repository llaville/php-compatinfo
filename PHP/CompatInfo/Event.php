<?php
/**
 * Generic Event for PHP_CompatInfo
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
 * Common Event structure handled by PHP_CompatInfo
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Event
{
    /**
     * Name of event
     * @var string
     */
    protected $name;

    /**
     * Arguments of event
     * @var array
     */
    protected $arguments;

    /**
     * Build a PHP_CompatInfo event
     *
     * @return object PHP_CompatInfo_Event
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $subject   = array_shift($arguments);
        $eventName = array_shift($arguments);

        switch ($eventName) {
        case 'startScanSource':
        case 'endScanSource':
        case 'startScanFile':
        case 'endScanFile':
        case 'startLoadReference':
        case 'endLoadReference':
        case 'failLoadReference':
        case 'pushWarning':
            $this->arguments = $arguments;
            break;
        default:
            $this->arguments = array();
        }

        $this->name = $eventName;
    }

    /**
     * Get name of the event.
     *
     * Usefull for listener to dispatch to the right event implementation
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get list of arguments required by the event
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

}
