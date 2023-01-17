<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $titolo ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="background: rgb(45, 44, 56);">
<nav class="navbar navbar-dark navbar-expand-md bg-dark py-3" style="background: rgb(39, 38, 46);">
    <div class="container"><img src="../assets/img/bisocial-logo.png" style="width: 124px;color: rgb(255,255,255);">
        <div class="collapse navbar-collapse" id="navcol-5">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
            </ul>
        </div>
        <nav class="navbar navbar-light navbar-expand-md" style="background: rgb(39,38,46);">
            <div class="container-fluid"><span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon" style="position: relative;transform: translate(0px);background: #f1592a;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-search">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                        </svg></span><span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon" style="position: relative;transform: translate(0px) translateX(0px);background: #662c92;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bell-fill">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"></path>
                        </svg></span><span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon" style="background: #4fc3c3;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-inbox-fill">
                            <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm-1.17-.437A1.5 1.5 0 0 1 4.98 3h6.04a1.5 1.5 0 0 1 1.17.563l3.7 4.625a.5.5 0 0 1 .106.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z"></path>
                        </svg></span>
                <a href="logout.php" class="btn btn-primary" style="background: darkred;border-width: 1px;border-color: #fff !important;font-family: 'Roboto Condensed', sans-serif;font-size: 60%;padding-top: 2px;padding-bottom: 2px;padding-right: 6px;padding-left: 6px;margin-right: 1%;margin-left: 100px;float: right">LOGOUT</a>
            </div>
        </nav>
    </div>
</nav>
<header class="bg-dark" style="background: rgb(39, 38, 46);">
    <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto" style="background: rgb(45,44,56);padding-bottom: 7px;padding-top: 7px;border-radius: 32px;margin-left: 3% !important;margin-right: 3% !important;border: 0px solid rgb(38,38,38);display: inline;">
        <div class="text-center"><a href="/bisocial-tecweb/src/index.php" class="btn btn-primary" style="background: linear-gradient(-155deg, #4fc3c3 8%, #662c92 53%, #f1592a 94%), #4fc3c3;border-width: 1px;border-color: #fff !important;font-family: 'Roboto Condensed', sans-serif;font-size: 80%;padding-top: 8px;padding-bottom: 8px;padding-right: 32px;padding-left: 32px;margin-right: 1%;margin-left: 1%;">GENERAL</a><a href="/bisocial-tecweb/src/personal.php" class="btn btn-primary" style="background: linear-gradient(-155deg, #4fc3c3 8%, #662c92 53%, #f1592a 94%), #4fc3c3;border-width: 1px;border-color: #fff !important;font-family: 'Roboto Condensed', sans-serif;font-size: 80%;padding-top: 8px;padding-bottom: 8px;padding-right: 32px;padding-left: 32px;margin-right: 1%;margin-left: 1%;">PERSONAL</a></div>
    </div>
</header>
<main>
    <?php
        require($pagina);
    ?>
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
</body>

</html>