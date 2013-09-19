<?php
/**
 * Data dictionary for ALL references
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
 * Data dictionary for ALL references
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 2.5.0
 */
class PHP_CompatInfo_Reference_ALL
    extends PHP_CompatInfo_Reference_PHP5
{
    /**
     * Class constructor of ALL References
     *
     * @param array $extensions OPTIONAL List of extensions to look for
     *                          (default: all supported by current platform)
     */
    public function __construct($extensions = null)
    {
        if (!isset($extensions)) {
            $extensions = self::getDatabaseExtensions();
        }
        parent::__construct($extensions);
    }

    /**
     * Get all extensions know in the database
     *
     * @return array
     */
    static public function getDatabaseExtensions()
    {
        $dir = new DirectoryIterator(dirname(__FILE__));
        $excludes = array(
            'PluginsAbstract.php', 'PHP5.php', 'ALL.php', 'DYN.php'
        );
        $exceptions = array(
            'core'       => 'Core',
            'oauth'      => 'OAuth',
            'pdflib'     => 'PDFlib',
            'pdo'        => 'PDO',
            'phar'       => 'Phar',
            'reflection' => 'Reflection',
            'simplexml'  => 'SimpleXML',
            'spl'        => 'SPL',
            'sqlite'     => 'SQLite',
            'xcache'     => 'XCache',
            'zendopcache'=> 'Zend OPcache',
        );
        $extensions = array();
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile()) {
                $fn = $fileinfo->getFilename();
                if (in_array($fn, $excludes)) {
                    continue;
                }
                $name = basename($fn, '.php');
                if (array_key_exists($name, $exceptions)) {
                    $name = $exceptions[$name];
                }
                $extensions[] = $name;
            }
        }

        return $extensions;
    }

}
