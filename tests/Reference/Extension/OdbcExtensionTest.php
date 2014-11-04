<?php
/**
 * Unit tests for PHP_CompatInfo, odbc extension Reference
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
 * @since      Class available since Release 3.0.0RC1
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;
use Bartlett\CompatInfo\Reference\Extension\OdbcExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about odbc extension
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
class OdbcExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        // This constants require ODBC >= 3.0.0
        self::$optionalconstants = array(
            // Standard data types
            'SQL_WCHAR',
            'SQL_WVARCHAR',
            'SQL_WLONGVARCHAR',
            'SQL_TYPE_DATE',
            'SQL_TYPE_TIME',
            'SQL_TYPE_TIMESTAMP',
            // SQLSpecialColumns values
            'SQL_BEST_ROWID',
            'SQL_ROWVER',
            'SQL_SCOPE_CURROW',
            'SQL_SCOPE_SESSION',
            'SQL_SCOPE_TRANSACTION',
            'SQL_NO_NULLS',
            'SQL_NULLABLE',
            // SQLStatistics values
            'SQL_INDEX_UNIQUE',
            'SQL_INDEX_ALL',
            'SQL_ENSURE',
            'SQL_QUICK',
        );

        self::$obj = new OdbcExtension();
        parent::setUpBeforeClass();
    }
}
