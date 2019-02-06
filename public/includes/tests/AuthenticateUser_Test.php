<?php declare (strict_types=1);

/*
CURRENT PROGRAM FLOW
1. Compare user submitted username & password to DB username & password.
2. If username and password valid return true
*/

$username = 'user';
$password = 'pass';

use PerfectApp\Auth\AuthenticateUser;

$user = new AuthenticateUser($pdo);
echo $user->check($username, $password) ? 'Valid Login' : 'Invalid Login';