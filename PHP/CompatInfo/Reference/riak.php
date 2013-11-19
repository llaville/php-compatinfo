<?php
/**
 * Version informations about riak extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about riak extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.26.0
 */
class PHP_CompatInfo_Reference_Riak
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'riak';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0.0';  // 2013-11-18 (stable)

    /**
     * Gets informations about extensions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null, $condition = null)
    {
        $phpMin = '5.3.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $interfaces = array();

        $release = '0.5.0';       // 2013-07-05 (beta)
        $items = array(
            'Riak\MapReduce\Output\StreamOutput'    => array('5.3.0', ''),
            'Riak\Output\KeyStreamOutput'           => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $interfaces);

        $release = '0.6.0';       // 2013-10-09 (beta)
        $items = array(
            'Riak\Property\ReplicationMode\ReplicationMode'
                                                    => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $interfaces);

        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '0.4.0';       // 2013-06-13 (alpha)
        $items = array(
            'Riak\Bucket'                           => array('5.3.0', ''),
            'Riak\Connection'                       => array('5.3.0', ''),
            'Riak\Exception\BadArgumentsException'  => array('5.3.0', ''),
            'Riak\Exception\CommunicationException' => array('5.3.0', ''),
            'Riak\Exception\ConnectionException'    => array('5.3.0', ''),
            'Riak\Exception\RiakException'          => array('5.3.0', ''),
            'Riak\Link'                             => array('5.3.0', ''),
            'Riak\MapReduce\Phase\Phase'            => array('5.3.0', ''),
            'Riak\MapReduce\Phase\ReducePhase'      => array('5.3.0', ''),
            'Riak\MapReduce\MapReduce'              => array('5.3.0', ''),
            'Riak\Object'                           => array('5.3.0', ''),
            'Riak\Query\IndexQuery'                 => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.5.0';       // 2013-07-05 (beta)
        $items = array(
            'Riak\BucketPropertyList'               => array('5.3.0', ''),
            'Riak\Exception\UnexpectedResponseException'
                                                    => array('5.3.0', ''),
            'Riak\Input\DeleteInput'                => array('5.3.0', ''),
            'Riak\Input\GetInput'                   => array('5.3.0', ''),
            'Riak\Input\Input'                      => array('5.3.0', ''),
            'Riak\Input\PutInput'                   => array('5.3.0', ''),
            'Riak\MapReduce\Functions\BaseFunction' => array('5.3.0', ''),
            'Riak\MapReduce\Functions\ErlangFunction'
                                                    => array('5.3.0', ''),
            'Riak\MapReduce\Functions\JavascriptFunction'
                                                    => array('5.3.0', ''),
            'Riak\MapReduce\Output\Output'          => array('5.3.0', ''),
            'Riak\MapReduce\Phase\MapPhase'         => array('5.3.0', ''),
            'Riak\ObjectList'                       => array('5.3.0', ''),
            'Riak\Output\GetOutput'                 => array('5.3.0', ''),
            'Riak\Output\Output'                    => array('5.3.0', ''),
            'Riak\Output\PutOutput'                 => array('5.3.0', ''),
            'Riak\PoolInfo'                         => array('5.3.0', ''),
            'Riak\Search\Input\ParameterBag'        => array('5.3.0', ''),
            'Riak\Search\Output\DocumentOutput'     => array('5.3.0', ''),
            'Riak\Search\Output\Output'             => array('5.3.0', ''),
            'Riak\Search\Search'                    => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.6.0';       // 2013-10-09 (beta)
        $items = array(
            'Riak\MapReduce\Input\BucketInput'      => array('5.3.0', ''),
            'Riak\MapReduce\Input\Input'            => array('5.3.0', ''),
            'Riak\MapReduce\Input\KeyDataListInput' => array('5.3.0', ''),
            'Riak\MapReduce\Input\KeyListInput'     => array('5.3.0', ''),
            'Riak\Property\CommitHook'              => array('5.3.0', ''),
            'Riak\Property\CommitHookList'          => array('5.3.0', ''),
            'Riak\Property\ModuleFunction'          => array('5.3.0', ''),
            'Riak\Property\ReplicationMode\Disabled'
                                                    => array('5.3.0', ''),
            'Riak\Property\ReplicationMode\FullSyncOnly'
                                                    => array('5.3.0', ''),
            'Riak\Property\ReplicationMode\RealTimeAndFullSync'
                                                    => array('5.3.0', ''),
            'Riak\Property\ReplicationMode\RealTimeOnly'
                                                    => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.7.0';       // 2013-10-31 (beta)
        $items = array(
            'Riak\Input\IndexInput'                 => array('5.3.0', ''),
            'Riak\Output\IndexOutput'               => array('5.3.0', ''),
            'Riak\Output\IndexResult'               => array('5.3.0', ''),
            'Riak\Output\IndexResultList'           => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.8.0';       // 2013-11-02 (beta)
        $items = array(
            'Riak\Crdt\Counter'                     => array('5.3.0', ''),
            'Riak\Crdt\Input\GetInput'              => array('5.3.0', ''),
            'Riak\Crdt\Input\UpdateInput'           => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.9.0';       // 2013-11-08 (beta)
        $items = array(
            'Riak\ServerInfo'                       => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

}
