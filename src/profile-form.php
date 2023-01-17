<?php
//DA FINIRE, FAR USCIRE L'ALERT IN BASE ALLA RESPONSE
$GLOBALS['response'] = 0;
if (isset($_POST['updateProfile']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    updateProfile();
}

function updateProfile()
{
    $dbh = new DatabaseHelper("localhost","root","","bisocial",3306);
    $result = $dbh->getUserInfo($_SESSION['user_id'])[0];

    $email = !empty($_POST['email']) ? $_POST['email'] : $result['email'];
    $nome = !empty($_POST['nome']) ? $_POST['nome'] : (!empty($result['nome']) ? $result['nome'] : NULL);
    $cognome = !empty($_POST['cognome']) ? $_POST['cognome'] : (!empty($result['cognome']) ? $result['cognome'] : NULL);
    $bio = !empty($_POST['bio']) ? $_POST['bio'] : (!empty($result['bio']) ? $result['bio'] : NULL);
    $image = !empty($_POST['user_image']) ? $_POST['user_image'] : (!empty($result['user_image']) ? $result['user_image'] : NULL);

    if (!empty($_POST['password'])) {
        if (!empty($_POST['confirmpass'])) {
            if ($_POST['password'] == $_POST['confirmpass']) {
                $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                $password = hash('sha512', $_POST['password'] . $salt);
                $dbh->updateProfile($_SESSION['user_id'], $email, $password, $salt, $nome, $cognome, $bio, $image);
            } else {
                $GLOBALS['response'] = 1;
            }
        } else {
            $GLOBALS['response'] = 2;
        }
    } else {
        $GLOBALS['response'] = 3;
        $password = $result['password'];
        $salt = $result['salt'];
        $dbh->updateProfile($_SESSION['user_id'], $email, $password, $salt, $nome, $cognome, $bio, $image);
    }
}
?>
<div class="container profile profile-view" id="profile">
    <div class="row">
        <?php
        if (!empty($GLOBALS['response'])) {
            switch ($GLOBALS['response']) {
                case 3:
                    echo '<div class="col-md-12 alert-col relative">
                <div id="profile-edit" style="display: block; background-color: lightgreen" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">Profilo modificato correttamente</span></div>
            </div>';
                    break;
                case 1:
                    echo '<div class="col-md-12 alert-col relative">
                <div id="profile-edit" style="display: block; background-color: lightcoral" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">Le due password non sono uguali</span></div>
            </div>';
                    break;
                case 2:
                    echo '<div class="col-md-12 alert-col relative">
                <div id="profile-edit" style="display: block; background-color: lightcoral" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">La password di conferma non è stata inserita</span></div>
            </div>';
            }
        }
        ?>
    </div>
    <form method="post" class="profile" name="profile-form">
        <div class="row profile-row" style="margin:20px 0px">
            <div class="col-md-4 relative">
                <div class="avatar">
                    <div class="avatar-bg center" >
                        <image src="/bisocial-tecweb/resources/profile.png" style="height: 200px;background-size: cover;width: 200px;margin: auto;display: block;"></image>
                    </div>
                </div><input class="form-control form-control" type="file" name="user_image" style="font-family: 'Roboto Condensed', sans-serif;">
                <hr>
                <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Bio</label><input class="form-control" type="text" autocomplete="off" name="bio"></div>
            </div>
            <div class="col-md-8">
                <h1 class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Modifica Profilo </h1>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Nome </label><input class="form-control" type="text" name="nome"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Cognome </label><input class="form-control" type="text" name="cognome"></div>
                    </div>
                </div>
                <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Email </label><input class="form-control" type="email" autocomplete="off" name="email"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Password </label><input class="form-control" type="password" name="password" autocomplete="off"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Conferma Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" name="updateProfile" value="updateProfile" onclick="pformhash(this.form, this.form.password);" type="submit" style="font-family: 'Roboto Condensed', sans-serif;padding-right: 22px;padding-left: 22px;padding-bottom: 8px;padding-top: 8px;">SAVE </button><button class="btn btn-danger form-btn" onclick="document.getElementById('profile-edit').style.display = 'none'" type="reset" style="font-family: 'Roboto Condensed', sans-serif;padding-right: 22px;padding-left: 22px;padding-bottom: 8px;padding-top: 8px;">CANCEL </button></div>
                </div>
            </div>
        </div>
    </form>
</div>

