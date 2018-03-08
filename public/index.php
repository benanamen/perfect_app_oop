<?php
ob_start();
session_start();

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

require('./config.php');
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