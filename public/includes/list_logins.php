<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}

/**
 * Displays Login Attempt Data
 */

use PerfectApp\Database\MysqlQuery;
$loginAttempts = new MysqlQuery($pdo);
include './templates/list_logins.php';