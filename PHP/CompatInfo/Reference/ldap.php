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
class PHP_CompatInfo_Reference_Ldap implements PHP_CompatInfo_Reference
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
            'ldap' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.ldap.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'ldap_add'                       => array('4.0.0', ''),
                'ldap_bind'                      => array('4.0.0', ''),
                'ldap_close'                     => array('4.0.0', ''),
                'ldap_compare'                   => array('4.0.2', ''),
                'ldap_connect'                   => array('4.0.0', ''),
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
                'ldap_search'                    => array('4.0.0', '', '4.0.0, 4.0.0, 4.0.0, 4.0.0, 4.0.2, 4.0.2, 4.0.2, 4.0.2'),
                'ldap_set_rebind_proc'           => array('4.2.0', ''),
                'ldap_set_option'                => array('4.0.4', ''),
                'ldap_sort'                      => array('4.2.0', ''),
                'ldap_start_tls'                 => array('4.2.0', ''),
                'ldap_unbind'                    => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'ldap_sasl_bind'                 => array('5.0.0', ''),
                'ldap_control_paged_result'      => array('5.4.0-dev', ''),
                'ldap_control_paged_result_response'
                                                 => array('5.4.0-dev', ''),
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
     * @link   http://www.php.net/manual/en/ldap.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
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
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'LDAP_OPT_NETWORK_TIMEOUT'       => array('5.3.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
