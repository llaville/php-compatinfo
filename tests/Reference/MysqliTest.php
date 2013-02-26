<?php
/**
 * Unit tests for PHP_CompatInfo package, Mysqli Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC3
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Mysqli extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_MysqliTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Mysqli::getExtensions
     * @covers PHP_CompatInfo_Reference_Mysqli::getFunctions
     * @covers PHP_CompatInfo_Reference_Mysqli::getConstants
     * @return void
     */
    protected function setUp()
    {
        $this->optionalconstants = array(
            // Requires MYSQLI_USE_MYSQLND
            'MYSQLI_OPT_NET_CMD_BUFFER_SIZE',
            'MYSQLI_OPT_NET_READ_BUFFER_SIZE',
            'MYSQLI_OPT_INT_AND_FLOAT_NATIVE',
            'MYSQLI_ASYNC',
            'MYSQLI_ON_UPDATE_NOW_FLAG',
            // Requires REFRESH_BACKUP_LOG
            'MYSQLI_REFRESH_BACKUP_LOG',
            // Requires SERVER_QUERY_WAS_SLOW
            'MYSQLI_SERVER_QUERY_WAS_SLOW',
            // requires SERVER_PS_OUT_PARAMS
            'MYSQLI_SERVER_PS_OUT_PARAMS',
            // requires MYSQL_VERSION_ID >= 50611 or MYSQLI_USE_MYSQLND
            'MYSQLI_OPT_CAN_HANDLE_EXPIRED_PASSWORDS',
        );
        $this->optionalfunctions = array(
            // Requires HAVE_EMBEDDED_MYSQLI
            'mysqli_embedded_server_end',
            'mysqli_embedded_server_start',
            // Requires MYSQLI_USE_MYSQLND
            'mysqli_fetch_all',
            'mysqli_get_cache_stats',
            'mysqli_get_connection_stats',
            'mysqli_get_client_stats',
            'mysqli_set_local_infile_default',
            'mysqli_set_local_infile_handler',
            'mysqli_poll',
            'mysqli_reap_async_query',
            'mysqli_stmt_get_result',
            'mysqli_stmt_more_results',
            'mysqli_stmt_next_result',
        );
        $this->obj = new PHP_CompatInfo_Reference_Mysqli();
        parent::setUp();
    }
}
