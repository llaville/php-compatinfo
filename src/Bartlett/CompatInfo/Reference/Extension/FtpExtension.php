<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class FtpExtension extends AbstractReference
{
    const REF_NAME    = 'ftp';
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

        // 4.0.3
        if (version_compare($version, '4.0.3', 'ge')) {
            $release = $this->getR40003();
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

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
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
            'ftp_cdup'                      => null,
            'ftp_chdir'                     => null,
            'ftp_connect'                   => null,
            'ftp_delete'                    => null,
            'ftp_fget'                      => null,
            'ftp_fput'                      => null,
            'ftp_get'                       => null,
            'ftp_login'                     => null,
            'ftp_mdtm'                      => null,
            'ftp_mkdir'                     => null,
            'ftp_nlist'                     => null,
            'ftp_pasv'                      => null,
            'ftp_put'                       => null,
            'ftp_pwd'                       => null,
            'ftp_quit'                      => null,
            'ftp_rawlist'                   => null,
            'ftp_rename'                    => null,
            'ftp_rmdir'                     => null,
            'ftp_site'                      => null,
            'ftp_size'                      => null,
            'ftp_systype'                   => null,
        );
        $release->constants = array(
            'FTP_ASCII'                     => null,
            'FTP_BINARY'                    => null,
            'FTP_IMAGE'                     => null,
            'FTP_TEXT'                      => null,
            'FTP_TIMEOUT_SEC'               => null,
        );
        return $release;
    }

    protected function getR40003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-10-11',
            'php.min' => '4.0.3',
            'php.max' => '',
        );
        $release->functions = array(
            'ftp_exec'                      => null,
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
            'ftp_close'                     => null,
            'ftp_get_option'                => null,
            'ftp_set_option'                => null,
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
            'ftp_nb_continue'               => null,
            'ftp_nb_fget'                   => null,
            'ftp_nb_fput'                   => null,
            'ftp_nb_get'                    => null,
            'ftp_nb_put'                    => null,
            'ftp_ssl_connect'               => null,

        );
        $release->constants = array(
            'FTP_AUTORESUME'                => null,
            'FTP_AUTOSEEK'                  => null,
            'FTP_FAILED'                    => null,
            'FTP_FINISHED'                  => null,
            'FTP_MOREDATA'                  => null,
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
        $release->functions = array(
            'ftp_alloc'                     => null,
            'ftp_chmod'                     => null,
            'ftp_raw'                       => null,
        );
        return $release;
    }
}
