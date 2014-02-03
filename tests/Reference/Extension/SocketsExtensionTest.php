<?php
/**
 * Unit tests for PHP_CompatInfo, Sockets extension Reference
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
use Bartlett\CompatInfo\Reference\Extension\SocketsExtension;

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Sockets extension
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
class SocketsExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (PATH_SEPARATOR == ':') {
            self::$optionalconstants = array(
                // Win32 only (from ext/sockets/win32_socket_constants.h)
                'SOCKET_EDISCON',
                'SOCKET_EPROCLIM',
                'SOCKET_ESTALE',
                'SOCKET_HOST_NOT_FOUND',
                'SOCKET_NOTINITIALISED',
                'SOCKET_NO_ADDRESS',
                'SOCKET_NO_DATA',
                'SOCKET_NO_RECOVERY',
                'SOCKET_SYSNOTREADY',
                'SOCKET_TRY_AGAIN',
                'SOCKET_VERNOTSUPPORTED',
            );
        } else {
            self::$optionalconstants = array(
                // Unix only (from ext/sockets/unix_socket_constants.h)
                'SOCKET_E2BIG',
                'SOCKET_EADV',
                'SOCKET_EAGAIN',
                'SOCKET_EBADE',
                'SOCKET_EBADFD',
                'SOCKET_EBADMSG',
                'SOCKET_EBADR',
                'SOCKET_EBADRQC',
                'SOCKET_EBADSLT',
                'SOCKET_EBUSY',
                'SOCKET_ECHRNG',
                'SOCKET_ECOMM',
                'SOCKET_EEXIST',
                'SOCKET_EIDRM',
                'SOCKET_EIO',
                'SOCKET_EISDIR',
                'SOCKET_EISNAM',
                'SOCKET_EL2HLT',
                'SOCKET_EL2NSYNC',
                'SOCKET_EL3HLT',
                'SOCKET_EL3RST',
                'SOCKET_ELNRNG',
                'SOCKET_EMEDIUMTYPE',
                'SOCKET_EMLINK',
                'SOCKET_EMULTIHOP',
                'SOCKET_ENFILE',
                'SOCKET_ENOANO',
                'SOCKET_ENOCSI',
                'SOCKET_ENODATA',
                'SOCKET_ENODEV',
                'SOCKET_ENOENT',
                'SOCKET_ENOLCK',
                'SOCKET_ENOLINK',
                'SOCKET_ENOMEDIUM',
                'SOCKET_ENOMEM',
                'SOCKET_ENOMSG',
                'SOCKET_ENONET',
                'SOCKET_ENOSPC',
                'SOCKET_ENOSR',
                'SOCKET_ENOSTR',
                'SOCKET_ENOSYS',
                'SOCKET_ENOTBLK',
                'SOCKET_ENOTDIR',
                'SOCKET_ENOTTY',
                'SOCKET_ENOTUNIQ',
                'SOCKET_ENXIO',
                'SOCKET_EPERM',
                'SOCKET_EPIPE',
                'SOCKET_EPROTO',
                'SOCKET_EREMCHG',
                'SOCKET_EREMOTEIO',
                'SOCKET_ERESTART',
                'SOCKET_EROFS',
                'SOCKET_ESPIPE',
                'SOCKET_ESRMNT',
                'SOCKET_ESTRPIPE',
                'SOCKET_ETIME',
                'SOCKET_EUNATCH',
                'SOCKET_EXDEV',
                'SOCKET_EXFULL',
            );
        }
        // Common to Windows and Unix
        // (from ext/sockets/ win32_socket_constants.h and unix_socket_constants.h)
        $tmp = array(
            'SOCKET_EACCES',
            'SOCKET_EADDRINUSE',
            'SOCKET_EADDRNOTAVAIL',
            'SOCKET_EAFNOSUPPORT',
            'SOCKET_EALREADY',
            'SOCKET_EBADF',
            'SOCKET_ECONNABORTED',
            'SOCKET_ECONNREFUSED',
            'SOCKET_ECONNRESET',
            'SOCKET_EDESTADDRREQ',
            'SOCKET_EDQUOT',
            'SOCKET_EFAULT',
            'SOCKET_EHOSTDOWN',
            'SOCKET_EHOSTUNREACH',
            'SOCKET_EINPROGRESS',
            'SOCKET_EINTR',
            'SOCKET_EINVAL',
            'SOCKET_EISCONN',
            'SOCKET_ELOOP',
            'SOCKET_EMFILE',
            'SOCKET_EMSGSIZE',
            'SOCKET_ENAMETOOLONG',
            'SOCKET_ENETDOWN',
            'SOCKET_ENETRESET',
            'SOCKET_ENETUNREACH',
            'SOCKET_ENOBUFS',
            'SOCKET_ENOPROTOOPT',
            'SOCKET_ENOTCONN',
            'SOCKET_ENOTEMPTY',
            'SOCKET_ENOTSOCK',
            'SOCKET_EOPNOTSUPP',
            'SOCKET_EPFNOSUPPORT',
            'SOCKET_EPROTONOSUPPORT',
            'SOCKET_EPROTOTYPE',
            'SOCKET_EREMOTE',
            'SOCKET_ESHUTDOWN',
            'SOCKET_ESOCKTNOSUPPORT',
            'SOCKET_ETIMEDOUT',
            'SOCKET_ETOOMANYREFS',
            'SOCKET_EUSERS',
            'SOCKET_EWOULDBLOCK',

            // from ext/sockets/sendrecvmsg.c
            'IPV6_RECVPKTINFO',
            'IPV6_PKTINFO',
            'IPV6_RECVHOPLIMIT',
            'IPV6_HOPLIMIT',
            'IPV6_RECVTCLASS',
            'IPV6_TCLASS',
            'SCM_CREDENTIALS',
            'SCM_RIGHTS',
            'SO_PASSCRED',

            // from ext/sockets/sockets.c
            'AF_INET6',
            'MSG_EOR',
            'MSG_EOF',
            'MSG_CONFIRM',
            'MSG_ERRQUEUE',
            'MSG_NOSIGNAL',
            'MSG_DONTWAIT',
            'MSG_MORE',
            'MSG_WAITFORONE',
            'MSG_CMSG_CLOEXEC',
            'SO_BINDTODEVICE',
            'SO_REUSEPORT',
            'SO_FAMILY',
            'TCP_NODELAY',
            'MCAST_BLOCK_SOURCE',
            'MCAST_UNBLOCK_SOURCE',
            'MCAST_JOIN_SOURCE_GROUP',
            'MCAST_LEAVE_SOURCE_GROUP',
            'IPV6_MULTICAST_IF',
            'IPV6_MULTICAST_HOPS',
            'IPV6_MULTICAST_LOOP',
            'IPPROTO_IPV6',
            'IPV6_UNICAST_HOPS',
        );
        self::$optionalconstants = array_merge(self::$optionalconstants, $tmp);

        self::$optionalfunctions = array(
            // requires HAVE_SOCKETPAIR
            'socket_create_pair',
        );
        self::$obj = new SocketsExtension();
        parent::setUpBeforeClass();
    }
}
