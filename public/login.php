<?php
ob_start();// Only needed when Debugging is turned on
/**
 * Last Modified <!--%TimeStamp%-->12/1/2017 8:37 PM<!---->
 */

use PerfectApp\Logging\SQLLoginAttemptsLog;

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

        $sql  = "SELECT username, password, first_name, last_name, is_active FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['username']
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Username didnt match, Redirect.
        if (!$row)
            {
            $login_attempt->logFailedAttempt($_POST['username']);
            header("Location: {$_SERVER['SCRIPT_NAME']}?failed_login");
            die;
            }

        //--------------------------------------------------------------------------------
        // Compare the password to the expected hash.
        //--------------------------------------------------------------------------------

        // Password is good
        if (password_verify($_POST['password'], $row['password']))
            {
            // Person status is inactive
             if (!$row['is_active'])
                {
                header("Location: ./login.php?inactive");
                die;
                }

            //----------------------------------------------------------------------------
            // Log sucessful login attempt & Update Last Login Datetime
            //----------------------------------------------------------------------------

            $sql  = "UPDATE users SET last_login = NOW() WHERE username = ?;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $row['username']
            ]);

            //----------------------------------------------------------------------------
            // Set Session Variables
            //----------------------------------------------------------------------------

            session_start();

            // Destroy old session id and creating a new one
            // Stops Session Fixation
            session_regenerate_id(true);

            $_SESSION['login'] = true;
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name']  = $row['last_name'];

            $login_attempt->logSuccessfulAttempt($_POST['username']);

            header("Location: ./index.php");
            die;
            } // End if password_verify
        else
            {
            $login_attempt->logFailedAttempt($_POST['username']);
            header("Location: {$_SERVER['SCRIPT_NAME']}?failed_login");
            die;
            }
        } // End Else
    } // End if Post

// ---------------------------------------------------------------------------------------
// Login Form
// ---------------------------------------------------------------------------------------

include('./includes/header.php');
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);
use PerfectApp\Utilities\DisplayActionMessage;
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

include('./templates/form_login.php');
include('./includes/footer.php');
