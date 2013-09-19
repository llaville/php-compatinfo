<?php
/**
 * Version informations about APCu extension
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

/**
 * All interfaces, classes, functions, constants about APCu extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.16.0
 */
class PHP_CompatInfo_Reference_Apcu
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'apcu';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '4.0.2';

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
        $phpMin = '5.3.0';
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
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '4.0.0';       // 2013-03-26 (beta)
        $items = array(
            'apcu_add'                              => array('5.3.0', ''),
            'apcu_bin_dump'                         => array('5.3.0', ''),
            'apcu_bin_dumpfile'                     => array('5.3.0', ''),
            'apcu_bin_load'                         => array('5.3.0', ''),
            'apcu_bin_loadfile'                     => array('5.3.0', ''),
            'apcu_cache_info'                       => array('5.3.0', ''),
            'apcu_cas'                              => array('5.3.0', ''),
            'apcu_clear_cache'                      => array('5.3.0', ''),
            'apcu_dec'                              => array('5.3.0', ''),
            'apcu_delete'                           => array('5.3.0', ''),
            'apcu_exists'                           => array('5.3.0', ''),
            'apcu_fetch'                            => array('5.3.0', ''),
            'apcu_inc'                              => array('5.3.0', ''),
            'apcu_sma_info'                         => array('5.3.0', ''),
            'apcu_store'                            => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.0.2';       // 2013-09-14 (beta)
        $items = array(
            'apcu_key_info'                         => array('5.3.0', ''),
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
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '4.0.1';       // 2013-04-30 (beta)
        $items = array(
            'APCU_APC_FULL_BC'                      => array('5.3.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }
}
