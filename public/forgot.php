<?php
//----------------------------------------------------------------------------------------
// Allow direct access to this page
//----------------------------------------------------------------------------------------

define('SECURE_PAGE', true);
require('./config.php');

$error = [];
$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //------------------------------------------------------------------------
    // Trim $_POST Array
    //------------------------------------------------------------------------

    $_POST = trim_array($_POST);

    //------------------------------------------------------------------------
    // Validate Form Input
    //------------------------------------------------------------------------

    if (empty($_POST['email']))
    {
        $error['email'] = 'Email Address Required.';
    }
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $error['email'] = 'Enter a valid Email';
    }

    //------------------------------------------------------------------------
    // Check for errors
    //------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {

        // Check DB for matching username and password.
        $sql = "SELECT email FROM users WHERE email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['email']]);
        $row = $stmt->fetch();

        //--------------------------------------------------------------------------------
        // No Results - Redirect, show user reset message even though email invalid
        //--------------------------------------------------------------------------------

        if (!$row)
        {
            header("Location: login.php?reset_sent");
            die;
        }

        //--------------------------------------------------------------------------------
        //
        //--------------------------------------------------------------------------------

        // From http://forums.phpfreaks.com/topic/298729-forgotten-password/?hl=%2Bmcrypt_create_iv#entry1524084
        // generate 16 random bytes
        $raw_token = openssl_random_pseudo_bytes(16);
        $encoded_token = bin2hex($raw_token);
        $token_hash = hash('sha256', $raw_token);

        /**
         * Interval specification.
         *
         * The format starts with the letter P, for "period." Each duration period is
         * represented by an integer value followed by a period designator. If the
         * duration contains time elements, that portion of the specification is
         * preceded by the letter T.
         *
         * @link http://www.php.net/manual/en/dateinterval.construct.php
         *
         * String to time option
         * $password_reset_expiration_datetime = date('Y-m-d H:i:s', strtotime("+5 min"));
         *
         */
        $period_designator = 'PT';
        $timespan = 'M'; //Minutes
        $timespan_add = 5; // Amount of days or minutes

        $time = new DateTime(date('Y-m-d H:i:s'));
        $time->add(new DateInterval($period_designator . $timespan_add . $timespan));

        $password_reset_expires = $time->format('Y-m-d H:i:s');

        $sql = "UPDATE users SET pasword_reset_hash=?, password_reset_expires=? WHERE email = ? ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token_hash, $password_reset_expires, $_POST['email']]);

        //--------------------------------------------------------------------------------
        // Email Reset Data
        //--------------------------------------------------------------------------------

        $subject = APP_NAME . " - Forgot Password";
        $email_body = "We received a password reset request. If you did not request to reset your password just ignore this message.\r\n";
        $email_body .= "Click the link below to set reset password.\r\n\r\n";
        $email_body .= APPLICATION_URL . "/reset.php?k=$encoded_token";

        // Send mail
        send_email("{$row['email']}", $subject, $email_body, ADMIN_EMAIL_FROM);

        header("Location: login.php?reset_sent");
        die;
    } // End else
}

//----------------------------------------------------------------------------------------
// Forgot Password Form
//----------------------------------------------------------------------------------------

include './includes/header.php';
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);

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

include './templates/form_forgot_password.php';
include './includes/footer.php';
