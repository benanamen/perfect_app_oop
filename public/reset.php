<?php

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
    //------------------------------------------------------------------------------------
    // Trim $_POST Array
    //------------------------------------------------------------------------------------

    $_POST = trim_array($_POST);

    //------------------------------------------------------------------------------------
    // Validate Form Input
    //------------------------------------------------------------------------------------

    if (empty($_POST['reset_code']))
    {
        $error['reset_code'] = 'Reset Code Required';
    }
    elseif (strlen($_POST['reset_code']) != 32)
    {
        $error['invalid_token'] = 'Valid Reset Code Required';
    }
    // Decode Token. Rare instance to use @ error suppression
    elseif (!$raw_token = @hex2bin($_POST['reset_code']))
    {
        $error['invalid_token'] = 'Invalid Token';
    }

    if (empty($_POST['new_password']))
    {
        $error['new_password'] = 'New Password Required';
    }

    if (empty($_POST['confirm_new_password']))
    {
        $error['confirm_new_password'] = ' Confirm Password Required';
    }
    elseif ($_POST['new_password'] != $_POST['confirm_new_password'])
    {
        $error['confirm_new_password'] = 'Passwords do not match';
    }

    //------------------------------------------------------------------------------------
    // Check for errors
    //------------------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {
        // Hash raw token
        $token_hash = hash('sha256', $raw_token);

        // Check DB for matching reset key.
        $sql = "SELECT user_id, email, password_reset_hash FROM users WHERE password_reset_hash=? AND password_reset_expires > NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token_hash]);
        $row = $stmt->fetch();

        //--------------------------------------------------------------------------------
        // No Results - Redirect
        //--------------------------------------------------------------------------------

        if (!$row)
        {
            header("Location: {$_SERVER['SCRIPT_NAME']}?action=failed_confirmation");
            die();
        }

        //--------------------------------------------------------------------------------
        // Update Password
        //--------------------------------------------------------------------------------

        $status = 'failed_reset';

        $hashed_new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ?, password_reset_hash = ?, password_reset_expires = ? WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$hashed_new_password, NULL, NULL, $row['user_id']]);

        if ($stmt->rowCount())
        {
            $status = 'reset';

            //--------------------------------------------------------------------------------
            // Send Reset Email
            //--------------------------------------------------------------------------------

            $to = $row['email'];
            $subject = "Password has been reset";
            $email_body = "Password has been reset";
            send_email($to, $subject, $email_body, ADMIN_EMAIL_FROM);
        }

        header("Location: login.php?action=$status");
        die();

    } // End else
} // End !empty POST

//----------------------------------------------------------------------------------------
// Reset Code Form
//----------------------------------------------------------------------------------------

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
// Display Form
// ---------------------------------------------------------------------------------------

$reset_code = isset($_GET['k']) ? $_GET['k'] : $reset_code = isset($_POST['reset_code']) ? $_POST['reset_code'] : '';

include './templates/form_reset.php';
include './includes/footer.php';
