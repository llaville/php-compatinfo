<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class GdExtension extends AbstractReference
{
    const REF_NAME    = 'gd';
    const REF_VERSION = '';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.2
        if (version_compare($version, '4.0.2', 'ge')) {
            $release = $this->getR40002();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.6
        if (version_compare($version, '4.0.6', 'ge')) {
            $release = $this->getR40006();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.7
        if (version_compare($version, '4.0.7', 'ge')) {
            $release = $this->getR40007();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.2
        if (version_compare($version, '4.3.2', 'ge')) {
            $release = $this->getR40302();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.0.0
        if (version_compare($version, '5.0.0', 'ge')) {
            $release = $this->getR50000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.0
        if (version_compare($version, '5.1.0', 'ge')) {
            $release = $this->getR50100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.1.3
        if (version_compare($version, '5.1.3', 'ge')) {
            $release = $this->getR50103();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.2
        if (version_compare($version, '5.2.2', 'ge')) {
            $release = $this->getR50202();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.2.4
        if (version_compare($version, '5.2.4', 'ge')) {
            $release = $this->getR50204();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.3.0
        if (version_compare($version, '5.3.0', 'ge')) {
            $release = $this->getR50300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.5.0
        if (version_compare($version, '5.5.0', 'ge')) {
            $release = $this->getR50500();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->functions = array(
            'imagearc'                      => null,
            'imagechar'                     => null,
            'imagecharup'                   => null,
            'imagecolorallocate'            => null,
            'imagecolorat'                  => null,
            'imagecolorclosest'             => null,
            'imagecolordeallocate'          => null,
            'imagecolorexact'               => null,
            'imagecolorresolve'             => null,
            'imagecolorset'                 => null,
            'imagecolorsforindex'           => null,
            'imagecolorstotal'              => null,
            'imagecolortransparent'         => null,
            'imagecopy'                     => null,
            'imagecopyresized'              => null,
            'imagecreate'                   => null,
            'imagecreatefromgif'            => null,
            'imagecreatefromjpeg'           => null,
            'imagecreatefrompng'            => null,
            'imagedashedline'               => null,
            'imagedestroy'                  => null,
            'imagefill'                     => null,
            'imagefilledpolygon'            => null,
            'imagefilledrectangle'          => null,
            'imagefilltoborder'             => null,
            'imagefontheight'               => null,
            'imagefontwidth'                => null,
            'imagegammacorrect'             => null,
            'imagegif'                      => null,
            'imageinterlace'                => null,
            'imagejpeg'                     => null,
            'imageline'                     => null,
            'imageloadfont'                 => null,
            'imagepng'                      => null,
            'imagepolygon'                  => null,
            'imagepsbbox'                   => null,
            'imagepsencodefont'             => null,
            'imagepsextendfont'             => null,
            'imagepsfreefont'               => null,
            'imagepsloadfont'               => null,
            'imagepsslantfont'              => null,
            'imagepstext'                   => null,
            'imagerectangle'                => null,
            'imagesetpixel'                 => null,
            'imagestring'                   => null,
            'imagestringup'                 => null,
            'imagesx'                       => null,
            'imagesy'                       => null,
            'imagettfbbox'                  => null,
            'imagettftext'                  => null,
        );
        $release->constants = array(
            'GD_BUNDLED'                    => null,
            'IMG_ARC_CHORD'                 => null,
            'IMG_ARC_EDGED'                 => null,
            'IMG_ARC_NOFILL'                => null,
            'IMG_ARC_PIE'                   => null,
            'IMG_ARC_ROUNDED'               => null,
            'IMG_COLOR_BRUSHED'             => null,
            'IMG_COLOR_STYLED'              => null,
            'IMG_COLOR_STYLEDBRUSHED'       => null,
            'IMG_COLOR_TILED'               => null,
            'IMG_COLOR_TRANSPARENT'         => null,
            'IMG_EFFECT_ALPHABLEND'         => null,
            'IMG_EFFECT_NORMAL'             => null,
            'IMG_EFFECT_OVERLAY'            => null,
            'IMG_EFFECT_REPLACE'            => null,
            'IMG_FILTER_BRIGHTNESS'         => null,
            'IMG_FILTER_COLORIZE'           => null,
            'IMG_FILTER_CONTRAST'           => null,
            'IMG_FILTER_EDGEDETECT'         => null,
            'IMG_FILTER_EMBOSS'             => null,
            'IMG_FILTER_GAUSSIAN_BLUR'      => null,
            'IMG_FILTER_GRAYSCALE'          => null,
            'IMG_FILTER_MEAN_REMOVAL'       => null,
            'IMG_FILTER_NEGATE'             => null,
            'IMG_FILTER_SELECTIVE_BLUR'     => null,
            'IMG_FILTER_SMOOTH'             => null,
            'IMG_GD2_COMPRESSED'            => null,
            'IMG_GD2_RAW'                   => null,
            'IMG_GIF'                       => null,
            'IMG_JPEG'                      => null,
            'IMG_JPG'                       => null,
            'IMG_PNG'                       => null,
            'IMG_WBMP'                      => null,
            'IMG_XPM'                       => null,
            'PNG_ALL_FILTERS'               => null,
            'PNG_FILTER_AVG'                => null,
            'PNG_FILTER_NONE'               => null,
            'PNG_FILTER_PAETH'              => null,
            'PNG_FILTER_SUB'                => null,
            'PNG_FILTER_UP'                 => null,
            'PNG_NO_FILTER'                 => null,
        );
        return $release;
    }

    protected function getR40001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-06-28',
            'php.min' => '4.0.1',
            'php.max' => '',
        );
        $release->functions = array(
            'imagecolorclosesthwb'          => null,
            'imagecreatefromwbmp'           => null,
            'imagecreatefromxbm'            => null,
            'imagecreatefromxpm'            => null,
            'imagecopymerge'                => null,
            'imagepalettecopy'              => null,
            'imagewbmp'                     => null,
        );
        return $release;
    }

    protected function getR40002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-08-29',
            'php.min' => '4.0.2',
            'php.max' => '',
        );
        $release->functions = array(
            'imagetypes'                    => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'imagecreatefromstring'         => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->functions = array(
            'image2wbmp'                    => null,
            'jpeg2wbmp'                     => null,
            'png2wbmp'                      => null,
        );
        return $release;
    }

    protected function getR40006()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.6',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-06-23',
            'php.min' => '4.0.6',
            'php.max' => '',
        );
        $release->functions = array(
            'imagealphablending'            => null,
            'imagecolorclosestalpha'        => null,
            'imagecolorexactalpha'          => null,
            'imagecolorresolvealpha'        => null,
            'imagecopymergegray'            => null,
            'imagecopyresampled'            => null,
            'imagecreatetruecolor'          => null,
            'imageellipse'                  => null,
            'imagefilledarc'                => null,
            'imagefilledellipse'            => null,
            'imagesetbrush'                 => null,
            'imagesetstyle'                 => null,
            'imagesetthickness'             => null,
            'imagesettile'                  => null,
            'imagetruecolortopalette'       => null,
        );
        $release->constants = array(
        );
        return $release;
    }

    protected function getR40007()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.7',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '',
            'php.min' => '4.0.7',
            'php.max' => '',
        );
        $release->functions = array(
            'imagecreatefromgd'             => null,
            'imagecreatefromgd2'            => null,
            'imagecreatefromgd2part'        => null,
            'imageftbbox'                   => null,
            'imagefttext'                   => null,
            'imagegd'                       => null,
            'imagegd2'                      => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->functions = array(
            'gd_info'                       => null,
            'imagecolormatch'               => null,
            'imagelayereffect'              => null,
            'imagerotate'                   => null,
        );
        $release->constants = array(
        );
        return $release;
    }

    protected function getR40302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-05-29',
            'php.min' => '4.3.2',
            'php.max' => '',
        );
        $release->functions = array(
            'imageantialias'                => null,
            'imagecolorallocatealpha'       => null,
            'imageistruecolor'              => null,
            'imagesavealpha'                => null,
        );
        return $release;
    }

    protected function getR50000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->classes = array(
        );
        $release->functions = array(
            'imagefilter'                   => null,
            'imagexbm'                      => null,
        );
        return $release;
    }

    protected function getR50100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-07-13',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->functions = array(
            'imageconvolution'              => null,
        );
        $release->constants = array(
        );
        return $release;
    }

    protected function getR50103()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.1.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-05-02',
            'php.min' => '5.1.3',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'gd.jpeg_ignore_warning'        => null,
        );
        return $release;
    }

    protected function getR50202()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-05-03',
            'php.min' => '5.2.2',
            'php.max' => '',
        );
        $release->functions = array(
            'imagegrabscreen'               => null,
            'imagegrabwindow'               => null,
        );
        return $release;
    }

    protected function getR50204()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.2.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2007-08-30',
            'php.min' => '5.2.4',
            'php.max' => '',
        );
        $release->constants = array(
            'GD_EXTRA_VERSION'              => null,
            'GD_MAJOR_VERSION'              => null,
            'GD_MINOR_VERSION'              => null,
            'GD_RELEASE_VERSION'            => null,
            'GD_VERSION'                    => null,
        );
        return $release;
    }

    protected function getR50300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-06-30',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->constants = array(
            'IMG_FILTER_PIXELATE'           => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->functions = array(
            'imagecreatefromwebp'           => null,
            'imagewebp'                     => null,
        );
        return $release;
    }

    protected function getR50500()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.5.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-06-20',
            'php.min' => '5.5.0',
            'php.max' => '',
        );
        $release->functions = array(
            'imageaffine'                   => null,
            'imageaffinematrixconcat'       => null,
            'imageaffinematrixget'          => null,
            'imagecrop'                     => null,
            'imagecropauto'                 => null,
            'imageflip'                     => null,
            'imagepalettetotruecolor'       => null,
            'imagescale'                    => null,
            'imagesetinterpolation'         => null,
        );
        $release->constants = array(
            'IMG_AFFINE_ROTATE'             => null,
            'IMG_AFFINE_SCALE'              => null,
            'IMG_AFFINE_SHEAR_HORIZONTAL'   => null,
            'IMG_AFFINE_SHEAR_VERTICAL'     => null,
            'IMG_AFFINE_TRANSLATE'          => null,
            'IMG_BELL'                      => null,
            'IMG_BESSEL'                    => null,
            'IMG_BICUBIC'                   => null,
            'IMG_BICUBIC_FIXED'             => null,
            'IMG_BILINEAR_FIXED'            => null,
            'IMG_BLACKMAN'                  => null,
            'IMG_BOX'                       => null,
            'IMG_BSPLINE'                   => null,
            'IMG_CATMULLROM'                => null,
            'IMG_CROP_BLACK'                => null,
            'IMG_CROP_DEFAULT'              => null,
            'IMG_CROP_SIDES'                => null,
            'IMG_CROP_THRESHOLD'            => null,
            'IMG_CROP_TRANSPARENT'          => null,
            'IMG_CROP_WHITE'                => null,
            'IMG_FLIP_BOTH'                 => null,
            'IMG_FLIP_HORIZONTAL'           => null,
            'IMG_FLIP_VERTICAL'             => null,
            'IMG_GAUSSIAN'                  => null,
            'IMG_GENERALIZED_CUBIC'         => null,
            'IMG_HAMMING'                   => null,
            'IMG_HANNING'                   => null,
            'IMG_HERMITE'                   => null,
            'IMG_MITCHELL'                  => null,
            'IMG_NEAREST_NEIGHBOUR'         => null,
            'IMG_POWER'                     => null,
            'IMG_QUADRATIC'                 => null,
            'IMG_SINC'                      => null,
            'IMG_TRIANGLE'                  => null,
            'IMG_WEIGHTED4'                 => null,
        );
        return $release;
    }
}
