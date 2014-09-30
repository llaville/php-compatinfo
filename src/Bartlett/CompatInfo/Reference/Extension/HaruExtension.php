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
                'constants' => array(
                    'NO_HIGHLIGHT'          => null,
                    'INVERT_BOX'            => null,
                    'INVERT_BORDER'         => null,
                    'DOWN_APPEARANCE'       => null,

                    'ICON_COMMENT'          => null,
                    'ICON_KEY'              => null,
                    'ICON_NOTE'             => null,
                    'ICON_HELP'             => null,
                    'ICON_NEW_PARAGRAPH'    => null,
                    'ICON_PARAGRAPH'        => null,
                    'ICON_INSERT'           => null,
                ),
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
                'constants' => array(
                    'CS_DEVICE_GRAY'        => null,
                    'CS_DEVICE_RGB'         => null,
                    'CS_DEVICE_CMYK'        => null,
                    'CS_CAL_GRAY'           => null,
                    'CS_CAL_RGB'            => null,
                    'CS_LAB'                => null,
                    'CS_ICC_BASED'          => null,
                    'CS_SEPARATION'         => null,
                    'CS_DEVICE_N'           => null,
                    'CS_INDEXED'            => null,
                    'CS_PATTERN'            => null,
                    'ENABLE_READ'           => null,
                    'ENABLE_PRINT'          => null,
                    'ENABLE_EDIT_ALL'       => null,
                    'ENABLE_COPY'           => null,
                    'ENABLE_EDIT'           => null,
                    'ENCRYPT_R2'            => null,
                    'ENCRYPT_R3'            => null,
                    'INFO_AUTHOR'           => null,
                    'INFO_CREATOR'          => null,
                    'INFO_TITLE'            => null,
                    'INFO_SUBJECT'          => null,
                    'INFO_KEYWORDS'         => null,
                    'INFO_CREATION_DATE'    => null,
                    'INFO_MOD_DATE'         => null,
                    'COMP_NONE'             => null,
                    'COMP_TEXT'             => null,
                    'COMP_IMAGE'            => null,
                    'COMP_METADATA'         => null,
                    'COMP_ALL'              => null,
                    'PAGE_LAYOUT_SINGLE'    => null,
                    'PAGE_LAYOUT_ONE_COLUMN'        => null,
                    'PAGE_LAYOUT_TWO_COLUMN_LEFT'   => null,
                    'PAGE_LAYOUT_TWO_COLUMN_RIGHT'  => null,
                    'PAGE_MODE_USE_NONE'    => null,
                    'PAGE_MODE_USE_OUTLINE' => null,
                    'PAGE_MODE_USE_THUMBS'  => null,
                    'PAGE_MODE_FULL_SCREEN' => null,
                ),
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
                'constants' => array(
                    'TYPE_SINGLE_BYTE'      => null,
                    'TYPE_DOUBLE_BYTE'      => null,
                    'TYPE_UNINITIALIZED'    => null,
                    'UNKNOWN'               => null,
                    'BYTE_TYPE_SINGLE'      => null,
                    'BYTE_TYPE_LEAD'        => null,
                    'BYTE_TYPE_TRAIL'       => null,
                    'BYTE_TYPE_UNKNOWN'     => null,
                    'WMODE_HORIZONTAL'      => null,
                    'WMODE_VERTICAL'        => null,
                ),
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
                'constants' => array(
                    'GMODE_PAGE_DESCRIPTION'=> null,
                    'GMODE_TEXT_OBJECT'     => null,
                    'GMODE_PATH_OBJECT'     => null,
                    'GMODE_CLIPPING_PATH'   => null,
                    'GMODE_SHADING'         => null,
                    'GMODE_INLINE_IMAGE'    => null,
                    'GMODE_EXTERNAL_OBJECT' => null,

                    'BUTT_END'              => null,
                    'ROUND_END'             => null,
                    'PROJECTING_SCUARE_END' => null,

                    'MITER_JOIN'            => null,
                    'ROUND_JOIN'            => null,
                    'BEVEL_JOIN'            => null,

                    'STROKE'                => null,
                    'INVISIBLE'             => null,
                    'STROKE_CLIPPING'       => null,
                    'CLIPPING'              => null,

                    'FILL'                  => null,
                    'FILL_THEN_STROKE'      => null,
                    'FILL_CLIPPING'         => null,
                    'FILL_STROKE_CLIPPING'  => null,

                    'TALIGN_LEFT'           => null,
                    'TALIGN_RIGHT'          => null,
                    'TALIGN_CENTER'         => null,
                    'TALIGN_JUSTIFY'        => null,

                    'SIZE_LETTER'           => null,
                    'SIZE_LEGAL'            => null,
                    'SIZE_A3'               => null,
                    'SIZE_A4'               => null,
                    'SIZE_A5'               => null,
                    'SIZE_B4'               => null,
                    'SIZE_B5'               => null,
                    'SIZE_EXECUTIVE'        => null,
                    'SIZE_US4x6'            => null,
                    'SIZE_US4x8'            => null,
                    'SIZE_US5x7'            => null,
                    'SIZE_COMM10'           => null,

                    'PORTRAIT'              => null,
                    'LANDSCAPE'             => null,

                    'TS_WIPE_LIGHT'         => null,
                    'TS_WIPE_UP'            => null,
                    'TS_WIPE_LEFT'          => null,
                    'TS_WIPE_DOWN'          => null,

                    'TS_BARN_DOORS_HORIZONTAL_OUT'  => null,
                    'TS_BARN_DOORS_HORIZONTAL_IN'   => null,
                    'TS_BARN_DOORS_VERTICAL_OUT'    => null,
                    'TS_BARN_DOORS_VERTICAL_IN'     => null,

                    'TS_BOX_OUT'            => null,
                    'TS_BOX_IN'             => null,

                    'TS_BLINDS_HORIZONTAL'  => null,
                    'TS_BLINDS_VERTICAL'    => null,

                    'TS_DISSOLVE'                           => null,
                    'TS_GLITTER_RIGHT'                      => null,
                    'TS_GLITTER_DOWN'                       => null,
                    'TS_GLITTER_TOP_LEFT_TO_BOTTOM_RIGHT'   => null,
                    'TS_REPLACE'                            => null,

                    'NUM_STYLE_DECIMAL'         => null,
                    'NUM_STYLE_UPPER_ROMAN'     => null,
                    'NUM_STYLE_LOWER_ROMAN'     => null,
                    'NUM_STYLE_UPPER_LETTERS'   => null,
                    'NUM_STYLE_LOWER_LETTERS'   => null,
                ),
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
