<?php
/**
 * Version informations about xmlrpc extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about xmlrpc extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.xmlrpc.php
 */
class PHP_CompatInfo_Reference_Xmlrpc
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'xmlrpc';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.51';

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
        $phpMin = '4.1.0';
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
     * @link   http://www.php.net/manual/en/ref.xmlrpc.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'xmlrpc_decode'                     => array('4.1.0', ''),
            'xmlrpc_decode_request'             => array('4.1.0', ''),
            'xmlrpc_encode'                     => array('4.1.0', ''),
            'xmlrpc_encode_request'             => array('4.1.0', ''),
            'xmlrpc_get_type'                   => array('4.1.0', ''),
            'xmlrpc_is_fault'                   => array('4.3.0', ''),
            'xmlrpc_parse_method_descriptions'  => array('4.1.0', ''),
            'xmlrpc_server_add_introspection_data'
                                                => array('4.1.0', ''),
            'xmlrpc_server_call_method'         => array('4.1.0', ''),
            'xmlrpc_server_create'              => array('4.1.0', ''),
            'xmlrpc_server_destroy'             => array('4.1.0', ''),
            'xmlrpc_server_register_introspection_callback'
                                                => array('4.1.0', ''),
            'xmlrpc_server_register_method'     => array('4.1.0', ''),
            'xmlrpc_set_type'                   => array('4.1.0', ''),
        );

        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
