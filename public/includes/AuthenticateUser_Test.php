<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/1/2018
 * Time: 7:12 PM
 */

// ----------------------------------------------------------------------------
// Database Connection
// ----------------------------------------------------------------------------
$dbhost = 'localhost';
$dbname = 'meetmarket_development';
$dbuser = 'root';
$dbpass = '';
$charset = 'utf8';
$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=$charset";
$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];
$pdo = new PDO($dsn, $dbuser, $dbpass, $opt);

/*
CURRENT PROGRAM FLOW
1. Compare user submitted username & password to DB username & password.
2. If username and password valid return true
*/

$username = 'myusername';
$password = 'pass';

use PerfectApp\Auth\AuthenticateUser;

$user = new AuthenticateUser($pdo);
echo $login_status = ($user->check($username, $password)) ? 'Valid Login' : 'Invalid Login';