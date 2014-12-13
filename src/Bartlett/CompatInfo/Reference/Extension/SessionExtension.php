<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SessionExtension extends AbstractReference
{
    const REF_NAME    = 'session';
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

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
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

        // 4.3.2
        if (version_compare($version, '4.3.2', 'ge')) {
            $release = $this->getR40302();
            $this->storage->attach($release);
        }

        // 4.4.0
        if (version_compare($version, '4.4.0', 'ge')) {
            $release = $this->getR40400();
            $this->storage->attach($release);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $this->storage->attach($release);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $this->storage->attach($release);
        }

        // 5.5.1
        if (version_compare($version, '5.5.1', 'ge')) {
            $release = $this->getR50501();
            $this->storage->attach($release);
        }

        // 5.5.2
        if (version_compare($version, '5.5.2', 'ge')) {
            $release = $this->getR50502();
            $this->storage->attach($release);
        }

        // 5.6.0alpha1
        if (version_compare($version, '5.6.0alpha1', 'ge')) {
            $release = $this->getR50600a1();
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
        $release->iniEntries = array(
            'session.auto_start'            => null,
            'session.cache_expire'          => null,
            'session.cache_limiter'         => null,
            'session.cookie_domain'         => null,
            'session.cookie_lifetime'       => null,
            'session.cookie_path'           => null,
            'session.entropy_file'          => null,
            'session.entropy_length'        => null,
            'session.gc_maxlifetime'        => null,
            'session.gc_probability'        => null,
            'session.name'                  => null,
            'session.referer_check'         => null,
            'session.save_handler'          => null,
            'session.save_path'             => null,
            'session.serialize_handler'     => null,
            'session.use_cookies'           => null,
        );
        $release->constants = array(
            'SID'                           => null,
        );
        $release->functions = array(
            'session_decode'                => null,
            'session_destroy'               => null,
            'session_encode'                => null,
            'session_get_cookie_params'     => null,
            'session_id'                    => null,
            'session_is_registered'         => array('4.0.0', self::LATEST_PHP_5_3),
            'session_module_name'           => null,
            'session_name'                  => null,
            'session_register'              => array('4.0.0', self::LATEST_PHP_5_3),
            'session_save_path'             => null,
            'session_set_cookie_params'     => null,
            'session_set_save_handler'      => null,
            'session_start'                 => null,
            'session_unregister'            => array('4.0.0', self::LATEST_PHP_5_3),
            'session_unset'                 => null,
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
        $release->iniEntries = array(
            'session.use_trans_sid'         => null,
        );
        $release->functions = array(
            'session_cache_limiter'         => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'session.cookie_secure'         => null,
            'url_rewriter.tags'             => null,
        );
        $release->functions = array(
            'session_write_close'           => null,
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
            'session_cache_expire'          => null,
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
        $release->iniEntries = array(
            'session.bug_compat_42'         => array('4.3.0', '5.4.0'),
            'session.bug_compat_warn'       => array('4.3.0', '5.4.0'),
            'session.use_only_cookies'      => null,
        );
        return $release;
    }

    protected function getR40302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-05-29',
            'php.min' => '4.3.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'session.gc_divisor'            => null,
        );
        $release->functions = array(
            'session_regenerate_id'         => array('4.3.2', '', '5.1.0'),
        );
        return $release;
    }

    protected function getR40400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2005-07-11',
            'php.min' => '4.4.0',
            'php.max' => '',
        );
        $release->functions = array(
            'session_commit'                => null,
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
        $release->iniEntries = array(
            'session.hash_bits_per_character'   => null,
            'session.hash_function'             => null,
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
        $release->iniEntries = array(
            'session.cookie_httponly'       => null,
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
        $release->iniEntries = array(
            'session.upload_progress.cleanup'   => null,
            'session.upload_progress.enabled'   => null,
            'session.upload_progress.freq'      => null,
            'session.upload_progress.min_freq'  => null,
            'session.upload_progress.name'      => null,
            'session.upload_progress.prefix'    => null,
        );
        $release->interfaces = array(
            'SessionHandlerInterface'           => null,
        );
        $release->classes = array(
            'SessionHandler'                    => null,
        );
        $release->constants = array(
            'PHP_SESSION_ACTIVE'                => null,
            'PHP_SESSION_DISABLED'              => null,
            'PHP_SESSION_NONE'                  => null,
        );
        $release->functions = array(
            'session_register_shutdown'         => null,
            'session_status'                    => null,
        );
        return $release;
    }

    protected function getR50501()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-07-18',
            'php.min' => '5.5.1',
            'php.max' => '',
        );
        $release->interfaces = array(
            'SessionIdInterface'            => null,
        );
        return $release;
    }

    protected function getR50502()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-08-15',
            'php.min' => '5.5.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'session.use_strict_mode'       => null,
        );
        return $release;
    }

    protected function getR50600a1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-01-21',
            'php.min' => '5.6.0alpha1',
            'php.max' => '',
        );
        $release->functions = array(
            'session_abort'                 => null,
            'session_gc'                    => array(
                'ext.max' => '5.6.0alpha3',
                'php.max' => '5.6.0alpha3'
            ),
            'session_reset'                 => null,
            'session_serializer_name'       => array(
                'ext.max' => '5.6.0alpha3',
                'php.max' => '5.6.0alpha3'
            ),
        );
        return $release;
    }
}
