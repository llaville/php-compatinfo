<?php
/**
 * Version informations about mbstring extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about mbstring extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mbstring.php
 */
class PHP_CompatInfo_Reference_Mbstring
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mbstring';

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
        $phpMin = '4.0.6';
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
     * @link   http://www.php.net/manual/en/ref.mbstring.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'mb_check_encoding'              => array('4.4.3', ''),
            'mb_convert_case'                => array('4.3.0', ''),
            'mb_convert_encoding'            => array('4.0.6', ''),
            'mb_convert_kana'                => array('4.0.6', ''),
            'mb_convert_variables'           => array('4.0.6', ''),
            'mb_decode_mimeheader'           => array('4.0.6', ''),
            'mb_decode_numericentity'        => array('4.0.6', ''),
            'mb_detect_encoding'             => array('4.0.6', ''),
            'mb_detect_order'                => array('4.0.6', ''),
            'mb_encode_mimeheader'           => array('4.0.6', ''),
            'mb_encode_numericentity'        => array('4.0.6', ''),
            'mb_encoding_aliases'            => array('5.3.0', ''),
            'mb_ereg'                        => array('4.2.0', ''),
            'mb_ereg_match'                  => array('4.2.0', ''),
            'mb_ereg_replace'                => array('4.2.0', ''),
            'mb_ereg_replace_callback'       => array('5.4.1', ''),
            'mb_ereg_search'                 => array('4.2.0', ''),
            'mb_ereg_search_getpos'          => array('4.2.0', ''),
            'mb_ereg_search_getregs'         => array('4.2.0', ''),
            'mb_ereg_search_init'            => array('4.2.0', ''),
            'mb_ereg_search_pos'             => array('4.2.0', ''),
            'mb_ereg_search_regs'            => array('4.2.0', ''),
            'mb_ereg_search_setpos'          => array('4.2.0', ''),
            'mb_eregi'                       => array('4.2.0', ''),
            'mb_eregi_replace'               => array('4.2.0', ''),
            'mb_get_info'                    => array('4.2.0', ''),
            'mb_http_input'                  => array('4.0.6', ''),
            'mb_http_output'                 => array('4.0.6', ''),
            'mb_internal_encoding'           => array('4.0.6', ''),
            'mb_language'                    => array('4.0.6', ''),
            'mb_list_encodings'              => array('5.0.0', ''),
            'mb_output_handler'              => array('4.0.6', ''),
            'mb_parse_str'                   => array('4.0.6', ''),
            'mb_preferred_mime_name'         => array('4.0.6', ''),
            'mb_regex_encoding'              => array('4.2.0', ''),
            'mb_regex_set_options'           => array('4.3.0', ''),
            'mb_send_mail'                   => array('4.0.6', ''),
            'mb_split'                       => array('4.2.0', ''),
            'mb_strcut'                      => array('4.0.6', ''),
            'mb_strimwidth'                  => array('4.0.6', ''),
            'mb_stripos'                     => array('5.2.0', ''),
            'mb_stristr'                     => array('5.2.0', ''),
            'mb_strlen'                      => array('4.0.6', ''),
            'mb_strpos'                      => array('4.0.6', ''),
            'mb_strrchr'                     => array('5.2.0', ''),
            'mb_strrichr'                    => array('5.2.0', ''),
            'mb_strripos'                    => array('5.2.0', ''),
            'mb_strrpos'                     => array('4.0.6', ''),
            'mb_strstr'                      => array('5.2.0', ''),
            'mb_strtolower'                  => array('4.3.0', ''),
            'mb_strtoupper'                  => array('4.3.0', ''),
            'mb_strwidth'                    => array('4.0.6', ''),
            'mb_substitute_character'        => array('4.0.6', ''),
            'mb_substr'                      => array('4.0.6', ''),
            'mb_substr_count'                => array('4.3.0', ''),
            'mbereg'                         => array('4.2.0', ''),
            'mbereg_match'                   => array('4.2.0', ''),
            'mbereg_replace'                 => array('4.2.0', ''),
            'mbereg_search'                  => array('4.2.0', ''),
            'mbereg_search_getpos'           => array('4.2.0', ''),
            'mbereg_search_getregs'          => array('4.2.0', ''),
            'mbereg_search_init'             => array('4.2.0', ''),
            'mbereg_search_pos'              => array('4.2.0', ''),
            'mbereg_search_regs'             => array('4.2.0', ''),
            'mbereg_search_setpos'           => array('4.2.0', ''),
            'mberegi'                        => array('4.2.0', ''),
            'mberegi_replace'                => array('4.2.0', ''),
            'mbregex_encoding'               => array('4.2.0', ''),
            'mbsplit'                        => array('4.2.0', ''),
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
     * @link   http://www.php.net/manual/en/mbstring.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'MB_CASE_LOWER'                  => array('4.0.6', ''),
            'MB_CASE_TITLE'                  => array('4.0.6', ''),
            'MB_CASE_UPPER'                  => array('4.0.6', ''),
            'MB_OVERLOAD_MAIL'               => array('4.0.6', ''),
            'MB_OVERLOAD_REGEX'              => array('4.0.6', ''),
            'MB_OVERLOAD_STRING'             => array('4.0.6', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
