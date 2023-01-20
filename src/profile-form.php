<?php
if(($_FILES['user_image']['size'] != 0)) {
    require("image-upload.php");
}
if(!empty($_POST['email']) || !empty($_POST['nome']) ||
    !empty($_POST['cognome']) || !empty($_POST['password']) ||
    !empty($_POST['confirmpass']) || !empty($_POST['bio']) ||
    isset($GLOBALS['uploadResponse'])) {
    require("profile-update.php");
}
$userImage = $dbh->getImage($_SESSION['user_id'])[0];
?>
<div class="container profile profile-view" id="profile">
    <div class="row">
        <?php
        if (isset($GLOBALS['updateResponse'])) {
            if (!$GLOBALS['updateResponse']) {
                echo '<div class="col-md-12 alert-col relative">
                    <div id="profile-edit" style="display: block; background-color: lightgreen" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">' . $updateMessage . '</span></div>
                </div>';
            } else {
                echo '<div class="col-md-12 alert-col relative">
                    <div id="profile-edit" style="display: block; background-color: lightcoral" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">' . $updateMessage . '</span></div>
                </div>';
            }
            unset($GLOBALS['updateResponse']);
        }
        if (isset($GLOBALS['uploadResponse'])) {
            if (!$GLOBALS['uploadResponse']) {
                echo '<div class="col-md-12 alert-col relative">
                    <div id="profile-edit" style="display: block; background-color: lightgreen" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">' . $uploadMessage . '</span></div>
                </div>';
            } else {
                echo '<div class="col-md-12 alert-col relative">
                    <div id="profile-edit" style="display: block; background-color: lightcoral" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">' . $uploadMessage . '</span></div>
                </div>';
            }
            unset($GLOBALS['uploadResponse']);
        }
        ?>
    </div>
    <form method="post" class="profile" name="profile-form" enctype="multipart/form-data">
        <div class="row profile-row" style="margin:20px 0px">
            <div class="col-md-4 relative">
                <div class="avatar">
                    <div class="avatar-bg center">
                        <?php
                        echo '<image src="../assets/img/propic/' . $userImage['user_image'] . '" style="height: 200px;background-size: cover;width: 200px;margin: auto;display: block;"></image>';
                        ?>
                    </div>
                </div><hr><input class="form-control form-control" type="file" name="user_image" style="font-family: 'Roboto Condensed', sans-serif;">
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
                        <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Password </label><input class="form-control" type="password" name="p" autocomplete="off"></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label" style="font-family: 'Roboto Condensed', sans-serif;">Conferma Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" name="updateProfile" value="updateProfile" onclick="formhash(this.form, this.form.password);" type="submit" style="font-family: 'Roboto Condensed', sans-serif;padding-right: 22px;padding-left: 22px;padding-bottom: 8px;padding-top: 8px;">SAVE </button><button class="btn btn-danger form-btn" onclick="document.getElementById('profile-edit').style.display = 'none'" type="reset" style="font-family: 'Roboto Condensed', sans-serif;padding-right: 22px;padding-left: 22px;padding-bottom: 8px;padding-top: 8px;">CANCEL </button></div>
                </div>
            </div>
        </div>
    </form>
</div>

