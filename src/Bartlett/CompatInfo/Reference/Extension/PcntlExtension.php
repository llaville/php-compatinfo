<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PcntlExtension extends AbstractReference
{
    const REF_NAME    = 'pcntl';
    const REF_VERSION = '';

    private $version_number;

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.1.0
        if (version_compare($version, '4.1.0', 'ge')) {
            $release = $this->getR40100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
        
        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.4
        if (version_compare($version, '5.3.4', 'ge')) {
            $release = $this->getR50304();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
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
        $release->functions = array(
            'pcntl_fork'                => null,
            'pcntl_signal'              => null,
            'pcntl_waitpid'             => null,
            'pcntl_wexitstatus'         => null,
            'pcntl_wifexited'           => null,
            'pcntl_wifsignaled'         => null,
            'pcntl_wifstopped'          => null,
            'pcntl_wstopsig'            => null,
            'pcntl_wtermsig'            => null,
        );
        $release->constants = array(
            'SIGABRT'                   => null,
            'SIGALRM'                   => null,
            'SIGBABY'                   => null,
            'SIGBUS'                    => null,
            'SIGCHLD'                   => null,
            'SIGCLD'                    => null,
            'SIGCONT'                   => null,
            'SIGFPE'                    => null,
            'SIGHUP'                    => null,
            'SIGILL'                    => null,
            'SIGINT'                    => null,
            'SIGIO'                     => null,
            'SIGIOT'                    => null,
            'SIGKILL'                   => null,
            'SIGPIPE'                   => null,
            'SIGPOLL'                   => null,
            'SIGPROF'                   => null,
            'SIGPWR'                    => null,
            'SIGQUIT'                   => null,
            'SIGSEGV'                   => null,
            'SIGSTKFLT'                 => null,
            'SIGSTOP'                   => null,
            'SIGSYS'                    => null,
            'SIGTERM'                   => null,
            'SIGTRAP'                   => null,
            'SIGTSTP'                   => null,
            'SIGTTIN'                   => null,
            'SIGTTOU'                   => null,
            'SIGURG'                    => null,
            'SIGUSR1'                   => null,
            'SIGUSR2'                   => null,
            'SIGVTALRM'                 => null,
            'SIGWINCH'                  => null,
            'SIGXCPU'                   => null,
            'SIGXFSZ'                   => null,
            'SIG_DFL'                   => null,
            'SIG_ERR'                   => null,
            'SIG_IGN'                   => null,
            'WNOHANG'                   => null,
            'WUNTRACED'                 => null,
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
            'pcntl_exec'                => null,
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
        $release->functions = array(
            'pcntl_alarm'               => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'PRIO_PGRP'                 => null,
            'PRIO_PROCESS'              => null,
            'PRIO_USER'                 => null,
        );
        $release->functions = array(
            'pcntl_getpriority'         => null,
            'pcntl_setpriority'         => null,
            'pcntl_wait'                => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'BUS_ADRALN'                => null,
            'BUS_ADRERR'                => null,
            'BUS_OBJERR'                => null,
            'CLD_CONTINUED'             => null,
            'CLD_DUMPED'                => null,
            'CLD_EXITED'                => null,
            'CLD_KILLED'                => null,
            'CLD_STOPPED'               => null,
            'CLD_TRAPPED'               => null,
            'FPE_FLTDIV'                => null,
            'FPE_FLTINV'                => null,
            'FPE_FLTOVF'                => null,
            'FPE_FLTRES'                => null,
            'FPE_FLTSUB'                => null,
            'FPE_FLTUND'                => null,
            'FPE_INTDIV'                => null,
            'FPE_INTOVF'                => null,
            'ILL_BADSTK'                => null,
            'ILL_COPROC'                => null,
            'ILL_ILLADR'                => null,
            'ILL_ILLOPC'                => null,
            'ILL_ILLOPN'                => null,
            'ILL_ILLTRP'                => null,
            'ILL_PRVOPC'                => null,
            'ILL_PRVREG'                => null,
            'POLL_ERR'                  => null,
            'POLL_HUP'                  => null,
            'POLL_IN'                   => null,
            'POLL_MSG'                  => null,
            'POLL_OUT'                  => null,
            'POLL_PRI'                  => null,
            'SEGV_ACCERR'               => null,
            'SEGV_MAPERR'               => null,
            'SIG_BLOCK'                 => null,
            'SIG_SETMASK'               => null,
            'SIG_UNBLOCK'               => null,
            'SI_ASYNCIO'                => null,
            'SI_KERNEL'                 => null,
            'SI_MESGQ'                  => null,
            'SI_NOINFO'                 => null,
            'SI_QUEUE'                  => null,
            'SI_SIGIO'                  => null,
            'SI_TIMER'                  => null,
            'SI_TKILL'                  => null,
            'SI_USER'                   => null,
            'TRAP_BRKPT'                => null,
            'TRAP_TRACE'                => null,
        );
        $release->functions = array(
            'pcntl_signal_dispatch'     => null,
            'pcntl_sigprocmask'         => null,
            'pcntl_sigtimedwait'        => null,
            'pcntl_sigwaitinfo'         => null,
        );
        return $release;
    }

    protected function getR50304()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-12-09',
            'php.min' => '5.3.4',
            'php.max' => '',
        );
        $release->constants = array(
            'PCNTL_E2BIG'               => null,
            'PCNTL_EACCES'              => null,
            'PCNTL_EAGAIN'              => null,
            'PCNTL_ECHILD'              => null,
            'PCNTL_EFAULT'              => null,
            'PCNTL_EINTR'               => null,
            'PCNTL_EINVAL'              => null,
            'PCNTL_EIO'                 => null,
            'PCNTL_EISDIR'              => null,
            'PCNTL_ELIBBAD'             => null,
            'PCNTL_ELOOP'               => null,
            'PCNTL_EMFILE'              => null,
            'PCNTL_ENAMETOOLONG'        => null,
            'PCNTL_ENFILE'              => null,
            'PCNTL_ENOENT'              => null,
            'PCNTL_ENOEXEC'             => null,
            'PCNTL_ENOMEM'              => null,
            'PCNTL_ENOTDIR'             => null,
            'PCNTL_EPERM'               => null,
            'PCNTL_ESRCH'               => null,
            'PCNTL_ETXTBSY'             => null,
        );
        $release->functions = array(
            'pcntl_errno'               => null,
            'pcntl_get_last_error'      => null,
            'pcntl_strerror'            => null,
        );
        return $release;
    }
}
