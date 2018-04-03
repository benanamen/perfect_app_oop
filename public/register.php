<?php
/**
 * Last Modified <!--%TimeStamp%-->4/2/2018 10:030 PM<!---->
 */

use PerfectApp\Mail\PHPMailSubmissionAgent;
use PerfectApp\StandardUserRegistration;

define('SECURE_PAGE', true);
require('./config.php');

$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // -----------------------------------------------------------------------------------
    // Trim Data, Sanitize Input, Check Missing Fields
    // -----------------------------------------------------------------------------------

    include('./includes/validation/validate_registration.php');

    // -----------------------------------------------------------------------------------
    // Check for errors
    // -----------------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {
        $phpMailSubmissionAgent = new PHPMailSubmissionAgent();
        $userRegistration = new StandardUserRegistration($phpMailSubmissionAgent, $pdo);
        $userRegistration->register($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['username'], $_POST['password']);
    } // End Else
} // End POST


logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);

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
require('./includes/header.php');
include('./templates/form_register.php');
include('./includes/footer.php');
