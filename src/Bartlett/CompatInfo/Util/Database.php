<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Util;

use Bartlett\CompatInfoDb\DatabaseFactory;
use PDO;

/**
 * Class Database
 * Keep compatibility between PHP_CompatInfo_Db 1.x (deprecated) and 2.x
 * Since version 5.3.0, only compatibility to PHP_CompatInfo_Db 2.x is supported
 */
class Database
{
    public static function versionRefDb()
    {
        $pdo = DatabaseFactory::create('sqlite');

        $stmt = $pdo->prepare(
            'SELECT build_string as "build.string", build_date as "build.date", build_version as "build.version"' .
            ' FROM bartlett_compatinfo_versions'
        );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function initRefDb()
    {
        return DatabaseFactory::create('sqlite');
    }
}
