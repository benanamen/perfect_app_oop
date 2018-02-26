<?php
/**
 * Last Modified <!--%TimeStamp%-->11/25/2017 3:26 PM<!---->
 */

//----------------------------------------------------------------------------------------
// Block Direct Access
//----------------------------------------------------------------------------------------

if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
?>

<div class="card border-primary mb-3" style="max-width: 15rem;">
    <div class="card-header">
        <img src="./images/default_profile.jpg" width="140" height="140" alt="Profile Image">
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="<?= $_SERVER['SCRIPT_NAME'] ?>">Home</a></li>

        <li class="list-group-item"><a href="<?= $_SERVER['SCRIPT_NAME'] ?>?p=settings">Settings</a></li>
        <li class="list-group-item"><a href="<?= $_SERVER['SCRIPT_NAME'] ?>?p=list_logins">Login Attempts</a></li>
        <li class="list-group-item"><a href="<?= $_SERVER['SCRIPT_NAME'] ?>?p=errors">Error Log</a></li>
    </ul>
</div>