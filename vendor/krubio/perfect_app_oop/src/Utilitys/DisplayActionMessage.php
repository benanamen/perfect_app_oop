<?php

namespace PerfectApp\Utilities;

/**
 * Class DisplayActionMessages
 * Display various action messages
 */
class DisplayActionMessage
{

    /**
     * @return string
     */
    public static function actionMessage()
    {
        $status = null;
        $message = null;

        if (isset($_GET['insert']))
        {
            $status = 'success';
            $message = 'Record Inserted';
        }

        if (isset($_GET['update']))
        {
            $status = 'success';
            $message = 'Record Updated';
        }

        if (isset($_GET['delete']))
        {
            $status = 'success';
            $message = 'Record Deleted';
        }

        if (isset($_GET['reset']))
        {
            $status = 'success';
            $message = 'Your password has been reset.';
        }

        if (isset($_GET['logout']))
        {
            $status = 'success';
            $message = 'Successful log out.';
        }

        if (isset($_GET['confirm']))
        {
            $status = 'success';
            $message = 'Email confirmation instructions have been sent. Check your spam folder.';
        }

        if (isset($_GET['verified']))
        {
            $status = 'success';
            $message = 'Your email has been verified. You may login now.';
        }

        if (isset($_GET['registered']))
        {
            $status = 'success';
            $message = 'Email sent with instructions to confirm your email.';
        }

        if (isset($_GET['reset_sent']))
        {
            $status = 'info';
            $message = 'If your email is in our system you will receive reset instructions.';
        }

        if (isset($_GET['failed_login']))
        {
            $status = 'error_custom';
            $message = 'Invalid Login';
        }

        if (isset($_GET['inactive']))
        {
            $status = 'error_custom';
            $message = 'Inactive Account';
        }

        if (isset($_GET['failed_reset']))
        {
            $status = 'error_custom';
            $message = 'Invalid Code';
        }

        if (isset($_GET['failed_confirmation']))
        {
            $status = 'error_custom';
            $message = 'Invalid/Expired Code';
        }

        if ($status)
        {
            return self::show_action_message($status, $message);
        }

        return null;
    }

    /**
     * @param $status
     * @param $message
     * @return string
     */
    public static function show_action_message($status, $message)
    {
        return <<<HTML

    <div class="d-flex p-2 d-flex justify-content-center">
        <div class="col-sm-2 col-md-4 col-form-label">
            <div class="$status">$message</div>
        </div>
    </div>

HTML;
    }
}
