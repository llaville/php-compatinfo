<?php
/**
 * Unit tests for PHP_CompatInfo, gd extension Reference
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
 * about gd extension
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
class GdExtensionTest extends GenericTest
{
    const EXTNAME = 'Gd';

    /**
     * Sets up the shared fixture.
     *
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

        parent::setUpBeforeClass();
    }
}
