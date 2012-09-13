<?php
/**
 * Version informations about imap extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about imap extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.imap.php
 */
class PHP_CompatInfo_Reference_Imap
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'imap';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

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
     * Gets informations about functions
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.imap.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'imap_8bit'                 => array('4.0.0', ''),
            'imap_alerts'               => array('4.0.0', ''),
            'imap_append'               => array('4.0.0', ''),
            'imap_base64'               => array('4.0.0', ''),
            'imap_binary'               => array('4.0.0', ''),
            'imap_body'                 => array('4.0.0', ''),
            'imap_bodystruct'           => array('4.0.0', ''),
            'imap_check'                => array('4.0.0', ''),
            'imap_clearflag_full'       => array('4.0.0', ''),
            'imap_close'                => array('4.0.0', ''),
            'imap_create'               => array('4.0.0', ''),
            'imap_createmailbox'        => array('4.0.0', ''),
            'imap_delete'               => array('4.0.0', ''),
            'imap_deletemailbox'        => array('4.0.0', ''),
            'imap_errors'               => array('4.0.0', ''),
            'imap_expunge'              => array('4.0.0', ''),
            'imap_fetch_overview'       => array('4.0.0', ''),
            'imap_fetchbody'            => array('4.0.0', ''),
            'imap_fetchheader'          => array('4.0.0', ''),
            'imap_fetchmime'            => array('5.3.6', ''),
            'imap_fetchstructure'       => array('4.0.0', ''),
            'imap_fetchtext'            => array('4.0.0', ''),
            'imap_gc'                   => array('5.3.0', ''),
            'imap_get_quota'            => array('4.0.5', ''),
            'imap_get_quotaroot'        => array('4.3.0', ''),
            'imap_getacl'               => array('5.0.0', ''),
            'imap_getmailboxes'         => array('4.0.0', ''),
            'imap_getsubscribed'        => array('4.0.0', ''),
            'imap_header'               => array('4.0.0', ''),
            'imap_headerinfo'           => array('4.0.0', ''),
            'imap_headers'              => array('4.0.0', ''),
            'imap_last_error'           => array('4.0.0', ''),
            'imap_list'                 => array('4.0.0', ''),
            'imap_listmailbox'          => array('4.0.0', ''),
            'imap_listscan'             => array('4.0.0', ''),
            'imap_listsubscribed'       => array('4.0.0', ''),
            'imap_lsub'                 => array('4.0.0', ''),
            'imap_mail'                 => array('4.0.0', ''),
            'imap_mail_compose'         => array('4.0.0', ''),
            'imap_mail_copy'            => array('4.0.0', ''),
            'imap_mail_move'            => array('4.0.0', ''),
            'imap_mailboxmsginfo'       => array('4.0.0', ''),
            'imap_mime_header_decode'   => array('4.0.0', ''),
            'imap_msgno'                => array('4.0.0', ''),
            'imap_mutf7_to_utf8'        => array('5.3.0', ''),
            'imap_num_msg'              => array('4.0.0', ''),
            'imap_num_recent'           => array('4.0.0', ''),
            'imap_open'                 => array('4.0.0', ''),
            'imap_ping'                 => array('4.0.0', ''),
            'imap_qprint'               => array('4.0.0', ''),
            'imap_rename'               => array('4.0.0', ''),
            'imap_renamemailbox'        => array('4.0.0', ''),
            'imap_reopen'               => array('4.0.0', ''),
            'imap_rfc822_parse_adrlist' => array('4.0.0', ''),
            'imap_rfc822_parse_headers' => array('4.0.0', ''),
            'imap_rfc822_write_address' => array('4.0.0', ''),
            'imap_savebody'             => array('5.1.3', ''),
            'imap_scan'                 => array('4.0.0', ''),
            'imap_scanmailbox'          => array('4.0.0', ''),
            'imap_search'               => array('4.0.0', ''),
            'imap_set_quota'            => array('4.0.5', ''),
            'imap_setacl'               => array('4.0.7', ''),
            'imap_setflag_full'         => array('4.0.0', ''),
            'imap_sort'                 => array('4.0.0', ''),
            'imap_status'               => array('4.0.0', ''),
            'imap_subscribe'            => array('4.0.0', ''),
            'imap_thread'               => array('4.0.7', ''),
            'imap_timeout'              => array('4.3.3', ''),
            'imap_uid'                  => array('4.0.0', ''),
            'imap_undelete'             => array('4.0.0', ''),
            'imap_unsubscribe'          => array('4.0.0', ''),
            'imap_utf7_decode'          => array('4.0.0', ''),
            'imap_utf7_encode'          => array('4.0.0', ''),
            'imap_utf8'                 => array('4.0.0', ''),
            'imap_utf8_to_mutf7'        => array('5.3.0', ''),
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
     * @link   http://www.php.net/manual/en/imap.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'CL_EXPUNGE'                => array('4.0.0', ''),
            'CP_MOVE'                   => array('4.0.0', ''),
            'CP_UID'                    => array('4.0.0', ''),
            'ENC7BIT'                   => array('4.0.0', ''),
            'ENC8BIT'                   => array('4.0.0', ''),
            'ENCBASE64'                 => array('4.0.0', ''),
            'ENCBINARY'                 => array('4.0.0', ''),
            'ENCOTHER'                  => array('4.0.0', ''),
            'ENCQUOTEDPRINTABLE'        => array('4.0.0', ''),
            'FT_INTERNAL'               => array('4.0.0', ''),
            'FT_NOT'                    => array('4.0.0', ''),
            'FT_PEEK'                   => array('4.0.0', ''),
            'FT_PREFETCHTEXT'           => array('4.0.0', ''),
            'FT_UID'                    => array('4.0.0', ''),
            'IMAP_CLOSETIMEOUT'         => array('4.0.0', ''),
            'IMAP_GC_ELT'               => array('5.3.0', ''),
            'IMAP_GC_ENV'               => array('5.3.0', ''),
            'IMAP_GC_TEXTS'             => array('5.3.0', ''),
            'IMAP_OPENTIMEOUT'          => array('4.0.0', ''),
            'IMAP_READTIMEOUT'          => array('4.0.0', ''),
            'IMAP_WRITETIMEOUT'         => array('4.0.0', ''),
            'LATT_HASCHILDREN'          => array('4.0.0', ''),
            'LATT_HASNOCHILDREN'        => array('4.0.0', ''),
            'LATT_MARKED'               => array('4.0.0', ''),
            'LATT_NOINFERIORS'          => array('4.0.0', ''),
            'LATT_NOSELECT'             => array('4.0.0', ''),
            'LATT_REFERRAL'             => array('4.0.0', ''),
            'LATT_UNMARKED'             => array('4.0.0', ''),
            'NIL'                       => array('4.0.0', ''),
            'OP_ANONYMOUS'              => array('4.0.0', ''),
            'OP_DEBUG'                  => array('4.0.0', ''),
            'OP_EXPUNGE'                => array('4.0.0', ''),
            'OP_HALFOPEN'               => array('4.0.0', ''),
            'OP_PROTOTYPE'              => array('4.0.0', ''),
            'OP_READONLY'               => array('4.0.0', ''),
            'OP_SECURE'                 => array('4.0.0', ''),
            'OP_SHORTCACHE'             => array('4.0.0', ''),
            'OP_SILENT'                 => array('4.0.0', ''),
            'SA_ALL'                    => array('4.0.0', ''),
            'SA_MESSAGES'               => array('4.0.0', ''),
            'SA_RECENT'                 => array('4.0.0', ''),
            'SA_UIDNEXT'                => array('4.0.0', ''),
            'SA_UIDVALIDITY'            => array('4.0.0', ''),
            'SA_UNSEEN'                 => array('4.0.0', ''),
            'SE_FREE'                   => array('4.0.0', ''),
            'SE_NOPREFETCH'             => array('4.0.0', ''),
            'SE_UID'                    => array('4.0.0', ''),
            'SORTARRIVAL'               => array('4.0.0', ''),
            'SORTCC'                    => array('4.0.0', ''),
            'SORTDATE'                  => array('4.0.0', ''),
            'SORTFROM'                  => array('4.0.0', ''),
            'SORTSIZE'                  => array('4.0.0', ''),
            'SORTSUBJECT'               => array('4.0.0', ''),
            'SORTTO'                    => array('4.0.0', ''),
            'SO_FREE'                   => array('4.0.0', ''),
            'SO_NOSERVER'               => array('4.0.0', ''),
            'ST_SET'                    => array('4.0.0', ''),
            'ST_SILENT'                 => array('4.0.0', ''),
            'ST_UID'                    => array('4.0.0', ''),
            'TYPEAPPLICATION'           => array('4.0.0', ''),
            'TYPEAUDIO'                 => array('4.0.0', ''),
            'TYPEIMAGE'                 => array('4.0.0', ''),
            'TYPEMESSAGE'               => array('4.0.0', ''),
            'TYPEMODEL'                 => array('4.0.0', ''),
            'TYPEMULTIPART'             => array('4.0.0', ''),
            'TYPEOTHER'                 => array('4.0.0', ''),
            'TYPETEXT'                  => array('4.0.0', ''),
            'TYPEVIDEO'                 => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
