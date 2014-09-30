<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MbstringExtension extends AbstractReference
{
    const REF_NAME    = 'mbstring';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.6
        if (version_compare($version, '4.0.6', 'ge')) {
            $release = $this->getR40006();
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

        // 4.4.3
        if (version_compare($version, '4.4.3', 'ge')) {
            $release = $this->getR40403();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.2
        if (version_compare($version, '5.1.2', 'ge')) {
            $release = $this->getR50102();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
        
        // 5.2.0
        if (version_compare($version, '5.2.0', 'ge')) {
            $release = $this->getR50200();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.1
        if (version_compare($version, '5.4.1', 'ge')) {
            $release = $this->getR50401();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
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
        $release->iniEntries = array(
            'mbstring.detect_order'                 => null,
            'mbstring.http_input'                   => null,
            'mbstring.http_output'                  => null,
            'mbstring.http_output_conv_mimetypes'   => null,
            'mbstring.internal_encoding'            => null,
            'mbstring.substitute_character'         => null,
        );
        $release->constants = array(
            'MB_CASE_LOWER'                         => null,
            'MB_CASE_TITLE'                         => null,
            'MB_CASE_UPPER'                         => null,
            'MB_OVERLOAD_MAIL'                      => null,
            'MB_OVERLOAD_REGEX'                     => null,
            'MB_OVERLOAD_STRING'                    => null,
        );
        $release->functions = array(
            'mb_convert_encoding'                   => null,
            'mb_convert_kana'                       => null,
            'mb_convert_variables'                  => null,
            'mb_decode_mimeheader'                  => null,
            'mb_decode_numericentity'               => null,
            'mb_detect_encoding'                    => null,
            'mb_detect_order'                       => null,
            'mb_encode_mimeheader'                  => null,
            'mb_encode_numericentity'               => null,
            'mb_http_input'                         => null,
            'mb_http_output'                        => null,
            'mb_internal_encoding'                  => null,
            'mb_language'                           => null,
            'mb_output_handler'                     => null,
            'mb_parse_str'                          => null,
            'mb_preferred_mime_name'                => null,
            'mb_send_mail'                          => null,
            'mb_strcut'                             => null,
            'mb_strimwidth'                         => null,
            'mb_strlen'                             => null,
            'mb_strpos'                             => null,
            'mb_strrpos'                            => null,
            'mb_strwidth'                           => null,
            'mb_substitute_character'               => null,
            'mb_substr'                             => null,
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
        $release->iniEntries = array(
            'mbstring.func_overload'        => null,
        );
        $release->functions = array(
            'mb_ereg'                       => null,
            'mb_ereg_match'                 => null,
            'mb_ereg_replace'               => null,
            'mb_ereg_search'                => null,
            'mb_ereg_search_getpos'         => null,
            'mb_ereg_search_getregs'        => null,
            'mb_ereg_search_init'           => null,
            'mb_ereg_search_pos'            => null,
            'mb_ereg_search_regs'           => null,
            'mb_ereg_search_setpos'         => null,
            'mb_eregi'                      => null,
            'mb_eregi_replace'              => null,
            'mb_get_info'                   => null,
            'mb_regex_encoding'             => null,
            'mb_split'                      => null,
            'mbereg'                        => null,
            'mbereg_match'                  => null,
            'mbereg_replace'                => null,
            'mbereg_search'                 => null,
            'mbereg_search_getpos'          => null,
            'mbereg_search_getregs'         => null,
            'mbereg_search_init'            => null,
            'mbereg_search_pos'             => null,
            'mbereg_search_regs'            => null,
            'mbereg_search_setpos'          => null,
            'mberegi'                       => null,
            'mberegi_replace'               => null,
            'mbregex_encoding'              => null,
            'mbsplit'                       => null,
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
            'mbstring.encoding_translation' => null,
            'mbstring.language'             => null,
        );
        $release->functions = array(
            'mb_convert_case'               => null,
            'mb_regex_set_options'          => null,
            'mb_strtolower'                 => null,
            'mb_strtoupper'                 => null,
            'mb_substr_count'               => null,
        );
        return $release;
    }

    protected function getR40403()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.4.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-08-03',
            'php.min' => '4.4.3',
            'php.max' => '',
        );
        $release->functions = array(
            'mb_check_encoding'             => null,
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
            'mb_list_encodings'             => null,
        );
        return $release;
    }

    protected function getR50102()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-01-12',
            'php.min' => '5.1.2',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mbstring.strict_detection'     => null,
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
            'mb_stripos'                    => null,
            'mb_stristr'                    => null,
            'mb_strrchr'                    => null,
            'mb_strrichr'                   => null,
            'mb_strripos'                   => null,
            'mb_strstr'                     => null,
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
            'mb_encoding_aliases'           => null,
        );
        return $release;
    }

    protected function getR50401()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-04-26',
            'php.min' => '5.4.1',
            'php.max' => '',
        );
        $release->functions = array(
            'mb_ereg_replace_callback'      => null,
        );
        return $release;
    }
}
