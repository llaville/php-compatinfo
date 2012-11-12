<?php
/**
 * Unit tests for PHP_CompatInfo package, odbc Reference
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
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about odbc extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_OdbcTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Odbc::getExtensions
     * @covers PHP_CompatInfo_Reference_Odbc::getFunctions
     * @covers PHP_CompatInfo_Reference_Odbc::getConstants
     * @return void
     */
    protected function setUp()
    {
        // This constants require ODBC >= 3.0.0
        $this->optionnalconstants = array(
            // Standard data types
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
        $this->obj = new PHP_CompatInfo_Reference_Odbc();
        parent::setUp();
    }
}
