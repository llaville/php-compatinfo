<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class IntlExtension extends AbstractReference
{
    const REF_NAME    = 'intl';
    const REF_VERSION = '';

    private $version_number;

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $this->version_number = $this->getMetaVersion('version_number');

        $version = $this->getLatestVersion();

        // 1.0.0beta
        if (version_compare($version, '1.0.0beta', 'ge')) {
            $release = $this->getR10000beta();
            $this->storage->attach($release);
        }

        // 1.0.0RC1
        if (version_compare($version, '1.0.0RC1', 'ge')) {
            $release = $this->getR10000RC1();
            $this->storage->attach($release);
        }

        // 1.0.1
        if (version_compare($version, '1.0.1', 'ge')) {
            $release = $this->getR10001();
            $this->storage->attach($release);
        }

        // 1.0.2
        if (version_compare($version, '1.0.2', 'ge')) {
            $release = $this->getR10002();
            $this->storage->attach($release);
        }

        // 1.0.3
        if (version_compare($version, '1.0.3', 'ge')) {
            $release = $this->getR10003();
            $this->storage->attach($release);
        }

        // 1.1.0
        if (version_compare($version, '1.1.0', 'ge')) {
            $release = $this->getR10100();
            $this->storage->attach($release);
        }

        // 2.0.0b1
        if (version_compare($version, '2.0.0b1', 'ge')) {
            $release = $this->getR20000b1();
            $this->storage->attach($release);
        }

        // 3.0.0
        if (version_compare($version, '3.0.0', 'ge')) {
            $release = $this->getR30000();
            $this->storage->attach($release);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $this->storage->attach($release);
        }

        // 5.5.1
        if (version_compare($version, '5.5.1', 'ge')) {
            $release = $this->getR50501();
            $this->storage->attach($release);
        }
    }

    protected function getR10000beta()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0beta',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2007-12-06',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'intl.default_locale'               => null,
        );
        $release->classes = array(
            'Collator'                          => null,
            'Locale'                            => null,
            'MessageFormatter'                  => null,
            'Normalizer'                        => null,
            'NumberFormatter'                   => null,
            'IntlException'                     => null,
        );
        $release->constants = array(
            'ULOC_ACTUAL_LOCALE'                => null,
            'ULOC_VALID_LOCALE'                 => null,

            // Warnings
            'U_USING_FALLBACK_WARNING'          => null,
            'U_ERROR_WARNING_START'             => null,
            'U_USING_DEFAULT_WARNING'           => null,
            'U_SAFECLONE_ALLOCATED_WARNING'     => null,
            'U_STATE_OLD_WARNING'               => null,
            'U_STRING_NOT_TERMINATED_WARNING'   => null,
            'U_SORT_KEY_TOO_SHORT_WARNING'      => null,
            'U_AMBIGUOUS_ALIAS_WARNING'         => null,
            'U_DIFFERENT_UCA_VERSION'           => null,
            'U_ERROR_WARNING_LIMIT'             => null,

            // Standard errors
            'U_ZERO_ERROR'                      => null,
            'U_ILLEGAL_ARGUMENT_ERROR'          => null,
            'U_MISSING_RESOURCE_ERROR'          => null,
            'U_INVALID_FORMAT_ERROR'            => null,
            'U_FILE_ACCESS_ERROR'               => null,
            'U_INTERNAL_PROGRAM_ERROR'          => null,
            'U_MESSAGE_PARSE_ERROR'             => null,
            'U_MEMORY_ALLOCATION_ERROR'         => null,
            'U_INDEX_OUTOFBOUNDS_ERROR'         => null,
            'U_PARSE_ERROR'                     => null,
            'U_INVALID_CHAR_FOUND'              => null,
            'U_TRUNCATED_CHAR_FOUND'            => null,
            'U_ILLEGAL_CHAR_FOUND'              => null,
            'U_INVALID_TABLE_FORMAT'            => null,
            'U_INVALID_TABLE_FILE'              => null,
            'U_BUFFER_OVERFLOW_ERROR'           => null,
            'U_UNSUPPORTED_ERROR'               => null,
            'U_RESOURCE_TYPE_MISMATCH'          => null,
            'U_ILLEGAL_ESCAPE_SEQUENCE'         => null,
            'U_UNSUPPORTED_ESCAPE_SEQUENCE'     => null,
            'U_NO_SPACE_AVAILABLE'              => null,
            'U_CE_NOT_FOUND_ERROR'              => null,
            'U_PRIMARY_TOO_LONG_ERROR'          => null,
            'U_STATE_TOO_OLD_ERROR'             => null,
            'U_TOO_MANY_ALIASES_ERROR'          => null,
            'U_ENUM_OUT_OF_SYNC_ERROR'          => null,
            'U_INVARIANT_CONVERSION_ERROR'      => null,
            'U_INVALID_STATE_ERROR'             => null,
            'U_COLLATOR_VERSION_MISMATCH'       => null,
            'U_USELESS_COLLATOR_ERROR'          => null,
            'U_NO_WRITE_PERMISSION'             => null,
            'U_STANDARD_ERROR_LIMIT'            => null,

            // The error code range 0x10000 0x10100 are reserved for Transliterator
            'U_BAD_VARIABLE_DEFINITION'         => null,
            'U_PARSE_ERROR_START'               => null,
            'U_MALFORMED_RULE'                  => null,
            'U_MALFORMED_SET'                   => null,
            'U_MALFORMED_SYMBOL_REFERENCE'      => null,
            'U_MALFORMED_UNICODE_ESCAPE'        => null,
            'U_MALFORMED_VARIABLE_DEFINITION'   => null,
            'U_MALFORMED_VARIABLE_REFERENCE'    => null,
            'U_MISMATCHED_SEGMENT_DELIMITERS'   => null,
            'U_MISPLACED_ANCHOR_START'          => null,
            'U_MISPLACED_CURSOR_OFFSET'         => null,
            'U_MISPLACED_QUANTIFIER'            => null,
            'U_MISSING_OPERATOR'                => null,
            'U_MISSING_SEGMENT_CLOSE'           => null,
            'U_MULTIPLE_ANTE_CONTEXTS'          => null,
            'U_MULTIPLE_CURSORS'                => null,
            'U_MULTIPLE_POST_CONTEXTS'          => null,
            'U_TRAILING_BACKSLASH'              => null,
            'U_UNDEFINED_SEGMENT_REFERENCE'     => null,
            'U_UNDEFINED_VARIABLE'              => null,
            'U_UNQUOTED_SPECIAL'                => null,
            'U_UNTERMINATED_QUOTE'              => null,
            'U_RULE_MASK_ERROR'                 => null,
            'U_MISPLACED_COMPOUND_FILTER'       => null,
            'U_MULTIPLE_COMPOUND_FILTERS'       => null,
            'U_INVALID_RBT_SYNTAX'              => null,
            'U_INVALID_PROPERTY_PATTERN'        => null,
            'U_MALFORMED_PRAGMA'                => null,
            'U_UNCLOSED_SEGMENT'                => null,
            'U_ILLEGAL_CHAR_IN_SEGMENT'         => null,
            'U_VARIABLE_RANGE_EXHAUSTED'        => null,
            'U_VARIABLE_RANGE_OVERLAP'          => null,
            'U_ILLEGAL_CHARACTER'               => null,
            'U_INTERNAL_TRANSLITERATOR_ERROR'   => null,
            'U_INVALID_ID'                      => null,
            'U_INVALID_FUNCTION'                => null,
            'U_PARSE_ERROR_LIMIT'               => null,

            // The error code range 0x10100 0x10200 are reserved for formatting API parsing error
            'U_UNEXPECTED_TOKEN'                => null,
            'U_FMT_PARSE_ERROR_START'           => null,
            'U_MULTIPLE_DECIMAL_SEPARATORS'     => null,
            // Typo: kept for backward compatibility. Use U_MULTIPLE_DECIMAL_SEPARATORS
            'U_MULTIPLE_DECIMAL_SEPERATORS'     => null,
            'U_MULTIPLE_EXPONENTIAL_SYMBOLS'    => null,
            'U_MALFORMED_EXPONENTIAL_PATTERN'   => null,
            'U_MULTIPLE_PERCENT_SYMBOLS'        => null,
            'U_MULTIPLE_PERMILL_SYMBOLS'        => null,
            'U_MULTIPLE_PAD_SPECIFIERS'         => null,
            'U_PATTERN_SYNTAX_ERROR'            => null,
            'U_ILLEGAL_PAD_POSITION'            => null,
            'U_UNMATCHED_BRACES'                => null,
            'U_UNSUPPORTED_PROPERTY'            => null,
            'U_UNSUPPORTED_ATTRIBUTE'           => null,
            'U_FMT_PARSE_ERROR_LIMIT'           => null,

            // The error code range 0x10200 0x102ff are reserved for Break Iterator related error
            'U_BRK_INTERNAL_ERROR'              => null,
            'U_BRK_ERROR_START'                 => null,
            'U_BRK_HEX_DIGITS_EXPECTED'         => null,
            'U_BRK_SEMICOLON_EXPECTED'          => null,
            'U_BRK_RULE_SYNTAX'                 => null,
            'U_BRK_UNCLOSED_SET'                => null,
            'U_BRK_ASSIGN_ERROR'                => null,
            'U_BRK_VARIABLE_REDFINITION'        => null,
            'U_BRK_MISMATCHED_PAREN'            => null,
            'U_BRK_NEW_LINE_IN_QUOTED_STRING'   => null,
            'U_BRK_UNDEFINED_VARIABLE'          => null,
            'U_BRK_INIT_ERROR'                  => null,
            'U_BRK_RULE_EMPTY_SET'              => null,
            'U_BRK_UNRECOGNIZED_OPTION'         => null,
            'U_BRK_MALFORMED_RULE_TAG'          => null,
            'U_BRK_ERROR_LIMIT'                 => null,

            // The error codes in the range 0x10300-0x103ff are reserved for regular expression related errrs
            'U_REGEX_INTERNAL_ERROR'            => null,
            'U_REGEX_ERROR_START'               => null,
            'U_REGEX_RULE_SYNTAX'               => null,
            'U_REGEX_INVALID_STATE'             => null,
            'U_REGEX_BAD_ESCAPE_SEQUENCE'       => null,
            'U_REGEX_PROPERTY_SYNTAX'           => null,
            'U_REGEX_UNIMPLEMENTED'             => null,
            'U_REGEX_MISMATCHED_PAREN'          => null,
            'U_REGEX_NUMBER_TOO_BIG'            => null,
            'U_REGEX_BAD_INTERVAL'              => null,
            'U_REGEX_MAX_LT_MIN'                => null,
            'U_REGEX_INVALID_BACK_REF'          => null,
            'U_REGEX_INVALID_FLAG'              => null,
            'U_REGEX_LOOK_BEHIND_LIMIT'         => null,
            'U_REGEX_SET_CONTAINS_STRING'       => null,
            'U_REGEX_ERROR_LIMIT'               => null,

            // Aliases for StringPrep
            'U_STRINGPREP_PROHIBITED_ERROR'     => null,
            'U_STRINGPREP_UNASSIGNED_ERROR'     => null,
            'U_STRINGPREP_CHECK_BIDI_ERROR'     => null,

            'U_ERROR_LIMIT'                     => null,
        );
        if (version_compare($this->version_number, '4.6.0', 'ge')) {
            // requires libicu >= 4.6
            $items = array(
                // The error code in the range 0x10400-0x104ff are reserved for IDNA related error codes
                'U_IDNA_ACE_PREFIX_ERROR'       => null,
                'U_IDNA_CHECK_BIDI_ERROR'       => null,
                'U_IDNA_ERROR_LIMIT'            => null,
                'U_IDNA_ERROR_START'            => null,
                'U_IDNA_LABEL_TOO_LONG_ERROR'   => null,
                'U_IDNA_PROHIBITED_ERROR'       => null,
                'U_IDNA_STD3_ASCII_RULES_ERROR' => null,
                'U_IDNA_UNASSIGNED_ERROR'       => null,
                'U_IDNA_VERIFICATION_ERROR'     => null,
                'U_IDNA_ZERO_LENGTH_LABEL_ERROR'=> null,
            );
            $release->constants += $items;
        }
        $release->functions = array(
            'collator_asort'                    => null,
            'collator_compare'                  => null,
            'collator_create'                   => null,
            'collator_get_attribute'            => null,
            'collator_get_error_code'           => null,
            'collator_get_error_message'        => null,
            'collator_get_locale'               => null,
            'collator_get_strength'             => null,
            'collator_set_attribute'            => null,
            'collator_set_strength'             => null,
            'collator_sort'                     => null,
            'collator_sort_with_sort_keys'      => null,

            'intl_error_name'                   => null,
            'intl_get_error_code'               => null,
            'intl_get_error_message'            => null,
            'intl_is_failure'                   => null,

            'locale_canonicalize'               => null,
            'locale_compose'                    => null,
            'locale_filter_matches'             => null,
            'locale_get_all_variants'           => null,
            'locale_get_default'                => null,
            'locale_get_display_language'       => null,
            'locale_get_display_name'           => null,
            'locale_get_display_region'         => null,
            'locale_get_display_script'         => null,
            'locale_get_display_variant'        => null,
            'locale_get_keywords'               => null,
            'locale_get_primary_language'       => null,
            'locale_get_region'                 => null,
            'locale_get_script'                 => null,
            'locale_lookup'                     => null,
            'locale_parse'                      => null,
            'locale_set_default'                => null,

            'msgfmt_create'                     => null,
            'msgfmt_format'                     => null,
            'msgfmt_format_message'             => null,
            'msgfmt_get_error_code'             => null,
            'msgfmt_get_error_message'          => null,
            'msgfmt_get_locale'                 => null,
            'msgfmt_get_pattern'                => null,
            'msgfmt_parse'                      => null,
            'msgfmt_parse_message'              => null,
            'msgfmt_set_pattern'                => null,

            'normalizer_is_normalized'          => null,
            'normalizer_normalize'              => null,

            'numfmt_create'                     => null,
            'numfmt_format'                     => null,
            'numfmt_format_currency'            => null,
            'numfmt_get_attribute'              => null,
            'numfmt_get_error_code'             => null,
            'numfmt_get_error_message'          => null,
            'numfmt_get_locale'                 => null,
            'numfmt_get_pattern'                => null,
            'numfmt_get_symbol'                 => null,
            'numfmt_get_text_attribute'         => null,
            'numfmt_parse'                      => null,
            'numfmt_parse_currency'             => null,
            'numfmt_set_attribute'              => null,
            'numfmt_set_pattern'                => null,
            'numfmt_set_symbol'                 => null,
            'numfmt_set_text_attribute'         => null,
        );
        return $release;
    }

    protected function getR10000RC1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0RC1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-05-27',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->classes = array(
            'IntlDateFormatter'                 => null,
        );
        $release->constants = array(
            'GRAPHEME_EXTR_COUNT'               => null,
            'GRAPHEME_EXTR_MAXBYTES'            => null,
            'GRAPHEME_EXTR_MAXCHARS'            => null,
        );
        $release->functions = array(
            'datefmt_create'                    => null,
            'datefmt_format'                    => null,
            'datefmt_get_calendar'              => null,
            'datefmt_get_datetype'              => null,
            'datefmt_get_error_code'            => null,
            'datefmt_get_error_message'         => null,
            'datefmt_get_locale'                => null,
            'datefmt_get_pattern'               => null,
            'datefmt_get_timetype'              => null,
            'datefmt_get_timezone_id'           => null,
            'datefmt_is_lenient'                => null,
            'datefmt_localtime'                 => null,
            'datefmt_parse'                     => null,
            'datefmt_set_calendar'              => null,
            'datefmt_set_lenient'               => null,
            'datefmt_set_pattern'               => null,
            'datefmt_set_timezone_id'           => null,

            'grapheme_extract'                  => null,
            'grapheme_stripos'                  => null,
            'grapheme_stristr'                  => null,
            'grapheme_strlen'                   => null,
            'grapheme_strpos'                   => null,
            'grapheme_strripos'                 => null,
            'grapheme_strrpos'                  => null,
            'grapheme_strstr'                   => null,
            'grapheme_substr'                   => null,
        );
        return $release;
    }

    protected function getR10001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2008-09-12',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->functions = array(
            'locale_accept_from_http'           => null,
        );
        return $release;
    }

    protected function getR10002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-04-09',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->constants = array(
            'IDNA_ALLOW_UNASSIGNED'             => null,
            'IDNA_DEFAULT'                      => null,
            'IDNA_USE_STD3_RULES'               => null,
        );
        $release->functions = array(
            'idn_to_ascii'                      => null,
            'idn_to_utf8'                       => null,
        );
        return $release;
    }

    protected function getR10003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-10-26',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'intl.error_level'                  => null,
        );
        $release->functions = array(
            'collator_get_sort_key'             => null,
        );
        return $release;
    }

    protected function getR10100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-01-08',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->classes = array(
            'ResourceBundle'                    => null,
        );
        $release->functions = array(
            'resourcebundle_count'              => null,
            'resourcebundle_create'             => null,
            'resourcebundle_get'                => null,
            'resourcebundle_get_error_code'     => null,
            'resourcebundle_get_error_message'  => null,
            'resourcebundle_locales'            => null,

        );
        return $release;
    }

    protected function getR20000b1()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0b1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2011-11-29',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->classes = array(
            'Spoofchecker'                              => null,
            'Transliterator'                            => null,
        );
        $release->constants = array(
            'INTL_ICU_VERSION'                          => array('5.3.7', ''),
            'INTL_IDNA_VARIANT_2003'                    => null,
            'INTL_MAX_LOCALE_LEN'                       => array('5.2.4', ''),
        );
        if (version_compare($this->version_number, '3.8.0', 'ge')) {
            // requires libicu >= 3.8
            $items = array(
                'U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR'     => null,
            );
            $release->constants += $items;
        }
        if (version_compare($this->version_number, '4.6.0', 'ge')) {
            // requires libicu >= 4.6
            $items = array(
                'INTL_ICU_DATA_VERSION'                 => array('5.3.7', ''),

                'IDNA_CHECK_BIDI'                       => null,
                'IDNA_CHECK_CONTEXTJ'                   => null,

                'IDNA_NONTRANSITIONAL_TO_ASCII'         => null,
                'IDNA_NONTRANSITIONAL_TO_UNICODE'       => null,

                'IDNA_ERROR_EMPTY_LABEL'                => null,
                'IDNA_ERROR_LABEL_TOO_LONG'             => null,
                'IDNA_ERROR_DOMAIN_NAME_TOO_LONG'       => null,
                'IDNA_ERROR_LEADING_HYPHEN'             => null,
                'IDNA_ERROR_TRAILING_HYPHEN'            => null,
                'IDNA_ERROR_HYPHEN_3_4'                 => null,
                'IDNA_ERROR_LEADING_COMBINING_MARK'     => null,
                'IDNA_ERROR_DISALLOWED'                 => null,
                'IDNA_ERROR_PUNYCODE'                   => null,
                'IDNA_ERROR_LABEL_HAS_DOT'              => null,
                'IDNA_ERROR_INVALID_ACE_LABEL'          => null,
                'IDNA_ERROR_BIDI'                       => null,
                'IDNA_ERROR_CONTEXTJ'                   => null,

                'INTL_IDNA_VARIANT_UTS46'               => null,
            );
            $release->constants += $items;
        }
        $release->functions = array(
            'transliterator_create'                     => null,
            'transliterator_create_from_rules'          => null,
            'transliterator_create_inverse'             => null,
            'transliterator_get_error_code'             => null,
            'transliterator_get_error_message'          => null,
            'transliterator_list_ids'                   => null,
            'transliterator_transliterate'              => null,
        );
        return $release;
    }

    protected function getR30000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-02',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'intl.use_exceptions'           => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->classes = array(
            'IntlBreakIterator'                             => null,
            'IntlCalendar'                                  => null,
            'IntlCodePointBreakIterator'                    => null,
            'IntlGregorianCalendar'                         => null,
            'IntlIterator'                                  => null,
            'IntlPartsIterator'                             => null,
            'IntlRuleBasedBreakIterator'                    => null,
            'IntlTimeZone'                                  => null,
            'UConverter'                                    => null,
        );
        $release->functions = array(
            'datefmt_format_object'                         => null,
            'datefmt_get_calendar_object'                   => null,
            'datefmt_get_timezone'                          => null,
            'datefmt_set_timezone'                          => null,

            'intlgregcal_create_instance'                   => null,
            'intlgregcal_get_gregorian_change'              => null,
            'intlgregcal_is_leap_year'                      => null,
            'intlgregcal_set_gregorian_change'              => null,

            'intlcal_add'                                   => null,
            'intlcal_after'                                 => null,
            'intlcal_before'                                => null,
            'intlcal_clear'                                 => null,
            'intlcal_create_instance'                       => null,
            'intlcal_equals'                                => null,
            'intlcal_field_difference'                      => null,
            'intlcal_from_date_time'                        => null,
            'intlcal_get'                                   => null,
            'intlcal_get_actual_maximum'                    => null,
            'intlcal_get_actual_minimum'                    => null,
            'intlcal_get_available_locales'                 => null,
            'intlcal_get_day_of_week_type'                  => null,
            'intlcal_get_error_code'                        => null,
            'intlcal_get_error_message'                     => null,
            'intlcal_get_first_day_of_week'                 => null,
            'intlcal_get_greatest_minimum'                  => null,
            'intlcal_get_keyword_values_for_locale'         => null,
            'intlcal_get_least_maximum'                     => null,
            'intlcal_get_locale'                            => null,
            'intlcal_get_maximum'                           => null,
            'intlcal_get_minimal_days_in_first_week'        => null,
            'intlcal_get_minimum'                           => null,
            'intlcal_get_now'                               => null,
            'intlcal_get_time'                              => null,
            'intlcal_get_time_zone'                         => null,
            'intlcal_get_type'                              => null,
            'intlcal_get_weekend_transition'                => null,
            'intlcal_in_daylight_time'                      => null,
            'intlcal_is_equivalent_to'                      => null,
            'intlcal_is_lenient'                            => null,
            'intlcal_is_set'                                => null,
            'intlcal_is_weekend'                            => null,
            'intlcal_roll'                                  => null,
            'intlcal_set'                                   => null,
            'intlcal_set_first_day_of_week'                 => null,
            'intlcal_set_lenient'                           => null,
            'intlcal_set_time'                              => null,
            'intlcal_set_time_zone'                         => null,
            'intlcal_to_date_time'                          => null,

            'intltz_count_equivalent_ids'                   => null,
            'intltz_create_default'                         => null,
            'intltz_create_enumeration'                     => null,
            'intltz_create_time_zone'                       => null,
            'intltz_from_date_time_zone'                    => null,
            'intltz_get_canonical_id'                       => null,
            'intltz_get_equivalent_id'                      => null,
            'intltz_get_gmt'                                => null,
            'intltz_get_display_name'                       => null,
            'intltz_get_dst_savings'                        => null,
            'intltz_get_error_code'                         => null,
            'intltz_get_error_message'                      => null,
            'intltz_get_id'                                 => null,
            'intltz_get_offset'                             => null,
            'intltz_get_raw_offset'                         => null,

            'intltz_get_tz_data_version'                    => null,
            'intltz_has_same_rules'                         => null,
            'intltz_to_date_time_zone'                      => null,
            'intltz_use_daylight_time'                      => null,
        );
        if (version_compare($this->version_number, '4.8', 'ge')) {
            // requires libicu >= 4.8
            $items = array(
                'intltz_create_time_zone_id_enumeration'    => null,
                'intltz_get_region'                         => null,
            );
            $release->functions += $items;
        }
        if (version_compare($this->version_number, '49', 'ge')) {
            // requires libicu >= 49 (version scheme change 4.9 become 49)
            $items = array(
                'intlcal_get_repeated_wall_time_option'     => null,
                'intlcal_get_skipped_wall_time_option'      => null,
                'intlcal_set_repeated_wall_time_option'     => null,
                'intlcal_set_skipped_wall_time_option'      => null,
                'intltz_get_unknown'                        => null,
            );
            $release->functions += $items;
        }
        return $release;
    }

    protected function getR50501()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-07-18',
            'php.min' => '5.5.1',
            'php.max' => '',
        );
        $release->functions = array(
            'intlcal_set_minimal_days_in_first_week'        => null,
        );
        return $release;
    }
}
