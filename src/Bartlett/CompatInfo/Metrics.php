<?php
/**
 * Metrics identification.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  GIT: $Id$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

namespace Bartlett\CompatInfo;

/**
 * Contains all metrics provided by each standard analyser.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.6.0
 */
final class Metrics
{
    /**
     * Metrics categories
     */
    const SUMMARIES  = 'internals';
    const PACKAGES   = 'packages';
    const NAMESPACES = 'namespaces';
    const USES       = 'uses';
    const EXTENSIONS = 'extensions';
    const INTERFACES = 'interfaces';
    const TRAITS     = 'traits';
    const CLASSES    = 'classes';
    const METHODS    = 'methods';
    const FUNCTIONS  = 'functions';
    const CONSTANTS  = 'constants';
    const CONDITIONS = 'conditions';
    const VERSIONS   = 'versions';

    /**
     * Prefixes of each analyser
     */
    const CLASS_ANALYSER          = 'cla';
    const CODE_CONDITION_ANALYSER = 'cca';
    const CONSTANT_ANALYSER       = 'ca';
    const EXTENSION_ANALYSER      = 'ea';
    const FUNCTION_ANALYSER       = 'fa';
    const INTERFACE_ANALYSER      = 'ia';
    const NAMESPACE_ANALYSER      = 'na';
    const SUMMARY_ANALYSER        = 'sa';
    const TRAIT_ANALYSER          = 'ta';
}
