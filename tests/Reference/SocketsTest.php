<?php
/**
 * Unit tests for PHP_CompatInfo package, Sockets Reference
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
 * about Sockets extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_SocketsTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Sockets::getExtensions
     * @covers PHP_CompatInfo_Reference_Sockets::getFunctions
     * @covers PHP_CompatInfo_Reference_Sockets::getConstants
     * @return void
     */
    protected function setUp()
    {
        if (DIRECTORY_SEPARATOR == '\\') {
            $this->optionalconstants = array(
                // Win32 only
                'MSG_CMSG_CLOEXEC',
                'MSG_CONFIRM',
                'MSG_ERRQUEUE',
                'MSG_MORE',
                'MSG_NOSIGNAL',
                'MSG_WAITFORONE',
                'SCM_CREDENTIALS',
                'SCM_RIGHTS',
                'SO_PASSCRED',
            );
        } else {
            $this->optionalconstants = array(
                // Unix only
            );
        }
        $tmp = array(
            'SO_REUSEPORT',
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
            'SOCKET_ENOTTY',
            'SOCKET_ENOTBLK',
            'SOCKET_ENOTDIR',
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
            'MSG_DONTWAIT',
            'MSG_EOR',
            'MSG_EOF',            
        );
        $this->optionalconstants = array_merge($this->optionalconstants, $tmp);

        $this->optionalfunctions = array(
            // requires HAVE_SOCKETPAIR
            'socket_create_pair',
        );
        $this->obj = new PHP_CompatInfo_Reference_Sockets();
        parent::setUp();
    }
}
