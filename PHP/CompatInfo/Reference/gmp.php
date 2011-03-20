<?php
/**
 * Version informations about gmp extension
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
 * All interfaces, classes, functions, constants about gmp extension
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @link     http://www.php.net/manual/en/book.gmp.php
 */
class PHP_CompatInfo_Reference_Gmp implements PHP_CompatInfo_Reference
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
        // From doc : These functions have been added in PHP 4.0.4.
        // Note: This extension is available on Windows platforms since PHP 5.1.0.
        $extensions = array(
            'gmp' => array('4.0.4', '', '')
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
     * @link   http://www.php.net/manual/en/ref.gmp.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'gmp_abs'                => array('4.0.4', ''),
                'gmp_add'                => array('4.0.4', ''),
                'gmp_and'                => array('4.0.4', ''),
                'gmp_clrbit'             => array('4.0.4', ''),
                'gmp_cmp'                => array('4.0.4', ''),
                'gmp_com'                => array('4.0.4', ''),
                'gmp_div_q'              => array('4.0.4', ''),
                'gmp_div_qr'             => array('4.0.4', ''),
                'gmp_div_r'              => array('4.0.4', ''),
                'gmp_div'                => array('4.0.4', ''),
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
                'gmp_xor'                => array('4.0.4', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'gmp_nextprime'          => array('5.2.0', ''),
                'gmp_testbit'            => array('5.3.0', ''),
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
     * @link   http://www.php.net/manual/en/gmp.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'GMP_ROUND_ZERO'           => array('4.0.4', ''),
                'GMP_ROUND_PLUSINF'        => array('4.0.4', ''),
                'GMP_ROUND_MINUSINF'       => array('4.0.4', ''),
                'GMP_VERSION'              => array('4.0.4', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
