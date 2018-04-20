<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/2/2018
 * Time: 8:14 PM
 */

namespace PerfectApp;

use PDO;
use PerfectApp\Mail\MailSubmissionAgent;


/**
 * Class StandardUserRegistration
 * @package PerfectApp
 */
class StandardUserRegistration implements UserRegistration
{
    /**
     * @var PDO the connection to the underlying database
     */
    protected $pdo;

    /**
     * @var MailSubmissionAgent
     */
    private $mailSubmissionAgent;


    /**
     * StandardUserRegistration constructor.
     * @param MailSubmissionAgent $mailSubmissionAgent
     * @param PDO $pdo
     */
    public function __construct(MailSubmissionAgent $mailSubmissionAgent, PDO $pdo)
    {
        $this->mailSubmissionAgent = $mailSubmissionAgent;
        $this->pdo = $pdo;
    }


    /**
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $username
     * @param $password
     * @return mixed|void
     */
    public function register($firstName, $lastName, $email, $username, $password)
    {
        $raw_token = openssl_random_pseudo_bytes(16);
        $encoded_token = bin2hex($raw_token);
        $token_hash = hash('sha256', $raw_token);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try
        {
            $sql = '
            INSERT INTO
              users (
                first_name
              , last_name
              , email
              , username
              , password
              , verify_email_hash
              )
            VALUES (?,?,?,?,?,?)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                  $firstName
                , $lastName
                , $email
                , $username
                , $hashed_password
                , $token_hash
            ]);

            $subject = 'Confirm Email';
            $body = "Click to activate account\r\n" . APPLICATION_URL . "/activate.php?k=$encoded_token";
            $this->mailSubmissionAgent->send($email, $subject, $body, ADMIN_EMAIL_FROM);

            header("Location: ./login.php?confirm");
            die;
        }

        catch (\PDOException $e)
        {
            if ($e->getCode() == '23000')
            {
                $error[] = "Registration Failed";
                $error[] = "Invalid Username or Email";
                show_form_errors($error);
            }
            else
            {
                throw $e;
            }
        } // End Catch
    }
}
