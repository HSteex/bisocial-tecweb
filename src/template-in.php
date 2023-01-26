<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $titolo ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background: rgb(45, 44, 56);">
<nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
    <div class="container">
        <a href="/bisocial-tecweb/src/index.php"><img  src="../assets/img/bisocial-logo.png" class="logo"></a>
        <nav class="navbar navbar-light navbar-expand-md">
                <button class="fa fa-search "id="search-button" onclick="toggleSearchTab();"></button>
                
                <div class="w3-dropdown-hover">
                <button class="w3-button fas fa-bell center" onclick="window.location.href='notification.php';" type="submit" name="notify-button" value="notify-button"></button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                    <?php 
                        require('notification.php')
                        ?>
                </div>
                <div class="badge">3</div>
                </div>
            

            <span><a href="logout.php" class="logout fa fa-power-off"></a></span>
        </nav>
    </div>
</nav>
<header class="bg-dark" style="background: rgb(39, 38, 46);">
    <div id="search-tab">
        <form action="user-search.php" method="get">
            <input type="text" class="form-control" id="search-form" name="user-to-find" style="height: 25px">
        </form>
    </div>
    <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto" style="background: rgb(45,44,56);padding-bottom: 7px;padding-top: 7px;border-radius: 32px;margin-left: 3% !important;margin-right: 3% !important;border: 0px solid rgb(38,38,38);display: inline;">
        <div class="text-center"><a href="/bisocial-tecweb/src/index.php" class="btn btn-primary" style="background: linear-gradient(-155deg, #4fc3c3 8%, #662c92 53%, #f1592a 94%), #4fc3c3;border-width: 1px;border-color: #fff !important;font-family: 'Roboto Condensed', sans-serif;font-size: 80%;padding-top: 8px;padding-bottom: 8px;padding-right: 32px;padding-left: 32px;margin-right: 1%;margin-left: 1%;">GENERAL</a><a href="/bisocial-tecweb/src/personal.php?username=<?php echo $_SESSION["username"]?>" class="btn btn-primary" style="background: linear-gradient(-155deg, #4fc3c3 8%, #662c92 53%, #f1592a 94%), #4fc3c3;border-width: 1px;border-color: #fff !important;font-family: 'Roboto Condensed', sans-serif;font-size: 80%;padding-top: 8px;padding-bottom: 8px;padding-right: 32px;padding-left: 32px;margin-right: 1%;margin-left: 1%;">PERSONAL</a></div>
    </div>
</header>
<main>
    <?php
        require("post-upload-alert.php");
        require($pagina);
        require("post-form.php");
    ?>
    <a href="#" class="float">
        <div class="center">
        <button onclick="postOverlayOn()" class="fa fa-plus my-float"></button>
            </a>
        </div>
</main>
<footer class="bg-dark">
    <div class="container py-4 py-lg-5" style="padding-top: 0px !important;display: inline-flex; justify-content:right;">
        <div class="text-muted d-flex justify-content-between align-items-center pt-3">
            <p class="mb-0" style="display: inline-flex;padding-right: 15px;padding-top: 13px;">Copyright © 2022</p>
        </div>
        <div class="text-muted d-flex justify-content-between align-items-center pt-3"><img src="../assets/img/bisocial-logo.png" style="width: 124px;position: relative;display: inline-flex;"></div>
    </div>
</footer>

<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/forms.js"></script>
<script src="../assets/js/ajax-functions.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>