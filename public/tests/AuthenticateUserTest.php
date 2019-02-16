<?php declare(strict_types=1);

//KR This works
use PerfectApp\Database\PdoCrud;

$crud = new PdoCrud($pdo, 'users', 'username');
$user = new AuthenticateUserTest($pdo, $crud);


$_POST['username'] = 'user';
$username = [$_POST['username']];
$_POST['password'] = 'pass';

$sql = 'SELECT user_id, password, first_name, last_name, is_active
    FROM users
    WHERE username = ?';

$row = $user->check($sql, $username, $_POST['password']);

var_dump($row);

/**
 * Class AuthenticateUserTest
 */
class AuthenticateUserTest
{
    /**
     * @var PdoCrud
     */
    public $pdoCrud;
    /**
     * @var PDO the connection to the underlying database
     */
    protected $pdo;

    /**
     * AuthenticateUser constructor.
     * @param PDO $pdo
     * @param  pdoCrud $pdoCrud
     */
    public function __construct(PDO $pdo, PdoCrud $pdoCrud)
    {
        $this->pdo = $pdo;
        $this->pdoCrud = $pdoCrud;
    }

    /**
     * Checks whether a username/password combination is valid
     * @param $sql string
     * @param $username array
     * @param $password string
     * @return bool|mixed
     */
    public function check($sql, $username, $password)
    {
        $stmt = $this->pdoCrud->query($sql, $username);
        $row = $stmt->fetch();

        if ($row && password_verify($password, $row['password']))
        {
            return $row;
        }
        return false;
    }
}
