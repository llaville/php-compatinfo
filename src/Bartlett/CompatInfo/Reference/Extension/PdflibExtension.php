<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class PdflibExtension extends AbstractReference
{
    const REF_NAME    = 'pdflib';
    const REF_VERSION = '3.0.4';    // 2014-01-15 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version = $this->getCurrentVersion();

        // 2.0.0
        if (version_compare($version, '2.0.0', 'ge')) {
            $release = $this->getR20000();
            $this->storage->attach($release);
        }

        // 2.0.3
        if (version_compare($version, '2.0.3', 'ge')) {
            $release = $this->getR20003();
            $this->storage->attach($release);
        }

        // 2.1.0
        if (version_compare($version, '2.1.0', 'ge')) {
            $release = $this->getR20100();
            $this->storage->attach($release);
        }

        // 2.1.10
        if (version_compare($version, '2.1.10', 'ge')) {
            $release = $this->getR20110();
            $this->storage->attach($release);
        }

        // 3.0.1
        if (version_compare($version, '3.0.1', 'ge')) {
            $release = $this->getR30001();
            $this->storage->attach($release);
        }

        // 3.0.2
        if (version_compare($version, '3.0.2', 'ge')) {
            $release = $this->getR30002();
            $this->storage->attach($release);
        }
    }

    protected function getR20000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-06-21',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->classes = array(
            'PDFlib'                        => null,
            'PDFlibException'               => null,
        );
        $release->functions = array(
            'pdf_activate_item'             => null,
            'pdf_add_bookmark'              => null,
            'pdf_add_launchlink'            => null,
            'pdf_add_locallink'             => null,
            'pdf_add_nameddest'             => null,
            'pdf_add_note'                  => null,
            'pdf_add_pdflink'               => null,
            'pdf_add_thumbnail'             => null,
            'pdf_add_weblink'               => null,
            'pdf_arc'                       => null,
            'pdf_arcn'                      => null,
            'pdf_attach_file'               => null,
            'pdf_begin_document'            => null,
            'pdf_begin_font'                => null,
            'pdf_begin_glyph'               => null,
            'pdf_begin_item'                => null,
            'pdf_begin_layer'               => null,
            'pdf_begin_page'                => null,
            'pdf_begin_page_ext'            => null,
            'pdf_begin_pattern'             => null,
            'pdf_begin_template'            => null,
            'pdf_circle'                    => null,
            'pdf_clip'                      => null,
            'pdf_close'                     => null,
            'pdf_close_image'               => null,
            'pdf_close_pdi'                 => null,
            'pdf_close_pdi_page'            => null,
            'pdf_closepath'                 => null,
            'pdf_closepath_fill_stroke'     => null,
            'pdf_closepath_stroke'          => null,
            'pdf_concat'                    => null,
            'pdf_continue_text'             => null,
            'pdf_create_action'             => null,
            'pdf_create_annotation'         => null,
            'pdf_create_bookmark'           => null,
            'pdf_create_field'              => null,
            'pdf_create_fieldgroup'         => null,
            'pdf_create_gstate'             => null,
            'pdf_create_pvf'                => null,
            'pdf_create_textflow'           => null,
            'pdf_curveto'                   => null,
            'pdf_define_layer'              => null,
            'pdf_delete'                    => null,
            'pdf_delete_pvf'                => null,
            'pdf_delete_textflow'           => null,
            'pdf_encoding_set_char'         => null,
            'pdf_end_document'              => null,
            'pdf_end_font'                  => null,
            'pdf_end_glyph'                 => null,
            'pdf_end_item'                  => null,
            'pdf_end_layer'                 => null,
            'pdf_end_page'                  => null,
            'pdf_end_page_ext'              => null,
            'pdf_end_pattern'               => null,
            'pdf_end_template'              => null,
            'pdf_endpath'                   => null,
            'pdf_fill'                      => null,
            'pdf_fill_imageblock'           => null,
            'pdf_fill_pdfblock'             => null,
            'pdf_fill_stroke'               => null,
            'pdf_fill_textblock'            => null,
            'pdf_findfont'                  => null,
            'pdf_fit_image'                 => null,
            'pdf_fit_pdi_page'              => null,
            'pdf_fit_textflow'              => null,
            'pdf_fit_textline'              => null,
            'pdf_get_apiname'               => null,
            'pdf_get_buffer'                => null,
            'pdf_get_errmsg'                => null,
            'pdf_get_errnum'                => null,
            'pdf_get_parameter'             => null,
            'pdf_get_pdi_parameter'         => null,
            'pdf_get_pdi_value'             => null,
            'pdf_get_value'                 => null,
            'pdf_info_textflow'             => null,
            'pdf_initgraphics'              => null,
            'pdf_lineto'                    => null,
            'pdf_load_font'                 => null,
            'pdf_load_iccprofile'           => null,
            'pdf_load_image'                => null,
            'pdf_makespotcolor'             => null,
            'pdf_moveto'                    => null,
            'pdf_new'                       => null,
            'pdf_open_ccitt'                => null,
            'pdf_open_file'                 => null,
            'pdf_open_image'                => null,
            'pdf_open_image_file'           => null,
            'pdf_open_pdi'                  => null,
            'pdf_open_pdi_document'         => null,
            'pdf_open_pdi_page'             => null,
            'pdf_place_image'               => null,
            'pdf_place_pdi_page'            => null,
            'pdf_process_pdi'               => null,
            'pdf_rect'                      => null,
            'pdf_restore'                   => null,
            'pdf_resume_page'               => null,
            'pdf_rotate'                    => null,
            'pdf_save'                      => null,
            'pdf_scale'                     => null,
            'pdf_set_border_color'          => null,
            'pdf_set_border_dash'           => null,
            'pdf_set_border_style'          => null,
            'pdf_set_gstate'                => null,
            'pdf_set_info'                  => null,
            'pdf_set_layer_dependency'      => null,
            'pdf_set_parameter'             => null,
            'pdf_set_text_pos'              => null,
            'pdf_set_value'                 => null,
            'pdf_setcolor'                  => null,
            'pdf_setdash'                   => null,
            'pdf_setdashpattern'            => null,
            'pdf_setflat'                   => null,
            'pdf_setfont'                   => null,
            'pdf_setlinecap'                => null,
            'pdf_setlinejoin'               => null,
            'pdf_setlinewidth'              => null,
            'pdf_setmatrix'                 => null,
            'pdf_setmiterlimit'             => null,
            'pdf_setpolydash'               => null,
            'pdf_shading'                   => null,
            'pdf_shading_pattern'           => null,
            'pdf_shfill'                    => null,
            'pdf_show'                      => null,
            'pdf_show_boxed'                => null,
            'pdf_show_xy'                   => null,
            'pdf_skew'                      => null,
            'pdf_stringwidth'               => null,
            'pdf_stroke'                    => null,
            'pdf_suspend_page'              => null,
            'pdf_translate'                 => null,
        );
        return $release;
    }

    protected function getR20003()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2004-11-24',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pdf_setgray'                   => null,
            'pdf_setgray_fill'              => null,
            'pdf_setgray_stroke'            => null,
            'pdf_setrgbcolor'               => null,
            'pdf_setrgbcolor_fill'          => null,
            'pdf_setrgbcolor_stroke'        => null,
            'pdf_utf16_to_utf8'             => null,
            'pdf_utf8_to_utf16'             => null,
        );
        return $release;
    }

    protected function getR20100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.1.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2006-10-05',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pdf_add_table_cell'            => null,
            'pdf_add_textflow'              => null,
            'pdf_begin_template_ext'        => null,
            'pdf_close_pdi_document'        => null,
            'pdf_create_3dview'             => null,
            'pdf_delete_table'              => null,
            'pdf_end_mc'                    => null,
            'pdf_fit_table'                 => null,
            'pdf_info_font'                 => null,
            'pdf_info_matchbox'             => null,
            'pdf_info_table'                => null,
            'pdf_info_textline'             => null,
            'pdf_load_3ddata'               => null,
            'pdf_pcos_get_number'           => null,
            'pdf_pcos_get_stream'           => null,
            'pdf_pcos_get_string'           => null,
        );
        return $release;
    }

    protected function getR20110()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '2.1.10',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-04-08',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pdf_utf32_to_utf16'            => null,
        );
        return $release;
    }

    protected function getR30001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-07-25',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pdf_add_path_point'            => null,
            'pdf_add_portfolio_file'        => null,
            'pdf_add_portfolio_folder'      => null,
            'pdf_align'                     => null,
            'pdf_begin_dpart'               => null,
            'pdf_begin_glyph_ext'           => null,
            'pdf_begin_mc'                  => null,
            'pdf_circular_arc'              => null,
            'pdf_close_font'                => null,
            'pdf_close_graphics'            => null,
            'pdf_convert_to_unicode'        => null,
            'pdf_delete_path'               => null,
            'pdf_draw_path'                 => null,
            'pdf_ellipse'                   => null,
            'pdf_elliptical_arc'            => null,
            'pdf_end_dpart'                 => null,
            'pdf_end_template_ext'          => null,
            'pdf_fill_graphicsblock'        => null,
            'pdf_fit_graphics'              => null,
            'pdf_get_option'                => null,
            'pdf_get_string'                => null,
            'pdf_info_graphics'             => null,
            'pdf_info_image'                => null,
            'pdf_info_path'                 => null,
            'pdf_info_pdi_page'             => null,
            'pdf_info_pvf'                  => null,
            'pdf_load_asset'                => null,
            'pdf_load_graphics'             => null,
            'pdf_mc_point'                  => null,
            'pdf_poca_delete'               => null,
            'pdf_poca_insert'               => null,
            'pdf_poca_new'                  => null,
            'pdf_poca_remove'               => null,
            'pdf_set_graphics_option'       => null,
            'pdf_set_option'                => null,
            'pdf_set_text_option'           => null,
            'pdf_utf16_to_utf32'            => null,
            'pdf_utf32_to_utf8'             => null,
            'pdf_utf8_to_utf32'             => null,
        );
        return $release;
    }

    protected function getR30002()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '3.0.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-12-19',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->functions = array(
            'pdf_begin_pattern_ext'         => null,
        );
        return $release;
    }
}
