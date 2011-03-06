<?php
/**
 * Version informations about pcntl extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about pcntl extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.pcntl.php
 */
class PHP_CompatInfo_Reference_Pcntl implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'pcntl' => array('4.1.0', '', '')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.pcntl.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'pcntl_alarm'             => array('4.3.0', ''),
                'pcntl_exec'              => array('4.2.0', ''),
                'pcntl_fork'              => array('4.1.0', ''),
                'pcntl_signal'            => array('4.1.0', ''),
                'pcntl_waitpid'           => array('4.1.0', ''),
                'pcntl_wexitstatus'       => array('4.1.0', ''),
                'pcntl_wifexited'         => array('4.1.0', ''),
                'pcntl_wifsignaled'       => array('4.1.0', ''),
                'pcntl_wifstopped'        => array('4.1.0', ''),
                'pcntl_wstopsig'          => array('4.1.0', ''),
                'pcntl_wtermsig'          => array('4.1.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'pcntl_getpriority'       => array('5.0.0', ''),
                'pcntl_setpriority'       => array('5.0.0', ''),
                'pcntl_signal_dispatch'   => array('5.3.0', ''),
                'pcntl_sigprocmask'       => array('5.3.0', ''),
                'pcntl_sigtimedwait'      => array('5.3.0', ''),
                'pcntl_sigwaitinfo'       => array('5.3.0', ''),
                'pcntl_wait'              => array('5.0.0', ''),
                // Not (yet) in Documentation - found in NEW
                'pcntl_get_last_error'    => array('5.3.4', ''),
                'pcntl_errno'             => array('5.3.4', ''),
                'pcntl_strerror'          => array('5.3.4', ''),
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'WNOHANG'         => array('4.1.0', ''),
                'WUNTRACED'       => array('4.1.0', ''),
                'SIG_IGN'         => array('4.1.0', ''),
                'SIG_DFL'         => array('4.1.0', ''),
                'SIG_ERR'         => array('4.1.0', ''),
                'SIGHUP'          => array('4.1.0', ''),
                'SIGINT'          => array('4.1.0', ''),
                'SIGQUIT'         => array('4.1.0', ''),
                'SIGILL'          => array('4.1.0', ''),
                'SIGTRAP'         => array('4.1.0', ''),
                'SIGABRT'         => array('4.1.0', ''),
                'SIGIOT'          => array('4.1.0', ''),
                'SIGBUS'          => array('4.1.0', ''),
                'SIGFPE'          => array('4.1.0', ''),
                'SIGKILL'         => array('4.1.0', ''),
                'SIGUSR1'         => array('4.1.0', ''),
                'SIGSEGV'         => array('4.1.0', ''),
                'SIGUSR2'         => array('4.1.0', ''),
                'SIGPIPE'         => array('4.1.0', ''),
                'SIGALRM'         => array('4.1.0', ''),
                'SIGTERM'         => array('4.1.0', ''),
                'SIGSTKFLT'       => array('4.1.0', ''),
                'SIGCLD'          => array('4.1.0', ''),
                'SIGCHLD'         => array('4.1.0', ''),
                'SIGCONT'         => array('4.1.0', ''),
                'SIGSTOP'         => array('4.1.0', ''),
                'SIGTSTP'         => array('4.1.0', ''),
                'SIGTTIN'         => array('4.1.0', ''),
                'SIGTTOU'         => array('4.1.0', ''),
                'SIGURG'          => array('4.1.0', ''),
                'SIGXCPU'         => array('4.1.0', ''),
                'SIGXFSZ'         => array('4.1.0', ''),
                'SIGVTALRM'       => array('4.1.0', ''),
                'SIGPROF'         => array('4.1.0', ''),
                'SIGWINCH'        => array('4.1.0', ''),
                'SIGPOLL'         => array('4.1.0', ''),
                'SIGIO'           => array('4.1.0', ''),
                'SIGPWR'          => array('4.1.0', ''),
                'SIGSYS'          => array('4.1.0', ''),
                'SIGBABY'         => array('4.1.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'SIG_BLOCK'         => array('5.3.0', ''),
                'SIG_UNBLOCK'       => array('5.3.0', ''),
                'SIG_SETMASK'       => array('5.3.0', ''),
                'SI_USER'           => array('5.3.0', ''),
                'SI_NOINFO'         => array('5.3.0', ''),
                'SI_KERNEL'         => array('5.3.0', ''),
                'SI_QUEUE'          => array('5.3.0', ''),
                'SI_TIMER'          => array('5.3.0', ''),
                'SI_MESGQ'          => array('5.3.0', ''),
                'SI_ASYNCIO'        => array('5.3.0', ''),
                'SI_SIGIO'          => array('5.3.0', ''),
                'SI_TKILL'          => array('5.3.0', ''),
                'CLD_EXITED'        => array('5.3.0', ''),
                'CLD_KILLED'        => array('5.3.0', ''),
                'CLD_DUMPED'        => array('5.3.0', ''),
                'CLD_TRAPPED'       => array('5.3.0', ''),
                'CLD_STOPPED'       => array('5.3.0', ''),
                'CLD_CONTINUED'     => array('5.3.0', ''),
                'TRAP_BRKPT'        => array('5.3.0', ''),
                'TRAP_TRACE'        => array('5.3.0', ''),
                'POLL_IN'           => array('5.3.0', ''),
                'POLL_OUT'          => array('5.3.0', ''),
                'POLL_MSG'          => array('5.3.0', ''),
                'POLL_ERR'          => array('5.3.0', ''),
                'POLL_PRI'          => array('5.3.0', ''),
                'POLL_HUP'          => array('5.3.0', ''),
                'ILL_ILLOPC'        => array('5.3.0', ''),
                'ILL_ILLOPN'        => array('5.3.0', ''),
                'ILL_ILLADR'        => array('5.3.0', ''),
                'ILL_ILLTRP'        => array('5.3.0', ''),
                'ILL_PRVOPC'        => array('5.3.0', ''),
                'ILL_PRVREG'        => array('5.3.0', ''),
                'ILL_COPROC'        => array('5.3.0', ''),
                'ILL_BADSTK'        => array('5.3.0', ''),
                'FPE_INTDIV'        => array('5.3.0', ''),
                'FPE_INTOVF'        => array('5.3.0', ''),
                'FPE_FLTDIV'        => array('5.3.0', ''),
                'FPE_FLTOVF'        => array('5.3.0', ''),
                'FPE_FLTUND'        => array('5.3.0', ''),
                'FPE_FLTRES'        => array('5.3.0', ''),
                'FPE_FLTINV'        => array('5.3.0', ''),
                'FPE_FLTSUB'        => array('5.3.0', ''),
                'SEGV_MAPERR'       => array('5.3.0', ''),
                'SEGV_ACCERR'       => array('5.3.0', ''),
                'BUS_ADRALN'        => array('5.3.0', ''),
                'BUS_ADRERR'        => array('5.3.0', ''),
                'BUS_OBJERR'        => array('5.3.0', ''),
                // Not (yet) in documentation
                'PRIO_PGRP'          => array('', ''),
                'PRIO_USER'          => array('', ''),
                'PRIO_PROCESS'       => array('', ''),
                'PCNTL_EINTR'        => array('', ''),
                'PCNTL_ECHILD'       => array('', ''),
                'PCNTL_EINVAL'       => array('', ''),
                'PCNTL_EAGAIN'       => array('', ''),
                'PCNTL_ESRCH'        => array('', ''),
                'PCNTL_EACCES'       => array('', ''),
                'PCNTL_EPERM'        => array('', ''),
                'PCNTL_ENOMEM'       => array('', ''),
                'PCNTL_E2BIG'        => array('', ''),
                'PCNTL_EFAULT'       => array('', ''),
                'PCNTL_EIO'          => array('', ''),
                'PCNTL_EISDIR'       => array('', ''),
                'PCNTL_ELIBBAD'      => array('', ''),
                'PCNTL_ELOOP'        => array('', ''),
                'PCNTL_EMFILE'       => array('', ''),
                'PCNTL_ENAMETOOLONG' => array('', ''),
                'PCNTL_ENFILE'       => array('', ''),
                'PCNTL_ENOENT'       => array('', ''),
                'PCNTL_ENOEXEC'      => array('', ''),
                'PCNTL_ENOTDIR'      => array('', ''),
                'PCNTL_ETXTBSY'      => array('', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
