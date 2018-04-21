<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}

$error = [];
$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //------------------------------------------------------------------------------------
    // Validate Form Input
    //------------------------------------------------------------------------------------

    if (empty($_POST['password']))
    {
        $error['password'] = 'Current Password Required.';
    }

    if (empty($_POST['new_password']))
    {
        $error['new_password'] = 'New Password Required.';
    }

    if (empty($_POST['confirm_new_password']))
    {
        $error['confirm_new_password'] = 'Confirm New Password Required.';
    }
    elseif ($_POST['new_password'] != $_POST['confirm_new_password'])
    {
        $error['confirm_new_password'] = 'Passwords do not match.';
    }

    $sql = 'SELECT password FROM users WHERE user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $row = $stmt->fetch();

    if (!password_verify($_POST['password'], $row['password']))
    {
        $error[] = 'Current Password Incorrect';
    }

    // -----------------------------------------------------------------------------------
    // Check for errors
    // -----------------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {
        $hashed_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET password = ? WHERE user_id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$hashed_password, $_SESSION['user_id']]);
        header("Location: ./logout.php");
        die;

    } // End Else
} // End POST

if ($show_error)
{
    show_form_errors($error);
}

include './templates/form_change_password.php';
