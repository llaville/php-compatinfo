<?php
/**
 * Version informations about ldap extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about ldap extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.ldap.php
 */
class PHP_CompatInfo_Reference_Ldap
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'ldap';

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
     * @link   http://www.php.net/manual/en/ref.ldap.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'ldap_add'                       => array('4.0.0', ''),
            'ldap_bind'                      => array('4.0.0', ''),
            'ldap_close'                     => array('4.0.0', ''),
            'ldap_compare'                   => array('4.0.2', ''),
            'ldap_connect'                   => array('4.0.0', ''),
            'ldap_control_paged_result'      => array('5.4.0', ''),
            'ldap_control_paged_result_response'
                                             => array('5.4.0', ''),
            'ldap_count_entries'             => array('4.0.0', ''),
            'ldap_delete'                    => array('4.0.0', ''),
            'ldap_dn2ufn'                    => array('4.0.0', ''),
            'ldap_err2str'                   => array('4.0.0', ''),
            'ldap_errno'                     => array('4.0.0', ''),
            'ldap_error'                     => array('4.0.0', ''),
            'ldap_explode_dn'                => array('4.0.0', ''),
            'ldap_first_attribute'           => array('4.0.0', ''),
            'ldap_first_entry'               => array('4.0.0', ''),
            'ldap_first_reference'           => array('4.0.5', ''),
            'ldap_free_result'               => array('4.0.0', ''),
            'ldap_get_attributes'            => array('4.0.0', ''),
            'ldap_get_dn'                    => array('4.0.0', ''),
            'ldap_get_entries'               => array('4.0.0', ''),
            'ldap_get_option'                => array('4.0.4', ''),
            'ldap_get_values'                => array('4.0.0', ''),
            'ldap_get_values_len'            => array('4.0.0', ''),
            'ldap_list'                      => array('4.0.0', ''),
            'ldap_mod_add'                   => array('4.0.0', ''),
            'ldap_mod_del'                   => array('4.0.0', ''),
            'ldap_mod_replace'               => array('4.0.0', ''),
            'ldap_modify'                    => array('4.0.0', ''),
            'ldap_next_attribute'            => array('4.0.0', ''),
            'ldap_next_entry'                => array('4.0.0', ''),
            'ldap_next_reference'            => array('4.0.5', ''),
            'ldap_parse_reference'           => array('4.0.5', ''),
            'ldap_parse_result'              => array('4.0.5', ''),
            'ldap_read'                      => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.0, 4.0.2, 4.0.2, 4.0.2, 4.0.2'),
            'ldap_rename'                    => array('4.0.5', ''),
            'ldap_sasl_bind'                 => array('5.0.0', ''),
            'ldap_search'                    => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.0, 4.0.2, 4.0.2, 4.0.2, 4.0.2'),
            'ldap_set_option'                => array('4.0.4', ''),
            'ldap_set_rebind_proc'           => array('4.2.0', ''),
            'ldap_sort'                      => array('4.2.0', ''),
            'ldap_start_tls'                 => array('4.2.0', ''),
            'ldap_unbind'                    => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/ldap.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'LDAP_DEREF_ALWAYS'              => array('4.0.0', ''),
            'LDAP_DEREF_FINDING'             => array('4.0.0', ''),
            'LDAP_DEREF_NEVER'               => array('4.0.0', ''),
            'LDAP_DEREF_SEARCHING'           => array('4.0.0', ''),
            'LDAP_OPT_CLIENT_CONTROLS'       => array('4.0.0', ''),
            'LDAP_OPT_DEBUG_LEVEL'           => array('4.0.0', ''),
            'LDAP_OPT_DEREF'                 => array('4.0.0', ''),
            'LDAP_OPT_ERROR_NUMBER'          => array('4.0.0', ''),
            'LDAP_OPT_ERROR_STRING'          => array('4.0.0', ''),
            'LDAP_OPT_HOST_NAME'             => array('4.0.0', ''),
            'LDAP_OPT_MATCHED_DN'            => array('4.0.0', ''),
            'LDAP_OPT_NETWORK_TIMEOUT'       => array('5.3.0', ''),
            'LDAP_OPT_PROTOCOL_VERSION'      => array('4.0.0', ''),
            'LDAP_OPT_REFERRALS'             => array('4.0.0', ''),
            'LDAP_OPT_RESTART'               => array('4.0.0', ''),
            'LDAP_OPT_SERVER_CONTROLS'       => array('4.0.0', ''),
            'LDAP_OPT_SIZELIMIT'             => array('4.0.0', ''),
            'LDAP_OPT_TIMELIMIT'             => array('4.0.0', ''),
            'LDAP_OPT_X_SASL_AUTHCID'        => array('4.0.0', ''),
            'LDAP_OPT_X_SASL_AUTHZID'        => array('4.0.0', ''),
            'LDAP_OPT_X_SASL_MECH'           => array('4.0.0', ''),
            'LDAP_OPT_X_SASL_REALM'          => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
