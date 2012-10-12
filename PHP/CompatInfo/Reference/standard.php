<?php
/**
 * Version informations about components always available with PHP
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants always available with PHP
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_Standard
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'standard';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '5.4.8-dev';

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
        $phpMin = '4.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );

        return $extensions;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '4.0.0';       // 2000-05-22
        $items = array(
            'Directory'                      => array('4.0.0', ''),
            '__PHP_Incomplete_Class'         => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '5.0.0';       // 2004-07-13
        $items = array(
            'php_user_filter'                => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
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
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '4.0.0';       // 2000-05-22
        $items = array(
            'abs'                            => array('4.0.0', ''),
            'acos'                           => array('4.0.0', ''),
            'addcslashes'                    => array('4.0.0', ''),
            'addslashes'                     => array('4.0.0', ''),
            'array_count_values'             => array('4.0.0', ''),
            'array_flip'                     => array('4.0.0', ''),
            'array_keys'                     => array('4.0.0', '', '4.0.0, 4.0.0, 5.0.0'),
            'array_merge'                    => array('4.0.0', ''),
            'array_multisort'                => array('4.0.0', ''),
            'array_pad'                      => array('4.0.0', ''),
            'array_pop'                      => array('4.0.0', ''),
            'array_push'                     => array('4.0.0', ''),
            'array_rand'                     => array('4.0.0', ''),
            'array_reverse'                  => array('4.0.0', ''),
            'array_shift'                    => array('4.0.0', ''),
            'array_slice'                    => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 5.0.2'),
            'array_splice'                   => array('4.0.0', ''),
            'array_udiff_assoc'              => array('4.0.0', ''),
            'array_udiff_uassoc'             => array('4.0.0', ''),
            'array_uintersect'               => array('4.0.0', ''),
            'array_uintersect_assoc'         => array('4.0.0', ''),
            'array_uintersect_uassoc'        => array('4.0.0', ''),
            'array_unshift'                  => array('4.0.0', ''),
            'array_values'                   => array('4.0.0', ''),
            'array_walk'                     => array('4.0.0', ''),
            'arsort'                         => array('4.0.0', ''),
            'asin'                           => array('4.0.0', ''),
            'asort'                          => array('4.0.0', ''),
            'assert'                         => array('4.0.0', ''),
            'assert_options'                 => array('4.0.0', ''),
            'atan'                           => array('4.0.0', ''),
            'atan2'                          => array('4.0.0', ''),
            'base64_decode'                  => array('4.0.0', ''),
            'base64_encode'                  => array('4.0.0', ''),
            'base_convert'                   => array('4.0.0', ''),
            'basename'                       => array('4.0.0', ''),
            'bin2hex'                        => array('4.0.0', ''),
            'bindec'                         => array('4.0.0', ''),
            'call_user_func'                 => array('4.0.0', ''),
            'call_user_method'               => array('4.0.0', ''),
            'ceil'                           => array('4.0.0', ''),
            'chdir'                          => array('4.0.0', ''),
            'checkdnsrr'                     => array('4.0.0', ''),
            'chgrp'                          => array('4.0.0', ''),
            'chmod'                          => array('4.0.0', ''),
            'chop'                           => array('4.0.0', ''),
            'chown'                          => array('4.0.0', ''),
            'chr'                            => array('4.0.0', ''),
            'chunk_split'                    => array('4.0.0', ''),
            'clearstatcache'                 => array('4.0.0', '', '5.3.0, 5.3.0'),
            'closedir'                       => array('4.0.0', ''),
            'closelog'                       => array('4.0.0', ''),
            'compact'                        => array('4.0.0', ''),
            'connection_aborted'             => array('4.0.0', ''),
            'connection_status'              => array('4.0.0', ''),
            'connection_timeout'             => array('4.0.0', '4.0.4'),
            'convert_cyr_string'             => array('4.0.0', ''),
            'copy'                           => array('4.0.0', '', '4.0.0, 4.0.0, 5.3.0'),
            'cos'                            => array('4.0.0', ''),
            'count'                          => array('4.0.0', ''),
            'count_chars'                    => array('4.0.0', ''),
            'crypt'                          => array('4.0.0', ''),
            'current'                        => array('4.0.0', ''),
            'decbin'                         => array('4.0.0', ''),
            'dechex'                         => array('4.0.0', ''),
            'decoct'                         => array('4.0.0', ''),
            'define_syslog_variables'        => array('4.0.0', '5.3.18'),
            'deg2rad'                        => array('4.0.0', ''),
            'dir'                            => array('4.0.0', ''),
            'dirname'                        => array('4.0.0', ''),
            'disk_total_space'               => array('4.0.0', ''),
            // In "Semaphore functions" but in "standard" ext
            'dl'                             => array('4.0.0', ''),
            'doubleval'                      => array('4.0.0', ''),
            'end'                            => array('4.0.0', ''),
            'error_log'                      => array('4.0.0', ''),
            'escapeshellcmd'                 => array('4.0.0', ''),
            'exec'                           => array('4.0.0', ''),
            'exp'                            => array('4.0.0', ''),
            'explode'                        => array('4.0.0', ''),
            'extract'                        => array('4.0.0', ''),
            'fclose'                         => array('4.0.0', ''),
            'feof'                           => array('4.0.0', ''),
            'fgetc'                          => array('4.0.0', ''),
            'fgetcsv'                        => array('4.0.0', ''),
            'fgets'                          => array('4.0.0', ''),
            'fgetss'                         => array('4.0.0', '', '5.0.0, 4.0.0, 5.0.0'),
            'file'                           => array('4.0.0', '', '4.0.0, 4.0.0, 5.0.0'),
            'file_exists'                    => array('4.0.0', ''),
            'fileatime'                      => array('4.0.0', ''),
            'filectime'                      => array('4.0.0', ''),
            'filegroup'                      => array('4.0.0', ''),
            'fileinode'                      => array('4.0.0', ''),
            'filemtime'                      => array('4.0.0', ''),
            'fileowner'                      => array('4.0.0', ''),
            'fileperms'                      => array('4.0.0', ''),
            'filesize'                       => array('4.0.0', ''),
            'filetype'                       => array('4.0.0', ''),
            'flock'                          => array('4.0.0', ''),
            'floor'                          => array('4.0.0', ''),
            'flush'                          => array('4.0.0', ''),
            'fopen'                          => array('4.0.0', ''),
            'fpassthru'                      => array('4.0.0', ''),
            'fputs'                          => array('4.0.0', ''),
            'fread'                          => array('4.0.0', ''),
            'fseek'                          => array('4.0.0', ''),
            'fsockopen'                      => array('4.0.0', ''),
            'fstat'                          => array('4.0.0', ''),
            'ftell'                          => array('4.0.0', ''),
            'ftruncate'                      => array('4.0.0', ''),
            'fwrite'                         => array('4.0.0', ''),
            'get_browser'                    => array('4.0.0', '', '4.0.0, 4.3.2'),
            'get_cfg_var'                    => array('4.0.0', ''),
            'get_current_user'               => array('4.0.0', ''),
            'get_html_translation_table'     => array('4.0.0', ''),
            'get_magic_quotes_gpc'           => array('4.0.0', ''),
            'get_magic_quotes_runtime'       => array('4.0.0', ''),
            'get_meta_tags'                  => array('4.0.0', ''),
            'getcwd'                         => array('4.0.0', ''),
            'getenv'                         => array('4.0.0', ''),
            'gethostbyaddr'                  => array('4.0.0', ''),
            'gethostbyname'                  => array('4.0.0', ''),
            'gethostbynamel'                 => array('4.0.0', ''),
            'getimagesize'                   => array('4.0.0', ''),
            'getlastmod'                     => array('4.0.0', ''),
            'getmxrr'                        => array('4.0.0', ''),
            'getmyinode'                     => array('4.0.0', ''),
            'getmypid'                       => array('4.0.0', ''),
            'getmyuid'                       => array('4.0.0', ''),
            'getprotobyname'                 => array('4.0.0', ''),
            'getprotobynumber'               => array('4.0.0', ''),
            'getrandmax'                     => array('4.0.0', ''),
            'getrusage'                      => array('4.0.0', ''),
            'getservbyname'                  => array('4.0.0', ''),
            'getservbyport'                  => array('4.0.0', ''),
            'gettimeofday'                   => array('4.0.0', '', '5.1.0'),
            'gettype'                        => array('4.0.0', ''),
            'header'                         => array('4.0.0', ''),
            'headers_sent'                   => array('4.0.0', ''),
            'hebrev'                         => array('4.0.0', ''),
            'hebrevc'                        => array('4.0.0', ''),
            'hexdec'                         => array('4.0.0', ''),
            'highlight_file'                 => array('4.0.0', ''),
            'highlight_string'               => array('4.0.0', ''),
            'htmlentities'                   => array('4.0.0', '', '4.0.0, 4.0.3, 4.1.0, 5.2.3'),
            'htmlspecialchars'               => array('4.0.0', '', '4.0.0, 4.0.0, 4.1.0, 5.2.3'),
            'http_build_query'               => array('4.0.0', ''),
            'ignore_user_abort'              => array('4.0.0', ''),
            'image_type_to_extension'        => array('4.0.0', ''),
            'image_type_to_mime_type'        => array('4.0.0', ''),
            'implode'                        => array('4.0.0', ''),
            'in_array'                       => array('4.0.0', ''),
            'ini_alter'                      => array('4.0.0', ''),
            'ini_get'                        => array('4.0.0', ''),
            'ini_restore'                    => array('4.0.0', ''),
            'ini_set'                        => array('4.0.0', ''),
            'intval'                         => array('4.0.0', ''),
            'ip2long'                        => array('4.0.0', ''),
            'iptcembed'                      => array('4.0.0', ''),
            'iptcparse'                      => array('4.0.0', ''),
            'is_array'                       => array('4.0.0', ''),
            'is_bool'                        => array('4.0.0', ''),
            'is_dir'                         => array('4.0.0', ''),
            'is_double'                      => array('4.0.0', ''),
            'is_executable'                  => array('4.0.0', ''),
            'is_file'                        => array('4.0.0', ''),
            'is_float'                       => array('4.0.0', ''),
            'is_int'                         => array('4.0.0', ''),
            'is_integer'                     => array('4.0.0', ''),
            'is_link'                        => array('4.0.0', ''),
            'is_long'                        => array('4.0.0', ''),
            'is_numeric'                     => array('4.0.0', ''),
            'is_object'                      => array('4.0.0', ''),
            'is_readable'                    => array('4.0.0', ''),
            'is_real'                        => array('4.0.0', ''),
            'is_resource'                    => array('4.0.0', ''),
            'is_string'                      => array('4.0.0', ''),
            'is_writable'                    => array('4.0.0', ''),
            'is_writeable'                   => array('4.0.0', ''),
            'join'                           => array('4.0.0', ''),
            'key'                            => array('4.0.0', ''),
            'krsort'                         => array('4.0.0', ''),
            'ksort'                          => array('4.0.0', ''),
            'lcg_value'                      => array('4.0.0', ''),
            'link'                           => array('4.0.0', ''),
            'linkinfo'                       => array('4.0.0', ''),
            'localeconv'                     => array('4.0.0', ''),
            'log'                            => array('4.0.0', ''),
            'log10'                          => array('4.0.0', ''),
            'long2ip'                        => array('4.0.0', ''),
            'lstat'                          => array('4.0.0', ''),
            'ltrim'                          => array('4.0.0', ''),
            'magic_quotes_runtime'           => array('4.0.0', ''),
            'mail'                           => array('4.0.0', ''),
            'max'                            => array('4.0.0', ''),
            'md5'                            => array('4.0.0', '', '4.0.0, 5.0.0'),
            'metaphone'                      => array('4.0.0', ''),
            'microtime'                      => array('4.0.0', '', '5.0.0'),
            'min'                            => array('4.0.0', ''),
            'mkdir'                          => array('4.0.0', '', '4.0.0, 4.0.0, 5.0.0, 5.0.0'),
            'mt_getrandmax'                  => array('4.0.0', ''),
            'mt_rand'                        => array('4.0.0', ''),
            'mt_srand'                       => array('4.0.0', ''),
            'natcasesort'                    => array('4.0.0', ''),
            'natsort'                        => array('4.0.0', ''),
            'next'                           => array('4.0.0', ''),
            'nl2br'                          => array('4.0.0', '', '4.0.0, 5.3.0'),
            'number_format'                  => array('4.0.0', ''),
            'ob_end_clean'                   => array('4.0.0', ''),
            'ob_end_flush'                   => array('4.0.0', ''),
            'ob_get_contents'                => array('4.0.0', ''),
            'ob_implicit_flush'              => array('4.0.0', ''),
            'ob_start'                       => array('4.0.0', ''),
            'octdec'                         => array('4.0.0', ''),
            'opendir'                        => array('4.0.0', '', '4.0.0, 5.3.0'),
            'openlog'                        => array('4.0.0', ''),
            'ord'                            => array('4.0.0', ''),
            'output_add_rewrite_var'         => array('4.0.0', ''),
            'pack'                           => array('4.0.0', ''),
            'parse_ini_file'                 => array('4.0.0', ''),
            'parse_str'                      => array('4.0.0', ''),
            'parse_url'                      => array('4.0.0', '', '4.0.0, 5.2.0'),
            'passthru'                       => array('4.0.0', ''),
            'pclose'                         => array('4.0.0', ''),
            'pfsockopen'                     => array('4.0.0', ''),
            'php_logo_guid'                  => array('4.0.0', ''),
            'php_real_logo_guid'             => array('4.0.0', ''),
            'phpcredits'                     => array('4.0.0', ''),
            'phpinfo'                        => array('4.0.0', ''),
            'phpversion'                     => array('4.0.0', ''),
            'pi'                             => array('4.0.0', ''),
            'popen'                          => array('4.0.0', ''),
            'pos'                            => array('4.0.0', ''),
            'pow'                            => array('4.0.0', ''),
            'prev'                           => array('4.0.0', ''),
            'print_r'                        => array('4.0.0', ''),
            'printf'                         => array('4.0.0', ''),
            'putenv'                         => array('4.0.0', ''),
            'quoted_printable_decode'        => array('4.0.0', ''),
            'quotemeta'                      => array('4.0.0', ''),
            'rad2deg'                        => array('4.0.0', ''),
            'rand'                           => array('4.0.0', ''),
            'range'                          => array('4.0.0', ''),
            'rawurldecode'                   => array('4.0.0', ''),
            'rawurlencode'                   => array('4.0.0', ''),
            'readdir'                        => array('4.0.0', ''),
            'readfile'                       => array('4.0.0', ''),
            'readlink'                       => array('4.0.0', ''),
            'realpath'                       => array('4.0.0', ''),
            'register_shutdown_function'     => array('4.0.0', ''),
            'rename'                         => array('4.0.0', ''),
            'reset'                          => array('4.0.0', ''),
            'rewind'                         => array('4.0.0', ''),
            'rewinddir'                      => array('4.0.0', ''),
            'rmdir'                          => array('4.0.0', ''),
            'round'                          => array('4.0.0', ''),
            'rsort'                          => array('4.0.0', ''),
            'rtrim'                          => array('4.0.0', ''),
            'serialize'                      => array('4.0.0', ''),
            'set_file_buffer'                => array('4.0.0', ''),
            'set_magic_quotes_runtime'       => array('4.0.0', ''),
            'set_socket_blocking'            => array('4.0.0', ''),
            'set_time_limit'                 => array('4.0.0', ''),
            'setcookie'                      => array('4.0.0', ''),
            'setlocale'                      => array('4.0.0', ''),
            'settype'                        => array('4.0.0', ''),
            'shell_exec'                     => array('4.0.0', ''),
            'show_source'                    => array('4.0.0', ''),
            'shuffle'                        => array('4.0.0', ''),
            'similar_text'                   => array('4.0.0', ''),
            'sin'                            => array('4.0.0', ''),
            'sizeof'                         => array('4.0.0', ''),
            'sleep'                          => array('4.0.0', ''),
            'socket_get_status'              => array('4.0.0', ''),
            'socket_set_blocking'            => array('4.0.0', ''),
            'socket_set_timeout'             => array('4.0.0', ''),
            'sort'                           => array('4.0.0', ''),
            'soundex'                        => array('4.0.0', ''),
            'sprintf'                        => array('4.0.0', ''),
            'sqrt'                           => array('4.0.0', ''),
            'srand'                          => array('4.0.0', ''),
            'stat'                           => array('4.0.0', ''),
            'str_repeat'                     => array('4.0.0', ''),
            'str_replace'                    => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 5.0.0'),
            'strchr'                         => array('4.0.0', ''),
            'strcspn'                        => array('4.0.0', ''),
            'strip_tags'                     => array('4.0.0', ''),
            'stripcslashes'                  => array('4.0.0', ''),
            'stripslashes'                   => array('4.0.0', ''),
            'stristr'                        => array('4.0.0', ''),
            'strnatcasecmp'                  => array('4.0.0', ''),
            'strnatcmp'                      => array('4.0.0', ''),
            'strpos'                         => array('4.0.0', ''),
            'strrchr'                        => array('4.0.0', ''),
            'strrev'                         => array('4.0.0', ''),
            'strrpos'                        => array('4.0.0', ''),
            'strspn'                         => array('4.0.0', ''),
            'strstr'                         => array('4.0.0', ''),
            'strtok'                         => array('4.0.0', ''),
            'strtolower'                     => array('4.0.0', ''),
            'strtoupper'                     => array('4.0.0', ''),
            'strtr'                          => array('4.0.0', ''),
            'strval'                         => array('4.0.0', ''),
            'substr'                         => array('4.0.0', ''),
            'substr_count'                   => array('4.0.0', '', '4.0.0, 4.0.0, 5.1.0, 5.1.0'),
            'substr_replace'                 => array('4.0.0', ''),
            'symlink'                        => array('4.0.0', ''),
            'syslog'                         => array('4.0.0', ''),
            'system'                         => array('4.0.0', ''),
            'tan'                            => array('4.0.0', ''),
            'tanh'                           => array('4.0.0', ''),
            'tempnam'                        => array('4.0.0', ''),
            'tmpfile'                        => array('4.0.0', ''),
            'touch'                          => array('4.0.0', ''),
            'trim'                           => array('4.0.0', ''),
            'uasort'                         => array('4.0.0', ''),
            'ucfirst'                        => array('4.0.0', ''),
            'ucwords'                        => array('4.0.0', ''),
            'uksort'                         => array('4.0.0', ''),
            'umask'                          => array('4.0.0', ''),
            'uniqid'                         => array('4.0.0', ''),
            'unlink'                         => array('4.0.0', ''),
            'unpack'                         => array('4.0.0', ''),
            'unserialize'                    => array('4.0.0', ''),
            'urldecode'                      => array('4.0.0', ''),
            'urlencode'                      => array('4.0.0', ''),
            'usleep'                         => array('4.0.0', ''),
            'usort'                          => array('4.0.0', ''),
            'var_dump'                       => array('4.0.0', ''),
            'zend_logo_guid'                 => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.1';       // 2000-06-28
        $items = array(
            'array_diff'                     => array('4.0.1', ''),
            'array_intersect'                => array('4.0.1', ''),
            'array_merge_recursive'          => array('4.0.1', ''),
            'array_unique'                   => array('4.0.1', ''),
            'crc32'                          => array('4.0.1', ''),
            'fflush'                         => array('4.0.1', ''),
            'fscanf'                         => array('4.0.1', ''),
            'levenshtein'                    => array('4.0.1', ''),
            'php_sapi_name'                  => array('4.0.1', ''),
            'sscanf'                         => array('4.0.1', ''),
            'str_pad'                        => array('4.0.1', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.2';       // 2000-08-29
        $items = array(
            'ezmlm_hash'                     => array('4.0.2', ''),
            'ob_get_length'                  => array('4.0.2', ''),
            'php_uname'                      => array('4.0.2', ''),
            'wordwrap'                       => array('4.0.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.3';       // 2000-10-11
        $items = array(
            'escapeshellarg'                 => array('4.0.3', ''),
            'is_uploaded_file'               => array('4.0.3', ''),
            'move_uploaded_file'             => array('4.0.3', ''),
            'pathinfo'                       => array('4.0.3', ''),
            'php_egg_logo_guid'              => array('4.0.3', ''),
            'register_tick_function'         => array('4.0.3', ''),
            'unregister_tick_function'       => array('4.0.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.4';       // 2000-12-19
        $items = array(
            'array_sum'                      => array('4.0.4', ''),
            'call_user_func_array'           => array('4.0.4', ''),
            'constant'                       => array('4.0.4', ''),
            'is_null'                        => array('4.0.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.5';       // 2001-04-30
        $items = array(
            'array_reduce'                   => array('4.0.5', ''),
            'array_search'                   => array('4.0.5', ''),
            'call_user_method_array'         => array('4.0.5', ''),
            'chroot'                         => array('4.0.5', '5.3.18'),
            'is_scalar'                      => array('4.0.5', ''),
            'strcoll'                        => array('4.0.5', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.6';       // 2001-06-23
        $items = array(
            'array_filter'                   => array('4.0.6', ''),
            'array_map'                      => array('4.0.6', ''),
            'is_callable'                    => array('4.0.6', ''),
            'key_exists'                     => array('4.0.6', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.7';       //
        $items = array(
            'acosh'                          => array('4.0.7', ''),
            'array_key_exists'               => array('4.0.7', ''),
            'asinh'                          => array('4.0.7', ''),
            'atanh'                          => array('4.0.7', ''),
            'cosh'                           => array('4.0.7', ''),
            'expm1'                          => array('4.0.7', ''),
            'getmygid'                       => array('4.0.7', ''),
            'hypot'                          => array('4.0.7', ''),
            'import_request_variables'       => array('4.0.7', '5.3.18'),
            'log1p'                          => array('4.0.7', ''),
            'sinh'                           => array('4.0.7', ''),
            'version_compare'                => array('4.0.7', ''),
            'vprintf'                        => array('4.0.7', ''),
            'vsprintf'                       => array('4.0.7', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.1.0';       // 2001-12-10
        $items = array(
            'disk_free_space'                => array('4.1.0', ''),
            'diskfreespace'                  => array('4.1.0', ''),
            'nl_langinfo'                    => array('4.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.2.0';       // 2002-04-22
        $items = array(
            'array_change_key_case'          => array('4.2.0', ''),
            'array_chunk'                    => array('4.2.0', ''),
            'array_fill'                     => array('4.2.0', ''),
            'debug_zval_dump'                => array('4.2.0', ''),
            'floatval'                       => array('4.2.0', ''),
            'fmod'                           => array('4.2.0', ''),
            // In "Semaphore functions" but in "standard" ext
            'ftok'                           => array('4.2.0', ''),
            'ini_get_all'                    => array('4.2.0', ''),
            'is_finite'                      => array('4.2.0', ''),
            'is_infinite'                    => array('4.2.0', ''),
            'is_nan'                         => array('4.2.0', ''),
            'md5_file'                       => array('4.2.0', '', '4.2.0, 5.0.0'),
            'ob_clean'                       => array('4.2.0', ''),
            'ob_flush'                       => array('4.2.0', ''),
            'ob_get_level'                   => array('4.2.0', ''),
            'ob_get_status'                  => array('4.2.0', ''),
            'str_rot13'                      => array('4.2.0', ''),
            'var_export'                     => array('4.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.3.0';       // 2002-12-27
        $items = array(
            'array_diff_assoc'               => array('4.3.0', ''),
            'array_intersect_assoc'          => array('4.3.0', ''),
            'file_get_contents'              => array('4.3.0', '', '4.3.0, 4.3.0, 4.3.0, 5.1.0, 5.1.0'),
            'fnmatch'                        => array('4.3.0', ''),
            'get_include_path'               => array('4.3.0', ''),
            'getopt'                         => array('4.3.0', '', '4.3.0, 5.3.0'),
            'glob'                           => array('4.3.0', ''),
            'html_entity_decode'             => array('4.3.0', ''),
            'money_format'                   => array('4.3.0', ''),
            'ob_get_clean'                   => array('4.3.0', ''),
            'ob_get_flush'                   => array('4.3.0', ''),
            'ob_list_handlers'               => array('4.3.0', ''),
            'output_reset_rewrite_vars'      => array('4.3.0', ''),
            'php_ini_scanned_files'          => array('4.3.0', ''),
            'proc_close'                     => array('4.3.0', ''),
            'proc_open'                      => array('4.3.0', ''),
            'restore_include_path'           => array('4.3.0', ''),
            'set_include_path'               => array('4.3.0', ''),
            'sha1'                           => array('4.3.0', '', '4.3.0, 5.0.0'),
            'sha1_file'                      => array('4.3.0', '', '4.3.0, 5.0.0'),
            'str_shuffle'                    => array('4.3.0', ''),
            'str_word_count'                 => array('4.3.0', ''),
            'stream_context_create'          => array('4.3.0', ''),
            'stream_context_get_options'     => array('4.3.0', ''),
            'stream_context_set_option'      => array('4.3.0', ''),
            'stream_context_set_params'      => array('4.3.0', ''),
            'stream_filter_append'           => array('4.3.0', ''),
            'stream_filter_prepend'          => array('4.3.0', ''),
            'stream_get_meta_data'           => array('4.3.0', ''),
            'stream_register_wrapper'        => array('4.3.0', ''),
            'stream_select'                  => array('4.3.0', ''),
            'stream_set_blocking'            => array('4.3.0', ''),
            'stream_set_timeout'             => array('4.3.0', ''),
            'stream_set_write_buffer'        => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.3.2';       // 2003-05-29
        $items = array(
            'memory_get_usage'               => array('4.3.2', '', '5.2.0'),
            'stream_wrapper_register'        => array('4.3.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.0.0';       // 2004-07-13
        $items = array(
            'array_combine'                  => array('5.0.0', ''),
            'array_diff_uassoc'              => array('5.0.0', ''),
            'array_intersect_uassoc'         => array('5.0.0', ''),
            'array_udiff'                    => array('5.0.0', ''),
            'array_walk_recursive'           => array('5.0.0', ''),
            'convert_uudecode'               => array('5.0.0', ''),
            'convert_uuencode'               => array('5.0.0', ''),
            'dns_check_record'               => array('5.0.0', ''),
            'dns_get_mx'                     => array('5.0.0', ''),
            'dns_get_record'                 => array('5.0.0', ''),
            'file_put_contents'              => array('5.0.0', ''),
            'fprintf'                        => array('5.0.0', ''),
            'get_headers'                    => array('5.0.0', ''),
            'headers_list'                   => array('5.0.0', ''),
            'php_check_syntax'               => array('5.0.0', '5.0.4'),
            'php_strip_whitespace'           => array('5.0.0', ''),
            'proc_get_status'                => array('5.0.0', ''),
            'proc_nice'                      => array('5.0.0', ''),
            'proc_terminate'                 => array('5.0.0', ''),
            'scandir'                        => array('5.0.0', ''),
            'setrawcookie'                   => array('5.0.0', ''),
            'str_ireplace'                   => array('5.0.0', ''),
            'str_split'                      => array('5.0.0', ''),
            'stream_bucket_append'           => array('5.0.0', ''),
            'stream_bucket_make_writeable'   => array('5.0.0', ''),
            'stream_bucket_new'              => array('5.0.0', ''),
            'stream_bucket_prepend'          => array('5.0.0', ''),
            'stream_copy_to_stream'          => array('5.0.0', '', '5.0.0, 5.0.0, 5.0.0, 5.1.0'),
            'stream_filter_register'         => array('5.0.0', ''),
            'stream_get_contents'            => array('5.0.0', '', '5.0.0, 5.0.0, 5.1.0'),
            'stream_get_filters'             => array('5.0.0', ''),
            'stream_get_line'                => array('5.0.0', ''),
            'stream_get_transports'          => array('5.0.0', ''),
            'stream_get_wrappers'            => array('5.0.0', ''),
            'stream_socket_accept'           => array('5.0.0', ''),
            'stream_socket_client'           => array('5.0.0', ''),
            'stream_socket_get_name'         => array('5.0.0', ''),
            'stream_socket_recvfrom'         => array('5.0.0', ''),
            'stream_socket_sendto'           => array('5.0.0', ''),
            'stream_socket_server'           => array('5.0.0', ''),
            'stripos'                        => array('5.0.0', ''),
            'strpbrk'                        => array('5.0.0', ''),
            'strripos'                       => array('5.0.0', ''),
            'substr_compare'                 => array('5.0.0', ''),
            'time_nanosleep'                 => array('5.0.0', ''),
            'vfprintf'                       => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.1.0';       // 2005-11-24
        $items = array(
            'array_diff_key'                 => array('5.1.0', ''),
            'array_diff_ukey'                => array('5.1.0', ''),
            'array_intersect_key'            => array('5.1.0', ''),
            'array_intersect_ukey'           => array('5.1.0', ''),
            'array_product'                  => array('5.1.0', ''),
            'fputcsv'                        => array('5.1.0', ''),
            'htmlspecialchars_decode'        => array('5.1.0', ''),
            'inet_ntop'                      => array('5.1.0', ''),
            'inet_pton'                      => array('5.1.0', ''),
            'lchgrp'                         => array('5.1.0', ''),
            'lchown'                         => array('5.1.0', ''),
            'stream_context_get_default'     => array('5.1.0', ''),
            'stream_filter_remove'           => array('5.1.0', ''),
            'stream_socket_enable_crypto'    => array('5.1.0', ''),
            'stream_socket_pair'             => array('5.1.0', ''),
            'stream_wrapper_restore'         => array('5.1.0', ''),
            'stream_wrapper_unregister'      => array('5.1.0', ''),
            'strptime'                       => array('5.1.0', ''),
            'time_sleep_until'               => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.1.3';       // 2006-05-02
        $items = array(
            'sys_getloadavg'                 => array('5.1.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.2.0';       // 2006-11-02
        $items = array(
            'array_fill_keys'                => array('5.2.0', ''),
            'error_get_last'                 => array('5.2.0', ''),
            'memory_get_peak_usage'          => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.2.1';       // 2007-02-08
        $items = array(
            'stream_socket_shutdown'         => array('5.2.1', ''),
            'sys_get_temp_dir'               => array('5.2.1', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.2.4';       // 2007-08-30
        $items = array(
            'php_ini_loaded_file'            => array('5.2.4', ''),
            'stream_is_local'                => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.3.0';       // 2009-06-30
        $items = array(
            'array_replace'                  => array('5.3.0', ''),
            'array_replace_recursive'        => array('5.3.0', ''),
            'forward_static_call'            => array('5.3.0', ''),
            'forward_static_call_array'      => array('5.3.0', ''),
            'gethostname'                    => array('5.3.0', ''),
            'header_remove'                  => array('5.3.0', ''),
            'lcfirst'                        => array('5.3.0', ''),
            'parse_ini_string'               => array('5.3.0', ''),
            'quoted_printable_encode'        => array('5.3.0', ''),
            'str_getcsv'                     => array('5.3.0', ''),
            'stream_context_get_params'      => array('5.3.0', ''),
            'stream_context_set_default'     => array('5.3.0', ''),
            'stream_supports_lock'           => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.3.2';       // 2010-03-04
        $items = array(
            'realpath_cache_get'             => array('5.3.2', ''),
            'realpath_cache_size'            => array('5.3.2', ''),
            'stream_resolve_include_path'    => array('5.3.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.3.3';       // 2010-07-22
        $items = array(
            'stream_set_read_buffer'         => array('5.3.3', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.4.0';       // 2012-03-01
        $items = array(
            'getimagesizefromstring'         => array('5.4.0', ''),
            'header_register_callback'       => array('5.4.0', ''),
            'hex2bin'                        => array('5.4.0', ''),
            'http_response_code'             => array('5.4.0', ''),
            'stream_set_chunk_size'          => array('5.4.0', ''),
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
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '4.0.0';       // 2000-05-22
        $items = array(
            'ASSERT_ACTIVE'                  => array('4.0.0', ''),
            'ASSERT_BAIL'                    => array('4.0.0', ''),
            'ASSERT_CALLBACK'                => array('4.0.0', ''),
            'ASSERT_QUIET_EVAL'              => array('4.0.0', ''),
            'ASSERT_WARNING'                 => array('4.0.0', ''),
            'CASE_LOWER'                     => array('4.0.0', ''),
            'CASE_UPPER'                     => array('4.0.0', ''),
            'CHAR_MAX'                       => array('4.0.0', ''),
            'CONNECTION_ABORTED'             => array('4.0.0', ''),
            'CONNECTION_NORMAL'              => array('4.0.0', ''),
            'CONNECTION_TIMEOUT'             => array('4.0.0', ''),
            'COUNT_NORMAL'                   => array('4.0.0', ''),
            'COUNT_RECURSIVE'                => array('4.0.0', ''),
            'CREDITS_ALL'                    => array('4.0.0', ''),
            'CREDITS_DOCS'                   => array('4.0.0', ''),
            'CREDITS_FULLPAGE'               => array('4.0.0', ''),
            'CREDITS_GENERAL'                => array('4.0.0', ''),
            'CREDITS_GROUP'                  => array('4.0.0', ''),
            'CREDITS_MODULES'                => array('4.0.0', ''),
            'CREDITS_QA'                     => array('4.0.0', ''),
            'CREDITS_SAPI'                   => array('4.0.0', ''),
            'CRYPT_BLOWFISH'                 => array('4.0.0', ''),
            'CRYPT_EXT_DES'                  => array('4.0.0', ''),
            'CRYPT_MD5'                      => array('4.0.0', ''),
            'CRYPT_SALT_LENGTH'              => array('4.0.0', ''),
            'CRYPT_STD_DES'                  => array('4.0.0', ''),
            'DNS_A'                          => array('4.0.0', ''),
            'DNS_A6'                         => array('4.0.0', ''),
            'DNS_AAAA'                       => array('4.0.0', ''),
            'DNS_ALL'                        => array('4.0.0', ''),
            'DNS_ANY'                        => array('4.0.0', ''),
            'DNS_CNAME'                      => array('4.0.0', ''),
            'DNS_HINFO'                      => array('4.0.0', ''),
            'DNS_MX'                         => array('4.0.0', ''),
            'DNS_NAPTR'                      => array('4.0.0', ''),
            'DNS_NS'                         => array('4.0.0', ''),
            'DNS_PTR'                        => array('4.0.0', ''),
            'DNS_SOA'                        => array('4.0.0', ''),
            'DNS_SRV'                        => array('4.0.0', ''),
            'DNS_TXT'                        => array('4.0.0', ''),
            'ENT_COMPAT'                     => array('4.0.0', ''),
            'ENT_NOQUOTES'                   => array('4.0.0', ''),
            'ENT_QUOTES'                     => array('4.0.0', ''),
            'EXTR_IF_EXISTS'                 => array('4.0.0', ''),
            'EXTR_OVERWRITE'                 => array('4.0.0', ''),
            'EXTR_PREFIX_ALL'                => array('4.0.0', ''),
            'EXTR_PREFIX_IF_EXISTS'          => array('4.0.0', ''),
            'EXTR_PREFIX_INVALID'            => array('4.0.0', ''),
            'EXTR_PREFIX_SAME'               => array('4.0.0', ''),
            'EXTR_REFS'                      => array('4.0.0', ''),
            'EXTR_SKIP'                      => array('4.0.0', ''),
            'FILE_APPEND'                    => array('4.0.0', ''),
            'FILE_IGNORE_NEW_LINES'          => array('4.0.0', ''),
            'FILE_NO_DEFAULT_CONTEXT'        => array('4.0.0', ''),
            'FILE_SKIP_EMPTY_LINES'          => array('4.0.0', ''),
            'FILE_USE_INCLUDE_PATH'          => array('4.0.0', ''),
            'FNM_CASEFOLD'                   => array('4.0.0', ''),
            'FNM_NOESCAPE'                   => array('4.0.0', ''),
            'FNM_PATHNAME'                   => array('4.0.0', ''),
            'FNM_PERIOD'                     => array('4.0.0', ''),
            'GLOB_BRACE'                     => array('4.0.0', ''),
            'GLOB_ERR'                       => array('4.0.0', ''),
            'GLOB_MARK'                      => array('4.0.0', ''),
            'GLOB_NOCHECK'                   => array('4.0.0', ''),
            'GLOB_NOESCAPE'                  => array('4.0.0', ''),
            'GLOB_NOSORT'                    => array('4.0.0', ''),
            'GLOB_ONLYDIR'                   => array('4.0.0', ''),
            'HTML_ENTITIES'                  => array('4.0.0', ''),
            'HTML_SPECIALCHARS'              => array('4.0.0', ''),
            'IMAGETYPE_BMP'                  => array('4.0.0', ''),
            'IMAGETYPE_GIF'                  => array('4.0.0', ''),
            'IMAGETYPE_IFF'                  => array('4.0.0', ''),
            'IMAGETYPE_JB2'                  => array('4.0.0', ''),
            'IMAGETYPE_JP2'                  => array('4.0.0', ''),
            'IMAGETYPE_JPC'                  => array('4.0.0', ''),
            'IMAGETYPE_JPEG'                 => array('4.0.0', ''),
            'IMAGETYPE_JPEG2000'             => array('4.0.0', ''),
            'IMAGETYPE_JPX'                  => array('4.0.0', ''),
            'IMAGETYPE_PNG'                  => array('4.0.0', ''),
            'IMAGETYPE_PSD'                  => array('4.0.0', ''),
            'IMAGETYPE_SWC'                  => array('4.0.0', ''),
            'IMAGETYPE_SWF'                  => array('4.0.0', ''),
            'IMAGETYPE_TIFF_II'              => array('4.0.0', ''),
            'IMAGETYPE_TIFF_MM'              => array('4.0.0', ''),
            'IMAGETYPE_WBMP'                 => array('4.0.0', ''),
            'IMAGETYPE_XBM'                  => array('4.0.0', ''),
            'INF'                            => array('4.0.0', ''),
            'INFO_ALL'                       => array('4.0.0', ''),
            'INFO_CONFIGURATION'             => array('4.0.0', ''),
            'INFO_CREDITS'                   => array('4.0.0', ''),
            'INFO_ENVIRONMENT'               => array('4.0.0', ''),
            'INFO_GENERAL'                   => array('4.0.0', ''),
            'INFO_LICENSE'                   => array('4.0.0', ''),
            'INFO_MODULES'                   => array('4.0.0', ''),
            'INFO_VARIABLES'                 => array('4.0.0', ''),
            'INI_ALL'                        => array('4.0.0', ''),
            'INI_PERDIR'                     => array('4.0.0', ''),
            'INI_SYSTEM'                     => array('4.0.0', ''),
            'INI_USER'                       => array('4.0.0', ''),
            'LC_ALL'                         => array('4.0.0', ''),
            'LC_COLLATE'                     => array('4.0.0', ''),
            'LC_CTYPE'                       => array('4.0.0', ''),
            'LC_MESSAGES'                    => array('4.0.0', ''),
            'LC_MONETARY'                    => array('4.0.0', ''),
            'LC_NUMERIC'                     => array('4.0.0', ''),
            'LC_TIME'                        => array('4.0.0', ''),
            'LOCK_EX'                        => array('4.0.0', ''),
            'LOCK_NB'                        => array('4.0.0', ''),
            'LOCK_SH'                        => array('4.0.0', ''),
            'LOCK_UN'                        => array('4.0.0', ''),
            'LOG_ALERT'                      => array('4.0.0', ''),
            'LOG_AUTH'                       => array('4.0.0', ''),
            'LOG_AUTHPRIV'                   => array('4.0.0', ''),
            'LOG_CONS'                       => array('4.0.0', ''),
            'LOG_CRIT'                       => array('4.0.0', ''),
            'LOG_CRON'                       => array('4.0.0', ''),
            'LOG_DAEMON'                     => array('4.0.0', ''),
            'LOG_DEBUG'                      => array('4.0.0', ''),
            'LOG_EMERG'                      => array('4.0.0', ''),
            'LOG_ERR'                        => array('4.0.0', ''),
            'LOG_INFO'                       => array('4.0.0', ''),
            'LOG_KERN'                       => array('4.0.0', ''),
            'LOG_LOCAL0'                     => array('4.0.0', ''),
            'LOG_LOCAL1'                     => array('4.0.0', ''),
            'LOG_LOCAL2'                     => array('4.0.0', ''),
            'LOG_LOCAL3'                     => array('4.0.0', ''),
            'LOG_LOCAL4'                     => array('4.0.0', ''),
            'LOG_LOCAL5'                     => array('4.0.0', ''),
            'LOG_LOCAL6'                     => array('4.0.0', ''),
            'LOG_LOCAL7'                     => array('4.0.0', ''),
            'LOG_LPR'                        => array('4.0.0', ''),
            'LOG_MAIL'                       => array('4.0.0', ''),
            'LOG_NDELAY'                     => array('4.0.0', ''),
            'LOG_NEWS'                       => array('4.0.0', ''),
            'LOG_NOTICE'                     => array('4.0.0', ''),
            'LOG_NOWAIT'                     => array('4.0.0', ''),
            'LOG_ODELAY'                     => array('4.0.0', ''),
            'LOG_PERROR'                     => array('4.0.0', ''),
            'LOG_PID'                        => array('4.0.0', ''),
            'LOG_SYSLOG'                     => array('4.0.0', ''),
            'LOG_USER'                       => array('4.0.0', ''),
            'LOG_UUCP'                       => array('4.0.0', ''),
            'LOG_WARNING'                    => array('4.0.0', ''),
            'M_1_PI'                         => array('4.0.0', ''),
            'M_2_PI'                         => array('4.0.0', ''),
            'M_2_SQRTPI'                     => array('4.0.0', ''),
            'M_E'                            => array('4.0.0', ''),
            'M_EULER'                        => array('4.0.0', ''),
            'M_LN10'                         => array('4.0.0', ''),
            'M_LN2'                          => array('4.0.0', ''),
            'M_LNPI'                         => array('4.0.0', ''),
            'M_LOG10E'                       => array('4.0.0', ''),
            'M_LOG2E'                        => array('4.0.0', ''),
            'M_PI'                           => array('4.0.0', ''),
            'M_PI_2'                         => array('4.0.0', ''),
            'M_PI_4'                         => array('4.0.0', ''),
            'M_SQRT1_2'                      => array('4.0.0', ''),
            'M_SQRT2'                        => array('4.0.0', ''),
            'M_SQRT3'                        => array('4.0.0', ''),
            'M_SQRTPI'                       => array('4.0.0', ''),
            'NAN'                            => array('4.0.0', ''),
            'PATHINFO_BASENAME'              => array('4.0.0', ''),
            'PATHINFO_DIRNAME'               => array('4.0.0', ''),
            'PATHINFO_EXTENSION'             => array('4.0.0', ''),
            'PATHINFO_FILENAME'              => array('4.0.0', ''),
            'PHP_URL_FRAGMENT'               => array('4.0.0', ''),
            'PHP_URL_HOST'                   => array('4.0.0', ''),
            'PHP_URL_PASS'                   => array('4.0.0', ''),
            'PHP_URL_PATH'                   => array('4.0.0', ''),
            'PHP_URL_PORT'                   => array('4.0.0', ''),
            'PHP_URL_QUERY'                  => array('4.0.0', ''),
            'PHP_URL_SCHEME'                 => array('4.0.0', ''),
            'PHP_URL_USER'                   => array('4.0.0', ''),
            'PSFS_ERR_FATAL'                 => array('4.0.0', ''),
            'PSFS_FEED_ME'                   => array('4.0.0', ''),
            'PSFS_FLAG_FLUSH_CLOSE'          => array('4.0.0', ''),
            'PSFS_FLAG_FLUSH_INC'            => array('4.0.0', ''),
            'PSFS_FLAG_NORMAL'               => array('4.0.0', ''),
            'PSFS_PASS_ON'                   => array('4.0.0', ''),
            'SEEK_CUR'                       => array('4.0.0', ''),
            'SEEK_END'                       => array('4.0.0', ''),
            'SEEK_SET'                       => array('4.0.0', ''),
            'SORT_ASC'                       => array('4.0.0', ''),
            'SORT_DESC'                      => array('4.0.0', ''),
            'SORT_LOCALE_STRING'             => array('4.0.0', ''),
            'SORT_NUMERIC'                   => array('4.0.0', ''),
            'SORT_REGULAR'                   => array('4.0.0', ''),
            'SORT_STRING'                    => array('4.0.0', ''),
            'STREAM_CLIENT_ASYNC_CONNECT'    => array('4.0.0', ''),
            'STREAM_CLIENT_CONNECT'          => array('4.0.0', ''),
            'STREAM_CLIENT_PERSISTENT'       => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_SSLv2_CLIENT'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_SSLv3_CLIENT'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_SSLv23_CLIENT'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_TLS_CLIENT'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_SSLv2_SERVER'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_SSLv3_SERVER'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_SSLv23_SERVER'
                                             => array('4.0.0', ''),
            'STREAM_CRYPTO_METHOD_TLS_SERVER'
                                             => array('4.0.0', ''),
            'STREAM_ENFORCE_SAFE_MODE'       => array('4.0.0', '5.3.18'),
            'STREAM_FILTER_ALL'              => array('4.0.0', ''),
            'STREAM_FILTER_READ'             => array('4.0.0', ''),
            'STREAM_FILTER_WRITE'            => array('4.0.0', ''),
            'STREAM_IGNORE_URL'              => array('4.0.0', ''),
            'STREAM_IPPROTO_IP'              => array('4.0.0', ''),
            'STREAM_MKDIR_RECURSIVE'         => array('4.0.0', ''),
            'STREAM_MUST_SEEK'               => array('4.0.0', ''),
            'STREAM_NOTIFY_AUTH_REQUIRED'    => array('4.0.0', ''),
            'STREAM_NOTIFY_AUTH_RESULT'      => array('4.0.0', ''),
            'STREAM_NOTIFY_COMPLETED'        => array('4.0.0', ''),
            'STREAM_NOTIFY_CONNECT'          => array('4.0.0', ''),
            'STREAM_NOTIFY_FAILURE'          => array('4.0.0', ''),
            'STREAM_NOTIFY_FILE_SIZE_IS'     => array('4.0.0', ''),
            'STREAM_NOTIFY_MIME_TYPE_IS'     => array('4.0.0', ''),
            'STREAM_NOTIFY_PROGRESS'         => array('4.0.0', ''),
            'STREAM_NOTIFY_REDIRECTED'       => array('4.0.0', ''),
            'STREAM_NOTIFY_RESOLVE'          => array('4.0.0', ''),
            'STREAM_NOTIFY_SEVERITY_ERR'     => array('4.0.0', ''),
            'STREAM_NOTIFY_SEVERITY_INFO'    => array('4.0.0', ''),
            'STREAM_NOTIFY_SEVERITY_WARN'    => array('4.0.0', ''),
            'STREAM_OOB'                     => array('4.0.0', ''),
            'STREAM_PEEK'                    => array('4.0.0', ''),
            'STREAM_PF_INET'                 => array('4.0.0', ''),
            'STREAM_PF_INET6'                => array('4.0.0', ''),
            'STREAM_PF_UNIX'                 => array('4.0.0', ''),
            'STREAM_REPORT_ERRORS'           => array('4.0.0', ''),
            'STREAM_SERVER_BIND'             => array('4.0.0', ''),
            'STREAM_SERVER_LISTEN'           => array('4.0.0', ''),
            'STREAM_SHUT_RD'                 => array('4.0.0', ''),
            'STREAM_SHUT_RDWR'               => array('4.0.0', ''),
            'STREAM_SHUT_WR'                 => array('4.0.0', ''),
            'STREAM_SOCK_DGRAM'              => array('4.0.0', ''),
            'STREAM_SOCK_RAW'                => array('4.0.0', ''),
            'STREAM_SOCK_RDM'                => array('4.0.0', ''),
            'STREAM_SOCK_SEQPACKET'          => array('4.0.0', ''),
            'STREAM_SOCK_STREAM'             => array('4.0.0', ''),
            'STREAM_URL_STAT_LINK'           => array('4.0.0', ''),
            'STREAM_URL_STAT_QUIET'          => array('4.0.0', ''),
            'STREAM_USE_PATH'                => array('4.0.0', ''),
            'STR_PAD_BOTH'                   => array('4.0.0', ''),
            'STR_PAD_LEFT'                   => array('4.0.0', ''),
            'STR_PAD_RIGHT'                  => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.0.6';       // 2001-06-23
        $items = array(
            'DIRECTORY_SEPARATOR'            => array('4.0.6', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.1.0';       // 2001-12-10
        $items = array(
            'ABDAY_1'                        => array('4.1.0', ''),
            'ABDAY_2'                        => array('4.1.0', ''),
            'ABDAY_3'                        => array('4.1.0', ''),
            'ABDAY_4'                        => array('4.1.0', ''),
            'ABDAY_5'                        => array('4.1.0', ''),
            'ABDAY_6'                        => array('4.1.0', ''),
            'ABDAY_7'                        => array('4.1.0', ''),
            'ABMON_1'                        => array('4.1.0', ''),
            'ABMON_10'                       => array('4.1.0', ''),
            'ABMON_11'                       => array('4.1.0', ''),
            'ABMON_12'                       => array('4.1.0', ''),
            'ABMON_2'                        => array('4.1.0', ''),
            'ABMON_3'                        => array('4.1.0', ''),
            'ABMON_4'                        => array('4.1.0', ''),
            'ABMON_5'                        => array('4.1.0', ''),
            'ABMON_6'                        => array('4.1.0', ''),
            'ABMON_7'                        => array('4.1.0', ''),
            'ABMON_8'                        => array('4.1.0', ''),
            'ABMON_9'                        => array('4.1.0', ''),
            'ALT_DIGITS'                     => array('4.1.0', ''),
            'AM_STR'                         => array('4.1.0', ''),
            'CODESET'                        => array('4.1.0', ''),
            'CRNCYSTR'                       => array('4.1.0', ''),
            'DAY_1'                          => array('4.1.0', ''),
            'DAY_2'                          => array('4.1.0', ''),
            'DAY_3'                          => array('4.1.0', ''),
            'DAY_4'                          => array('4.1.0', ''),
            'DAY_5'                          => array('4.1.0', ''),
            'DAY_6'                          => array('4.1.0', ''),
            'DAY_7'                          => array('4.1.0', ''),
            'D_FMT'                          => array('4.1.0', ''),
            'D_T_FMT'                        => array('4.1.0', ''),
            'ERA'                            => array('4.1.0', ''),
            'ERA_D_FMT'                      => array('4.1.0', ''),
            'ERA_D_T_FMT'                    => array('4.1.0', ''),
            'ERA_T_FMT'                      => array('4.1.0', ''),
            'MON_1'                          => array('4.1.0', ''),
            'MON_10'                         => array('4.1.0', ''),
            'MON_11'                         => array('4.1.0', ''),
            'MON_12'                         => array('4.1.0', ''),
            'MON_2'                          => array('4.1.0', ''),
            'MON_3'                          => array('4.1.0', ''),
            'MON_4'                          => array('4.1.0', ''),
            'MON_5'                          => array('4.1.0', ''),
            'MON_6'                          => array('4.1.0', ''),
            'MON_7'                          => array('4.1.0', ''),
            'MON_8'                          => array('4.1.0', ''),
            'MON_9'                          => array('4.1.0', ''),
            'NOEXPR'                         => array('4.1.0', ''),
            'PM_STR'                         => array('4.1.0', ''),
            'RADIXCHAR'                      => array('4.1.0', ''),
            'THOUSEP'                        => array('4.1.0', ''),
            'T_FMT'                          => array('4.1.0', ''),
            'T_FMT_AMPM'                     => array('4.1.0', ''),
            'YESEXPR'                        => array('4.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '4.3.0';       // 2002-12-27
        $items = array(
            'PATH_SEPARATOR'                 => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.1.0';       // 2005-11-24
        $items = array(
            'STREAM_IPPROTO_ICMP'               => array('5.1.0', ''),
            'STREAM_IPPROTO_RAW'                => array('5.1.0', ''),
            'STREAM_IPPROTO_TCP'                => array('5.1.0', ''),
            'STREAM_IPPROTO_UDP'                => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.2.4';       // 2007-08-30
        $items = array(
            'GLOB_AVAILABLE_FLAGS'              => array('5.2.4', ''),
            'STREAM_IS_URL'                     => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.2.7';       // 2008-12-04
        $items = array(
            'FILE_BINARY'                       => array('5.2.7', ''),
            'FILE_TEXT'                         => array('5.2.7', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.0';       // 2009-06-30
        $items = array(
            'ENT_IGNORE'                        => array('5.3.0', ''),
            'IMAGETYPE_COUNT'                   => array('5.3.0', ''),
            'IMAGETYPE_ICO'                     => array('5.3.0', ''),
            'IMAGETYPE_UNKNOWN'                 => array('5.3.0', ''),
            'INI_SCANNER_NORMAL'                => array('5.3.0', ''),
            'INI_SCANNER_RAW'                   => array('5.3.0', ''),
            'PHP_ROUND_HALF_DOWN'               => array('5.3.0', ''),
            'PHP_ROUND_HALF_EVEN'               => array('5.3.0', ''),
            'PHP_ROUND_HALF_ODD'                => array('5.3.0', ''),
            'PHP_ROUND_HALF_UP'                 => array('5.3.0', ''),
            'STREAM_BUFFER_FULL'                => array('5.3.0', ''),
            'STREAM_BUFFER_LINE'                => array('5.3.0', ''),
            'STREAM_BUFFER_NONE'                => array('5.3.0', ''),
            'STREAM_CAST_AS_STREAM'             => array('5.3.0', ''),
            'STREAM_CAST_FOR_SELECT'            => array('5.3.0', ''),
            'STREAM_OPTION_BLOCKING'            => array('5.3.0', ''),
            'STREAM_OPTION_READ_BUFFER'         => array('5.3.0', ''),
            'STREAM_OPTION_READ_TIMEOUT'        => array('5.3.0', ''),
            'STREAM_OPTION_WRITE_BUFFER'        => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.2';       // 2010-03-04
        $items = array(
            'CRYPT_SHA256'                      => array('5.3.2', ''),
            'CRYPT_SHA512'                      => array('5.3.2', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.4.0';       // 2012-03-01
        $items = array(
            'ENT_DISALLOWED'                    => array('5.4.0', ''),
            'ENT_HTML401'                       => array('5.4.0', ''),
            'ENT_HTML5'                         => array('5.4.0', ''),
            'ENT_SUBSTITUTE'                    => array('5.4.0', ''),
            'ENT_XHTML'                         => array('5.4.0', ''),
            'ENT_XML1'                          => array('5.4.0', ''),
            'PHP_QUERY_RFC1738'                 => array('5.4.0', ''),
            'PHP_QUERY_RFC3986'                 => array('5.4.0', ''),
            'SCANDIR_SORT_ASCENDING'            => array('5.4.0', ''),
            'SCANDIR_SORT_DESCENDING'           => array('5.4.0', ''),
            'SCANDIR_SORT_NONE'                 => array('5.4.0', ''),
            'SORT_FLAG_CASE'                    => array('5.4.0', ''),
            'SORT_NATURAL'                      => array('5.4.0', ''),
            'STREAM_META_ACCESS'                => array('5.4.0', ''),
            'STREAM_META_GROUP'                 => array('5.4.0', ''),
            'STREAM_META_GROUP_NAME'            => array('5.4.0', ''),
            'STREAM_META_OWNER'                 => array('5.4.0', ''),
            'STREAM_META_OWNER_NAME'            => array('5.4.0', ''),
            'STREAM_META_TOUCH'                 => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

    /**
     * Gets informations about tokens (language features)
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getTokens($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $tokens = array();

        $release = '5.0.0';       // 2004-07-13
        $items = array(
            'catch'                          => array('5.0.0', ''),
            'clone'                          => array('5.0.0', ''),
            'instanceof'                     => array('5.0.0', ''),
            'throw'                          => array('5.0.0', ''),
            'try'                            => array('5.0.0', ''),
            '(unset)'                        => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $tokens);

        $release = '5.1.0';       // 2005-11-24
        $items = array(
            '__halt_compiler'                => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $tokens);

        $release = '5.3.0';       // 2009-06-30
        $items = array(
            'goto'                           => array('5.3.0', ''),
            'use'                            => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $tokens);

        $release = '5.4.0';       // 2012-03-01
        $items = array(
            'classMemberAccessOnInstantiation'
                                             => array('5.4.0', ''),
            'arrayDereferencing'             => array('5.4.0', ''),
            'insteadof'                      => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $tokens);

        return $tokens;
    }

    /**
     * Gets informations about superglobals
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/language.variables.superglobals.php
     */
    public function getGlobals($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $globals = array();

        $release = '4.0.0';       // 2000-05-22
        $items = array(
            '$GLOBALS'                       => array('4.0.0', ''),
            '$HTTP_SERVER_VARS'              => array('4.0.0', ''),
            '$HTTP_GET_VARS'                 => array('4.0.0', ''),
            '$HTTP_POST_VARS'                => array('4.0.0', ''),
            '$HTTP_POST_FILES'               => array('4.0.0', ''),
            '$HTTP_COOKIE_VARS'              => array('4.0.0', ''),
            '$HTTP_SESSION_VARS'             => array('4.0.0', ''),
            '$HTTP_ENV_VARS'                 => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $globals);

        $release = '4.1.0';       // 2001-12-10
        $items = array(
            '$_SERVER'                       => array('4.1.0', ''),
            '$_GET'                          => array('4.1.0', ''),
            '$_POST'                         => array('4.1.0', ''),
            '$_COOKIE'                       => array('4.1.0', ''),
            '$_SESSION'                      => array('4.1.0', ''),
            '$_ENV'                          => array('4.1.0', ''),
        );
        $this->applyFilter($release, $items, $globals);

        return $globals;
    }

}
