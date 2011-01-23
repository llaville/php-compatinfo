<?php
/**
 * All interfaces, classes, functions, constants about mbstring extension
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @link       http://www.php.net/manual/en/book.mbstring.php
 */

require_once 'PHP/CompatInfo/Reference.php';

class PHP_CompatInfo_Reference_Mbstring implements PHP_CompatInfo_Reference
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
            'mbstring' => array('4.0.6', '', '')
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
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
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
     * @link   http://www.php.net/manual/en/ref.mbstring.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'mb_convert_case'                => array('4.3.0', ''),
                'mb_strtoupper'                  => array('4.3.0', ''),
                'mb_strtolower'                  => array('4.3.0', ''),
                'mb_language'                    => array('4.0.6', ''),
                'mb_internal_encoding'           => array('4.0.6', ''),
                'mb_http_input'                  => array('4.0.6', ''),
                'mb_http_output'                 => array('4.0.6', ''),
                'mb_detect_order'                => array('4.0.6', ''),
                'mb_substitute_character'        => array('4.0.6', ''),
                'mb_parse_str'                   => array('4.0.6', ''),
                'mb_output_handler'              => array('4.0.6', ''),
                'mb_preferred_mime_name'         => array('4.0.6', ''),
                'mb_strlen'                      => array('4.0.6', ''),
                'mb_strpos'                      => array('4.0.6', ''),
                'mb_strrpos'                     => array('4.0.6', ''),
                'mb_substr_count'                => array('4.3.0', ''),
                'mb_substr'                      => array('4.0.6', ''),
                'mb_strcut'                      => array('4.0.6', ''),
                'mb_strwidth'                    => array('4.0.6', ''),
                'mb_strimwidth'                  => array('4.0.6', ''),
                'mb_convert_encoding'            => array('4.0.6', ''),
                'mb_detect_encoding'             => array('4.0.6', ''),
                'mb_convert_kana'                => array('4.0.6', ''),
                'mb_encode_mimeheader'           => array('4.0.6', ''),
                'mb_decode_mimeheader'           => array('4.0.6', ''),
                'mb_convert_variables'           => array('4.0.6', ''),
                'mb_encode_numericentity'        => array('4.0.6', ''),
                'mb_decode_numericentity'        => array('4.0.6', ''),
                'mb_send_mail'                   => array('4.0.6', ''),
                'mb_get_info'                    => array('4.2.0', ''),
                'mb_check_encoding'              => array('4.4.3', ''),
                'mb_regex_encoding'              => array('4.2.0', ''),
                'mb_regex_set_options'           => array('4.3.0', ''),
                'mb_ereg'                        => array('4.2.0', ''),
                'mb_eregi'                       => array('4.2.0', ''),
                'mb_ereg_replace'                => array('4.2.0', ''),
                'mb_eregi_replace'               => array('4.2.0', ''),
                'mb_split'                       => array('4.2.0', ''),
                'mb_ereg_match'                  => array('4.2.0', ''),
                'mb_ereg_search'                 => array('4.2.0', ''),
                'mb_ereg_search_pos'             => array('4.2.0', ''),
                'mb_ereg_search_regs'            => array('4.2.0', ''),
                'mb_ereg_search_init'            => array('4.2.0', ''),
                'mb_ereg_search_getregs'         => array('4.2.0', ''),
                'mb_ereg_search_getpos'          => array('4.2.0', ''),
                'mb_ereg_search_setpos'          => array('4.2.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'mb_encoding_aliases'            => array('5.3.0', ''),
                'mb_list_encodings'              => array('5.0.0', ''),
                'mb_stripos'                     => array('5.2.0', ''),
                'mb_stristr'                     => array('5.2.0', ''),
                'mb_strrchr'                     => array('5.2.0', ''),
                'mb_strrichr'                    => array('5.2.0', ''),
                'mb_strripos'                    => array('5.2.0', ''),
                'mb_strstr'                      => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/mbstring.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'MB_OVERLOAD_MAIL'               => array('4.0.6', ''),
                'MB_OVERLOAD_STRING'             => array('4.0.6', ''),
                'MB_OVERLOAD_REGEX'              => array('4.0.6', ''),
                'MB_CASE_UPPER'                  => array('4.0.6', ''),
                'MB_CASE_LOWER'                  => array('4.0.6', ''),
                'MB_CASE_TITLE'                  => array('4.0.6', ''),
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
