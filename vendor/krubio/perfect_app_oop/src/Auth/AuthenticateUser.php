<?php declare(strict_types=1);

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
     * @param string $username
     * @param string $password
     * @return bool|mixed
     */
    public function check($username, $password)
    {
        $stmt = $this->pdo->prepare('
    SELECT user_id, password, first_name, last_name, is_active
    FROM users
    WHERE username = ?
');
        $stmt->execute([$username]);
        $row = $stmt->fetch();

        if ($row && password_verify($password, $row['password']))
        {
            return $row;
        }
        return false;
    }
}
