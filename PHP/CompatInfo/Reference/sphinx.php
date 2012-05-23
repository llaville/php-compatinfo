<?php
/**
 * Version informations about sphinx extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about sphinx extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.sphinx.php
 * @since    Class available since Release ???
 */
class PHP_CompatInfo_Reference_Sphinx implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'sphinx' => array('5.2.2', '', '1.2.0')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'SphinxClient'                  => array('5.2.2', ''),
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/sphinx.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'SEARCHD_ERROR'                           => array('5.2.2', ''),
                'SEARCHD_OK'                              => array('5.2.2', ''),
                'SEARCHD_RETRY'                           => array('5.2.2', ''),
                'SEARCHD_WARNING'                         => array('5.2.2', ''),
                'SPH_ATTR_BOOL'                           => array('5.2.2', ''),
                'SPH_ATTR_FLOAT'                          => array('5.2.2', ''),
                'SPH_ATTR_INTEGER'                        => array('5.2.2', ''),
                'SPH_ATTR_MULTI'                          => array('5.2.2', ''),
                'SPH_ATTR_ORDINAL'                        => array('5.2.2', ''),
                'SPH_ATTR_TIMESTAMP'                      => array('5.2.2', ''),
                'SPH_FILTER_FLOATRANGE'                   => array('5.2.2', ''),
                'SPH_FILTER_RANGE'                        => array('5.2.2', ''),
                'SPH_FILTER_VALUES'                       => array('5.2.2', ''),
                'SPH_GROUPBY_ATTR'                        => array('5.2.2', ''),
                'SPH_GROUPBY_ATTRPAIR'                    => array('5.2.2', ''),
                'SPH_GROUPBY_DAY'                         => array('5.2.2', ''),
                'SPH_GROUPBY_MONTH'                       => array('5.2.2', ''),
                'SPH_GROUPBY_WEEK'                        => array('5.2.2', ''),
                'SPH_GROUPBY_YEAR'                        => array('5.2.2', ''),
                'SPH_MATCH_ALL'                           => array('5.2.2', ''),
                'SPH_MATCH_ANY'                           => array('5.2.2', ''),
                'SPH_MATCH_BOOLEAN'                       => array('5.2.2', ''),
                'SPH_MATCH_EXTENDED'                      => array('5.2.2', ''),
                'SPH_MATCH_EXTENDED2'                     => array('5.2.2', ''),
                'SPH_MATCH_FULLSCAN'                      => array('5.2.2', ''),
                'SPH_MATCH_PHRASE'                        => array('5.2.2', ''),
                'SPH_RANK_BM25'                           => array('5.2.2', ''),
                'SPH_RANK_NONE'                           => array('5.2.2', ''),
                'SPH_RANK_PROXIMITY_BM25'                 => array('5.2.2', ''),
                'SPH_RANK_WORDCOUNT'                      => array('5.2.2', ''),
                'SPH_SORT_ATTR_ASC'                       => array('5.2.2', ''),
                'SPH_SORT_ATTR_DESC'                      => array('5.2.2', ''),
                'SPH_SORT_EXPR'                           => array('5.2.2', ''),
                'SPH_SORT_EXTENDED'                       => array('5.2.2', ''),
                'SPH_SORT_RELEVANCE'                      => array('5.2.2', ''),
                'SPH_SORT_TIME_SEGMENTS'                  => array('5.2.2', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
