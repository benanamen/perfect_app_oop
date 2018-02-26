<?php
/**
 * Last Modified <!--%TimeStamp%-->1/14/2017 11:04 PM<!---->
 */

if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}


$referrer = 'No Referrer';
if (isset($_SERVER['HTTP_REFERER']))
{
    $referrer = $_SERVER['HTTP_REFERER'];
}

$subject = '404 Error';
$email_body = "404 ERROR\n\n Path: " . ABSPATH . "\n URI: {$_SERVER['REQUEST_URI']}\n Referrer: $referrer\n IP address: {$_SERVER['REMOTE_ADDR']}\n Browser: {$_SERVER['HTTP_USER_AGENT']}";
send_email(ADMIN_EMAIL_TO, $subject, $email_body, ADMIN_EMAIL_FROM);

http_response_code(404);
?>
<h1>404 - Page Not Found </h1>
