<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $titolo ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/forms.js"></script>
<script src="../assets/js/ajax-functions.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<body style="background: rgb(45, 44, 56);">

<nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
    <div class="container">
        <a href="/bisocial-tecweb/src/index.php"><img  src="../assets/img/bisocial-logo.png" class="logo"></a>
        <nav class="navbar navbar-light navbar-expand-md">
                <button class="fa fa-search "id="search-button" onclick="toggleSearchTab();"></button>
                <!-- Notification -->
                <div class="w3-dropdown-hover">
                <button class="w3-button fas fa-bell center"  type="submit" name="notify-button" value="notify-button"></button>
                <div id="notifications-container">
                <?php 
                if($dbh->countNotification($_SESSION["user_id"])>0){
                    echo '<div class="w3-dropdown-content w3-bar-block w3-border drop-menu" >
                    <ul>';
                         
                    require('notification.php');
                            
                                
                    echo '
                    <li>
                                <button onclick="deleteAllNotifications()" class="delete-notification">
                                Cancella tutte le notifiche
                                </button>
                    </li>
                    </ul>
                    </div>';
                }
                ?>
                </div>
                <div id="notifications-count" class="badge"><?php echo $dbh->countNotification($_SESSION["user_id"]); ?></div>
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
    <div class="text-center mx-auto under-header">
        <div class="text-center">
            <a href="/bisocial-tecweb/src/index.php" class="btn btn-primary main-button" >GENERAL</a>
            <a href="/bisocial-tecweb/src/personal.php?username=<?php echo $_SESSION["username"]?>" class="btn btn-primary main-button">PERSONAL</a>
        </div>
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
        </div>
    </a>
</main>
<footer class="bg-dark" >
    <div class="container py-4 py-lg-5" style="display: inline-flex; justify-content:right;">
        <div class="text-muted d-flex justify-content-between align-items-center pt-3">
            <p class="mb-0" style="display: inline-flex;padding-right: 15px;padding-top: 13px;">Be unique.</p>
        </div>
        <div class="text-muted d-flex justify-content-between align-items-center pt-3">
            <img src="../assets/img/bisocial-logo.png" style="width: 124px;position: relative;display: inline-flex;">
        </div>
    </div>
</footer>


</body>

</html>