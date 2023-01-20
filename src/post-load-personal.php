<?php
//$dbh = new DatabaseHelper("localhost","root","","bisocial",3306);
$userInfo = $dbh->getUserInfo($_SESSION['user_id'])[0];
?>
<div class="text-center profile-card" style="max-width:1024px;margin: 15px;background: rgb(39, 38, 46);max-width: 1024px;margin:auto;">
    <div class="settings-button" style="background-image: url();height: 100px;background-size: cover;"><a href="/bisocial-tecweb/src/profile.php" class="btn btn-primary" style="background: rgb(39,38,46);border-width: 1px;border-color: #fff !important;font-family: 'Roboto Condensed', sans-serif;font-size: 60%;padding-top: 4px;padding-bottom: 4px;padding-right: 8px;padding-left: 8px;margin-right: 10%;margin-left: 80%;display: flex;position: static;transform: translate(0px);">SETTINGS</a></div>
    <div><?php echo '<img class="rounded-circle" style="margin-top:-70px;" src="../assets/img/propic/' . $userInfo['user_image'] . '" height="150px">'?>
        <h3 class="form-label" style="color: white"><?php echo $userInfo['nome'] . ' ' . $userInfo['cognome'];?></h3>
        <p class="form-label" style="padding: 20px;padding-bottom: 0;padding-top: 5px;"><?php echo $userInfo['bio'];?></p>
    </div>
    <div class="row" style="padding:0;padding-bottom:10px;padding-top:20px;">
        <div class="col-md-6">
            <p class="form-label">Followers</p>
            <p class="form-label"><strong>12M</strong> </p>
        </div>
        <div class="col-md-6">
            <p class="form-label">Following</p>
            <p class="form-label"><strong>1M</strong> </p>
        </div>
    </div>
</div>
<?php
require("post-load.php");
?>
