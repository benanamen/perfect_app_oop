<?php
/**
 * Last Modified <!--%TimeStamp%-->04/25/2018 10:36 AM<!---->
 */

$error = [];
$show_error = false;
require('./config.php');

if (!isset($_GET['k']))
{
    header("Location: ./index.php");
    die;
}

if (empty($_GET['k']))
{
    $error['activation_code'] = 'Activation Code Required';
}
elseif (strlen($_GET['k']) != 32)
{
    $error['invalid_key'] = 'Valid Activation Code Required';
}
// Decode Token. Rare instance to use @ error suppression
elseif (!$raw_token = @hex2bin($_POST['reset_code']))
{
    $error['invalid_token'] = 'Invalid Token';
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

    $sql = "UPDATE users SET is_active=?, is_email_verified=?, verify_email_hash=? WHERE verify_email_hash = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([1, 1, NULL, $token_hash]);

    $status = $stmt->rowCount() ? 'verified' : 'failed_confirmation';
    header("Location: ./login.php?$status");
    die;
}

if ($show_error)
{
    show_form_errors($error);
}
