<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/2/2018
 * Time: 8:27 PM
 */

namespace PerfectApp\Mail;


class PHPMailSubmissionAgent implements MailSubmissionAgent
{
    /**
     * @param string $to
     * @param string $subject
     * @param string $message
     * @param string $from
     */
    public function send($to, $subject, $message, $from)
    {
        mail($to, $subject, $message, "From: $from");
    }
}
