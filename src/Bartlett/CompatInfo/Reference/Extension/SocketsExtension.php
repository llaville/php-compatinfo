<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SocketsExtension extends AbstractReference
{
    const REF_NAME    = 'sockets';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 4.1.0
        if (version_compare($version, '4.1.0', 'ge')) {
            $release = $this->getR40100();
            $this->storage->attach($release);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $this->storage->attach($release);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $this->storage->attach($release);
        }

        // 5.2.4
        if (version_compare($version, '5.2.4', 'ge')) {
            $release = $this->getR50204();
            $this->storage->attach($release);
        }

        // 5.2.7
        if (version_compare($version, '5.2.7', 'ge')) {
            $release = $this->getR50207();
            $this->storage->attach($release);
        }

        // 5.2.10
        if (version_compare($version, '5.2.10', 'ge')) {
            $release = $this->getR50210();
            $this->storage->attach($release);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $this->storage->attach($release);
        }

        // 5.4.10
        if (version_compare($version, '5.4.10', 'ge')) {
            $release = $this->getR50410();
            $this->storage->attach($release);
        }

        // 5.4.18
        if (version_compare($version, '5.4.18', 'ge')) {
            $release = $this->getR50418();
            $this->storage->attach($release);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $this->storage->attach($release);
        }
    }

    protected function getR40100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-12-10',
            'php.min' => '4.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            'AF_INET'                       => null,
            'AF_INET6'                      => null,
            'AF_UNIX'                       => null,
            'MSG_DONTROUTE'                 => null,
            'MSG_OOB'                       => null,
            'MSG_PEEK'                      => null,
            'MSG_WAITALL'                   => null,
            'PHP_BINARY_READ'               => null,
            'PHP_NORMAL_READ'               => null,
            'SOCKET_EACCES'                 => null,
            'SOCKET_EADDRINUSE'             => null,
            'SOCKET_EADDRNOTAVAIL'          => null,
            'SOCKET_EAFNOSUPPORT'           => null,
            'SOCKET_EALREADY'               => null,
            'SOCKET_EBADF'                  => null,
            'SOCKET_ECONNABORTED'           => null,
            'SOCKET_ECONNREFUSED'           => null,
            'SOCKET_ECONNRESET'             => null,
            'SOCKET_EDESTADDRREQ'           => null,
            'SOCKET_EDISCON'                => null,
            'SOCKET_EDQUOT'                 => null,
            'SOCKET_EFAULT'                 => null,
            'SOCKET_EHOSTDOWN'              => null,
            'SOCKET_EHOSTUNREACH'           => null,
            'SOCKET_EINPROGRESS'            => null,
            'SOCKET_EINTR'                  => null,
            'SOCKET_EINVAL'                 => null,
            'SOCKET_EISCONN'                => null,
            'SOCKET_ELOOP'                  => null,
            'SOCKET_EMFILE'                 => null,
            'SOCKET_EMSGSIZE'               => null,
            'SOCKET_ENAMETOOLONG'           => null,
            'SOCKET_ENETDOWN'               => null,
            'SOCKET_ENETRESET'              => null,
            'SOCKET_ENETUNREACH'            => null,
            'SOCKET_ENOBUFS'                => null,
            'SOCKET_ENOPROTOOPT'            => null,
            'SOCKET_ENOTCONN'               => null,
            'SOCKET_ENOTEMPTY'              => null,
            'SOCKET_ENOTSOCK'               => null,
            'SOCKET_EOPNOTSUPP'             => null,
            'SOCKET_EPFNOSUPPORT'           => null,
            'SOCKET_EPROCLIM'               => null,
            'SOCKET_EPROTONOSUPPORT'        => null,
            'SOCKET_EPROTOTYPE'             => null,
            'SOCKET_EREMOTE'                => null,
            'SOCKET_ESHUTDOWN'              => null,
            'SOCKET_ESOCKTNOSUPPORT'        => null,
            'SOCKET_ESTALE'                 => null,
            'SOCKET_ETIMEDOUT'              => null,
            'SOCKET_ETOOMANYREFS'           => null,
            'SOCKET_EUSERS'                 => null,
            'SOCKET_EWOULDBLOCK'            => null,
            'SOCKET_HOST_NOT_FOUND'         => null,
            'SOCKET_NOTINITIALISED'         => null,
            'SOCKET_NO_ADDRESS'             => null,
            'SOCKET_NO_DATA'                => null,
            'SOCKET_NO_RECOVERY'            => null,
            'SOCKET_SYSNOTREADY'            => null,
            'SOCKET_TRY_AGAIN'              => null,
            'SOCKET_VERNOTSUPPORTED'        => null,
            'SOCK_DGRAM'                    => null,
            'SOCK_RAW'                      => null,
            'SOCK_RDM'                      => null,
            'SOCK_SEQPACKET'                => null,
            'SOCK_STREAM'                   => null,
            'SOL_SOCKET'                    => null,
            'SOL_TCP'                       => null,
            'SOL_UDP'                       => null,
            'SOMAXCONN'                     => null,
            'SO_BROADCAST'                  => null,
            'SO_DEBUG'                      => null,
            'SO_DONTROUTE'                  => null,
            'SO_ERROR'                      => null,
            'SO_KEEPALIVE'                  => null,
            'SO_LINGER'                     => null,
            'SO_OOBINLINE'                  => null,
            'SO_RCVBUF'                     => null,
            'SO_RCVLOWAT'                   => null,
            'SO_RCVTIMEO'                   => null,
            'SO_REUSEADDR'                  => null,
            'SO_SNDBUF'                     => null,
            'SO_SNDLOWAT'                   => null,
            'SO_SNDTIMEO'                   => null,
            'SO_TYPE'                       => null,
        );
        $release->functions = array(
            'socket_accept'                 => null,
            'socket_bind'                   => null,
            'socket_close'                  => null,
            'socket_connect'                => null,
            'socket_create'                 => null,
            'socket_create_listen'          => null,
            'socket_create_pair'            => null,
            'socket_getopt'                 => null,
            'socket_getpeername'            => null,
            'socket_getsockname'            => null,
            'socket_last_error'             => null,
            'socket_listen'                 => null,
            'socket_read'                   => null,
            'socket_recv'                   => null,
            'socket_recvfrom'               => null,
            'socket_select'                 => null,
            'socket_send'                   => null,
            'socket_sendto'                 => null,
            'socket_set_nonblock'           => null,
            'socket_setopt'                 => null,
            'socket_shutdown'               => null,
            'socket_strerror'               => null,
            'socket_write'                  => null,
        );
        return $release;
    }

    protected function getR40200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-04-22',
            'php.min' => '4.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'socket_clear_error'            => null,
            'socket_set_block'              => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'SOCKET_E2BIG'                  => null,
            'SOCKET_EADV'                   => null,
            'SOCKET_EAGAIN'                 => null,
            'SOCKET_EBADE'                  => null,
            'SOCKET_EBADFD'                 => null,
            'SOCKET_EBADMSG'                => null,
            'SOCKET_EBADR'                  => null,
            'SOCKET_EBADRQC'                => null,
            'SOCKET_EBADSLT'                => null,
            'SOCKET_EBUSY'                  => null,
            'SOCKET_ECHRNG'                 => null,
            'SOCKET_ECOMM'                  => null,
            'SOCKET_EEXIST'                 => null,
            'SOCKET_EIDRM'                  => null,
            'SOCKET_EIO'                    => null,
            'SOCKET_EISDIR'                 => null,
            'SOCKET_EISNAM'                 => null,
            'SOCKET_EL2HLT'                 => null,
            'SOCKET_EL2NSYNC'               => null,
            'SOCKET_EL3HLT'                 => null,
            'SOCKET_EL3RST'                 => null,
            'SOCKET_ELNRNG'                 => null,
            'SOCKET_EMEDIUMTYPE'            => null,
            'SOCKET_EMLINK'                 => null,
            'SOCKET_EMULTIHOP'              => null,
            'SOCKET_ENFILE'                 => null,
            'SOCKET_ENOANO'                 => null,
            'SOCKET_ENOCSI'                 => null,
            'SOCKET_ENODATA'                => null,
            'SOCKET_ENODEV'                 => null,
            'SOCKET_ENOENT'                 => null,
            'SOCKET_ENOLCK'                 => null,
            'SOCKET_ENOLINK'                => null,
            'SOCKET_ENOMEDIUM'              => null,
            'SOCKET_ENOMEM'                 => null,
            'SOCKET_ENOMSG'                 => null,
            'SOCKET_ENONET'                 => null,
            'SOCKET_ENOSPC'                 => null,
            'SOCKET_ENOSR'                  => null,
            'SOCKET_ENOSTR'                 => null,
            'SOCKET_ENOSYS'                 => null,
            'SOCKET_ENOTBLK'                => null,
            'SOCKET_ENOTDIR'                => null,
            'SOCKET_ENOTTY'                 => null,
            'SOCKET_ENOTUNIQ'               => null,
            'SOCKET_ENXIO'                  => null,
            'SOCKET_EPERM'                  => null,
            'SOCKET_EPIPE'                  => null,
            'SOCKET_EPROTO'                 => null,
            'SOCKET_EREMCHG'                => null,
            'SOCKET_EREMOTEIO'              => null,
            'SOCKET_ERESTART'               => null,
            'SOCKET_EROFS'                  => null,
            'SOCKET_ESPIPE'                 => null,
            'SOCKET_ESRMNT'                 => null,
            'SOCKET_ESTRPIPE'               => null,
            'SOCKET_ETIME'                  => null,
            'SOCKET_EUNATCH'                => null,
            'SOCKET_EXDEV'                  => null,
            'SOCKET_EXFULL'                 => null,
        );
        $release->functions = array(
            'socket_get_option'             => null,
            'socket_set_option'             => null,
        );
        return $release;
    }

    protected function getR50204()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-08-30',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->constants = array(
            'MSG_EOF'                       => null,
            'MSG_EOR'                       => null,
        );
        return $release;
    }

    protected function getR50207()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-12-04',
            'php.min' => '5.2.7',
            'php.max' => '',
        );
        $release->constants = array(
            'TCP_NODELAY'                   => null,
        );
        return $release;
    }

    protected function getR50210()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.10',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-18',
            'php.min' => '5.2.10',
            'php.max' => '',
        );
        $release->constants = array(
            'MSG_DONTWAIT'                  => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'IPPROTO_IP'                    => null,
            'IPPROTO_IPV6'                  => null,
            'IPV6_MULTICAST_HOPS'           => null,
            'IPV6_MULTICAST_IF'             => null,
            'IPV6_MULTICAST_LOOP'           => null,
            'IP_MULTICAST_IF'               => null,
            'IP_MULTICAST_LOOP'             => null,
            'IP_MULTICAST_TTL'              => null,
            'MCAST_BLOCK_SOURCE'            => null,
            'MCAST_JOIN_GROUP'              => null,
            'MCAST_JOIN_SOURCE_GROUP'       => null,
            'MCAST_LEAVE_GROUP'             => null,
            'MCAST_LEAVE_SOURCE_GROUP'      => null,
            'MCAST_UNBLOCK_SOURCE'          => null,
        );
        $release->functions = array(
            'socket_import_stream'          => null,
        );
        return $release;
    }

    protected function getR50410()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.10',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-12-20',
            'php.min' => '5.4.10',
            'php.max' => '',
        );
        $release->constants = array(
            'SO_REUSEPORT'                  => null,
        );
        return $release;
    }

    protected function getR50418()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.18',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-08-15',
            'php.min' => '5.4.18',
            'php.max' => '',
        );
        $release->constants = array(
            'SO_BINDTODEVICE'               => array(
                'php.excludes' => '5.5.0'
            ),
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->constants = array(
            'IPV6_HOPLIMIT'                 => null,
            'IPV6_PKTINFO'                  => null,
            'IPV6_RECVHOPLIMIT'             => null,
            'IPV6_RECVPKTINFO'              => null,
            'IPV6_RECVTCLASS'               => null,
            'IPV6_TCLASS'                   => null,
            'IPV6_UNICAST_HOPS'             => null,
            'MSG_CMSG_CLOEXEC'              => null,
            'MSG_CONFIRM'                   => null,
            'MSG_CTRUNC'                    => null,
            'MSG_ERRQUEUE'                  => null,
            'MSG_MORE'                      => null,
            'MSG_NOSIGNAL'                  => null,
            'MSG_TRUNC'                     => null,
            'MSG_WAITFORONE'                => null,
            'SCM_CREDENTIALS'               => null,
            'SCM_RIGHTS'                    => null,
            'SO_PASSCRED'                   => null,
        );
        $release->functions = array(
            'socket_cmsg_space'             => null,
            'socket_recvmsg'                => null,
            'socket_sendmsg'                => null,
        );
        return $release;
    }
}
