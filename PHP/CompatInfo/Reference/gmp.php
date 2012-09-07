<?php
/**
 * Version informations about gmp extension
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
 * @link     http://gmplib.org/    The GNU Multiple Precision Arithmetic Library
 * @link     http://www.mpir.org/  Multiple Precision Integers and Rationals - MPIR
 */

/**
 * All interfaces, classes, functions, constants about gmp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.gmp.php
 */
class PHP_CompatInfo_Reference_Gmp
    extends PHP_CompatInfo_Reference_PluginsAbstract
{
    /**
     * Extension/Reference name
     */
    const REF_NAME    = 'gmp';

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
        // From doc : These functions have been added in PHP 4.0.4.
        // Note: This extension is available on Windows platforms since PHP 5.1.0.

        if (DIRECTORY_SEPARATOR == '\\') {
            // Win32 only
            $phpMin = '5.1.0';
        } else {
            $phpMin = '4.0.4';
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
     * @link   http://www.php.net/manual/en/ref.gmp.php
     */
    public function getFunctions($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $functions = array();

        $release = false;
        $items = array(
            'gmp_abs'                => array('4.0.4', ''),
            'gmp_add'                => array('4.0.4', ''),
            'gmp_and'                => array('4.0.4', ''),
            'gmp_clrbit'             => array('4.0.4', ''),
            'gmp_cmp'                => array('4.0.4', ''),
            'gmp_com'                => array('4.0.4', ''),
            'gmp_div'                => array('4.0.4', ''),
            'gmp_div_q'              => array('4.0.4', ''),
            'gmp_div_qr'             => array('4.0.4', ''),
            'gmp_div_r'              => array('4.0.4', ''),
            'gmp_divexact'           => array('4.0.4', ''),
            'gmp_fact'               => array('4.0.4', ''),
            'gmp_gcd'                => array('4.0.4', ''),
            'gmp_gcdext'             => array('4.0.4', ''),
            'gmp_hamdist'            => array('4.0.4', ''),
            'gmp_init'               => array('4.0.4', ''),
            'gmp_intval'             => array('4.0.4', ''),
            'gmp_invert'             => array('4.0.4', ''),
            'gmp_jacobi'             => array('4.0.4', ''),
            'gmp_legendre'           => array('4.0.4', ''),
            'gmp_mod'                => array('4.0.4', ''),
            'gmp_mul'                => array('4.0.4', ''),
            'gmp_neg'                => array('4.0.4', ''),
            'gmp_nextprime'          => array('5.2.0', ''),
            'gmp_or'                 => array('4.0.4', ''),
            'gmp_perfect_square'     => array('4.0.4', ''),
            'gmp_popcount'           => array('4.0.4', ''),
            'gmp_pow'                => array('4.0.4', ''),
            'gmp_powm'               => array('4.0.4', ''),
            'gmp_prob_prime'         => array('4.0.4', ''),
            'gmp_random'             => array('4.0.4', ''),
            'gmp_scan0'              => array('4.0.4', ''),
            'gmp_scan1'              => array('4.0.4', ''),
            'gmp_setbit'             => array('4.0.4', ''),
            'gmp_sign'               => array('4.0.4', ''),
            'gmp_sqrt'               => array('4.0.4', ''),
            'gmp_sqrtrem'            => array('4.0.4', ''),
            'gmp_strval'             => array('4.0.4', ''),
            'gmp_sub'                => array('4.0.4', ''),
            'gmp_testbit'            => array('5.3.0', ''),
            'gmp_xor'                => array('4.0.4', ''),
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
     * @link   http://www.php.net/manual/en/gmp.constants.php
     */
    public function getConstants($extension = null, $version = null, $condition = null)
    {
        $this->setFilter(func_get_args());

        $constants = array();

        $release = false;
        $items = array(
            'GMP_ROUND_MINUSINF'       => array('4.0.4', ''),
            'GMP_ROUND_PLUSINF'        => array('4.0.4', ''),
            'GMP_ROUND_ZERO'           => array('4.0.4', ''),
            'GMP_VERSION'              => array('4.0.4', ''),
        );
        /*
            Windows only:
            The GMP extension now relies on MPIR instead of the GMP library
         */
        if (DIRECTORY_SEPARATOR == '\\') {
            $items['GMP_MPIR_VERSION'] = array('5.3.0', '');
        }
        $this->applyFilter($release, $items, $constants);

        return $constants;
    }

}
