<?php
/**
 * Version informations about sockets extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about sockets extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.sockets.php
 */
class PHP_CompatInfo_Reference_Sockets
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'sockets';

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
        $phpMin = '4.1.0';
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
     * @link   http://www.php.net/manual/en/ref.sockets.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'socket_accept'                  => array('4.1.0', ''),
            'socket_bind'                    => array('4.1.0', ''),
            'socket_clear_error'             => array('4.2.0', ''),
            'socket_close'                   => array('4.1.0', ''),
            'socket_connect'                 => array('4.1.0', ''),
            'socket_create'                  => array('4.1.0', ''),
            'socket_create_listen'           => array('4.1.0', ''),
            'socket_create_pair'             => array('4.1.0', ''),
            'socket_get_option'              => array('4.3.0', ''),
            'socket_getopt'                  => array('4.1.0', ''),
            'socket_getpeername'             => array('4.1.0', ''),
            'socket_getsockname'             => array('4.1.0', ''),
            'socket_import_stream'           => array('5.4.0', ''),
            'socket_last_error'              => array('4.1.0', ''),
            'socket_listen'                  => array('4.1.0', ''),
            'socket_read'                    => array('4.1.0', ''),
            'socket_recv'                    => array('4.1.0', ''),
            'socket_recvfrom'                => array('4.1.0', ''),
            'socket_select'                  => array('4.1.0', ''),
            'socket_send'                    => array('4.1.0', ''),
            'socket_sendto'                  => array('4.1.0', ''),
            'socket_set_block'               => array('4.2.0', ''),
            'socket_set_nonblock'            => array('4.1.0', ''),
            'socket_set_option'              => array('4.3.0', ''),
            'socket_setopt'                  => array('4.1.0', ''),
            'socket_shutdown'                => array('4.1.0', ''),
            'socket_strerror'                => array('4.1.0', ''),
            'socket_write'                   => array('4.1.0', ''),
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
     * @link   http://www.php.net/manual/en/sockets.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'AF_INET'                        => array('4.1.0', ''),
            'AF_INET6'                       => array('4.1.0', ''),
            'AF_UNIX'                        => array('4.1.0', ''),
            'IPPROTO_IP'                     => array('5.4.0', ''),
            'IPPROTO_IPV6'                   => array('5.4.0', ''),
            'IPV6_MULTICAST_HOPS'            => array('5.4.0', ''),
            'IPV6_MULTICAST_IF'              => array('5.4.0', ''),
            'IPV6_MULTICAST_LOOP'            => array('5.4.0', ''),
            'IP_MULTICAST_IF'                => array('5.4.0', ''),
            'IP_MULTICAST_LOOP'              => array('5.4.0', ''),
            'IP_MULTICAST_TTL'               => array('5.4.0', ''),
            'MCAST_BLOCK_SOURCE'             => array('5.4.0', ''),
            'MCAST_JOIN_GROUP'               => array('5.4.0', ''),
            'MCAST_JOIN_SOURCE_GROUP'        => array('5.4.0', ''),
            'MCAST_LEAVE_GROUP'              => array('5.4.0', ''),
            'MCAST_LEAVE_SOURCE_GROUP'       => array('5.4.0', ''),
            'MCAST_UNBLOCK_SOURCE'           => array('5.4.0', ''),
            'MSG_DONTROUTE'                  => array('4.1.0', ''),
            'MSG_DONTWAIT'                   => array('5.2.10', ''),
            'MSG_EOF'                        => array('5.2.4', ''),
            'MSG_EOR'                        => array('5.2.4', ''),
            'MSG_OOB'                        => array('4.1.0', ''),
            'MSG_PEEK'                       => array('4.1.0', ''),
            'MSG_WAITALL'                    => array('4.1.0', ''),
            'PHP_BINARY_READ'                => array('4.1.0', ''),
            'PHP_NORMAL_READ'                => array('4.1.0', ''),
            'SOCKET_E2BIG'                   => array('4.3.0', ''),
            'SOCKET_EACCES'                  => array('4.1.0', ''),
            'SOCKET_EADDRINUSE'              => array('4.1.0', ''),
            'SOCKET_EADDRNOTAVAIL'           => array('4.1.0', ''),
            'SOCKET_EADV'                    => array('4.3.0', ''),
            'SOCKET_EAFNOSUPPORT'            => array('4.1.0', ''),
            'SOCKET_EAGAIN'                  => array('4.3.0', ''),
            'SOCKET_EALREADY'                => array('4.1.0', ''),
            'SOCKET_EBADE'                   => array('4.3.0', ''),
            'SOCKET_EBADF'                   => array('4.1.0', ''),
            'SOCKET_EBADFD'                  => array('4.3.0', ''),
            'SOCKET_EBADMSG'                 => array('4.3.0', ''),
            'SOCKET_EBADR'                   => array('4.3.0', ''),
            'SOCKET_EBADRQC'                 => array('4.3.0', ''),
            'SOCKET_EBADSLT'                 => array('4.3.0', ''),
            'SOCKET_EBUSY'                   => array('4.3.0', ''),
            'SOCKET_ECHRNG'                  => array('4.3.0', ''),
            'SOCKET_ECOMM'                   => array('4.3.0', ''),
            'SOCKET_ECONNABORTED'            => array('4.1.0', ''),
            'SOCKET_ECONNREFUSED'            => array('4.1.0', ''),
            'SOCKET_ECONNRESET'              => array('4.1.0', ''),
            'SOCKET_EDESTADDRREQ'            => array('4.1.0', ''),
            'SOCKET_EDISCON'                 => array('4.1.0', ''),
            'SOCKET_EDQUOT'                  => array('4.1.0', ''),
            'SOCKET_EEXIST'                  => array('4.3.0', ''),
            'SOCKET_EFAULT'                  => array('4.1.0', ''),
            'SOCKET_EHOSTDOWN'               => array('4.1.0', ''),
            'SOCKET_EHOSTUNREACH'            => array('4.1.0', ''),
            'SOCKET_EIDRM'                   => array('4.3.0', ''),
            'SOCKET_EINPROGRESS'             => array('4.1.0', ''),
            'SOCKET_EINTR'                   => array('4.1.0', ''),
            'SOCKET_EINVAL'                  => array('4.1.0', ''),
            'SOCKET_EIO'                     => array('4.3.0', ''),
            'SOCKET_EISCONN'                 => array('4.1.0', ''),
            'SOCKET_EISDIR'                  => array('4.3.0', ''),
            'SOCKET_EISNAM'                  => array('4.3.0', ''),
            'SOCKET_EL2HLT'                  => array('4.3.0', ''),
            'SOCKET_EL2NSYNC'                => array('4.3.0', ''),
            'SOCKET_EL3HLT'                  => array('4.3.0', ''),
            'SOCKET_EL3RST'                  => array('4.3.0', ''),
            'SOCKET_ELNRNG'                  => array('4.3.0', ''),
            'SOCKET_ELOOP'                   => array('4.1.0', ''),
            'SOCKET_EMEDIUMTYPE'             => array('4.3.0', ''),
            'SOCKET_EMFILE'                  => array('4.1.0', ''),
            'SOCKET_EMLINK'                  => array('4.3.0', ''),
            'SOCKET_EMSGSIZE'                => array('4.1.0', ''),
            'SOCKET_EMULTIHOP'               => array('4.3.0', ''),
            'SOCKET_ENAMETOOLONG'            => array('4.1.0', ''),
            'SOCKET_ENETDOWN'                => array('4.1.0', ''),
            'SOCKET_ENETRESET'               => array('4.1.0', ''),
            'SOCKET_ENETUNREACH'             => array('4.1.0', ''),
            'SOCKET_ENFILE'                  => array('4.3.0', ''),
            'SOCKET_ENOANO'                  => array('4.3.0', ''),
            'SOCKET_ENOBUFS'                 => array('4.1.0', ''),
            'SOCKET_ENOCSI'                  => array('4.3.0', ''),
            'SOCKET_ENODATA'                 => array('4.3.0', ''),
            'SOCKET_ENODEV'                  => array('4.3.0', ''),
            'SOCKET_ENOENT'                  => array('4.3.0', ''),
            'SOCKET_ENOLCK'                  => array('4.3.0', ''),
            'SOCKET_ENOLINK'                 => array('4.3.0', ''),
            'SOCKET_ENOMEDIUM'               => array('4.3.0', ''),
            'SOCKET_ENOMEM'                  => array('4.3.0', ''),
            'SOCKET_ENOMSG'                  => array('4.3.0', ''),
            'SOCKET_ENONET'                  => array('4.3.0', ''),
            'SOCKET_ENOPROTOOPT'             => array('4.1.0', ''),
            'SOCKET_ENOSPC'                  => array('4.3.0', ''),
            'SOCKET_ENOSR'                   => array('4.3.0', ''),
            'SOCKET_ENOSTR'                  => array('4.3.0', ''),
            'SOCKET_ENOSYS'                  => array('4.3.0', ''),
            'SOCKET_ENOTBLK'                 => array('4.3.0', ''),
            'SOCKET_ENOTCONN'                => array('4.1.0', ''),
            'SOCKET_ENOTDIR'                 => array('4.3.0', ''),
            'SOCKET_ENOTEMPTY'               => array('4.1.0', ''),
            'SOCKET_ENOTSOCK'                => array('4.1.0', ''),
            'SOCKET_ENOTTY'                  => array('4.3.0', ''),
            'SOCKET_ENOTUNIQ'                => array('4.3.0', ''),
            'SOCKET_ENXIO'                   => array('4.3.0', ''),
            'SOCKET_EOPNOTSUPP'              => array('4.1.0', ''),
            'SOCKET_EPERM'                   => array('4.3.0', ''),
            'SOCKET_EPFNOSUPPORT'            => array('4.1.0', ''),
            'SOCKET_EPIPE'                   => array('4.3.0', ''),
            'SOCKET_EPROCLIM'                => array('4.1.0', ''),
            'SOCKET_EPROTO'                  => array('4.3.0', ''),
            'SOCKET_EPROTONOSUPPORT'         => array('4.1.0', ''),
            'SOCKET_EPROTOTYPE'              => array('4.1.0', ''),
            'SOCKET_EREMCHG'                 => array('4.3.0', ''),
            'SOCKET_EREMOTE'                 => array('4.1.0', ''),
            'SOCKET_EREMOTEIO'               => array('4.3.0', ''),
            'SOCKET_ERESTART'                => array('4.3.0', ''),
            'SOCKET_EROFS'                   => array('4.3.0', ''),
            'SOCKET_ESHUTDOWN'               => array('4.1.0', ''),
            'SOCKET_ESOCKTNOSUPPORT'         => array('4.1.0', ''),
            'SOCKET_ESPIPE'                  => array('4.3.0', ''),
            'SOCKET_ESRMNT'                  => array('4.3.0', ''),
            'SOCKET_ESTALE'                  => array('4.1.0', ''),
            'SOCKET_ESTRPIPE'                => array('4.3.0', ''),
            'SOCKET_ETIME'                   => array('4.3.0', ''),
            'SOCKET_ETIMEDOUT'               => array('4.1.0', ''),
            'SOCKET_ETOOMANYREFS'            => array('4.1.0', ''),
            'SOCKET_EUNATCH'                 => array('4.3.0', ''),
            'SOCKET_EUSERS'                  => array('4.1.0', ''),
            'SOCKET_EWOULDBLOCK'             => array('4.1.0', ''),
            'SOCKET_EXDEV'                   => array('4.3.0', ''),
            'SOCKET_EXFULL'                  => array('4.3.0', ''),
            'SOCKET_HOST_NOT_FOUND'          => array('4.1.0', ''),
            'SOCKET_NOTINITIALISED'          => array('4.1.0', ''),
            'SOCKET_NO_ADDRESS'              => array('4.1.0', ''),
            'SOCKET_NO_DATA'                 => array('4.1.0', ''),
            'SOCKET_NO_RECOVERY'             => array('4.1.0', ''),
            'SOCKET_SYSNOTREADY'             => array('4.1.0', ''),
            'SOCKET_TRY_AGAIN'               => array('4.1.0', ''),
            'SOCKET_VERNOTSUPPORTED'         => array('4.1.0', ''),
            'SOCK_DGRAM'                     => array('4.1.0', ''),
            'SOCK_RAW'                       => array('4.1.0', ''),
            'SOCK_RDM'                       => array('4.1.0', ''),
            'SOCK_SEQPACKET'                 => array('4.1.0', ''),
            'SOCK_STREAM'                    => array('4.1.0', ''),
            'SOL_SOCKET'                     => array('4.1.0', ''),
            'SOL_TCP'                        => array('4.1.0', ''),
            'SOL_UDP'                        => array('4.1.0', ''),
            'SOMAXCONN'                      => array('4.1.0', ''),
            'SO_BROADCAST'                   => array('4.1.0', ''),
            'SO_DEBUG'                       => array('4.1.0', ''),
            'SO_DONTROUTE'                   => array('4.1.0', ''),
            'SO_ERROR'                       => array('4.1.0', ''),
            'SO_KEEPALIVE'                   => array('4.1.0', ''),
            'SO_LINGER'                      => array('4.1.0', ''),
            'SO_OOBINLINE'                   => array('4.1.0', ''),
            'SO_RCVBUF'                      => array('4.1.0', ''),
            'SO_RCVLOWAT'                    => array('4.1.0', ''),
            'SO_RCVTIMEO'                    => array('4.1.0', ''),
            'SO_REUSEADDR'                   => array('4.1.0', ''),
            'SO_SNDBUF'                      => array('4.1.0', ''),
            'SO_SNDLOWAT'                    => array('4.1.0', ''),
            'SO_SNDTIMEO'                    => array('4.1.0', ''),
            'SO_TYPE'                        => array('4.1.0', ''),
            'TCP_NODELAY'                    => array('5.2.7', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
