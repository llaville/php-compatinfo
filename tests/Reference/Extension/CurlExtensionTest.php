<?php
/**
 * Unit tests for PHP_CompatInfo, curl extension Reference
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
use Bartlett\CompatInfo\Reference\Extension\CurlExtension;

/**
 * Tests for PHP_CompatInfo, retrieving components informations
 * about curl extension
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
class CurlExtensionTest extends GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalconstants = array(
            'CURLOPT_MUTE',
            'CURLOPT_PASSWDFUNCTION',
        );

        if (PATH_SEPARATOR == ';') {
            // Win*
            if (version_compare(PHP_VERSION, '5.6.0alpha1', 'ge')) {
                // PHP 5.6
                array_push(self::$optionalconstants,
                    'CURLCLOSEPOLICY_CALLBACK',
                    'CURLCLOSEPOLICY_LEAST_RECENTLY_USED',
                    'CURLCLOSEPOLICY_LEAST_TRAFFIC',
                    'CURLCLOSEPOLICY_OLDEST',
                    'CURLCLOSEPOLICY_SLOWEST',
                    'CURLOPT_CLOSEPOLICY'
                );
            }
        }

        self::$obj = new CurlExtension();
        parent::setUpBeforeClass();
    }
}
