<?php
/**
 * Last Modified <!--%TimeStamp%-->1/14/2017 11:14 PM<!---->
 */

if (!isset($_GET['k']))
    {
    die(header("Location: ./index.php"));
    }

require ("../config.php");

$encoded_token = $_GET['k'];

/** Decode token and hash it */
$raw_token = hex2bin($encoded_token);
$token_hash = hash('sha256', $raw_token);

/** look up $token_hash */
$sql = "SELECT confirmation_key FROM users WHERE confirmation_key = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token_hash]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row)
    {
    die(header("Location: login.php?failed_confirmation"));
    }

$sql = "UPDATE users SET is_active=?, verified_email=?, confirmation_key=? WHERE confirmation_key = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([1, 1, NULL, $token_hash]);

die(header("Location: ./login.php?verified"));
