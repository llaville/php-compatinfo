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
 * @version  GIT: $Id$
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

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'imagearc'                       => array('4.0.0', ''),
            'imagechar'                      => array('4.0.0', ''),
            'imagecharup'                    => array('4.0.0', ''),
            'imagecolorallocate'             => array('4.0.0', ''),
            'imagecolorat'                   => array('4.0.0', ''),
            'imagecolorclosest'              => array('4.0.0', ''),
            'imagecolordeallocate'           => array('4.0.0', ''),
            'imagecolorexact'                => array('4.0.0', ''),
            'imagecolorresolve'              => array('4.0.0', ''),
            'imagecolorset'                  => array('4.0.0', ''),
            'imagecolorsforindex'            => array('4.0.0', ''),
            'imagecolorstotal'               => array('4.0.0', ''),
            'imagecolortransparent'          => array('4.0.0', ''),
            'imagecopy'                      => array('4.0.0', ''),
            'imagecopyresized'               => array('4.0.0', ''),
            'imagecreate'                    => array('4.0.0', ''),
            'imagecreatefromgif'             => array('4.0.0', ''),
            'imagecreatefromjpeg'            => array('4.0.0', ''),
            'imagecreatefrompng'             => array('4.0.0', ''),
            'imagedashedline'                => array('4.0.0', ''),
            'imagedestroy'                   => array('4.0.0', ''),
            'imagefill'                      => array('4.0.0', ''),
            'imagefilledpolygon'             => array('4.0.0', ''),
            'imagefilledrectangle'           => array('4.0.0', ''),
            'imagefilltoborder'              => array('4.0.0', ''),
            'imagefontheight'                => array('4.0.0', ''),
            'imagefontwidth'                 => array('4.0.0', ''),
            'imagegif'                       => array('4.0.0', ''),
            'imageinterlace'                 => array('4.0.0', ''),
            'imagegammacorrect'              => array('4.0.0', ''),
            'imagejpeg'                      => array('4.0.0', ''),
            'imageline'                      => array('4.0.0', ''),
            'imageloadfont'                  => array('4.0.0', ''),
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
            'imagesetpixel'                  => array('4.0.0', ''),
            'imagestring'                    => array('4.0.0', ''),
            'imagestringup'                  => array('4.0.0', ''),
            'imagesx'                        => array('4.0.0', ''),
            'imagesy'                        => array('4.0.0', ''),
            'imagettfbbox'                   => array('4.0.0', ''),
            'imagettftext'                   => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.1';       // 2000-06-28 (stable)
        $items = array(
            'imagecolorclosesthwb'           => array('4.0.1', ''),
            'imagecreatefromwbmp'            => array('4.0.1', ''),
            'imagecreatefromxbm'             => array('4.0.1', ''),
            'imagecreatefromxpm'             => array('4.0.1', ''),
            'imagecopymerge'                 => array('4.0.1', ''),
            'imagepalettecopy'               => array('4.0.1', ''),
            'imagewbmp'                      => array('4.0.1', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.2';       // 2000-08-29 (stable)
        $items = array(
            'imagetypes'                     => array('4.0.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.4';       // 2000-12-19 (stable)
        $items = array(
            'imagecreatefromstring'          => array('4.0.4', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.5';       // 2001-04-30 (stable)
        $items = array(
            'image2wbmp'                     => array('4.0.5', ''),
            'jpeg2wbmp'                      => array('4.0.5', ''),
            'png2wbmp'                       => array('4.0.5', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.6';       // 2001-06-23 (stable)
        $items = array(
            'imagealphablending'             => array('4.0.6', ''),
            'imagecolorclosestalpha'         => array('4.0.6', ''),
            'imagecolorexactalpha'           => array('4.0.6', ''),
            'imagecolorresolvealpha'         => array('4.0.6', ''),
            'imagecopymergegray'             => array('4.0.6', ''),
            'imagecopyresampled'             => array('4.0.6', ''),
            'imagecreatetruecolor'           => array('4.0.6', ''),
            'imageellipse'                   => array('4.0.6', ''),
            'imagefilledarc'                 => array('4.0.6', ''),
            'imagefilledellipse'             => array('4.0.6', ''),
            'imagesetbrush'                  => array('4.0.6', ''),
            'imagesetstyle'                  => array('4.0.6', ''),
            'imagesetthickness'              => array('4.0.6', ''),
            'imagesettile'                   => array('4.0.6', ''),
            'imagetruecolortopalette'        => array('4.0.6', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.7';       //
        $items = array(
            'imagecreatefromgd'              => array('4.0.7', ''),
            'imagecreatefromgd2'             => array('4.0.7', ''),
            'imagecreatefromgd2part'         => array('4.0.7', ''),
            'imageftbbox'                    => array('4.0.7', ''),
            'imagefttext'                    => array('4.0.7', ''),
            'imagegd'                        => array('4.0.7', ''),
            'imagegd2'                       => array('4.0.7', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.3.0';       // 2002-12-27 (stable)
        $items = array(
            'gd_info'                        => array('4.3.0', ''),
            'imagecolormatch'                => array('4.3.0', ''),
            'imagelayereffect'               => array('4.3.0', ''),
            'imagerotate'                    => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.3.2';       // 2003-05-29 (stable)
        $items = array(
            'imageantialias'                 => array('4.3.2', ''),
            'imagecolorallocatealpha'        => array('4.3.2', ''),
            'imageistruecolor'               => array('4.3.2', ''),
            'imagesavealpha'                 => array('4.3.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.0.0';       // 2004-07-13 (stable)
        $items = array(
            'imagefilter'                    => array('5.0.0', ''),
            'imagexbm'                       => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.1.0';       // 2005-11-24 (stable)
        $items = array(
            'imageconvolution'               => array('5.1.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.2.2';       //
        $items = array(
            'imagegrabscreen'                => array('5.2.2', ''),
            'imagegrabwindow'                => array('5.2.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.4.0';       // 2012-03-01 (stable)
        $items = array(
            'imagecreatefromwebp'            => array('5.4.0', ''),
            'imagewebp'                      => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '5.5.0';       // 2013-06-20 (stable)
        $items = array(
            'imageaffine'                    => array('5.5.0', ''),
            'imageaffinematrixconcat'        => array('5.5.0', ''),
            'imageaffinematrixget'           => array('5.5.0', ''),
            'imagecrop'                      => array('5.5.0', ''),
            'imagecropauto'                  => array('5.5.0', ''),
            'imageflip'                      => array('5.5.0', ''),
            'imagepalettetotruecolor'        => array('5.5.0', ''),
            'imagescale'                     => array('5.5.0', ''),
            'imagesetinterpolation'          => array('5.5.0', ''),
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

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'GD_BUNDLED'                     => array('4.0.0', ''),
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

        $release = '5.2.4';       // 2007-08-30 (stable)
        $items = array(
            'GD_EXTRA_VERSION'               => array('5.2.4', ''),
            'GD_MAJOR_VERSION'               => array('5.2.4', ''),
            'GD_MINOR_VERSION'               => array('5.2.4', ''),
            'GD_RELEASE_VERSION'             => array('5.2.4', ''),
            'GD_VERSION'                     => array('5.2.4', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.3.0';       // 2009-06-30 (stable)
        $items = array(
            'IMG_FILTER_PIXELATE'            => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '5.5.0';       // 2013-06-20 (stable)
        $items = array(
            'IMG_AFFINE_ROTATE'              => array('5.5.0', ''),
            'IMG_AFFINE_SCALE'               => array('5.5.0', ''),
            'IMG_AFFINE_SHEAR_HORIZONTAL'    => array('5.5.0', ''),
            'IMG_AFFINE_SHEAR_VERTICAL'      => array('5.5.0', ''),
            'IMG_AFFINE_TRANSLATE'           => array('5.5.0', ''),
            'IMG_BELL'                       => array('5.5.0', ''),
            'IMG_BESSEL'                     => array('5.5.0', ''),
            'IMG_BICUBIC'                    => array('5.5.0', ''),
            'IMG_BICUBIC_FIXED'              => array('5.5.0', ''),
            'IMG_BILINEAR_FIXED'             => array('5.5.0', ''),
            'IMG_BLACKMAN'                   => array('5.5.0', ''),
            'IMG_BOX'                        => array('5.5.0', ''),
            'IMG_BSPLINE'                    => array('5.5.0', ''),
            'IMG_CATMULLROM'                 => array('5.5.0', ''),
            'IMG_CROP_BLACK'                 => array('5.5.0', ''),
            'IMG_CROP_DEFAULT'               => array('5.5.0', ''),
            'IMG_CROP_SIDES'                 => array('5.5.0', ''),
            'IMG_CROP_TRANSPARENT'           => array('5.5.0', ''),
            'IMG_CROP_THRESHOLD'             => array('5.5.0', ''),
            'IMG_CROP_WHITE'                 => array('5.5.0', ''),
            'IMG_FLIP_HORIZONTAL'            => array('5.5.0', ''),
            'IMG_FLIP_VERTICAL'              => array('5.5.0', ''),
            'IMG_FLIP_BOTH'                  => array('5.5.0', ''),
            'IMG_GAUSSIAN'                   => array('5.5.0', ''),
            'IMG_GENERALIZED_CUBIC'          => array('5.5.0', ''),
            'IMG_HAMMING'                    => array('5.5.0', ''),
            'IMG_HANNING'                    => array('5.5.0', ''),
            'IMG_HERMITE'                    => array('5.5.0', ''),
            'IMG_MITCHELL'                   => array('5.5.0', ''),
            'IMG_NEAREST_NEIGHBOUR'          => array('5.5.0', ''),
            'IMG_POWER'                      => array('5.5.0', ''),
            'IMG_QUADRATIC'                  => array('5.5.0', ''),
            'IMG_SINC'                       => array('5.5.0', ''),
            'IMG_TRIANGLE'                   => array('5.5.0', ''),
            'IMG_WEIGHTED4'                  => array('5.5.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
