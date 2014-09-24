<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class StandardExtension extends AbstractReference
{
    const REF_NAME    = 'standard';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.3
        if (version_compare($version, '4.0.3', 'ge')) {
            $release = $this->getR40003();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.6
        if (version_compare($version, '4.0.6', 'ge')) {
            $release = $this->getR40006();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

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

        // 4.3.2
        if (version_compare($version, '4.3.2', 'ge')) {
            $release = $this->getR40302();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.3
        if (version_compare($version, '5.1.3', 'ge')) {
            $release = $this->getR50103();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.1
        if (version_compare($version, '5.2.1', 'ge')) {
            $release = $this->getR50201();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.4
        if (version_compare($version, '5.2.4', 'ge')) {
            $release = $this->getR50204();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.7
        if (version_compare($version, '5.2.7', 'ge')) {
            $release = $this->getR50207();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.2
        if (version_compare($version, '5.3.2', 'ge')) {
            $release = $this->getR50302();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.3
        if (version_compare($version, '5.3.3', 'ge')) {
            $release = $this->getR50303();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.4
        if (version_compare($version, '5.3.4', 'ge')) {
            $release = $this->getR50304();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.0alpha3
        if (version_compare($version, '5.6.0alpha3', 'ge')) {
            $release = $this->getR50600a3();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.6.1RC1
        if (version_compare($version, '5.6.1RC1', 'ge')) {
            $release = $this->getR50601rc1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
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
            'user_agent'                    => null,
            'default_socket_timeout'        => null,
            'auto_detect_line_endings'      => null,
            'assert.active'                 => null,
            'assert.bail'                   => null,
            'assert.warning'                => null,
            'assert.callback'               => null,
            'assert.quiet_eval'             => null,
            'url_rewriter.tags'             => null,
            'safe_mode_allowed_env_vars'    => array('php.max' => self::LATEST_PHP_5_3),
            'safe_mode_protected_env_vars'  => array('php.max' => self::LATEST_PHP_5_3),
        );
        $release->classes = array(
            'Directory' => array(
                'methods' => array(
                    'close'                 => null,
                    'read'                  => null,
                    'rewind'                => null,
                ),
            ),
            '__PHP_Incomplete_Class' => array(),
        );
        $release->functions = array(
            'abs'                           => null,
            'acos'                          => null,
            'addcslashes'                   => null,
            'addslashes'                    => null,
            'array_count_values'            => null,
            'array_flip'                    => null,
            'array_keys'                    => array('4.0.0', '', '4.0.0, 4.0.0, 5.0.0'),
            'array_merge'                   => null,
            'array_multisort'               => null,
            'array_pad'                     => null,
            'array_pop'                     => null,
            'array_push'                    => null,
            'array_rand'                    => null,
            'array_reverse'                 => null,
            'array_shift'                   => null,
            'array_slice'                   => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 5.0.2'),
            'array_splice'                  => null,
            'array_udiff_assoc'             => null,
            'array_udiff_uassoc'            => null,
            'array_uintersect'              => null,
            'array_uintersect_assoc'        => null,
            'array_uintersect_uassoc'       => null,
            'array_unshift'                 => null,
            'array_values'                  => null,
            'array_walk'                    => null,
            'arsort'                        => null,
            'asin'                          => null,
            'asort'                         => null,
            'assert'                        => array('4.0.0', '', '4.0.0, 5.4.8'),
            'assert_options'                => null,
            'atan'                          => null,
            'atan2'                         => null,
            'base64_decode'                 => null,
            'base64_encode'                 => null,
            'base_convert'                  => null,
            'basename'                      => null,
            'bin2hex'                       => null,
            'bindec'                        => null,
            'call_user_func'                => null,
            'call_user_method'              => null,
            'ceil'                          => null,
            'chdir'                         => null,
            'checkdnsrr'                    => null,
            'chgrp'                         => null,
            'chmod'                         => null,
            'chop'                          => null,
            'chown'                         => null,
            'chr'                           => null,
            'chunk_split'                   => null,
            'clearstatcache'                => array('4.0.0', '', '5.3.0, 5.3.0'),
            'closedir'                      => null,
            'closelog'                      => null,
            'compact'                       => null,
            'connection_aborted'            => null,
            'connection_status'             => null,
            'connection_timeout'            => array('4.0.0', '4.0.4'),
            'convert_cyr_string'            => null,
            'copy'                          => array('4.0.0', '', '4.0.0, 4.0.0, 5.3.0'),
            'cos'                           => null,
            'count'                         => null,
            'count_chars'                   => null,
            'crypt'                         => null,
            'current'                       => null,
            'decbin'                        => null,
            'dechex'                        => null,
            'decoct'                        => null,
            'define_syslog_variables'       => array('4.0.0', self::LATEST_PHP_5_3),
            'deg2rad'                       => null,
            'dir'                           => null,
            'dirname'                       => null,
            'disk_total_space'              => null,
            'dl'                            => null,
            'doubleval'                     => null,
            'end'                           => null,
            'error_log'                     => null,
            'escapeshellcmd'                => null,
            'exec'                          => null,
            'exp'                           => null,
            'explode'                       => null,
            'extract'                       => null,
            'fclose'                        => null,
            'feof'                          => null,
            'fgetc'                         => null,
            'fgetcsv'                       => null,
            'fgets'                         => null,
            'fgetss'                        => array('4.0.0', '', '5.0.0, 4.0.0, 5.0.0'),
            'file'                          => array('4.0.0', '', '4.0.0, 4.0.0, 5.0.0'),
            'file_exists'                   => null,
            'fileatime'                     => null,
            'filectime'                     => null,
            'filegroup'                     => null,
            'fileinode'                     => null,
            'filemtime'                     => null,
            'fileowner'                     => null,
            'fileperms'                     => null,
            'filesize'                      => null,
            'filetype'                      => null,
            'flock'                         => null,
            'floor'                         => null,
            'flush'                         => null,
            'fopen'                         => null,
            'fpassthru'                     => null,
            'fputs'                         => null,
            'fread'                         => null,
            'fseek'                         => null,
            'fsockopen'                     => null,
            'fstat'                         => null,
            'ftell'                         => null,
            'ftruncate'                     => null,
            'fwrite'                        => null,
            'get_browser'                   => array('4.0.0', '', '4.0.0, 4.3.2'),
            'get_cfg_var'                   => null,
            'get_current_user'              => null,
            'get_html_translation_table'    => null,
            'get_magic_quotes_gpc'          => null,
            'get_magic_quotes_runtime'      => null,
            'get_meta_tags'                 => null,
            'getcwd'                        => null,
            'getenv'                        => null,
            'gethostbyaddr'                 => null,
            'gethostbyname'                 => null,
            'gethostbynamel'                => null,
            'getimagesize'                  => null,
            'getlastmod'                    => null,
            'getmxrr'                       => null,
            'getmyinode'                    => null,
            'getmypid'                      => null,
            'getmyuid'                      => null,
            'getprotobyname'                => null,
            'getprotobynumber'              => null,
            'getrandmax'                    => null,
            'getrusage'                     => null,
            'getservbyname'                 => null,
            'getservbyport'                 => null,
            'gettimeofday'                  => array('4.0.0', '', '5.1.0'),
            'gettype'                       => null,
            'header'                        => null,
            'headers_sent'                  => null,
            'hebrev'                        => null,
            'hebrevc'                       => null,
            'hexdec'                        => null,
            'highlight_file'                => null,
            'highlight_string'              => null,
            'htmlentities'                  => array('4.0.0', '', '4.0.0, 4.0.3, 4.1.0, 5.2.3'),
            'htmlspecialchars'              => array('4.0.0', '', '4.0.0, 4.0.0, 4.1.0, 5.2.3'),
            'http_build_query'              => null,
            'ignore_user_abort'             => null,
            'image_type_to_extension'       => null,
            'image_type_to_mime_type'       => null,
            'implode'                       => null,
            'in_array'                      => null,
            'ini_alter'                     => null,
            'ini_get'                       => null,
            'ini_restore'                   => null,
            'ini_set'                       => null,
            'intval'                        => null,
            'ip2long'                       => null,
            'iptcembed'                     => null,
            'iptcparse'                     => null,
            'is_array'                      => null,
            'is_bool'                       => null,
            'is_dir'                        => null,
            'is_double'                     => null,
            'is_executable'                 => null,
            'is_file'                       => null,
            'is_float'                      => null,
            'is_int'                        => null,
            'is_integer'                    => null,
            'is_link'                       => null,
            'is_long'                       => null,
            'is_numeric'                    => null,
            'is_object'                     => null,
            'is_readable'                   => null,
            'is_real'                       => null,
            'is_resource'                   => null,
            'is_string'                     => null,
            'is_writable'                   => null,
            'is_writeable'                  => null,
            'join'                          => null,
            'key'                           => null,
            'krsort'                        => null,
            'ksort'                         => null,
            'lcg_value'                     => null,
            'link'                          => null,
            'linkinfo'                      => null,
            'localeconv'                    => null,
            'log'                           => null,
            'log10'                         => null,
            'long2ip'                       => null,
            'lstat'                         => null,
            'ltrim'                         => null,
            'magic_quotes_runtime'          => null,
            'mail'                          => null,
            'max'                           => null,
            'md5'                           => array('4.0.0', '', '4.0.0, 5.0.0'),
            'metaphone'                     => null,
            'microtime'                     => array('4.0.0', '', '5.0.0'),
            'min'                           => null,
            'mkdir'                         => array('4.0.0', '', '4.0.0, 4.0.0, 5.0.0, 5.0.0'),
            'mt_getrandmax'                 => null,
            'mt_rand'                       => null,
            'mt_srand'                      => null,
            'natcasesort'                   => null,
            'natsort'                       => null,
            'next'                          => null,
            'nl2br'                         => array('4.0.0', '', '4.0.0, 5.3.0'),
            'number_format'                 => null,
            'ob_end_clean'                  => null,
            'ob_end_flush'                  => null,
            'ob_get_contents'               => null,
            'ob_implicit_flush'             => null,
            'ob_start'                      => null,
            'octdec'                        => null,
            'opendir'                       => array('4.0.0', '', '4.0.0, 5.3.0'),
            'openlog'                       => null,
            'ord'                           => null,
            'output_add_rewrite_var'        => null,
            'pack'                          => null,
            'parse_ini_file'                => null,
            'parse_str'                     => null,
            'parse_url'                     => array('4.0.0', '', '4.0.0, 5.1.2'),
            'passthru'                      => null,
            'pclose'                        => null,
            'pfsockopen'                    => null,
            'php_logo_guid'                 => array('4.0.0', self::LATEST_PHP_5_4),
            'php_real_logo_guid'            => array('4.0.0', self::LATEST_PHP_5_4),
            'phpcredits'                    => null,
            'phpinfo'                       => null,
            'phpversion'                    => null,
            'pi'                            => null,
            'popen'                         => null,
            'pos'                           => null,
            'pow'                           => null,
            'prev'                          => null,
            'print_r'                       => null,
            'printf'                        => null,
            'putenv'                        => null,
            'quoted_printable_decode'       => null,
            'quotemeta'                     => null,
            'rad2deg'                       => null,
            'rand'                          => null,
            'range'                         => null,
            'rawurldecode'                  => null,
            'rawurlencode'                  => null,
            'readdir'                       => null,
            'readfile'                      => null,
            'readlink'                      => null,
            'realpath'                      => null,
            'register_shutdown_function'    => null,
            'rename'                        => null,
            'reset'                         => null,
            'rewind'                        => null,
            'rewinddir'                     => null,
            'rmdir'                         => null,
            'round'                         => null,
            'rsort'                         => null,
            'rtrim'                         => null,
            'serialize'                     => null,
            'set_file_buffer'               => null,
            'set_magic_quotes_runtime'      => null,
            'set_socket_blocking'           => null,
            'set_time_limit'                => null,
            'setcookie'                     => null,
            'setlocale'                     => null,
            'settype'                       => null,
            'shell_exec'                    => null,
            'show_source'                   => null,
            'shuffle'                       => null,
            'similar_text'                  => null,
            'sin'                           => null,
            'sizeof'                        => null,
            'sleep'                         => null,
            'socket_get_status'             => null,
            'socket_set_blocking'           => null,
            'socket_set_timeout'            => null,
            'sort'                          => null,
            'soundex'                       => null,
            'sprintf'                       => null,
            'sqrt'                          => null,
            'srand'                         => null,
            'stat'                          => null,
            'str_repeat'                    => null,
            'str_replace'                   => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 5.0.0'),
            'strchr'                        => null,
            'strcspn'                       => null,
            'strip_tags'                    => null,
            'stripcslashes'                 => null,
            'stripslashes'                  => null,
            'stristr'                       => null,
            'strnatcasecmp'                 => null,
            'strnatcmp'                     => null,
            'strpos'                        => null,
            'strrchr'                       => null,
            'strrev'                        => null,
            'strrpos'                       => null,
            'strspn'                        => null,
            'strstr'                        => null,
            'strtok'                        => null,
            'strtolower'                    => null,
            'strtoupper'                    => null,
            'strtr'                         => null,
            'strval'                        => null,
            'substr'                        => null,
            'substr_count'                  => array('4.0.0', '', '4.0.0, 4.0.0, 5.1.0, 5.1.0'),
            'substr_replace'                => null,
            'symlink'                       => null,
            'syslog'                        => null,
            'system'                        => null,
            'tan'                           => null,
            'tanh'                          => null,
            'tempnam'                       => null,
            'tmpfile'                       => null,
            'touch'                         => null,
            'trim'                          => null,
            'uasort'                        => null,
            'ucfirst'                       => null,
            'ucwords'                       => null,
            'uksort'                        => null,
            'umask'                         => null,
            'uniqid'                        => null,
            'unlink'                        => null,
            'unpack'                        => null,
            'unserialize'                   => null,
            'urldecode'                     => null,
            'urlencode'                     => null,
            'usleep'                        => null,
            'usort'                         => null,
            'var_dump'                      => null,
            'zend_logo_guid'                => array('4.0.0', self::LATEST_PHP_5_4),
        );
        $release->constants = array(
            'ASSERT_ACTIVE'                 => null,
            'ASSERT_BAIL'                   => null,
            'ASSERT_CALLBACK'               => null,
            'ASSERT_QUIET_EVAL'             => null,
            'ASSERT_WARNING'                => null,
            'CASE_LOWER'                    => null,
            'CASE_UPPER'                    => null,
            'CHAR_MAX'                      => null,
            'CONNECTION_ABORTED'            => null,
            'CONNECTION_NORMAL'             => null,
            'CONNECTION_TIMEOUT'            => null,
            'COUNT_NORMAL'                  => null,
            'COUNT_RECURSIVE'               => null,
            'CREDITS_ALL'                   => null,
            'CREDITS_DOCS'                  => null,
            'CREDITS_FULLPAGE'              => null,
            'CREDITS_GENERAL'               => null,
            'CREDITS_GROUP'                 => null,
            'CREDITS_MODULES'               => null,
            'CREDITS_QA'                    => null,
            'CREDITS_SAPI'                  => null,
            'CRYPT_BLOWFISH'                => null,
            'CRYPT_EXT_DES'                 => null,
            'CRYPT_MD5'                     => null,
            'CRYPT_SALT_LENGTH'             => null,
            'CRYPT_STD_DES'                 => null,
            'DNS_A'                         => null,
            'DNS_A6'                        => null,
            'DNS_AAAA'                      => null,
            'DNS_ALL'                       => null,
            'DNS_ANY'                       => null,
            'DNS_CNAME'                     => null,
            'DNS_HINFO'                     => null,
            'DNS_MX'                        => null,
            'DNS_NAPTR'                     => null,
            'DNS_NS'                        => null,
            'DNS_PTR'                       => null,
            'DNS_SOA'                       => null,
            'DNS_SRV'                       => null,
            'DNS_TXT'                       => null,
            'ENT_COMPAT'                    => null,
            'ENT_NOQUOTES'                  => null,
            'ENT_QUOTES'                    => null,
            'EXTR_IF_EXISTS'                => null,
            'EXTR_OVERWRITE'                => null,
            'EXTR_PREFIX_ALL'               => null,
            'EXTR_PREFIX_IF_EXISTS'         => null,
            'EXTR_PREFIX_INVALID'           => null,
            'EXTR_PREFIX_SAME'              => null,
            'EXTR_REFS'                     => null,
            'EXTR_SKIP'                     => null,
            'FILE_APPEND'                   => null,
            'FILE_IGNORE_NEW_LINES'         => null,
            'FILE_NO_DEFAULT_CONTEXT'       => null,
            'FILE_SKIP_EMPTY_LINES'         => null,
            'FILE_USE_INCLUDE_PATH'         => null,
            'FNM_CASEFOLD'                  => null,
            'FNM_NOESCAPE'                  => null,
            'FNM_PATHNAME'                  => null,
            'FNM_PERIOD'                    => null,
            'GLOB_BRACE'                    => null,
            'GLOB_ERR'                      => null,
            'GLOB_MARK'                     => null,
            'GLOB_NOCHECK'                  => null,
            'GLOB_NOESCAPE'                 => null,
            'GLOB_NOSORT'                   => null,
            'GLOB_ONLYDIR'                  => null,
            'HTML_ENTITIES'                 => null,
            'HTML_SPECIALCHARS'             => null,
            'IMAGETYPE_BMP'                 => null,
            'IMAGETYPE_GIF'                 => null,
            'IMAGETYPE_IFF'                 => null,
            'IMAGETYPE_JB2'                 => null,
            'IMAGETYPE_JP2'                 => null,
            'IMAGETYPE_JPC'                 => null,
            'IMAGETYPE_JPEG'                => null,
            'IMAGETYPE_JPEG2000'            => null,
            'IMAGETYPE_JPX'                 => null,
            'IMAGETYPE_PNG'                 => null,
            'IMAGETYPE_PSD'                 => null,
            'IMAGETYPE_SWC'                 => null,
            'IMAGETYPE_SWF'                 => null,
            'IMAGETYPE_TIFF_II'             => null,
            'IMAGETYPE_TIFF_MM'             => null,
            'IMAGETYPE_WBMP'                => null,
            'IMAGETYPE_XBM'                 => null,
            'INF'                           => null,
            'INFO_ALL'                      => null,
            'INFO_CONFIGURATION'            => null,
            'INFO_CREDITS'                  => null,
            'INFO_ENVIRONMENT'              => null,
            'INFO_GENERAL'                  => null,
            'INFO_LICENSE'                  => null,
            'INFO_MODULES'                  => null,
            'INFO_VARIABLES'                => null,
            'INI_ALL'                       => null,
            'INI_PERDIR'                    => null,
            'INI_SYSTEM'                    => null,
            'INI_USER'                      => null,
            'LC_ALL'                        => null,
            'LC_COLLATE'                    => null,
            'LC_CTYPE'                      => null,
            'LC_MESSAGES'                   => null,
            'LC_MONETARY'                   => null,
            'LC_NUMERIC'                    => null,
            'LC_TIME'                       => null,
            'LOCK_EX'                       => null,
            'LOCK_NB'                       => null,
            'LOCK_SH'                       => null,
            'LOCK_UN'                       => null,
            'LOG_ALERT'                     => null,
            'LOG_AUTH'                      => null,
            'LOG_AUTHPRIV'                  => null,
            'LOG_CONS'                      => null,
            'LOG_CRIT'                      => null,
            'LOG_CRON'                      => null,
            'LOG_DAEMON'                    => null,
            'LOG_DEBUG'                     => null,
            'LOG_EMERG'                     => null,
            'LOG_ERR'                       => null,
            'LOG_INFO'                      => null,
            'LOG_KERN'                      => null,
            'LOG_LOCAL0'                    => null,
            'LOG_LOCAL1'                    => null,
            'LOG_LOCAL2'                    => null,
            'LOG_LOCAL3'                    => null,
            'LOG_LOCAL4'                    => null,
            'LOG_LOCAL5'                    => null,
            'LOG_LOCAL6'                    => null,
            'LOG_LOCAL7'                    => null,
            'LOG_LPR'                       => null,
            'LOG_MAIL'                      => null,
            'LOG_NDELAY'                    => null,
            'LOG_NEWS'                      => null,
            'LOG_NOTICE'                    => null,
            'LOG_NOWAIT'                    => null,
            'LOG_ODELAY'                    => null,
            'LOG_PERROR'                    => null,
            'LOG_PID'                       => null,
            'LOG_SYSLOG'                    => null,
            'LOG_USER'                      => null,
            'LOG_UUCP'                      => null,
            'LOG_WARNING'                   => null,
            'M_1_PI'                        => null,
            'M_2_PI'                        => null,
            'M_2_SQRTPI'                    => null,
            'M_E'                           => null,
            'M_EULER'                       => null,
            'M_LN10'                        => null,
            'M_LN2'                         => null,
            'M_LNPI'                        => null,
            'M_LOG10E'                      => null,
            'M_LOG2E'                       => null,
            'M_PI'                          => null,
            'M_PI_2'                        => null,
            'M_PI_4'                        => null,
            'M_SQRT1_2'                     => null,
            'M_SQRT2'                       => null,
            'M_SQRT3'                       => null,
            'M_SQRTPI'                      => null,
            'NAN'                           => null,
            'PATHINFO_BASENAME'             => null,
            'PATHINFO_DIRNAME'              => null,
            'PATHINFO_EXTENSION'            => null,
            'PATHINFO_FILENAME'             => null,
            'PHP_URL_FRAGMENT'              => null,
            'PHP_URL_HOST'                  => null,
            'PHP_URL_PASS'                  => null,
            'PHP_URL_PATH'                  => null,
            'PHP_URL_PORT'                  => null,
            'PHP_URL_QUERY'                 => null,
            'PHP_URL_SCHEME'                => null,
            'PHP_URL_USER'                  => null,
            'PSFS_ERR_FATAL'                => null,
            'PSFS_FEED_ME'                  => null,
            'PSFS_FLAG_FLUSH_CLOSE'         => null,
            'PSFS_FLAG_FLUSH_INC'           => null,
            'PSFS_FLAG_NORMAL'              => null,
            'PSFS_PASS_ON'                  => null,
            'SEEK_CUR'                      => null,
            'SEEK_END'                      => null,
            'SEEK_SET'                      => null,
            'SORT_ASC'                      => null,
            'SORT_DESC'                     => null,
            'SORT_LOCALE_STRING'            => null,
            'SORT_NUMERIC'                  => null,
            'SORT_REGULAR'                  => null,
            'SORT_STRING'                   => null,
            'STREAM_CLIENT_ASYNC_CONNECT'   => null,
            'STREAM_CLIENT_CONNECT'         => null,
            'STREAM_CLIENT_PERSISTENT'      => null,
            'STREAM_CRYPTO_METHOD_SSLv2_CLIENT'     => null,
            'STREAM_CRYPTO_METHOD_SSLv3_CLIENT'     => null,
            'STREAM_CRYPTO_METHOD_SSLv23_CLIENT'    => null,
            'STREAM_CRYPTO_METHOD_TLS_CLIENT'       => null,
            'STREAM_CRYPTO_METHOD_SSLv2_SERVER'     => null,
            'STREAM_CRYPTO_METHOD_SSLv3_SERVER'     => null,
            'STREAM_CRYPTO_METHOD_SSLv23_SERVER'    => null,
            'STREAM_CRYPTO_METHOD_TLS_SERVER'       => null,
            'STREAM_ENFORCE_SAFE_MODE'      => array('4.0.0', self::LATEST_PHP_5_3),
            'STREAM_FILTER_ALL'             => null,
            'STREAM_FILTER_READ'            => null,
            'STREAM_FILTER_WRITE'           => null,
            'STREAM_IGNORE_URL'             => null,
            'STREAM_IPPROTO_IP'             => null,
            'STREAM_MKDIR_RECURSIVE'        => null,
            'STREAM_MUST_SEEK'              => null,
            'STREAM_NOTIFY_AUTH_REQUIRED'   => null,
            'STREAM_NOTIFY_AUTH_RESULT'     => null,
            'STREAM_NOTIFY_COMPLETED'       => null,
            'STREAM_NOTIFY_CONNECT'         => null,
            'STREAM_NOTIFY_FAILURE'         => null,
            'STREAM_NOTIFY_FILE_SIZE_IS'    => null,
            'STREAM_NOTIFY_MIME_TYPE_IS'    => null,
            'STREAM_NOTIFY_PROGRESS'        => null,
            'STREAM_NOTIFY_REDIRECTED'      => null,
            'STREAM_NOTIFY_RESOLVE'         => null,
            'STREAM_NOTIFY_SEVERITY_ERR'    => null,
            'STREAM_NOTIFY_SEVERITY_INFO'   => null,
            'STREAM_NOTIFY_SEVERITY_WARN'   => null,
            'STREAM_OOB'                    => null,
            'STREAM_PEEK'                   => null,
            'STREAM_PF_INET'                => null,
            'STREAM_PF_INET6'               => null,
            'STREAM_PF_UNIX'                => null,
            'STREAM_REPORT_ERRORS'          => null,
            'STREAM_SERVER_BIND'            => null,
            'STREAM_SERVER_LISTEN'          => null,
            'STREAM_SHUT_RD'                => null,
            'STREAM_SHUT_RDWR'              => null,
            'STREAM_SHUT_WR'                => null,
            'STREAM_SOCK_DGRAM'             => null,
            'STREAM_SOCK_RAW'               => null,
            'STREAM_SOCK_RDM'               => null,
            'STREAM_SOCK_SEQPACKET'         => null,
            'STREAM_SOCK_STREAM'            => null,
            'STREAM_URL_STAT_LINK'          => null,
            'STREAM_URL_STAT_QUIET'         => null,
            'STREAM_USE_PATH'               => null,
            'STR_PAD_BOTH'                  => null,
            'STR_PAD_LEFT'                  => null,
            'STR_PAD_RIGHT'                 => null,
        );
        return $release;
    }

    protected function getR40001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-06-28',
            'php.min' => '4.0.1',
            'php.max' => '',
        );
        $release->functions = array(
            'array_diff'                    => null,
            'array_intersect'               => null,
            'array_merge_recursive'         => null,
            'array_unique'                  => null,
            'crc32'                         => null,
            'fflush'                        => null,
            'fscanf'                        => null,
            'levenshtein'                   => null,
            'php_sapi_name'                 => null,
            'sscanf'                        => null,
            'str_pad'                       => null,
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
            'ezmlm_hash'                    => null,
            'ob_get_length'                 => null,
            'php_uname'                     => null,
            'wordwrap'                      => null,
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
            'escapeshellarg'                => null,
            'is_uploaded_file'              => null,
            'move_uploaded_file'            => null,
            'pathinfo'                      => null,
            'php_egg_logo_guid'             => array('4.0.3', self::LATEST_PHP_5_4),
            'register_tick_function'        => null,
            'unregister_tick_function'      => null,
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
        $release->functions = array(
            'array_sum'                     => null,
            'call_user_func_array'          => null,
            'constant'                      => null,
            'is_null'                       => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->functions = array(
            'array_reduce'                  => null,
            'array_search'                  => null,
            'call_user_method_array'        => null,
            'chroot'                        => null,
            'is_scalar'                     => null,
            'strcoll'                       => null,
        );
        return $release;
    }

    protected function getR40006()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-06-23',
            'php.min' => '4.0.6',
            'php.max' => '',
        );
        $release->functions = array(
            'array_filter'                  => null,
            'array_map'                     => null,
            'is_callable'                   => null,
            'key_exists'                    => null,
        );
        $release->constants = array(
            'DIRECTORY_SEPARATOR'           => null,
        );
        return $release;
    }

    protected function getR40007()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.0.7',
            'php.max' => '',
        );
        $release->functions = array(
            'acosh'                         => null,
            'array_key_exists'              => null,
            'asinh'                         => null,
            'atanh'                         => null,
            'cosh'                          => null,
            'expm1'                         => null,
            'getmygid'                      => null,
            'hypot'                         => null,
            'import_request_variables'      => array('4.0.7', self::LATEST_PHP_5_3),
            'log1p'                         => null,
            'sinh'                          => null,
            'version_compare'               => null,
            'vprintf'                       => null,
            'vsprintf'                      => null,
        );
        return $release;
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
            'disk_free_space'               => null,
            'diskfreespace'                 => null,
            'nl_langinfo'                   => null,
        );
        $release->constants = array(
            'ABDAY_1'                       => null,
            'ABDAY_2'                       => null,
            'ABDAY_3'                       => null,
            'ABDAY_4'                       => null,
            'ABDAY_5'                       => null,
            'ABDAY_6'                       => null,
            'ABDAY_7'                       => null,
            'ABMON_1'                       => null,
            'ABMON_10'                      => null,
            'ABMON_11'                      => null,
            'ABMON_12'                      => null,
            'ABMON_2'                       => null,
            'ABMON_3'                       => null,
            'ABMON_4'                       => null,
            'ABMON_5'                       => null,
            'ABMON_6'                       => null,
            'ABMON_7'                       => null,
            'ABMON_8'                       => null,
            'ABMON_9'                       => null,
            'ALT_DIGITS'                    => null,
            'AM_STR'                        => null,
            'CODESET'                       => null,
            'CRNCYSTR'                      => null,
            'DAY_1'                         => null,
            'DAY_2'                         => null,
            'DAY_3'                         => null,
            'DAY_4'                         => null,
            'DAY_5'                         => null,
            'DAY_6'                         => null,
            'DAY_7'                         => null,
            'D_FMT'                         => null,
            'D_T_FMT'                       => null,
            'ERA'                           => null,
            'ERA_D_FMT'                     => null,
            'ERA_D_T_FMT'                   => null,
            'ERA_T_FMT'                     => null,
            'MON_1'                         => null,
            'MON_10'                        => null,
            'MON_11'                        => null,
            'MON_12'                        => null,
            'MON_2'                         => null,
            'MON_3'                         => null,
            'MON_4'                         => null,
            'MON_5'                         => null,
            'MON_6'                         => null,
            'MON_7'                         => null,
            'MON_8'                         => null,
            'MON_9'                         => null,
            'NOEXPR'                        => null,
            'PM_STR'                        => null,
            'RADIXCHAR'                     => null,
            'THOUSEP'                       => null,
            'T_FMT'                         => null,
            'T_FMT_AMPM'                    => null,
            'YESEXPR'                       => null,
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
            'array_change_key_case'         => null,
            'array_chunk'                   => null,
            'array_fill'                    => null,
            'debug_zval_dump'               => null,
            'floatval'                      => null,
            'fmod'                          => null,
            'ftok'                          => null,
            'ini_get_all'                   => null,
            'is_finite'                     => null,
            'is_infinite'                   => null,
            'is_nan'                        => null,
            'md5_file'                      => array('4.2.0', '', '4.2.0, 5.0.0'),
            'ob_clean'                      => null,
            'ob_flush'                      => null,
            'ob_get_level'                  => null,
            'ob_get_status'                 => null,
            'str_rot13'                     => null,
            'var_export'                    => null,
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
            'array_diff_assoc'              => null,
            'array_intersect_assoc'         => null,
            'file_get_contents'             => array('4.3.0', '', '4.3.0, 4.3.0, 4.3.0, 5.1.0, 5.1.0'),
            'fnmatch'                       => null,
            'get_include_path'              => null,
            'getopt'                        => array('4.3.0', '', '4.3.0, 5.3.0'),
            'glob'                          => null,
            'html_entity_decode'            => null,
            'money_format'                  => null,
            'ob_get_clean'                  => null,
            'ob_get_flush'                  => null,
            'ob_list_handlers'              => null,
            'output_reset_rewrite_vars'     => null,
            'php_ini_scanned_files'         => null,
            'proc_close'                    => null,
            'proc_open'                     => null,
            'restore_include_path'          => null,
            'set_include_path'              => null,
            'sha1'                          => array('4.3.0', '', '4.3.0, 5.0.0'),
            'sha1_file'                     => array('4.3.0', '', '4.3.0, 5.0.0'),
            'str_shuffle'                   => null,
            'str_word_count'                => null,
            'stream_context_create'         => null,
            'stream_context_get_options'    => null,
            'stream_context_set_option'     => null,
            'stream_context_set_params'     => null,
            'stream_filter_append'          => null,
            'stream_filter_prepend'         => null,
            'stream_get_meta_data'          => null,
            'stream_register_wrapper'       => null,
            'stream_select'                 => null,
            'stream_set_blocking'           => null,
            'stream_set_timeout'            => null,
            'stream_set_write_buffer'       => null,
        );
        $release->constants = array(
            'PATH_SEPARATOR'                => null,
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
        $release->functions = array(
            'memory_get_usage'              => array('4.3.2', '', '5.2.0'),
            'stream_wrapper_register'       => null,
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
        $release->classes = array(
            'php_user_filter' => array(
                'methods'    => array(
                    'filter'                => null,
                    'onClose'               => null,
                    'onCreate'              => null,
                ),
            ),
        );
        $release->functions = array(
            'array_combine'                 => null,
            'array_diff_uassoc'             => null,
            'array_intersect_uassoc'        => null,
            'array_udiff'                   => null,
            'array_walk_recursive'          => null,
            'convert_uudecode'              => null,
            'convert_uuencode'              => null,
            'dns_check_record'              => null,
            'dns_get_mx'                    => null,
            'dns_get_record'                => null,
            'file_put_contents'             => null,
            'fprintf'                       => null,
            'get_headers'                   => null,
            'headers_list'                  => null,
            'php_check_syntax'              => array('5.0.0', '5.0.4'),
            'php_strip_whitespace'          => null,
            'proc_get_status'               => null,
            'proc_nice'                     => null,
            'proc_terminate'                => null,
            'scandir'                       => null,
            'setrawcookie'                  => null,
            'str_ireplace'                  => null,
            'str_split'                     => null,
            'stream_bucket_append'          => null,
            'stream_bucket_make_writeable'  => null,
            'stream_bucket_new'             => null,
            'stream_bucket_prepend'         => null,
            'stream_copy_to_stream'         => array('5.0.0', '', '5.0.0, 5.0.0, 5.0.0, 5.1.0'),
            'stream_filter_register'        => null,
            'stream_get_contents'           => array('5.0.0', '', '5.0.0, 5.0.0, 5.1.0'),
            'stream_get_filters'            => null,
            'stream_get_line'               => null,
            'stream_get_transports'         => null,
            'stream_get_wrappers'           => null,
            'stream_socket_accept'          => null,
            'stream_socket_client'          => null,
            'stream_socket_get_name'        => null,
            'stream_socket_recvfrom'        => null,
            'stream_socket_sendto'          => null,
            'stream_socket_server'          => null,
            'stripos'                       => null,
            'strpbrk'                       => null,
            'strripos'                      => null,
            'substr_compare'                => null,
            'time_nanosleep'                => null,
            'vfprintf'                      => null,
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
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'array_diff_key'                => null,
            'array_diff_ukey'               => null,
            'array_intersect_key'           => null,
            'array_intersect_ukey'          => null,
            'array_product'                 => null,
            'fputcsv'                       => null,
            'htmlspecialchars_decode'       => null,
            'inet_ntop'                     => null,
            'inet_pton'                     => null,
            'lchgrp'                        => null,
            'lchown'                        => null,
            'stream_context_get_default'    => null,
            'stream_filter_remove'          => null,
            'stream_socket_enable_crypto'   => null,
            'stream_socket_pair'            => null,
            'stream_wrapper_restore'        => null,
            'stream_wrapper_unregister'     => null,
            'strptime'                      => null,
            'time_sleep_until'              => null,
        );
        $release->constants = array(
            'STREAM_IPPROTO_ICMP'           => null,
            'STREAM_IPPROTO_RAW'            => null,
            'STREAM_IPPROTO_TCP'            => null,
            'STREAM_IPPROTO_UDP'            => null,
        );
        return $release;
    }

    protected function getR50103()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-05-02',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->functions = array(
            'sys_getloadavg'                => null,
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
            'array_fill_keys'               => null,
            'error_get_last'                => null,
            'memory_get_peak_usage'         => null,
        );
        return $release;
    }

    protected function getR50201()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-02-08',
            'php.min' => '5.2.1',
            'php.max' => '',
        );
        $release->functions = array(
            'stream_socket_shutdown'        => null,
            'sys_get_temp_dir'              => null,
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
        $release->functions = array(
            'php_ini_loaded_file'           => null,
            'stream_is_local'               => null,
        );
        $release->constants = array(
            'GLOB_AVAILABLE_FLAGS'          => null,
            'STREAM_IS_URL'                 => null,
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
            'FILE_BINARY'                   => null,
            'FILE_TEXT'                     => null,
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
        $release->functions = array(
            'array_replace'                 => null,
            'array_replace_recursive'       => null,
            'forward_static_call'           => null,
            'forward_static_call_array'     => null,
            'gethostname'                   => null,
            'header_remove'                 => null,
            'lcfirst'                       => null,
            'parse_ini_string'              => null,
            'quoted_printable_encode'       => null,
            'str_getcsv'                    => null,
            'stream_context_get_params'     => null,
            'stream_context_set_default'    => null,
            'stream_supports_lock'          => null,
        );
        $release->constants = array(
            'ENT_IGNORE'                    => null,
            'IMAGETYPE_COUNT'               => null,
            'IMAGETYPE_ICO'                 => null,
            'IMAGETYPE_UNKNOWN'             => null,
            'INI_SCANNER_NORMAL'            => null,
            'INI_SCANNER_RAW'               => null,
            'PHP_ROUND_HALF_DOWN'           => null,
            'PHP_ROUND_HALF_EVEN'           => null,
            'PHP_ROUND_HALF_ODD'            => null,
            'PHP_ROUND_HALF_UP'             => null,
            'STREAM_BUFFER_FULL'            => null,
            'STREAM_BUFFER_LINE'            => null,
            'STREAM_BUFFER_NONE'            => null,
            'STREAM_CAST_AS_STREAM'         => null,
            'STREAM_CAST_FOR_SELECT'        => null,
            'STREAM_OPTION_BLOCKING'        => null,
            'STREAM_OPTION_READ_BUFFER'     => null,
            'STREAM_OPTION_READ_TIMEOUT'    => null,
            'STREAM_OPTION_WRITE_BUFFER'    => null,
        );
        return $release;
    }

    protected function getR50302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-03-04',
            'php.min' => '5.3.2',
            'php.max' => '',
        );
        $release->functions = array(
            'realpath_cache_get'            => null,
            'realpath_cache_size'           => null,
            'stream_resolve_include_path'   => null,
        );
        $release->constants = array(
            'CRYPT_SHA256'                  => null,
            'CRYPT_SHA512'                  => null,
        );
        return $release;
    }

    protected function getR50303()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-07-22',
            'php.min' => '5.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'stream_set_read_buffer'        => null,
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
        $release->iniEntries = array(
            'from'                          => null,
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
        $release->functions = array(
            'getimagesizefromstring'         => null,
            'header_register_callback'       => null,
            'hex2bin'                        => null,
            'http_response_code'             => null,
            'stream_set_chunk_size'          => null,
        );
        $release->constants = array(
            'ENT_DISALLOWED'                 => null,
            'ENT_HTML401'                    => null,
            'ENT_HTML5'                      => null,
            'ENT_SUBSTITUTE'                 => null,
            'ENT_XHTML'                      => null,
            'ENT_XML1'                       => null,
            'PHP_QUERY_RFC1738'              => null,
            'PHP_QUERY_RFC3986'              => null,
            'SCANDIR_SORT_ASCENDING'         => null,
            'SCANDIR_SORT_DESCENDING'        => null,
            'SCANDIR_SORT_NONE'              => null,
            'SORT_FLAG_CASE'                 => null,
            'SORT_NATURAL'                   => null,
            'STREAM_META_ACCESS'             => null,
            'STREAM_META_GROUP'              => null,
            'STREAM_META_GROUP_NAME'         => null,
            'STREAM_META_OWNER'              => null,
            'STREAM_META_OWNER_NAME'         => null,
            'STREAM_META_TOUCH'              => null,
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
        $release->functions = array(
            'array_column'                  => null,
            'boolval'                       => null,
            'cli_get_process_title'         => null,
            'cli_set_process_title'         => null,
            'password_get_info'             => null,
            'password_hash'                 => null,
            'password_needs_rehash'         => null,
            'password_verify'               => null,
        );
        $release->constants = array(
            'PASSWORD_DEFAULT'              => null,
            'PASSWORD_BCRYPT'               => null,
            'PASSWORD_BCRYPT_DEFAULT_COST'  => null,
        );
        return $release;
    }

    protected function getR50600a3()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.0alpha3',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-02-27',
            'php.min' => '5.6.0alpha3',
            'php.max' => '',
        );
        $release->constants = array(
            'ARRAY_FILTER_USE_BOTH'                 => null,
            'ARRAY_FILTER_USE_KEY'                  => null,
            'STREAM_CRYPTO_METHOD_ANY_CLIENT'       => null,
            'STREAM_CRYPTO_METHOD_ANY_SERVER'       => null,
            'STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT'   => null,
            'STREAM_CRYPTO_METHOD_TLSv1_0_SERVER'   => null,
            'STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT'   => null,
            'STREAM_CRYPTO_METHOD_TLSv1_1_SERVER'   => null,
            'STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT'   => null,
            'STREAM_CRYPTO_METHOD_TLSv1_2_SERVER'   => null,
        );
        return $release;
    }

    protected function getR50601rc1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.6.1RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-09-11',
            'php.min' => '5.6.1RC1',
            'php.max' => '',
        );
        $release->constants = array(
            'INI_SCANNER_TYPED'                     => null,
        );
        return $release;
    }
}
