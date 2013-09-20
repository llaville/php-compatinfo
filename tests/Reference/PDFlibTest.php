<?php
/**
 * Unit tests for PHP_CompatInfo package, PDFlib Reference
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
 * @since      Class available since Release 2.23.0
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving components informations
 * about PDFlib extension
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
class PHP_CompatInfo_Reference_PDFlibTest
    extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * Sets up the fixture.
     *
     * @covers PHP_CompatInfo_Reference_PDFlib::getClasses
     * @covers PHP_CompatInfo_Reference_PDFlib::getFunctions
     * @covers PHP_CompatInfo_Reference_PDFlib::getConstants
     * @return void
     */
    protected function setUp()
    {
        // functions only available if PDFLIB_MAJORVERSION >= 8
        // so not available with pdflib-lite free library
        $this->optionalfunctions = array(
            'pdf_add_path_point',
            'pdf_add_portfolio_file',
            'pdf_add_portfolio_folder',
            'pdf_align',
            'pdf_begin_dpart',
            'pdf_begin_glyph_ext',
            'pdf_circular_arc',
            'pdf_close_font',
            'pdf_close_graphics',
            'pdf_convert_to_unicode',
            'pdf_delete_path',
            'pdf_draw_path',
            'pdf_ellipse',
            'pdf_elliptical_arc',
            'pdf_end_dpart',
            'pdf_end_template_ext',
            'pdf_fill_graphicsblock',
            'pdf_fit_graphics',
            'pdf_get_option',
            'pdf_get_string',
            'pdf_info_graphics',
            'pdf_info_image',
            'pdf_info_path',
            'pdf_info_pdi_page',
            'pdf_info_pvf',
            'pdf_load_asset',
            'pdf_load_graphics',
            'pdf_poca_delete',
            'pdf_poca_insert',
            'pdf_poca_new',
            'pdf_poca_remove',
            'pdf_set_graphics_option',
            'pdf_set_option',
            'pdf_set_text_option',
            'pdf_utf16_to_utf32',
            'pdf_utf8_to_utf16',
            'pdf_utf8_to_utf32',
            'pdf_utf32_to_utf8',
        );
        $this->obj = new PHP_CompatInfo_Reference_PDFlib();
        parent::setUp();
    }
}
