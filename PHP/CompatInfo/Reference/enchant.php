<?php
/**
 * Version informations about enchant extension
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
 * All interfaces, classes, functions, constants about enchant extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.enchant.php
 */
class PHP_CompatInfo_Reference_Enchant
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'enchant';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.1.0';  // 2009-10-08 (stable)

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
        /*
            0.1.0 until 1.1.0 PHP 5.0.0 ge
         */
        $phpMin = '5.0.0';
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
     * @link   http://www.php.net/manual/en/ref.enchant.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '0.1.0';       // 2004-03-08 (alpha)
        $items = array(
            'enchant_broker_describe'               => array('5.0.0', ''),
            'enchant_broker_dict_exists'            => array('5.0.0', ''),
            'enchant_broker_free_dict'              => array('5.0.0', ''),
            'enchant_broker_free'                   => array('5.0.0', ''),
            'enchant_broker_get_error'              => array('5.0.0', ''),
            'enchant_broker_init'                   => array('5.0.0', ''),
            'enchant_broker_request_dict'           => array('5.0.0', ''),
            'enchant_broker_request_pwl_dict'       => array('5.0.0', ''),
            'enchant_broker_set_ordering'           => array('5.0.0', ''),
            'enchant_dict_add_to_personal'          => array('5.0.0', ''),
            'enchant_dict_add_to_session'           => array('5.0.0', ''),
            'enchant_dict_check'                    => array('5.0.0', ''),
            'enchant_dict_describe'                 => array('5.0.0', ''),
            'enchant_dict_get_error'                => array('5.0.0', ''),
            'enchant_dict_is_in_session'            => array('5.0.0', ''),
            'enchant_dict_store_replacement'        => array('5.0.0', ''),
            'enchant_dict_suggest'                  => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '0.2.0';       // 2004-03-09 (alpha)
        $items = array(
            'enchant_dict_quick_check'              => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.0.1';       // 2006-03-21 (stable)
        $items = array(
            'enchant_broker_list_dicts'             => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '1.1.0';       // 2009-10-08 (stable)
        $items = array(
            'enchant_broker_set_dict_path'          => array('5.0.0', ''),
            'enchant_broker_get_dict_path'          => array('5.0.0', ''),
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
     * @link   http://www.php.net/manual/en/enchant.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '1.1.0';       // 2009-10-08 (stable)
        $items = array(
            'ENCHANT_ISPELL'            => array('5.0.0', ''),
            'ENCHANT_MYSPELL'           => array('5.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
