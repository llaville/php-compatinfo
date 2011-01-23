<?php
/**
 * All interfaces, classes, functions, constants about pcre extension
 *
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @link       http://www.php.net/manual/en/book.pcre.php
 */

require_once 'PHP/CompatInfo/Reference.php';

class PHP_CompatInfo_Reference_Pcre implements PHP_CompatInfo_Reference
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
            'pcre' => array('4.0.0', '', '')
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
     * @link   http://www.php.net/manual/en/ref.pcre.php
     */
    public function getFunctions($extension = null, $version = null)
    {
        $functions = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'preg_match'                     => array('4.0.0', ''),
                'preg_match_all'                 => array('4.0.0', ''),
                'preg_replace'                   => array('4.0.0', ''),
                'preg_replace_callback'          => array('4.0.5', ''),
                'preg_split'                     => array('4.0.0', ''),
                'preg_quote'                     => array('4.0.0', ''),
                'preg_grep'                      => array('4.0.0', ''),
            );
            $functions = array_merge(
                $functions,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'preg_filter'                    => array('5.3.0', ''),
                'preg_last_error'                => array('5.2.0', ''),
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
     * @link   http://www.php.net/manual/en/pcre.constants.php
     */
    public function getConstants($extension = null, $version = null)
    {
        $constants = array();

        if ((null == $version ) || ('4' == $version)) {
            $version4 = array(
                'PREG_PATTERN_ORDER'             => array('4.0.0', ''),
                'PREG_SET_ORDER'                 => array('4.0.0', ''),
                'PREG_OFFSET_CAPTURE'            => array('4.3.0', ''),
                'PREG_SPLIT_NO_EMPTY'            => array('4.0.0', ''),
                'PREG_SPLIT_DELIM_CAPTURE'       => array('4.0.5', ''),
                'PREG_SPLIT_OFFSET_CAPTURE'      => array('4.3.0', ''),
                'PREG_GREP_INVERT'               => array('4.0.0', ''),
            );
            $constants = array_merge(
                $constants,
                $version4
            );
        }
        if ((null == $version ) || ('5' == $version)) {
            $version5 = array(
                'PREG_NO_ERROR'                  => array('5.2.0', ''),
                'PREG_INTERNAL_ERROR'            => array('5.2.0', ''),
                'PREG_BACKTRACK_LIMIT_ERROR'     => array('5.2.0', ''),
                'PREG_RECURSION_LIMIT_ERROR'     => array('5.2.0', ''),
                'PREG_BAD_UTF8_ERROR'            => array('5.2.0', ''),
                'PREG_BAD_UTF8_OFFSET_ERROR'     => array('5.3.0', ''),
                'PCRE_VERSION'                   => array('5.2.4', ''),
            );
            $constants = array_merge(
                $constants,
                $version5
            );
        }

        return $constants;
    }

}
