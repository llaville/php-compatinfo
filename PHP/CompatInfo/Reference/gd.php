<?php
/**
 * All interfaces, classes, functions, constants about gd extension
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @link       http://www.php.net/manual/en/book.image.php
 */

require_once 'PHP/CompatInfo/Reference.php';

class PHP_CompatInfo_Reference_Gd implements PHP_CompatInfo_Reference
{
    /**
     * Gets all informations at once about:
     * extensions, interfaces, classes, functions, constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getAll($extension = null, $version = null)
    {
        $references = array(
            'extensions' => $this->getExtensions($extension, $version),
            'interfaces' => $this->getInterfaces($extension, $version),
            'classes'    => $this->getClasses($extension, $version),
            'functions'  => $this->getFunctions($extension, $version),
            'constants'  => $this->getConstants($extension, $version),
        );
        return $references;
    }

    /**
     * Gets informations about extensions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getExtensions($extension = null, $version = null)
    {
        $extensions = array(
            'gd' => array('4.0.0', '', '')
        );
        return $extensions;
    }

    /**
     * Gets informations about interfaces
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getInterfaces($extension = null, $version = null)
    {
        $interfaces = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $interfaces = array_merge(
                $interfaces,
                $version5
            );
        }
        return $interfaces;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null)
    {
        $classes = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
            );
            $classes = array_merge(
                $classes,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $classes = array_merge(
                $classes,
                $version5
            );
        }

        return $classes;
    }

    /**
     * Gets informations about functions
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/ref.image.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'gd_info'                        => array('4.3.0', ''),
                'imagearc'                       => array('4.0.0', ''),
                'imageellipse'                   => array('4.0.6', ''),
                'imagechar'                      => array('4.0.0', ''),
                'imagecharup'                    => array('4.0.0', ''),
                'imagecolorat'                   => array('4.0.0', ''),
                'imagecolorallocate'             => array('4.0.0', ''),
                'imagepalettecopy'               => array('4.0.1', ''),
                'imagecreatefromstring'          => array('4.0.4', ''),
                'imagecolorclosest'              => array('4.0.0', ''),
                'imagecolorclosesthwb'           => array('4.0.1', ''),
                'imagecolordeallocate'           => array('4.0.0', ''),
                'imagecolorresolve'              => array('4.0.0', ''),
                'imagecolorexact'                => array('4.0.0', ''),
                'imagecolorset'                  => array('4.0.0', ''),
                'imagecolortransparent'          => array('4.0.0', ''),
                'imagecolorstotal'               => array('4.0.0', ''),
                'imagecolorsforindex'            => array('4.0.0', ''),
                'imagecopy'                      => array('4.0.0', ''),
                'imagecopymerge'                 => array('4.0.1', ''),
                'imagecopymergegray'             => array('4.0.6', ''),
                'imagecopyresized'               => array('4.0.0', ''),
                'imagecreate'                    => array('4.0.0', ''),
                'imagecreatetruecolor'           => array('4.0.6', ''),
                'imageistruecolor'               => array('4.3.2', ''),
                'imagetruecolortopalette'        => array('4.0.6', ''),
                'imagesetthickness'              => array('4.0.6', ''),
                'imagefilledarc'                 => array('4.0.6', ''),
                'imagefilledellipse'             => array('4.0.6', ''),
                'imagealphablending'             => array('4.0.6', ''),
                'imagesavealpha'                 => array('4.3.2', ''),
                'imagecolorallocatealpha'        => array('4.3.2', ''),
                'imagecolorresolvealpha'         => array('4.0.6', ''),
                'imagecolorclosestalpha'         => array('4.0.6', ''),
                'imagecolorexactalpha'           => array('4.0.6', ''),
                'imagecopyresampled'             => array('4.0.6', ''),
                'imagerotate'                    => array('4.3.0', ''),
                'imageantialias'                 => array('4.3.2', ''),
                'imagesettile'                   => array('4.0.6', ''),
                'imagesetbrush'                  => array('4.0.6', ''),
                'imagesetstyle'                  => array('4.0.6', ''),
                'imagecreatefrompng'             => array('4.0.0', ''),
                'imagecreatefromgif'             => array('4.0.0', ''),
                'imagecreatefromjpeg'            => array('4.0.0', ''),
                'imagecreatefromwbmp'            => array('4.0.1', ''),
                'imagecreatefromxbm'             => array('4.0.1', ''),
                'imagecreatefromxpm'             => array('4.0.1', ''),
                'imagecreatefromgd'              => array('4.0.7', ''),
                'imagecreatefromgd2'             => array('4.0.7', ''),
                'imagecreatefromgd2part'         => array('4.0.7', ''),
                'imagepsbbox'                    => array('4.0.0', ''),
                'imagepsencodefont'              => array('4.0.0', ''),
                'imagepsextendfont'              => array('4.0.0', ''),
                'imagepsfreefont'                => array('4.0.0', ''),
                'imagepsloadfont'                => array('4.0.0', ''),
                'imagepsslantfont'               => array('4.0.0', ''),
                'imagepstext'                    => array('4.0.0', ''),
                'imagepng'                       => array('4.0.0', ''),
                'imagegif'                       => array('4.0.0', ''),
                'imagejpeg'                      => array('4.0.0', ''),
                'imagewbmp'                      => array('4.0.1', ''),
                'imagegd'                        => array('4.0.7', ''),
                'imagegd2'                       => array('4.0.7', ''),
                'imagedestroy'                   => array('4.0.0', ''),
                'imagegammacorrect'              => array('4.0.0', ''),
                'imagefill'                      => array('4.0.0', ''),
                'imagefilledpolygon'             => array('4.0.0', ''),
                'imagefilledrectangle'           => array('4.0.0', ''),
                'imagefilltoborder'              => array('4.0.0', ''),
                'imagefontwidth'                 => array('4.0.0', ''),
                'imagefontheight'                => array('4.0.0', ''),
                'imageinterlace'                 => array('4.0.0', ''),
                'imageline'                      => array('4.0.0', ''),
                'imageloadfont'                  => array('4.0.0', ''),
                'imagepolygon'                   => array('4.0.0', ''),
                'imagerectangle'                 => array('4.0.0', ''),
                'imagesetpixel'                  => array('4.0.0', ''),
                'imagestring'                    => array('4.0.0', ''),
                'imagestringup'                  => array('4.0.0', ''),
                'imagesx'                        => array('4.0.0', ''),
                'imagesy'                        => array('4.0.0', ''),
                'imagedashedline'                => array('4.0.0', ''),
                'imagettfbbox'                   => array('4.0.0', ''),
                'imagettftext'                   => array('4.0.0', ''),
                'imageftbbox'                    => array('4.0.7', ''),
                'imagefttext'                    => array('4.0.7', ''),
                'imagetypes'                     => array('4.0.2', ''),
                'jpeg2wbmp'                      => array('4.0.5', ''),
                'png2wbmp'                       => array('4.0.5', ''),
                'image2wbmp'                     => array('4.0.5', ''),
                'imagelayereffect'               => array('4.3.0', ''),
                'imagecolormatch'                => array('4.3.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'imageconvolution'               => array('5.1.0', ''),
                'imagefilter'                    => array('5.0.0', ''),
                'imagegrabscreen'                => array('5.2.2', ''),
                'imagegrabwindow'                => array('5.2.2', ''),
                'imagexbm'                       => array('5.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version5
            );
        }
        return $functions;
    }

    /**
     * Gets informations about constants
     *
     * @param string $extension OPTIONAL
     * @param string $version   OPTIONAL PHP version
     *                          (4 => only PHP4, 5 or null => PHP4 + PHP5)
     *
     * @return array
     * @link   http://www.php.net/manual/en/image.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'IMG_GIF'                        => array('4.0.0', ''),
                'IMG_JPG'                        => array('4.0.0', ''),
                'IMG_JPEG'                       => array('4.0.0', ''),
                'IMG_PNG'                        => array('4.0.0', ''),
                'IMG_WBMP'                       => array('4.0.0', ''),
                'IMG_XPM'                        => array('4.0.0', ''),
                'IMG_COLOR_TILED'                => array('4.0.0', ''),
                'IMG_COLOR_STYLED'               => array('4.0.0', ''),
                'IMG_COLOR_BRUSHED'              => array('4.0.0', ''),
                'IMG_COLOR_STYLEDBRUSHED'        => array('4.0.0', ''),
                'IMG_COLOR_TRANSPARENT'          => array('4.0.0', ''),
                'IMG_ARC_ROUNDED'                => array('4.0.0', ''),
                'IMG_ARC_PIE'                    => array('4.0.0', ''),
                'IMG_ARC_CHORD'                  => array('4.0.0', ''),
                'IMG_ARC_NOFILL'                 => array('4.0.0', ''),
                'IMG_ARC_EDGED'                  => array('4.0.0', ''),
                'IMG_GD2_RAW'                    => array('4.0.0', ''),
                'IMG_GD2_COMPRESSED'             => array('4.0.0', ''),
                'IMG_EFFECT_REPLACE'             => array('4.0.0', ''),
                'IMG_EFFECT_ALPHABLEND'          => array('4.0.0', ''),
                'IMG_EFFECT_NORMAL'              => array('4.0.0', ''),
                'IMG_EFFECT_OVERLAY'             => array('4.0.0', ''),
                'GD_BUNDLED'                     => array('4.0.0', ''),
                'IMG_FILTER_NEGATE'              => array('4.0.0', ''),
                'IMG_FILTER_GRAYSCALE'           => array('4.0.0', ''),
                'IMG_FILTER_BRIGHTNESS'          => array('4.0.0', ''),
                'IMG_FILTER_CONTRAST'            => array('4.0.0', ''),
                'IMG_FILTER_COLORIZE'            => array('4.0.0', ''),
                'IMG_FILTER_EDGEDETECT'          => array('4.0.0', ''),
                'IMG_FILTER_GAUSSIAN_BLUR'       => array('4.0.0', ''),
                'IMG_FILTER_SELECTIVE_BLUR'      => array('4.0.0', ''),
                'IMG_FILTER_EMBOSS'              => array('4.0.0', ''),
                'IMG_FILTER_MEAN_REMOVAL'        => array('4.0.0', ''),
                'IMG_FILTER_SMOOTH'              => array('4.0.0', ''),
                'PNG_NO_FILTER'                  => array('4.0.0', ''),
                'PNG_FILTER_NONE'                => array('4.0.0', ''),
                'PNG_FILTER_SUB'                 => array('4.0.0', ''),
                'PNG_FILTER_UP'                  => array('4.0.0', ''),
                'PNG_FILTER_AVG'                 => array('4.0.0', ''),
                'PNG_FILTER_PAETH'               => array('4.0.0', ''),
                'PNG_ALL_FILTERS'                => array('4.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'GD_VERSION'                     => array('5.2.4', ''),
                'GD_MAJOR_VERSION'               => array('5.2.4', ''),
                'GD_MINOR_VERSION'               => array('5.2.4', ''),
                'GD_RELEASE_VERSION'             => array('5.2.4', ''),
                'GD_EXTRA_VERSION'               => array('5.2.4', ''),
                'IMG_FILTER_PIXELATE'            => array('5.3.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
