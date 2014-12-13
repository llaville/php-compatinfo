<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class TidyExtension extends AbstractReference
{
    const REF_NAME    = 'tidy';
    const REF_VERSION = '2.0';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 0.5.2
        if (version_compare($version, '0.5.2', 'ge')) {
            $release = $this->getR00502();
            $this->storage->attach($release);
        }

        // 0.7.0
        if (version_compare($version, '0.7.0', 'ge')) {
            $release = $this->getR00700();
            $this->storage->attach($release);
        }

        // 2.0
        if (version_compare($version, '2.0', 'ge')) {
            $release = $this->getR20000();
            $this->storage->attach($release);
        }
    }

    protected function getR00502()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.5.2',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2003-08-06',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'tidy.default_config'               => null,
            'tidy.clean_output'                 => null,
        );
        $release->classes = array(
            'tidy'                              => null,
        );
        $release->functions = array(
            'tidy_access_count'                 => null,
            'tidy_clean_repair'                 => null,
            'tidy_config_count'                 => null,
            'tidy_create'                       => array('ext.max' => '0.5.3'),
            'tidy_diagnose'                     => null,
            'tidy_error_count'                  => null,
            'tidy_get_body'                     => null,
            'tidy_get_error_buffer'             => null,
            'tidy_get_head'                     => null,
            'tidy_get_html'                     => null,
            'tidy_get_html_ver'                 => null,
            'tidy_get_output'                   => null,
            'tidy_get_release'                  => null,
            'tidy_get_root'                     => null,
            'tidy_get_status'                   => null,
            'tidy_getopt'                       => null,
            'tidy_is_xhtml'                     => null,
            'tidy_is_xml'                       => null,
            'tidy_load_config'                  => array(
                'php.min' => '4.3.0',
                'php.max' => '4.4.9',
                'ext.max' => '1.2'
            ),
            'tidy_load_config_enc'              => array('ext.max' => '1.2'),
            'tidy_parse_file'                   => null,
            'tidy_parse_string'                 => null,
            'tidy_save_config'                  => array(
                'php.min' => '4.3.0',
                'php.max' => '4.4.9',
                'ext.max' => '1.2'
            ),
            'tidy_set_encoding'                 => array(
                'php.min' => '4.3.0',
                'php.max' => '4.4.9',
                'ext.max' => '1.2'
            ),
            'tidy_setopt'                       => array(
                'php.min' => '4.3.0',
                'php.max' => '4.4.9',
                'ext.max' => '1.2'
            ),
            'tidy_warning_count'                => null,
        );
        $release->constants = array(
            'TIDY_NODETYPE_ASP'                 => null,
            'TIDY_NODETYPE_CDATA'               => null,
            'TIDY_NODETYPE_COMMENT'             => null,
            'TIDY_NODETYPE_DOCTYPE'             => null,
            'TIDY_NODETYPE_END'                 => null,
            'TIDY_NODETYPE_JSTE'                => null,
            'TIDY_NODETYPE_PHP'                 => null,
            'TIDY_NODETYPE_PROCINS'             => null,
            'TIDY_NODETYPE_ROOT'                => null,
            'TIDY_NODETYPE_SECTION'             => null,
            'TIDY_NODETYPE_START'               => null,
            'TIDY_NODETYPE_STARTEND'            => null,
            'TIDY_NODETYPE_TEXT'                => null,
            'TIDY_NODETYPE_XMLDECL'             => null,

            'TIDY_TAG_A'                        => null,
            'TIDY_TAG_ABBR'                     => null,
            'TIDY_TAG_ACRONYM'                  => null,
            'TIDY_TAG_ADDRESS'                  => null,
            'TIDY_TAG_ALIGN'                    => null,
            'TIDY_TAG_APPLET'                   => null,
            'TIDY_TAG_AREA'                     => null,
            'TIDY_TAG_B'                        => null,
            'TIDY_TAG_BASE'                     => null,
            'TIDY_TAG_BASEFONT'                 => null,
            'TIDY_TAG_BDO'                      => null,
            'TIDY_TAG_BGSOUND'                  => null,
            'TIDY_TAG_BIG'                      => null,
            'TIDY_TAG_BLINK'                    => null,
            'TIDY_TAG_BLOCKQUOTE'               => null,
            'TIDY_TAG_BODY'                     => null,
            'TIDY_TAG_BR'                       => null,
            'TIDY_TAG_BUTTON'                   => null,
            'TIDY_TAG_CAPTION'                  => null,
            'TIDY_TAG_CENTER'                   => null,
            'TIDY_TAG_CITE'                     => null,
            'TIDY_TAG_CODE'                     => null,
            'TIDY_TAG_COL'                      => null,
            'TIDY_TAG_COLGROUP'                 => null,
            'TIDY_TAG_COMMENT'                  => null,
            'TIDY_TAG_DD'                       => null,
            'TIDY_TAG_DEL'                      => null,
            'TIDY_TAG_DFN'                      => null,
            'TIDY_TAG_DIR'                      => null,
            'TIDY_TAG_DIV'                      => null,
            'TIDY_TAG_DL'                       => null,
            'TIDY_TAG_DT'                       => null,
            'TIDY_TAG_EM'                       => null,
            'TIDY_TAG_EMBED'                    => null,
            'TIDY_TAG_FIELDSET'                 => null,
            'TIDY_TAG_FONT'                     => null,
            'TIDY_TAG_FORM'                     => null,
            'TIDY_TAG_FRAME'                    => null,
            'TIDY_TAG_FRAMESET'                 => null,
            'TIDY_TAG_H1'                       => null,
            'TIDY_TAG_H2'                       => null,
            'TIDY_TAG_H3'                       => null,
            'TIDY_TAG_H4'                       => null,
            'TIDY_TAG_H5'                       => null,
            'TIDY_TAG_H6'                       => null,
            'TIDY_TAG_HEAD'                     => null,
            'TIDY_TAG_HR'                       => null,
            'TIDY_TAG_HTML'                     => null,
            'TIDY_TAG_I'                        => null,
            'TIDY_TAG_IFRAME'                   => null,
            'TIDY_TAG_ILAYER'                   => null,
            'TIDY_TAG_IMG'                      => null,
            'TIDY_TAG_INPUT'                    => null,
            'TIDY_TAG_INS'                      => null,
            'TIDY_TAG_ISINDEX'                  => null,
            'TIDY_TAG_KBD'                      => null,
            'TIDY_TAG_KEYGEN'                   => null,
            'TIDY_TAG_LABEL'                    => null,
            'TIDY_TAG_LAYER'                    => null,
            'TIDY_TAG_LEGEND'                   => null,
            'TIDY_TAG_LI'                       => null,
            'TIDY_TAG_LINK'                     => null,
            'TIDY_TAG_LISTING'                  => null,
            'TIDY_TAG_MAP'                      => null,
            'TIDY_TAG_MARQUEE'                  => null,
            'TIDY_TAG_MENU'                     => null,
            'TIDY_TAG_META'                     => null,
            'TIDY_TAG_MULTICOL'                 => null,
            'TIDY_TAG_NOBR'                     => null,
            'TIDY_TAG_NOEMBED'                  => null,
            'TIDY_TAG_NOFRAMES'                 => null,
            'TIDY_TAG_NOLAYER'                  => null,
            'TIDY_TAG_NOSAVE'                   => null,
            'TIDY_TAG_NOSCRIPT'                 => null,
            'TIDY_TAG_OBJECT'                   => null,
            'TIDY_TAG_OL'                       => null,
            'TIDY_TAG_OPTGROUP'                 => null,
            'TIDY_TAG_OPTION'                   => null,
            'TIDY_TAG_P'                        => null,
            'TIDY_TAG_PARAM'                    => null,
            'TIDY_TAG_PLAINTEXT'                => null,
            'TIDY_TAG_PRE'                      => null,
            'TIDY_TAG_Q'                        => null,
            'TIDY_TAG_RB'                       => null,
            'TIDY_TAG_RBC'                      => null,
            'TIDY_TAG_RP'                       => null,
            'TIDY_TAG_RT'                       => null,
            'TIDY_TAG_RTC'                      => null,
            'TIDY_TAG_RUBY'                     => null,
            'TIDY_TAG_S'                        => null,
            'TIDY_TAG_SAMP'                     => null,
            'TIDY_TAG_SCRIPT'                   => null,
            'TIDY_TAG_SELECT'                   => null,
            'TIDY_TAG_SERVER'                   => null,
            'TIDY_TAG_SERVLET'                  => null,
            'TIDY_TAG_SMALL'                    => null,
            'TIDY_TAG_SPACER'                   => null,
            'TIDY_TAG_SPAN'                     => null,
            'TIDY_TAG_STRIKE'                   => null,
            'TIDY_TAG_STRONG'                   => null,
            'TIDY_TAG_STYLE'                    => null,
            'TIDY_TAG_SUB'                      => null,
            'TIDY_TAG_SUP'                      => null,
            'TIDY_TAG_TABLE'                    => null,
            'TIDY_TAG_TBODY'                    => null,
            'TIDY_TAG_TD'                       => null,
            'TIDY_TAG_TEXTAREA'                 => null,
            'TIDY_TAG_TFOOT'                    => null,
            'TIDY_TAG_TH'                       => null,
            'TIDY_TAG_THEAD'                    => null,
            'TIDY_TAG_TITLE'                    => null,
            'TIDY_TAG_TR'                       => null,
            'TIDY_TAG_TT'                       => null,
            'TIDY_TAG_U'                        => null,
            'TIDY_TAG_UL'                       => null,
            'TIDY_TAG_UNKNOWN'                  => null,
            'TIDY_TAG_VAR'                      => null,
            'TIDY_TAG_WBR'                      => null,
            'TIDY_TAG_XMP'                      => null,
        );
        return $release;
    }

    protected function getR00700()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.7.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2003-09-22',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'tidyNode'                          => array('5.0.1', ''),
        );
        $release->functions = array(
            'tidy_repair_string'                => null,
            'tidy_repair_file'                  => null,
            'tidy_reset_config'                 => array('4.3.0', '4.4.9'),
            'tidy_get_config'                   => null,
        );
        return $release;
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0',
            'ext.max' => '',
            'state'   => '',
            'date'    => '',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'ob_tidyhandler'                    => array('5.0.0', self::LATEST_PHP_5_3),
            'tidy_get_opt_doc'                  => array('5.1.0', ''),
        );
        return $release;
    }
}
