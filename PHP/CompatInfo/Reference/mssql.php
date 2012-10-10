<?php
/**
 * Version informations about mssql extension
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
 * All interfaces, classes, functions, constants about mssql extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mssql.php
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_Mssql
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mssql';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

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
        $phpMin = '4.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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
     * @link   http://www.php.net/manual/en/ref.mssql.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'mssql_bind'                              => array('4.0.7', ''),
            'mssql_close'                             => array('4.0.0', ''),
            'mssql_connect'                           => array('4.0.0', ''),
            'mssql_data_seek'                         => array('4.0.0', ''),
            'mssql_execute'                           => array('4.0.7', ''),
            'mssql_fetch_array'                       => array('4.0.0', ''),
            'mssql_fetch_assoc'                       => array('4.2.0', ''),
            'mssql_fetch_batch'                       => array('4.0.4', ''),
            'mssql_fetch_field'                       => array('4.0.0', ''),
            'mssql_fetch_object'                      => array('4.0.0', ''),
            'mssql_fetch_row'                         => array('4.0.0', ''),
            'mssql_field_length'                      => array('4.0.0', ''),
            'mssql_field_name'                        => array('4.0.0', ''),
            'mssql_field_seek'                        => array('4.0.0', ''),
            'mssql_field_type'                        => array('4.0.0', ''),
            'mssql_free_result'                       => array('4.0.0', ''),
            'mssql_free_statement'                    => array('4.3.2', ''),
            'mssql_get_last_message'                  => array('4.0.0', ''),
            'mssql_guid_string'                       => array('4.0.7', ''),
            'mssql_init'                              => array('4.0.7', ''),
            'mssql_min_error_severity'                => array('4.0.0', ''),
            'mssql_min_message_severity'              => array('4.0.0', ''),
            'mssql_next_result'                       => array('4.0.5', ''),
            'mssql_num_fields'                        => array('4.0.0', ''),
            'mssql_num_rows'                          => array('4.0.0', ''),
            'mssql_pconnect'                          => array('4.0.0', ''),
            'mssql_query'                             => array('4.0.0', ''),
            'mssql_result'                            => array('4.0.0', ''),
            'mssql_rows_affected'                     => array('4.0.4', ''),
            'mssql_select_db'                         => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/mssql.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'MSSQL_ASSOC'                             => array('4.0.0', ''),
            'MSSQL_BOTH'                              => array('4.0.0', ''),
            'MSSQL_NUM'                               => array('4.0.0', ''),
            'SQLBIT'                                  => array('4.0.0', ''),
            'SQLCHAR'                                 => array('4.0.0', ''),
            'SQLFLT4'                                 => array('4.0.0', ''),
            'SQLFLT8'                                 => array('4.0.0', ''),
            'SQLFLTN'                                 => array('4.0.0', ''),
            'SQLINT1'                                 => array('4.0.0', ''),
            'SQLINT2'                                 => array('4.0.0', ''),
            'SQLINT4'                                 => array('4.0.0', ''),
            'SQLTEXT'                                 => array('4.0.0', ''),
            'SQLVARCHAR'                              => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
