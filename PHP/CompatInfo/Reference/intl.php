<?php
/**
 * Version informations about intl extension
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
 * All interfaces, classes, functions, constants about intl extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.intl.php
 * @since    Class available since Release 2.0.0
 */
class PHP_CompatInfo_Reference_Intl
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'intl';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.0.0';  // 2013-06-02 (stable)

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
        /*
            1.0.0beta      PHP 5.2.0 ge
            since 1.0.0RC1 PHP 5.2.4 ge
         */
        $extver = phpversion(self::REF_NAME);
        if ($extver === false) {
            $extver = self::REF_VERSION;
        }

        if ($extension === null) {
            $version1 = $version;
            $version2 = '5.2.4';
        } else {
            $version1 = $extver;
            $version2 = '1.0.0RC1';
        }
        $phpMin = version_compare($version1, $version2, 'lt') ? '5.2.0' : '5.2.4';
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
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '1.0.0beta';   // 2007-12-06 (beta)
        $items = array(
            'Collator'                      => array('5.2.0', ''),
            'Locale'                        => array('5.2.0', ''),
            'MessageFormatter'              => array('5.2.0', ''),
            'Normalizer'                    => array('5.2.0', ''),
            'NumberFormatter'               => array('5.2.0', ''),
            'IntlException'                 => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.0.0RC1';    // 2008-05-27 (stable)
        $items = array(
            'IntlDateFormatter'             => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '1.1.0';       // 2010-01-08 (stable)
        $items = array(
            'ResourceBundle'                => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '2.0.0b1';     // 2011-11-29 (beta)
        $items = array(
            'Spoofchecker'                  => array('5.4.0', ''),
            'Transliterator'                => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        $release = '5.5.0';       // 2013-06-20 (stable)
        $items = array(
            'IntlBreakIterator'             => array('5.5.0', ''),
            'IntlCalendar'                  => array('5.5.0', ''),
            'IntlCodePointBreakIterator'    => array('5.5.0', ''),
            'IntlGregorianCalendar'         => array('5.5.0', ''),
            'IntlIterator'                  => array('5.5.0', ''),
            'IntlPartsIterator'             => array('5.5.0', ''),
            'IntlRuleBasedBreakIterator'    => array('5.5.0', ''),
            'IntlTimeZone'                  => array('5.5.0', ''),
            'UConverter'                    => array('5.5.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.intl.php
     * @link   http://www.php.net/manual/en/ref.intl.idn.php
     * @link   http://www.php.net/manual/en/ref.intl.grapheme.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $ver = defined('INTL_ICU_VERSION') ? INTL_ICU_VERSION : FALSE;

        $release = '1.0.0beta';   // 2007-12-06 (beta)
        $items = array(
            'collator_asort'                    => array('5.2.0', ''),
            'collator_compare'                  => array('5.2.0', ''),
            'collator_create'                   => array('5.2.0', ''),
            'collator_get_attribute'            => array('5.2.0', ''),
            'collator_get_error_code'           => array('5.2.0', ''),
            'collator_get_error_message'        => array('5.2.0', ''),
            'collator_get_locale'               => array('5.2.0', ''),
            'collator_get_strength'             => array('5.2.0', ''),
            'collator_set_attribute'            => array('5.2.0', ''),
            'collator_set_strength'             => array('5.2.0', ''),
            'collator_sort'                     => array('5.2.0', ''),
            'collator_sort_with_sort_keys'      => array('5.2.0', ''),

            'intl_error_name'                   => array('5.2.0', ''),
            'intl_get_error_code'               => array('5.2.0', ''),
            'intl_get_error_message'            => array('5.2.0', ''),
            'intl_is_failure'                   => array('5.2.0', ''),

            'locale_canonicalize'               => array('5.2.0', ''),
            'locale_compose'                    => array('5.2.0', ''),
            'locale_filter_matches'             => array('5.2.0', ''),
            'locale_get_all_variants'           => array('5.2.0', ''),
            'locale_get_default'                => array('5.2.0', ''),
            'locale_get_display_language'       => array('5.2.0', ''),
            'locale_get_display_name'           => array('5.2.0', ''),
            'locale_get_display_region'         => array('5.2.0', ''),
            'locale_get_display_script'         => array('5.2.0', ''),
            'locale_get_display_variant'        => array('5.2.0', ''),
            'locale_get_keywords'               => array('5.2.0', ''),
            'locale_get_primary_language'       => array('5.2.0', ''),
            'locale_get_region'                 => array('5.2.0', ''),
            'locale_get_script'                 => array('5.2.0', ''),
            'locale_lookup'                     => array('5.2.0', ''),
            'locale_parse'                      => array('5.2.0', ''),
            'locale_set_default'                => array('5.2.0', ''),

            'msgfmt_create'                     => array('5.2.0', ''),
            'msgfmt_format'                     => array('5.2.0', ''),
            'msgfmt_format_message'             => array('5.2.0', ''),
            'msgfmt_get_error_code'             => array('5.2.0', ''),
            'msgfmt_get_error_message'          => array('5.2.0', ''),
            'msgfmt_get_locale'                 => array('5.2.0', ''),
            'msgfmt_get_pattern'                => array('5.2.0', ''),
            'msgfmt_parse'                      => array('5.2.0', ''),
            'msgfmt_parse_message'              => array('5.2.0', ''),
            'msgfmt_set_pattern'                => array('5.2.0', ''),

            'normalizer_is_normalized'          => array('5.2.0', ''),
            'normalizer_normalize'              => array('5.2.0', ''),

            'numfmt_create'                     => array('5.2.0', ''),
            'numfmt_format'                     => array('5.2.0', ''),
            'numfmt_format_currency'            => array('5.2.0', ''),
            'numfmt_get_attribute'              => array('5.2.0', ''),
            'numfmt_get_error_code'             => array('5.2.0', ''),
            'numfmt_get_error_message'          => array('5.2.0', ''),
            'numfmt_get_locale'                 => array('5.2.0', ''),
            'numfmt_get_pattern'                => array('5.2.0', ''),
            'numfmt_get_symbol'                 => array('5.2.0', ''),
            'numfmt_get_text_attribute'         => array('5.2.0', ''),
            'numfmt_parse'                      => array('5.2.0', ''),
            'numfmt_parse_currency'             => array('5.2.0', ''),
            'numfmt_set_attribute'              => array('5.2.0', ''),
            'numfmt_set_pattern'                => array('5.2.0', ''),
            'numfmt_set_symbol'                 => array('5.2.0', ''),
            'numfmt_set_text_attribute'         => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.0RC1';    // 2008-05-27 (stable)
        $items = array(
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
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.1';       // 2008-09-12 (stable)
        $items = array(
            'locale_accept_from_http'           => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.2';       // 2009-04-09 (stable)
        $items = array(
            'idn_to_ascii'                      => array('5.2.4', ''),
            'idn_to_utf8'                       => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.3';       // 2009-10-26 (stable)
        $items = array(
            'collator_get_sort_key'             => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.1.0';       // 2010-01-08 (stable)
        $items = array(
            'resourcebundle_count'              => array('5.2.4', ''),
            'resourcebundle_create'             => array('5.2.4', ''),
            'resourcebundle_get'                => array('5.2.4', ''),
            'resourcebundle_get_error_code'     => array('5.2.4', ''),
            'resourcebundle_get_error_message'  => array('5.2.4', ''),
            'resourcebundle_locales'            => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.0b1';     // 2011-11-29 (beta)
        $items = array(
            'transliterator_create'             => array('5.4.0', ''),
            'transliterator_create_from_rules'  => array('5.4.0', ''),
            'transliterator_create_inverse'     => array('5.4.0', ''),
            'transliterator_get_error_code'     => array('5.4.0', ''),
            'transliterator_get_error_message'  => array('5.4.0', ''),
            'transliterator_list_ids'           => array('5.4.0', ''),
            'transliterator_transliterate'      => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.5.0';       // 2013-06-20 (stable)
        $items = array(
            'datefmt_format_object'             => array('5.5.0', ''),
            'datefmt_get_calendar_object'       => array('5.5.0', ''),
            'datefmt_get_timezone'              => array('5.5.0', ''),
            'datefmt_set_timezone'              => array('5.5.0', ''),

            'intlgregcal_create_instance'       => array('5.5.0', ''),
            'intlgregcal_get_gregorian_change'  => array('5.5.0', ''),
            'intlgregcal_is_leap_year'          => array('5.5.0', ''),
            'intlgregcal_set_gregorian_change'  => array('5.5.0', ''),

            'intlcal_add'                       => array('5.5.0', ''),
            'intlcal_after'                     => array('5.5.0', ''),
            'intlcal_before'                    => array('5.5.0', ''),
            'intlcal_clear'                     => array('5.5.0', ''),
            'intlcal_create_instance'           => array('5.5.0', ''),
            'intlcal_equals'                    => array('5.5.0', ''),
            'intlcal_field_difference'          => array('5.5.0', ''),
            'intlcal_from_date_time'            => array('5.5.0', ''),
            'intlcal_get'                       => array('5.5.0', ''),
            'intlcal_get_actual_maximum'        => array('5.5.0', ''),
            'intlcal_get_actual_minimum'        => array('5.5.0', ''),
            'intlcal_get_available_locales'     => array('5.5.0', ''),
            'intlcal_get_day_of_week_type'      => array('5.5.0', ''),
            'intlcal_get_error_code'            => array('5.5.0', ''),
            'intlcal_get_error_message'         => array('5.5.0', ''),
            'intlcal_get_first_day_of_week'     => array('5.5.0', ''),
            'intlcal_get_greatest_minimum'      => array('5.5.0', ''),
            'intlcal_get_keyword_values_for_locale'
                                                => array('5.5.0', ''),
            'intlcal_get_least_maximum'         => array('5.5.0', ''),
            'intlcal_get_locale'                => array('5.5.0', ''),
            'intlcal_get_maximum'               => array('5.5.0', ''),
            'intlcal_get_minimal_days_in_first_week'
                                                => array('5.5.0', ''),
            'intlcal_get_minimum'               => array('5.5.0', ''),
            'intlcal_get_now'                   => array('5.5.0', ''),
            'intlcal_get_time'                  => array('5.5.0', ''),
            'intlcal_get_time_zone'             => array('5.5.0', ''),
            'intlcal_get_type'                  => array('5.5.0', ''),
            'intlcal_get_weekend_transition'    => array('5.5.0', ''),
            'intlcal_in_daylight_time'          => array('5.5.0', ''),
            'intlcal_is_equivalent_to'          => array('5.5.0', ''),
            'intlcal_is_lenient'                => array('5.5.0', ''),
            'intlcal_is_set'                    => array('5.5.0', ''),
            'intlcal_is_weekend'                => array('5.5.0', ''),
            'intlcal_roll'                      => array('5.5.0', ''),
            'intlcal_set'                       => array('5.5.0', ''),
            'intlcal_set_first_day_of_week'     => array('5.5.0', ''),
            'intlcal_set_lenient'               => array('5.5.0', ''),
            'intlcal_set_time'                  => array('5.5.0', ''),
            'intlcal_set_time_zone'             => array('5.5.0', ''),
            'intlcal_to_date_time'              => array('5.5.0', ''),

            'intltz_count_equivalent_ids'       => array('5.5.0', ''),
            'intltz_create_default'             => array('5.5.0', ''),
            'intltz_create_enumeration'         => array('5.5.0', ''),
            'intltz_create_time_zone'           => array('5.5.0', ''),
            'intltz_from_date_time_zone'        => array('5.5.0', ''),
            'intltz_get_canonical_id'           => array('5.5.0', ''),
            'intltz_get_equivalent_id'          => array('5.5.0', ''),
            'intltz_get_gmt'                    => array('5.5.0', ''),
            'intltz_get_display_name'           => array('5.5.0', ''),
            'intltz_get_dst_savings'            => array('5.5.0', ''),
            'intltz_get_error_code'             => array('5.5.0', ''),
            'intltz_get_error_message'          => array('5.5.0', ''),
            'intltz_get_id'                     => array('5.5.0', ''),
            'intltz_get_offset'                 => array('5.5.0', ''),
            'intltz_get_raw_offset'             => array('5.5.0', ''),

            'intltz_get_tz_data_version'        => array('5.5.0', ''),
            'intltz_has_same_rules'             => array('5.5.0', ''),
            'intltz_to_date_time_zone'          => array('5.5.0', ''),
            'intltz_use_daylight_time'          => array('5.5.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        if (version_compare($ver, '4.8', 'ge')) {
            // requires libicu >= 4.8
            $items = array(
                'intltz_create_time_zone_id_enumeration'
                                                => array('5.5.0', ''),
                'intltz_get_region'             => array('5.5.0', ''),
            );
            $this->applyFilter($release, $items, $functions);
        }
        if (version_compare($ver, '49', 'ge')) {
            // requires libicu >= 49 (version scheme change 4.9 become 49)
            $items = array(
                'intltz_get_unknown'            => array('5.5.0', ''),
                'intlcal_get_repeated_wall_time_option'
                                                => array('5.5.0', ''),
                'intlcal_get_skipped_wall_time_option'
                                                => array('5.5.0', ''),
                'intlcal_set_repeated_wall_time_option'
                                                => array('5.5.0', ''),
                'intlcal_set_skipped_wall_time_option'
                                                => array('5.5.0', ''),
            );
            $this->applyFilter($release, $items, $functions);
        }

        $release = '5.5.1';       // 2013-07-18 (stable)
        $items = array(
            'intlcal_set_minimal_days_in_first_week'
                                                => array('5.5.1', ''),
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

        $ver = defined('INTL_ICU_VERSION') ? INTL_ICU_VERSION : FALSE;

        $release = '1.0.0beta';   // 2007-12-06 (beta)
        $items = array(
            'ULOC_ACTUAL_LOCALE'                => array('5.2.0', ''),
            'ULOC_VALID_LOCALE'                 => array('5.2.0', ''),

            // Warnings
            'U_USING_FALLBACK_WARNING'          => array('5.2.0', ''),
            'U_ERROR_WARNING_START'             => array('5.2.0', ''),
            'U_USING_DEFAULT_WARNING'           => array('5.2.0', ''),
            'U_SAFECLONE_ALLOCATED_WARNING'     => array('5.2.0', ''),
            'U_STATE_OLD_WARNING'               => array('5.2.0', ''),
            'U_STRING_NOT_TERMINATED_WARNING'   => array('5.2.0', ''),
            'U_SORT_KEY_TOO_SHORT_WARNING'      => array('5.2.0', ''),
            'U_AMBIGUOUS_ALIAS_WARNING'         => array('5.2.0', ''),
            'U_DIFFERENT_UCA_VERSION'           => array('5.2.0', ''),
            'U_ERROR_WARNING_LIMIT'             => array('5.2.0', ''),

            // Standard errors
            'U_ZERO_ERROR'                      => array('5.2.0', ''),
            'U_ILLEGAL_ARGUMENT_ERROR'          => array('5.2.0', ''),
            'U_MISSING_RESOURCE_ERROR'          => array('5.2.0', ''),
            'U_INVALID_FORMAT_ERROR'            => array('5.2.0', ''),
            'U_FILE_ACCESS_ERROR'               => array('5.2.0', ''),
            'U_INTERNAL_PROGRAM_ERROR'          => array('5.2.0', ''),
            'U_MESSAGE_PARSE_ERROR'             => array('5.2.0', ''),
            'U_MEMORY_ALLOCATION_ERROR'         => array('5.2.0', ''),
            'U_INDEX_OUTOFBOUNDS_ERROR'         => array('5.2.0', ''),
            'U_PARSE_ERROR'                     => array('5.2.0', ''),
            'U_INVALID_CHAR_FOUND'              => array('5.2.0', ''),
            'U_TRUNCATED_CHAR_FOUND'            => array('5.2.0', ''),
            'U_ILLEGAL_CHAR_FOUND'              => array('5.2.0', ''),
            'U_INVALID_TABLE_FORMAT'            => array('5.2.0', ''),
            'U_INVALID_TABLE_FILE'              => array('5.2.0', ''),
            'U_BUFFER_OVERFLOW_ERROR'           => array('5.2.0', ''),
            'U_UNSUPPORTED_ERROR'               => array('5.2.0', ''),
            'U_RESOURCE_TYPE_MISMATCH'          => array('5.2.0', ''),
            'U_ILLEGAL_ESCAPE_SEQUENCE'         => array('5.2.0', ''),
            'U_UNSUPPORTED_ESCAPE_SEQUENCE'     => array('5.2.0', ''),
            'U_NO_SPACE_AVAILABLE'              => array('5.2.0', ''),
            'U_CE_NOT_FOUND_ERROR'              => array('5.2.0', ''),
            'U_PRIMARY_TOO_LONG_ERROR'          => array('5.2.0', ''),
            'U_STATE_TOO_OLD_ERROR'             => array('5.2.0', ''),
            'U_TOO_MANY_ALIASES_ERROR'          => array('5.2.0', ''),
            'U_ENUM_OUT_OF_SYNC_ERROR'          => array('5.2.0', ''),
            'U_INVARIANT_CONVERSION_ERROR'      => array('5.2.0', ''),
            'U_INVALID_STATE_ERROR'             => array('5.2.0', ''),
            'U_COLLATOR_VERSION_MISMATCH'       => array('5.2.0', ''),
            'U_USELESS_COLLATOR_ERROR'          => array('5.2.0', ''),
            'U_NO_WRITE_PERMISSION'             => array('5.2.0', ''),
            'U_STANDARD_ERROR_LIMIT'            => array('5.2.0', ''),

            // The error code range 0x10000 0x10100 are reserved for Transliterator
            'U_BAD_VARIABLE_DEFINITION'         => array('5.2.0', ''),
            'U_PARSE_ERROR_START'               => array('5.2.0', ''),
            'U_MALFORMED_RULE'                  => array('5.2.0', ''),
            'U_MALFORMED_SET'                   => array('5.2.0', ''),
            'U_MALFORMED_SYMBOL_REFERENCE'      => array('5.2.0', ''),
            'U_MALFORMED_UNICODE_ESCAPE'        => array('5.2.0', ''),
            'U_MALFORMED_VARIABLE_DEFINITION'   => array('5.2.0', ''),
            'U_MALFORMED_VARIABLE_REFERENCE'    => array('5.2.0', ''),
            'U_MISMATCHED_SEGMENT_DELIMITERS'   => array('5.2.0', ''),
            'U_MISPLACED_ANCHOR_START'          => array('5.2.0', ''),
            'U_MISPLACED_CURSOR_OFFSET'         => array('5.2.0', ''),
            'U_MISPLACED_QUANTIFIER'            => array('5.2.0', ''),
            'U_MISSING_OPERATOR'                => array('5.2.0', ''),
            'U_MISSING_SEGMENT_CLOSE'           => array('5.2.0', ''),
            'U_MULTIPLE_ANTE_CONTEXTS'          => array('5.2.0', ''),
            'U_MULTIPLE_CURSORS'                => array('5.2.0', ''),
            'U_MULTIPLE_POST_CONTEXTS'          => array('5.2.0', ''),
            'U_TRAILING_BACKSLASH'              => array('5.2.0', ''),
            'U_UNDEFINED_SEGMENT_REFERENCE'     => array('5.2.0', ''),
            'U_UNDEFINED_VARIABLE'              => array('5.2.0', ''),
            'U_UNQUOTED_SPECIAL'                => array('5.2.0', ''),
            'U_UNTERMINATED_QUOTE'              => array('5.2.0', ''),
            'U_RULE_MASK_ERROR'                 => array('5.2.0', ''),
            'U_MISPLACED_COMPOUND_FILTER'       => array('5.2.0', ''),
            'U_MULTIPLE_COMPOUND_FILTERS'       => array('5.2.0', ''),
            'U_INVALID_RBT_SYNTAX'              => array('5.2.0', ''),
            'U_INVALID_PROPERTY_PATTERN'        => array('5.2.0', ''),
            'U_MALFORMED_PRAGMA'                => array('5.2.0', ''),
            'U_UNCLOSED_SEGMENT'                => array('5.2.0', ''),
            'U_ILLEGAL_CHAR_IN_SEGMENT'         => array('5.2.0', ''),
            'U_VARIABLE_RANGE_EXHAUSTED'        => array('5.2.0', ''),
            'U_VARIABLE_RANGE_OVERLAP'          => array('5.2.0', ''),
            'U_ILLEGAL_CHARACTER'               => array('5.2.0', ''),
            'U_INTERNAL_TRANSLITERATOR_ERROR'   => array('5.2.0', ''),
            'U_INVALID_ID'                      => array('5.2.0', ''),
            'U_INVALID_FUNCTION'                => array('5.2.0', ''),
            'U_PARSE_ERROR_LIMIT'               => array('5.2.0', ''),

            // The error code range 0x10100 0x10200 are reserved for formatting API parsing error
            'U_UNEXPECTED_TOKEN'                => array('5.2.0', ''),
            'U_FMT_PARSE_ERROR_START'           => array('5.2.0', ''),
            'U_MULTIPLE_DECIMAL_SEPARATORS'     => array('5.2.0', ''),
            // Typo: kept for backward compatibility. Use U_MULTIPLE_DECIMAL_SEPARATORS
            'U_MULTIPLE_DECIMAL_SEPERATORS'     => array('5.2.0', ''),
            'U_MULTIPLE_EXPONENTIAL_SYMBOLS'    => array('5.2.0', ''),
            'U_MALFORMED_EXPONENTIAL_PATTERN'   => array('5.2.0', ''),
            'U_MULTIPLE_PERCENT_SYMBOLS'        => array('5.2.0', ''),
            'U_MULTIPLE_PERMILL_SYMBOLS'        => array('5.2.0', ''),
            'U_MULTIPLE_PAD_SPECIFIERS'         => array('5.2.0', ''),
            'U_PATTERN_SYNTAX_ERROR'            => array('5.2.0', ''),
            'U_ILLEGAL_PAD_POSITION'            => array('5.2.0', ''),
            'U_UNMATCHED_BRACES'                => array('5.2.0', ''),
            'U_UNSUPPORTED_PROPERTY'            => array('5.2.0', ''),
            'U_UNSUPPORTED_ATTRIBUTE'           => array('5.2.0', ''),
            'U_FMT_PARSE_ERROR_LIMIT'           => array('5.2.0', ''),

            // The error code range 0x10200 0x102ff are reserved for Break Iterator related error
            'U_BRK_INTERNAL_ERROR'              => array('5.2.0', ''),
            'U_BRK_ERROR_START'                 => array('5.2.0', ''),
            'U_BRK_HEX_DIGITS_EXPECTED'         => array('5.2.0', ''),
            'U_BRK_SEMICOLON_EXPECTED'          => array('5.2.0', ''),
            'U_BRK_RULE_SYNTAX'                 => array('5.2.0', ''),
            'U_BRK_UNCLOSED_SET'                => array('5.2.0', ''),
            'U_BRK_ASSIGN_ERROR'                => array('5.2.0', ''),
            'U_BRK_VARIABLE_REDFINITION'        => array('5.2.0', ''),
            'U_BRK_MISMATCHED_PAREN'            => array('5.2.0', ''),
            'U_BRK_NEW_LINE_IN_QUOTED_STRING'   => array('5.2.0', ''),
            'U_BRK_UNDEFINED_VARIABLE'          => array('5.2.0', ''),
            'U_BRK_INIT_ERROR'                  => array('5.2.0', ''),
            'U_BRK_RULE_EMPTY_SET'              => array('5.2.0', ''),
            'U_BRK_UNRECOGNIZED_OPTION'         => array('5.2.0', ''),
            'U_BRK_MALFORMED_RULE_TAG'          => array('5.2.0', ''),
            'U_BRK_ERROR_LIMIT'                 => array('5.2.0', ''),

            // The error codes in the range 0x10300-0x103ff are reserved for regular expression related errrs
            'U_REGEX_INTERNAL_ERROR'            => array('5.2.0', ''),
            'U_REGEX_ERROR_START'               => array('5.2.0', ''),
            'U_REGEX_RULE_SYNTAX'               => array('5.2.0', ''),
            'U_REGEX_INVALID_STATE'             => array('5.2.0', ''),
            'U_REGEX_BAD_ESCAPE_SEQUENCE'       => array('5.2.0', ''),
            'U_REGEX_PROPERTY_SYNTAX'           => array('5.2.0', ''),
            'U_REGEX_UNIMPLEMENTED'             => array('5.2.0', ''),
            'U_REGEX_MISMATCHED_PAREN'          => array('5.2.0', ''),
            'U_REGEX_NUMBER_TOO_BIG'            => array('5.2.0', ''),
            'U_REGEX_BAD_INTERVAL'              => array('5.2.0', ''),
            'U_REGEX_MAX_LT_MIN'                => array('5.2.0', ''),
            'U_REGEX_INVALID_BACK_REF'          => array('5.2.0', ''),
            'U_REGEX_INVALID_FLAG'              => array('5.2.0', ''),
            'U_REGEX_LOOK_BEHIND_LIMIT'         => array('5.2.0', ''),
            'U_REGEX_SET_CONTAINS_STRING'       => array('5.2.0', ''),
            'U_REGEX_ERROR_LIMIT'               => array('5.2.0', ''),

            // Aliases for StringPrep
            'U_STRINGPREP_PROHIBITED_ERROR'     => array('5.2.0', ''),
            'U_STRINGPREP_UNASSIGNED_ERROR'     => array('5.2.0', ''),
            'U_STRINGPREP_CHECK_BIDI_ERROR'     => array('5.2.0', ''),

            'U_ERROR_LIMIT'                     => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        if (version_compare($ver, '4.6.0', 'ge')) {
            // requires libicu >= 4.6
            $items = array(
                // The error code in the range 0x10400-0x104ff are reserved for IDNA related error codes
                'U_IDNA_PROHIBITED_ERROR'       => array('5.2.0', ''),
                'U_IDNA_ERROR_START'            => array('5.2.0', ''),
                'U_IDNA_UNASSIGNED_ERROR'       => array('5.2.0', ''),
                'U_IDNA_CHECK_BIDI_ERROR'       => array('5.2.0', ''),
                'U_IDNA_STD3_ASCII_RULES_ERROR' => array('5.2.0', ''),
                'U_IDNA_ACE_PREFIX_ERROR'       => array('5.2.0', ''),
                'U_IDNA_VERIFICATION_ERROR'     => array('5.2.0', ''),
                'U_IDNA_LABEL_TOO_LONG_ERROR'   => array('5.2.0', ''),
                'U_IDNA_ZERO_LENGTH_LABEL_ERROR'
                                                => array('5.2.0', ''),
                'U_IDNA_ERROR_LIMIT'            => array('5.2.0', ''),
            );
            $this->applyFilter($release, $items, $constants);
        }

        $release = '1.0.0RC1';    // 2008-05-27 (stable)
        $items = array(
            'GRAPHEME_EXTR_COUNT'               => array('5.2.4', ''),
            'GRAPHEME_EXTR_MAXBYTES'            => array('5.2.4', ''),
            'GRAPHEME_EXTR_MAXCHARS'            => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '1.0.2';       // 2009-04-09 (stable)
        $items = array(
            'IDNA_ALLOW_UNASSIGNED'             => array('5.2.4', ''),
            'IDNA_DEFAULT'                      => array('5.2.4', ''),
            'IDNA_USE_STD3_RULES'               => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '2.0.0b1';     // 2011-11-29 (beta)
        $items = array(
            'INTL_ICU_VERSION'                  => array('5.3.7', ''),

            'INTL_IDNA_VARIANT_2003'            => array('5.4.0', ''),

            'INTL_MAX_LOCALE_LEN'               => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $constants);

        if (version_compare($ver, '3.8.0', 'ge')) {
            // requires libicu >= 3.8
            $items = array(
                'U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR' => array('5.4.0', ''),
            );
            $this->applyFilter($release, $items, $constants);
        }

        if (version_compare($ver, '4.6.0', 'ge')) {
            // requires libicu >= 4.6
            $items = array(
                'INTL_ICU_DATA_VERSION'             => array('5.3.7', ''),

                'IDNA_CHECK_BIDI'                   => array('5.4.0', ''),
                'IDNA_CHECK_CONTEXTJ'               => array('5.4.0', ''),

                'IDNA_NONTRANSITIONAL_TO_ASCII'     => array('5.4.0', ''),
                'IDNA_NONTRANSITIONAL_TO_UNICODE'   => array('5.4.0', ''),

                'IDNA_ERROR_EMPTY_LABEL'            => array('5.4.0', ''),
                'IDNA_ERROR_LABEL_TOO_LONG'         => array('5.4.0', ''),
                'IDNA_ERROR_DOMAIN_NAME_TOO_LONG'   => array('5.4.0', ''),
                'IDNA_ERROR_LEADING_HYPHEN'         => array('5.4.0', ''),
                'IDNA_ERROR_TRAILING_HYPHEN'        => array('5.4.0', ''),
                'IDNA_ERROR_HYPHEN_3_4'             => array('5.4.0', ''),
                'IDNA_ERROR_LEADING_COMBINING_MARK' => array('5.4.0', ''),
                'IDNA_ERROR_DISALLOWED'             => array('5.4.0', ''),
                'IDNA_ERROR_PUNYCODE'               => array('5.4.0', ''),
                'IDNA_ERROR_LABEL_HAS_DOT'          => array('5.4.0', ''),
                'IDNA_ERROR_INVALID_ACE_LABEL'      => array('5.4.0', ''),
                'IDNA_ERROR_BIDI'                   => array('5.4.0', ''),
                'IDNA_ERROR_CONTEXTJ'               => array('5.4.0', ''),

                'INTL_IDNA_VARIANT_UTS46'           => array('5.4.0', ''),
            );
            $this->applyFilter($release, $items, $constants);
        }

        return $constants;
    }

}
