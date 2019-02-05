<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 * Class SQLiteConnection
 * @package PerfectApp
 */
class SQLiteConnection implements DatabaseConnection
{

    /**
     * @return mixed|PDO
     */
    public function connect()
    {
        $options = [
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false];

        $path = SQLITE_DB_PATH;
        return new PDO("sqlite:$path", null, null, $options);
    }
}
