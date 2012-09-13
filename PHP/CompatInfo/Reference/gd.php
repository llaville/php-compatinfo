<?php
/**
 * Version informations about gd extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about gd extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.image.php
 */
class PHP_CompatInfo_Reference_Gd
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'gd';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '';

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
        $phpMin = '4.0.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
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
     * @link   http://www.php.net/manual/en/ref.image.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'gd_info'                        => array('4.3.0', ''),
            'image2wbmp'                     => array('4.0.5', ''),
            'imagealphablending'             => array('4.0.6', ''),
            'imageantialias'                 => array('4.3.2', ''),
            'imagearc'                       => array('4.0.0', ''),
            'imagechar'                      => array('4.0.0', ''),
            'imagecharup'                    => array('4.0.0', ''),
            'imagecolorallocate'             => array('4.0.0', ''),
            'imagecolorallocatealpha'        => array('4.3.2', ''),
            'imagecolorat'                   => array('4.0.0', ''),
            'imagecolorclosest'              => array('4.0.0', ''),
            'imagecolorclosestalpha'         => array('4.0.6', ''),
            'imagecolorclosesthwb'           => array('4.0.1', ''),
            'imagecolordeallocate'           => array('4.0.0', ''),
            'imagecolorexact'                => array('4.0.0', ''),
            'imagecolorexactalpha'           => array('4.0.6', ''),
            'imagecolormatch'                => array('4.3.0', ''),
            'imagecolorresolve'              => array('4.0.0', ''),
            'imagecolorresolvealpha'         => array('4.0.6', ''),
            'imagecolorset'                  => array('4.0.0', ''),
            'imagecolorsforindex'            => array('4.0.0', ''),
            'imagecolorstotal'               => array('4.0.0', ''),
            'imagecolortransparent'          => array('4.0.0', ''),
            'imageconvolution'               => array('5.1.0', ''),
            'imagecopy'                      => array('4.0.0', ''),
            'imagecopymerge'                 => array('4.0.1', ''),
            'imagecopymergegray'             => array('4.0.6', ''),
            'imagecopyresampled'             => array('4.0.6', ''),
            'imagecopyresized'               => array('4.0.0', ''),
            'imagecreate'                    => array('4.0.0', ''),
            'imagecreatefromgd'              => array('4.0.7', ''),
            'imagecreatefromgd2'             => array('4.0.7', ''),
            'imagecreatefromgd2part'         => array('4.0.7', ''),
            'imagecreatefromgif'             => array('4.0.0', ''),
            'imagecreatefromjpeg'            => array('4.0.0', ''),
            'imagecreatefrompng'             => array('4.0.0', ''),
            'imagecreatefromstring'          => array('4.0.4', ''),
            'imagecreatefromwbmp'            => array('4.0.1', ''),
            'imagecreatefromxbm'             => array('4.0.1', ''),
            'imagecreatefromxpm'             => array('4.0.1', ''),
            'imagecreatetruecolor'           => array('4.0.6', ''),
            'imagecreatefromwebp'            => array('5.4.0', ''),
            'imagewebp'                      => array('5.4.0', ''),
            'imagedashedline'                => array('4.0.0', ''),
            'imagedestroy'                   => array('4.0.0', ''),
            'imageellipse'                   => array('4.0.6', ''),
            'imagefill'                      => array('4.0.0', ''),
            'imagefilledarc'                 => array('4.0.6', ''),
            'imagefilledellipse'             => array('4.0.6', ''),
            'imagefilledpolygon'             => array('4.0.0', ''),
            'imagefilledrectangle'           => array('4.0.0', ''),
            'imagefilltoborder'              => array('4.0.0', ''),
            'imagefilter'                    => array('5.0.0', ''),
            'imagefontheight'                => array('4.0.0', ''),
            'imagefontwidth'                 => array('4.0.0', ''),
            'imageftbbox'                    => array('4.0.7', ''),
            'imagefttext'                    => array('4.0.7', ''),
            'imagegammacorrect'              => array('4.0.0', ''),
            'imagegd'                        => array('4.0.7', ''),
            'imagegd2'                       => array('4.0.7', ''),
            'imagegif'                       => array('4.0.0', ''),
            'imagegrabscreen'                => array('5.2.2', ''),
            'imagegrabwindow'                => array('5.2.2', ''),
            'imageinterlace'                 => array('4.0.0', ''),
            'imageistruecolor'               => array('4.3.2', ''),
            'imagejpeg'                      => array('4.0.0', ''),
            'imagelayereffect'               => array('4.3.0', ''),
            'imageline'                      => array('4.0.0', ''),
            'imageloadfont'                  => array('4.0.0', ''),
            'imagepalettecopy'               => array('4.0.1', ''),
            'imagepng'                       => array('4.0.0', ''),
            'imagepolygon'                   => array('4.0.0', ''),
            'imagepsbbox'                    => array('4.0.0', ''),
            'imagepsencodefont'              => array('4.0.0', ''),
            'imagepsextendfont'              => array('4.0.0', ''),
            'imagepsfreefont'                => array('4.0.0', ''),
            'imagepsloadfont'                => array('4.0.0', ''),
            'imagepsslantfont'               => array('4.0.0', ''),
            'imagepstext'                    => array('4.0.0', ''),
            'imagerectangle'                 => array('4.0.0', ''),
            'imagerotate'                    => array('4.3.0', ''),
            'imagesavealpha'                 => array('4.3.2', ''),
            'imagesetbrush'                  => array('4.0.6', ''),
            'imagesetpixel'                  => array('4.0.0', ''),
            'imagesetstyle'                  => array('4.0.6', ''),
            'imagesetthickness'              => array('4.0.6', ''),
            'imagesettile'                   => array('4.0.6', ''),
            'imagestring'                    => array('4.0.0', ''),
            'imagestringup'                  => array('4.0.0', ''),
            'imagesx'                        => array('4.0.0', ''),
            'imagesy'                        => array('4.0.0', ''),
            'imagetruecolortopalette'        => array('4.0.6', ''),
            'imagettfbbox'                   => array('4.0.0', ''),
            'imagettftext'                   => array('4.0.0', ''),
            'imagetypes'                     => array('4.0.2', ''),
            'imagewbmp'                      => array('4.0.1', ''),
            'imagexbm'                       => array('5.0.0', ''),
            'jpeg2wbmp'                      => array('4.0.5', ''),
            'png2wbmp'                       => array('4.0.5', ''),
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
     * @link   http://www.php.net/manual/en/image.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'GD_BUNDLED'                     => array('4.0.0', ''),
            'GD_EXTRA_VERSION'               => array('5.2.4', ''),
            'GD_MAJOR_VERSION'               => array('5.2.4', ''),
            'GD_MINOR_VERSION'               => array('5.2.4', ''),
            'GD_RELEASE_VERSION'             => array('5.2.4', ''),
            'GD_VERSION'                     => array('5.2.4', ''),
            'IMG_ARC_CHORD'                  => array('4.0.0', ''),
            'IMG_ARC_EDGED'                  => array('4.0.0', ''),
            'IMG_ARC_NOFILL'                 => array('4.0.0', ''),
            'IMG_ARC_PIE'                    => array('4.0.0', ''),
            'IMG_ARC_ROUNDED'                => array('4.0.0', ''),
            'IMG_COLOR_BRUSHED'              => array('4.0.0', ''),
            'IMG_COLOR_STYLED'               => array('4.0.0', ''),
            'IMG_COLOR_STYLEDBRUSHED'        => array('4.0.0', ''),
            'IMG_COLOR_TILED'                => array('4.0.0', ''),
            'IMG_COLOR_TRANSPARENT'          => array('4.0.0', ''),
            'IMG_EFFECT_ALPHABLEND'          => array('4.0.0', ''),
            'IMG_EFFECT_NORMAL'              => array('4.0.0', ''),
            'IMG_EFFECT_OVERLAY'             => array('4.0.0', ''),
            'IMG_EFFECT_REPLACE'             => array('4.0.0', ''),
            'IMG_FILTER_BRIGHTNESS'          => array('4.0.0', ''),
            'IMG_FILTER_COLORIZE'            => array('4.0.0', ''),
            'IMG_FILTER_CONTRAST'            => array('4.0.0', ''),
            'IMG_FILTER_EDGEDETECT'          => array('4.0.0', ''),
            'IMG_FILTER_EMBOSS'              => array('4.0.0', ''),
            'IMG_FILTER_GAUSSIAN_BLUR'       => array('4.0.0', ''),
            'IMG_FILTER_GRAYSCALE'           => array('4.0.0', ''),
            'IMG_FILTER_MEAN_REMOVAL'        => array('4.0.0', ''),
            'IMG_FILTER_NEGATE'              => array('4.0.0', ''),
            'IMG_FILTER_PIXELATE'            => array('5.3.0', ''),
            'IMG_FILTER_SELECTIVE_BLUR'      => array('4.0.0', ''),
            'IMG_FILTER_SMOOTH'              => array('4.0.0', ''),
            'IMG_GD2_COMPRESSED'             => array('4.0.0', ''),
            'IMG_GD2_RAW'                    => array('4.0.0', ''),
            'IMG_GIF'                        => array('4.0.0', ''),
            'IMG_JPEG'                       => array('4.0.0', ''),
            'IMG_JPG'                        => array('4.0.0', ''),
            'IMG_PNG'                        => array('4.0.0', ''),
            'IMG_WBMP'                       => array('4.0.0', ''),
            'IMG_XPM'                        => array('4.0.0', ''),
            'PNG_ALL_FILTERS'                => array('4.0.0', ''),
            'PNG_FILTER_AVG'                 => array('4.0.0', ''),
            'PNG_FILTER_NONE'                => array('4.0.0', ''),
            'PNG_FILTER_PAETH'               => array('4.0.0', ''),
            'PNG_FILTER_SUB'                 => array('4.0.0', ''),
            'PNG_FILTER_UP'                  => array('4.0.0', ''),
            'PNG_NO_FILTER'                  => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
