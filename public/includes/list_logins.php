<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}

/**
 * Displays Login Attempt Data
 */

//use PerfectApp\Database\MysqlConnection;
//use PerfectApp\Database\MysqlQuery;

//----------------------------------------------------------------------------------------
// Create PDO DB Connection
//----------------------------------------------------------------------------------------
/*$db = new MysqlConnection();
$pdo = $db->connect();*/

/*if (!is_object($pdo))
{
    return false;
}*/
use PerfectApp\Database\MysqlQuery;
$loginAttempts = new MysqlQuery($pdo);
include './templates/listLoginAttempts.php';