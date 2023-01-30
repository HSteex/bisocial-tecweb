<?php
require("bootstrap.php");
if (!empty($_POST['content'])) {
    $dbh->addComment($_POST['post_id'], $_SESSION['user_id'], $_POST['content'], date('Y-m-d H:i:s', time()));#Notification details saved in db
    $postOwner=$dbh->getPostOwner($_POST['post_id']);
    if($postOwner!=$_SESSION['user_id']){
        $dbh->saveNotify($_SESSION["user_id"],$postOwner,"ha commentato il tuo post", "http://localhost/bisocial-tecweb/src/index.php?post_id=".$_POST["post_id"]);
    }
}

