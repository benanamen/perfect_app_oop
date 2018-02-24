<?php
//TODO: Does not handle connection errors
namespace PerfectApp\Database;

use PDO;

/**
 * Class MysqlConnection
 * @package PerfectApp
 */
class MysqlConnection implements DatabaseConnection
{
    /**
     * @return mixed|PDO
     */
    public function connect()
    {
        try
        {
            $dsn = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $opt = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                  , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                  , PDO::ATTR_EMULATE_PREPARES => false];

            return new PDO($dsn, DB_USER, DB_PASSWORD, $opt);
        }
        catch (\PDOException $e)
        {
            $error = $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();
            error_log(MYSQL_DATETIME_TODAY . "|$error\r\n", 3, ERROR_LOG_PATH);

            $subject = "Database Down";
            $email_body = "The Database is down for " . APP_NAME . "\n ERROR: $error";
            send_email(ADMIN_EMAIL_TO, $subject, $email_body, ADMIN_EMAIL_FROM);
            die('<h1><span style="color:red">FATAL ERROR: No Database Connection</span></h1>');
        }
    }
}