<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class HaruExtension extends AbstractReference
{
    const REF_NAME    = 'haru';
    const REF_VERSION = '1.0.4';    // 2012-12-23 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.0.1
        if (version_compare($version, '0.0.1', 'ge')) {
            $release = $this->getR00001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.0.1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2007-03-26',
            'php.min' => '5.1.3',
            'php.max' => '',
        );

        /**
         * @link http://www.php.net/manual/en/class.haruannotation.php
         * @link http://www.php.net/manual/en/class.harudestination.php
         * @link http://www.php.net/manual/en/class.harudoc.php
         * @link http://www.php.net/manual/en/class.haruencoder.php
         * @link http://www.php.net/manual/en/class.haruexception.php
         * @link http://www.php.net/manual/en/class.harufont.php
         * @link http://www.php.net/manual/en/class.haruimage.php
         * @link http://www.php.net/manual/en/class.haruoutline.php
         * @link http://www.php.net/manual/en/class.harupage.php
         */
        $release->classes = array(
            'HaruAnnotation'        => array(
                'methods' => array(
                    'setHighlightMode'      => null,
                    'setBorderStyle'        => null,
                    'setIcon'               => null,
                    'setOpened'             => null,
                ),
            ),
            'HaruDestination'       => array(
                'methods' => array(
                    'setXYZ'                => null,
                    'setFit'                => null,
                    'setFitH'               => null,
                    'setFitV'               => null,
                    'setFitR'               => null,
                    'setFitB'               => null,
                    'setFitBH'              => null,
                    'setFitBV'              => null,
                ),
            ),
            'HaruDoc'               => array(
                'methods' => array(
                    '__construct'           => null,
                    'resetError'            => null,
                    'addPage'               => null,
                    'insertPage'            => null,
                    'getCurrentPage'        => null,
                    'getEncoder'            => null,
                    'getCurrentEncoder'     => null,
                    'setCurrentEncoder'     => null,
                    'save'                  => null,
                    'output'                => null,
                    'saveToStream'          => null,
                    'resetStream'           => null,
                    'getStreamSize'         => null,
                    'readFromStream'        => null,
                    'setPageLayout'         => null,
                    'getPageLayout'         => null,
                    'setPageMode'           => null,
                    'getPageMode'           => null,
                    'setInfoAttr'           => null,
                    'getInfoAttr'           => null,
                    'setInfoDateAttr'       => null,
                    'getFont'               => null,
                    'loadTTF'               => null,
                    'loadTTC'               => null,
                    'loadType1'             => null,
                    'loadPNG'               => null,
                    'loadJPEG'              => null,
                    'loadRaw'               => null,
                    'setPassword'           => null,
                    'setPermission'         => null,
                    'setEncryptionMode'     => null,
                    'setCompressionMode'    => null,
                    'setPagesConfiguration' => null,
                    'setOpenAction'         => null,
                    'createOutline'         => null,
                    'addPageLabel'          => null,
                    'useJPFonts'            => null,
                    'useJPEncodings'        => null,
                    'useKRFonts'            => null,
                    'useKREncodings'        => null,
                    'useCNSFonts'           => null,
                    'useCNSEncodings'       => null,
                    'useCNTFonts'           => null,
                    'useCNTEncodings'       => null,
                ),
            ),
            'HaruEncoder'           => array(
                'methods' => array(
                    'getType'               => null,
                    'getByteType'           => null,
                    'getUnicode'            => null,
                    'getWritingMode'        => null,
                ),
            ),
            'HaruException'         => array(
                'methods' => array(
                    '__construct'           => null,
                    'getMessage'            => null,
                    'getCode'               => null,
                    'getFile'               => null,
                    'getLine'               => null,
                    'getTrace'              => null,
                    'getPrevious'           => null,
                    'getTraceAsString'      => null,
                    '__toString'            => null,
                ),
            ),
            'HaruFont'              => array(
                'methods' => array(
                    'getFontName'           => null,
                    'getEncodingName'       => null,
                    'getUnicodeWidth'       => null,
                    'getAscent'             => null,
                    'getDescent'            => null,
                    'getXHeight'            => null,
                    'getCapHeight'          => null,
                    'getTextWidth'          => null,
                    'MeasureText'           => null,
                )
            ),
            'HaruImage'             => array(
                'methods' => array(
                    'getSize'               => null,
                    'getWidth'              => null,
                    'getHeight'             => null,
                    'getBitsPerComponent'   => null,
                    'getColorSpace'         => null,
                    'setColorMask'          => null,
                    'setMaskImage'          => null,
                    // require libharu >= 2.2
                    'addSMask'              => array('ext.min' => '1.0.3'),
                ),
            ),
            'HaruOutline'           => array(
                'methods' => array(
                    'setOpened'             => null,
                    'setDestination'        => null,
                ),
            ),
            'HaruPage'              => array(
                'methods' => array(
                    'drawImage'             => null,
                    'setLineWidth'          => null,
                    'setLineCap'            => null,
                    'setLineJoin'           => null,
                    'setMiterLimit'         => null,
                    'setFlatness'           => null,
                    'setDash'               => null,
                    'Concat'                => null,
                    'getTransMatrix'        => null,
                    'setTextMatrix'         => null,
                    'getTextMatrix'         => null,
                    'moveTo'                => null,
                    'stroke'                => null,
                    'fill'                  => null,
                    'eofill'                => null,
                    'lineTo'                => null,
                    'curveTo'               => null,
                    'curveTo2'              => null,
                    'curveTo3'              => null,
                    'rectangle'             => null,
                    'arc'                   => null,
                    'circle'                => null,
                    'showText'              => null,
                    'showTextNextLine'      => null,
                    'textOut'               => null,
                    'beginText'             => null,
                    'endText'               => null,
                    'setFontAndSize'        => null,
                    'setCharSpace'          => null,
                    'setWordSpace'          => null,
                    'setHorizontalScaling'  => null,
                    'setTextLeading'        => null,
                    'setTextRenderingMode'  => null,
                    'setTextRise'           => null,
                    'moveTextPos'           => null,
                    'fillStroke'            => null,
                    'eoFillStroke'          => null,
                    'closePath'             => null,
                    'endPath'               => null,
                    'ellipse'               => null,
                    'textRect'              => null,
                    'moveToNextLine'        => null,
                    'setGrayFill'           => null,
                    'setGrayStroke'         => null,
                    'setRGBFill'            => null,
                    'setRGBStroke'          => null,
                    'setCMYKFill'           => null,
                    'setCMYKStroke'         => null,
                    'setWidth'              => null,
                    'setHeight'             => null,
                    'setSize'               => null,
                    'setRotate'             => null,
                    'getWidth'              => null,
                    'getHeight'             => null,
                    'createDestination'     => null,
                    'createTextAnnotation'  => null,
                    'createLinkAnnotation'  => null,
                    'createURLAnnotation'   => null,
                    'getTextWidth'          => null,
                    'MeasureText'           => null,
                    'getGMode'              => null,
                    'getCurrentPos'         => null,
                    'getCurrentTextPos'     => null,
                    'getCurrentFont'        => null,
                    'getCurrentFontSize'    => null,
                    'getLineWidth'          => null,
                    'getLineCap'            => null,
                    'getLineJoin'           => null,
                    'getMiterLimit'         => null,
                    'getDash'               => null,
                    'getFlatness'           => null,
                    'getCharSpace'          => null,
                    'getWordSpace'          => null,
                    'getHorizontalScaling'  => null,
                    'getTextLeading'        => null,
                    'getTextRenderingMode'  => null,
                    'getTextRise'           => null,
                    'getRGBFill'            => null,
                    'getRGBStroke'          => null,
                    'getCMYKFill'           => null,
                    'getCMYKStroke'         => null,
                    'getGrayFill'           => null,
                    'getGrayStroke'         => null,
                    'getFillingColorSpace'  => null,
                    'getStrokingColorSpace' => null,
                    'setSlideShow'          => null,
                    // require libharu >= 2.2
                    'setZoom'               => array('ext.min' => '1.0.3'),
                ),
            ),
        );
        return $release;
    }
}
