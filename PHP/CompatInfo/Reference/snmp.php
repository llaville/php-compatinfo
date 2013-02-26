<?php
/**
 * Version informations about snmp extension
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
 * All interfaces, classes, functions, constants about snmp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.snmp.php
 */
class PHP_CompatInfo_Reference_Snmp
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'snmp';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '0.1';

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

        $release = false;
        $items = array(
            'SNMP'                           => array('5.4.0', ''),
            'SNMPException'                  => array('5.4.0', ''),
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
     * @link   http://www.php.net/manual/en/ref.snmp.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'snmp2_get'                         => array('4.3.11', ''),
            'snmp2_getnext'                     => array('5.0.4', ''),
            'snmp2_real_walk'                   => array('4.3.11', ''),
            'snmp2_set'                         => array('4.3.11', ''),
            'snmp2_walk'                        => array('4.3.11', ''),
            'snmp3_get'                         => array('4.3.0', ''),
            'snmp3_getnext'                     => array('5.0.0', ''),
            'snmp3_real_walk'                   => array('4.3.0', ''),
            'snmp3_set'                         => array('4.3.0', ''),
            'snmp3_walk'                        => array('4.3.0', ''),
            'snmp_get_quick_print'              => array('4.0.0', ''),
            'snmp_get_valueretrieval'           => array('4.3.3', ''),
            'snmp_read_mib'                     => array('5.0.0', ''),
            'snmp_set_enum_print'               => array('4.3.0', ''),
            'snmp_set_oid_numeric_print'        => array('4.3.0', ''),
            'snmp_set_oid_output_format'        => array('5.2.0', ''),
            'snmp_set_quick_print'              => array('4.0.0', ''),
            'snmp_set_valueretrieval'           => array('4.3.3', ''),
            'snmpget'                           => array('4.0.0', ''),
            'snmpgetnext'                       => array('5.0.0', ''),
            'snmprealwalk'                      => array('4.0.0', ''),
            'snmpset'                           => array('4.0.0', ''),
            'snmpwalk'                          => array('4.0.0', ''),
            'snmpwalkoid'                       => array('4.0.0', ''),
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
     * @link   http://www.php.net/manual/en/snmp.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'SNMP_BIT_STR'                      => array('4.3.3', ''),
            'SNMP_COUNTER'                      => array('4.3.3', ''),
            'SNMP_COUNTER64'                    => array('4.3.3', ''),
            'SNMP_INTEGER'                      => array('4.3.3', ''),
            'SNMP_IPADDRESS'                    => array('4.3.3', ''),
            'SNMP_NULL'                         => array('4.3.3', ''),
            'SNMP_OBJECT_ID'                    => array('4.3.3', ''),
            'SNMP_OCTET_STR'                    => array('4.3.3', ''),
            'SNMP_OID_OUTPUT_FULL'              => array('5.2.0', ''),
            'SNMP_OID_OUTPUT_MODULE'            => array('5.4.0', ''),
            'SNMP_OID_OUTPUT_NONE'              => array('5.4.0', ''),
            'SNMP_OID_OUTPUT_NUMERIC'           => array('5.2.0', ''),
            'SNMP_OID_OUTPUT_SUFFIX'            => array('5.4.0', ''),
            'SNMP_OID_OUTPUT_UCD'               => array('5.4.0', ''),
            'SNMP_OPAQUE'                       => array('4.3.3', ''),
            'SNMP_TIMETICKS'                    => array('4.3.3', ''),
            'SNMP_UINTEGER'                     => array('4.3.3', ''),
            'SNMP_UNSIGNED'                     => array('4.3.3', ''),
            'SNMP_VALUE_LIBRARY'                => array('4.3.3', ''),
            'SNMP_VALUE_OBJECT'                 => array('4.3.3', ''),
            'SNMP_VALUE_PLAIN'                  => array('4.3.3', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
