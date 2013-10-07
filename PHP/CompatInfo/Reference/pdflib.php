<?php
/**
 * Version informations about PDFlib extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about PDFlib extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.pdflib.php
 * @since    Class available since Release 2.23.0
 */
class PHP_CompatInfo_Reference_PDFlib
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'PDFlib';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '3.0.1';  // 2013-07-25 (stable)

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
        $phpMin = '5.2.0';
        $extensions = array(
            self::REF_NAME => array($phpMin, '', self::REF_VERSION)
        );
        return $extensions;
    }

    /**
     * Gets informations about classes
     *
     * @param string $extension (optional) NULL for PHP version,
     *                          TRUE if extension version
     * @param string $version   (optional) php or extension version
     * @param string $condition (optional) particular relationship with $version
     *                          Same operator values as used by version_compare
     *
     * @return array
     */
    public function getClasses($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $classes = array();

        $release = '2.0.0';       // 2004-06-21 (stable)
        $items = array(
            'PDFlib'                                => array('5.2.0', ''),
            'PDFlibException'                       => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $classes);

        return $classes;
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
     * @link   http://www.php.net/manual/en/ref.pdflib.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '2.0.0';       // 2004-06-21 (stable)
        $items = array(
            'pdf_activate_item'                     => array('5.2.0', ''),
            'pdf_add_bookmark'                      => array('5.2.0', ''),
            'pdf_add_launchlink'                    => array('5.2.0', ''),
            'pdf_add_locallink'                     => array('5.2.0', ''),
            'pdf_add_nameddest'                     => array('5.2.0', ''),
            'pdf_add_note'                          => array('5.2.0', ''),
            'pdf_add_pdflink'                       => array('5.2.0', ''),
            'pdf_add_thumbnail'                     => array('5.2.0', ''),
            'pdf_add_weblink'                       => array('5.2.0', ''),
            'pdf_arc'                               => array('5.2.0', ''),
            'pdf_arcn'                              => array('5.2.0', ''),
            'pdf_attach_file'                       => array('5.2.0', ''),
            'pdf_begin_document'                    => array('5.2.0', ''),
            'pdf_begin_font'                        => array('5.2.0', ''),
            'pdf_begin_glyph'                       => array('5.2.0', ''),
            'pdf_begin_item'                        => array('5.2.0', ''),
            'pdf_begin_layer'                       => array('5.2.0', ''),
            'pdf_begin_page'                        => array('5.2.0', ''),
            'pdf_begin_page_ext'                    => array('5.2.0', ''),
            'pdf_begin_pattern'                     => array('5.2.0', ''),
            'pdf_begin_template'                    => array('5.2.0', ''),
            'pdf_circle'                            => array('5.2.0', ''),
            'pdf_clip'                              => array('5.2.0', ''),
            'pdf_close'                             => array('5.2.0', ''),
            'pdf_close_image'                       => array('5.2.0', ''),
            'pdf_close_pdi'                         => array('5.2.0', ''),
            'pdf_close_pdi_page'                    => array('5.2.0', ''),
            'pdf_closepath'                         => array('5.2.0', ''),
            'pdf_closepath_fill_stroke'             => array('5.2.0', ''),
            'pdf_closepath_stroke'                  => array('5.2.0', ''),
            'pdf_concat'                            => array('5.2.0', ''),
            'pdf_continue_text'                     => array('5.2.0', ''),
            'pdf_create_action'                     => array('5.2.0', ''),
            'pdf_create_annotation'                 => array('5.2.0', ''),
            'pdf_create_bookmark'                   => array('5.2.0', ''),
            'pdf_create_field'                      => array('5.2.0', ''),
            'pdf_create_fieldgroup'                 => array('5.2.0', ''),
            'pdf_create_gstate'                     => array('5.2.0', ''),
            'pdf_create_pvf'                        => array('5.2.0', ''),
            'pdf_create_textflow'                   => array('5.2.0', ''),
            'pdf_curveto'                           => array('5.2.0', ''),
            'pdf_define_layer'                      => array('5.2.0', ''),
            'pdf_delete'                            => array('5.2.0', ''),
            'pdf_delete_pvf'                        => array('5.2.0', ''),
            'pdf_delete_textflow'                   => array('5.2.0', ''),
            'pdf_encoding_set_char'                 => array('5.2.0', ''),
            'pdf_end_document'                      => array('5.2.0', ''),
            'pdf_end_font'                          => array('5.2.0', ''),
            'pdf_end_glyph'                         => array('5.2.0', ''),
            'pdf_end_item'                          => array('5.2.0', ''),
            'pdf_end_layer'                         => array('5.2.0', ''),
            'pdf_end_page'                          => array('5.2.0', ''),
            'pdf_end_page_ext'                      => array('5.2.0', ''),
            'pdf_end_pattern'                       => array('5.2.0', ''),
            'pdf_end_template'                      => array('5.2.0', ''),
            'pdf_endpath'                           => array('5.2.0', ''),
            'pdf_fill'                              => array('5.2.0', ''),
            'pdf_fill_imageblock'                   => array('5.2.0', ''),
            'pdf_fill_pdfblock'                     => array('5.2.0', ''),
            'pdf_fill_stroke'                       => array('5.2.0', ''),
            'pdf_fill_textblock'                    => array('5.2.0', ''),
            'pdf_findfont'                          => array('5.2.0', ''),
            'pdf_fit_image'                         => array('5.2.0', ''),
            'pdf_fit_pdi_page'                      => array('5.2.0', ''),
            'pdf_fit_textflow'                      => array('5.2.0', ''),
            'pdf_fit_textline'                      => array('5.2.0', ''),
            'pdf_get_apiname'                       => array('5.2.0', ''),
            'pdf_get_buffer'                        => array('5.2.0', ''),
            'pdf_get_errmsg'                        => array('5.2.0', ''),
            'pdf_get_errnum'                        => array('5.2.0', ''),
            'pdf_get_parameter'                     => array('5.2.0', ''),
            'pdf_get_pdi_parameter'                 => array('5.2.0', ''),
            'pdf_get_pdi_value'                     => array('5.2.0', ''),
            'pdf_get_value'                         => array('5.2.0', ''),
            'pdf_info_textflow'                     => array('5.2.0', ''),
            'pdf_initgraphics'                      => array('5.2.0', ''),
            'pdf_lineto'                            => array('5.2.0', ''),
            'pdf_load_font'                         => array('5.2.0', ''),
            'pdf_load_iccprofile'                   => array('5.2.0', ''),
            'pdf_load_image'                        => array('5.2.0', ''),
            'pdf_makespotcolor'                     => array('5.2.0', ''),
            'pdf_moveto'                            => array('5.2.0', ''),
            'pdf_new'                               => array('5.2.0', ''),
            'pdf_open_ccitt'                        => array('5.2.0', ''),
            'pdf_open_file'                         => array('5.2.0', ''),
            'pdf_open_image'                        => array('5.2.0', ''),
            'pdf_open_image_file'                   => array('5.2.0', ''),
            'pdf_open_pdi'                          => array('5.2.0', ''),
            'pdf_open_pdi_document'                 => array('5.2.0', ''),
            'pdf_open_pdi_page'                     => array('5.2.0', ''),
            'pdf_place_image'                       => array('5.2.0', ''),
            'pdf_place_pdi_page'                    => array('5.2.0', ''),
            'pdf_process_pdi'                       => array('5.2.0', ''),
            'pdf_rect'                              => array('5.2.0', ''),
            'pdf_restore'                           => array('5.2.0', ''),
            'pdf_resume_page'                       => array('5.2.0', ''),
            'pdf_rotate'                            => array('5.2.0', ''),
            'pdf_save'                              => array('5.2.0', ''),
            'pdf_scale'                             => array('5.2.0', ''),
            'pdf_set_border_color'                  => array('5.2.0', ''),
            'pdf_set_border_dash'                   => array('5.2.0', ''),
            'pdf_set_border_style'                  => array('5.2.0', ''),
            'pdf_set_gstate'                        => array('5.2.0', ''),
            'pdf_set_info'                          => array('5.2.0', ''),
            'pdf_set_layer_dependency'              => array('5.2.0', ''),
            'pdf_set_parameter'                     => array('5.2.0', ''),
            'pdf_set_text_pos'                      => array('5.2.0', ''),
            'pdf_set_value'                         => array('5.2.0', ''),
            'pdf_setcolor'                          => array('5.2.0', ''),
            'pdf_setdash'                           => array('5.2.0', ''),
            'pdf_setdashpattern'                    => array('5.2.0', ''),
            'pdf_setflat'                           => array('5.2.0', ''),
            'pdf_setfont'                           => array('5.2.0', ''),
            'pdf_setlinecap'                        => array('5.2.0', ''),
            'pdf_setlinejoin'                       => array('5.2.0', ''),
            'pdf_setlinewidth'                      => array('5.2.0', ''),
            'pdf_setmatrix'                         => array('5.2.0', ''),
            'pdf_setmiterlimit'                     => array('5.2.0', ''),
            'pdf_setpolydash'                       => array('5.2.0', ''),
            'pdf_shading'                           => array('5.2.0', ''),
            'pdf_shading_pattern'                   => array('5.2.0', ''),
            'pdf_shfill'                            => array('5.2.0', ''),
            'pdf_show'                              => array('5.2.0', ''),
            'pdf_show_boxed'                        => array('5.2.0', ''),
            'pdf_show_xy'                           => array('5.2.0', ''),
            'pdf_skew'                              => array('5.2.0', ''),
            'pdf_stringwidth'                       => array('5.2.0', ''),
            'pdf_stroke'                            => array('5.2.0', ''),
            'pdf_suspend_page'                      => array('5.2.0', ''),
            'pdf_translate'                         => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0.3';       // 2004-11-24 (stable)
        $items = array(
            'pdf_setgray'                           => array('5.2.0', ''),
            'pdf_setgray_fill'                      => array('5.2.0', ''),
            'pdf_setgray_stroke'                    => array('5.2.0', ''),
            'pdf_setrgbcolor'                       => array('5.2.0', ''),
            'pdf_setrgbcolor_fill'                  => array('5.2.0', ''),
            'pdf_setrgbcolor_stroke'                => array('5.2.0', ''),
            'pdf_utf16_to_utf8'                     => array('5.2.0', ''),
            'pdf_utf8_to_utf16'                     => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.1.0';       // 2006-10-05 (stable)
        $items = array(
            'pdf_add_table_cell'                    => array('5.2.0', ''),
            'pdf_add_textflow'                      => array('5.2.0', ''),
            'pdf_begin_template_ext'                => array('5.2.0', ''),
            'pdf_close_pdi_document'                => array('5.2.0', ''),
            'pdf_create_3dview'                     => array('5.2.0', ''),
            'pdf_delete_table'                      => array('5.2.0', ''),
            'pdf_end_mc'                            => array('5.2.0', ''),
            'pdf_fit_table'                         => array('5.2.0', ''),
            'pdf_info_font'                         => array('5.2.0', ''),
            'pdf_info_matchbox'                     => array('5.2.0', ''),
            'pdf_info_table'                        => array('5.2.0', ''),
            'pdf_info_textline'                     => array('5.2.0', ''),
            'pdf_load_3ddata'                       => array('5.2.0', ''),
            'pdf_pcos_get_number'                   => array('5.2.0', ''),
            'pdf_pcos_get_stream'                   => array('5.2.0', ''),
            'pdf_pcos_get_string'                   => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.1.10';      // 2013-04-08 (stable)
        $items = array(
            'pdf_utf32_to_utf16'                    => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '3.0.1';       // 2013-07-25 (stable)
        $items = array(
            'pdf_add_path_point'                    => array('5.2.0', ''),
            'pdf_add_portfolio_file'                => array('5.2.0', ''),
            'pdf_add_portfolio_folder'              => array('5.2.0', ''),
            'pdf_align'                             => array('5.2.0', ''),
            'pdf_begin_dpart'                       => array('5.2.0', ''),
            'pdf_begin_glyph_ext'                   => array('5.2.0', ''),
            'pdf_begin_mc'                          => array('5.2.0', ''),
            'pdf_circular_arc'                      => array('5.2.0', ''),
            'pdf_close_font'                        => array('5.2.0', ''),
            'pdf_close_graphics'                    => array('5.2.0', ''),
            'pdf_convert_to_unicode'                => array('5.2.0', ''),
            'pdf_delete_path'                       => array('5.2.0', ''),
            'pdf_draw_path'                         => array('5.2.0', ''),
            'pdf_ellipse'                           => array('5.2.0', ''),
            'pdf_elliptical_arc'                    => array('5.2.0', ''),
            'pdf_end_dpart'                         => array('5.2.0', ''),
            'pdf_end_template_ext'                  => array('5.2.0', ''),
            'pdf_fill_graphicsblock'                => array('5.2.0', ''),
            'pdf_fit_graphics'                      => array('5.2.0', ''),
            'pdf_get_option'                        => array('5.2.0', ''),
            'pdf_get_string'                        => array('5.2.0', ''),
            'pdf_info_graphics'                     => array('5.2.0', ''),
            'pdf_info_image'                        => array('5.2.0', ''),
            'pdf_info_path'                         => array('5.2.0', ''),
            'pdf_info_pdi_page'                     => array('5.2.0', ''),
            'pdf_info_pvf'                          => array('5.2.0', ''),
            'pdf_load_asset'                        => array('5.2.0', ''),
            'pdf_load_graphics'                     => array('5.2.0', ''),
            'pdf_mc_point'                          => array('5.2.0', ''),
            'pdf_poca_delete'                       => array('5.2.0', ''),
            'pdf_poca_insert'                       => array('5.2.0', ''),
            'pdf_poca_new'                          => array('5.2.0', ''),
            'pdf_poca_remove'                       => array('5.2.0', ''),
            'pdf_set_graphics_option'               => array('5.2.0', ''),
            'pdf_set_option'                        => array('5.2.0', ''),
            'pdf_set_text_option'                   => array('5.2.0', ''),
            'pdf_utf16_to_utf32'                    => array('5.2.0', ''),
            'pdf_utf32_to_utf8'                     => array('5.2.0', ''),
            'pdf_utf8_to_utf32'                     => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
