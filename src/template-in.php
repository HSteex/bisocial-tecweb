<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $titolo ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
</head>

<body style="background: rgb(45, 44, 56);">
<nav class="navbar navbar-dark navbar-expand-md bg-dark py-3" style="background: rgb(39, 38, 46);">
    <div class="container"><img src="../assets/img/bisocial-logo.png" style="width: 124px;color: rgb(255,255,255);">
        <nav class="navbar navbar-light navbar-expand-md" style="background: rgb(39,38,46);display:flex;">
            <div class="container-fluid">
            <span><button id="search-button" onclick="toggleSearchTab();"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#b0320c" class="bi bi-search-heart-fill" viewBox="0 0 16 16" >
                <path d="M6.5 13a6.474 6.474 0 0 0 3.845-1.258h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.008 1.008 0 0 0-.115-.1A6.471 6.471 0 0 0 13 6.5 6.502 6.502 0 0 0 6.5 0a6.5 6.5 0 1 0 0 13Zm0-8.518c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z"/>
                    </svg></button></span>
            <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#692d98" class="bi bi-bell-fill" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
            </svg></span>
            <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgb(117, 230, 178)" class="bi bi-inbox-fill" viewBox="0 0 16 16">
                <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z"/>
            </svg></span>
            <span><a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="red" class="bi bi-emoji-smile-upside-down" viewBox="0 0 16 16">
                <path d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0-1a8 8 0 1 1 0 16A8 8 0 0 1 8 0z"/>
                <path d="M4.285 6.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 4.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 3.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 9.5C7 8.672 6.552 8 6 8s-1 .672-1 1.5.448 1.5 1 1.5 1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5.448 1.5 1 1.5 1-.672 1-1.5z"/>
            </svg></a></span>
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
        <button onclick="postOverlayOn()" class="fa fa-plus my-float">+</button>
    </a>
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

</body>

</html>