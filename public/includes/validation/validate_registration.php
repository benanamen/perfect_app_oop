<?php declare (strict_types=1);

/**
 * Validate Add/Edit Form Data
 * Last Modified <!--%TimeStamp%-->1/14/2017 9:04 PM<!---->
 */

//------------------------------------------------------------------------
// Trim $_POST Array
//------------------------------------------------------------------------

$_POST = trim_array($_POST);

//------------------------------------------------------------------------
// Validate Form Input
//------------------------------------------------------------------------

$error = [];

if (empty($_POST['first_name']))
    {
    $error['first_name'] = 'First Name Required.';
    }

if (empty($_POST['last_name']))
    {
    $error['last_name'] = 'Last Name Required.';
    }

if (empty($_POST['email']))
    {
    $error['email'] = 'Email Address Required.';
    }
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
    $error['email'] = 'Enter a valid Email';
    }

if (empty($_POST['username']))
    {
    $error['username'] = 'Username Required.';
    }

if (empty($_POST['password']))
    {
    $error['password'] = 'Password Required.';
    }
if (empty($_POST['password_confirm']))
    {
    $error['password_confirm'] = 'Confirm Password Required.';
    }
elseif ($_POST['password'] != $_POST['password_confirm'])
    {
    $error['password_confirm'] = 'Passwords do not match.';
    }
