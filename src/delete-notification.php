<?php 
include 'bootstrap.php';
if(isset($_POST['notif_id'])){
    $dbh->deleteNotification($_POST['notif_id']);
}

if(isset($_POST["deleteAll"])){
    $dbh->deleteAllNotifications($_SESSION["user_id"]);
    echo "1";
}
?>
