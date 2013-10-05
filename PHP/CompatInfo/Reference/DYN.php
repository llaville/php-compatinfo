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
