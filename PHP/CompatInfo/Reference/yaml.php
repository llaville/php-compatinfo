<?php
/**
 * Version informations about yaml extension
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
 * All interfaces, classes, functions, constants about yaml extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.yaml.php
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_Yaml
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'yaml';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '1.1.0';

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
        $phpMin = '5.2.0';
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
     * @link   http://www.php.net/manual/en/ref.yaml.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'yaml_emit'                               => array('5.2.0', ''),
            'yaml_emit_file'                          => array('5.2.0', ''),
            'yaml_parse'                              => array('5.2.0', ''),
            'yaml_parse_file'                         => array('5.2.0', ''),
            'yaml_parse_url'                          => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/yaml.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'YAML_ANY_BREAK'                          => array('5.2.0', ''),
            'YAML_ANY_ENCODING'                       => array('5.2.0', ''),
            'YAML_ANY_SCALAR_STYLE'                   => array('5.2.0', ''),
            'YAML_BINARY_TAG'                         => array('5.2.0', ''),
            'YAML_BOOL_TAG'                           => array('5.2.0', ''),
            'YAML_CRLN_BREAK'                         => array('5.2.0', ''),
            'YAML_CR_BREAK'                           => array('5.2.0', ''),
            'YAML_DOUBLE_QUOTED_SCALAR_STYLE'         => array('5.2.0', ''),
            'YAML_FLOAT_TAG'                          => array('5.2.0', ''),
            'YAML_FOLDED_SCALAR_STYLE'                => array('5.2.0', ''),
            'YAML_INT_TAG'                            => array('5.2.0', ''),
            'YAML_LITERAL_SCALAR_STYLE'               => array('5.2.0', ''),
            'YAML_LN_BREAK'                           => array('5.2.0', ''),
            'YAML_MAP_TAG'                            => array('5.2.0', ''),
            'YAML_MERGE_TAG'                          => array('5.2.0', ''),
            'YAML_NULL_TAG'                           => array('5.2.0', ''),
            'YAML_PHP_TAG'                            => array('5.2.0', ''),
            'YAML_PLAIN_SCALAR_STYLE'                 => array('5.2.0', ''),
            'YAML_SEQ_TAG'                            => array('5.2.0', ''),
            'YAML_SINGLE_QUOTED_SCALAR_STYLE'         => array('5.2.0', ''),
            'YAML_STR_TAG'                            => array('5.2.0', ''),
            'YAML_TIMESTAMP_TAG'                      => array('5.2.0', ''),
            'YAML_UTF16BE_ENCODING'                   => array('5.2.0', ''),
            'YAML_UTF16LE_ENCODING'                   => array('5.2.0', ''),
            'YAML_UTF8_ENCODING'                      => array('5.2.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
