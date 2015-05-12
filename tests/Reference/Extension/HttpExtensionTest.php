<?php
/**
 * Unit tests for PHP_CompatInfo, http extension Reference
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
 * @since      Class available since Release 3.0.0RC1
 */

namespace Bartlett\Tests\CompatInfo\Reference\Extension;

use Bartlett\Tests\CompatInfo\Reference\GenericTest;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about http extension
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
class HttpExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
            // PHP_HTTP_CURL_VERSION(7,34,0)
            'http\\Client\\Curl\\SSL_VERSION_TLSv1_0',
            'http\\Client\\Curl\\SSL_VERSION_TLSv1_1',
            'http\\Client\\Curl\\SSL_VERSION_TLSv1_2',
            // PHP_HTTP_CURL_VERSION(7,38,0)
            'http\\Client\\Curl\\AUTH_SPNEGO',
        );
        self::$ext = 'Http';
        parent::setUpBeforeClass();

        if (!is_null(self::$obj)) {
            $currentVersion = self::$obj->getCurrentVersion();

            // platform dependant
            if (version_compare($currentVersion, '2.0.0', 'lt')) {
                // v1, so all v2 releases are optionals
                $releases = array_keys(self::$obj->getReleases());
                foreach ($releases as $rel_version) {
                    if (version_compare($rel_version, '2.0.0', 'ge')) {
                        array_push(self::$optionalreleases, $rel_version);
                    }
                }
            } else {
                // v2, so all v1 releases must not be checked
                self::$optionalreleases = array(
                    '0.7.0',
                    '1.0.0',
                    '1.3.0',
                    '1.5.0',
                    '1.7.0',
                );
            }
        }
    }
}
