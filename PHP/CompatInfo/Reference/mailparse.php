<?php
/**
 * Version informations about mailparse extension
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
 * All interfaces, classes, functions, constants about mailparse extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.mailparse.php
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_Mailparse
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'mailparse';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '2.1.6';  // 2012-03-09 (stable)

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
        $phpMin = '4.3.0';
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

        $release = '0.9';         // 2002-12-12 (beta)
        $items = array(
            'mimemessage'                             => array('4.3.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.mailparse.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.9';         // 2002-12-12 (beta)
        $items = array(
            'mailparse_determine_best_xfer_encoding'  => array('4.3.0', ''),
            'mailparse_msg_create'                    => array('4.3.0', ''),
            'mailparse_msg_extract_part'              => array('4.3.0', ''),
            'mailparse_msg_extract_part_file'         => array('4.3.0', ''),
            'mailparse_msg_extract_whole_part_file'   => array('4.3.0', ''),
            'mailparse_msg_free'                      => array('4.3.0', ''),
            'mailparse_msg_get_part'                  => array('4.3.0', ''),
            'mailparse_msg_get_part_data'             => array('4.3.0', ''),
            'mailparse_msg_get_structure'             => array('4.3.0', ''),
            'mailparse_msg_parse'                     => array('4.3.0', ''),
            'mailparse_msg_parse_file'                => array('4.3.0', ''),
            'mailparse_rfc822_parse_addresses'        => array('4.3.0', ''),
            'mailparse_stream_encode'                 => array('4.3.0', ''),
            'mailparse_test'                          => array('4.3.0', ''),
            'mailparse_uudecode_all'                  => array('4.3.0', ''),
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
     * @link   http://www.php.net/manual/en/mailparse.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '0.9';         // 2002-12-12 (beta)
        $items = array(
            'MAILPARSE_EXTRACT_OUTPUT'                => array('4.3.0', ''),
            'MAILPARSE_EXTRACT_RETURN'                => array('4.3.0', ''),
            'MAILPARSE_EXTRACT_STREAM'                => array('4.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
