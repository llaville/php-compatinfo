<?php
/**
 * Version informations about solr extension
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
 * All interfaces, classes, functions, constants about solr extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.solr.php
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_Solr
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'solr';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0.2';

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
        $phpMin = '5.2.3';
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

        $release = '0.9.11';      // 2010-06-22
        $items = array(
            'SolrClient'                        => array('5.2.3', ''),
            'SolrClientException'               => array('5.2.3', ''),
            'SolrDocument'                      => array('5.2.3', ''),
            'SolrDocumentField'                 => array('5.2.3', ''),
            'SolrException'                     => array('5.2.3', ''),
            'SolrGenericResponse'               => array('5.2.3', ''),
            'SolrIllegalArgumentException'      => array('5.2.3', ''),
            'SolrIllegalOperationException'     => array('5.2.3', ''),
            'SolrInputDocument'                 => array('5.2.3', ''),
            'SolrModifiableParams'              => array('5.2.3', ''),
            'SolrObject'                        => array('5.2.3', ''),
            'SolrParams'                        => array('5.2.3', ''),
            'SolrPingResponse'                  => array('5.2.3', ''),
            'SolrQuery'                         => array('5.2.3', ''),
            'SolrQueryResponse'                 => array('5.2.3', ''),
            'SolrResponse'                      => array('5.2.3', ''),
            'SolrUpdateResponse'                => array('5.2.3', ''),
            'SolrUtils'                         => array('5.2.3', ''),
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
     * @link   http://www.php.net/manual/en/ref.solr.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.9.11';      // 2010-06-22
        $items = array(
            'solr_get_version'                  => array('5.2.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
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
     * @link   http://www.php.net/manual/en/solr.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.9.11';      // 2010-06-22
        $items = array(
            'SOLR_EXTENSION_VERSION'            => array('5.2.3', ''),
            'SOLR_MAJOR_VERSION'                => array('5.2.3', ''),
            'SOLR_MINOR_VERSION'                => array('5.2.3', ''),
            'SOLR_PATCH_VERSION'                => array('5.2.3', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
