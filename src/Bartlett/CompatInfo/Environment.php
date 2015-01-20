<?php

namespace Bartlett\CompatInfo;

/**
 * Application Environment.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 3.6.0
 */
class Environment
{
    /**
     * Initializes installation of the Reference database
     *
     * @return \PDO Instance of pdo_sqlite
     */
    public static function initRefDb()
    {
        if ($database = getenv('BARTLETT_COMPATINFO_DB')) {
            return new \PDO('sqlite:' . $database);
        }

        $database = 'compatinfo.sqlite';
        $tempDir  = sys_get_temp_dir() . '/bartlett';

        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }
        $source = dirname(dirname(dirname(__DIR__))) . '/data/' . $database;
        $dest   = $tempDir . '/' . $database;

        if (!file_exists($dest)
            || sha1_file($source) !== sha1_file($dest)
        ) {
            // install DB only if necessary (missing or modified)
            copy($source, $dest);
        }

        $pdo = new \PDO('sqlite:' . $tempDir . '/' . $database);
        return $pdo;
    }
}
