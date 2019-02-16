<?php declare (strict_types=1);

/**
 * Application Configuration
 *
 * @version 2.0.0
 * @author Kevin Rubio
 * @copyright 2018 Galaxy Internet
 * @license Proprietary - No Licence Granted
 * @see http://galaxyinternet.us
 *
 */

namespace PerfectApp\Debug;

/** Required files. */
require '../functions.php';
require "../vendor/autoload.php";

// Custom exception handler function (functions.php)
set_exception_handler('custom_exception');

//----------------------------------------------------------------------------------------
// Application Url
//----------------------------------------------------------------------------------------

define("APPLICATION_URL", "http://{$_SERVER['HTTP_HOST']}");

//----------------------------------------------------------------------------------------
// Set App Name & Admin Email
//----------------------------------------------------------------------------------------

define("APP_NAME", 'My Perfect Application');
define("VERSION", 'v.2.0');

define("ADMIN_EMAIL_TO", 'admin@example.com');
define("ADMIN_EMAIL_FROM", 'DoNotReply@example.com');

//----------------------------------------------------------------------------------------
// Database Connection
//----------------------------------------------------------------------------------------

define('DB_TYPE', 'mysql'); // Database Type
define('DB_NAME', 'perfect_app'); // Database Name
define('DB_USER', 'root'); // Database Username
define('DB_PASSWORD', ''); // Database Password
define('DB_HOST', 'localhost'); // Database Hostname
define('DB_CHARSET', 'utf8mb4'); // Database Charset

//----------------------------------------------------------------------------------------
// Dates & Times
//----------------------------------------------------------------------------------------

// Set Timezone
date_default_timezone_set('America/Los_Angeles');

// MySQL Datetime. Format: 2010-07-15 16:33:56
define("MYSQL_DATETIME_TODAY", date("Y-m-d H:i:s"));

//----------------------------------------------------------------------------------------
// Errors
//----------------------------------------------------------------------------------------

define("EMAIL_ERROR", true); // Email errors to ADMIN_EMAIL_TO
define("LOG_ERROR", true); // Log errors to file

//----------------------------------------------------------------------------------------
// Debugging
//----------------------------------------------------------------------------------------

define("DEBUG", true); // Toggle Debugging

define("SHOW_DEBUG_PARAMS", DEBUG); // Display Sql & Sql Parameters
define("SHOW_SESSION_DATA", DEBUG); // Display Session Data
define("SHOW_POST_DATA", DEBUG); // Display Post Data
define("SHOW_GET_DATA", DEBUG); // Display Get Data
define("SHOW_COOKIE_DATA", false); // Display Cookie Data
define("SHOW_REQUEST_DATA", false); // Display Request Data

if (DEBUG)
{
    ShowDebugData::displayDebugData();
}

//----------------------------------------------------------------------------------------
// Main Logo
//----------------------------------------------------------------------------------------
define("IMAGE_FILENAME", 'logo.png');
define("IMAGE_WIDTH", 320);
define("IMAGE_HEIGHT", 220);
define("IMAGE_ALT", APP_NAME);

//----------------------------------------------------------------------------------------
//  DO NOT EDIT BELOW HERE
//----------------------------------------------------------------------------------------

if (version_compare(PHP_VERSION, '7.1') < 0)
{
    die('Your PHP installation is too old. Requires at least PHP 7.1');
}

define('ABSPATH', __dir__ . DIRECTORY_SEPARATOR);

// Path To error log
define("ERROR_LOG_PATH", ABSPATH . ".." . DIRECTORY_SEPARATOR . "logs" . DIRECTORY_SEPARATOR . "error.log");

//----------------------------------------------------------------------------------------
// Create PDO DB Connection
//----------------------------------------------------------------------------------------

use PerfectApp\Database\MysqlConnection;

$pdo = (new MysqlConnection())->connect();

if (!is_object($pdo))
{
    return false;
}

//----------------------------------------------------------------------------------------
//  Sentry Error Tracking
//----------------------------------------------------------------------------------------

$client = new \Raven_Client('https://8cd1d3113bff47908842b365aee02a7f:191b64007c2b48dfb81e33ace71c362d@sentry.io/301353');
$error_handler = new \Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();

//----------------------------------------------------------------------------------------
//  Display Action Messages
//----------------------------------------------------------------------------------------

define('ACTIONS_ARRAY', [
    'insert' => ['status' => 'success', 'message' => 'Record Inserted']
    , 'update' => ['status' => 'success', 'message' => 'Record Updated']
    , 'delete' => ['status' => 'success', 'message' => 'Record Deleted']
    , 'reset' => ['status' => 'success', 'message' => 'Your password has been reset.']
    , 'logout' => ['status' => 'success', 'message' => 'You have been successfully logged out.']
    , 'confirm' => ['status' => 'success', 'message' => 'Email confirmation instructions have been sent. Check your spam folder.']
    , 'noconfirm' => ['status' => 'error_custom', 'message' => 'Email has not been confirmed.']
    , 'verified' => ['status' => 'success', 'message' => 'Your email has been verified. You may login now.']
    , 'registered' => ['status' => 'success', 'message' => 'Email sent with instructions to confirm your email.']
    , 'reset_sent' => ['status' => 'info', 'message' => 'If your email is in our system you will receive reset instructions.']
    , 'failed_login' => ['status' => 'error_custom', 'message' => 'Invalid Login']
    , 'inactive' => ['status' => 'error_custom', 'message' => 'Inactive Account']
    , 'failed_reset' => ['status' => 'error_custom', 'message' => 'Password Reset Failed']
    , 'failed_confirmation' => ['status' => 'error_custom', 'message' => 'Invalid/Expired Token']
]
);

use PerfectApp\Utilities\ActionMessages;
use PerfectApp\Utilities\MesssageHTML;
$messages = new ActionMessages(ACTIONS_ARRAY);
$action = new MesssageHTML($messages);
define('DISPLAY_ACTION', $action = !empty($_GET['action']) ? $action->render($_GET['action']) : null);
