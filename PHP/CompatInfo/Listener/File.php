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
class PHP_CompatInfo_Listener_File implements SplObserver
{
    /**
     * Time format
     * @var string
     */
    private $_timeFormat = '%b %d %H:%M:%S';

    /**
     * Receive update from subject
     *
     * @param SplSubject $subject Subject observed that contains event to write
     *
     * @return void
     */
    public function update(SplSubject $subject)
    {
        $event = $subject->getEvent();

        error_log(
            sprintf(
                '%s [%s] %s %s',
                strftime($this->_timeFormat, $event['timestamp']),
                $event['level'],
                $event['message'],
                PHP_EOL
            ),
            3, 'phpci.log'
        );
    }

}
