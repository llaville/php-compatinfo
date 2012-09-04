<?php
/**
 * Version informations about mysql extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about mysql extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mysql.php
 */
class PHP_CompatInfo_Reference_Mysql
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mysql';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.0';

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
     * @link   http://www.php.net/manual/en/ref.mysql.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'mysql'                          => array('4.0.0', ''),
            'mysql_affected_rows'            => array('4.0.0', ''),
            'mysql_client_encoding'          => array('4.3.0', ''),
            'mysql_close'                    => array('4.0.0', ''),
            'mysql_connect'                  => array('4.0.0', ''),
            'mysql_create_db'                => array('4.0.0', ''),
            'mysql_data_seek'                => array('4.0.0', ''),
            'mysql_db_name'                  => array('4.0.0', ''),
            'mysql_db_query'                 => array('4.0.0', ''),
            'mysql_dbname'                   => array('4.0.0', ''),
            'mysql_drop_db'                  => array('4.0.0', ''),
            'mysql_errno'                    => array('4.0.0', ''),
            'mysql_error'                    => array('4.0.0', ''),
            'mysql_escape_string'            => array('4.0.3', ''),
            'mysql_fetch_array'              => array('4.0.0', ''),
            'mysql_fetch_assoc'              => array('4.0.3', ''),
            'mysql_fetch_field'              => array('4.0.0', ''),
            'mysql_fetch_lengths'            => array('4.0.0', ''),
            'mysql_fetch_object'             => array('4.0.0', ''),
            'mysql_fetch_row'                => array('4.0.0', ''),
            'mysql_field_flags'              => array('4.0.0', ''),
            'mysql_field_len'                => array('4.0.0', ''),
            'mysql_field_name'               => array('4.0.0', ''),
            'mysql_field_seek'               => array('4.0.0', ''),
            'mysql_field_table'              => array('4.0.0', ''),
            'mysql_field_type'               => array('4.0.0', ''),
            'mysql_fieldflags'               => array('4.0.0', ''),
            'mysql_fieldlen'                 => array('4.0.0', ''),
            'mysql_fieldname'                => array('4.0.0', ''),
            'mysql_fieldtable'               => array('4.0.0', ''),
            'mysql_fieldtype'                => array('4.0.0', ''),
            'mysql_free_result'              => array('4.0.0', ''),
            'mysql_freeresult'               => array('4.0.0', ''),
            'mysql_get_client_info'          => array('4.0.5', ''),
            'mysql_get_host_info'            => array('4.0.5', ''),
            'mysql_get_proto_info'           => array('4.0.5', ''),
            'mysql_get_server_info'          => array('4.0.5', ''),
            'mysql_info'                     => array('4.3.0', ''),
            'mysql_insert_id'                => array('4.0.0', ''),
            'mysql_list_dbs'                 => array('4.0.0', ''),
            'mysql_list_fields'              => array('4.0.0', ''),
            'mysql_list_processes'           => array('4.3.0', ''),
            'mysql_list_tables'              => array('4.0.0', ''),
            'mysql_listdbs'                  => array('4.0.0', ''),
            'mysql_listfields'               => array('4.0.0', ''),
            'mysql_listtables'               => array('4.0.0', ''),
            'mysql_num_fields'               => array('4.0.0', ''),
            'mysql_num_rows'                 => array('4.0.0', ''),
            'mysql_numfields'                => array('4.0.0', ''),
            'mysql_numrows'                  => array('4.0.0', ''),
            'mysql_pconnect'                 => array('4.0.0', ''),
            'mysql_ping'                     => array('4.3.0', ''),
            'mysql_query'                    => array('4.0.0', ''),
            'mysql_real_escape_string'       => array('4.3.0', ''),
            'mysql_result'                   => array('4.0.0', ''),
            'mysql_select_db'                => array('4.0.0', ''),
            'mysql_selectdb'                 => array('4.0.0', ''),
            'mysql_set_charset'              => array('5.2.3', ''),
            'mysql_stat'                     => array('4.3.0', ''),
            'mysql_table_name'               => array('4.0.0', ''),
            'mysql_tablename'                => array('4.0.0', ''),
            'mysql_thread_id'                => array('4.3.0', ''),
            'mysql_unbuffered_query'         => array('4.0.6', ''),
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
     * @link   http://www.php.net/manual/en/mysql.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'MYSQL_ASSOC'                    => array('4.0.0', ''),
            'MYSQL_BOTH'                     => array('4.0.0', ''),
            'MYSQL_CLIENT_COMPRESS'          => array('4.3.0', ''),
            'MYSQL_CLIENT_IGNORE_SPACE'      => array('4.3.0', ''),
            'MYSQL_CLIENT_INTERACTIVE'       => array('4.3.0', ''),
            'MYSQL_CLIENT_SSL'               => array('4.3.0', ''),
            'MYSQL_NUM'                      => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
