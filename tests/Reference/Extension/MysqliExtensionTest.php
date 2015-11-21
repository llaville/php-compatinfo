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
            'MYSQLI_STORE_RESULT_COPY_DATA',

            // Requires DBUG_ON
            'MYSQLI_DEBUG_TRACE_ENABLED',

            // Requires REFRESH_BACKUP_LOG
            'MYSQLI_REFRESH_BACKUP_LOG',
            // Requires SERVER_QUERY_WAS_SLOW
            'MYSQLI_SERVER_QUERY_WAS_SLOW',
            // requires SERVER_PS_OUT_PARAMS
            'MYSQLI_SERVER_PS_OUT_PARAMS',
            // requires MYSQL_VERSION_ID >= 50611 or MYSQLI_USE_MYSQLND
            'MYSQLI_OPT_CAN_HANDLE_EXPIRED_PASSWORDS',
            'MYSQLI_CLIENT_CAN_HANDLE_EXPIRED_PASSWORDS',

            // Requires FIELD_TYPE_JSON
            'MYSQLI_TYPE_JSON',

            // Requires MYSQL_DATA_TRUNCATED
            'MYSQLI_DATA_TRUNCATED',

            // Requires MYSQLI_USE_MYSQLND
            // and
            // Requires MYSQL > 50111
            'MYSQLI_OPT_SSL_VERIFY_SERVER_CERT',

            // Requires MYSQL > 50002
            'MYSQLI_TYPE_NEWDECIMAL',
            'MYSQLI_TYPE_BIT',

            // Requires MYSQL > 50605
            'MYSQLI_SERVER_PUBLIC_KEY',

            // Requires MYSQL > 50003
            'MYSQLI_STMT_ATTR_CURSOR_TYPE',
            'MYSQLI_CURSOR_TYPE_NO_CURSOR',
            'MYSQLI_CURSOR_TYPE_READ_ONLY',
            'MYSQLI_CURSOR_TYPE_FOR_UPDATE',
            'MYSQLI_CURSOR_TYPE_SCROLLABLE',

            // Requires MYSQL > 50007
            'MYSQLI_STMT_ATTR_PREFETCH_ROWS',

            // Requires MYSQL > 50007
            'MYSQLI_NO_DEFAULT_VALUE_FLAG',

            // Requires MYSQL > 51122 and < 60000 || > 60003
            'MYSQLI_ON_UPDATE_NOW_FLAG'

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
        self::$ext = 'Mysqli';
        parent::setUpBeforeClass();
    }
}
