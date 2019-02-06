<?php declare (strict_types=1);

/**
 * This file: display_pages.php
 * Acts as a Router to display pages
 * Restricts access to certain files
 *
 * Last Modified <!--%TimeStamp%-->1/14/2017 9:03 PM<!---->
 */

if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}

//------------------------------------------------------------------------
// Restrict access to these files
//------------------------------------------------------------------------

/**
 * Specify disallowed paths
 */

$restricted_files = [
      'header'
    , 'footer'
    , 'navbar'
    , 'menu'
];

//----------------------------------------------------------------------------------------
// Display Pages
//----------------------------------------------------------------------------------------

if (isset($_GET['p']))
{
    $page = basename($_GET['p']);

    if (!in_array($page, $restricted_files) && file_exists("./includes/$page.php"))
    {
        $include = "./includes/$page.php";
    }
    else
    {
        $include = './includes/404.php';
    }
}
else
{
    $include = './includes/default.php';
}