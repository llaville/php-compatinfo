<?php
/**
 * Version informations about zlib extension
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
 * All interfaces, classes, functions, constants about zlib extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.zlib.php
 */
class PHP_CompatInfo_Reference_Zlib
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'zlib';

    /**
     * Latest version of Extension/Reference supported
     */
    const REF_VERSION = '2.0';

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
        if (DIRECTORY_SEPARATOR == '\\') {
            // Built-in support for zlib on Windows is available with PHP 4.3.0.
            $phpMin = '4.3.0';
        } else {
            $phpMin = '4.0.0';
        }

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
     * @link   http://www.php.net/manual/en/ref.zlib.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = '1.0';         //
        $items = array(
            'gzclose'                        => array('4.0.0', ''),
            'gzcompress'                     => array('4.0.1', ''),
            'gzdeflate'                      => array('4.0.4', ''),
            'gzencode'                       => array('4.0.4', ''),
            'gzeof'                          => array('4.0.0', ''),
            'gzfile'                         => array('4.0.0', ''),
            'gzgetc'                         => array('4.0.0', ''),
            'gzgets'                         => array('4.0.0', ''),
            'gzgetss'                        => array('4.0.0', ''),
            'gzinflate'                      => array('4.0.4', ''),
            'gzopen'                         => array('4.0.0', ''),
            'gzpassthru'                     => array('4.0.0', ''),
            'gzputs'                         => array('4.0.0', ''),
            'gzread'                         => array('4.0.0', ''),
            'gzrewind'                       => array('4.0.0', ''),
            'gzseek'                         => array('4.0.0', ''),
            'gztell'                         => array('4.0.0', ''),
            'gzuncompress'                   => array('4.0.1', ''),
            'gzwrite'                        => array('4.0.0', ''),
            'ob_gzhandler'                   => array('4.0.4', ''),
            'readgzfile'                     => array('4.0.0', ''),
            'zlib_get_coding_type'           => array('4.3.2', ''),
        );
        $this->applyFilter($release, $items, $functions);

        $release = '2.0';         //
        $items = array(
            'gzdecode'                       => array('5.4.0', ''),
            'zlib_decode'                    => array('5.4.0', ''),
            'zlib_encode'                    => array('5.4.0', ''),
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
     * @link   http://www.php.net/manual/en/zlib.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = '1.0';         //
        $items = array(
            'FORCE_DEFLATE'                 => array('4.0.0', ''),
            'FORCE_GZIP'                    => array('4.0.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        $release = '2.0';         //
        $items = array(
            'ZLIB_ENCODING_DEFLATE'         => array('5.4.0', ''),
            'ZLIB_ENCODING_GZIP'            => array('5.4.0', ''),
            'ZLIB_ENCODING_RAW'             => array('5.4.0', ''),
        );
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
