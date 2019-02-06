<?php declare (strict_types=1);

if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
?>
<!doctype html>

<html lang="en">
<head>

    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--    <link rel="stylesheet" type="text/css" href="./bootstrap/4.0.0/css/bootstrap.css">-->
    <link rel="stylesheet" type="text/css" href="./css/dataTables.bootstrap4.min.css">

    <!-- Custom styles -->
    <link href="./css/custom.css" rel="stylesheet">
    <link href="./css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">

    <script src="./js/jquery-1.12.4.js"></script>

    <!-- Data Tables -->
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myDataTable').DataTable({
                "order" : [[ 3, "desc"]]
            });
        });
    </script>

    <title><?= APP_NAME ?></title>
</head>

<body>
<div class="container">
