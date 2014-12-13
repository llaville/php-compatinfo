<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ImapExtension extends AbstractReference
{
    const REF_NAME    = 'imap';
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

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $this->storage->attach($release);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
            $this->storage->attach($release);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $this->storage->attach($release);
        }

        // 4.3.3
        if (version_compare($version, '4.3.3', 'ge')) {
            $release = $this->getR40303();
            $this->storage->attach($release);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $this->storage->attach($release);
        }

        // 5.1.3
        if (version_compare($version, '5.1.3', 'ge')) {
            $release = $this->getR50103();
            $this->storage->attach($release);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $this->storage->attach($release);
        }

        // 5.3.6
        if (version_compare($version, '5.3.6', 'ge')) {
            $release = $this->getR50306();
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
        $release->constants = array(
            'CL_EXPUNGE'                => null,
            'CP_MOVE'                   => null,
            'CP_UID'                    => null,
            'ENC7BIT'                   => null,
            'ENC8BIT'                   => null,
            'ENCBASE64'                 => null,
            'ENCBINARY'                 => null,
            'ENCOTHER'                  => null,
            'ENCQUOTEDPRINTABLE'        => null,
            'FT_INTERNAL'               => null,
            'FT_NOT'                    => null,
            'FT_PEEK'                   => null,
            'FT_PREFETCHTEXT'           => null,
            'FT_UID'                    => null,
            'IMAP_CLOSETIMEOUT'         => null,
            'IMAP_OPENTIMEOUT'          => null,
            'IMAP_READTIMEOUT'          => null,
            'IMAP_WRITETIMEOUT'         => null,
            'LATT_HASCHILDREN'          => null,
            'LATT_HASNOCHILDREN'        => null,
            'LATT_MARKED'               => null,
            'LATT_NOINFERIORS'          => null,
            'LATT_NOSELECT'             => null,
            'LATT_REFERRAL'             => null,
            'LATT_UNMARKED'             => null,
            'NIL'                       => null,
            'OP_ANONYMOUS'              => null,
            'OP_DEBUG'                  => null,
            'OP_EXPUNGE'                => null,
            'OP_HALFOPEN'               => null,
            'OP_PROTOTYPE'              => null,
            'OP_READONLY'               => null,
            'OP_SECURE'                 => null,
            'OP_SHORTCACHE'             => null,
            'OP_SILENT'                 => null,
            'SA_ALL'                    => null,
            'SA_MESSAGES'               => null,
            'SA_RECENT'                 => null,
            'SA_UIDNEXT'                => null,
            'SA_UIDVALIDITY'            => null,
            'SA_UNSEEN'                 => null,
            'SE_FREE'                   => null,
            'SE_NOPREFETCH'             => null,
            'SE_UID'                    => null,
            'SORTARRIVAL'               => null,
            'SORTCC'                    => null,
            'SORTDATE'                  => null,
            'SORTFROM'                  => null,
            'SORTSIZE'                  => null,
            'SORTSUBJECT'               => null,
            'SORTTO'                    => null,
            'SO_FREE'                   => null,
            'SO_NOSERVER'               => null,
            'ST_SET'                    => null,
            'ST_SILENT'                 => null,
            'ST_UID'                    => null,
            'TYPEAPPLICATION'           => null,
            'TYPEAUDIO'                 => null,
            'TYPEIMAGE'                 => null,
            'TYPEMESSAGE'               => null,
            'TYPEMODEL'                 => null,
            'TYPEMULTIPART'             => null,
            'TYPEOTHER'                 => null,
            'TYPETEXT'                  => null,
            'TYPEVIDEO'                 => null,
        );
        $release->functions = array(
            'imap_8bit'                 => null,
            'imap_alerts'               => null,
            'imap_append'               => null,
            'imap_base64'               => null,
            'imap_binary'               => null,
            'imap_body'                 => null,
            'imap_bodystruct'           => null,
            'imap_check'                => null,
            'imap_clearflag_full'       => null,
            'imap_close'                => null,
            'imap_create'               => null,
            'imap_createmailbox'        => null,
            'imap_delete'               => null,
            'imap_deletemailbox'        => null,
            'imap_errors'               => null,
            'imap_expunge'              => null,
            'imap_fetch_overview'       => null,
            'imap_fetchbody'            => null,
            'imap_fetchheader'          => null,
            'imap_fetchstructure'       => null,
            'imap_fetchtext'            => null,
            'imap_getmailboxes'         => null,
            'imap_getsubscribed'        => null,
            'imap_header'               => null,
            'imap_headerinfo'           => null,
            'imap_headers'              => null,
            'imap_last_error'           => null,
            'imap_list'                 => null,
            'imap_listmailbox'          => null,
            'imap_listscan'             => null,
            'imap_listsubscribed'       => null,
            'imap_lsub'                 => null,
            'imap_mail'                 => null,
            'imap_mail_compose'         => null,
            'imap_mail_copy'            => null,
            'imap_mail_move'            => null,
            'imap_mailboxmsginfo'       => null,
            'imap_mime_header_decode'   => null,
            'imap_msgno'                => null,
            'imap_num_msg'              => null,
            'imap_num_recent'           => null,
            'imap_open'                 => null,
            'imap_ping'                 => null,
            'imap_qprint'               => null,
            'imap_rename'               => null,
            'imap_renamemailbox'        => null,
            'imap_reopen'               => null,
            'imap_rfc822_parse_adrlist' => null,
            'imap_rfc822_parse_headers' => null,
            'imap_rfc822_write_address' => null,
            'imap_scan'                 => null,
            'imap_scanmailbox'          => null,
            'imap_search'               => null,
            'imap_setflag_full'         => null,
            'imap_sort'                 => null,
            'imap_status'               => null,
            'imap_subscribe'            => null,
            'imap_uid'                  => null,
            'imap_undelete'             => null,
            'imap_unsubscribe'          => null,
            'imap_utf7_decode'          => null,
            'imap_utf7_encode'          => null,
            'imap_utf8'                 => null,
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
            'imap_get_quota'            => null,
            'imap_set_quota'            => null,
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
            'imap_setacl'               => null,
            'imap_thread'               => null,
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
            'imap_get_quotaroot'        => null,
        );
        return $release;
    }

    protected function getR40303()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-08-25',
            'php.min' => '4.3.3',
            'php.max' => '',
        );
        $release->functions = array(
            'imap_timeout'              => null,
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
            'imap_getacl'               => null,
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
            'imap_savebody'             => null,
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
            'IMAP_GC_ELT'               => null,
            'IMAP_GC_ENV'               => null,
            'IMAP_GC_TEXTS'             => null,
        );
        $release->functions = array(
            'imap_gc'                   => null,
            'imap_mutf7_to_utf8'        => null,
            'imap_utf8_to_mutf7'        => null,
        );
        return $release;
    }

    protected function getR50306()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-03-17',
            'php.min' => '5.3.6',
            'php.max' => '',
        );
        $release->functions = array(
            'imap_fetchmime'            => null,
        );
        return $release;
    }
}
