<?php
/**
 * Version informations about snmp extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  SVN: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about snmp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.snmp.php
 */
class PHP_CompatInfo_Reference_Snmp implements PHP_CompatInfo_Reference
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
            'snmp' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.snmp.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'snmp_get_quick_print'              => array('4.0.0', ''),
                'snmp_get_valueretrieval'           => array('4.3.3', ''),
                'snmp_set_enum_print'               => array('4.3.0', ''),
                'snmp_set_oid_numeric_print'        => array('4.3.0', ''),
                'snmp_set_quick_print'              => array('4.0.0', ''),
                'snmp_set_valueretrieval'           => array('4.3.3', ''),
                'snmp3_get'                         => array('4.3.0', ''),
                'snmp3_real_walk'                   => array('4.3.0', ''),
                'snmp3_set'                         => array('4.3.0', ''),
                'snmp3_walk'                        => array('4.3.0', ''),
                'snmpget'                           => array('4.0.0', ''),
                'snmprealwalk'                      => array('4.0.0', ''),
                'snmpset'                           => array('4.0.0', ''),
                'snmpwalk'                          => array('4.0.0', ''),
                'snmpwalkoid'                       => array('4.0.0', ''),
                // Appear in 4.3.11 and 5.0.4
                'snmp2_get'                         => array('4.3.11', ''),
                'snmp2_real_walk'                   => array('4.3.11', ''),
                'snmp2_set'                         => array('4.3.11', ''),
                'snmp2_walk'                        => array('4.3.11', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'snmp_read_mib'                     => array('5.0.0', ''),
                'snmp_set_oid_output_format'        => array('5.2.0', ''),
                'snmpgetnext'                       => array('5.0.0', ''),
                'snmp3_getnext'                     => array('5.0.0', ''),
                'snmp2_getnext'                     => array('5.0.4', ''),
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
     * @link   http://www.php.net/manual/en/snmp.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'SNMP_VALUE_LIBRARY'                => array('4.3.3', ''),
                'SNMP_VALUE_PLAIN'                  => array('4.3.3', ''),
                'SNMP_VALUE_OBJECT'                 => array('4.3.3', ''),
                'SNMP_BIT_STR'                      => array('4.3.3', ''),
                'SNMP_OCTET_STR'                    => array('4.3.3', ''),
                'SNMP_OPAQUE'                       => array('4.3.3', ''),
                'SNMP_NULL'                         => array('4.3.3', ''),
                'SNMP_OBJECT_ID'                    => array('4.3.3', ''),
                'SNMP_IPADDRESS'                    => array('4.3.3', ''),
                'SNMP_COUNTER'                      => array('4.3.3', ''),
                'SNMP_UNSIGNED'                     => array('4.3.3', ''),
                'SNMP_TIMETICKS'                    => array('4.3.3', ''),
                'SNMP_UINTEGER'                     => array('4.3.3', ''),
                'SNMP_INTEGER'                      => array('4.3.3', ''),
                'SNMP_COUNTER64'                    => array('4.3.3', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'SNMP_OID_OUTPUT_FULL'              => array('5.2.0', ''),
                'SNMP_OID_OUTPUT_MODULE'            => array('5.4.0-dev', ''),
                'SNMP_OID_OUTPUT_NONE'              => array('5.4.0-dev', ''),
                'SNMP_OID_OUTPUT_NUMERIC'           => array('5.2.0', ''),
                'SNMP_OID_OUTPUT_SUFFIX'            => array('5.4.0-dev', ''),
                'SNMP_OID_OUTPUT_UCD'               => array('5.4.0-dev', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
