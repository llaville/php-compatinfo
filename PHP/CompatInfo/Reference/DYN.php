<?php
/**
 * EXPERIMENTAL (all rules are not yet implemented)
 * Lazy loader for references
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
 * Lazy loader for references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.23.0
 */
class PHP_CompatInfo_Reference_DYN
    extends PHP_CompatInfo_Reference_PHP5
{
    /**
     * Rules that should identify a reference to match for lazy loading
     */
    protected $rules;

    /**
     * Actual loaded references
     */
    protected $extensionReferences = array();

    /**
     * @param array $references (optional) Default references to prefetch
     * @param array $rules      (optional) Additional lazy loader rules
     * @param bool $prepend     Will add rules to head to stack rather than end by default
     */
    public function __construct(array $references = array(), array $rules = array(),
        $prepend = FALSE
    ) {
        $this->rules = array(
            array(
                'prefixes'  => array('Spl', 'spl_', 'class_', 'iterator_'),
                'suffixes'  => array('Iterator', 'Exception'),
                'contains'  => FALSE,
                'extension' => 'SPL',
            ),
            array(
                'prefixes'  => array('AMQP'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'amqp',
            ),
            array(
                'prefixes'  => array('APC', 'apc_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'apc',
            ),
            array(
                'prefixes'  => array('apcu_', 'APCU_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'apcu',
            ),
            array(
                'prefixes'  => array('bc'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'bcmath',
            ),
            array(
                'prefixes'  => array('bz'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'bz2',
            ),
            array(
                'prefixes'  => array('cal_', 'easter_', 'frenchtojd', 'gregoriantojd', 'jd', 'CAL_'),
                'suffixes'  => 'tojd',
                'contains'  => FALSE,
                'extension' => 'calendar',
            ),
            array(
                'prefixes'  => 'ctype_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ctype',
            ),
            array(
                'prefixes'  => array('curl_', 'CURL'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'curl',
            ),
            array(
                'prefixes'  => array('DateTime', 'DateInterval', 'DatePeriod', 'date_', 'timezone_', 'DATE_', 'SUNFUNCS_'),
                'suffixes'  => array('date', 'time'),
                'contains'  => FALSE,
                'extension' => 'date',
            ),
            array(
                'prefixes'  => array('Dom', 'dom_', 'DOM_', 'XML_', 'DOMSTRING_SIZE_ERR'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'dom',
            ),
            array(
                'prefixes'  => array('enchant_', 'ENCHANT_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'enchant',
            ),
            array(
                'prefixes'  => array('ereg', 'split', 'sql_regcase'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ereg',
            ),
            array(
                'prefixes'  => array('exif_', 'EXIF_'),
                'suffixes'  => FALSE,
                'contains'  => 'read_exif_data',
                'extension' => 'exif',
            ),
            array(
                'prefixes'  => array('finfo', 'FILEINFO_'),
                'suffixes'  => FALSE,
                'contains'  => 'mime_content_type',
                'extension' => 'fileinfo',
            ),
            array(
                'prefixes'  => array('input_', 'filter_', 'INPUT_', 'FILTER_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'filter',
            ),
            array(
                'prefixes'  => array('ftp_', 'FTP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ftp',
            ),
            array(
                'prefixes'  => array('image', 'IMG_', 'PNG_', 'GD_'),
                'suffixes'  => '2wbmp',
                'contains'  => 'gd_info',
                'extension' => 'gd',
            ),
            array(
                'prefixes'  => 'Gender',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'gender',
            ),
            array(
                'prefixes'  => array('geoip_', 'GEOIP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'geoip',
            ),
            array(
                'prefixes'  => FALSE,
                'suffixes'  => 'gettext',
                'contains'  => 'textdomain',
                'extension' => 'gettext',
            ),
            array(
                'prefixes'  => array('gmp_', 'GMP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'gmp',
            ),
            array(
                'prefixes'  => 'Haru',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'haru',
            ),
            array(
                'prefixes'  => array('hash_', 'mhash_', 'HASH_', 'MHASH_'),
                'suffixes'  => array('hash', 'mhash'),
                'contains'  => FALSE,
                'extension' => 'hash',
            ),
            array(
                'prefixes'  => array('Http', 'http_', 'HTTP_'),
                'suffixes'  => FALSE,
                'contains'  => array('ob_deflatehandler', 'ob_etaghandler', 'ob_inflatehandler'),
                'extension' => 'http',
            ),
            array(
                'prefixes'  => array('iconv_', 'ICONV_'),
                'suffixes'  => FALSE,
                'contains'  => 'iconv',
                'extension' => 'iconv',
            ),
            array(
                'prefixes'  => 'igbinary_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'igbinary',
            ),
            array(
                'prefixes'  => 'Imagick',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'imagick',
            ),
            array(
                'prefixes'  => array(
                    'imap_', 'CL_', 'CP_', 'ENC', 'FT_', 'IMAP_',
                    'LATT_', 'OP_', 'SA_', 'SE_', 'SORT', 'SO_', 'ST_', 'TYPE'
                ),
                'suffixes'  => 'NIL',
                'contains'  => FALSE,
                'extension' => 'imap',
            ),
            array(
                'prefixes'  => 'inclued_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'inclued',
            ),
            array(
                'prefixes'  => array(
                    'Intl', 'UConverter', 'Collator', 'Locale',
                    'MessageFormatter', 'NumberFormatter', 'Normalizer',
                    'ResourceBundle', 'Spoofchecker', 'Transliterator',
                    'intl_', 'collator_', 'locale_', 'msgfmt_', 'normalizer_',
                    'numfmt_', 'datefmt_', 'grapheme_', 'idn_', 'resourcebundle_',
                    'transliterator_', 'intlgregcal_', 'intlcal_', 'intltz_',
                    'ULOC_', 'U_', 'GRAPHEME_', 'IDNA_', 'INTL_'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'intl',
            ),
            array(
                'prefixes'  => array('Json', 'json_', 'JSON_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'json',
            ),
            array(
                'prefixes'  => array('ldap_', 'LDAP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ldap',
            ),
            array(
                'prefixes'  => array('event_', 'EVLOOP_', 'EV_', 'EVBUFFER_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'libevent',
            ),
            array(
                'prefixes'  => array('libxml_', 'LibXML', 'LIBXML_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'libxml',
            ),
            array(
                'prefixes'  => 'lzf_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'lzf',
            ),
            array(
                'prefixes'  => array('mailparse_', 'MAILPARSE_'),
                'suffixes'  => FALSE,
                'contains'  => 'mimemessage',
                'extension' => 'mailparse',
            ),
            array(
                'prefixes'  => array('mb_', 'mbereg', 'mbregex', 'mbsplit', 'MB_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mbstring',
            ),
            array(
                'prefixes'  => array('mcrypt_', 'mdecrypt_', 'MCRYPT_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mcrypt',
            ),
            array(
                'prefixes'  => array('memcache_', 'Memcache', 'MEMCACHE_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'memcache',
            ),
            array(
                'prefixes'  => 'Memcached',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'memcached',
            ),
            array(
                'prefixes'  => array('mhash', 'MHASH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mhash',
            ),
            array(
                'prefixes'  => array('Mongo', 'bson_', 'MONGO_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mongo',
            ),
            array(
                'prefixes'  => array('msgpack_', 'MessagePack'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'msgpack',
            ),
            array(
                'prefixes'  => array('mssql_', 'MSSQL_', 'SQL'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mssql',
            ),
            array(
                'prefixes'  => array('mysql_', 'MYSQL_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mysql',
            ),
            array(
                'prefixes'  => array('mysqli_', 'MYSQLI_', 'mysqli'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mysqli',
            ),
            array(
                'prefixes'  => array('OAuth', 'oauth_', 'OAUTH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'OAuth',
            ),
            array(
                'prefixes'  => array('odbc_', 'ODBC_', 'SQL_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'odbc',
            ),
            array(
                'prefixes'  => array('openssl_', 'OPENSSL_', 'PKCS7_', 'X509_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'openssl',
            ),
            array(
                'prefixes'  => array(
                    'pcntl_', 'BUS_', 'CLD_', 'FPE_', 'ILL_', 'PCNTL_', 'POLL_',
                    'PRIO_', 'SEGV_', 'SIG', 'SI_', 'TRAP_', 'WNOHANG', 'WUNTRACED'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pcntl',
            ),
            array(
                'prefixes'  => array('preg_', 'PCRE_', 'PREG_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pcre',
            ),
            array(
                'prefixes'  => array('PDFlib', 'pdf_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'PDFlib',
            ),
            array(
                'prefixes'  => array('PDO', 'pdo_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'PDO',
            ),
            array(
                'prefixes'  => array('pg_', 'PGSQL_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pgsql',
            ),
            array(
                'prefixes'  => 'Phar',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Phar',
            ),
            array(
                'prefixes'  => array('posix_', 'POSIX_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'posix',
            ),
            array(
                'prefixes'  => array(
                    'Cond', 'Mutex', 'Stackable', 'Thread', 'Worker', 'PTHREADS_'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pthreads',
            ),
            array(
                'prefixes'  => array('Rar', 'rar_', 'RAR_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'rar',
            ),
            array(
                'prefixes'  => array('readline', 'READLINE_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'readline',
            ),
            array(
                'prefixes'  => 'recode',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'recode',
            ),
            array(
                'prefixes'  => array('Reflection', 'Reflector'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Reflection',
            ),
            array(
                'prefixes'  => array('Session', 'session_', 'PHP_SESSION_', 'SID'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'session',
            ),
            array(
                'prefixes'  => 'shmop_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'shmop',
            ),
            array(
                'prefixes'  => array('SimpleXML', 'simplexml_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SimpleXML',
            ),
            array(
                'prefixes'  => array('SNMP', 'snmp'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'snmp',
            ),
            array(
                'prefixes'  => array(
                    'Soap', 'SOAP_', 'WSDL_', 'XSD_',
                    'APACHE_MAP', 'UNKNOWN_TYPE'
                ),
                'suffixes'  => FALSE,
                'contains'  => '_soap_',
                'extension' => 'soap',
            ),
            array(
                'prefixes'  => array(
                    'socket_', 'AF_', 'IPPROTO_', 'IPV6_', 'IP_', 'MCAST_',
                    'MSG_', 'PHP_BINARY_READ', 'PHP_NORMAL_READ', 'SCM_',
                    'SOCKET_', 'SOCK_', 'SOL_', 'SOMAXCONN', 'SO_', 'TCP_NODELAY'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sockets',
            ),
            array(
                'prefixes'  => array('Solr', 'solr_', 'SOLR_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'solr',
            ),
            array(
                'prefixes'  => array('Sphinx', 'SEARCHD_', 'SPH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sphinx',
            ),
            array(
                'prefixes'  => array(
                    'Spl', 'Iterator',
                    'Countable', 'ArrayAccess', 'Serializable', 'Traversable',
                    'ArrayObject',
                    'spl_', 'class_', 'iterator_'
                ),
                'suffixes'  => array('Iterator', 'Exception'),
                'contains'  => FALSE,
                'extension' => 'SPL',
            ),
            array(
                'prefixes'  => array('SQLite', 'sqlite_', 'SQLITE_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SQLite',
            ),
            array(
                'prefixes'  => array('SQLite3', 'SQLITE3_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SQLite3',
            ),
            array(
                'prefixes'  => array('ssh2_', 'SSH2_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ssh2',
            ),
            array(
                'prefixes'  => array('stomp_', 'Stomp'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'stomp',
            ),
            array(
                'prefixes'  => array('svn_', 'Svn', 'SVN_', 'PHP_SVN_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'svn',
            ),
            array(
                'prefixes'  => array('msg_', 'MSG_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sysvmsg',
            ),
            array(
                'prefixes'  => 'sem_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sysvsem',
            ),
            array(
                'prefixes'  => 'shm_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sysvshm',
            ),
            array(
                'prefixes'  => array('tidy_', 'TIDY_', 'tidy', 'ob_tidy'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'tidy',
            ),
            array(
                'prefixes'  => array('token_', 'T_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'tokenizer',
            ),
            array(
                'prefixes'  => 'uploadprogress_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'uploadprogress',
            ),
            array(
                'prefixes'  => array('Varnish', 'VARNISH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'varnish',
            ),
            array(
                'prefixes'  => 'wddx_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'wddx',
            ),
            array(
                'prefixes'  => array('xcache_', 'XCACHE_', 'XC_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'XCache',
            ),
            array(
                'prefixes'  => array('xdebug_', 'XDEBUG_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xdebug',
            ),
            array(
                'prefixes'  => array('xhprof_', 'XHPROF_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xhprof',
            ),
            array(
                'prefixes'  => array('xml_', 'utf8_', 'XML_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xml',
            ),
            array(
                'prefixes'  => 'XMLReader',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xmlreader',
            ),
            array(
                'prefixes'  => 'xmlrpc_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xmlrpc',
            ),
            array(
                'prefixes'  => array('XMLWriter', 'xmlwriter_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xmlwriter',
            ),
            array(
                'prefixes'  => array('XSLT', 'XSL_', 'LIBEXSLT_', 'LIBXSLT_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xsl',
            ),
            array(
                'prefixes'  => array('yaml_', 'YAML_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'yaml',
            ),
            array(
                'prefixes'  => 'opcache_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Zend OPcache',
            ),
            array(
                'prefixes'  => array('zip_', 'Zip'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'zip',
            ),
            array(
                'prefixes'  => '*',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Core',
            ),
            array(
                'prefixes'  => '*',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'standard',
            ),
        );
        if (count($rules) > 0) {
            if ($prepend === TRUE) {
                $this->rules = array_merge($rules, $this->rules);
            } else {
                $this->rules = array_merge($this->rules, $rules);
            }
        }

        if (count($references) > 0) {
            // references always loaded before start of parsing data sources
            foreach($references as $name) {
                $this->loadReference($name, TRUE);
            }
        }
    }

    /**
     * Returns a PHP_CompatInfo_Reference object.
     *
     * @param string $element  One of reference's element to discover
     * @param bool   $prefetch (optional) When FALSE, do a matching rules search.
     *                         Otherwise force a prefetch with $element
     *                         that identify a reference.
     *
     * @return mixed FALSE if reference could not be loaded or is not detected,
     *               reference object instance otherwise
     */
    public function loadReference($element, $prefetch = FALSE)
    {
        if ($prefetch === TRUE) {
            $extension = $element;
        } else {
            $extension = NULL;

            if ($this->match($element, $extension) === FALSE) {
                return FALSE;
            }
        }

        if (!array_key_exists($extension, $this->extensionReferences)) {

            $refClassName = 'PHP_CompatInfo_Reference_' . ucfirst(str_replace(' ', '', $extension));
            $refClassName = str_replace(' ', '_', $refClassName);
            if (class_exists($refClassName, true)) {
                $this->extensionReferences[$extension] = new $refClassName;
                //error_log('lazy load ref : '. $refClassName);
            } else {
                $this->warnings[] = "Could not load extension reference '$extension'";
                $this->extensionReferences[$extension] = FALSE;
            }
        }

        return $this->extensionReferences[$extension];
    }

    /**
     * Try to found the extension where Element is defined
     *

     * @param string $name       Element's name
     * @param string &$extension Element's extension found
     *
     * @return bool TRUE if found, FALSE otherwise
     */
    protected function match($name, &$extension)
    {
        $found = FALSE;

        foreach($this->rules as $rule) {
            if (isset($rule['prefixes']) && empty($rule['prefixes'])
                && isset($rule['suffixes']) && empty($rule['suffixes'])
                && isset($rule['contains']) && empty($rule['contains'])
            ) {
                continue;  // skip the empty rule
            }

            if (!$found && $rule['prefixes'] === '*') {
                // search into Core and standard references

                $functions = $this->extensionReferences[$rule['extension']]->getFunctions();
                if (array_key_exists($name, $functions)) {
                    $found = TRUE;
                    break 1;
                }
                unset($functions);

                $constants = $this->extensionReferences[$rule['extension']]->getConstants();
                if (array_key_exists($name, $constants)) {
                    $found = TRUE;
                    break 1;
                }
                unset($constants);

                $interfaces = $this->extensionReferences[$rule['extension']]->getInterfaces();
                if (array_key_exists($name, $interfaces)) {
                    $found = TRUE;
                    break 1;
                }
                unset($interfaces);

                $classes = $this->extensionReferences[$rule['extension']]->getClasses();
                if (array_key_exists($name, $classes)) {
                    $found = TRUE;
                    break 1;
                }
                unset($classes);

                if ('standard' === $rule['extension']) {
                    $tokens = $this->extensionReferences[$rule['extension']]->getTokens();
                    if (array_key_exists($name, $tokens)) {
                        $found = TRUE;
                        break 1;
                    }
                    unset($tokens);

                    $globals = $this->extensionReferences[$rule['extension']]->getGlobals();
                    if (array_key_exists($name, $globals)) {
                        $found = TRUE;
                        break 1;
                    }
                    unset($globals);
                }
            }

            if (!$found && !empty($rule['prefixes'])) {
                if (!is_array($rule['prefixes'])) {
                    $rule['prefixes'] = array( $rule['prefixes'] );
                }
                foreach( $rule['prefixes'] as $prefix ) {
                    if (strpos($name, $prefix) === 0) {
                        // the reference element name begin with this prefix
                        $found = TRUE;
                        break 2;
                    }
                }
            }

            if (!$found && !empty($rule['suffixes'])) {
                if (!is_array($rule['suffixes'])) {
                    $rule['suffixes'] = array( $rule['suffixes'] );
                }
                foreach( $rule['suffixes'] as $suffix ) {
                    if (substr($name, -1 * strlen($suffix)) === $suffix) {
                        // the reference element name end with this suffix
                        $found = TRUE;
                        break 2;
                    }
                }
            }

            if (!$found && !empty($rule['contains'])) {
                if (!is_array($rule['contains'])) {
                    $rule['contains'] = array( $rule['contains'] );
                }
                foreach( $rule['contains'] as $contains ) {
                    if (strpos($name, $contains) !== FALSE) {
                        // the reference element name contains this word
                        $found = TRUE;
                        break 2;
                    }
                }
            }
        }

        $extension = $found ? $rule['extension'] : NULL;
        return $found;
    }

}
