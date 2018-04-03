<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/2/2018
 * Time: 8:27 PM
 */

namespace PerfectApp\Mail;


interface MailSubmissionAgent
{
    /**
     * Sends an e-mail to a single address
     *
     * @param $from    string the sender address
     * @param $to      string the receiver address
     * @param $subject string the mail subject
     * @param $body    string the mail body
     */
    public function send($from, $to, $subject, $body);
}
