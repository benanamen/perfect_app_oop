<?php
/**
 * Last Modified <!--%TimeStamp%-->1/14/2017 11:14 PM<!---->
 */

if (!isset($_GET['k']))
{
    header("Location: ./index.php");
    die;
}

require("./config.php");

$encoded_token = $_GET['k'];

/** Decode token and hash it */
$raw_token = hex2bin($encoded_token);
$token_hash = hash('sha256', $raw_token);

/** look up $token_hash */
$sql = "SELECT verify_email_hash FROM users WHERE verify_email_hash = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token_hash]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row)
{
    header("Location: login.php?failed_confirmation");
    die;
}

$sql = "UPDATE users SET is_active=?, is_email_verified=?, verify_email_hash=? WHERE verify_email_hash = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([1, 1, NULL, $token_hash]);

header("Location: ./login.php?verified");
die;
