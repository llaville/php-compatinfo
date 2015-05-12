<?php
/**
 * Reference Interface.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo\Reference;

/**
 * Interface that define a reference (extension).
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.0.0RC1
 */
interface ReferenceInterface
{
    /**
     * Gets the current version of extension loaded on the platform
     *
     * @return mixed FALSE if extension not loaded, otherwise string
     */
    public function getCurrentVersion();

    /**
     * Gets the latest (release) version of an extension.
     *
     * @return string
     */
    public function getLatestVersion();

    /**
     * Gets a list of releases from an extension.
     *
     * @return array
     */
    public function getReleases();

    /**
     * Gets a list of interfaces from an extension.
     *
     * @return array
     */
    public function getInterfaces();

    /**
     * Gets a list of classes from an extension.
     *
     * @return array
     */
    public function getClasses();

    /**
     * Gets a list of functions from an extension.
     *
     * @return array
     */
    public function getFunctions();

    /**
     * Gets a list of constants from an extension.
     *
     * @return array
     */
    public function getConstants();

    /**
     * Gets a list of ini entries from an extension.
     *
     * @return array
     */
    public function getIniEntries();

    /**
     * Gets a list of class constants from an extension.
     *
     * @return array
     */
    public function getClassConstants();

    /**
     * Gets a list of static class methods from an extension.
     *
     * @return array
     */
    public function getClassStaticMethods();

    /**
     * Gets a list of non-static class methods from an extension.
     *
     * @return array
     */
    public function getClassMethods();
}
