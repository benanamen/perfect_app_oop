<?php declare(strict_types=1);

require '../config.php';

use PerfectApp\Utilities\ActionMessages;
use PerfectApp\Utilities\MesssageHTML;
use PerfectApp\Utilities\MesssageJson;

$actions_array = [
      'insert' => ['status' => 'success', 'message' => 'Record Inserted']
    , 'update' => ['status' => 'success', 'message' => 'Record Updated']
    , 'delete' => ['status' => 'success', 'message' => 'Record Deleted']
    , 'reset' => ['status' => 'success', 'message' => 'Your password has been reset.']
    , 'logout' => ['status' => 'success', 'message' => 'You have been successfuly logged out.']
    , 'confirm' => ['status' => 'success', 'message' => 'Email confirmation instructions have been sent. Check your spam folder.']
    , 'verified' => ['status' => 'success', 'message' => 'Your email has been verified. You may login now.']
    , 'registered' => ['status' => 'success', 'message' => 'Email sent with instructions to confirm your email.']
    , 'reset_sent' => ['status' => 'info', 'message' => 'If your email is in our system you will receive reset instructions.']
    , 'failed_login' => ['status' => 'error_custom', 'message' => 'Invalid Login']
    , 'inactive' => ['status' => 'error_custom', 'message' => 'Inactive Account']
    , 'failed_reset' => ['status' => 'error_custom', 'message' => 'Password Reset Failed']
    , 'failed_confirmation' => ['status' => 'error_custom', 'message' => 'Invalid/Expired Token']
    ];

//==============================================
// TEST
//==============================================
//$_GET['message'] = 'update';
//$msg = $_GET['message'];

foreach ($actions_array as $key=>$value)
{

    $messages = new ActionMessages($actions_array);

    $a = new MesssageHTML($messages);
    $b = new MesssageJson($messages);

    var_dump($a->render($key));
    var_dump($b->render($key));

}
