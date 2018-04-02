<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/1/2018
 * Time: 7:06 PM
 */

namespace PerfectApp\Auth;

use PDO;

/**
 * Class AuthenticateUser
 * @package PerfectApp\Auth
 */
class AuthenticateUser
{
    /**
     * @var PDO the connection to the underlying database
     */
    protected $pdo;

    /**
     * AuthenticateUser constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Checks whether a username/password combination is valid
     *
     * @param string $username the username to be checked
     * @param string $password the corresponding password
     *
     * @return boolean the result of the check
     */
    public function check($username, $password)
    {
        $passwordHashStmt = $this->pdo->prepare('
    SELECT password
    FROM users
    WHERE username = ?
');
        $passwordHashStmt->execute([$username]);
        $passwordHash = $passwordHashStmt->fetchColumn();
        return $passwordHash && password_verify($password, $passwordHash);
    }
}