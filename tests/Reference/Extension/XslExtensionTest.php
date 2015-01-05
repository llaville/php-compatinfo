<?php
/**
 * Unit tests for PHP_CompatInfo, xsl extension Reference
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

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about xsl extension
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
class XslExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        if (version_compare(PHP_VERSION, '5.3.3', 'eq')) {
            // Security fix backported in PHP 5.3.3 / RHEL-6
            self::$ignoredcfgs = array(
                'xsl.security_prefs',
            );
            self::$ignoredconstants = array(
                'XSL_SECPREF_CREATE_DIRECTORY',
                'XSL_SECPREF_DEFAULT',
                'XSL_SECPREF_NONE',
                'XSL_SECPREF_READ_FILE',
                'XSL_SECPREF_READ_NETWORK',
                'XSL_SECPREF_WRITE_FILE',
                'XSL_SECPREF_WRITE_NETWORK',
            );
        }
        self::$ext = 'XslExtension';
        parent::setUpBeforeClass();
    }
}
