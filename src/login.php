<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>studio-design</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="logo"><img src="../assets/img/bisocial-logo.png" alt="Logo BiSocial" class="logo"></div>
    <div class="padding">
        <form action="process_login.php" method="post" class="login" name="login_form">
                <input class="form-control login" type="text" placeholder="Username" name="username"/>
                <input class="form-control login" type="password" placeholder="Password" name="p" id="password" />
                <input type="submit" value="Login" onclick="formhash(this.form, this.form.password);" />
            <div class="center"><a href="#" class="forgot-password">Password dimenticata?</a>
                <button class="btn btn-primary login">Login</button>
            </div>
        </form>
        <div class="oppure"><span class="separator">
    altrimenti</div>
        <div class="center"><button class="btn btn-primary registration register" type="button">Registrati</button></div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/sha512.js"></script>
    <script type="text/javascript" src="../assets/js/forms.js"></script>
</body>

</html>