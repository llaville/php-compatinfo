<?php
/**
 * Version informations about odbc extension
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
 * All interfaces, classes, functions, constants about odbc extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.uodbc.php
 * @since    Class available since Release 2.10.0
 */
class PHP_CompatInfo_Reference_Odbc
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'odbc';

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
     * @link   http://www.php.net/manual/en/ref.uodbc.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'odbc_autocommit'                => array('4.0.0', ''),
            'odbc_binmode'                   => array('4.0.0', ''),
            'odbc_close_all'                 => array('4.0.0', ''),
            'odbc_close'                     => array('4.0.0', ''),
            'odbc_columnprivileges'          => array('4.0.0', ''),
            'odbc_columns'                   => array('4.0.0', ''),
            'odbc_commit'                    => array('4.0.0', ''),
            'odbc_connect'                   => array('4.0.0', ''),
            'odbc_cursor'                    => array('4.0.0', ''),
            'odbc_data_source'               => array('4.0.0', ''),
            'odbc_do'                        => array('4.0.0', ''),
            'odbc_error'                     => array('4.0.0', ''),
            'odbc_errormsg'                  => array('4.0.0', ''),
            'odbc_exec'                      => array('4.0.0', ''),
            'odbc_execute'                   => array('4.0.0', ''),
            'odbc_fetch_array'               => array('4.0.2', ''),
            'odbc_fetch_into'                => array('4.0.0', ''),
            'odbc_fetch_object'              => array('4.0.2', ''),
            'odbc_fetch_row'                 => array('4.0.0', ''),
            'odbc_field_len'                 => array('4.0.0', ''),
            'odbc_field_name'                => array('4.0.0', ''),
            'odbc_field_num'                 => array('4.0.0', ''),
            'odbc_field_precision'           => array('4.0.0', ''),
            'odbc_field_scale'               => array('4.0.0', ''),
            'odbc_field_type'                => array('4.0.0', ''),
            'odbc_foreignkeys'               => array('4.0.0', ''),
            'odbc_free_result'               => array('4.0.0', ''),
            'odbc_gettypeinfo'               => array('4.0.0', ''),
            'odbc_longreadlen'               => array('4.0.0', ''),
            'odbc_next_result'               => array('4.0.0', ''),
            'odbc_num_fields'                => array('4.0.0', ''),
            'odbc_num_rows'                  => array('4.0.0', ''),
            'odbc_pconnect'                  => array('4.0.0', ''),
            'odbc_prepare'                   => array('4.0.0', ''),
            'odbc_primarykeys'               => array('4.0.0', ''),
            'odbc_procedurecolumns'          => array('4.0.0', ''),
            'odbc_procedures'                => array('4.0.0', ''),
            'odbc_result_all'                => array('4.0.0', ''),
            'odbc_result'                    => array('4.0.0', ''),
            'odbc_rollback'                  => array('4.0.0', ''),
            'odbc_setoption'                 => array('4.0.0', ''),
            'odbc_specialcolumns'            => array('4.0.0', ''),
            'odbc_statistics'                => array('4.0.0', ''),
            'odbc_tableprivileges'           => array('4.0.0', ''),
            'odbc_tables'                    => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/uodbc.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'ODBC_TYPE'                         => array('4.0.0', ''),
            'ODBC_BINMODE_PASSTHRU'             => array('4.0.0', ''),
            'ODBC_BINMODE_RETURN'               => array('4.0.0', ''),
            'ODBC_BINMODE_CONVERT'              => array('4.0.0', ''),
            'SQL_ODBC_CURSORS'                  => array('4.0.0', ''),
            'SQL_CUR_USE_DRIVER'                => array('4.0.0', ''),
            'SQL_CUR_USE_IF_NEEDED'             => array('4.0.0', ''),
            'SQL_CUR_USE_ODBC'                  => array('4.0.0', ''),
            'SQL_CONCURRENCY'                   => array('4.0.0', ''),
            'SQL_CONCUR_READ_ONLY'              => array('4.0.0', ''),
            'SQL_CONCUR_LOCK'                   => array('4.0.0', ''),
            'SQL_CONCUR_ROWVER'                 => array('4.0.0', ''),
            'SQL_CONCUR_VALUES'                 => array('4.0.0', ''),
            'SQL_CURSOR_TYPE'                   => array('4.0.0', ''),
            'SQL_CURSOR_FORWARD_ONLY'           => array('4.0.0', ''),
            'SQL_CURSOR_KEYSET_DRIVEN'          => array('4.0.0', ''),
            'SQL_CURSOR_DYNAMIC'                => array('4.0.0', ''),
            'SQL_CURSOR_STATIC'                 => array('4.0.0', ''),
            'SQL_KEYSET_SIZE'                   => array('4.0.0', ''),
            // Data Source type
            'SQL_FETCH_FIRST'                   => array('4.3.0', ''),
            'SQL_FETCH_NEXT'                    => array('4.3.0', ''),
            // the standard data types
            'SQL_CHAR'                          => array('4.0.0', ''),
            'SQL_VARCHAR'                       => array('4.0.0', ''),
            'SQL_LONGVARCHAR'                   => array('4.0.0', ''),
            'SQL_DECIMAL'                       => array('4.0.0', ''),
            'SQL_NUMERIC'                       => array('4.0.0', ''),
            'SQL_BIT'                           => array('4.0.0', ''),
            'SQL_TINYINT'                       => array('4.0.0', ''),
            'SQL_SMALLINT'                      => array('4.0.0', ''),
            'SQL_INTEGER'                       => array('4.0.0', ''),
            'SQL_BIGINT'                        => array('4.0.0', ''),
            'SQL_REAL'                          => array('4.0.0', ''),
            'SQL_FLOAT'                         => array('4.0.0', ''),
            'SQL_DOUBLE'                        => array('4.0.0', ''),
            'SQL_BINARY'                        => array('4.0.0', ''),
            'SQL_VARBINARY'                     => array('4.0.0', ''),
            'SQL_LONGVARBINARY'                 => array('4.0.0', ''),
            'SQL_DATE'                          => array('4.0.0', ''),
            'SQL_TIME'                          => array('4.0.0', ''),
            'SQL_TIMESTAMP'                     => array('4.0.0', ''),
            'SQL_TYPE_DATE'                     => array('4.0.0', ''),
            'SQL_TYPE_TIME'                     => array('4.0.0', ''),
            'SQL_TYPE_TIMESTAMP'                => array('4.0.0', ''),
            // SQLSpecialColumns values
            'SQL_BEST_ROWID'                    => array('4.0.0', ''),
            'SQL_ROWVER'                        => array('4.0.0', ''),
            'SQL_SCOPE_CURROW'                  => array('4.0.0', ''),
            'SQL_SCOPE_TRANSACTION'             => array('4.0.0', ''),
            'SQL_SCOPE_SESSION'                 => array('4.0.0', ''),
            'SQL_NO_NULLS'                      => array('4.0.0', ''),
            'SQL_NULLABLE'                      => array('4.0.0', ''),
            // SQLStatistics values
            'SQL_INDEX_UNIQUE'                  => array('4.0.0', ''),
            'SQL_INDEX_ALL'                     => array('4.0.0', ''),
            'SQL_ENSURE'                        => array('4.0.0', ''),
            'SQL_QUICK'                         => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
