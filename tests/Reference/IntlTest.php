<?php
/**
 * Unit tests for PHP_CompatInfo package, Intl Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Intl extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class PHP_CompatInfo_Reference_IntlTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_Intl::getExtensions
     * @covers PHP_CompatInfo_Reference_Intl::getFunctions
     * @covers PHP_CompatInfo_Reference_Intl::getConstants
     * @covers PHP_CompatInfo_Reference_Intl::getClasses
     * @return void
     */
    protected function setUp()
    {
        if (!defined('INTL_ICU_VERSION')) {
            define('INTL_ICU_VERSION', false);
        }

        if (PATH_SEPARATOR == ';') {
            // Win*
            $this->optionalclasses  = array('IntlException');
            $this->ignoredfunctions = array(
                'intltz_get_unknown',
                'intlcal_get_repeated_wall_time_option',
                'intlcal_get_skipped_wall_time_option',
                'intlcal_set_repeated_wall_time_option',
                'intlcal_set_skipped_wall_time_option',
            );
        }

        if (version_compare(INTL_ICU_VERSION, '3.8.0', 'lt')) {
            // requires libicu >= 3.8
            $this->optionalconstants = array_merge(
                $this->optionalconstants,
                array(
                    'U_IDNA_DOMAIN_NAME_TOO_LONG_ERROR',
                )
            );
        }

        /*
            On Windows platform extension intl 1.1.0 :
                - uses libicu 4.6.1   for PHP 5.4.1 or greater
                - uses libicu 4.2.0.1 for PHP 5.4.0
                - uses libicu 4.6.1   for PHP 5.3.10 or greater but without optional constants below
         */
        $onWindowsPHP_5_3 = (version_compare(PHP_VERSION, '5.4.0', 'lt') && (DIRECTORY_SEPARATOR == '\\'));

        if (version_compare(INTL_ICU_VERSION, '4.6.0', 'lt') || $onWindowsPHP_5_3) {
            // requires libicu >= 4.6
            $this->optionalconstants = array_merge(
                $this->optionalconstants,
                array(
                    'INTL_ICU_DATA_VERSION',

                    'U_IDNA_PROHIBITED_ERROR',
                    'U_IDNA_ERROR_START',
                    'U_IDNA_UNASSIGNED_ERROR',
                    'U_IDNA_CHECK_BIDI_ERROR',
                    'U_IDNA_STD3_ASCII_RULES_ERROR',
                    'U_IDNA_ACE_PREFIX_ERROR',
                    'U_IDNA_VERIFICATION_ERROR',
                    'U_IDNA_LABEL_TOO_LONG_ERROR',
                    'U_IDNA_ZERO_LENGTH_LABEL_ERROR',
                    'U_IDNA_ERROR_LIMIT',

                    'IDNA_CHECK_BIDI',
                    'IDNA_CHECK_CONTEXTJ',

                    'IDNA_NONTRANSITIONAL_TO_ASCII',
                    'IDNA_NONTRANSITIONAL_TO_UNICODE',

                    'IDNA_ERROR_EMPTY_LABEL',
                    'IDNA_ERROR_LABEL_TOO_LONG',
                    'IDNA_ERROR_DOMAIN_NAME_TOO_LONG',
                    'IDNA_ERROR_LEADING_HYPHEN',
                    'IDNA_ERROR_TRAILING_HYPHEN',
                    'IDNA_ERROR_HYPHEN_3_4',
                    'IDNA_ERROR_LEADING_COMBINING_MARK',
                    'IDNA_ERROR_DISALLOWED',
                    'IDNA_ERROR_PUNYCODE',
                    'IDNA_ERROR_LABEL_HAS_DOT',
                    'IDNA_ERROR_INVALID_ACE_LABEL',
                    'IDNA_ERROR_BIDI',
                    'IDNA_ERROR_CONTEXTJ',

                    'INTL_IDNA_VARIANT_UTS46',
                )
            );

            if ($onWindowsPHP_5_3) {
                // one more exception on windows for PHP 5.3
                $this->optionalconstants[] = 'INTL_IDNA_VARIANT_2003';
            }
        }

        $this->obj = new PHP_CompatInfo_Reference_Intl();
        parent::setUp();
    }
}
