<?php
/**
 * Version informations about tidy extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about tidy extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.tidy.php
 */
class PHP_CompatInfo_Reference_Tidy
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'tidy';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '2.0';

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
        $extver = phpversion(self::REF_NAME);
        if ($extver === false) {
            $extver = self::REF_VERSION;
        }
        /*
           Since version 2.0
           Support for PHP versions lower than PHP 5.0 have been dropped
         */
        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.0.0';
        } else {
            $version1 = $extver;
            $version2 = '2.0';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '4.3.0' : '5.0.0';
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
     * @link   http://www.php.net/manual/en/class.tidy.php
     * @link   http://www.php.net/manual/en/class.tidynode.php
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '0.5.2';       // 2003-08-06
        $items = array(
            'tidy'                     => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '0.7.0';       // 2003-09-22
        $items = array(
            'tidyNode'                 => array('5.0.1', ''),
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
     * @link   http://www.php.net/manual/en/ref.tidy.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.5.2';       // 2003-08-06
        $items = array(
            'tidy_access_count'                 => array('4.3.0', ''),
            'tidy_clean_repair'                 => array('4.3.0', ''),
            'tidy_config_count'                 => array('4.3.0', ''),
            'tidy_create'                       => array('4.3.0', ''),
            'tidy_diagnose'                     => array('4.3.0', ''),
            'tidy_error_count'                  => array('4.3.0', ''),
            'tidy_get_body'                     => array('4.3.0', ''),
            'tidy_get_error_buffer'             => array('4.3.0', ''),
            'tidy_get_head'                     => array('4.3.0', ''),
            'tidy_get_html'                     => array('4.3.0', ''),
            'tidy_get_html_ver'                 => array('4.3.0', ''),
            'tidy_get_output'                   => array('4.3.0', ''),
            'tidy_get_release'                  => array('4.3.0', ''),
            'tidy_get_root'                     => array('4.3.0', ''),
            'tidy_get_status'                   => array('4.3.0', ''),
            'tidy_getopt'                       => array('4.3.0', ''),
            'tidy_is_xhtml'                     => array('4.3.0', ''),
            'tidy_is_xml'                       => array('4.3.0', ''),
            'tidy_load_config'                  => array('4.3.0', '4.4.9'),
            'tidy_load_config_enc'              => array('4.3.0', ''),
            'tidy_parse_file'                   => array('4.3.0', ''),
            'tidy_parse_string'                 => array('4.3.0', ''),
            'tidy_save_config'                  => array('4.3.0', '4.4.9'),
            'tidy_set_encoding'                 => array('4.3.0', '4.4.9'),
            'tidy_setopt'                       => array('4.3.0', '4.4.9'),
            'tidy_warning_count'                => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);
        // removed functions
        $this->setMaxExtensionVersion(
            '0.5.3', 'tidy_create', $functions
        );
        // PECL tidy only, removed in PHP 5.0.0 (tidy 2.0)
        $this->setMaxExtensionVersion(
            '1.2', 'tidy_setopt', $functions
        );
        $this->setMaxExtensionVersion(
            '1.2', 'tidy_load_config', $functions
        );
        $this->setMaxExtensionVersion(
            '1.2', 'tidy_save_config', $functions
        );
        $this->setMaxExtensionVersion(
            '1.2', 'tidy_set_encoding', $functions
        );
        $this->setMaxExtensionVersion(
            '1.2', 'tidy_load_config_enc', $functions
        );

        $release = '0.7.0';       // 2003-09-22
        $items = array(
            'tidy_repair_string'                => array('4.3.0', ''),
            'tidy_repair_file'                  => array('4.3.0', ''),
            'tidy_reset_config'                 => array('4.3.0', '4.4.9'),
            'tidy_get_config'                   => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0';         //
        $items = array(
            'ob_tidyhandler'                    => array('5.0.0', '5.3.17'),
            'tidy_get_opt_doc'                  => array('5.1.0', ''),
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
     * @link   http://www.php.net/manual/en/tidy.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.5.2';       // 2003-08-06
        $items = array(
            'TIDY_NODETYPE_ASP'                 => array('4.3.0', ''),
            'TIDY_NODETYPE_CDATA'               => array('4.3.0', ''),
            'TIDY_NODETYPE_COMMENT'             => array('4.3.0', ''),
            'TIDY_NODETYPE_DOCTYPE'             => array('4.3.0', ''),
            'TIDY_NODETYPE_END'                 => array('4.3.0', ''),
            'TIDY_NODETYPE_JSTE'                => array('4.3.0', ''),
            'TIDY_NODETYPE_PHP'                 => array('4.3.0', ''),
            'TIDY_NODETYPE_PROCINS'             => array('4.3.0', ''),
            'TIDY_NODETYPE_ROOT'                => array('4.3.0', ''),
            'TIDY_NODETYPE_SECTION'             => array('4.3.0', ''),
            'TIDY_NODETYPE_START'               => array('4.3.0', ''),
            'TIDY_NODETYPE_STARTEND'            => array('4.3.0', ''),
            'TIDY_NODETYPE_TEXT'                => array('4.3.0', ''),
            'TIDY_NODETYPE_XMLDECL'             => array('4.3.0', ''),

            'TIDY_TAG_A'                        => array('4.3.0', ''),
            'TIDY_TAG_ABBR'                     => array('4.3.0', ''),
            'TIDY_TAG_ACRONYM'                  => array('4.3.0', ''),
            'TIDY_TAG_ADDRESS'                  => array('4.3.0', ''),
            'TIDY_TAG_ALIGN'                    => array('4.3.0', ''),
            'TIDY_TAG_APPLET'                   => array('4.3.0', ''),
            'TIDY_TAG_AREA'                     => array('4.3.0', ''),
            'TIDY_TAG_B'                        => array('4.3.0', ''),
            'TIDY_TAG_BASE'                     => array('4.3.0', ''),
            'TIDY_TAG_BASEFONT'                 => array('4.3.0', ''),
            'TIDY_TAG_BDO'                      => array('4.3.0', ''),
            'TIDY_TAG_BGSOUND'                  => array('4.3.0', ''),
            'TIDY_TAG_BIG'                      => array('4.3.0', ''),
            'TIDY_TAG_BLINK'                    => array('4.3.0', ''),
            'TIDY_TAG_BLOCKQUOTE'               => array('4.3.0', ''),
            'TIDY_TAG_BODY'                     => array('4.3.0', ''),
            'TIDY_TAG_BR'                       => array('4.3.0', ''),
            'TIDY_TAG_BUTTON'                   => array('4.3.0', ''),
            'TIDY_TAG_CAPTION'                  => array('4.3.0', ''),
            'TIDY_TAG_CENTER'                   => array('4.3.0', ''),
            'TIDY_TAG_CITE'                     => array('4.3.0', ''),
            'TIDY_TAG_CODE'                     => array('4.3.0', ''),
            'TIDY_TAG_COL'                      => array('4.3.0', ''),
            'TIDY_TAG_COLGROUP'                 => array('4.3.0', ''),
            'TIDY_TAG_COMMENT'                  => array('4.3.0', ''),
            'TIDY_TAG_DD'                       => array('4.3.0', ''),
            'TIDY_TAG_DEL'                      => array('4.3.0', ''),
            'TIDY_TAG_DFN'                      => array('4.3.0', ''),
            'TIDY_TAG_DIR'                      => array('4.3.0', ''),
            'TIDY_TAG_DIV'                      => array('4.3.0', ''),
            'TIDY_TAG_DL'                       => array('4.3.0', ''),
            'TIDY_TAG_DT'                       => array('4.3.0', ''),
            'TIDY_TAG_EM'                       => array('4.3.0', ''),
            'TIDY_TAG_EMBED'                    => array('4.3.0', ''),
            'TIDY_TAG_FIELDSET'                 => array('4.3.0', ''),
            'TIDY_TAG_FONT'                     => array('4.3.0', ''),
            'TIDY_TAG_FORM'                     => array('4.3.0', ''),
            'TIDY_TAG_FRAME'                    => array('4.3.0', ''),
            'TIDY_TAG_FRAMESET'                 => array('4.3.0', ''),
            'TIDY_TAG_H1'                       => array('4.3.0', ''),
            'TIDY_TAG_H2'                       => array('4.3.0', ''),
            'TIDY_TAG_H3'                       => array('4.3.0', ''),
            'TIDY_TAG_H4'                       => array('4.3.0', ''),
            'TIDY_TAG_H5'                       => array('4.3.0', ''),
            'TIDY_TAG_H6'                       => array('4.3.0', ''),
            'TIDY_TAG_HEAD'                     => array('4.3.0', ''),
            'TIDY_TAG_HR'                       => array('4.3.0', ''),
            'TIDY_TAG_HTML'                     => array('4.3.0', ''),
            'TIDY_TAG_I'                        => array('4.3.0', ''),
            'TIDY_TAG_IFRAME'                   => array('4.3.0', ''),
            'TIDY_TAG_ILAYER'                   => array('4.3.0', ''),
            'TIDY_TAG_IMG'                      => array('4.3.0', ''),
            'TIDY_TAG_INPUT'                    => array('4.3.0', ''),
            'TIDY_TAG_INS'                      => array('4.3.0', ''),
            'TIDY_TAG_ISINDEX'                  => array('4.3.0', ''),
            'TIDY_TAG_KBD'                      => array('4.3.0', ''),
            'TIDY_TAG_KEYGEN'                   => array('4.3.0', ''),
            'TIDY_TAG_LABEL'                    => array('4.3.0', ''),
            'TIDY_TAG_LAYER'                    => array('4.3.0', ''),
            'TIDY_TAG_LEGEND'                   => array('4.3.0', ''),
            'TIDY_TAG_LI'                       => array('4.3.0', ''),
            'TIDY_TAG_LINK'                     => array('4.3.0', ''),
            'TIDY_TAG_LISTING'                  => array('4.3.0', ''),
            'TIDY_TAG_MAP'                      => array('4.3.0', ''),
            'TIDY_TAG_MARQUEE'                  => array('4.3.0', ''),
            'TIDY_TAG_MENU'                     => array('4.3.0', ''),
            'TIDY_TAG_META'                     => array('4.3.0', ''),
            'TIDY_TAG_MULTICOL'                 => array('4.3.0', ''),
            'TIDY_TAG_NOBR'                     => array('4.3.0', ''),
            'TIDY_TAG_NOEMBED'                  => array('4.3.0', ''),
            'TIDY_TAG_NOFRAMES'                 => array('4.3.0', ''),
            'TIDY_TAG_NOLAYER'                  => array('4.3.0', ''),
            'TIDY_TAG_NOSAVE'                   => array('4.3.0', ''),
            'TIDY_TAG_NOSCRIPT'                 => array('4.3.0', ''),
            'TIDY_TAG_OBJECT'                   => array('4.3.0', ''),
            'TIDY_TAG_OL'                       => array('4.3.0', ''),
            'TIDY_TAG_OPTGROUP'                 => array('4.3.0', ''),
            'TIDY_TAG_OPTION'                   => array('4.3.0', ''),
            'TIDY_TAG_P'                        => array('4.3.0', ''),
            'TIDY_TAG_PARAM'                    => array('4.3.0', ''),
            'TIDY_TAG_PLAINTEXT'                => array('4.3.0', ''),
            'TIDY_TAG_PRE'                      => array('4.3.0', ''),
            'TIDY_TAG_Q'                        => array('4.3.0', ''),
            'TIDY_TAG_RB'                       => array('4.3.0', ''),
            'TIDY_TAG_RBC'                      => array('4.3.0', ''),
            'TIDY_TAG_RP'                       => array('4.3.0', ''),
            'TIDY_TAG_RT'                       => array('4.3.0', ''),
            'TIDY_TAG_RTC'                      => array('4.3.0', ''),
            'TIDY_TAG_RUBY'                     => array('4.3.0', ''),
            'TIDY_TAG_S'                        => array('4.3.0', ''),
            'TIDY_TAG_SAMP'                     => array('4.3.0', ''),
            'TIDY_TAG_SCRIPT'                   => array('4.3.0', ''),
            'TIDY_TAG_SELECT'                   => array('4.3.0', ''),
            'TIDY_TAG_SERVER'                   => array('4.3.0', ''),
            'TIDY_TAG_SERVLET'                  => array('4.3.0', ''),
            'TIDY_TAG_SMALL'                    => array('4.3.0', ''),
            'TIDY_TAG_SPACER'                   => array('4.3.0', ''),
            'TIDY_TAG_SPAN'                     => array('4.3.0', ''),
            'TIDY_TAG_STRIKE'                   => array('4.3.0', ''),
            'TIDY_TAG_STRONG'                   => array('4.3.0', ''),
            'TIDY_TAG_STYLE'                    => array('4.3.0', ''),
            'TIDY_TAG_SUB'                      => array('4.3.0', ''),
            'TIDY_TAG_SUP'                      => array('4.3.0', ''),
            'TIDY_TAG_TABLE'                    => array('4.3.0', ''),
            'TIDY_TAG_TBODY'                    => array('4.3.0', ''),
            'TIDY_TAG_TD'                       => array('4.3.0', ''),
            'TIDY_TAG_TEXTAREA'                 => array('4.3.0', ''),
            'TIDY_TAG_TFOOT'                    => array('4.3.0', ''),
            'TIDY_TAG_TH'                       => array('4.3.0', ''),
            'TIDY_TAG_THEAD'                    => array('4.3.0', ''),
            'TIDY_TAG_TITLE'                    => array('4.3.0', ''),
            'TIDY_TAG_TR'                       => array('4.3.0', ''),
            'TIDY_TAG_TT'                       => array('4.3.0', ''),
            'TIDY_TAG_U'                        => array('4.3.0', ''),
            'TIDY_TAG_UL'                       => array('4.3.0', ''),
            'TIDY_TAG_UNKNOWN'                  => array('4.3.0', ''),
            'TIDY_TAG_VAR'                      => array('4.3.0', ''),
            'TIDY_TAG_WBR'                      => array('4.3.0', ''),
            'TIDY_TAG_XMP'                      => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
