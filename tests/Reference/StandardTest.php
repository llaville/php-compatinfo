<?php
/**
 * Unit tests for PHP_CompatInfo package, Standard Reference
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
 * about Standard extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_StandardTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Standard::getExtensions
     * @covers PHP_CompatInfo_Reference_Standard::getFunctions
     * @covers PHP_CompatInfo_Reference_Standard::getConstants
     * @covers PHP_CompatInfo_Reference_Standard::getClasses
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$ignoredfunctions = array(
            // functions moved from internal to ereg extension in 5.3.0
            'ereg_replace',
            'ereg',
            'eregi_replace',
            'eregi',
            'split',
            'spliti',
            'sql_regcase',
        );

        if (DIRECTORY_SEPARATOR == '/') {
            self::$optionalfunctions = array(
                // requires HAVE_CHROOT
                'chroot',
                // remove in some Linux distribution (Redhat, ...)
                'php_egg_logo_guid',
            );
        } else {
            self::$optionalfunctions = array(
                // requires HAVE_NL_LANGINFO (linux only)
                'nl_langinfo',
                // requires HAVE_STRPTIME (linux only)
                'strptime',
                // requires HAVE_STRFMON (linux only)
                'money_format',
                // requires HAVE_GETRUSAGE (linux only)
                'getrusage',
                // requires HAVE_CHROOT
                'chroot',
                // requires HAVE_FTOK (linux only)
                'ftok',
                // requires HAVE_NICE (linux only)
                'proc_nice',
                // requires HAVE_GETLOADAVG (linux only)
                'sys_getloadavg',
                // Linux only
                'lchgrp',
                'lchown',
                // native support in 5.3 only (windows)
                'acosh',
                'asinh',
                'atanh',
                'dns_check_record',
                'dns_get_mx',
                'dns_get_record',
                'expm1',
                'log1p',
                'checkdnsrr',
                'fnmatch',
                'getmxrr',
                'getopt',
                'inet_ntop',
                'inet_pton',
                'link',
                'linkinfo',
                'readlink',
                'stream_socket_pair',
                'symlink',
                'time_nanosleep',
                'time_sleep_until',
            );

            if (php_sapi_name() != 'cli') {
                // dl function still exists in CLI but was removed from other SAPI since PHP 5.3
                array_push(self::$optionalfunctions, 'dl');
            }

            self::$optionalconstants = array(
                // requires syslog
                'LOG_LOCAL0',
                'LOG_LOCAL1',
                'LOG_LOCAL2',
                'LOG_LOCAL3',
                'LOG_LOCAL4',
                'LOG_LOCAL5',
                'LOG_LOCAL6',
                'LOG_LOCAL7',
                // requires HAVE_FNMATCH (linux only)
                'FNM_NOESCAPE',
                'FNM_PATHNAME',
                'FNM_PERIOD',
                'FNM_CASEFOLD',
                // requires HAVE_LIBINTL
                'LC_MESSAGES',
                'ABDAY_1',
                'ABDAY_2',
                'ABDAY_3',
                'ABDAY_4',
                'ABDAY_5',
                'ABDAY_6',
                'ABDAY_7',
                'DAY_1',
                'DAY_2',
                'DAY_3',
                'DAY_4',
                'DAY_5',
                'DAY_6',
                'DAY_7',
                'ABMON_1',
                'ABMON_2',
                'ABMON_3',
                'ABMON_4',
                'ABMON_5',
                'ABMON_6',
                'ABMON_7',
                'ABMON_8',
                'ABMON_9',
                'ABMON_10',
                'ABMON_11',
                'ABMON_12',
                'MON_1',
                'MON_2',
                'MON_3',
                'MON_4',
                'MON_5',
                'MON_6',
                'MON_7',
                'MON_8',
                'MON_9',
                'MON_10',
                'MON_11',
                'MON_12',
                'AM_STR',
                'PM_STR',
                'D_T_FMT',
                'D_FMT',
                'T_FMT',
                'T_FMT_AMPM',
                'ERA',
                'ERA_D_T_FMT',
                'ERA_D_FMT',
                'ERA_T_FMT',
                'ALT_DIGITS',
                'CRNCYSTR',
                'RADIXCHAR',
                'THOUSEP',
                'YESEXPR',
                'NOEXPR',
                'CODESET',
                // native support in 5.3 only (windows)
                'DNS_A',
                'DNS_NS',
                'DNS_CNAME',
                'DNS_SOA',
                'DNS_PTR',
                'DNS_HINFO',
                'DNS_MX',
                'DNS_TXT',
                'DNS_SRV',
                'DNS_NAPTR',
                'DNS_AAAA',
                'DNS_A6',
                'DNS_ANY',
                'DNS_ALL',
                // Stream not supported
                'STREAM_IPPROTO_TCP',
                'STREAM_IPPROTO_UDP',
                'STREAM_IPPROTO_ICMP',
                'STREAM_IPPROTO_RAW',
            );
        }
        self::$obj = new PHP_CompatInfo_Reference_Standard();
        parent::setUpBeforeClass();
    }
}
