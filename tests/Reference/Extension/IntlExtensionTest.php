<?php
/**
 * Unit tests for PHP_CompatInfo, intl extension Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.0.0
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;
use Bartlett\CompatInfo\Reference\Extension\IntlExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about intl extension
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 */
class IntlExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (PATH_SEPARATOR == ';') {
            // Win*
            self::$optionalclasses  = array('IntlException');

            if (version_compare(PHP_VERSION, '5.4.0', 'lt')) {

                self::$optionalconstants = array(
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
                );
            }
        }

        self::$optionalcfgs = array(
            'intl.use_exceptions'
        );

        self::$obj = new IntlExtension();
        parent::setUpBeforeClass();
    }
}
