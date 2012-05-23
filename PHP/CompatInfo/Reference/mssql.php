<?php
/**
 * Version informations about mssql extension
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
 * All interfaces, classes, functions, constants about mssql extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mssql.php
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_Mssql implements PHP_CompatInfo_Reference
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
            'mssql' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.mssql.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
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
     * @link   http://www.php.net/manual/en/mssql.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
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
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
