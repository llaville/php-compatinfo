<?php
/**
 * Unit tests for PHP_CompatInfo, varnish extension Reference
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

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about varnish extension
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
class VarnishExtensionTest extends GenericTest
{
    const EXTNAME = 'Varnish';

    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        /* log is not working on windows at the time*/
        self::$optionalconstants = array(
            'VarnishLog::TAG_Debug',
            'VarnishLog::TAG_Error',
            'VarnishLog::TAG_CLI',
            'VarnishLog::TAG_SessOpen',
            'VarnishLog::TAG_SessClose',
            'VarnishLog::TAG_BackendOpen',
            'VarnishLog::TAG_BackendReuse',
            'VarnishLog::TAG_BackendClose',
            'VarnishLog::TAG_HttpGarbage',
            'VarnishLog::TAG_Backend',
            'VarnishLog::TAG_Length',
            'VarnishLog::TAG_FetchError',
            'VarnishLog::TAG_ReqMethod',
            'VarnishLog::TAG_ReqURL',
            'VarnishLog::TAG_ReqProtocol',
            'VarnishLog::TAG_ReqStatus',
            'VarnishLog::TAG_ReqReason',
            'VarnishLog::TAG_ReqHeader',
            'VarnishLog::TAG_ReqUnset',
            'VarnishLog::TAG_ReqLost',
            'VarnishLog::TAG_RespMethod',
            'VarnishLog::TAG_RespURL',
            'VarnishLog::TAG_RespProtocol',
            'VarnishLog::TAG_RespStatus',
            'VarnishLog::TAG_RespReason',
            'VarnishLog::TAG_RespHeader',
            'VarnishLog::TAG_RespUnset',
            'VarnishLog::TAG_RespLost',
            'VarnishLog::TAG_BereqMethod',
            'VarnishLog::TAG_BereqURL',
            'VarnishLog::TAG_BereqProtocol',
            'VarnishLog::TAG_BereqStatus',
            'VarnishLog::TAG_BereqReason',
            'VarnishLog::TAG_BereqHeader',
            'VarnishLog::TAG_BereqUnset',
            'VarnishLog::TAG_BereqLost',
            'VarnishLog::TAG_BerespMethod',
            'VarnishLog::TAG_BerespURL',
            'VarnishLog::TAG_BerespProtocol',
            'VarnishLog::TAG_BerespStatus',
            'VarnishLog::TAG_BerespReason',
            'VarnishLog::TAG_BerespHeader',
            'VarnishLog::TAG_BerespUnset',
            'VarnishLog::TAG_BerespLost',
            'VarnishLog::TAG_ObjMethod',
            'VarnishLog::TAG_ObjURL',
            'VarnishLog::TAG_ObjProtocol',
            'VarnishLog::TAG_ObjStatus',
            'VarnishLog::TAG_ObjReason',
            'VarnishLog::TAG_ObjHeader',
            'VarnishLog::TAG_ObjUnset',
            'VarnishLog::TAG_ObjLost',
            'VarnishLog::TAG_BogoHeader',
            'VarnishLog::TAG_LostHeader',
            'VarnishLog::TAG_TTL',
            'VarnishLog::TAG_Fetch_Body',
            'VarnishLog::TAG_VCL_acl',
            'VarnishLog::TAG_VCL_call',
            'VarnishLog::TAG_VCL_trace',
            'VarnishLog::TAG_VCL_return',
            'VarnishLog::TAG_ReqStart',
            'VarnishLog::TAG_Hit',
            'VarnishLog::TAG_HitPass',
            'VarnishLog::TAG_ExpBan',
            'VarnishLog::TAG_ExpKill',
            'VarnishLog::TAG_WorkThread',
            'VarnishLog::TAG_ESI_xmlerror',
            'VarnishLog::TAG_Hash',
            'VarnishLog::TAG_Backend_health',
            'VarnishLog::TAG_VCL_Log',
            'VarnishLog::TAG_VCL_Error',
            'VarnishLog::TAG_Gzip',
            'VarnishLog::TAG_Link',
            'VarnishLog::TAG_Begin',
            'VarnishLog::TAG_End',
            'VarnishLog::TAG_VSL',
            'VarnishLog::TAG_Storage',
            'VarnishLog::TAG_Timestamp',
            'VarnishLog::TAG_ReqAcct',
            'VarnishLog::TAG_ESI_BodyBytes',
            'VarnishLog::TAG_PipeAcct',
            'VarnishLog::TAG_BereqAcct',
        );
        parent::setUpBeforeClass();
    }
}
