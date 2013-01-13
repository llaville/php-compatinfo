<?php
/**
 * Base class listener
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
 * Base class listener
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
abstract class PHP_CompatInfo_Listener_Abstract
{
    /**
     * sha1 hash of listener
     * @var string
     */
    protected $hash;

    /**
     * Build the unique identifier for this listener
     *
     * @return void
     */
    public function setHash()
    {
        $args = func_get_args();

        $this->hash = sha1(serialize($args));
    }

    /**
     * Return unique identifier for this listener
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

}
