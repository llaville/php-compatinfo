<?php
/**
 * Events that could be observed in PHP_CompatInfo
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
 * Observable Events Interface
 *
 * Each new listener must implement this interface
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
interface PHP_CompatInfo_Observable
{
    /**
     * A data source scan started
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function startScanSource($event);

    /**
     * A data source scan ended
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function endScanSource($event);

    /**
     * A file scan started
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function startScanFile($event);

    /**
     * A file scan ended
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function endScanFile($event);

    /**
     * A load reference started
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function startLoadReference($event);

    /**
     * A load reference ended
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function endLoadReference($event);

    /**
     * A load reference failed
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function failLoadReference($event);

    /**
     * A warning pushed on stack
     *
     * @param object $event The event
     *
     * @return mixed Depends of listener implementation
     */
    public function pushWarning($event);

}
