<?php
ob_start();
session_start();


require('./config.php');

//----------------------------------------------------------------------------------------
// Create PDO DB Connection
//----------------------------------------------------------------------------------------
require "../vendor/autoload.php";


//----------------------------------------------------------------------------------------
// Create PDO DB Connection
//----------------------------------------------------------------------------------------

use PerfectApp\Database\MysqlConnection;


$db = new MysqlConnection();
$pdo = $db->connect();

if (!is_object($pdo))
{
    return false;
}

/*$loginAttempts = new MysqlQuery($pdo);
include './templates/listLoginAttempts.php';
*/




//die();







//----------------------------------------------------------------------------------------
// Allow direct access to this page
//----------------------------------------------------------------------------------------

define('SECURE_PAGE', true);

//----------------------------------------------------------------------------------------
// Redirect if not logged in
//----------------------------------------------------------------------------------------

/*if (!isset($_SESSION['login']))
{
    header("Location: ../login.php");
    die;
}*/

//----------------------------------------------------------------------------------------
//
//----------------------------------------------------------------------------------------

include('./includes/header.php');
include('./includes/navbar.php');
include('./includes/display_pages.php');

?>
<div class="row">
    <div class="col-md-3">
        <?php include('./templates/menu.php'); ?>
    </div>
    <div class="col-md-9">
        <?php include("$include"); ?>
    </div>
</div>
<?php include('./includes/footer.php'); ?>