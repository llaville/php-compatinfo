<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PosixExtension extends AbstractReference
{
    const REF_NAME    = 'posix';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $this->storage->attach($release);
        }

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $this->storage->attach($release);
        }

        // 4.2.0
        if (version_compare($version, '4.2.0', 'ge')) {
            $release = $this->getR40200();
            $this->storage->attach($release);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $this->storage->attach($release);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $this->storage->attach($release);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'posix_ctermid'                     => null,
            'posix_getcwd'                      => null,
            'posix_getegid'                     => null,
            'posix_geteuid'                     => null,
            'posix_getgid'                      => null,
            'posix_getgrgid'                    => null,
            'posix_getgrnam'                    => null,
            'posix_getgroups'                   => null,
            'posix_getlogin'                    => null,
            'posix_getpgid'                     => null,
            'posix_getpgrp'                     => null,
            'posix_getpid'                      => null,
            'posix_getppid'                     => null,
            'posix_getpwnam'                    => null,
            'posix_getpwuid'                    => null,
            'posix_getrlimit'                   => null,
            'posix_getsid'                      => null,
            'posix_getuid'                      => null,
            'posix_isatty'                      => null,
            'posix_kill'                        => null,
            'posix_mkfifo'                      => null,
            'posix_setgid'                      => null,
            'posix_setpgid'                     => null,
            'posix_setsid'                      => null,
            'posix_setuid'                      => null,
            'posix_times'                       => null,
            'posix_ttyname'                     => null,
            'posix_uname'                       => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'posix_setegid'                     => null,
            'posix_seteuid'                     => null,
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
            'posix_errno'                       => null,
            'posix_get_last_error'              => null,
            'posix_strerror'                    => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-11-24',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->constants = array(
            // used only by posix_access
            'POSIX_F_OK'                        => null,
            'POSIX_X_OK'                        => null,
            'POSIX_W_OK'                        => null,
            'POSIX_R_OK'                        => null,
            // used only by posix_mknod
            'POSIX_S_IFREG'                     => null,
            'POSIX_S_IFCHR'                     => null,
            'POSIX_S_IFBLK'                     => null,
            'POSIX_S_IFIFO'                     => null,
            'POSIX_S_IFSOCK'                    => null,
        );
        $release->functions = array(
            'posix_access'                      => null,
            'posix_mknod'                       => null,
        );
        return $release;
    }

    protected function getR50200()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-11-02',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'posix_initgroups'                  => null,
        );
        return $release;
    }
}
