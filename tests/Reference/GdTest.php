<?php
/**
 * Unit tests for PHP_CompatInfo package, Gd Reference
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
 * @since      Class available since Release 2.0.0RC4
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about Gd extension
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
class PHP_CompatInfo_Reference_GdTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the shared fixture.
     *
     * @covers PHP_CompatInfo_Reference_Gd::getExtensions
     * @covers PHP_CompatInfo_Reference_Gd::getFunctions
     * @covers PHP_CompatInfo_Reference_Gd::getConstants
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$optionalfunctions = array(
            // Win32 only
            'imagegrabscreen',
            'imagegrabwindow',
            // requires HAVE_GD_WEBP, (Win32 only in PHP 5.4)
            'imagecreatefromwebp',
            'imagewebp',
            // requires HAVE_COLORCLOSESTHWB
            'imagecolorclosesthwb',
            // requires HAVE_LIBT1
            'imagepsbbox',
            'imagepsencodefont',
            'imagepsextendfont',
            'imagepsfreefont',
            'imagepsloadfont',
            'imagepsslantfont',
            'imagepstext',
            // requires HAVE_GD_XPM (linux only)
            'imagecreatefromxpm',
        );
        if (defined('GD_BUNDLED') && ! GD_BUNDLED) {
            self::$optionalfunctions[] = 'imageantialias';
        }
        self::$obj = new PHP_CompatInfo_Reference_Gd();
        parent::setUpBeforeClass();
    }
}
