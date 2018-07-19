<?php
/**
 * Last Modified <!--%TimeStamp%-->04/02/2018 11:30 AM<!---->
 */

ob_start();// Only needed when Debugging is turned on

use PerfectApp\Auth\AuthenticateUser;
use PerfectApp\Logging\SQLLoginAttemptsLog;
use PerfectApp\Utilities\DisplayActionMessage;

//----------------------------------------------------------------------------------------
// Allow direct access to this page
//----------------------------------------------------------------------------------------

define('SECURE_PAGE', true);
require('./config.php');

$error = [];
$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $_POST = array_map('trim', $_POST);

    //------------------------------------------------------------------------------------
    // Validate Form Input
    //------------------------------------------------------------------------------------

    if (empty($_POST['username']))
    {
        $error['username'] = 'Username Required.';
    }
    if (empty($_POST['password']))
    {
        $error['password'] = 'Password Required.';
    }

    //------------------------------------------------------------------------------------
    // Display Errors
    //------------------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {
        $login_attempt = new SQLLoginAttemptsLog($pdo);
        $user = new AuthenticateUser($pdo);
        $row = $user->check($_POST['username'], $_POST['password']);

        // Username and/or Password didn't match
        if (!$row)
        {
            $login_attempt->logFailedAttempt($_POST['username']);
            header("Location: {$_SERVER['SCRIPT_NAME']}?failed_login");
            die;
        }
        elseif (!$row['is_active'])
        {
            $login_attempt->logFailedAttempt($_POST['username']);
            header("Location: ./login.php?inactive");
            die;
        }
        else
        {
            //----------------------------------------------------------------------------
            // Log successful login attempt & Update Last Login Datetime
            //----------------------------------------------------------------------------

            $login_attempt->logSuccessfulAttempt($_POST['username']);

            $sql = "UPDATE users SET last_login = NOW() WHERE username = ?;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_POST['username']]);

            //----------------------------------------------------------------------------
            // Set Session Variables
            //----------------------------------------------------------------------------

            session_start();
            session_regenerate_id(true);

            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];

            header("Location: ./index.php");
            die;

        }//End Else
    } // End else
} // End if Post

// ---------------------------------------------------------------------------------------
// Login Form
// ---------------------------------------------------------------------------------------

include './includes/header.php';
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);

echo DisplayActionMessage::actionMessage();

// ---------------------------------------------------------------------------------------
// Display Form Errors
// ---------------------------------------------------------------------------------------

if ($show_error)
{
    show_form_errors($error);
}

// ---------------------------------------------------------------------------------------
// Display Form & Footer
// ---------------------------------------------------------------------------------------

include './templates/form_login.php';
include './includes/footer.php';
