<?php
/**
 * Version informations about sphinx extension
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
 * All interfaces, classes, functions, constants about sphinx extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.sphinx.php
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_Sphinx
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'sphinx';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.3.0';  // 2013-04-04 (stable)

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
            0.1.0 until 1.0.1  PHP 5.1.3 ge
            since 1.0.2        PHP 5.2.2 ge
         */
        $extver = phpversion(self::REF_NAME);
        if ($extver === false) {
            $extver = self::REF_VERSION;
        }

        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.2.2';
        } else {
            $version1 = $extver;
            $version2 = '1.0.1';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '5.1.3' : '5.2.2';
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
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '0.1.0';       // 2008-07-21 (beta)
        $items = array(
            'SphinxClient'                  => array('5.1.3', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/sphinx.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.1.0';       // 2008-07-21 (beta)
        $items = array(
            'SEARCHD_ERROR'                           => array('5.1.3', ''),
            'SEARCHD_OK'                              => array('5.1.3', ''),
            'SEARCHD_RETRY'                           => array('5.1.3', ''),
            'SEARCHD_WARNING'                         => array('5.1.3', ''),

            'SPH_ATTR_BOOL'                           => array('5.1.3', ''),
            'SPH_ATTR_FLOAT'                          => array('5.1.3', ''),
            'SPH_ATTR_INTEGER'                        => array('5.1.3', ''),
            'SPH_ATTR_MULTI'                          => array('5.1.3', ''),
            'SPH_ATTR_ORDINAL'                        => array('5.1.3', ''),
            'SPH_ATTR_TIMESTAMP'                      => array('5.1.3', ''),
            'SPH_FILTER_FLOATRANGE'                   => array('5.1.3', ''),

            'SPH_FILTER_RANGE'                        => array('5.1.3', ''),
            'SPH_FILTER_VALUES'                       => array('5.1.3', ''),
            'SPH_GROUPBY_ATTR'                        => array('5.1.3', ''),
            'SPH_GROUPBY_ATTRPAIR'                    => array('5.1.3', ''),

            'SPH_GROUPBY_DAY'                         => array('5.1.3', ''),
            'SPH_GROUPBY_MONTH'                       => array('5.1.3', ''),
            'SPH_GROUPBY_WEEK'                        => array('5.1.3', ''),
            'SPH_GROUPBY_YEAR'                        => array('5.1.3', ''),
            'SPH_MATCH_ALL'                           => array('5.1.3', ''),
            'SPH_MATCH_ANY'                           => array('5.1.3', ''),

            'SPH_MATCH_BOOLEAN'                       => array('5.1.3', ''),
            'SPH_MATCH_EXTENDED'                      => array('5.1.3', ''),
            'SPH_MATCH_EXTENDED2'                     => array('5.1.3', ''),

            'SPH_MATCH_FULLSCAN'                      => array('5.1.3', ''),
            'SPH_MATCH_PHRASE'                        => array('5.1.3', ''),
            'SPH_RANK_BM25'                           => array('5.1.3', ''),
            'SPH_RANK_NONE'                           => array('5.1.3', ''),
            'SPH_RANK_PROXIMITY_BM25'                 => array('5.1.3', ''),
            'SPH_RANK_WORDCOUNT'                      => array('5.1.3', ''),

            'SPH_SORT_ATTR_ASC'                       => array('5.1.3', ''),
            'SPH_SORT_ATTR_DESC'                      => array('5.1.3', ''),
            'SPH_SORT_EXPR'                           => array('5.1.3', ''),
            'SPH_SORT_EXTENDED'                       => array('5.1.3', ''),
            'SPH_SORT_RELEVANCE'                      => array('5.1.3', ''),
            'SPH_SORT_TIME_SEGMENTS'                  => array('5.1.3', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.1.0';       // 2010-09-17 (stable)
        $items = array(
            'SPH_RANK_FIELDMASK'                      => array('5.2.2', ''),
            'SPH_RANK_MATCHANY'                       => array('5.2.2', ''),
            'SPH_RANK_PROXIMITY'                      => array('5.2.2', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.3.0';       // 2013-04-04 (stable)
        $items = array(
            'SPH_RANK_SPH04'                          => array('5.2.2', ''),
            'SPH_RANK_EXPR'                           => array('5.2.2', ''),
            'SPH_RANK_TOTAL'                          => array('5.2.2', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
