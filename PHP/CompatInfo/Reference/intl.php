<?php
/**
 * Version informations about intl extension
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
 * All interfaces, classes, functions, constants about intl extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.intl.php
 * @since    Class available since Release 2.0.0
 */
class PHP_CompatInfo_Reference_Intl implements PHP_CompatInfo_Reference
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
            'intl' => array('5.2.4', '', '1.1.0')
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
                'Collator'                      => array('5.2.4', ''),
                'NumberFormatter'               => array('5.2.4', ''),
                'Locale'                        => array('5.2.4', ''),
                'Normalizer'                    => array('5.2.4', ''),
                'MessageFormatter'              => array('5.2.4', ''),
                'IntlDateFormatter'             => array('5.2.4', ''),
                'ResourceBundle'                => array('5.2.4', ''),
                // not yet available
                // 'Transliterator'                => array('5.2.4', ''),
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
     * @link   http://www.php.net/manual/en/ref.intl.php
     * @link   http://www.php.net/manual/en/ref.intl.idn.php
     * @link   http://www.php.net/manual/en/ref.intl.grapheme.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                // php 5.3.0 or intl 1.0.2 or idn 0.1
                'idn_to_ascii'                      => array('4.0.0', ''),
                'idn_to_utf8'                       => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'collator_asort'                    => array('5.2.4', ''),
                'collator_compare'                  => array('5.2.4', ''),
                'collator_create'                   => array('5.2.4', ''),
                'collator_get_attribute'            => array('5.2.4', ''),
                'collator_get_error_code'           => array('5.2.4', ''),
                'collator_get_error_message'        => array('5.2.4', ''),
                'collator_get_locale'               => array('5.2.4', ''),
                'collator_get_sort_key'             => array('5.2.4', ''),
                'collator_get_strength'             => array('5.2.4', ''),
                'collator_set_attribute'            => array('5.2.4', ''),
                'collator_set_strength'             => array('5.2.4', ''),
                'collator_sort'                     => array('5.2.4', ''),
                'collator_sort_with_sort_keys'      => array('5.2.4', ''),
                'datefmt_create'                    => array('5.2.4', ''),
                'datefmt_format'                    => array('5.2.4', ''),
                'datefmt_get_calendar'              => array('5.2.4', ''),
                'datefmt_get_datetype'              => array('5.2.4', ''),
                'datefmt_get_error_code'            => array('5.2.4', ''),
                'datefmt_get_error_message'         => array('5.2.4', ''),
                'datefmt_get_locale'                => array('5.2.4', ''),
                'datefmt_get_pattern'               => array('5.2.4', ''),
                'datefmt_get_timetype'              => array('5.2.4', ''),
                'datefmt_get_timezone_id'           => array('5.2.4', ''),
                'datefmt_is_lenient'                => array('5.2.4', ''),
                'datefmt_localtime'                 => array('5.2.4', ''),
                'datefmt_parse'                     => array('5.2.4', ''),
                'datefmt_set_calendar'              => array('5.2.4', ''),
                'datefmt_set_lenient'               => array('5.2.4', ''),
                'datefmt_set_pattern'               => array('5.2.4', ''),
                'datefmt_set_timezone_id'           => array('5.2.4', ''),
                'grapheme_extract'                  => array('5.2.4', ''),
                'grapheme_stripos'                  => array('5.2.4', ''),
                'grapheme_stristr'                  => array('5.2.4', ''),
                'grapheme_strlen'                   => array('5.2.4', ''),
                'grapheme_strpos'                   => array('5.2.4', ''),
                'grapheme_strripos'                 => array('5.2.4', ''),
                'grapheme_strrpos'                  => array('5.2.4', ''),
                'grapheme_strstr'                   => array('5.2.4', ''),
                'grapheme_substr'                   => array('5.2.4', ''),
                'intl_error_name'                   => array('5.2.4', ''),
                'intl_get_error_code'               => array('5.2.4', ''),
                'intl_get_error_message'            => array('5.2.4', ''),
                'intl_is_failure'                   => array('5.2.4', ''),
                'locale_accept_from_http'           => array('5.2.4', ''),
                'locale_canonicalize'               => array('5.2.4', ''),
                'locale_compose'                    => array('5.2.4', ''),
                'locale_filter_matches'             => array('5.2.4', ''),
                'locale_get_all_variants'           => array('5.2.4', ''),
                'locale_get_default'                => array('5.2.4', ''),
                'locale_get_display_language'       => array('5.2.4', ''),
                'locale_get_display_name'           => array('5.2.4', ''),
                'locale_get_display_region'         => array('5.2.4', ''),
                'locale_get_display_script'         => array('5.2.4', ''),
                'locale_get_display_variant'        => array('5.2.4', ''),
                'locale_get_keywords'               => array('5.2.4', ''),
                'locale_get_primary_language'       => array('5.2.4', ''),
                'locale_get_region'                 => array('5.2.4', ''),
                'locale_get_script'                 => array('5.2.4', ''),
                'locale_lookup'                     => array('5.2.4', ''),
                'locale_parse'                      => array('5.2.4', ''),
                'locale_set_default'                => array('5.2.4', ''),
                'msgfmt_create'                     => array('5.2.4', ''),
                'msgfmt_format'                     => array('5.2.4', ''),
                'msgfmt_format_message'             => array('5.2.4', ''),
                'msgfmt_get_error_code'             => array('5.2.4', ''),
                'msgfmt_get_error_message'          => array('5.2.4', ''),
                'msgfmt_get_locale'                 => array('5.2.4', ''),
                'msgfmt_get_pattern'                => array('5.2.4', ''),
                'msgfmt_parse'                      => array('5.2.4', ''),
                'msgfmt_parse_message'              => array('5.2.4', ''),
                'msgfmt_set_pattern'                => array('5.2.4', ''),
                'normalizer_is_normalized'          => array('5.2.4', ''),
                'normalizer_normalize'              => array('5.2.4', ''),
                'numfmt_create'                     => array('5.2.4', ''),
                'numfmt_format'                     => array('5.2.4', ''),
                'numfmt_format_currency'            => array('5.2.4', ''),
                'numfmt_get_attribute'              => array('5.2.4', ''),
                'numfmt_get_error_code'             => array('5.2.4', ''),
                'numfmt_get_error_message'          => array('5.2.4', ''),
                'numfmt_get_locale'                 => array('5.2.4', ''),
                'numfmt_get_pattern'                => array('5.2.4', ''),
                'numfmt_get_symbol'                 => array('5.2.4', ''),
                'numfmt_get_text_attribute'         => array('5.2.4', ''),
                'numfmt_parse'                      => array('5.2.4', ''),
                'numfmt_parse_currency'             => array('5.2.4', ''),
                'numfmt_set_attribute'              => array('5.2.4', ''),
                'numfmt_set_pattern'                => array('5.2.4', ''),
                'numfmt_set_symbol'                 => array('5.2.4', ''),
                'numfmt_set_text_attribute'         => array('5.2.4', ''),
                'resourcebundle_count'              => array('5.2.4', ''),
                'resourcebundle_create'             => array('5.2.4', ''),
                'resourcebundle_get'                => array('5.2.4', ''),
                'resourcebundle_get_error_code'     => array('5.2.4', ''),
                'resourcebundle_get_error_message'  => array('5.2.4', ''),
                'resourcebundle_locales'            => array('5.2.4', ''),
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
     * @link   http://www.php.net/manual/en/imap.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'IDNA_ALLOW_UNASSIGNED'             => array('4.0.0', ''),
                'IDNA_DEFAULT'                      => array('4.0.0', ''),
                'IDNA_USE_STD3_RULES'               => array('4.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'GRAPHEME_EXTR_COUNT'               => array('5.2.4', ''),
                'GRAPHEME_EXTR_MAXBYTES'            => array('5.2.4', ''),
                'GRAPHEME_EXTR_MAXCHARS'            => array('5.2.4', ''),
                'INTL_MAX_LOCALE_LEN'               => array('5.2.4', ''),
                'ULOC_ACTUAL_LOCALE'                => array('5.2.4', ''),
                'ULOC_VALID_LOCALE'                 => array('5.2.4', ''),
                'U_AMBIGUOUS_ALIAS_WARNING'         => array('5.2.4', ''),
                'U_BAD_VARIABLE_DEFINITION'         => array('5.2.4', ''),
                'U_BRK_ASSIGN_ERROR'                => array('5.2.4', ''),
                'U_BRK_ERROR_LIMIT'                 => array('5.2.4', ''),
                'U_BRK_ERROR_START'                 => array('5.2.4', ''),
                'U_BRK_HEX_DIGITS_EXPECTED'         => array('5.2.4', ''),
                'U_BRK_INIT_ERROR'                  => array('5.2.4', ''),
                'U_BRK_INTERNAL_ERROR'              => array('5.2.4', ''),
                'U_BRK_MALFORMED_RULE_TAG'          => array('5.2.4', ''),
                'U_BRK_MISMATCHED_PAREN'            => array('5.2.4', ''),
                'U_BRK_NEW_LINE_IN_QUOTED_STRING'   => array('5.2.4', ''),
                'U_BRK_RULE_EMPTY_SET'              => array('5.2.4', ''),
                'U_BRK_RULE_SYNTAX'                 => array('5.2.4', ''),
                'U_BRK_SEMICOLON_EXPECTED'          => array('5.2.4', ''),
                'U_BRK_UNCLOSED_SET'                => array('5.2.4', ''),
                'U_BRK_UNDEFINED_VARIABLE'          => array('5.2.4', ''),
                'U_BRK_UNRECOGNIZED_OPTION'         => array('5.2.4', ''),
                'U_BRK_VARIABLE_REDFINITION'        => array('5.2.4', ''),
                'U_BUFFER_OVERFLOW_ERROR'           => array('5.2.4', ''),
                'U_CE_NOT_FOUND_ERROR'              => array('5.2.4', ''),
                'U_COLLATOR_VERSION_MISMATCH'       => array('5.2.4', ''),
                'U_DIFFERENT_UCA_VERSION'           => array('5.2.4', ''),
                'U_ENUM_OUT_OF_SYNC_ERROR'          => array('5.2.4', ''),
                'U_ERROR_LIMIT'                     => array('5.2.4', ''),
                'U_ERROR_WARNING_LIMIT'             => array('5.2.4', ''),
                'U_ERROR_WARNING_START'             => array('5.2.4', ''),
                'U_FILE_ACCESS_ERROR'               => array('5.2.4', ''),
                'U_FMT_PARSE_ERROR_LIMIT'           => array('5.2.4', ''),
                'U_FMT_PARSE_ERROR_START'           => array('5.2.4', ''),
                'U_ILLEGAL_ARGUMENT_ERROR'          => array('5.2.4', ''),
                'U_ILLEGAL_CHARACTER'               => array('5.2.4', ''),
                'U_ILLEGAL_CHAR_FOUND'              => array('5.2.4', ''),
                'U_ILLEGAL_CHAR_IN_SEGMENT'         => array('5.2.4', ''),
                'U_ILLEGAL_ESCAPE_SEQUENCE'         => array('5.2.4', ''),
                'U_ILLEGAL_PAD_POSITION'            => array('5.2.4', ''),
                'U_INDEX_OUTOFBOUNDS_ERROR'         => array('5.2.4', ''),
                'U_INTERNAL_PROGRAM_ERROR'          => array('5.2.4', ''),
                'U_INTERNAL_TRANSLITERATOR_ERROR'   => array('5.2.4', ''),
                'U_INVALID_CHAR_FOUND'              => array('5.2.4', ''),
                'U_INVALID_FORMAT_ERROR'            => array('5.2.4', ''),
                'U_INVALID_FUNCTION'                => array('5.2.4', ''),
                'U_INVALID_ID'                      => array('5.2.4', ''),
                'U_INVALID_PROPERTY_PATTERN'        => array('5.2.4', ''),
                'U_INVALID_RBT_SYNTAX'              => array('5.2.4', ''),
                'U_INVALID_STATE_ERROR'             => array('5.2.4', ''),
                'U_INVALID_TABLE_FILE'              => array('5.2.4', ''),
                'U_INVALID_TABLE_FORMAT'            => array('5.2.4', ''),
                'U_INVARIANT_CONVERSION_ERROR'      => array('5.2.4', ''),
                'U_MALFORMED_EXPONENTIAL_PATTERN'   => array('5.2.4', ''),
                'U_MALFORMED_PRAGMA'                => array('5.2.4', ''),
                'U_MALFORMED_RULE'                  => array('5.2.4', ''),
                'U_MALFORMED_SET'                   => array('5.2.4', ''),
                'U_MALFORMED_SYMBOL_REFERENCE'      => array('5.2.4', ''),
                'U_MALFORMED_UNICODE_ESCAPE'        => array('5.2.4', ''),
                'U_MALFORMED_VARIABLE_DEFINITION'   => array('5.2.4', ''),
                'U_MALFORMED_VARIABLE_REFERENCE'    => array('5.2.4', ''),
                'U_MEMORY_ALLOCATION_ERROR'         => array('5.2.4', ''),
                'U_MESSAGE_PARSE_ERROR'             => array('5.2.4', ''),
                'U_MISMATCHED_SEGMENT_DELIMITERS'   => array('5.2.4', ''),
                'U_MISPLACED_ANCHOR_START'          => array('5.2.4', ''),
                'U_MISPLACED_COMPOUND_FILTER'       => array('5.2.4', ''),
                'U_MISPLACED_CURSOR_OFFSET'         => array('5.2.4', ''),
                'U_MISPLACED_QUANTIFIER'            => array('5.2.4', ''),
                'U_MISSING_OPERATOR'                => array('5.2.4', ''),
                'U_MISSING_RESOURCE_ERROR'          => array('5.2.4', ''),
                'U_MISSING_SEGMENT_CLOSE'           => array('5.2.4', ''),
                'U_MULTIPLE_ANTE_CONTEXTS'          => array('5.2.4', ''),
                'U_MULTIPLE_COMPOUND_FILTERS'       => array('5.2.4', ''),
                'U_MULTIPLE_CURSORS'                => array('5.2.4', ''),
                'U_MULTIPLE_DECIMAL_SEPARATORS'     => array('5.2.4', ''),
                'U_MULTIPLE_DECIMAL_SEPERATORS'     => array('5.2.4', ''),
                'U_MULTIPLE_EXPONENTIAL_SYMBOLS'    => array('5.2.4', ''),
                'U_MULTIPLE_PAD_SPECIFIERS'         => array('5.2.4', ''),
                'U_MULTIPLE_PERCENT_SYMBOLS'        => array('5.2.4', ''),
                'U_MULTIPLE_PERMILL_SYMBOLS'        => array('5.2.4', ''),
                'U_MULTIPLE_POST_CONTEXTS'          => array('5.2.4', ''),
                'U_NO_SPACE_AVAILABLE'              => array('5.2.4', ''),
                'U_NO_WRITE_PERMISSION'             => array('5.2.4', ''),
                'U_PARSE_ERROR'                     => array('5.2.4', ''),
                'U_PARSE_ERROR_LIMIT'               => array('5.2.4', ''),
                'U_PARSE_ERROR_START'               => array('5.2.4', ''),
                'U_PATTERN_SYNTAX_ERROR'            => array('5.2.4', ''),
                'U_PRIMARY_TOO_LONG_ERROR'          => array('5.2.4', ''),
                'U_REGEX_BAD_ESCAPE_SEQUENCE'       => array('5.2.4', ''),
                'U_REGEX_BAD_INTERVAL'              => array('5.2.4', ''),
                'U_REGEX_ERROR_LIMIT'               => array('5.2.4', ''),
                'U_REGEX_ERROR_START'               => array('5.2.4', ''),
                'U_REGEX_INTERNAL_ERROR'            => array('5.2.4', ''),
                'U_REGEX_INVALID_BACK_REF'          => array('5.2.4', ''),
                'U_REGEX_INVALID_FLAG'              => array('5.2.4', ''),
                'U_REGEX_INVALID_STATE'             => array('5.2.4', ''),
                'U_REGEX_LOOK_BEHIND_LIMIT'         => array('5.2.4', ''),
                'U_REGEX_MAX_LT_MIN'                => array('5.2.4', ''),
                'U_REGEX_MISMATCHED_PAREN'          => array('5.2.4', ''),
                'U_REGEX_NUMBER_TOO_BIG'            => array('5.2.4', ''),
                'U_REGEX_PROPERTY_SYNTAX'           => array('5.2.4', ''),
                'U_REGEX_RULE_SYNTAX'               => array('5.2.4', ''),
                'U_REGEX_SET_CONTAINS_STRING'       => array('5.2.4', ''),
                'U_REGEX_UNIMPLEMENTED'             => array('5.2.4', ''),
                'U_RESOURCE_TYPE_MISMATCH'          => array('5.2.4', ''),
                'U_RULE_MASK_ERROR'                 => array('5.2.4', ''),
                'U_SAFECLONE_ALLOCATED_WARNING'     => array('5.2.4', ''),
                'U_SORT_KEY_TOO_SHORT_WARNING'      => array('5.2.4', ''),
                'U_STANDARD_ERROR_LIMIT'            => array('5.2.4', ''),
                'U_STATE_OLD_WARNING'               => array('5.2.4', ''),
                'U_STATE_TOO_OLD_ERROR'             => array('5.2.4', ''),
                'U_STRINGPREP_CHECK_BIDI_ERROR'     => array('5.2.4', ''),
                'U_STRINGPREP_PROHIBITED_ERROR'     => array('5.2.4', ''),
                'U_STRINGPREP_UNASSIGNED_ERROR'     => array('5.2.4', ''),
                'U_STRING_NOT_TERMINATED_WARNING'   => array('5.2.4', ''),
                'U_TOO_MANY_ALIASES_ERROR'          => array('5.2.4', ''),
                'U_TRAILING_BACKSLASH'              => array('5.2.4', ''),
                'U_TRUNCATED_CHAR_FOUND'            => array('5.2.4', ''),
                'U_UNCLOSED_SEGMENT'                => array('5.2.4', ''),
                'U_UNDEFINED_SEGMENT_REFERENCE'     => array('5.2.4', ''),
                'U_UNDEFINED_VARIABLE'              => array('5.2.4', ''),
                'U_UNEXPECTED_TOKEN'                => array('5.2.4', ''),
                'U_UNMATCHED_BRACES'                => array('5.2.4', ''),
                'U_UNQUOTED_SPECIAL'                => array('5.2.4', ''),
                'U_UNSUPPORTED_ATTRIBUTE'           => array('5.2.4', ''),
                'U_UNSUPPORTED_ERROR'               => array('5.2.4', ''),
                'U_UNSUPPORTED_ESCAPE_SEQUENCE'     => array('5.2.4', ''),
                'U_UNSUPPORTED_PROPERTY'            => array('5.2.4', ''),
                'U_UNTERMINATED_QUOTE'              => array('5.2.4', ''),
                'U_USELESS_COLLATOR_ERROR'          => array('5.2.4', ''),
                'U_USING_DEFAULT_WARNING'           => array('5.2.4', ''),
                'U_USING_FALLBACK_WARNING'          => array('5.2.4', ''),
                'U_VARIABLE_RANGE_EXHAUSTED'        => array('5.2.4', ''),
                'U_VARIABLE_RANGE_OVERLAP'          => array('5.2.4', ''),
                'U_ZERO_ERROR'                      => array('5.2.4', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
