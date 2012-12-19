<?php
/**
 * Version informations about mongo extension
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
 * All interfaces, classes, functions, constants about mongo extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mongo.php
 */
class PHP_CompatInfo_Reference_Mongo
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mongo';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.3.2';

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
        /*
            0.9.0       PHP 5.0.0 ge
            since 1.0.0 PHP 5.1.0 ge
            since 1.3.0 PHP 5.2.6 ge
         */
        $phpMin = '5.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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
     * @link   http://www.php.net/manual/en/mongo.core.php
     * @link   http://www.php.net/manual/en/mongo.types.php
     * @link   http://www.php.net/manual/en/mongo.gridfs.php
     * @link   http://www.php.net/manual/en/mongo.miscellaneous.php
     * @link   http://www.php.net/manual/en/mongo.exceptions.php
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '0.9.0';       // 2009-05-20
        $items = array(
            // Core
            'Mongo'                             => array('5.0.0', ''),
            'MongoUtil'                         => array('5.0.0', ''),
            'MongoCollection'                   => array('5.0.0', ''),
            'MongoCursor'                       => array('5.0.0', ''),
            'MongoDB'                           => array('5.0.0', ''),

            // Types
            'MongoCode'                         => array('5.0.0', ''),
            'MongoId'                           => array('5.0.0', ''),
            'MongoRegex'                        => array('5.0.0', ''),
            'MongoBinData'                      => array('5.0.0', ''),
            'MongoDate'                         => array('5.0.0', ''),
            'MongoDBRef'                        => array('5.0.0', ''),

            // GridFS
            'MongoGridFS'                       => array('5.0.0', ''),
            'MongoGridFSFile'                   => array('5.0.0', ''),
            'MongoGridFSCursor'                 => array('5.0.0', ''),

            // Exceptions
            'MongoException'                    => array('5.0.0', ''),
            'MongoCursorException'              => array('5.0.0', ''),
            'MongoConnectionException'          => array('5.0.0', ''),
            'MongoGridFSException'              => array('5.0.0', ''),

        );
        $this->applyFilter($release, $items, $classes);
        // removed classes
        $this->setMaxExtensionVersion(
            '0.9.0', 'MongoUtil', $classes
        );

        $release = '1.0.1';       // 2009-11-19
        $items = array(
            // Types
            'MongoTimestamp'                    => array('5.1.0', ''),
            'MongoMaxKey'                       => array('5.1.0', ''),
            'MongoMinKey'                       => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.0.3';       // 2010-01-07
        $items = array(
            // Exceptions
            'MongoCursorTimeoutException'       => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.0.9';       // 2010-08-06
        $items = array(
            // Types
            'MongoInt32'                        => array('5.1.0', ''),
            'MongoInt64'                        => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.2.3';       // 2011-08-15
        $items = array(
            // Miscellaneous
            'MongoLog'                          => array('5.1.0', ''),
            'MongoPool'                         => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.3.0RC1';    // 2012-11-05
        $items = array(
            // Exceptions
            'MongoResultException'              => array('5.2.6', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.3.0RC3';    // 2012-11-20
        $items = array(
            // Core
            'MongoClient'                       => array('5.2.6', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.mongo.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '1.0.1';       // 2009-11-19
        $items = array(
            'bson_decode'                       => array('5.1.0', ''),
            'bson_encode'                       => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
