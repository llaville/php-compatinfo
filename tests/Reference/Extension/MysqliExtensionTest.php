<?php
/**
 * Unit tests for PHP_CompatInfo, mysqli extension Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.0.0
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;
use Bartlett\CompatInfo\Reference\Extension\MysqliExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about mysqli extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class MysqliExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
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
            'MYSQLI_CLIENT_CAN_HANDLE_EXPIRED_PASSWORDS',
        );
        self::$optionalfunctions = array(
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
        self::$obj = new MysqliExtension();
        parent::setUpBeforeClass();
    }
}
