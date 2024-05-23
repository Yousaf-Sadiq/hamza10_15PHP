<?php
require_once dirname(__DIR__) . "/../app/database.php";
require_once dirname(__DIR__) . "/../include/web.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<style>
    #error {
        position: fixed;
        z-index: 99999;
        top: 10px;
        right: 0px;
        width: 300px;

    }
</style>

<body>
    <div id="error"></div>

    <?php

    require_once "nav.php";
    ?>