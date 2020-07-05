<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Util;

use Bartlett\CompatInfoDb\DatabaseFactory;
use Bartlett\CompatInfoDb\Environment;
use PDO;

/**
 * Class Database
 * Keep compatibility between PHP_CompatInfo_Db 1.x (deprecated) and 2.x
 */
class Database
{
    public static function versionRefDb()
    {
        if (class_exists('Bartlett\\CompatInfoDb\\Environment')) {
            // CompatInfo DB 1.x
            $versions = Environment::versionRefDb();
        } else {
            // CompatInfo DB 2.x
            $pdo = DatabaseFactory::create('sqlite');

            $stmt = $pdo->prepare(
                'SELECT build_string as "build.string", build_date as "build.date", build_version as "build.version"' .
                ' FROM bartlett_compatinfo_versions'
            );
            $stmt->execute();
            $versions = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $versions;
    }

    public static function initRefDb()
    {
        if (class_exists('Bartlett\\CompatInfoDb\\Environment')) {
            // CompatInfo DB 1.x
            $pdo = Environment::initRefDb();
        } else {
            // CompatInfo DB 2.x
            $pdo = DatabaseFactory::create('sqlite');
        }

        return $pdo;
    }
}
