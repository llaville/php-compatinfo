<?php
/**
 * Version informations about tidy extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about tidy extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.tidy.php
 */
class PHP_CompatInfo_Reference_Tidy implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'tidy' => array('4.0.0', '', '2.0')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/class.tidy.php
     * @link   http://www.php.net/manual/en/class.tidynode.php
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'tidy'                     => array('4.0.0', ''),
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                // All methods are 5.0.1, except getParent 5.2.0
                'tidyNode'                 => array('5.0.1', ''),
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.tidy.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                // PECL tidy >= 0.5.2 (PHP 4) or PHP >= 5.0.0
                'tidy_access_count'                 => array('4.0.0', ''),
                'tidy_config_count'                 => array('4.0.0', ''),
                'tidy_error_count'                  => array('4.0.0', ''),
                'tidy_get_error_buffer'             => array('4.0.0', ''),
                'tidy_get_output'                   => array('4.0.0', ''),
                'tidy_warning_count'                => array('4.0.0', ''),
                // PECL tidy only, removed in PHP 5.0.0
                'tidy_load_config'                  => array('4.0.0', '4.4.9'),
                'tidy_reset_config'                 => array('4.0.0', '4.4.9'),
                'tidy_save_config'                  => array('4.0.0', '4.4.9'),
                'tidy_set_encoding'                 => array('4.0.0', '4.4.9'),
                'tidy_setopt'                       => array('4.0.0', '4.4.9'),
                // Function eq to tidy class methods in Tidy 0.5.2
                'tidy_get_body'                     => array('4.0.0', ''),
                'tidy_clean_repair'                 => array('4.0.0', ''),
                'tidy_diagnose'                     => array('4.0.0', ''),
                'tidy_get_html_ver'                 => array('4.0.0', ''),
                'tidy_getopt'                       => array('4.0.0', ''),
                'tidy_get_release'                  => array('4.0.0', ''),
                'tidy_get_status'                   => array('4.0.0', ''),
                'tidy_get_head'                     => array('4.0.0', ''),
                'tidy_get_html'                     => array('4.0.0', ''),
                'tidy_is_xhtml'                     => array('4.0.0', ''),
                'tidy_is_xml'                       => array('4.0.0', ''),
                'tidy_parse_file'                   => array('4.0.0', ''),
                'tidy_parse_string'                 => array('4.0.0', ''),
                'tidy_get_root'                     => array('4.0.0', ''),
                // Function eq to tidy class methods in Tidy 0.7.0
                'tidy_get_config'                   => array('4.0.0', ''),
                'tidy_repair_file'                  => array('4.0.0', ''),
                'tidy_repair_string'                => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'ob_tidyhandler'                    => array('5.0.0', '5.3.14'),
                // Function eq to tidy class method
                'tidy_get_opt_doc'                  => array('5.1.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/tidy.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'TIDY_TAG_UNKNOWN'                  => array('4.0.0', ''),
                'TIDY_TAG_A'                        => array('4.0.0', ''),
                'TIDY_TAG_ABBR'                     => array('4.0.0', ''),
                'TIDY_TAG_ACRONYM'                  => array('4.0.0', ''),
                'TIDY_TAG_ADDRESS'                  => array('4.0.0', ''),
                'TIDY_TAG_ALIGN'                    => array('4.0.0', ''),
                'TIDY_TAG_APPLET'                   => array('4.0.0', ''),
                'TIDY_TAG_AREA'                     => array('4.0.0', ''),
                'TIDY_TAG_B'                        => array('4.0.0', ''),
                'TIDY_TAG_BASE'                     => array('4.0.0', ''),
                'TIDY_TAG_BASEFONT'                 => array('4.0.0', ''),
                'TIDY_TAG_BDO'                      => array('4.0.0', ''),
                'TIDY_TAG_BGSOUND'                  => array('4.0.0', ''),
                'TIDY_TAG_BIG'                      => array('4.0.0', ''),
                'TIDY_TAG_BLINK'                    => array('4.0.0', ''),
                'TIDY_TAG_BLOCKQUOTE'               => array('4.0.0', ''),
                'TIDY_TAG_BODY'                     => array('4.0.0', ''),
                'TIDY_TAG_BR'                       => array('4.0.0', ''),
                'TIDY_TAG_BUTTON'                   => array('4.0.0', ''),
                'TIDY_TAG_CAPTION'                  => array('4.0.0', ''),
                'TIDY_TAG_CENTER'                   => array('4.0.0', ''),
                'TIDY_TAG_CITE'                     => array('4.0.0', ''),
                'TIDY_TAG_CODE'                     => array('4.0.0', ''),
                'TIDY_TAG_COL'                      => array('4.0.0', ''),
                'TIDY_TAG_COLGROUP'                 => array('4.0.0', ''),
                'TIDY_TAG_COMMENT'                  => array('4.0.0', ''),
                'TIDY_TAG_DD'                       => array('4.0.0', ''),
                'TIDY_TAG_DEL'                      => array('4.0.0', ''),
                'TIDY_TAG_DFN'                      => array('4.0.0', ''),
                'TIDY_TAG_DIR'                      => array('4.0.0', ''),
                'TIDY_TAG_DIV'                      => array('4.0.0', ''),
                'TIDY_TAG_DL'                       => array('4.0.0', ''),
                'TIDY_TAG_DT'                       => array('4.0.0', ''),
                'TIDY_TAG_EM'                       => array('4.0.0', ''),
                'TIDY_TAG_EMBED'                    => array('4.0.0', ''),
                'TIDY_TAG_FIELDSET'                 => array('4.0.0', ''),
                'TIDY_TAG_FONT'                     => array('4.0.0', ''),
                'TIDY_TAG_FORM'                     => array('4.0.0', ''),
                'TIDY_TAG_FRAME'                    => array('4.0.0', ''),
                'TIDY_TAG_FRAMESET'                 => array('4.0.0', ''),
                'TIDY_TAG_H1'                       => array('4.0.0', ''),
                'TIDY_TAG_H2'                       => array('4.0.0', ''),
                'TIDY_TAG_H3'                       => array('4.0.0', ''),
                'TIDY_TAG_H4'                       => array('4.0.0', ''),
                'TIDY_TAG_H5'                       => array('4.0.0', ''),
                'TIDY_TAG_H6'                       => array('4.0.0', ''),
                'TIDY_TAG_HEAD'                     => array('4.0.0', ''),
                'TIDY_TAG_HR'                       => array('4.0.0', ''),
                'TIDY_TAG_HTML'                     => array('4.0.0', ''),
                'TIDY_TAG_I'                        => array('4.0.0', ''),
                'TIDY_TAG_IFRAME'                   => array('4.0.0', ''),
                'TIDY_TAG_ILAYER'                   => array('4.0.0', ''),
                'TIDY_TAG_IMG'                      => array('4.0.0', ''),
                'TIDY_TAG_INPUT'                    => array('4.0.0', ''),
                'TIDY_TAG_INS'                      => array('4.0.0', ''),
                'TIDY_TAG_ISINDEX'                  => array('4.0.0', ''),
                'TIDY_TAG_KBD'                      => array('4.0.0', ''),
                'TIDY_TAG_KEYGEN'                   => array('4.0.0', ''),
                'TIDY_TAG_LABEL'                    => array('4.0.0', ''),
                'TIDY_TAG_LAYER'                    => array('4.0.0', ''),
                'TIDY_TAG_LEGEND'                   => array('4.0.0', ''),
                'TIDY_TAG_LI'                       => array('4.0.0', ''),
                'TIDY_TAG_LINK'                     => array('4.0.0', ''),
                'TIDY_TAG_LISTING'                  => array('4.0.0', ''),
                'TIDY_TAG_MAP'                      => array('4.0.0', ''),
                'TIDY_TAG_MARQUEE'                  => array('4.0.0', ''),
                'TIDY_TAG_MENU'                     => array('4.0.0', ''),
                'TIDY_TAG_META'                     => array('4.0.0', ''),
                'TIDY_TAG_MULTICOL'                 => array('4.0.0', ''),
                'TIDY_TAG_NOBR'                     => array('4.0.0', ''),
                'TIDY_TAG_NOEMBED'                  => array('4.0.0', ''),
                'TIDY_TAG_NOFRAMES'                 => array('4.0.0', ''),
                'TIDY_TAG_NOLAYER'                  => array('4.0.0', ''),
                'TIDY_TAG_NOSAVE'                   => array('4.0.0', ''),
                'TIDY_TAG_NOSCRIPT'                 => array('4.0.0', ''),
                'TIDY_TAG_OBJECT'                   => array('4.0.0', ''),
                'TIDY_TAG_OL'                       => array('4.0.0', ''),
                'TIDY_TAG_OPTGROUP'                 => array('4.0.0', ''),
                'TIDY_TAG_OPTION'                   => array('4.0.0', ''),
                'TIDY_TAG_P'                        => array('4.0.0', ''),
                'TIDY_TAG_PARAM'                    => array('4.0.0', ''),
                'TIDY_TAG_PLAINTEXT'                => array('4.0.0', ''),
                'TIDY_TAG_PRE'                      => array('4.0.0', ''),
                'TIDY_TAG_Q'                        => array('4.0.0', ''),
                'TIDY_TAG_RB'                       => array('4.0.0', ''),
                'TIDY_TAG_RBC'                      => array('4.0.0', ''),
                'TIDY_TAG_RP'                       => array('4.0.0', ''),
                'TIDY_TAG_RT'                       => array('4.0.0', ''),
                'TIDY_TAG_RTC'                      => array('4.0.0', ''),
                'TIDY_TAG_RUBY'                     => array('4.0.0', ''),
                'TIDY_TAG_S'                        => array('4.0.0', ''),
                'TIDY_TAG_SAMP'                     => array('4.0.0', ''),
                'TIDY_TAG_SCRIPT'                   => array('4.0.0', ''),
                'TIDY_TAG_SELECT'                   => array('4.0.0', ''),
                'TIDY_TAG_SERVER'                   => array('4.0.0', ''),
                'TIDY_TAG_SERVLET'                  => array('4.0.0', ''),
                'TIDY_TAG_SMALL'                    => array('4.0.0', ''),
                'TIDY_TAG_SPACER'                   => array('4.0.0', ''),
                'TIDY_TAG_SPAN'                     => array('4.0.0', ''),
                'TIDY_TAG_STRIKE'                   => array('4.0.0', ''),
                'TIDY_TAG_STRONG'                   => array('4.0.0', ''),
                'TIDY_TAG_STYLE'                    => array('4.0.0', ''),
                'TIDY_TAG_SUB'                      => array('4.0.0', ''),
                'TIDY_TAG_SUP'                      => array('4.0.0', ''),
                'TIDY_TAG_TABLE'                    => array('4.0.0', ''),
                'TIDY_TAG_TBODY'                    => array('4.0.0', ''),
                'TIDY_TAG_TD'                       => array('4.0.0', ''),
                'TIDY_TAG_TEXTAREA'                 => array('4.0.0', ''),
                'TIDY_TAG_TFOOT'                    => array('4.0.0', ''),
                'TIDY_TAG_TH'                       => array('4.0.0', ''),
                'TIDY_TAG_THEAD'                    => array('4.0.0', ''),
                'TIDY_TAG_TITLE'                    => array('4.0.0', ''),
                'TIDY_TAG_TR'                       => array('4.0.0', ''),
                'TIDY_TAG_TT'                       => array('4.0.0', ''),
                'TIDY_TAG_U'                        => array('4.0.0', ''),
                'TIDY_TAG_UL'                       => array('4.0.0', ''),
                'TIDY_TAG_VAR'                      => array('4.0.0', ''),
                'TIDY_TAG_WBR'                      => array('4.0.0', ''),
                'TIDY_TAG_XMP'                      => array('4.0.0', ''),
                'TIDY_NODETYPE_ROOT'                => array('4.0.0', ''),
                'TIDY_NODETYPE_DOCTYPE'             => array('4.0.0', ''),
                'TIDY_NODETYPE_COMMENT'             => array('4.0.0', ''),
                'TIDY_NODETYPE_PROCINS'             => array('4.0.0', ''),
                'TIDY_NODETYPE_TEXT'                => array('4.0.0', ''),
                'TIDY_NODETYPE_START'               => array('4.0.0', ''),
                'TIDY_NODETYPE_END'                 => array('4.0.0', ''),
                'TIDY_NODETYPE_STARTEND'            => array('4.0.0', ''),
                'TIDY_NODETYPE_CDATA'               => array('4.0.0', ''),
                'TIDY_NODETYPE_SECTION'             => array('4.0.0', ''),
                'TIDY_NODETYPE_ASP'                 => array('4.0.0', ''),
                'TIDY_NODETYPE_JSTE'                => array('4.0.0', ''),
                'TIDY_NODETYPE_PHP'                 => array('4.0.0', ''),
                'TIDY_NODETYPE_XMLDECL'             => array('4.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
