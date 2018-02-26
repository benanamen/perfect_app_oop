<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
?>
<!doctype html>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./bootstrap/4.0.0/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/dataTables.bootstrap4.min.css">

    <!-- Custom styles -->
    <link href="./css/custom.css" rel="stylesheet">

    <script src="./js/jquery-1.12.4.js"></script>

    <!-- Data Tables -->
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myDataTable').DataTable();
        });
    </script>

    <title></title>
</head>

<body>
<div class="container">
