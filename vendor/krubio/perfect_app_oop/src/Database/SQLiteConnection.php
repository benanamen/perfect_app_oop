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
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            , PDO::ATTR_EMULATE_PREPARES => false];

        return new PDO('sqlite:C:\laragon\www\perfectappoop\vendor\krubio\perfect_app_oop\src\Database\dogsDb_PDO.db', null, null, $opt);
    }
}
