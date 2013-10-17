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
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'AMQP',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'amqp',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('APC', 'apc_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'apc',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('apcu_', 'APCU_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'apcu',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('bc'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'bcmath',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('bz'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'bz2',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('cal_', 'easter_', 'frenchtojd', 'gregoriantojd', 'jd', 'CAL_'),
                'suffixes'  => 'tojd',
                'contains'  => FALSE,
                'extension' => 'calendar',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'ctype_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ctype',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('curl_', 'CURL'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'curl',
            ),
            array(
                'matches'   => '^(gm|loc|mk|str).*time$',
                'excludes'  => FALSE,
                'prefixes'  => array(
                    'DateTime', 'DateInterval', 'DatePeriod',
                    'date_', 'time', 'timezone_', 'DATE_', 'SUNFUNCS_'
                ),
                'suffixes'  => 'date',
                'contains'  => FALSE,
                'extension' => 'date',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('DOM', 'dom_', 'DOM_', 'XML_', 'DOMSTRING_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'dom',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('enchant_', 'ENCHANT_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'enchant',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('ereg', 'split', 'sql_regcase'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ereg',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('exif_', 'EXIF_'),
                'suffixes'  => FALSE,
                'contains'  => 'read_exif_data',
                'extension' => 'exif',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('finfo', 'FILEINFO_'),
                'suffixes'  => FALSE,
                'contains'  => 'mime_content_type',
                'extension' => 'fileinfo',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('input_', 'filter_', 'INPUT_', 'FILTER_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'filter',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('ftp_', 'FTP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ftp',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('image', 'IMG_', 'PNG_', 'GD_'),
                'suffixes'  => '2wbmp',
                'contains'  => 'gd_info',
                'extension' => 'gd',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'Gender',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'gender',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('geoip_', 'GEOIP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'geoip',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => FALSE,
                'suffixes'  => 'gettext',
                'contains'  => 'textdomain',
                'extension' => 'gettext',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('gmp_', 'GMP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'gmp',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'Haru',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'haru',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('hash', 'mhash', 'HASH_', 'MHASH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'hash',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Http', 'http_', 'HTTP_'),
                'suffixes'  => FALSE,
                'contains'  => array(
                    'ob_deflatehandler', 'ob_etaghandler', 'ob_inflatehandler'
                ),
                'extension' => 'http',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('iconv_', 'ICONV_'),
                'suffixes'  => FALSE,
                'contains'  => 'iconv',
                'extension' => 'iconv',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'igbinary_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'igbinary',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'Imagick',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'imagick',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array(
                    'imap_', 'CL_', 'CP_', 'ENC', 'FT_', 'IMAP_',
                    'LATT_', 'OP_', 'SA_', 'SE_', 'SORT', 'SO_', 'ST_', 'TYPE'
                ),
                'suffixes'  => 'NIL',
                'contains'  => FALSE,
                'extension' => 'imap',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'inclued_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'inclued',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
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
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Json', 'json_', 'JSON_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'json',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('ldap_', 'LDAP_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ldap',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('event_', 'EVLOOP_', 'EV_', 'EVBUFFER_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'libevent',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('libxml_', 'LibXML', 'LIBXML_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'libxml',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'lzf_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'lzf',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mailparse_', 'MAILPARSE_'),
                'suffixes'  => FALSE,
                'contains'  => 'mimemessage',
                'extension' => 'mailparse',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mb_', 'mbereg', 'mbregex', 'mbsplit', 'MB_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mbstring',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mcrypt_', 'mdecrypt_', 'MCRYPT_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mcrypt',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('memcache_', 'Memcache', 'MEMCACHE_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'memcache',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'Memcached',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'memcached',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mhash', 'MHASH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mhash',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Mongo', 'bson_', 'MONGO_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mongo',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('msgpack_', 'MessagePack'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'msgpack',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mssql_', 'MSSQL_', 'SQL'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mssql',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mysql_', 'MYSQL_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mysql',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('mysqli_', 'MYSQLI_', 'mysqli'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'mysqli',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('OAuth', 'oauth_', 'OAUTH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'OAuth',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('odbc_', 'ODBC_', 'SQL_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'odbc',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('openssl_', 'OPENSSL_', 'PKCS7_', 'X509_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'openssl',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array(
                    'pcntl_', 'BUS_', 'CLD_', 'FPE_', 'ILL_', 'PCNTL_', 'POLL_',
                    'PRIO_', 'SEGV_', 'SIG', 'SI_', 'TRAP_', 'WNOHANG', 'WUNTRACED'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pcntl',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('preg_', 'PCRE_', 'PREG_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pcre',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('PDFlib', 'pdf_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'PDFlib',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('PDO', 'pdo_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'PDO',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('pg_', 'PGSQL_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pgsql',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'Phar',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Phar',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('posix_', 'POSIX_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'posix',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array(
                    'Cond', 'Mutex', 'Stackable', 'Thread', 'Worker', 'PTHREADS_'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'pthreads',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Rar', 'rar_', 'RAR_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'rar',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('readline', 'READLINE_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'readline',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'recode',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'recode',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Reflection', 'Reflector'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Reflection',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Session', 'session_', 'PHP_SESSION_', 'SID'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'session',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'shmop_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'shmop',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('SimpleXML', 'simplexml_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SimpleXML',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('SNMP', 'snmp'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'snmp',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array(
                    'Soap', 'SOAP_', 'WSDL_', 'XSD_',
                    'APACHE_MAP', 'UNKNOWN_TYPE'
                ),
                'suffixes'  => FALSE,
                'contains'  => '_soap_',
                'extension' => 'soap',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
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
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Solr', 'solr_', 'SOLR_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'solr',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Sphinx', 'SEARCHD_', 'SPH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sphinx',
            ),
            array(
                'matches'   => array(
                    '^[A-Za-z]+(Exception|Iterator)$'
                ),
                'excludes'  => array('ErrorException', 'Exception'),
                'prefixes'  => array(
                    'Spl', 'Countable',
                    'ArrayObject',
                    'spl_', 'iterator_',
                    'class_implements', 'class_parents', 'class_uses'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SPL',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('SQLite', 'sqlite_', 'SQLITE_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SQLite',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('SQLite3', 'SQLITE3_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'SQLite3',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('ssh2_', 'SSH2_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'ssh2',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('stomp_', 'Stomp'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'stomp',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('svn_', 'Svn', 'SVN_', 'PHP_SVN_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'svn',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('msg_', 'MSG_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sysvmsg',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'sem_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sysvsem',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'shm_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'sysvshm',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('tidy_', 'TIDY_', 'tidy', 'ob_tidy'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'tidy',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('token_', 'T_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'tokenizer',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'uploadprogress_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'uploadprogress',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('Varnish', 'VARNISH_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'varnish',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'wddx_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'wddx',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('xcache_', 'XCACHE_', 'XC_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'XCache',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('xdebug_', 'XDEBUG_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xdebug',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('xhprof_', 'XHPROF_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xhprof',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('xml_', 'utf8_', 'XML_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xml',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'XMLReader',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xmlreader',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'xmlrpc_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xmlrpc',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('XMLWriter', 'xmlwriter_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xmlwriter',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('XSLT', 'XSL_', 'LIBEXSLT_', 'LIBXSLT_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'xsl',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('yaml_', 'YAML_'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'yaml',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => 'opcache_',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Zend OPcache',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array('zip_', 'Zip'),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'zip',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => array(
                    'gz', 'zlib_', 'ob_gz', 'readgz', 'FORCE_', 'ZLIB_'
                ),
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'zlib',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
                'prefixes'  => '*',
                'suffixes'  => FALSE,
                'contains'  => FALSE,
                'extension' => 'Core',
            ),
            array(
                'matches'   => FALSE,
                'excludes'  => FALSE,
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
                //error_log(sprintf("Matching element '%s', no result", $element));
                return FALSE;
            }
            //error_log(sprintf("Matching element '%s', give extension '%s'", $element, $extension));
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
            if (isset($rule['matches']) && empty($rule['matches'])
                && isset($rule['prefixes']) && empty($rule['prefixes'])
                && isset($rule['suffixes']) && empty($rule['suffixes'])
                && isset($rule['contains']) && empty($rule['contains'])
            ) {
                continue;  // skip the empty rule
            }

            if (!$found && !empty($rule['matches'])) {
                if (!is_array($rule['matches'])) {
                    $rule['matches'] = array( $rule['matches'] );
                }
                if (!empty($rule['excludes']) && !is_array($rule['excludes'])) {
                    $rule['excludes'] = array( $rule['excludes'] );
                }

                if (is_array($rule['excludes']) && in_array($name, $rule['excludes'])) {
                    // matches rules won't be applied for this element $name
                } else {
                    foreach( $rule['matches'] as $pattern ) {
                        if (preg_match("/$pattern/", $name) === 1) {
                            // the reference element name match the pattern
                            $found = TRUE;
                            break 2;
                        }
                    }
                }
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
