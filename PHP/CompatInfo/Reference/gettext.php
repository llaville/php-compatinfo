<?php
/**
 * Version informations about gettext extension
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
 * All interfaces, classes, functions, constants about gettext extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.gettext.php
 */
class PHP_CompatInfo_Reference_Gettext
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'gettext';

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
     * @link   http://www.php.net/manual/en/ref.gettext.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '4.0.0';       // 2000-05-22 (stable)
        $items = array(
            'bindtextdomain'                 => array('4.0.0', ''),
            'dcgettext'                      => array('4.0.0', ''),
            'dgettext'                       => array('4.0.0', ''),
            'gettext'                        => array('4.0.0', ''),
            'textdomain'                     => array('4.0.0', ''),
            '_'                              => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '4.2.0';       // 2002-04-22 (stable)
        $items = array(
            'bind_textdomain_codeset'        => array('4.2.0', ''),
            'dcngettext'                     => array('4.2.0', ''),
            'dngettext'                      => array('4.2.0', ''),
            'ngettext'                       => array('4.2.0', ''),
        );
        $this->applyFilter($release, $items, $functions);

        return $functions;
    }

}
